<?php

namespace App\Http\Controllers\Settings;

use App\Actions\Users\DestroyUser;
use App\Actions\Users\UpdateUserProfile;
use App\Data\Pages\Settings\Profile\EditProfilePageData;
use App\Data\UserData;
use App\Http\Requests\Settings\ProfileDeleteRequest;
use App\Http\Requests\Settings\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

final class ProfileController
{
    public function edit(Request $request, User $profile): Response
    {
        return Inertia::render('settings/Profile', [
            EditProfilePageData::DATA_NAME => EditProfilePageData::from([
                'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail && empty($request->user()->email_verified_at),
                'status' => $request->session()->get('status'),
                UserData::DATA_NAME => UserData::from($profile),
            ]),
        ]);
    }

    public function update(ProfileUpdateRequest $request, User $profile): RedirectResponse
    {
        app(UpdateUserProfile::class)(
            user: $profile,
            data: UserData::from($request->validated())
        );

        return to_route('profile.edit', [
            'profile' => $profile,
        ])->with('status', __('Profile updated successfully.'));
    }

    public function destroy(ProfileDeleteRequest $request, User $profile): RedirectResponse
    {
        Auth::logout();

        app(DestroyUser::class)(user: $profile);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
