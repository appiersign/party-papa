<?php

namespace App\Notifications;

use App\Notifications\Channels\ArkeselSMSChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class SMSNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return [ArkeselSMSChannel::class];
    }

    public function toSMS($notifiable): string
    {
        return 'SMS message';
    }
}
