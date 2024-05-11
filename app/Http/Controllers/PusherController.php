<?php

namespace App\Http\Controllers;
use App\Events\AskingForHelp;
use App\Models\chat;
use App\Models\Message;
use App\Models\User;
use App\Notifications\ASkingForHelpNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;
use App\Models\Group;
use App\Models\Post;

use View;
use App\Events\GroupCreated;
use App\Events\GroupChat;

class PusherController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }

    public function broadcast(Request $request)
    {
        Message::create([
            'user_id' => Auth::id(),
            'group_id' => $request->group_id,
            'from' => Auth::id(),

            'message' => $request->get('message'),
        ]);
        broadcast(new GroupChat($request->get('message'), $request->group_id, auth()->user()))->toOthers();

        return view('messages.broadcast', ['message' => $request->get('message'), 'user_image' => Auth::user()->image]);
    }

    public function receive(Request $request)
    {

        return view('messages.receive', ['message' => $request->get('message'), 'user'=> $request->user]);
    }

}
