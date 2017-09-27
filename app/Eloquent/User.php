<?php

namespace App\Eloquent;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name', 
        'email',
        'sex',
        'birthday',
        'img_path',
        'introduction',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 
     * Cancel auto_increment
     *
    **/
    // public $incrementing = false;


    public function purposes()
    {
        return $this->hasMany(Purpose::class);
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }    
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    public function idols()
    {
        return $this->hasMany(Idol::class);
    } 
    public function regions()
    {
        return $this->hasMany(Region::class);
    } 
    public function statues()
    {
        return $this->hasMany(Statue::class);
    }          
    public function recommends()
    {
        return $this->hasMany(Recommend::class);
    }
    public function matchings()
    {
        return $this->hasMany(Matching::class,'from_user_id');
    }
    public function accounts()
    {
        return $this->hasMany(LinkedSocialAccount::class);
    }
    public function rooms()
    {
        return $this->hasMany(Room::class,'from_user_id');
    }
    public function roomsTo()
    {
        return $this->hasMany(Room::class,'to_user_id');
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
    public function access_to_rooms()
    {
        return $this->hasMany(AccessToRoom::class);
    }

}
