<?php

namespace App\Jobs;

use App\Models\Guest;
use App\Models\Invitation;
use App\Notifications\CountDownSMSNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;

class CountDownJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $partyDay = Carbon::parse('2022-06-19');
        $days = $partyDay->diffInDays(now());
        $guests = Guest::query()
            ->whereIn('id', Invitation::query()
                ->where('status', '=', 'confirmed')
                ->pluck('guest_id')
                ->toArray())
            ->get();

        $delay = 0;

        $guests->each(function (Guest $guest) use ($days, $delay) {
            $delay += 10;
            sleep(1);
            $guest->notify((new CountDownSMSNotification($days))->delay(now()->addSeconds($delay)));
        });
    }
}
