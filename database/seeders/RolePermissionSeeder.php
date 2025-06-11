<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        collect(PermissionEnum::cases())
            ->each(fn ($permission) => Permission::firstOrCreate(['name' => $permission->value]));

        collect(RoleEnum::cases())->each(function ($roleEnum) {
            $role = Role::firstOrCreate(['name' => $roleEnum->value]);

            $permissions = $roleEnum === RoleEnum::ADMIN
                ? Permission::query()->get()
                : collect($roleEnum->getPermissions())->map(fn ($permissionEnum) => $permissionEnum->value);

            $role->syncPermissions($permissions);
        });
    }
}
