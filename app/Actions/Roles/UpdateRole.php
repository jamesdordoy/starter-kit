<?php

declare(strict_types=1);

namespace App\Actions\Roles;

use App\Data\RoleUpdateData;
use App\Models\Role;

final class UpdateRole
{
    public function __invoke(Role $role, RoleUpdateData $data): Role
    {
        $role->update([
            'name' => $data->name,
            'guard_name' => $data->guardName ?? $role->guard_name,
        ]);

        if ($data->permissions !== null) {
            $role->syncPermissions($data->permissions);
        }

        return $role->fresh('permissions');
    }
}
