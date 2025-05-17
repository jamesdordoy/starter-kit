<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        foreach (PermissionEnum::cases() as $permission) {
            Permission::firstOrCreate(['name' => $permission->value]);
        }

        foreach (RoleEnum::cases() as $roleEnum) {
            $role = Role::firstOrCreate(['name' => $roleEnum->value]);

            if ($roleEnum === RoleEnum::ADMIN) {
                $role->syncPermissions(Permission::query()->get());
            } else {
                $permissions = array_map(
                    fn ($permissionEnum) => $permissionEnum->value,
                    $roleEnum->getPermissions()
                );

                $role->syncPermissions($permissions);
            }
        }
    }
}
