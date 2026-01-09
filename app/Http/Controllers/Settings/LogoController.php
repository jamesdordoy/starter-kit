<?php

declare(strict_types=1);

namespace App\Http\Controllers\Settings;

use App\Actions\Settings\UpdateSiteLogo;
use App\Http\Requests\Settings\Media\StoreRequest;
use App\Settings\SiteSettings;
use Illuminate\Http\RedirectResponse;

final class LogoController
{
    public function update(StoreRequest $request, SiteSettings $settings): RedirectResponse
    {
        app(UpdateSiteLogo::class)(
            file: $request->file('file'),
            settings: $settings
        );

        return back()->with('status', 'logo-updated');
    }
}
