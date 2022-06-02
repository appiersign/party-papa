<?php

namespace App\Http\Actions\Invitation;

use App\Http\Requests\InvitationRequest;
use App\Models\Invitation;
use Exception;
use Illuminate\Http\JsonResponse;

class UpdateInvitationAction
{
    public function handle(InvitationRequest $request, Invitation $invitation): JsonResponse
    {
        try {
            $invitation->update([
                'responded_at' => now()->toDateTimeString(),
                ...$request->validated()
            ]);
            success('Invitation updated successfully.');
        } catch (Exception $e) {
            report($e);
            error('Failed to update invitation.');
            return response()->json(['message' => 'Failed to update invitation.'], 500);
        }

        return response()->json('', 204);
    }
}
