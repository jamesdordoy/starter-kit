<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';

import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import Filepond from '@/components/ui/filepond/Filepond.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'General settings',
        href: route('settings.index'),
    },
];

const { system, database, cache, queue, storage, mail } = usePage().props;

const sections = [
    {
        title: 'System Overview',
        description: 'Details about your application environment',
        data: system,
    },
    {
        title: 'Database',
        description: 'Connection and driver details',
        data: database,
    },
    {
        title: 'Cache',
        description: 'Current cache driver',
        data: cache,
    },
    {
        title: 'Queue',
        description: 'Current queue driver',
        data: queue,
    },
    {
        title: 'Storage',
        description: 'Disk usage and config',
        data: storage,
    },
    {
        title: 'Mail',
        description: 'Mail driver and connection details',
        data: mail,
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="General settings" />

        <SettingsLayout>
            <Filepond />

            <div class="mt-12 space-y-8">
                <section
                    v-for="section in sections"
                    :key="section.title"
                    class="rounded-lg border border-neutral-200 bg-white shadow-sm dark:border-neutral-700 dark:bg-neutral-900"
                >
                    <div class="border-b border-neutral-200 px-6 py-4 dark:border-neutral-700">
                        <h2 class="text-base font-semibold text-neutral-800 dark:text-white">
                            {{ section.title }}
                        </h2>
                        <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">
                            {{ section.description }}
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 p-6 text-sm text-neutral-700 dark:text-neutral-300">
                        <template v-for="(value, key) in section.data" :key="key">
                            <div v-if="typeof value !== 'object' || value === null">
                                <dt class="font-medium capitalize text-neutral-600 dark:text-neutral-400">
                                    {{ key.replace(/_/g, ' ') }}
                                </dt>
                                <dd class="mt-1 text-neutral-900 dark:text-white">
                                    {{ value }}
                                </dd>
                            </div>

                            <template v-else>
                                <div
                                    v-for="(subValue, subKey) in value"
                                    :key="subKey"
                                >
                                    <dt class="font-medium capitalize text-neutral-600 dark:text-neutral-400">
                                        {{ key.replace(/_/g, ' ') }} – {{ subKey.replace(/_/g, ' ') }}
                                    </dt>
                                    <dd class="mt-1 text-neutral-900 dark:text-white">
                                        {{ subValue }}
                                    </dd>
                                </div>
                            </template>
                        </template>
                    </div>
                </section>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
