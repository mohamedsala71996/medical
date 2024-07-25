<?php

namespace App\Jobs;

use App\Models\MapGroupChat;
use App\Models\MapGroup;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $messageId;
    protected $groupId;

    public function __construct($messageId, $groupId)
    {
        $this->messageId = $messageId;
        $this->groupId = $groupId;
    }

    public function handle()
    {
        $message = MapGroupChat::find($this->messageId);
        $group = MapGroup::find($this->groupId);

        if ($message) {
            $message->delete();
        }

        if ($group) {
            $group->delete();
        }
    }
}
