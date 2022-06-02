<?php

namespace App\Listeners;

use App\Events\InvitationStatusUpdatedEvent;
use App\Notifications\InvitationConfirmationNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class InvitationStatusUpdatedListener
{

    /**
     * Handle the event.
     *
     * @param InvitationStatusUpdatedEvent $event
     * @return void
     */
    public function handle(InvitationStatusUpdatedEvent $event): void
    {
        if ($event->invitation->confirmed()) {
            $event->invitation->guest->notify(new InvitationConfirmationNotification);
            $event->invitation->guest->notifyMainGuest();
        }
    }
}
