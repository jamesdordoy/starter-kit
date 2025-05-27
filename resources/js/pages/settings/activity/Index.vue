<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Activity Log" />

        <SettingsLayout>
            <div class="space-y-6">
                <HeadingSmall title="Activity Log" description="View and filter system activity logs" />

                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mb-6">
                            <div class="flex flex-col gap-4 sm:flex-row">
                                <div class="flex-1">
                                    <div class="grid gap-2">
                                        <Label for="log_name">Log Type</Label>
                                        <Select v-model="params.filter.description">
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
                                        <Select v-model="params.filter.causer_id">
                                            <option value="">All Users</option>
                                            <option v-for="user in users.data" :key="user.id?.toString()" :value="user.id">
                                                {{ user.name }}
                                            </option>
                                        </Select>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="grid gap-2">
                                        <Label for="date_from">Date From</Label>
                                        <Input id="date_from" v-model="params.filter.date_from" type="date" class="mt-1 block w-full" />
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="grid gap-2">
                                        <Label for="date_to">Date To</Label>
                                        <Input id="date_to" v-model="params.filter.date_to" type="date" class="mt-1 block w-full" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <Datatable :columns="cols" :data="activities" :reload="['activities']" :params="params">
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
                                <Link
                                    :href="route('settings.activity-log.show', data.value.id)"
                                    class="ring-offset-background focus-visible:ring-ring bg-primary text-primary-foreground hover:bg-primary/90 inline-flex h-10 items-center justify-center rounded-md px-4 py-2 text-sm font-medium transition-colors focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:outline-none disabled:pointer-events-none disabled:opacity-50"
                                >
                                    View Changes
                                </Link>
                            </template>
                        </Datatable>
                    </div>
                </div>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>

<script setup lang="ts">
import Datatable from '@/components/Datatable.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select } from '@/components/ui/select';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import type { BreadcrumbItem } from '@/types';
import type { Collection } from '@/types/collection';
import type { PaginatedCollection } from '@/types/paginated-collection';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Activity Log',
        href: '/settings/activity-log',
    },
];

interface Props {
    activities: PaginatedCollection<App.Data.ActivityData>;
    users: Collection<App.Data.UserData>;
    params: {
        filter?: string[];
    };
}

const props = defineProps<Props>();

const cols = ref([
    { field: 'created_at', title: 'Date' },
    { field: 'log_name', title: 'Type' },
    { field: 'causer', title: 'User' },
    { field: 'description', title: 'Description' },
    { field: 'properties', title: '', sort: false },
]);

const params = ref({
    filter: props.params.length > 0 || {
        description: '',
        causer_id: '',
        date_from: '',
        date_to: '',
    },
    page: 1,
    per_page: 15,
    sort: 'created_at',
});

const formatDate = (date: string) => {
    return new Date(date).toLocaleString();
};

watch(
    params,
    (newParams) => {
        console.log(newParams);
        router.get(route('settings.activity-log.index'), newParams, { preserveState: true, preserveScroll: true });
    },
    { deep: true },
);
</script>
