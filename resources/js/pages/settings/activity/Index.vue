<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Activity Log" />

        <SettingsLayout>
            <div class="space-y-6">
                <HeadingSmall title="Activity Log" description="View and filter system activity logs" />

                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mb-6">
                            <div class="flex flex-col gap-4 sm:flex-row">
                                <div class="flex-1">
                                    <div class="grid gap-2">
                                        <Label for="log_name">Log Type</Label>
                                        <Select :options="activityOptions" v-model="params.filter.description" />
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="grid gap-2">
                                        <Label for="user">User</Label>
                                        <Select :options="userOptions" v-model="params.filter.causer_id" />
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="grid gap-2">
                                        <Label for="date_from">Date Range</Label>
                                        <DateRangePicker v-model="params.filter.date_range" />
                                    </div>
                                </div>
                                <div class="flex-1"></div>
                                <div class="flex-1"></div>
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
                                    :href="route('settings.activity.show', data.value.id)"
                                    class="ring-offset-background focus-visible:ring-ring hover:bg-primary/90 inline-flex h-10 items-center justify-center rounded-md bg-gray-300 px-4 py-2 text-sm font-medium text-gray-800 transition-colors focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:outline-none disabled:pointer-events-none disabled:opacity-50 dark:bg-neutral-900 dark:text-white"
                                >
                                    View Details
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
import { DateRangePicker } from '@/components/ui/date-range-picker';
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
        href: '/settings/activity',
    },
];

interface Props {
    activities: PaginatedCollection<App.Data.ActivityData>;
    users: Collection<App.Data.UserData>;
    params: App.QueryBuilder.Data.QueryBuilderParams;
}

interface Column {
    field: string;
    title: string;
    sort?: boolean;
}

const props = defineProps<Props>();

const cols = ref<Column[]>([
    { field: 'created_at', title: 'Date' },
    { field: 'log_name', title: 'Type' },
    { field: 'causer', title: 'User' },
    { field: 'description', title: 'Description' },
    { field: 'properties', title: '', sort: false },
]);

interface ActivityOption {
    value: App.Enums.ActivityLogEnum | null;
    label: string;
}

const activityOptions = ref<ActivityOption[]>([
    { value: null, label: 'All' },
    { value: 'created', label: 'Created' },
    { value: 'updated', label: 'Updated' },
    { value: 'deleted', label: 'Deleted' },
    { value: 'restored', label: 'Restored' },
    { value: 'forceDeleted', label: 'Force Deleted' },
    { value: 'login', label: 'Login' },
    { value: 'logout', label: 'Logout' },
]);

const userOptions = ref([
    {
        value: null,
        label: 'All Users',
    },
    ...props.users.data.map((user) => ({
        value: user.id,
        label: user.name,
    })),
]);

const params = ref({
    ...props.params,
} as App.QueryBuilder.Data.QueryBuilderParams);

const formatDate = (date: string) => {
    return new Date(date).toLocaleString();
};

watch(
    params,
    (newParams) => {
        router.get(route('settings.activity.index'), newParams, { preserveState: true, preserveScroll: true });
    },
    { deep: true },
);
</script>
