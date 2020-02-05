<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';

    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    public function user()
    {
        return $this->hasMany('App\Model\User', 'room_id', 'id');
    }
}
