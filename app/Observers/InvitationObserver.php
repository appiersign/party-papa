<?php

namespace App\Observers;

use App\Events\InvitationCreatedEvent;
use App\Events\InvitationStatusUpdatedEvent;
use App\Models\Invitation;

class InvitationObserver
{
    public function creating(Invitation $invitation): void
    {
        $invitation->guest->invitations()->delete();
        $invitation->external_id = uniqid();
    }

    public function created(Invitation $invitation): void
    {
        event(new InvitationCreatedEvent($invitation));
    }

    public function updated(Invitation $invitation): void
    {
        if ($invitation->isDirty('status')) {
            event(new InvitationStatusUpdatedEvent($invitation));
        }
    }
}
