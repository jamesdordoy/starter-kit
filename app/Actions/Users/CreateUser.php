<?php

namespace App\Actions\Users;

use App\Data\UserData;
use App\Models\User;

class CreateUser
{
    public function __invoke(UserData $data): User
    {
        $user = User::create($data->toArray());

        return $user;
    }
}
