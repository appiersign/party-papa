<?php

namespace App\Http\Actions\Guest;

use App\Http\Requests\GuestRequest;
use App\Models\Guest;
use Exception;
use Illuminate\Http\RedirectResponse;

class StoreOrUpdateGuestAction
{
    public function handle(GuestRequest $request, Guest $guest = new Guest): RedirectResponse
    {
        try {
            if ($guest->exists) {
                $guest->update($request->validated());
            } else {
                Guest::query()->create([
                    'name' => 'fetching...',
                    'network' => 'fetching...',
                    ...$request->validated()
                ]);
            }
            success('Guest saved successfully');
            return redirect()->route('guests.create');
        } catch (Exception $e) {
            report($e);
            error('Guest could not be saved, please try again later');
        }

        return back();
    }
}
