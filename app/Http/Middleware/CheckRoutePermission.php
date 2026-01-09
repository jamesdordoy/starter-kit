<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\Route;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class CheckRoutePermission
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $route = $request->route();

        if (! $route) {
            return $next($request);
        }

        $routeName = $route->getName();

        if (! $routeName) {
            return $next($request);
        }

        $routeModel = Route::with('permissions')->where('name', $routeName)->first();

        // Handle missing route mapping
        if (! $routeModel) {
            // Log::warning("Unregistered route: {$routeName}");

            // Uncomment to block by default:
            // abort(403, 'Access denied: route not registered.');

            return $next($request); // Allow through (optional)
        }

        $requiredPermissions = $routeModel->permissions->pluck('name');

        foreach ($requiredPermissions as $permission) {
            if (! $user || ! $user->can($permission)) {
                abort(403, "Access denied: missing permission '{$permission}'.");
            }
        }

        return $next($request);
    }
}
