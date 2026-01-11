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

        $routeModel = Route::where('name', $routeName)->first();

        if (! $routeModel) {
            abort(403, 'Access denied: route not registered.');
        }

        if ($routeModel->is_public) {
            return $next($request);
        }

        if (! $user) {
            abort(403, 'Access denied: authentication required.');
        }

        if ($user->hasRole('admin')) {
            return $next($request);
        }

        $userAccessibleRouteNames = $user->getAccessibleRouteNames();
        if (! in_array($routeName, $userAccessibleRouteNames)) {
            abort(403, 'Access denied: route not accessible with your current permissions.');
        }

        return $next($request);
    }
}
