<script setup lang="ts">
import Datatable from '@/components/Datatable.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import type { PaginatedCollection } from '@/types/paginated-collection';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { index as settingsIndex } from '@/actions/App/Http/Controllers/Settings/SettingController';
import { index, show } from '@/actions/App/Http/Controllers/Settings/RoleController';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Roles',
        href: settingsIndex().url,
    },
];

const props = defineProps<{
    roles: PaginatedCollection<App.Data.RoleData>;
    params: {
        page: number;
        per_page: number;
        sortColumn: string;
        sortDirection: string;
        search: string;
    };
}>();

const cols = ref([
    { field: 'id', title: 'ID', width: '90px' },
    { field: 'name', title: 'Name' },
    { field: 'guard_name', title: 'Guard' },
    { field: 'permissions_count', title: 'Permissions' },
    { field: 'actions', title: 'Actions', sort: false },
]);

const params = ref(props.params);
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Roles" />
        <SettingsLayout>
            <HeadingSmall title="Roles" description="View and manage roles and their permissions" />
            <Datatable :columns="cols" :data="props.roles" :reload="['roles']" :params="params">
                <template #id="data">
                    {{ data.value.id }}
                </template>

                <template #name="data">
                    {{ data.value.name }}
                </template>

                <template #guard_name="data">
                    <span class="rounded-md bg-neutral-100 px-2 py-1 text-xs text-neutral-700 dark:bg-neutral-800 dark:text-neutral-300">
                        {{ data.value.guard_name }}
                    </span>
                </template>

                <template #permissions_count="data">
                    {{ data.value.permissions?.length ?? data.value.permissions_count ?? 0 }}
                </template>

                <template #actions="data">
                    <div class="flex gap-2">
                        <Link
                            v-if="data.value.id"
                            :href="show({ role: data.value.id }).url"
                            class="inline-flex items-center gap-1 rounded-md border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 focus:outline-none dark:border-gray-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800"
                        >
                            <font-awesome-icon icon="eye" />
                            View
                        </Link>
                    </div>
                </template>
            </Datatable>
        </SettingsLayout>
    </AppLayout>
</template>
