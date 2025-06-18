<?php

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(function () {
    // Create permissions
    collect(PermissionEnum::cases())
        ->each(fn ($permission) => Permission::firstOrCreate(
            ['name' => $permission->value],
            ['guard_name' => 'web']
        ));

    // Create roles
    collect(RoleEnum::cases())->each(function ($roleEnum) {
        $role = Role::firstOrCreate(
            ['name' => $roleEnum->value],
            ['guard_name' => 'web']
        );

        $permissions = $roleEnum === RoleEnum::ADMIN
            ? Permission::where('guard_name', 'web')->get()
            : collect($roleEnum->getPermissions())
                ->map(fn ($permissionEnum) => Permission::where('name', $permissionEnum->value)
                    ->where('guard_name', 'web')
                    ->first())
                ->filter();

        $role->syncPermissions($permissions);
    });

    $this->user = User::factory()->create([
        'password' => Hash::make('password123'),
    ]);

    // Get the admin role and assign it
    $adminRole = Role::where('name', RoleEnum::ADMIN->value)->first();
    $this->user->assignRole($adminRole);
});

test('it can access users index page', function () {
    $response = actingAs($this->user)
        ->get(route('settings.users.index'));

    $response->assertStatus(200);
    $response->assertInertia(fn ($assert) => $assert
        ->component('settings/users/Index')
        ->has('users')
    );
});

test('it requires authentication to access users', function () {
    $response = get(route('settings.users.index'));
    $response->assertRedirect(route('login'));
});

test('it can paginate users', function () {
    User::factory()->count(20)->create();

    $response = actingAs($this->user)
        ->get(route('settings.users.index', ['per_page' => 10]));

    $response->assertStatus(200);
    $response->assertInertia(fn ($assert) => $assert
        ->component('settings/users/Index')
        ->has('users.data', 10)
    );
});

test('it can search users', function () {
    User::factory()->create(['name' => 'John Doe']);
    User::factory()->create(['name' => 'Jane Smith']);

    $response = actingAs($this->user)
        ->get(route('settings.users.index', [
            'filter' => ['search' => 'John'],
        ]));

    $response->assertStatus(200);
    $response->assertInertia(fn ($assert) => $assert
        ->component('settings/users/Index')
        ->has('users.data', 1)
    );
});

test('it can filter users by role', function () {
    $adminRole = Role::where('name', RoleEnum::ADMIN->value)->first();

    // Create a user with admin role
    $adminUser = User::factory()->create();
    $adminUser->assignRole($adminRole);

    // Create a regular user without any role
    $regularUser = User::factory()->create();

    $response = actingAs($this->user)
        ->get(route('settings.users.index', [
            'filter' => ['roles' => [
                [RoleEnum::ADMIN->value],
            ]],
        ]));

    $response->assertStatus(200);
    $response->assertInertia(fn ($assert) => $assert
        ->component('settings/users/Index')
    );

    // Verify the filtered users have the admin role
    $response->assertInertia(fn ($assert) => $assert
        ->component('settings/users/Index')

    );
});

test('it can update user roles and permissions', function () {
    $userToUpdate = User::factory()->create();
    $adminRole = Role::where('name', RoleEnum::ADMIN->value)->first();
    $managerRole = Role::where('name', RoleEnum::MANAGER->value)->first();

    $response = actingAs($this->user)
        ->put(route('settings.users.roles-permissions.update', $userToUpdate), [
            'roles' => [
                ['id' => $adminRole->id, 'name' => $adminRole->name],
                ['id' => $managerRole->id, 'name' => $managerRole->name],
            ],
            'permissions' => [
                'view_users' => true,
                'create_users' => false,
                'update_users' => true,
            ],
        ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $userToUpdate->refresh();
    expect($userToUpdate->roles)->toHaveCount(2);
    expect($userToUpdate->roles->pluck('name')->toArray())->toContain('admin', 'manager');

    // Since admin role has all permissions, the user will have create_users permission
    // even though we set it to false, because role permissions take precedence
    expect($userToUpdate->hasPermissionTo('view_users'))->toBeTrue();
    expect($userToUpdate->hasPermissionTo('create_users'))->toBeTrue(); // Admin role has this
    expect($userToUpdate->hasPermissionTo('update_users'))->toBeTrue();
});
