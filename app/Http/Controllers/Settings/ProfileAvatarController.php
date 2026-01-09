<?php

declare(strict_types=1);

namespace App\Http\Controllers\Settings;

use App\Actions\Users\UpdateUserAvatar;
use App\Http\Requests\Settings\ProfileAvatarUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

final class ProfileAvatarController
{
    public function update(ProfileAvatarUpdateRequest $request): RedirectResponse
    {
        app(UpdateUserAvatar::class)(
            user: Auth::user(),
            file: $request->file('avatar')
        );

        return back()->with('status', 'profile-updated');
    }
}
