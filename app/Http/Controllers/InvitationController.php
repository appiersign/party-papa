<?php

namespace App\Http\Controllers;

use App\Http\Actions\Invitation\ShowInvitationAction;
use App\Http\Actions\Invitation\UpdateInvitationAction;
use App\Http\Requests\InvitationRequest;
use App\Models\Invitation;
use Illuminate\Http\JsonResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class InvitationController extends Controller
{

    /**
     * Show An Invitation.
     *
     * @param Invitation $invitation
     * @param ShowInvitationAction $action
     * @return Response|ResponseFactory
     */
    public function show(Invitation $invitation, ShowInvitationAction $action): Response|ResponseFactory
    {
        return $action->handle($invitation);
    }

    /**
     * Update the Invitation.
     *
     * @param InvitationRequest $request
     * @param Invitation $invitation
     * @param UpdateInvitationAction $action
     * @return JsonResponse
     */
    public function update(InvitationRequest $request, Invitation $invitation, UpdateInvitationAction $action): JsonResponse
    {
        return $action->handle($request, $invitation);
    }
}
