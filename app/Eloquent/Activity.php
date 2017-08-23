<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
