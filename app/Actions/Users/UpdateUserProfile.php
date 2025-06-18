<?php

namespace App\Actions\Users;

use App\Models\User;

class UpdateUserProfile
{
    public function __invoke(User $user, array $data): User
    {
        $user->fill($data);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return $user;
    }
}
