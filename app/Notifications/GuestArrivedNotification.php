<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;

class GuestArrivedNotification extends SMSNotification
{
    use Queueable;

    public function toSMS($notifiable): string
    {
        return "Welcome {$notifiable->getFirstName()}! We are glad to have you here. Please visit the serving stands for all you need. At this point, you're on your own, make sure you have fun. \nThank you!";
    }
}
