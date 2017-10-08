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

    public function users(){

        return $this->belongsToMany('App\User', 'campaign_user', 'user_id', 'campaign_id')
            ->withPivot('code', 'redeem', 'created_At', 'updated_at');;

    }
}
