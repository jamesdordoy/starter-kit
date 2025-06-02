<?php

namespace App\Http\Controllers\Settings;

use App\Http\Requests\Settings\Media\StoreRequest;
use App\Models\Setting;

final class LogoController
{
    public function update(StoreRequest $request)
    {
        $setting = Setting::where('name', 'site_logo')->first();

        $setting->addMediaFromRequest('file')
            ->toMediaCollection('site_logo');

        return back()->with('status', 'logo-updated');
    }
}
