<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
	protected $fillable = ['user_id','region'];
    //Relation
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    //init
    public static function init($user_id,String $string)
    {
    	return Region::create(['user_id' => $user_id,'region' => $string]);
    }
}
