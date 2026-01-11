<?php

declare(strict_types=1);

namespace App\Http\Controllers\Settings;

use App\Actions\Permissions\CreatePermission;
use App\Actions\Permissions\DestroyPermission;
use App\Actions\Permissions\UpdatePermission;
use App\Data\PermissionData;
use App\Data\RouteData;
use App\Http\Requests\Settings\Permissions\StorePermissionRequest;
use App\Http\Requests\Settings\Permissions\UpdatePermissionRequest;
use App\Models\Permission;
use App\Models\Route;
use App\QueryBuilder\Data\QueryBuilderParams;
use App\QueryBuilder\Queries\PermissionQuery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

final class PermissionController
{
    public function index(Request $request): Response
    {
        $permissions = (new PermissionQuery($request))
            ->withCount(['routes' => fn ($query) => $query->where('is_public', false)])
            ->paginate($request->input('per_page', 15))
            ->withQueryString();

        return Inertia::render('settings/permissions/Index', [
            PermissionData::COLLECTION_NAME => PermissionData::collect($permissions),
            QueryBuilderParams::PROPERTY_NAME => QueryBuilderParams::from(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('settings/permissions/Create', [
            RouteData::COLLECTION_NAME => RouteData::collect(Route::where('is_public', false)->get()),
        ]);
    }

    public function store(StorePermissionRequest $request): RedirectResponse
    {
        app(CreatePermission::class)($request->toDto());

        return redirect()->route('settings.permissions.index')->with('success', 'Permission created successfully.');
    }

    public function show(Permission $permission): Response
    {
        $permission->load('routes');
        $permissionRoutes = $permission->routes()->where('is_public', false)->get();

        return Inertia::render('settings/permissions/Show', [
            PermissionData::DATA_NAME => PermissionData::from([
                ...$permission->toArray(),
                'routes' => $permissionRoutes->toArray(),
            ]),
            RouteData::COLLECTION_NAME => RouteData::collect(Route::where('is_public', false)->get()),
        ]);
    }

    public function edit(Permission $permission): Response
    {
        return $this->show($permission);
    }

    public function update(UpdatePermissionRequest $request, Permission $permission): RedirectResponse
    {
        app(UpdatePermission::class)($permission, $request->toDto());

        return redirect()->route('settings.permissions.show', $permission)->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        app(DestroyPermission::class)($permission);

        return redirect()->route('settings.permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
