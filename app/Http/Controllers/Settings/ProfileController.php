<?php

namespace App\Http\Controllers\Settings;

use App\Actions\Users\DestroyUser;
use App\Actions\Users\UpdateUserProfile;
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
    /**
     * Show the user's profile settings page.
     */
    public function edit(Request $request, User $profile): Response
    {
        return Inertia::render('settings/Profile', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail && empty($request->user()->email_verified_at),
            'status' => $request->session()->get('status'),
            UserData::DATA_NAME => UserData::from($profile),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, User $profile): RedirectResponse
    {
        app(UpdateUserProfile::class)(
            user: $profile,
            data: $request->validated()
        );

        return to_route('profile.edit', [
            'profile' => $profile,
        ])->with('status', __('Profile updated successfully.'));
    }

    /**
     * Delete the user's profile.
     */
    public function destroy(ProfileDeleteRequest $request, User $profile): RedirectResponse
    {
        Auth::logout();

        app(DestroyUser::class)(user: $profile);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
