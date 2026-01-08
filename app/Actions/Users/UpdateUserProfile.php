<?php

namespace App\Actions\Users;

use App\Models\User;
use App\Data\UserData;

class UpdateUserProfile
{
    public function __invoke(User $user, UserData $data): User
    {
        $user->fill($data->only('name', 'email')->toArray());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return $user;
    }
}
