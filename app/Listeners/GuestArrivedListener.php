<?php

namespace App\Listeners;

use App\Events\GuestArrivedEvent;
use App\Notifications\GuestArrivedNotification;

class GuestArrivedListener
{

    /**
     * Handle the event.
     *
     * @param GuestArrivedEvent $event
     * @return void
     */
    public function handle(GuestArrivedEvent $event): void
    {
        $event->guest->notify(new GuestArrivedNotification);
    }
}
