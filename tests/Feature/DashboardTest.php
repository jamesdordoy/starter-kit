<?php

use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\User;

test('guests are redirected to the login page', function () {
    $response = $this->get('/dashboard');
    $response->assertRedirect('/login');
});

test('test an admin can visit the dashboard', function () {

    $user = User::factory()->create();
    $this->actingAs($user);

    // Get the admin role and assign it
    $adminRole = Role::where('name', RoleEnum::ADMIN->value)->first();
    $user->assignRole($adminRole);

    $response = $this->get('/dashboard');
    $response->assertStatus(200);
});
