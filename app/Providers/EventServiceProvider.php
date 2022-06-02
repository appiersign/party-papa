<?php

namespace App\Providers;

use App\Events\InvitationCreatedEvent;
use App\Listeners\InvitationCreatedListener;
use App\Models\Guest;
use App\Models\Invitation;
use App\Observers\GuestObserver;
use App\Observers\InvitationObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        InvitationCreatedEvent::class => [
            InvitationCreatedListener::class,
        ],
        'App\Events\GuestCreatedEvent' => [
            'App\Listeners\GuestCreatedListener',
        ],
        'App\Events\GuestArrivedEvent' => [
            'App\Listeners\GuestArrivedListener',
        ],
        'App\Events\InvitationStatusUpdatedEvent' => [
            'App\Listeners\InvitationStatusUpdatedListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot(): void
    {
        Guest::observe(GuestObserver::class);
        Invitation::observe(InvitationObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
