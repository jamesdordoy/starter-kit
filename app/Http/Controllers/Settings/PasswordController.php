<?php

namespace App\Http\Controllers\Settings;

use App\Data\UserData;
use App\Http\Requests\Settings\ProfilePasswordUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Inertia\Response;

final class PasswordController
{
    public function edit(Request $request): Response
    {
        return Inertia::render('settings/Password', [
            UserData::DATA_NAME => UserData::from($request->user()),
        ]);
    }

    public function update(ProfilePasswordUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back();
    }
}
