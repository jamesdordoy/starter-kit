<?php

namespace App\Http\Controllers\Settings;

use App\Http\Requests\Settings\ProfileAvatarUpdateRequest;
use Illuminate\Support\Facades\Auth;

class ProfileAvatarController
{
    public function update(ProfileAvatarUpdateRequest $request)
    {
        $user = Auth::user();

        $user->addMediaFromRequest('avatar')
            ->toMediaCollection('avatars');

        return back()->with('status', 'profile-updated');
    }
}
