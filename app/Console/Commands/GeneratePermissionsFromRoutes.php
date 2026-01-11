<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\RoleEnum;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Route;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

final class GeneratePermissionsFromRoutes extends Command
{
    protected $signature = 'generate:permissions {--assign-routes : Assign routes to the generated permissions} {--generate-enum : Generate an enum containing all permissions and their associated routes}';

    protected $description = 'Generate permissions based on routes in the database';

    /**
     * Map route actions to permission actions
     */
    private function mapActionToPermission(string $action): ?string
    {
        return match ($action) {
            'index', 'show' => 'view',
            'create', 'store' => 'create',
            'edit', 'update' => 'update',
            'destroy', 'delete' => 'delete',
            'restore' => 'restore',
            default => null,
        };
    }

    /**
     * Extract resource and action from route name
     * Examples:
     * - "settings.users.index" -> ['resource' => 'users', 'action' => 'index']
     * - "settings.roles.create" -> ['resource' => 'roles', 'action' => 'create']
     */
    private function parseRouteName(string $routeName): ?array
    {
        $parts = Str::of($routeName)->explode('.');

        if ($parts->count() < 2) {
            return null;
        }

        $action = $parts->pop();
        $resource = $parts->pop();

        if (! $resource || ! $action) {
            return null;
        }

        return [
            'resource' => $resource,
            'action' => $action,
            'full_path' => $routeName,
        ];
    }

    /**
     * Generate permission name from route
     */
    private function generatePermissionName(string $routeName): ?string
    {
        $parsed = $this->parseRouteName($routeName);

        if (! $parsed) {
            return Str::replace('.', '_', $routeName);
        }

        $permissionAction = $this->mapActionToPermission($parsed['action']);

        if (! $permissionAction) {
            return Str::replace('.', '_', $routeName);
        }

        $resource = Str::replace('-', '_', $parsed['resource']);

        return sprintf('%s_%s', $permissionAction, $resource);
    }

    public function handle(): int
    {
        $this->info('Generating permissions from routes...');

        // Get all non-public routes
        $routes = Route::where('is_public', false)->get();

        $this->info("Found {$routes->count()} non-public routes.");

        $permissionMap = $routes->mapToGroups(fn ($route) => [
            $this->generatePermissionName($route->name) => $route->id,
        ])->map(fn ($routeIds, $permissionName) => [
            'name' => $permissionName,
            'routes' => $routeIds->values()->toArray(),
        ]);

        $this->info(sprintf('Generated %d unique permission names.', $permissionMap->count()));

        $permissionNames = $permissionMap->keys();
        $existingPermissionNames = Permission::where('guard_name', 'web')
            ->whereIn('name', $permissionNames)
            ->pluck('name');

        $permissionsToUpsert = $permissionMap->map(fn ($permissionData) => [
            'name' => $permissionData['name'],
            'guard_name' => 'web',
            'updated_at' => now(),
            'created_at' => now(),
        ])->values();

        if (! $permissionsToUpsert->isEmpty()) {
            Permission::upsert(
                $permissionsToUpsert->toArray(),
                ['name', 'guard_name'],
                ['updated_at']
            );

            $created = $permissionNames->diff($existingPermissionNames)->count();
            $updated = $permissionNames->intersect($existingPermissionNames)->count();
        } else {
            $created = 0;
            $updated = 0;
        }

        $this->info("Created {$created} new permission(s).");
        if ($updated > 0) {
            $this->info("Found {$updated} existing permission(s).");
        }

        if ($this->option('assign-routes')) {
            $permissions = Permission::where('guard_name', 'web')
                ->whereIn('name', $permissionMap->keys())
                ->get()
                ->keyBy('name');

            $pivotData = $permissionMap->flatMap(fn ($permissionData, $permissionName) => 
                collect($permissionData['routes'])->map(fn ($routeId) => [
                    'permission_id' => $permissions->get($permissionName)?->id,
                    'route_id' => $routeId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            )->filter(fn ($data) => $data['permission_id'])->values();

            if (! $pivotData->isEmpty()) {
                DB::table('route_permission')
                    ->whereIn('permission_id', $permissions->pluck('id'))
                    ->delete();

                DB::table('route_permission')->insert($pivotData->toArray());
            }
        }

        // Attach all permissions to admin role
        $adminRole = Role::firstOrCreate(
            ['name' => RoleEnum::ADMIN->value],
            ['guard_name' => 'web']
        );

        $adminRole->syncPermissions(
            Permission::where('guard_name', 'web')->pluck('id')
        );
        $this->info('All permissions have been assigned to the admin role.');

        if ($this->option('assign-routes')) {
            $this->info('Routes have been assigned to permissions.');
        } else {
            $this->comment('Tip: Use --assign-routes flag to automatically assign routes to permissions.');
        }

        if ($this->option('generate-enum')) {
            $this->generatePermissionEnum();
        }

        return self::SUCCESS;
    }

    /**
     * Generate an enum containing all permissions and their associated routes
     */
    private function generatePermissionEnum(): void
    {
        $this->info('Generating permission enum...');

        $permissions = Permission::with('routes')->orderBy('name')->get();

        if ($permissions->isEmpty()) {
            $this->warn('No permissions found to generate enum.');

            return;
        }

        $enumCases = $permissions->mapWithKeys(fn ($permission) => [
            Str::upper($permission->name) => $permission->name,
        ]);

        $permissionRoutesMap = $permissions->mapWithKeys(fn ($permission) => [
            $permission->name => $permission->routes->pluck('name')->unique()->sort()->values()->toArray(),
        ])->toArray();

        $enumContent = $this->buildPermissionEnumContent($enumCases->toArray(), $permissionRoutesMap);

        $enumPath = config('permission.generate_enum_path');
        File::put($enumPath, $enumContent);

        $this->info("Generated enum with {$permissions->count()} permission(s) at: {$enumPath}");
    }

    /**
     * Build the permission enum PHP file content
     */
    private function buildPermissionEnumContent(array $enumCases, array $permissionRoutesMap): string
    {
        $cases = collect($enumCases)
            ->map(fn ($permissionName, $caseName) => "\tcase {$caseName} = '{$permissionName}';")
            ->implode("\n");

        $matchEntries = collect($permissionRoutesMap)
            ->sortKeys()
            ->map(fn ($routeNames, $permission) => [
                'case' => Str::upper($permission),
                'routes' => collect($routeNames)->map(fn ($route) => "'{$route}'")->implode(', '),
            ])
            ->map(fn ($entry) => sprintf("\t\t\tself::%s => [%s],", $entry['case'], $entry['routes']))
            ->implode("\n");

        $stub = File::get(config('permission.generate_enum_stub'));

        return Str::replace(['{{CASES}}', '{{MATCH_ENTRIES}}'], [$cases, $matchEntries], $stub);
    }
}
