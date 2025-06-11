<?php

namespace App\Console\Commands;

use App\Models\Route as RouteModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route as RouteFacade;

class SyncRoutes extends Command
{
    protected $signature = 'route:sync';

    protected $description = 'Sync named Laravel routes with the routes table';

    public function handle()
    {
        $laravelRoutes = collect(RouteFacade::getRoutes())
            ->filter(fn ($route) => $route->getName())
            ->flatMap(function ($route) {
                return collect($route->methods())
                    ->reject(fn ($method) => $method === 'HEAD')
                    ->map(fn ($method) => [

                        'name' => $route->getName(),
                        'uri' => $route->uri(),
                        'method' => $method,
                    ]);
            });

        $existingRouteNames = RouteModel::pluck('name')->toArray();
        $currentRouteNames = $laravelRoutes->pluck('name')->toArray();

        $staleRoutes = array_diff($existingRouteNames, $currentRouteNames);
        $deletedCount = RouteModel::whereIn('name', $staleRoutes)->delete();

        $laravelRoutes->each(fn ($route) => RouteModel::firstOrCreate(
            ['name' => $route['name']],
            [
                'uri' => $route['uri'],
                'method' => $route['method'],
                'label' => null,
            ]
        ));

        $createdCount = RouteModel::count();

        $this->info("✅ Synced {$createdCount} route(s). � Deleted {$deletedCount} stale route(s).");
    }
}
