<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapGroupChat extends Model
{
    use HasFactory;
    use HasFactory;

    protected $table = 'map_group_chats';

    protected $fillable = ['sender_id', 'message','group_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
