<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Enums\ActivityLogEnum;
use Illuminate\Auth\Events\Logout;

final class LogSuccessfulLogout
{
    public function handle(Logout $event): void
    {
        activity()->causedBy($event->user->id)
            ->withProperties(['ip' => request()->ip()])
            ->log(ActivityLogEnum::LOGOUT->value);
    }
}
