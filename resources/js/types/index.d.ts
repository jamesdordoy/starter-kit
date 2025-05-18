import type { PageProps } from '@inertiajs/core';
import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: App.Data.UserData;
    can: App.Enums.PermissionEnum;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
}

export interface SharedData extends PageProps {
    name: string;
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export interface PaginatedCollection {
    data: Array<any>;
    meta: Array<{
        current_page: number;
        first_page_url: string;
        from: number;
        total: number;
        per_page: number;
        last_page: number;
        last_page_url: string;
        next_page_url: string | null;
    }>;
    links: Array<{
        label: string;
        url: string | null;
        active: boolean;
    }>;
}

export interface DatatableColumn {
    field: string;
    title: string;
}

export type BreadcrumbItemType = BreadcrumbItem;
