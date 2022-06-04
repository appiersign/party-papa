<?php

namespace App\Http\Actions\Guest;

use App\Http\Requests\GuestRequest;
use App\Models\Guest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GuestCheckInAction
{
    public function handle(Request $request): JsonResponse
    {
        try {
            $guest = Guest::query()
                ->where('external_id', $request->input('entryCode'))
                ->where('phone', '=', $request->input('phone'))
                ->first();

            if ($guest && $guest->arrived()) {
                $guest->arrive();
                return response()->json(['message' => "{$guest->name} has checked in already!"], 400);
            }

            if ($guest) {
                $guest->arrive();
                return response()->json(['message' => $guest]);
            }
        } catch (Exception $e) {
            report($e);
        }

        return response()->json(['message' => 'Guest could not be found'], 404);
    }
}
