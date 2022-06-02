<?php

namespace App\Observers;

use App\Events\GuestArrivedEvent;
use App\Events\GuestCreatedEvent;
use App\Models\Guest;

class GuestObserver
{
    public function creating(Guest $guest): void
    {
        $guest->external_id = random_int(100000, 999999);
    }
    /**
     * Handle the Guest "created" event.
     *
     * @param Guest $guest
     * @return void
     */
    public function created(Guest $guest): void
    {
        event(new GuestCreatedEvent($guest));
    }

    /**
     * Handle the Guest "updated" event.
     *
     * @param Guest $guest
     * @return void
     */
    public function updated(Guest $guest): void
    {
        if ($guest->isDirty('name')) {
            $guest->refresh();
            $guest->invitations()->create(['external_id' => uniqid()]);
        }

        if ($guest->isDirty('arrived_at')) {
            event(new GuestArrivedEvent($guest));
        }
    }

    /**
     * Handle the Guest "deleted" event.
     *
     * @param Guest $guest
     * @return void
     */
    public function deleting(Guest $guest): void
    {
        $guest->invitations()->delete();
    }

    /**
     * Handle the Guest "restored" event.
     *
     * @param Guest $guest
     * @return void
     */
    public function restored(Guest $guest)
    {
        //
    }

    /**
     * Handle the Guest "force deleted" event.
     *
     * @param Guest $guest
     * @return void
     */
    public function forceDeleted(Guest $guest)
    {
        //
    }
}
