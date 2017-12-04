<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ghanem\Rating\Traits\Ratingable as Ratingable;

class Restaurant extends Model
{

    use Ratingable;
    protected $table = 'restaurants';

    protected $guarded = ['id'];



    public function isRated(){
        return $state = ($this->sumRating() > 0) ? true : false;
    }

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

    /*  Mutator */
     public function getBusinessNameAttribute($value){
        return ucwords($value);
    }

    public function getInCodeAttribute($value){
        return strtoupper($value);
    }

    public function getOutCodeAttribute($value){
        return strtoupper($value);
    }


}
