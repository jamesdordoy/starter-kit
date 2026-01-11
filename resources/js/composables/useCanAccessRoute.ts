import { usePage } from '@inertiajs/vue3';
import type { RouteDefinition } from '@/wayfinder';
import type { SharedData } from '@/types';
import { usePermissions } from './usePermissions';

/**
 * Composable for checking if a user can access a route based on route-permission mappings
 */
export function useCanAccessRoute() {
    const page = usePage<SharedData>();
    const { canAll } = usePermissions();

    /**
     * Normalize URL by removing leading/trailing slashes for consistent matching
     */
    const normalizeUrl = (url: string): string => {
        return url.replace(/^\/+|\/+$/g, '');
    };

    /**
     * Extract route name from a Wayfinder route definition using URL and method
     */
    const getRouteNameFromDefinition = (route: RouteDefinition): string | null => {
        const url = normalizeUrl(route.url.split('?')[0]); // Remove query string and normalize
        const method = route.method?.toUpperCase() ?? 'GET';
        const key = `${method}:${url}`;
        
        // Try exact match first (for routes without parameters)
        const routeName = page.props.routes?.nameMap[key];
        if (routeName) {
            return routeName;
        }

        // Try to match with parameter placeholders (e.g., {user} -> any value)
        // This is a fallback for routes with parameters
        const routeNameMap = page.props.routes?.nameMap ?? {};
        for (const [urlMethod, name] of Object.entries(routeNameMap)) {
            const [routeMethod, routeUrl] = urlMethod.split(':', 2);
            
            if (routeMethod !== method) {
                continue;
            }

            const normalizedRouteUrl = normalizeUrl(routeUrl);

            // Convert parameter placeholders to regex pattern
            // Escape special regex characters first, then replace {param} with [^/]+
            const escaped = normalizedRouteUrl.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
            const pattern = escaped.replace(/\{[^}]+\}/g, '[^/]+');
            const regex = new RegExp(`^${pattern}$`);
            
            if (regex.test(url)) {
                return name;
            }
        }

        return null;
    };

    /**
     * Get route name from either a string (route name) or RouteDefinition
     */
    const getRouteName = (route: RouteDefinition | string): string | null => {
        if (typeof route === 'string') {
            return route;
        }

        return getRouteNameFromDefinition(route);
    };

    /**
     * Check if the user can access a route by route name
     * This checks the routes.accessible map which is built from user's roles and permissions
     */
    const canAccessRoute = (routeName: string): boolean => {
        // Check if route is in the accessible routes map
        return page.props.routes?.accessible[routeName] ?? false;
    };

    /**
     * Check if the user can access a route using either:
     * - A route name string (e.g., "settings.users.index")
     * - A Wayfinder RouteDefinition object
     */
    const canAccess = (route: string | RouteDefinition): boolean => {
        const routeName = getRouteName(route);
        
        if (!routeName) {
            // If we can't determine the route name, allow access
            // You can modify this behavior to deny by default if preferred
            return true;
        }

        return canAccessRoute(routeName);
    };

    return {
        canAccessRoute,
        canAccess,
        getRouteName,
    };
}
