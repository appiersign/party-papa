<?php

namespace App\Listeners;

use App\Events\InvitationStatusUpdatedEvent;
use App\Notifications\GuestEntryCodeSMSNotification;
use App\Notifications\InvitationConfirmationNotification;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

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
            Notification::send(
                $event->invitation->guest,
                (new GuestEntryCodeSMSNotification)->delay(Carbon::parse('2022-06-18 12:00:00'))
            );
        }
    }
}
