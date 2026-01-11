<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Route as RouteModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route as RouteFacade;

final class SyncRoutes extends Command
{
    protected $signature = 'sync:routes';

    protected $description = 'Sync named Laravel routes with the routes table';

    public function handle(): int
    {
        // Routes that should be marked as public
        $publicRoutePatterns = [
            'login',
            'register',
            'password.',
            'verification.',
            'home',
            'two-factor.',
        ];

        $laravelRoutes = collect(RouteFacade::getRoutes())
            ->filter(fn ($route) => $route->getName())
            ->flatMap(function ($route) use ($publicRoutePatterns) {
                $routeName = $route->getName();

                // Check if route matches any public pattern
                $isPublic = collect($publicRoutePatterns)->contains(function ($pattern) use ($routeName) {
                    return str_starts_with($routeName, $pattern);
                });

                return collect($route->methods())
                    ->reject(fn ($method) => $method === 'HEAD')
                    ->map(fn ($method) => [
                        'name' => $routeName,
                        'uri' => $route->uri(),
                        'method' => $method,
                        'is_public' => $isPublic,
                    ]);
            });

        // Get all current route name+method combinations (use select for better performance)
        $existingRoutes = RouteModel::select('name', 'method')
            ->get()
            ->map(fn ($r) => $r->name.'|'.$r->method)
            ->toArray();

        $currentRoutes = $laravelRoutes->map(fn ($r) => $r['name'].'|'.$r['method'])->toArray();

        // Find stale routes (routes that no longer exist)
        $staleRoutes = array_diff($existingRoutes, $currentRoutes);

        // Batch delete stale routes
        $deletedCount = 0;
        if (! empty($staleRoutes)) {
            $staleRouteKeys = collect($staleRoutes)->map(function ($routeKey) {
                [$name, $method] = explode('|', $routeKey);

                return ['name' => $name, 'method' => $method];
            });

            // Delete stale routes in a single query using where conditions
            foreach ($staleRouteKeys as $routeData) {
                $deleted = RouteModel::where('name', $routeData['name'])
                    ->where('method', $routeData['method'])
                    ->delete();
                $deletedCount += $deleted;
            }
        }

        // Bulk upsert routes using name+method as unique key
        $routesToUpsert = $laravelRoutes->map(function ($routeData) {
            return [
                'name' => $routeData['name'],
                'method' => $routeData['method'],
                'uri' => $routeData['uri'],
                'label' => null,
                'is_public' => $routeData['is_public'],
                'updated_at' => now(),
                'created_at' => now(),
            ];
        })->toArray();

        if (! empty($routesToUpsert)) {
            RouteModel::upsert(
                $routesToUpsert,
                ['name', 'method'], // Unique columns
                ['uri', 'is_public', 'label', 'updated_at'] // Columns to update
            );
        }

        $createdCount = RouteModel::count();

        $this->info("Synced {$createdCount} route(s). Deleted {$deletedCount} stale route(s).");

        return self::SUCCESS;
    }
}
