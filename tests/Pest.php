<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/

pest()->extend(Tests\TestCase::class)
    ->use(Illuminate\Foundation\Testing\RefreshDatabase::class)
    ->in('Feature');

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use App\Enums\RoleEnum;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Enums\PermissionEnum;

uses(RefreshDatabase::class)->in('Feature');
uses(RefreshDatabase::class)->in('Unit');

beforeEach(function () {
    Config::set('app.env', 'testing');
    
    // Create permissions with web guard
    collect(PermissionEnum::cases())
        ->each(fn ($permission) => Permission::firstOrCreate(
            ['name' => $permission->value],
            ['guard_name' => 'web']
        ));
    
    // Create roles with web guard and sync permissions
    collect(RoleEnum::cases())->each(function ($roleEnum) {
        $role = Role::firstOrCreate(
            ['name' => $roleEnum->value],
            ['guard_name' => 'web']
        );
        
        $permissions = $roleEnum === RoleEnum::ADMIN
            ? Permission::where('guard_name', 'web')->get()
            : collect($roleEnum->getPermissions())
                ->map(fn ($permissionEnum) => Permission::where('name', $permissionEnum->value)
                    ->where('guard_name', 'web')
                    ->first())
                ->filter();
        
        $role->syncPermissions($permissions);
    });
});

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function something()
{
    // ..
}
