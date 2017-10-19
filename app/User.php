<?php

namespace App;

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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function isSubscribed($restaurant_id){

        if($this->restaurants()->whereIn('restaurant_id', $restaurant_id)->first())
            return true;

        return false;

    }

    public function hasCode($id){

        if($this->campaigns->contains($id))
            return true;

        return false;

    }

    public function restaurants(){

        return $this->belongsToMany('App\Restaurant', 'restaurant_user')
            ->withPivot('created_At', 'updated_at', 'points');

    }

    public function campaigns(){

        return $this->belongsToMany('App\Campaign', 'campaign_user', 'user_id', 'campaign_id')
            ->withPivot('code', 'redeem', 'created_At', 'updated_at');

    }

    /* Accessors */
    public function getNameAttributes($value){
        return ucwords($value);
    }




}
