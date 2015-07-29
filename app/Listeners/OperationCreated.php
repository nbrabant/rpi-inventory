<?php

namespace App\Listeners;

use App\Events\OperationSaving;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OperationCreated
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
     * @param  OperationSaving  $event
     * @return void
     */
    public function handle(OperationSaving $event)
    {
        //
    }
}
