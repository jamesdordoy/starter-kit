<?php

namespace App\Http\Controllers\Settings;

use App\Http\Requests\Settings\Media\StoreRequest;
use App\Models\Setting;
use App\Settings\SiteSettings;

final class LogoController
{
    public function update(StoreRequest $request, SiteSettings $settings)
    {
        $setting = Setting::where('name', 'logo_media_id')->first();

        $media = $setting->addMediaFromRequest('file')
            ->toMediaCollection('site_logo');

        $settings->logo_media_id = $media->id;
        $settings->save();

        return back()->with('status', 'logo-updated');
    }
}
