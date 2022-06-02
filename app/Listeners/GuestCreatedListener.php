<?php

namespace App\Listeners;

use App\Events\GuestCreatedEvent;
use App\Jobs\ResolveGuestNameJob;

class GuestCreatedListener
{
    /**
     * Handle the event.
     *
     * @param GuestCreatedEvent $event
     * @return void
     */
    public function handle(GuestCreatedEvent $event): void
    {
        ResolveGuestNameJob::dispatch($event->guest)->delay(now()->addSeconds(20));
    }
}
