<?php

namespace App\Http\Controllers\Settings;

use App\Actions\Settings\UpdateSiteLogo;
use App\Http\Requests\Settings\Media\StoreRequest;
use App\Settings\SiteSettings;

final class LogoController
{
    public function __construct(
        private UpdateSiteLogo $updateSiteLogo
    ) {}

    public function update(StoreRequest $request, SiteSettings $settings)
    {
        app(UpdateSiteLogo::class)(
            file: $request->file('file'),
            settings: $settings
        );

        return back()->with('status', 'logo-updated');
    }
}
