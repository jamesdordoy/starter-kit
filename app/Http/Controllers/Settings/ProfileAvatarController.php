<?php

namespace App\Http\Controllers\Settings;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileAvatarController
{
    public function update(Request $request)
    {
        // dd('hit');
        // $request->validate([
        //     'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        // $user = Auth::user();

        // $user->addMediaFromRequest('avatar')
        //     ->toMediaCollection('avatars');

        // return back()->with('status', 'profile-updated');
    }
}
