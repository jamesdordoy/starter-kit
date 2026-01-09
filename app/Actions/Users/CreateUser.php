<?php

declare(strict_types=1);

namespace App\Actions\Users;

use App\Data\UserData;
use App\Models\User;

final class CreateUser
{
    public function __invoke(UserData $data): User
    {
        $user = User::create($data->toArray());

        return $user;
    }
}
