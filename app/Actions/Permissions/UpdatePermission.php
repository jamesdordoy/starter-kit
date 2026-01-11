<?php

declare(strict_types=1);

namespace App\Actions\Permissions;

use App\Data\PermissionUpdateData;
use App\Models\Permission;
use App\Models\Route;

final class UpdatePermission
{
    public function __invoke(Permission $permission, PermissionUpdateData $data): Permission
    {
        $permission->update([
            'name' => $data->name,
            'guard_name' => $data->guardName ?? $permission->guard_name,
        ]);

        if ($data->routes !== null) {
            $privateRouteIds = Route::whereIn('id', $data->routes)
                ->where('is_public', false)
                ->pluck('id')
                ->toArray();

            $permission->routes()->sync($privateRouteIds);
        }

        return $permission->fresh('routes');
    }
}
