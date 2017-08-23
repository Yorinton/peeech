<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Eloquent;

class Message extends Model
{
	protected $fillable = [
		'message',
		'room_id',
	];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function room()
    {
    	return $this->belongsTo(Room::class);
    }
}
