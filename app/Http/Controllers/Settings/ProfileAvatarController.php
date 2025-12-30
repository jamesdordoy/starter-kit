<?php

namespace App\Http\Controllers\Settings;

use App\Actions\Users\UpdateUserAvatar;
use App\Http\Requests\Settings\ProfileAvatarUpdateRequest;
use Illuminate\Support\Facades\Auth;

class ProfileAvatarController
{
    public function update(ProfileAvatarUpdateRequest $request)
    {
        app(UpdateUserAvatar::class)(
            user: Auth::user(),
            file: $request->file('avatar')
        );

        return back()->with('status', 'profile-updated');
    }
}
