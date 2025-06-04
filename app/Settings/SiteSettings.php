<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[
    TypeScript(),
]
class SiteSettings extends Settings
{
    public ?string $logo_media_id;

    public static function group(): string
    {
        return 'site';
    }
}
