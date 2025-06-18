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
    
    // Create the setting with the correct group
    $this->setting = Setting::where([
        'group' => 'site',
    ])->first();
    
    // Create a fake file and add it to the setting's media collection
    $file = UploadedFile::fake()->image('test-logo.jpg');
    $this->media = $this->setting->addMedia($file->getRealPath())
        ->toMediaCollection('site_logo');
    
    // Update the setting payload with the media ID
    $this->setting->update([
        'payload' => json_encode($this->media->id),
    ]);
    
    Storage::fake('public');
});

test('it can update site logo', function () {
    $file = UploadedFile::fake()->image('test.jpg');

    $response = actingAs($this->user)
        ->post(route('settings.logo.update'), [
            'file' => $file,
        ]);

    $response->assertRedirect();
    
    // Check that media items exist in the site_logo collection
    $mediaItems = Media::where('collection_name', 'site_logo')->get();
    expect($mediaItems)->toHaveCount(1); // Should be 1 due to singleFile()
    
    // Check that the latest media item is the one we just uploaded
    $latestMedia = $mediaItems->sortByDesc('created_at')->first();
    expect($latestMedia->file_name)->toContain('test.jpg');
    
    // Check that files exist in storage
    expect(Storage::disk('public')->allFiles())->toHaveCount(1);
});

test('it validates logo file upload', function () {
    // Create a file with an extension that's not in the allowed MIMES list
    $file = UploadedFile::fake()->create('test.exe', 100);

    $response = actingAs($this->user)
        ->post(route('settings.logo.update'), [
            'file' => $file,
        ]);

    $response->assertSessionHasErrors('file');
});

test('it requires authentication to update logo', function () {
    $file = UploadedFile::fake()->image('test.jpg');

    $response = post(route('settings.logo.update'), [
        'file' => $file,
    ]);

    $response->assertRedirect(route('login'));
});
