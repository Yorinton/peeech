<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function messages()
    {
    	return $this->hasMany(Message::class);
    }    

}
