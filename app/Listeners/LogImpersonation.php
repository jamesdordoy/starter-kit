<?php

namespace App\Listeners;

use App\Enums\ActivityLogEnum;
use Lab404\Impersonate\Events\TakeImpersonation;

class LogImpersonation
{
    public function handle(TakeImpersonation $event)
    {
        activity()->causedBy($event->impersonator->id)
            ->withProperties(['ip' => request()->ip()])
            ->log(ActivityLogEnum::IMPERSONATE->value);
    }
}
