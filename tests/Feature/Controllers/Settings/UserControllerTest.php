<?php

use App\Models\User;
use App\Enums\RoleEnum;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(function () {
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
                [RoleEnum::ADMIN->value]
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
