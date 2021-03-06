<?php

namespace App\Notifications\Channels;

use App\Notifications\SMSNotification;
use Appiersign\ArkeselSms\ArkeselSms;

class ArkeselSMSChannel
{
    public function send($notifiable, SMSNotification $notification): void
    {
        $sms = new ArkeselSms(env('ARKESE_SMS_API_KEY'));
        $senderId = strtolower($notifiable->side) === 'appier-sign' ? 'APPIERSIGN' : 'NIIPRO';

        logger()->info('--- SENDING SMS MESSAGE ---');
        logger()->info(['sender' => $senderId, 'message' => $message = $notification->toSMS($notifiable)]);

        sleep(2);

        $response = $sms->send($senderId, [$notifiable->phone], $message);

        logger()->info('--- RECEIVING SMS MESSAGE RESPONSE ---');
        logger()->info(get_object_vars($response));
    }
}
