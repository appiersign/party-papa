<?php

namespace App\Jobs;

use App\Models\Guest;
use App\Models\Invitation;
use App\Notifications\CountDownSMSNotification;
use Illuminate\Bus\Queueable;
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
        Guest::query()->whereIn('id', Invitation::query()
            ->where('status', '=', 'confirmed')
            ->pluck('guest_id')
            ->toArray())
            ->get()
            ->tap(
                fn(array $guests) => Notification::send(
                    $guests,
                    new CountDownSMSNotification(Carbon::parse('2022-06-19')->diffInDays(now()))
                )
            );
    }
}
