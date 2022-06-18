<?php

namespace App\Notifications\Channels;

use App\Notifications\SMSNotification;
use Illuminate\Support\Facades\Http;

class MnotifySMSChannel
{
    public function send($notifiable, SMSNotification $notification): void
    {
        $request = Http::post("https://api.mnotify.com/api/sms/quick?key=" . env('MNOTIFY_API_KEY'), $body = [
            'recipient' => [$notifiable->phone],
            'sender' => mb_strtoupper($notifiable->side),
            'message' => $notification->toSMS($notifiable)
        ]);

        logger()->info('=== MNOTIFY SMS REQUEST ===');
        logger()->info($body);

        sleep(2);

        logger()->info('=== MNOTIFY SMS RESPONSE ===');
        logger()->info($request->json());
    }
}
