import { usePage } from '@inertiajs/vue3';
import { computed, type ComputedRef } from 'vue';
import type { SharedData } from '@/types';

/**
 * Composable for checking user permissions
 */
export function usePermissions() {
    const page = usePage<SharedData>();

    /**
     * Check if the user has a specific permission
     */
    const can = (permission: string): boolean => {
        return page.props.auth.can[permission] ?? false;
    };

    /**
     * Check if the user has any of the given permissions
     */
    const canAny = (permissions: string[]): boolean => {
        return permissions.some((permission) => can(permission));
    };

    /**
     * Check if the user has all of the given permissions
     */
    const canAll = (permissions: string[]): boolean => {
        return permissions.every((permission) => can(permission));
    };

    /**
     * Get all permissions the user has
     */
    const permissions: ComputedRef<string[]> = computed(() => {
        return Object.entries(page.props.auth.can)
            .filter(([, hasPermission]) => hasPermission)
            .map(([permission]) => permission);
    });

    return {
        can,
        canAny,
        canAll,
        permissions,
    };
}
