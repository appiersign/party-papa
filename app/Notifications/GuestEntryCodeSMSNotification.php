<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GuestEntryCodeSMSNotification extends SMSNotification
{
    public function toSMS($notifiable): string
    {
        return "{$notifiable->getFirstName()}, June 18th is finally here! This is the Google Maps link to the location as promised: https://goo.gl/maps/1XNv6bNXRVRP8oiS9\nYou'll be asked your phone number and your entry code: '{$notifiable->external_id}' at the gate. Arrival time is at 1900hrs, please don't be late.\nCheers!";
    }
}
