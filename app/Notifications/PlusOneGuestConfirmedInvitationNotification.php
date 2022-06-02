<?php

namespace App\Notifications;

use App\Models\Guest;

class PlusOneGuestConfirmedInvitationNotification extends SMSNotification
{

    public function __construct(private readonly Guest $plusOne)
    {
        parent::__construct();
    }

    public function toSMS($notifiable): string
    {
        return "Hi! {$this->plusOne->getFirstName()} has confirmed your invitation.";
    }
}
