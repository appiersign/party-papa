<?php

namespace App\Notifications;

class GuestSMSNotification extends SMSNotification
{
    public function toSMS($notifiable): string
    {
        return <<<EOF
Yo {$notifiable->getFirstName()}! It's me {$notifiable->side} and I humbly invite you to join me on the 18th of June for my birthday party at Lapas.
The arrival time is at 1900hrs. {$notifiable->getDressCode()}
You'll receive another SMS with a Google Maps link to the party location later.
If you have "plus ones", please DM me their contacts on whatsapp.
For now, kindly tap on the link below to confirm your availability.
{$notifiable->invitations()->latest()->first()->short_url}
EOF;
    }
}
