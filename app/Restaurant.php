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

}
