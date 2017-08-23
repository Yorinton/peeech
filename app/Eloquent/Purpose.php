<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Purpose extends Model
{

    //Relation
    public function user()
    {   	
    	return $this->belongsTo(User::class);   	
    }
    public function purpose_master()
    {
    	return $this->belongsTo(PurposeMaster::class);
    }
}
