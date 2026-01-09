<?php

declare(strict_types=1);

namespace App\Http\Controllers\Settings;

use App\Actions\Users\UpdateUserRolesAndPermissions;
use App\Data\PermissionData;
use App\Data\RoleData;
use App\Data\UserData;
use App\Http\Requests\Settings\Users\UpdateRolesAndPermissionsRequest;
use App\Models\User;
use App\QueryBuilder\Data\QueryBuilderParams;
use App\QueryBuilder\Queries\UserQuery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

final class UserController
{
    public function index(Request $request): Response
    {
        $users = (new UserQuery($request))
            ->paginate($request->input('per_page', 15))
            ->withQueryString();

        return Inertia::render('settings/users/Index', [
            UserData::COLLECTION_NAME => UserData::collect($users),
            QueryBuilderParams::PROPERTY_NAME => QueryBuilderParams::from(),
        ]);
    }

    public function create(): void
    {
        //
    }

    public function store(Request $request): void
    {
        //
    }

    public function show(User $user): Response
    {
        return Inertia::render('settings/users/Show', [
            UserData::DATA_NAME => UserData::from([
                ...$user->toArray(),
                'permissions' => $user->getAllPermissions()->toArray(),
                'roles' => $user->roles->toArray(),
            ]),
            PermissionData::COLLECTION_NAME => PermissionData::collect(Permission::get()),
            RoleData::COLLECTION_NAME => RoleData::collect(Role::get()),
            QueryBuilderParams::PROPERTY_NAME => QueryBuilderParams::from(request()->query()),
        ]);
    }

    public function edit(string $id): void
    {
        //
    }

    public function update(UpdateRolesAndPermissionsRequest $request, User $user): RedirectResponse
    {
        $user = app(UpdateUserRolesAndPermissions::class)($user, $request->validated());

        return back()->with('success', 'User roles and permissions updated successfully.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return back();
    }
}
