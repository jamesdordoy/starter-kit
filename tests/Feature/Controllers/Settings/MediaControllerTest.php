<?php

use App\Data\MediaData;
use App\Enums\RoleEnum;
use App\Models\Media;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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

    Storage::fake('public');
});

test('it can access media index page', function () {
    $response = actingAs($this->user)
        ->get(route('settings.media-items.index'));

    $response->assertStatus(200);
    $response->assertInertia(fn ($assert) => $assert
        ->component('settings/assets/Index')
        ->has(MediaData::COLLECTION_NAME)
        ->has('params')
    );
});

test('it requires authentication to access media', function () {
    $response = get(route('settings.media-items.index'));
    $response->assertRedirect(route('login'));
});

test('it can paginate media items', function () {
    for ($i = 0; $i < 10; $i++) {
        $file = UploadedFile::fake()->image("test{$i}.jpg");
        $this->user->addMedia($file->getRealPath())
            ->toMediaCollection('default');
    }

    $response = actingAs($this->user)
        ->get(route('settings.media-items.index', [
            'page' => 2,
            'per_page' => 5,
        ]));

    $response->assertStatus(200);
    $response->assertInertia(fn ($assert) => $assert
        ->component('settings/assets/Index')
        ->has('assets.data', 5)
        ->where('assets.current_page', 2)
    );
});

test('it can store media files', function () {
    $file = UploadedFile::fake()->image('test.jpg');

    $response = actingAs($this->user)
        ->post(route('settings.media-items.store'), [
            'files' => [$file],
        ]);

    $response->assertRedirect();

    // Check that a media item was created (filename might be different due to Spatie's naming)
    expect(Media::where('collection_name', 'default')->count())->toBe(1);
    expect(Storage::disk('public')->allFiles())->toHaveCount(1);
});

test('it validates media file upload', function () {
    // Create a file with an extension that's not in the allowed MIMES list
    $file = UploadedFile::fake()->create('test.exe', 100);

    $response = actingAs($this->user)
        ->post(route('settings.media-items.store'), [
            'files' => [$file],
        ]);

    $response->assertSessionHasErrors('files.0');
});

test('it can show media item', function () {
    // Create a media item using Spatie Media Library
    $file = UploadedFile::fake()->image('test.jpg');
    $media = $this->user->addMedia($file->getRealPath())
        ->toMediaCollection('default');

    $response = actingAs($this->user)
        ->get(route('settings.media-items.show', $media));

    $response->assertStatus(200);
    $expectedFilename = $media->custom_properties['client_name'] ?? $media->file_name;
    $response->assertHeader('Content-Disposition', "attachment; filename={$expectedFilename}");
});

test('it requires authentication to show media', function () {
    // Create a media item using Spatie Media Library
    $file = UploadedFile::fake()->image('test.jpg');
    $media = $this->user->addMedia($file->getRealPath())
        ->toMediaCollection('default');

    $response = get(route('settings.media-items.show', $media));

    $response->assertRedirect(route('login'));
});
