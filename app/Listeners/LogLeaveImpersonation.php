<?php

namespace App\Listeners;

use App\Enums\ActivityLogEnum;
use Illuminate\Auth\Events\Login;
use Lab404\Impersonate\Events\LeaveImpersonation;

class LogLeaveImpersonation
{
    public function handle(LeaveImpersonation $event)
    {
        activity()->causedBy($event->impersonated->id)
            ->withProperties(['ip' => request()->ip()])
            ->log(ActivityLogEnum::LEAVE_IMPERSONATE->value);
    }
}
