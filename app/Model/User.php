<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'first_time',
        'role_id',
        'room_id',
    ];

    public function room()
    {
        return $this->belongsTo('App\Model\Room', 'room_id', 'id');
    }

    // public function role()
    // {
    //     return $this->belongsTo('App\Models\Role', 'role_id', 'id');
    // }

    public function role()
    {
        return $this->hasOne('App\Model\Role', 'id', 'role_id');
    }
}
