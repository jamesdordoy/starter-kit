<?php

declare(strict_types=1);

namespace App\Actions\Users;

use App\Models\User;
use Illuminate\Http\UploadedFile;

final readonly class UpdateUserAvatar
{
    public function __invoke(User $user, UploadedFile $file): User
    {
        $user->addMedia($file->getRealPath())
            ->usingFileName($file->getClientOriginalName())
            ->toMediaCollection('avatars');

        return $user;
    }
}
