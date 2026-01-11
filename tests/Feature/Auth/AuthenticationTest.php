<?php

use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\User;

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();

    // Assign manager role to the user
    $managerRole = Role::where('name', RoleEnum::MANAGER->value)->first();
    $user->assignRole($managerRole);

    // Ensure manager has permission to logout
    $logoutPermission = \App\Models\Permission::where('name', 'logout')->first();
    $managerRole->givePermissionTo($logoutPermission);

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
});
