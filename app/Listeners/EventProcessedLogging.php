<?php

namespace App\Listeners;

use App\Events\EventProcessed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class EventProcessedLogging
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EventProcessed $event): void
    {
        Log::info('EventProcessedLogging Listener is called.');
    }
}
