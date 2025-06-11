<?php

use App\Models\Media;
use App\Models\Setting;
use App\Models\User;
use App\Settings\SiteSettings;
use App\Enums\RoleEnum;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

beforeEach(function () {
    $this->user = User::factory()->create();
    $adminRole = Role::where('name', RoleEnum::ADMIN->value)->first();
    $this->user->assignRole($adminRole);
    $this->setting = Setting::create([
        'name' => 'logo_media_id',
        'group' => 'site',
        'value' => null,
    ]);
    Storage::fake('public');
});

test('it can update site logo', function () {
    $file = UploadedFile::fake()->image('test.jpg');

    $response = actingAs($this->user)
        ->post(route('settings.logo.update'), [
            'logo' => $file,
        ]);

    $response->assertRedirect();
    expect(Media::where('file_name', 'test.jpg')->exists())->toBeTrue();
    expect(Storage::disk('public'))->toHaveFile('test.jpg');
});

test('it validates logo file upload', function () {
    $file = UploadedFile::fake()->create('test.txt', 100);

    $response = actingAs($this->user)
        ->post(route('settings.logo.update'), [
            'logo' => $file,
        ]);

    $response->assertSessionHasErrors(['logo' => 'The logo must be an image.']);
});

test('it requires authentication to update logo', function () {
    $file = UploadedFile::fake()->image('test.jpg');

    $response = post(route('settings.logo.update'), [
        'logo' => $file,
    ]);

    $response->assertRedirect(route('login'));
});
