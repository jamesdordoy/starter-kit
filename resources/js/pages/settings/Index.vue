<script setup lang="ts">
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

import HeadingSmall from '@/components/HeadingSmall.vue';
import Filepond from '@/components/ui/filepond/Filepond.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'General settings',
        href: route('settings.index'),
    },
];

interface Props {
    logo: App.Data.MediaData;
    system: object;
    database: object;
    cache: object;
    queue: object;
    storage: object;
    mail: object;
}

const props = defineProps<Props>();

const sections = [
    {
        title: 'System Overview',
        description: 'Details about your application environment',
        data: props.system,
    },
    {
        title: 'Database',
        description: 'Connection and driver details',
        data: props.database,
    },
    {
        title: 'Cache',
        description: 'Current cache driver',
        data: props.cache,
    },
    {
        title: 'Queue',
        description: 'Current queue driver',
        data: props.queue,
    },
    {
        title: 'Storage',
        description: 'Disk usage and config',
        data: props.storage,
    },
    {
        title: 'Mail',
        description: 'Mail driver and connection details',
        data: props.mail,
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="General settings" />

        <SettingsLayout>
            <section class="flex flex-col space-y-6">
                <HeadingSmall title="Website Logo" description="Update your website logo" />

                <div class="flex w-full max-w-md flex-col space-y-4">
                    <div
                        class="rounded-2xl border-2 border-dashed border-neutral-200 bg-white p-4 shadow-sm transition-all hover:border-neutral-300 sm:p-6 dark:border-neutral-700 dark:bg-neutral-900 dark:hover:border-neutral-600"
                    >
                        <Filepond :files="[logo]" :single="true" :route="route('settings.logo.update')" class="filepond--circular w-full" />
                    </div>
                </div>
            </section>

            <div class="mt-12 space-y-8">
                <HeadingSmall title="General Information" description="Update your website information" />

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

                    <div class="grid grid-cols-1 gap-x-8 gap-y-4 p-6 text-sm text-neutral-700 md:grid-cols-2 dark:text-neutral-300">
                        <template v-for="(value, key) in section.data" :key="key">
                            <div v-if="typeof value !== 'object' || value === null">
                                <dt class="font-medium text-neutral-600 capitalize dark:text-neutral-400">
                                    {{ key.replace(/_/g, ' ') }}
                                </dt>
                                <dd class="mt-1 text-neutral-900 dark:text-white">
                                    {{ value }}
                                </dd>
                            </div>

                            <template v-else>
                                <div v-for="(subValue, subKey) in value" :key="subKey">
                                    <dt class="font-medium text-neutral-600 capitalize dark:text-neutral-400">
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
