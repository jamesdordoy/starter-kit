<?php

use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(function () {
    $this->user = User::factory()->create([
        'password' => Hash::make('old-password'),
    ]);

    // Get the admin role and assign it
    $adminRole = Role::where('name', RoleEnum::ADMIN->value)->first();
    $this->user->assignRole($adminRole);
});

test('it can access password edit page', function () {
    $response = actingAs($this->user)
        ->get(route('password.edit'));

    $response->assertStatus(200);
    $response->assertInertia(fn ($assert) => $assert
        ->component('settings/Password')
        ->has('user')
    );
});

test('it requires authentication to access password edit', function () {
    $response = get(route('password.edit'));
    $response->assertRedirect(route('login'));
});

test('it can update password', function () {
    $response = actingAs($this->user)
        ->put(route('user-password.update'), [
            'current_password' => 'old-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

    $response->assertRedirect();

    expect(Hash::check('new-password', $this->user->fresh()->password))->toBeTrue();
});

test('it validates current password', function () {
    $response = actingAs($this->user)
        ->put(route('user-password.update'), [
            'current_password' => 'wrong-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

    $response->assertSessionHasErrorsIn('updatePassword', ['current_password']);
    expect(Hash::check('old-password', $this->user->fresh()->password))->toBeTrue();
});

test('it validates password confirmation', function () {
    $response = actingAs($this->user)
        ->put(route('user-password.update'), [
            'current_password' => 'old-password',
            'password' => 'new-password',
            'password_confirmation' => 'different-password',
        ]);

    $response->assertSessionHasErrorsIn('updatePassword', ['password']);
    expect(Hash::check('old-password', $this->user->fresh()->password))->toBeTrue();
});

test('it validates password strength', function () {
    $response = actingAs($this->user)
        ->put(route('user-password.update'), [
            'current_password' => 'old-password',
            'password' => 'weak',
            'password_confirmation' => 'weak',
        ]);

    $response->assertSessionHasErrorsIn('updatePassword', ['password']);
    expect(Hash::check('old-password', $this->user->fresh()->password))->toBeTrue();
});
