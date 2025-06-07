<?php

namespace App\Providers;

use App\Listeners\LogImpersonation;
use App\Listeners\LogLeaveImpersonation;
use App\Listeners\LogMediaAdded;
use App\Listeners\LogSuccessfulLogin;
use App\Listeners\LogSuccessfulLogout;
use App\Listeners\LogSuccessfulRegistration;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\ServiceProvider;
use Lab404\Impersonate\Events\LeaveImpersonation;
use Lab404\Impersonate\Events\TakeImpersonation;
use Spatie\MediaLibrary\MediaCollections\Events\MediaHasBeenAddedEvent;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [
            LogSuccessfulLogin::class,
        ],
        Logout::class => [
            LogSuccessfulLogout::class,
        ],
        Registered::class => [
            LogSuccessfulRegistration::class,
        ],
        TakeImpersonation::class => [
            LogImpersonation::class,
        ],
        LeaveImpersonation::class => [
            LogLeaveImpersonation::class,
        ],
        MediaHasBeenAddedEvent::class => [
            LogMediaAdded::class,
        ],
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
