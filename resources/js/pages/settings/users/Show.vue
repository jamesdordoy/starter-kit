<script setup lang="ts">
import Datatable from '@/components/Datatable.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import type { PaginatedCollection } from '@/types/paginated-collection';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Users',
        href: route('settings.index'),
    },
];

interface Props {
    user: App.Data.UserData;
    params: {
        page: number;
        per_page: number;
        sortColumn: string;
        sortDirection: string;
        search: string;
    };
}

const props = defineProps<Props>();

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="General settings" />
        <SettingsLayout>
            <HeadingSmall title="User" description="View and manage your site Users" />

        </SettingsLayout>
    </AppLayout>
</template>
