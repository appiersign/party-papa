<?php

namespace App\Http\Actions\Invitation;

use App\Models\Invitation;
use Inertia\Response;
use Inertia\ResponseFactory;

class ShowInvitationAction
{
    public function handle(Invitation $invitation): Response|ResponseFactory
    {
        return inertia('Invitation/ShowInvitation', [
            'invitation' => $invitation->load('guest'),
            'allowConfirmation' => (Invitation::getConfirmed()->count() < (int)env('MAX_CONFIRMATIONS'))
        ]);
    }
}
