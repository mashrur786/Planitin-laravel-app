<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\PartnerResetPasswordNotification;

class Partner extends Authenticatable
{
    use Notifiable;

    protected  $guard = 'partner';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'restaurant_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PartnerResetPasswordNotification($token));
    }

    public function business(){

        return $this->belongsTo('App\Restaurant','restaurant_id', 'id');

    }

    public function campaigns(){

        return $this->hasManyThrough('App\Campaign','App\Restaurant');

    }


}
