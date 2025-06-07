<?php

namespace App\Listeners;

use App\Enums\ActivityLogEnum;
use Illuminate\Database\Eloquent\Model;
use Lab404\Impersonate\Events\TakeImpersonation;

class LogImpersonation
{
    public function handle(TakeImpersonation $event)
    {
        /** @var Model $model */
        $model = $event->impersonator;

        activity()->performedOn($model)
            ->causedBy($event->impersonated->id)
            ->withProperties(['ip' => request()->ip()])
            ->log(ActivityLogEnum::IMPERSONATE->value);
    }
}
