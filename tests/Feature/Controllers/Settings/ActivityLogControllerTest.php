<?php

use App\Models\Activity;
use App\Models\User;
use App\Enums\RoleEnum;
use Illuminate\Support\Facades\Hash;
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
});

test('it can access activity log index page', function () {
    $response = actingAs($this->user)
        ->get(route('settings.activity.index'));

    $response->assertStatus(200);
    $response->assertInertia(fn ($assert) => $assert
        ->component('settings/activity/Index')
        ->has('activities')
        ->has('users')
        ->has('params')
    );
});

test('it requires authentication to access activity log', function () {
    $response = get(route('settings.activity.index'));
    $response->assertRedirect(route('login'));
});

test('it can paginate activities', function () {
    // Create activities manually since we don't have a factory
    for ($i = 0; $i < 20; $i++) {
        Activity::create([
            'causer_id' => $this->user->id,
            'causer_type' => User::class,
            'description' => 'Test activity '.$i,
            'properties' => [],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    $response = actingAs($this->user)
        ->get(route('settings.activity.index', ['per_page' => 10]));

    $response->assertStatus(200);
    $response->assertInertia(fn ($assert) => $assert
        ->component('settings/activity/Index')
        ->has('activities.data', 10)
    );
});

test('it can filter activities by description', function () {
    Activity::create([
        'causer_id' => $this->user->id,
        'causer_type' => User::class,
        'description' => 'User logged in',
        'properties' => [],
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    Activity::create([
        'causer_id' => $this->user->id,
        'causer_type' => User::class,
        'description' => 'Profile updated',
        'properties' => [],
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = actingAs($this->user)
        ->get(route('settings.activity.index', [
            'filter' => ['description' => 'logged in'],
        ]));

    $response->assertStatus(200);
    $response->assertInertia(fn ($assert) => $assert
        ->component('settings/activity/Index')
        ->has('activities.data', 1)
    );
});

test('it can filter activities by date range', function () {
    Activity::create([
        'causer_id' => $this->user->id,
        'causer_type' => User::class,
        'description' => 'Old activity',
        'properties' => [],
        'created_at' => now()->subDays(2),
        'updated_at' => now()->subDays(2),
    ]);

    Activity::create([
        'causer_id' => $this->user->id,
        'causer_type' => User::class,
        'description' => 'Recent activity',
        'properties' => [],
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = actingAs($this->user)
        ->get(route('settings.activity.index', [
            'filter' => [
                'date_range' => [
                    'from' => [
                        'year' => now()->subDay()->year,
                        'month' => now()->subDay()->month,
                        'day' => now()->subDay()->day,
                    ],
                    'to' => [
                        'year' => now()->addDay()->year,
                        'month' => now()->addDay()->month,
                        'day' => now()->addDay()->day,
                    ],
                ],
            ],
        ]));

    $response->assertStatus(200);
    $response->assertInertia(fn ($assert) => $assert
        ->component('settings/activity/Index')
        ->has('activities.data', 1)
    );
});

test('it can access activity show page', function () {
    $activity = Activity::create([
        'causer_id' => $this->user->id,
        'causer_type' => User::class,
        'description' => 'Test activity',
        'properties' => [],
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = actingAs($this->user)
        ->get(route('settings.activity.show', $activity));

    $response->assertStatus(200);
    $response->assertInertia(fn ($assert) => $assert
        ->component('settings/activity/Show')
    );
});
