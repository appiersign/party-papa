<?php

namespace App\Notifications;

class PlusOneSMSNotification extends SMSNotification
{
    public function toSMS($notifiable): string
    {
        return <<<EOF
Yo {$notifiable->getFirstName()}! It's me {$notifiable->guest->getFirstName()}.
Kindly escort me to {$notifiable->side}'s birthday party at Lapas on Saturday June 18th.
The arrival time is 1900hrs. {$notifiable->getDressCode()}
Please tap the link below to confirm your availability.
{$notifiable->invitations()->latest()->first()->short_url}
EOF;
    }
}
