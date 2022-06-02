<?php

namespace App\Listeners;

use App\Events\InvitationCreatedEvent;
use App\Notifications\GuestSMSNotification;
use App\Notifications\PlusOneSMSNotification;

class InvitationCreatedListener
{

    /**
     * Handle the event.
     *
     * @param InvitationCreatedEvent $event
     * @return void
     */
    public function handle(InvitationCreatedEvent $event): void
    {
        $success = $event->invitation->getShortUrl();

        if ($success && $event->invitation->guest->isPlusOne()) {
            $event->invitation->guest->notify(new PlusOneSMSNotification);
            return;
        }

        if ($success) {
            $event->invitation->guest->notify(new GuestSMSNotification);
        }
    }
}
