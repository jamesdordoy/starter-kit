<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Enums\ActivityLogEnum;
use Illuminate\Auth\Events\Login;

final class LogSuccessfulLogin
{
    public function handle(Login $event): void
    {
        activity()->causedBy($event->user->id)
            ->withProperties(['ip' => request()->ip()])
            ->log(ActivityLogEnum::LOGIN->value);
    }
}
