<?php

namespace App\Http\Controllers;

use App\Events\MapGlobalChatSent;
use App\Models\MapGlobalChat;
use Illuminate\Http\Request;

class MapGlobalChatsController extends Controller
{
    public function index()
    {
        $messages = MapGlobalChat::with('user')->get();
        return view('map_chat.global-chat', compact('messages'));
    }

    public function store(Request $request)
    {
        $message = MapGlobalChat::create([
            'sender' => auth()->user()->id,
            'message' => $request->message,
        ]);

        broadcast(new MapGlobalChatSent($message->user, $request->message))->toOthers();

        return response()->json('Message sent successfully');
    }
}
