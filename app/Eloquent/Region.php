<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    //Relation
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
