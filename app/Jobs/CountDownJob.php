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

        $guests->each(fn(Guest $guest) => $guest->notify(new CountDownSMSNotification($days)));
    }
}
