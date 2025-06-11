<?php

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

test('it can access settings index page', function () {
    $response = actingAs($this->user)
        ->get(route('settings.index'));

    $response->assertStatus(200);
    $response->assertInertia(fn ($assert) => $assert
        ->component('settings/Index')
        ->has('logo')
        ->has('system', fn ($system) => $system
            ->has('app_name')
            ->has('app_env')
            ->has('app_debug')
            ->has('laravel_version')
            ->has('php_version')
            ->has('server_software')
            ->has('os')
        )
        ->has('database', fn ($database) => $database
            ->has('connection')
            ->has('driver')
            ->has('host')
            ->has('database')
        )
        ->has('cache', fn ($cache) => $cache
            ->has('driver')
        )
        ->has('queue', fn ($queue) => $queue
            ->has('driver')
        )
        ->has('storage', fn ($storage) => $storage
            ->has('default_disk')
            ->has('free_space_mb')
            ->has('total_space_mb')
        )
        ->has('mail', fn ($mail) => $mail
            ->has('driver')
            ->has('host')
            ->has('port')
            ->has('encryption')
            ->has('username')
            ->has('from', fn ($from) => $from
                ->has('address')
                ->has('name')
            )
        )
    );
});

test('it requires authentication to access settings', function () {
    $response = get(route('settings.index'));
    $response->assertRedirect(route('login'));
});

test('it displays correct system information', function () {
    $response = actingAs($this->user)
        ->get(route('settings.index'));

    $response->assertInertia(fn ($assert) => $assert
        ->component('settings/Index')
        ->has('system', fn ($system) => $system
            ->where('app_name', config('app.name'))
            ->where('app_env', app()->environment())
            ->where('app_debug', config('app.debug'))
            ->where('laravel_version', app()->version())
            ->where('php_version', PHP_VERSION)
            ->has('server_software')
            ->has('os')
        )
    );
});

test('it displays correct database information', function () {
    $response = actingAs($this->user)
        ->get(route('settings.index'));

    $response->assertInertia(fn ($assert) => $assert
        ->component('settings/Index')
        ->has('database', fn ($database) => $database
            ->where('connection', config('database.default'))
            ->where('driver', config('database.default'))
            ->where('host', config('database.connections.'.config('database.default').'.host'))
            ->has('database')
        )
    );
});
