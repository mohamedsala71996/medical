<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\StatusUpdated;
use App\Models\Notificaation;
use App\Models\Notification;
use App\Models\Rating;
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

    public function showMap($id) {
        $user = User::find($id);
        $authUserId = Auth::id();
        $userIds = [$user->id, $authUserId];
    
        $location = Location::where('user_id', $user->id)->first();
        $authLocation = Location::where('user_id', $authUserId)->first();
    
        $locations = Location::whereIn('user_id', $userIds)->get();
        $averageRating = $location->user->ratings()->avg('rating');
        $countRating = $location->user->ratings()->count();
        $userHasRated = Rating::where('user_id', $location->user->id)
                               ->where('rated_by', $authUserId)
                               ->exists();
    
        $distance = null;
        if ($location && $authLocation) {
            $distance = $this->haversineGreatCircleDistance(
                $location->latitude,
                $location->longitude,
                $authLocation->latitude,
                $authLocation->longitude
            );
        }
    
        return view('location.user-map', compact('user', 'locations', 'location', 'averageRating', 'userHasRated', 'countRating', 'authLocation', 'distance'));
    }
    
    private function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371)
    {
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);
    
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;
    
        $a = sin($latDelta / 2) * sin($latDelta / 2) +
             cos($latFrom) * cos($latTo) *
             sin($lonDelta / 2) * sin($lonDelta / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    
        return $earthRadius * $c;
    }

}
