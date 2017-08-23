<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Idol extends Model
{
    //Relation
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function idol_master()
    {
    	return $this->belongsTo(IdolMaster::class);
    }
}
