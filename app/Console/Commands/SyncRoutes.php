<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Route as RouteModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route as RouteFacade;
use Illuminate\Support\Str;

final class SyncRoutes extends Command
{
    protected $signature = 'sync:routes';

    protected $description = 'Sync named Laravel routes with the routes table';

    public function handle(): int
    {
        $laravelRoutes = collect(RouteFacade::getRoutes())
            ->filter(fn ($route) => $route->getName())
            ->flatMap(function ($route) {
                $routeName = $route->getName();

                $isPublic = collect(config('permission.public_route_patterns'))->contains(fn ($pattern) => Str::startsWith($routeName, $pattern));

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
            ->map(fn ($route) => sprintf('%s|%s', $route->name, $route->method));

        $currentRoutes = $laravelRoutes->map(fn ($route) => sprintf('%s|%s', $route['name'], $route['method']));

        $staleRoutes = $existingRoutes->diffAssoc($currentRoutes);

        $deletedCount = 0;
        if (! $staleRoutes->isEmpty()) {
            $staleRouteKeys = collect($staleRoutes)->map(function ($routeKey) {
                [$name, $method] = Str::of($routeKey)->explode('|');

                return ['name' => $name, 'method' => $method];
            });

            $deletedCount = $staleRouteKeys->map(fn ($routeData) => RouteModel::where('name', $routeData['name'])
                ->where('method', $routeData['method'])
                ->delete())->sum();
        }

        // Bulk upsert routes using name+method as unique key
        $routesToUpsert = $laravelRoutes->map(fn ($routeData) => [
                'name' => $routeData['name'],
                'method' => $routeData['method'],
                'uri' => $routeData['uri'],
                'label' => null,
                'is_public' => $routeData['is_public'],

            ]);

        if (! $routesToUpsert->isEmpty()) {
            RouteModel::upsert(
                $routesToUpsert->toArray(),
                ['name', 'method'], // Unique columns
                ['uri', 'is_public', 'label', 'updated_at'] // Columns to update
            );
        }

        $createdCount = RouteModel::count();

        $this->info("Synced {$createdCount} route(s). Deleted {$deletedCount} stale route(s).");

        return self::SUCCESS;
    }
}
