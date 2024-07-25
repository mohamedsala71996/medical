<?php

// namespace App\Console\Commands;

// use Illuminate\Console\Command;
// use App\Models\MapGroupChat;
// use App\Models\MapGroup;

// class DeleteMessage extends Command
// {
//     protected $signature = 'message:delete {messageId} {groupId}';

//     protected $description = 'Delete a message and its group after 30 minutes';

//     public function __construct()
//     {
//         parent::__construct();
//     }

//     public function handle()
//     {
//         $messageId = $this->argument('messageId');
//         $groupId = $this->argument('groupId');

//         $message = MapGroupChat::find($messageId);
//         $group = MapGroup::find($groupId);

//         if ($message) {
//             $message->delete();
//             $this->info('Message deleted successfully.');
//         } else {
//             $this->info('Message not found.');
//         }

//         if ($group) {
//             $group->delete();
//             $this->info('Group deleted successfully.');
//         } else {
//             $this->info('Group not found.');
//         }
//     }
// }
