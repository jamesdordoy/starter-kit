<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Route as RouteModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route as RouteFacade;

final class SyncRoutes extends Command
{
    protected $signature = 'route:sync';

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

        // Get all current route name+method combinations
        $existingRoutes = RouteModel::get(['name', 'method'])->map(fn ($r) => $r->name.'|'.$r->method)->toArray();
        $currentRoutes = $laravelRoutes->map(fn ($r) => $r['name'].'|'.$r['method'])->toArray();

        // Find stale routes (routes that no longer exist)
        $staleRoutes = array_diff($existingRoutes, $currentRoutes);
        $staleRouteData = collect($staleRoutes)->map(function ($routeKey) {
            [$name, $method] = explode('|', $routeKey);

            return ['name' => $name, 'method' => $method];
        });

        $deletedCount = 0;
        foreach ($staleRouteData as $routeData) {
            $deleted = RouteModel::where('name', $routeData['name'])
                ->where('method', $routeData['method'])
                ->delete();
            $deletedCount += $deleted;
        }

        // Update or create routes using name+method as unique key
        $laravelRoutes->each(function ($routeData) {
            RouteModel::updateOrCreate(
                [
                    'name' => $routeData['name'],
                    'method' => $routeData['method'],
                ],
                [
                    'uri' => $routeData['uri'],
                    'label' => null,
                    'is_public' => $routeData['is_public'],
                ]
            );
        });

        $createdCount = RouteModel::count();

        $this->info("Synced {$createdCount} route(s). Deleted {$deletedCount} stale route(s).");

        return self::SUCCESS;
    }
}
