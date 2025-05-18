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
                                        <Label for="date_from">Date From</Label>
                                        <Input
                                            id="date_from"
                                            v-model="filters.date_from"
                                            type="date"
                                            class="mt-1 block w-full"
                                        />
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="grid gap-2">
                                        <Label for="date_to">Date To</Label>
                                        <Input
                                            id="date_to"
                                            v-model="filters.date_to"
                                            type="date"
                                            class="mt-1 block w-full"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <Datatable
                            :columns="cols"
                            :data="activities"
                            :reload="['activities']"
                            :params="params"
                        >
                            <template #created_at="data">
                                {{ formatDate(data.value.created_at) }}
                            </template>
                            <template #log_name="data">
                                {{ data.value.log_name }}
                            </template>
                            <template #causer="data">
                                {{ data.value.causer?.name || 'System' }}
                            </template>
                            <template #description="data">
                                {{ data.value.description }}
                            </template>
                            <template #properties="data">
                                <pre class="text-xs whitespace-pre-wrap">{{ JSON.stringify(data.value.properties, null, 2) }}</pre>
                            </template>
                        </Datatable>
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
import Datatable from '@/components/Datatable.vue';
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
        date_from?: string;
        date_to?: string;
        search?: string;
    };
}

const props = defineProps<Props>();

const cols = ref([
    { field: "created_at", title: "Date" },
    { field: "log_name", title: "Type" },
    { field: "causer", title: "User" },
    { field: "description", title: "Description" },
    { field: "properties", title: "Details" },
]);

const params = {
    page: 1,
    per_page: 15,
    sortColumn: 'created_at',
    sortDirection: 'desc',
    search: '',
};

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