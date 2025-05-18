<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;

class LogSuccessfulRegistration
{
    public function handle(Registered $event)
    {
        activity()->causedBy($event->user->id)
            ->withProperties(['ip' => request()->ip()])
            ->log('User registered', ['placeholder' =>  $event->user->name]);
    }
} 