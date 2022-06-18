<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CountDownSMSNotification extends SMSNotification
{
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(private readonly int $days)
    {
        parent::__construct();
        $this->queue = 'countDown';
    }

    public function toSMS($notifiable): string
    {
        if (!$this->days) {
            $dressing = $notifiable->gender === 'female' ? ' And did you know hotness has never killed anybody? A word to the wise...' : '';
            return "Na todaaaaaaaay! Maps link and entry code will be flying in shortly, no matter what you choose to do today, just don't die wai?{$dressing}";
        }
        return "Yo fam! Its {$this->days} days more to the action. Looking forward to a wicked evening together. Party starts at 1900hrs, don't be late!";
    }
}
