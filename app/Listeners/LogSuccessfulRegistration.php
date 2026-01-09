<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Enums\ActivityLogEnum;
use Illuminate\Auth\Events\Registered;

final class LogSuccessfulRegistration
{
    public function handle(Registered $event): void
    {
        activity()->causedBy($event->user->id)
            ->withProperties([
                'id' => $event->user->getAuthIdentifier(),
                'email' => $event->user->email ?? null,
                'name' => $event->user->name ?? null,
                'ip' => request()->ip(),
            ])

            ->log(ActivityLogEnum::REGISTER->value);
    }
}
