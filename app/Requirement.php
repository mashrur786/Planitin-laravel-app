<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    // //
    protected $table = 'Requirements';

    protected $guarded = ['id'];

    public function restaurants(){

        return $this->belongsToMany('App\Restaurant', 'requirement_restaurant');

    }
}
