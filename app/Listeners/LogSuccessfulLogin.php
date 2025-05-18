<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class LogSuccessfulLogin
{
    public function handle(Login $event)
    {
        activity()->causedBy($event->user->id)
            ->withProperties(['ip' => request()->ip()])
            ->log('User logged in');
    }
}
