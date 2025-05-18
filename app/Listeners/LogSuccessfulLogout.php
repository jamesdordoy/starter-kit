<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;

class LogSuccessfulLogout
{
    public function handle(Logout $event)
    {
        activity()->causedBy($event->user->id)
            ->withProperties(['ip' => request()->ip()])
            ->log('User logged out');
    }
} 