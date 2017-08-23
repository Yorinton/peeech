<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Matching extends Model
{

	// use SoftDeletes;

    /**
     * 日付へキャストする属性(ソフトデリート用)
     *
     * @var array
     */
    // protected $dates = ['deleted_at'];

    //Relation
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
