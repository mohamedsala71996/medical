<?php

namespace App\Http\Controllers;

use App\Events\MapGroupChatSent;
use App\Jobs\DeleteMessageJob;
use App\Models\MapGroup;
use App\Models\MapGroupChat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class MapGroupController extends Controller
{
    public function index($id)
    {

         $group = MapGroup::with('admin')->where('id', $id)->first();
         if (!$group) {
            // Redirect or show an error message if the group does not exist
            return redirect()->back()->with('error', 'Group not found'); // Replace 'some.route' with an appropriate route
        }
        $messages = MapGroupChat::with('user')->where('group_id', $group->id)->get();

        $pin_message = MapGroupChat::with('user')->where('group_id', $group->id)->first();


        return view('map_chat.group-chat', compact('messages','pin_message', 'group'));
    }

    public function store(Request $request)
    {
        MapGroup::create([
            'name' => auth()->user()->name,
            'admin_id' => auth()->user()->id,
        ]);
        return redirect()->back();
    }

    public function messageStore(Request $request)
    {
        $group = MapGroup::where('id', $request->group_id)->first();
        $message = MapGroupChat::create([
            'group_id' => $request->group_id,
            'sender_id' => auth()->user()->id,
            'message' => $request->message,
        ]);
        broadcast(new MapGroupChatSent($message->user, $group, $request->message))->toOthers();

        return response()->json('Message sent successfully');
    }
    public function deleteMessages( $group_id)
    {
        $group = MapGroup::findOrFail($group_id);
        $group->messages()->delete();
        $group->delete();

        toastr()->success(__('chat deleted successfully'));
        return redirect('map');
    }
    public function pinMessageStore(Request $request,$id)
    {
        $group =MapGroup::create([
            'name' => auth()->user()->name,
            'admin_id' => auth()->user()->id,
        ]);
        if (!$group) {
            return redirect()->back()->with('error', 'Failed to create the group.');
        }    
        // $group = MapGroup::where('id', $id)->first();
        $message = MapGroupChat::create([
            'group_id' => $group->id,
            'sender_id' => auth()->user()->id,
            'message' => $request->message,
        ]);
        // broadcast(new MapGroupChatSent($message->user, $group, $request->message))->toOthers();
        if (!$message) {
            return redirect()->back()->with('error', 'Failed to create the message.');
        }
 
    // DeleteMessageJob::dispatch($message->id, $group->id)->delay(now()->addMinutes(30))->onQueue('default');

        return redirect("group/$group->id");
    }



}
