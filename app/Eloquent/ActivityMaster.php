<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class ActivityMaster extends Model
{
    public function activities()
    {
    	return $this->hasMany(Activity::class);
    }
}
