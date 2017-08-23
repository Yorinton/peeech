<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class IdolMaster extends Model
{
    //
    public function idols()
    {
        return $this->hasMany(Idol::class);
    }
}
