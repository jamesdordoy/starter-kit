<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Activity Log" />

        <SettingsLayout>
            <div class="space-y-6">
                <HeadingSmall 
                    title="Activity Log" 
                    description="View and filter system activity logs"
                />

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mb-6">
                            <div class="flex flex-col sm:flex-row gap-4">
                                <div class="flex-1">
                                    <div class="grid gap-2">
                                        <Label for="log_name">Log Type</Label>
                                        <Select v-model="filters.log_name">
                                            <option value="">All Types</option>
                                            <option value="login">Login</option>
                                            <option value="logout">Logout</option>
                                            <option value="created">Created</option>
                                            <option value="updated">Updated</option>
                                            <option value="deleted">Deleted</option>
                                        </Select>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="grid gap-2">
                                        <Label for="user">User</Label>
                                        <Select v-model="filters.causer_id">
                                            <option value="">All Users</option>
                                            <option 
                                                v-for="user in activities.data.filter(activity => activity.causer).map(activity => activity.causer)" 
                                                :key="user.id" 
                                                :value="user.id"
                                            >
                                                {{ user.name }}
                                            </option>
                                        </Select>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="grid gap-2">
                                        <Label for="date_range">Date Range</Label>
                                        <Input
                                            id="date_range"
                                            v-model="filters.date"
                                            type="date"
                                            class="mt-1 block w-full"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <DataTable
                            :data="activities"
                            :reload="['activities']"
                            :columns="columns"
                            :filters="filters"
                            @update:filters="updateFilters"
                        >
                            <template #cell(created_at)="{ value }">
                                {{ formatDate(value) }}
                            </template>
                            <template #cell(causer)="{ value }">
                                {{ value?.name || 'System' }}
                            </template>
                            <template #cell(properties)="{ value }">
                                <pre class="text-xs whitespace-pre-wrap">{{ JSON.stringify(value, null, 2) }}</pre>
                            </template>
                        </DataTable>
                    </div>
                </div>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import DataTable from '@/components/DataTable.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import { Head } from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select } from '@/components/ui/select';
import type { ActivityLog } from '@/types/activity-log';
import type { BreadcrumbItem } from '@/types';
import type { PaginatedCollection } from '@/types/datatable';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Activity Log',
        href: '/settings/activity-log',
    },
];

interface Props {
    activities: PaginatedCollection<ActivityLog>;
    filters: {
        log_name?: string;
        causer_id?: string;
        date?: string;
    };
}

const props = defineProps<Props>();

const columns = [
    { key: 'created_at', label: 'Date' },
    { key: 'log_name', label: 'Type' },
    { key: 'causer', label: 'User' },
    { key: 'description', label: 'Description' },
    { key: 'properties', label: 'Details' },
];

const formatDate = (date: string) => {
    return new Date(date).toLocaleString();
};

const updateFilters = (newFilters: typeof props.filters) => {
    router.get(
        route('settings.activity-log'),
        newFilters,
        { preserveState: true, preserveScroll: true }
    );
};
</script> 