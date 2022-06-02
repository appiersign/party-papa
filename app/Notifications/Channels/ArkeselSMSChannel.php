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
        $sms->send($senderId, [$notifiable->phone], $notification->toSMS($notifiable));
    }
}
