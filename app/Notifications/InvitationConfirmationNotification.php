<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvitationConfirmationNotification extends SMSNotification
{
    use Queueable;

    public function toSMS($notifiable): string
    {
        return "{$notifiable->getFirstName()}, your seat has been reserved. Watch out for an SMS with the Google maps link and your entry code on June 18th.\nEnjoy!";
    }
}
