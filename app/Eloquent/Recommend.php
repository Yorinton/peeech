<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Recommend extends Model
{
    //Relation
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
