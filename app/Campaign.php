<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    //
    protected $table = 'campaigns';

    protected $guarded = ['id'];

    protected $dates = [
    'created_at',
    'updated_at',
    'expires'
];


    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
