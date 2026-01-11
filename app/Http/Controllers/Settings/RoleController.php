<?php

declare(strict_types=1);

namespace App\Http\Controllers\Settings;

use App\Actions\Roles\CreateRole;
use App\Actions\Roles\DestroyRole;
use App\Actions\Roles\UpdateRole;
use App\Data\PermissionData;
use App\Data\RoleData;
use App\Http\Requests\Settings\Roles\StoreRoleRequest;
use App\Http\Requests\Settings\Roles\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\QueryBuilder\Data\QueryBuilderParams;
use App\QueryBuilder\Queries\RoleQuery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

final class RoleController
{
    public function index(Request $request): Response
    {
        $roles = (new RoleQuery($request))
            ->paginate($request->input('per_page', 15))
            ->withQueryString();

        return Inertia::render('settings/roles/Index', [
            RoleData::COLLECTION_NAME => RoleData::collect($roles),
            QueryBuilderParams::PROPERTY_NAME => QueryBuilderParams::from(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('settings/roles/Create', [
            PermissionData::COLLECTION_NAME => PermissionData::collect(Permission::get()),
        ]);
    }

    public function store(StoreRoleRequest $request): RedirectResponse
    {
        app(CreateRole::class)($request->toDto());

        return redirect()->route('settings.roles.index')->with('success', 'Role created successfully.');
    }

    public function show(Role $role): Response
    {
        $role->load('permissions');

        return Inertia::render('settings/roles/Show', [
            RoleData::DATA_NAME => RoleData::from([
                ...$role->toArray(),
                'permissions' => $role->permissions,
            ]),
            PermissionData::COLLECTION_NAME => PermissionData::collect(Permission::get()),
        ]);
    }

    public function edit(Role $role): Response
    {
        return $this->show($role);
    }

    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        app(UpdateRole::class)($role, $request->toDto());

        return redirect()->route('settings.roles.show', $role)->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        app(DestroyRole::class)($role);

        return redirect()->route('settings.roles.index')->with('success', 'Role deleted successfully.');
    }
}
