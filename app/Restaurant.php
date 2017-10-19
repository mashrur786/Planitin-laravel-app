<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    //
    protected $table = 'restaurants';

    protected $guarded = ['id'];

    // Relationship
     public function requirements(){

        return $this->belongsToMany('App\Requirement', 'requirement_restaurant');

    }

    public function campaigns(){

        return $this->hasMany(Campaign::class);

    }

    public function users(){

        return $this->belongsToMany('App\User', 'restaurant_user')
            ->withPivot('created_At', 'updated_at', 'points');

    }

    public function partner(){

        return $this->hasOne('App\Partner');

    }



}
