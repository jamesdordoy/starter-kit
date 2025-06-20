<?php

namespace App\Listeners;

use App\Enums\ActivityLogEnum;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Events\MediaHasBeenAddedEvent;

class LogMediaAdded
{
    public function handle(MediaHasBeenAddedEvent $event)
    {
        $media = $event->media;
        $path = $media->getPath();

        if ($media->model_type == User::class) {
            activity()
                ->causedBy(Auth::id())
                ->withProperties(['path' => $path])
                ->log(ActivityLogEnum::MEDIA_ADDED->value);
        } else {
            activity()
                ->withProperties(['path' => $path])
                ->log(ActivityLogEnum::MEDIA_ADDED->value);
        }

    }
}
