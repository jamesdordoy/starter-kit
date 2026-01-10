<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Activity Log" />

        <SettingsLayout>
            <div class="space-y-6">
                <HeadingSmall title="Activity Log" description="View and filter system activity logs" />

                <div class="overflow-hidden bg-white shadow sm:rounded-lg dark:bg-gray-800">
                    <div class="px-4 py-5 sm:p-6">
                        <!-- Activity Header -->
                        <div class="mb-6 border-b border-gray-200 pb-4 dark:border-gray-700">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">
                                        {{ activity.data.description }}
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                        {{ activity.data.formatted_created_at }}
                                    </p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span
                                        class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-blue-700/10 ring-inset dark:bg-blue-400/10 dark:text-blue-400"
                                    >
                                        {{ activity.data.log_name }}
                                    </span>
                                    <span
                                        v-if="activity.data.causer"
                                        class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-gray-500/10 ring-inset dark:bg-gray-400/10 dark:text-gray-400"
                                    >
                                        By {{ activity.data.causer.name }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Changes Section -->
                        <div v-if="activity.data.properties" class="space-y-6">
                            <!-- File Upload Specific Display -->
                            <div
                                v-if="activity.data.log_name === 'media_added'"
                                class="rounded-lg border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800/50"
                            >
                                <h4 class="mb-3 text-sm font-medium text-gray-900 dark:text-gray-100">File Upload Details</h4>
                                <div class="space-y-4">
                                    <div v-for="(value, key) in activity.data.properties" :key="key" class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                fill-rule="evenodd"
                                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        <div class="flex flex-col">
                                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400">{{ formatFieldName(key) }}</span>
                                            <span class="text-sm text-gray-900 dark:text-gray-100">{{ formatValue(value) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Standard Changes Display -->
                            <div v-if="activity.data.properties.changes" class="space-y-4">
                                <div
                                    v-for="(changes, field) in activity.data.properties.changes"
                                    :key="field"
                                    class="rounded-lg border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800/50"
                                >
                                    <h4 class="mb-3 text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ formatFieldName(field) }}
                                    </h4>
                                    <div class="grid gap-4 sm:grid-cols-2">
                                        <div>
                                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Previous Value</p>
                                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                                {{ formatValue(changes.old) }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400">New Value</p>
                                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                                {{ formatValue(changes.new) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Properties -->
                            <div
                                v-if="Object.keys(activity.data.properties).length > 0"
                                class="rounded-lg border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800/50"
                            >
                                <h4 class="mb-3 text-sm font-medium text-gray-900 dark:text-gray-100">Additional Details</h4>
                                <div class="space-y-4">
                                    <div v-for="(value, key) in activity.data.properties" :key="key" class="flex items-start gap-2">
                                        <div class="flex flex-col">
                                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400">{{ formatFieldName(key) }}</span>
                                            <span class="text-sm text-gray-900 dark:text-gray-100">{{ formatValue(value) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- No Changes Message -->
                        <div
                            v-if="!activity.data.properties || Object.keys(activity.data.properties).length === 0"
                            class="rounded-lg border border-gray-200 bg-gray-50 p-4 text-center dark:border-gray-700 dark:bg-gray-800/50"
                        >
                            <p class="text-sm text-gray-500 dark:text-gray-400">No changes were recorded for this activity.</p>
                        </div>
                    </div>
                </div>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>

<script setup lang="ts">
import HeadingSmall from '@/components/HeadingSmall.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import type { BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Activity Log',
        href: '/settings/activity',
    },
    {
        title: 'View Activity',
        href: '#',
    },
];

interface Props {
    activity: App.Data.ActivityData[];
}

const props = defineProps<Props>();

const activity = props.activity;

const formatFieldName = (field: string | number): string => {
    return String(field)
        .split('_')
        .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
        .join(' ');
};

const formatValue = (value: any): string => {
    if (value === null || value === undefined) {
        return '—';
    }

    if (typeof value === 'boolean') {
        return value ? 'Yes' : 'No';
    }

    if (typeof value === 'object') {
        return JSON.stringify(value);
    }

    return String(value);
};
</script>
