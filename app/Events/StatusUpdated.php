<?php
namespace App\Events;

use App\Models\Notificaation;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Notification;

class StatusUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function broadcastOn()
    {
        return new Channel('status-updates');
    }

    public function broadcastWith()
    {
        $groupId = $this->user->adminOfGroup ? $this->user->adminOfGroup->id : null;
    
        // Save the notification in the database
        Notificaation::create([
            'user_id' => $this->user->id,
            'status' => $this->user->status,
            'group_id' => $groupId,
        ]);
    
        return [
            'username' => $this->user->name,
            'status' => $this->user->status,
            'group_id' => $groupId,
            'user_id' => $this->user->id, // Include the user ID in the broadcast data
        ];
    }
    }

