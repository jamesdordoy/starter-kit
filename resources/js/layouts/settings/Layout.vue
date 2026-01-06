<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Separator } from '@/components/ui/separator';
import type { NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { index as settingsIndex } from '@/actions/App/Http/Controllers/Settings/SettingController';
import { index as usersIndex } from '@/actions/App/Http/Controllers/Settings/UserController';
import { index as activityIndex } from '@/actions/App/Http/Controllers/Settings/ActivityLogController';
import { index as mediaIndex } from '@/actions/App/Http/Controllers/Settings/MediaController';

const page = usePage();
const currentUrl = page.url;

const sidebarNavItems: NavItem[] = [
    { title: 'General Settings', routeGroup: 'settings.index', href: settingsIndex().url },
    { title: 'Site Users', routeGroup: 'settings.users', href: usersIndex().url },
    { title: 'Activity Log', routeGroup: 'settings.activity.index', href: activityIndex().url },
    { title: 'Assets', routeGroup: 'settings.media-items.index', href: mediaIndex().url },
];

const isActive = (routeGroup: string) => {
    const item = sidebarNavItems.find(i => i.routeGroup === routeGroup);
    if (!item) return false;
    
    if (routeGroup.endsWith('.index')) {
        return currentUrl === item.href || currentUrl.startsWith(item.href + '/');
    }

    return currentUrl.startsWith(item.href);
};
</script>

<template>
    <div class="px-4 py-6">
        <Heading title="General Settings" description="Manage your staff and general site settings." />

        <div class="flex flex-col space-y-8 md:space-y-0 lg:flex-row lg:space-y-0 lg:space-x-12">
            <aside class="w-full max-w-xl lg:w-48">
                <nav class="flex flex-col space-y-1 space-x-0">
                    <Button
                        v-for="item in sidebarNavItems"
                        :key="item.routeGroup"
                        variant="ghost"
                        :class="['w-full justify-start', { 'bg-muted': isActive(item.routeGroup || '') }]"
                        as-child
                    >
                        <Link :href="item.href">
                            {{ item.title }}
                        </Link>
                    </Button>
                </nav>
            </aside>

            <Separator class="my-6 md:hidden" />

            <div class="w-full flex-1 md:max-w-2xl lg:max-w-none">
                <section class="max-w space-y-12">
                    <slot />
                </section>
            </div>
        </div>
    </div>
</template>
