<?php

namespace App\Listeners;

use App\Events\SendCommand;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCommandListener implements ShouldQueue
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
     * @param  SendCommand  $event
     * @return void
     */
    public function handle(SendCommand $event)
    {
        //
    }
}
