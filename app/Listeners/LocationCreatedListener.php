<?php

namespace App\Listeners;

use App\Events\LocationCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LocationCreatedListener
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
     * @param  LocationCreated  $event
     * @return void
     */
    public function handle(LocationCreated $event)
    {
        //
    }
}
