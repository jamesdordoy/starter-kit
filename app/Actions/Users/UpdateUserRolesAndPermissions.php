<?php

namespace App\Actions\Users;

use App\Models\User;
use Illuminate\Support\Collection;

class UpdateUserRolesAndPermissions
{
    public function __invoke(User $user, array $data): User
    {
        // Update roles if provided
        if (isset($data['roles'])) {
            $roleNames = collect($data['roles'])->pluck('name')->toArray();
            $user->syncRoles($roleNames);
        }

        // Update permissions if provided
        if (isset($data['permissions'])) {
            $permissionNames = collect($data['permissions'])
                ->filter(fn($value) => $value === true)
                ->keys()
                ->toArray();
            
            $user->syncPermissions($permissionNames);
        }

        return $user->fresh(['roles', 'permissions']);
    }
} 