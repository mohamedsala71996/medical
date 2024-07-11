<?php

namespace App\Http\Controllers;

use App\Events\MapGroupChatSent;
use App\Models\MapGroup;
use App\Models\MapGroupChat;
use Illuminate\Http\Request;

class MapGroupController extends Controller
{
    public function index($id)
    {

         $group = MapGroup::with('admin')->where('id', $id)->first();
        
        $messages = MapGroupChat::with('user')->where('group_id', $group->id)->get();
        return view('map_chat.group-chat', compact('messages', 'group'));
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
        toastr()->success(__('chat deleted successfully'));
        return redirect()->back();
    }




}
