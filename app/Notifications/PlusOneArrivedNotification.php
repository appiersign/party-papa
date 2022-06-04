<?php

namespace App\Notifications;

use App\Models\Guest;
use Illuminate\Bus\Queueable;

class PlusOneArrivedNotification extends SMSNotification
{
    use Queueable;

    public function __construct(private readonly Guest $guest)
    {
        parent::__construct();
    }

    public function toSMS($notifiable): string
    {
        return "{$notifiable->getFirstName()}, {$this->guest->getFirstName()} has arrived!";
    }
}
