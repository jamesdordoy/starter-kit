<?php

declare(strict_types=1);

namespace App\Actions\Permissions;

use App\Data\PermissionStoreData;
use App\Models\Permission;
use App\Models\Route;

final class CreatePermission
{
    public function __invoke(PermissionStoreData $data): Permission
    {
        $permission = Permission::create([
            'name' => $data->name,
            'guard_name' => $data->guardName ?? 'web',
        ]);

        if ($data->routes) {
            $privateRouteIds = Route::whereIn('id', $data->routes)
                ->where('is_public', false)
                ->pluck('id')
                ->toArray();

            $permission->routes()->sync($privateRouteIds);
        }

        return $permission->load('routes');
    }
}
