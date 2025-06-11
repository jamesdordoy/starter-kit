<?php

namespace App\Http\Controllers\Settings;

use App\Data\PermissionData;
use App\Data\RoleData;
use App\Data\UserData;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\QueryBuilder\Data\QueryBuilderParams;
use App\QueryBuilder\Queries\UserQuery;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $users = (new UserQuery($request))
            ->paginate($request->input('per_page', 15))
            ->withQueryString()
            ->appends(request()->query());

        return Inertia::render('settings/users/Index', [
            UserData::COLLECTION_NAME => UserResource::collection($users),
            'params' => QueryBuilderParams::from(request()->query()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return Inertia::render('settings/users/Show', [
            UserData::DATA_NAME => UserData::from([
                ...$user->toArray(),
                'permissions' => $user->getAllPermissions()->toArray(),
                'roles' => $user->roles->toArray(),
            ]),
            PermissionData::COLLECTION_NAME => PermissionResource::collection(Permission::get()),
            RoleData::COLLECTION_NAME => Role::get(),
            QueryBuilderParams::PROPERTY_NAME => QueryBuilderParams::from(request()->query()),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
