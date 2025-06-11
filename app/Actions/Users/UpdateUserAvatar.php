<?php

namespace App\Actions\Users;

use App\Models\User;
use Illuminate\Http\UploadedFile;

readonly class UpdateUserAvatar
{
    public function __invoke(User $user, UploadedFile $file): User
    {
        $user->addMediaFromRequest('avatar')
            ->toMediaCollection('avatars');

        return $user;
    }
} 