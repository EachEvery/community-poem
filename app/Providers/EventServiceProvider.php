<?php

namespace CommunityPoem\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use CommunityPoem\Events\ResponseSaved;
use CommunityPoem\Listeners\SendToModeration;
use CommunityPoem\Events\ResponseApproved;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ResponseSaved::class => [
            SendToModeration::class,
        ],
        ResponseApproved::class => [
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot()
    {
        parent::boot();
    }
}
