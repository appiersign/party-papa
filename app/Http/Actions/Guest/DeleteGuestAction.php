<?php

namespace App\Http\Actions\Guest;

use App\Http\Requests\GuestRequest;
use App\Models\Guest;
use Exception;
use Illuminate\Http\RedirectResponse;

class DeleteGuestAction
{
    public function handle(Guest $guest): RedirectResponse
    {
        try {
            $guest->delete();
            success('Guest deleted!');
        } catch (Exception $e) {
            report($e);
            error('Guest could not be saved, please try again later');
        }

        return back();
    }
}
