<?php

use App\Models\Media;
use App\Models\User;
use App\Enums\RoleEnum;
use App\Data\MediaData;
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
        Media::create([
            'model_id' => $this->user->id,
            'model_type' => User::class,
            'collection_name' => 'default',
            'name' => "test{$i}",
            'file_name' => "test{$i}.jpg",
            'mime_type' => 'image/jpeg',
            'disk' => 'public',
            'size' => 100,
            'manipulations' => [],
            'custom_properties' => [],
            'generated_conversions' => [],
            'responsive_images' => [],
        ]);
    }

    $response = actingAs($this->user)
        ->get(route('settings.media-items.index', [
            'page' => 2,
            'per_page' => 5,
        ]));

    $response->assertStatus(200);
    $response->assertInertia(fn ($assert) => $assert
        ->component('settings/media-items/Index')
        ->has('media.data', 5)
        ->has('media.meta.current_page', 2)
    );
});

test('it can store media files', function () {
    $file = UploadedFile::fake()->image('test.jpg');

    $response = actingAs($this->user)
        ->post(route('settings.media-items.store'), [
            'files' => [$file],
        ]);

    $response->assertRedirect();

    expect(Media::where('file_name', 'test.jpg')->exists())->toBeTrue();
    expect(Storage::disk('public'))->toHaveFile('test.jpg');
});

test('it validates media file upload', function () {
    $file = UploadedFile::fake()->create('test.txt', 100);

    $response = actingAs($this->user)
        ->post(route('settings.media-items.store'), [
            'files' => [$file],
        ]);

    $response->assertSessionHasErrors(['files.0' => 'The files.0 must be an image.']);
});

test('it can show media item', function () {
    $media = Media::create([
        'model_id' => $this->user->id,
        'model_type' => User::class,
        'collection_name' => 'default',
        'name' => 'test',
        'file_name' => 'test.jpg',
        'mime_type' => 'image/jpeg',
        'disk' => 'public',
        'size' => 100,
        'manipulations' => [],
        'custom_properties' => [],
        'generated_conversions' => [],
        'responsive_images' => [],
    ]);

    $response = actingAs($this->user)
        ->get(route('settings.media-items.show', $media));

    $response->assertStatus(200);
    $response->assertInertia(fn ($assert) => $assert
        ->component('settings/media-items/Show')
        ->has('media')
    );
});

test('it requires authentication to show media', function () {
    $media = Media::create([
        'model_id' => $this->user->id,
        'model_type' => User::class,
        'collection_name' => 'default',
        'name' => 'test',
        'file_name' => 'test.jpg',
        'mime_type' => 'image/jpeg',
        'disk' => 'public',
        'size' => 100,
        'manipulations' => [],
        'custom_properties' => [],
        'generated_conversions' => [],
        'responsive_images' => [],
    ]);

    $response = get(route('settings.media-items.show', $media));

    $response->assertRedirect(route('login'));
});
