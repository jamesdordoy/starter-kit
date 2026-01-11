<?php

use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        ->get(route('profile.edit', ['profile' => $this->user->id]));

    $response->assertStatus(200);
    $response->assertInertia(fn ($assert) => $assert
        ->component('settings/Profile')
        ->has('editProfilePage.user')
    );
});

test('it requires authentication to access profile edit', function () {
    $response = get(route('profile.edit', ['profile' => $this->user->id]));
    $response->assertRedirect(route('login'));
});

test('it can update profile', function () {
    $response = actingAs($this->user)
        ->put(route('profile.update', ['profile' => $this->user->id]), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

    $response->assertRedirect();
    $response->assertSessionHas('status', __('Profile updated successfully.'));

    expect($this->user->fresh())
        ->name->toBe('John Doe')
        ->email->toBe('john@example.com');
});

test('it validates profile update data', function () {
    $response = actingAs($this->user)
        ->put(route('profile.update', ['profile' => $this->user->id]), [
            'name' => '',
            'email' => 'invalid-email',
        ]);

    $response->assertSessionHasErrors(['name', 'email']);
});

test('it can delete profile', function () {
    /** @var \App\Models\User $user */
    $user = User::factory()->create([
        'password' => Hash::make('password123'),
    ]);

    $response = actingAs($this->user)
        ->delete(route('profile.destroy', ['profile' => $this->user]), [
            'password' => 'password123',
        ]);

    $response->assertRedirect('/');
    expect(User::find($this->user->id))->toBeNull();
});

test('it requires correct password to delete profile', function () {
    /** @var \App\Models\User $user */
    $user = User::factory()->create([
        'password' => Hash::make('password123'),
    ]);

    $response = actingAs($this->user)
        ->delete(route('profile.destroy', ['profile' => $this->user->id]), [
            'password' => 'wrong-password',
        ]);

    $response->assertSessionHasErrors(['password' => __('validation.current_password')]);
    expect(User::find($user->id))->not->toBeNull();
});
