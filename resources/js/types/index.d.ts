import type { PageProps } from '@inertiajs/core';
import type { LucideIcon } from 'lucide-vue-next';

export interface Auth {
    user: App.Data.UserData;
    can: Record<string, boolean>;
    impersonator: App.Data.UserData | null;
}


export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href?: string;
    icon?: LucideIcon;
    isActive?: boolean;
    routeGroup?: string;
}

export interface SharedData extends PageProps {
    name: string;
    auth: Auth;
    sidebarOpen: boolean;
}

export type BreadcrumbItemType = BreadcrumbItem;
