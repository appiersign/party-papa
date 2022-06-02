<?php

namespace App\Models;

use App\Http\Services\PhoneNumberResolutionService;
use App\Notifications\PlusOneGuestConfirmedInvitationNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guest extends User
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at', 'arrived_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'gender',
        'side',
        'type',
        'guest_id',
        'arrived_at',
        'external_id',
        'phone',
        'network',
        'password',
    ];

    public function getRouteKeyName(): string
    {
        return 'external_id';
    }

    public function invitations(): HasMany
    {
        return $this->hasMany(Invitation::class);
    }

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    public function setNameAttribute(?string $value)
    {
        if ($value) {
            $this->attributes['name'] = khebabToWords($value);
        }
    }

    public function isPlusOne(): bool
    {
        return $this->guest_id <> null;
    }

    public function invite()
    {
        $this->invitations()->create([]);
    }

    public function arrive(): bool
    {
        return $this->update(['arrived_at' => now()->toDateTimeString()]);
    }

    public function arrived(): bool
    {
        return $this->arrived_at <> null;
    }

    public function notifyMainGuest()
    {
        if ($this->isPlusOne()) {
            $this->guest->notify(new PlusOneGuestConfirmedInvitationNotification($this));
        }
    }

    public function getFirstName(): string
    {
        return explode(' ', $this->name)[0];
    }

    public function resolveName()
    {
        $service = new PhoneNumberResolutionService($this->phone);
        if (($response = $service->resolve()) && $response['success']) {
            $this->update([
                'name' => $response['data']['accountName'],
                'network' => $response['data']['network'],
            ]);
        } else {
            $this->update([
                'name' => "friend",
                'network' => 'unknown',
            ]);
        }
    }

    public function getDressCode(): string
    {
        return $this->gender === 'female' ? 'No dress code. But looking hot and sexy will not kill you' : 'No dress code.';
    }
}
