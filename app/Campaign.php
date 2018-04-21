<?php

namespace App;

use Carbon\Carbon;
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
    /* Scope */
    public function scopeExpired($query)
    {
        $query->where('expires', '<=', Carbon::now());
    }

    public function scopeActive($query)
    {
        $query->where('expires', '>=', Carbon::now());
    }

    /* Relationship */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function users(){

        return $this->belongsToMany('App\User', 'campaign_user', 'campaign_id', 'user_id')
            ->withPivot('code', 'redeem', 'created_At', 'updated_at');

    }

    // this is a recommended way to declare event handlers
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::deleting(function($campaign)
        {

            foreach ($campaign->users as $user) {
                $user->detach();
                }
               // dd('test');
               // $model->users()->detach();
        });
    }
}
