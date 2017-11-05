<?php

namespace App\Listeners;

use App\Events\NewCampaignCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class NotifySubscribedUsers
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
     * @param  NewCampaignCreated  $event
     * @return void
     */
    public function handle(NewCampaignCreated $event)
    {
        //
        $users = $event->campaign->restaurant->users;

        if(!empty($users)){
            foreach($users as $user){
                $user->notify(new \App\Notifications\NewCampaignCreated($event->campaign));
            }
        }
    }
}
