<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GroupChat implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public  $message;
    public $group_id;
    public $user;

    public function __construct(string $message, int $group_id, $user)
    {
        $this->message = $message;
        $this->group_id = $group_id;
        $this->user = $user;
    }

    public function broadcastOn(): array
    {

        return [new Channel('groupchat-' . $this->group_id )];
    }

    public function broadcastAs(): string
    {
        return 'chat';
    }
}
