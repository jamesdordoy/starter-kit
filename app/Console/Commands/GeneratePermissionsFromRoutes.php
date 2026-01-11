<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\RoleEnum;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Route;
use Illuminate\Console\Command;

final class GeneratePermissionsFromRoutes extends Command
{
    protected $signature = 'permissions:generate-from-routes {--assign-routes : Assign routes to the generated permissions}';

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
        // Split by dots
        $parts = explode('.', $routeName);

        // If less than 2 parts, it's probably not a resource route
        if (count($parts) < 2) {
            return null;
        }

        // Last part is usually the action
        $action = array_pop($parts);

        // Second to last is usually the resource (e.g., settings.users.index -> users)
        // Or the last part before action if it's nested
        $resource = array_pop($parts) ?: null;

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
            // For routes that don't match the pattern, use the route name as-is (normalized)
            return str_replace('.', '_', $routeName);
        }

        $permissionAction = $this->mapActionToPermission($parsed['action']);

        // If we can't map the action, use the route name as-is
        if (! $permissionAction) {
            return str_replace('.', '_', $routeName);
        }

        // Normalize resource name (replace hyphens with underscores)
        $resource = str_replace('-', '_', $parsed['resource']);

        // Generate permission name: {action}_{resource}
        return $permissionAction.'_'.$resource;
    }

    public function handle(): int
    {
        $this->info('Generating permissions from routes...');

        // Get all non-public routes
        $routes = Route::where('is_public', false)->get();

        $this->info("Found {$routes->count()} non-public routes.");

        $permissionMap = [];

        // Group routes by permission name (multiple routes can map to same permission)
        foreach ($routes as $route) {
            $permissionName = $this->generatePermissionName($route->name);

            if (! isset($permissionMap[$permissionName])) {
                $permissionMap[$permissionName] = [
                    'name' => $permissionName,
                    'routes' => [],
                ];
            }

            $permissionMap[$permissionName]['routes'][] = $route->id;
        }

        $this->info('Generated '.count($permissionMap).' unique permission names.');

        $created = 0;
        $updated = 0;

        // Create or update permissions
        foreach ($permissionMap as $permissionData) {
            $permission = Permission::firstOrCreate(
                ['name' => $permissionData['name']],
                ['guard_name' => 'web']
            );

            if ($permission->wasRecentlyCreated) {
                $created++;
            } else {
                $updated++;
            }

            // Assign routes to permission if requested
            if ($this->option('assign-routes')) {
                $permission->routes()->sync($permissionData['routes']);
            }
        }

        $this->info("Created {$created} new permission(s).");
        if ($updated > 0) {
            $this->info("Found {$updated} existing permission(s).");
        }

        // Attach all permissions to admin role
        $adminRole = Role::firstOrCreate(
            ['name' => RoleEnum::ADMIN->value],
            ['guard_name' => 'web']
        );

        // Get all permission IDs (including newly created ones and existing ones)
        $allPermissionIds = Permission::where('guard_name', 'web')->pluck('id')->toArray();

        $adminRole->syncPermissions($allPermissionIds);
        $this->info('All permissions have been assigned to the admin role.');

        if ($this->option('assign-routes')) {
            $this->info('Routes have been assigned to permissions.');
        } else {
            $this->comment('Tip: Use --assign-routes flag to automatically assign routes to permissions.');
        }

        return self::SUCCESS;
    }
}
