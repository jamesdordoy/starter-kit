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

        // Handle missing route mapping
        if (! $routeModel) {
            \Log::warning("Unregistered route: {$routeName}");

            // Uncomment to block by default:
            abort(403, 'Access denied: route not registered.');
        }

        // Public routes are accessible to everyone (including unauthenticated users)
        if ($routeModel->is_public) {
            return $next($request);
        }

        // If route is not public, user must be authenticated
        if (! $user) {
            \Log::warning('not authenticated');
            abort(403, 'Access denied: authentication required.');
        }

        // Admins have access to all routes
        if ($user->isAdmin()) {
            return $next($request);
        }

        // Visitor role can only access public routes (already checked above)
        if ($user->isVisitor()) {
            abort(403, 'Access denied: visitor role can only access public routes.');
        }

        // Check if user's permissions grant access to this route
        $userAccessibleRouteNames = $user->getAccessibleRouteNames();
        if (! in_array($routeName, $userAccessibleRouteNames)) {
            abort(403, 'Access denied: route not accessible with your current permissions.');
        }

        return $next($request);
    }
}
