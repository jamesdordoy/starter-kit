<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SiteSettings extends Settings
{
    public ?string $logo_media_id;

    public static function group(): string
    {
        return 'site';
    }
}