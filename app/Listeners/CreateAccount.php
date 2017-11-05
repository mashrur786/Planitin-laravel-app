<?php

namespace App\Listeners;

use App\Events\NewRestaurant;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use App\Mail\BusinessAccountCreated;
use App\Partner;
use Illuminate\Support\Facades\Hash;



class CreateAccount
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewRestaurant  $event
     * @return void
     */
    public function handle(NewRestaurant $event)
    {

        $partner = new Partner;
        $partner->email = $event->restaurant->email;
        $partner->restaurant_id = $event->restaurant->id;
        $password = str_random(8);
        $partner->password = Hash::make($password);

        $partner->save();

        //Email password to new partner;
        Mail::to($event->restaurant->email)->send(new BusinessAccountCreated($event->restaurant, $password));


    }
}
