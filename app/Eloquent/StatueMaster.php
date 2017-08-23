<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class StatueMaster extends Model
{
    //
    public function statues()
    {
    	return $this->hahMany(Statue::class);
    }
}
