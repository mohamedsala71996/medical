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
use App\Events\PusherBroadcast;

class PusherController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }

    public function sendMessage(Request $request)
    {
        $message = auth()->user()->name . ': ' . $request->input('message');
        event(new MessageSent($message));
        return response()->json(['status' => 'Message sent!']);
    }

}
