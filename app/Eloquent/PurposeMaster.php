<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class PurposeMaster extends Model
{
    //
    public function purposes(){
    	return $this->hasMany(Purpose::class);
    }
}
