<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Statue extends Model
{
    //Relation
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function statue_master()
    {
    	return $this->belongsTo(StatueMaster::class);
    }
}
