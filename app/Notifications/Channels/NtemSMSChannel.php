<?php

namespace App\Notifications\Channels;

use App\Notifications\SMSNotification;
use Illuminate\Support\Facades\Http;

class NtemSMSChannel
{
    public function send($notifiable, SMSNotification $notification): void
    {
        $request = Http::withoutVerifying()
            ->get($url = "https://send.ntemsms.com/smsapi?key=958a45e6d4023c31fa17&to={$notifiable->phone}&msg={$notification->toSMS($notifiable)}&sender_id={$notifiable->side}");

        logger()->info('=== NTEM SMS REQUEST ===');
        logger()->info($url);

        sleep(2);

        logger()->info('=== NTEM SMS RESPONSE ===');
        logger()->info($request->json());
    }
}
