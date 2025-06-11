<?php

use App\Models\Media;
use App\Models\Setting;
use App\Models\User;
use App\Settings\SiteSettings;
use App\Enums\RoleEnum;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->user->assignRole(RoleEnum::ADMIN->value);
    $this->setting = Setting::create([
        'name' => 'logo_media_id',
        'group' => 'site',
        'value' => null,
    ]);
    Storage::fake('public');
});

test('it can update site logo', function () {
    $file = UploadedFile::fake()->image('logo.jpg');

    $response = actingAs($this->user)
        ->post(route('settings.logo.update'), [
            'file' => $file,
        ]);

    $response->assertRedirect();
    $response->assertSessionHas('status', 'logo-updated');

    expect(Media::where([
        'collection_name' => 'site_logo',
        'file_name' => 'logo.jpg',
    ])->exists())->toBeTrue();

    $settings = app(SiteSettings::class);
    expect($settings->logo_media_id)->not->toBeNull();
});

test('it validates logo file upload', function () {
    $file = UploadedFile::fake()->create('test.txt', 100);

    $response = actingAs($this->user)
        ->post(route('settings.logo.update'), [
            'file' => $file,
        ]);

    $response->assertSessionHasErrors('file');
});

test('it requires authentication to update logo', function () {
    $file = UploadedFile::fake()->image('logo.jpg');

    $response = post(route('settings.logo.update'), [
        'file' => $file,
    ]);

    $response->assertRedirect(route('login'));
});
