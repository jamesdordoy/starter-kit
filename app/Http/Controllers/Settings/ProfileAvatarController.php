<?php

namespace App\Http\Controllers\Settings;

use App\Http\Requests\Settings\ProfileAvatarUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileAvatarController
{
    public function update(ProfileAvatarUpdateRequest $request)
    {
        $user = User::find(Auth::id());

        $user->addMediaFromRequest('avatar')
            ->toMediaCollection('avatars');

        return back()->with('status', 'profile-updated');
    }
}
