<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Separator } from '@/components/ui/separator';
import type { SharedData } from '@/types';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';

const sidebarNavItems: NavItem[] = [
    {
        title: 'General Settings',
        href: route('settings.index'),
    },
    {
        title: 'Site Users',
        href: route('settings.users.index'),
    },
    {
        title: 'Activity Log',
        href: route('settings.activity.index'),
    },
    {
        title: 'Assets',
        href: route('settings.media-items.index'),
    },
];

const page = usePage<SharedData>();

const currentPath = page.props.ziggy?.location ? new URL(page.props.ziggy.location).pathname : '';
</script>

<template>
    <div class="px-4 py-6">
        <Heading title="General Settings" description="Manage your staff and general site settings." />

        <div class="flex flex-col space-y-8 md:space-y-0 lg:flex-row lg:space-y-0 lg:space-x-12">
            <aside class="w-full max-w-xl lg:w-48">
                <nav class="flex flex-col space-y-1 space-x-0">
                    <Button
                        v-for="item in sidebarNavItems"
                        :key="item.href"
                        variant="ghost"
                        :class="['w-full justify-start', { 'bg-muted': currentPath === item.href }]"
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
