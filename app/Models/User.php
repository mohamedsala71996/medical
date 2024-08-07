<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Group;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'type',
        'password',
        'phone',
        'terms',
        'status',
        'face_id_card',
        'back_id_card',
        'date_of_birth',
        'is_approved',
        'longitude',
        'latitude',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function group()
    {
        return $this->belongsToMany('App\Models\Group', 'admin_id');
    }

    public function group_member()
    {
        return $this->belongsToMany('App\Models\Group', 'group_participants', 'user_id', 'group_id')->orderBy('updated_at', 'desc');
    }

    public function message()
    {
        return $this->hasMany('App\Models\Message', 'user_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class)->withTimestamps();
    }

    public function receivesBroadcastNotificationsOn()
    {
        return 'users.'.$this->id;
    }

    public function adminOfGroup()
    {
        return $this->hasOne(MapGroup::class, 'admin_id'); // user can be admin on one group only and group has only one admin 
    }

    public function location()
    {
        return $this->hasOne(Location::class);
    }

    public function ratings()
{
    return $this->hasMany(Rating::class);
}

}
