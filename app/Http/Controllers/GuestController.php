<?php

namespace App\Http\Controllers;

use App\Http\Actions\Guest\DeleteGuestAction;
use App\Http\Actions\Guest\GuestCheckInAction;
use App\Http\Actions\Guest\InviteGuestAction;
use App\Http\Actions\Guest\StoreOrUpdateGuestAction;
use App\Http\Requests\GuestRequest;
use App\Http\Resources\GuestResource;
use App\Models\Guest;
use App\Models\Invitation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|ResponseFactory
     */
    public function index(): Response|ResponseFactory
    {
        return inertia('Guest/Index', [
            'guests' => GuestResource::collection(
                Guest::query()
                    ->when($search = request('search'), function (Builder $query) use ($search) {
                        $query->where(function ($query) use ($search) {
                            $query->where('name', 'like', "%{$search}%")
                                ->orWhere('phone', 'like', "%{$search}%");
                        });
                    })
                    ->when($status = request('status'), function (Builder $query) use ($status) {
                        if ($status === 'arrived') {
                            return $query->whereNotNull('arrived_at');
                        }
                        return $query->whereIn('guests.id', Invitation::query()->where('status', $status)->pluck('guest_id')->toArray());
                    })
                    ->orderBy('name')
                    ->cursorPaginate(20)
                    ->appends(request()->query())
            ),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|ResponseFactory
     */
    public function create(): Response|ResponseFactory
    {
        return inertia('Guest/CreateOrEdit', [
            '_guest' => (object)[],
            '_guests' => Guest::query()->orderBy('name')->get(['id', 'name', 'phone']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GuestRequest $request
     * @param StoreOrUpdateGuestAction $action
     * @return RedirectResponse
     */
    public function store(GuestRequest $request, StoreOrUpdateGuestAction $action): RedirectResponse
    {
        return $action->handle($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Guest $guest
     * @return Response|ResponseFactory
     */
    public function edit(Guest $guest): Response|ResponseFactory
    {
        return inertia('Guest/CreateOrEdit', [
            'guest' => $guest,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GuestRequest $request
     * @param Guest $guest
     * @param StoreOrUpdateGuestAction $action
     * @return RedirectResponse
     */
    public function update(GuestRequest $request, Guest $guest, StoreOrUpdateGuestAction $action): RedirectResponse
    {
        return $action->handle($request, $guest);
    }

    public function invite(Guest $guest, InviteGuestAction $action): RedirectResponse
    {
        return $action->handle($guest);
    }

    public function showCheckInForm(): Response|ResponseFactory
    {
        return inertia('Guest/CheckIn', []);
    }

    public function checkIn(Request $request, GuestCheckInAction $action): JsonResponse
    {
        return $action->handle($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Guest $guest
     * @param DeleteGuestAction $action
     * @return RedirectResponse
     */
    public function destroy(Guest $guest, DeleteGuestAction $action): RedirectResponse
    {
        return $action->handle($guest);
    }
}
