<?php

declare(strict_types=1);

namespace App\Actions\Roles;

use App\Data\RoleStoreData;
use App\Models\Role;

final class CreateRole
{
    public function __invoke(RoleStoreData $data): Role
    {
        $role = Role::create([
            'name' => $data->name,
            'guard_name' => $data->guardName ?? 'web',
        ]);

        if ($data->permissions) {
            $role->syncPermissions($data->permissions);
        }

        return $role->load('permissions');
    }
}
