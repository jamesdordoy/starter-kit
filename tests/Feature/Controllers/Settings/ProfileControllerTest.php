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

test('it can access profile edit page', function () {
    $response = actingAs($this->user)
        ->get(route('profile.edit'));

    $response->assertStatus(200);
    $response->assertInertia(fn ($assert) => $assert
        ->component('settings/Profile')
        ->has('user')
    );
});

test('it requires authentication to access profile edit', function () {
    $response = get(route('profile.edit'));
    $response->assertRedirect(route('login'));
});

test('it can update profile', function () {
    $response = actingAs($this->user)
        ->put(route('profile.update'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

    $response->assertRedirect();
    $response->assertSessionHas('status', 'profile-updated');

    expect($this->user->fresh())
        ->name->toBe('John Doe')
        ->email->toBe('john@example.com');
});

test('it validates profile update data', function () {
    $response = actingAs($this->user)
        ->put(route('profile.update'), [
            'name' => '',
            'email' => 'invalid-email',
        ]);

    $response->assertSessionHasErrors(['name', 'email']);
});

test('it can delete profile', function () {
    $response = actingAs($this->user)
        ->delete(route('profile.destroy'), [
            'password' => 'password123',
        ]);

    $response->assertRedirect(route('login'));
    expect(User::find($this->user->id))->toBeNull();
});

test('it requires correct password to delete profile', function () {
    $response = actingAs($this->user)
        ->delete(route('profile.destroy'), [
            'password' => 'wrong-password',
        ]);

    $response->assertSessionHasErrors('password');
    expect(User::find($this->user->id))->not->toBeNull();
});
