<?php

namespace App\Actions\Settings;

use App\Models\Setting;
use App\Settings\SiteSettings;
use Illuminate\Http\UploadedFile;

readonly class UpdateSiteLogo
{
    public function __invoke(UploadedFile $file, SiteSettings $settings): void
    {
        $setting = Setting::where('name', 'logo_media_id')->first();

        $media = $setting->addMedia($file->getRealPath())
            ->usingFileName($file->getClientOriginalName())
            ->toMediaCollection('site_logo');

        $settings->logo_media_id = $media->id;
        $settings->save();
    }
}
