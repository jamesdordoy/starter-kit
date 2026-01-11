<?php

declare(strict_types=1);

namespace App\Actions\Permissions;

use App\Models\Permission;

final class DestroyPermission
{
    public function __invoke(Permission $permission): bool
    {
        return $permission->delete();
    }
}
