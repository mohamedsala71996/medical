<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\StatusUpdated;
use App\Models\Notificaation;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function updateStatus(Request $request)
    {
        $request->validate([
            'status' => 'required|string|in:active,critical,inactive',
        ]);
        $user = Auth::user();
        if ($user) {
            $user = User::findOrFail(Auth::user()->id);
            $user->status = $request->status;
            $user->save();
            if ($request->status == 'critical') {
                broadcast(new StatusUpdated($user))->toOthers();
            }
            if (in_array($request->status, ['active', 'critical'])) {
                return response()->json(['success' => true, 'message' => 'Status updated. Please allow location access.', 'updateLocation' => true]);
            } elseif ($request->status == 'inactive') {
                Location::where('user_id', $user->id)->delete();
                return response()->json(['success' => true, 'message' => 'Status updated and location deleted.']);
            }
            return response()->json(['success' => true, 'message' => 'Status updated.']);
        }
        return response()->json(['success' => false, 'message' => 'User not authenticated.'], 401);
    }

    public function notification()
    {
        $notifications = Notificaation::where('user_id','!=' ,Auth::id())->take(50)->get();
        return view('notifications', compact('notifications'));
    }

    // public function markAsRead($id)
    // {
    //     $notification = Notificaation::find($id);

    //     if ($notification) {
    //         $notification->read_at = now();
    //         $notification->save();
    //         return response()->json(['success' => true]);
    //     }

    //     return response()->json(['success' => false], 404);
    // }

}
