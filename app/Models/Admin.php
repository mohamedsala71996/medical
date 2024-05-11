<?php

namespace App\Models;

use App\Http\Traits\ColumnFillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Model
{
    use SoftDeletes;
    use HasRoles;
    protected $softDelete = true;


    protected $fillable = [
        'name', 'email', 'password','image','lang','admin_type','phone','slider_theme','header_theme'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}//end class
