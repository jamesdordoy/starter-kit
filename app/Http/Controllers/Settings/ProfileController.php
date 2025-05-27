<?php

namespace App\Http\Controllers\Settings;

use App\Actions\Users\DestroyUser;
use App\Data\UserData;
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
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => $request->session()->get('status'),
            UserData::DATA_NAME => UserData::from($profile),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, User $profile): RedirectResponse
    {
        $profile->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $profile->email_verified_at = null;
        }

        $profile->save();

        return to_route('profile.edit', [
            'profile' => $profile,
        ])->with('status', __('Profile updated successfully.'));
    }

    /**
     * Delete the user's profile.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        Auth::logout();

        app(DestroyUser::class)(user: $request->user());

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
