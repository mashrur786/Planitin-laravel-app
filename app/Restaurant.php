<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    //
    protected $table = 'restaurants';

    protected $fillable = [

        'email',
        'business_name',
        'description',
        'cuisine',
        'type',
        'business_phone1',
        'business_phone2',
        'address',
        'street',
        'area',
        'town',
        'county',
        'postcode',
        'website',
        'contact_name',
        'contact_phone'
    ];

}
