<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import type { PaginatedCollection } from '@/types/paginated-collection';
import { Head } from '@inertiajs/vue3';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Users',
        href: route('settings.index'),
    },
];

interface Props {
    users: PaginatedCollection<App.Data.UserData>;
    params: {
        page: number;
        per_page: number;
        sortColumn: string;
        sortDirection: string;
        search: string;
    };
}
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="General settings" />
        <SettingsLayout> </SettingsLayout>
    </AppLayout>
</template>
