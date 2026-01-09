<?php

declare(strict_types=1);

namespace App\Actions\Users;

use App\Models\User;

final class DestroyUser
{
    public function __invoke(User $user): User
    {
        $user->delete();

        return $user;
    }
}
