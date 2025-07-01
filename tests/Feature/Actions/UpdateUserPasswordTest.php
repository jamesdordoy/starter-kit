<?php

use App\Actions\Fortify\UpdateUserPassword;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use function Pest\Laravel\actingAs;

describe('UpdateUserPassword', function () {
    it('updates the password when current password is correct and new password is valid', function () {
        $user = User::factory()->create([
            'password' => Hash::make('old-password'),
        ]);
        actingAs($user);
        $action = new UpdateUserPassword();

        $action->update($user, [
            'current_password' => 'old-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        expect(Hash::check('new-password', $user->fresh()->password))->toBeTrue();
    });

    it('throws validation error if current password is incorrect', function () {
        $user = User::factory()->create([
            'password' => Hash::make('old-password'),
        ]);
        actingAs($user);
        $action = new UpdateUserPassword();

        expect(fn () => $action->update($user, [
            'current_password' => 'wrong-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]))->toThrow(ValidationException::class);
    });

    it('throws validation error if new password is invalid', function () {
        $user = User::factory()->create([
            'password' => Hash::make('old-password'),
        ]);
        actingAs($user);
        $action = new UpdateUserPassword();

        expect(fn () => $action->update($user, [
            'current_password' => 'old-password',
            'password' => 'short', // too short for default rules
            'password_confirmation' => 'short',
        ]))->toThrow(ValidationException::class);
    });
}); 