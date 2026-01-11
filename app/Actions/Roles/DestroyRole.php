<?php

declare(strict_types=1);

namespace App\Actions\Roles;

use App\Models\Role;

final class DestroyRole
{
    public function __invoke(Role $role): bool
    {
        return $role->delete();
    }
}
