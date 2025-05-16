<?php

namespace App\Actions\Users;

use App\Models\User;

class DestroyUser
{
    public function __invoke(User $user): User
    {
        $user->delete();

        return $user;
    }
}
