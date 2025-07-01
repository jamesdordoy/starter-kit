<?php

use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;

use function Pest\Laravel\actingAs;

describe('UpdateUserProfileInformation', function () {
    it('updates the user\'s name and email successfully', function () {
        $user = User::factory()->create([
            'name' => 'Old Name',
            'email' => 'old@example.com',
        ]);
        actingAs($user);
        $action = new UpdateUserProfileInformation;

        $action->update($user, [
            'name' => 'New Name',
            'email' => 'new@example.com',
        ]);

        $user->refresh();
        expect($user->name)->toBe('New Name');
        expect($user->email)->toBe('new@example.com');
    });

    it('throws validation error if email is not unique', function () {
        $user1 = User::factory()->create([
            'email' => 'user1@example.com',
        ]);
        $user2 = User::factory()->create([
            'email' => 'user2@example.com',
        ]);
        actingAs($user2);
        $action = new UpdateUserProfileInformation;

        expect(fn () => $action->update($user2, [
            'name' => 'User Two',
            'email' => 'user1@example.com', // duplicate
        ]))->toThrow(ValidationException::class);
    });

    it('resets email verification and sends notification if email is changed for MustVerifyEmail user', function () {
        Notification::fake();
        $user = User::factory()->create([
            'email' => 'old@example.com',
            'email_verified_at' => now(),
        ]);
        actingAs($user);
        $action = new UpdateUserProfileInformation;

        $action->update($user, [
            'name' => 'Name',
            'email' => 'new@example.com',
        ]);

        $user->refresh();
        expect($user->email_verified_at)->toBeNull();
        Notification::assertSentTo($user, VerifyEmail::class);
    });
});
