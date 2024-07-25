<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'ratings';


    protected $fillable = [
        'user_id', 'rating',
        'rated_by',
    ];

    // In Rating.php
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rater()
    {
        return $this->belongsTo(User::class, 'rated_by');
    }
}
