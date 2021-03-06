<?php

namespace App\Models;

use App\Http\Services\BitlyService;
use App\Notifications\GuestSMSNotification;
use App\Notifications\PlusOneSMSNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Notification;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'guest_id',
        'status',
        'responded_at',
        'short_url'
    ];

    public function getRouteKeyName(): string
    {
        return 'external_id';
    }

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    public function confirm(): bool
    {
        return $this->update([
            'status' => 'confirmed',
            'responded_at' => now()
        ]);
    }

    public function confirmed(): bool
    {
        return $this->status === 'confirmed';
    }

    public function declined(): bool
    {
        return $this->status === 'declined';
    }

    public function decline(): bool
    {
        return $this->update([
            'status' => 'declined',
            'responded_at' => now()
        ]);
    }

    public function getShortUrl(): bool
    {
        if ($shortUrl = BitlyService::shorten(config('app.url') . '/invitations/' . $this->external_id)) {
            return $this->update([
                'short_url' => $shortUrl
            ]);
        }

        return false;
    }

    public function send()
    {
        $guest = $this->guest;

        if ($guest->isPlusOne()) {
            Notification::send([$guest], new PlusOneSMSNotification);
            return;
        }

        Notification::send([$guest], new GuestSMSNotification);
    }

    public static function getConfirmed(): Builder
    {
        return Invitation::query()->where('status', 'confirmed');
    }
}
