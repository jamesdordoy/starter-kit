<?php

namespace App\Listeners;

use App\Enums\ActivityLogEnum;
use Illuminate\Auth\Events\Registered;

class LogSuccessfulRegistration
{
    public function handle(Registered $event)
    {
        activity()->causedBy($event->user->id)
            ->withProperties(['ip' => request()->ip()])
            ->log(ActivityLogEnum::REGISTER->value);
    }
}
