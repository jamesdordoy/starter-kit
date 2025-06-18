<?php

use App\Enums\RoleEnum;
use App\Models\Media;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

beforeEach(function () {
    $this->user = User::factory()->create([
        'password' => Hash::make('password123'),
    ]);

    // Get the admin role and assign it
    $adminRole = Role::where('name', RoleEnum::ADMIN->value)->first();
    $this->user->assignRole($adminRole);

    Storage::fake('public');
});

test('it can update profile avatar', function () {
    $file = UploadedFile::fake()->image('avatar.jpg');

    $response = actingAs($this->user)
        ->post(route('profile.avatar'), [
            'avatar' => $file,
        ]);

    $response->assertRedirect();
    $response->assertSessionHas('status', 'profile-updated');

    expect(Media::where([
        'model_id' => $this->user->id,
        'model_type' => User::class,
        'collection_name' => 'avatars',
        'file_name' => 'avatar.jpg',
    ])->exists())->toBeTrue();
});

test('it validates avatar file upload', function () {
    $file = UploadedFile::fake()->create('test.txt', 100);

    $response = actingAs($this->user)
        ->post(route('profile.avatar'), [
            'avatar' => $file,
        ]);

    $response->assertSessionHasErrors('avatar');
});

test('it requires authentication to update avatar', function () {
    $file = UploadedFile::fake()->image('avatar.jpg');

    $response = post(route('profile.avatar'), [
        'avatar' => $file,
    ]);

    $response->assertRedirect(route('login'));
});
