<?php

namespace App\Http\Controllers;

use App\Http\Resources\GuestResource;
use App\Models\Guest;
use App\Models\Invitation;
use Inertia\Response;
use Inertia\ResponseFactory;

class Dashboard extends Controller
{
    public function __invoke(): Response|ResponseFactory
    {
        return inertia('Dashboard', [
            'totalGuests' => Guest::query()->count(),
            'totalDeclinedGuests' => Invitation::query()->where('status', '=', 'declined')->count(),
            'totalConfirmedGuests' => Invitation::query()->where('status', '=', 'confirmed')->count(),
            'totalArrivedGuests' => Guest::query()->where('arrived_at', '!=', null)->count(),
            'guests' => GuestResource::collection(
                Guest::query()->latest('arrived_at')->latest()->take(10)->get()
            ),
        ]);
    }
}
