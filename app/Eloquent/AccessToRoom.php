<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class AccessToRoom extends Model
{
    //
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function room()
    {
    	return $this->belongsTo(Room::class);
    }
}
