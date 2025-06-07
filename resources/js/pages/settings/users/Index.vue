<script setup lang="ts">
import Datatable from '@/components/Datatable.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import type { PaginatedCollection } from '@/types/paginated-collection';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

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

const props = defineProps<Props>();

const cols = ref([
    { field: 'id', title: 'ID', width: '90px' },
    { field: 'name', title: 'Name' },
    { field: 'email', title: 'Email' },
    { field: 'email_verified_at', title: 'Email Verified At' },
    { field: 'actions', title: 'Actions', sort: false },
]);

const handleImpersonate = (data: any) => {
    window.location.href = route('settings.impersonate', { id: data.value.id });
};

const params = ref(props.params);

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="General settings" />
        <SettingsLayout>
            <HeadingSmall title="Users" description="View and manage your site Users" />
            <Datatable :columns="cols" :data="props.users" :reload="['users']" :params="params">
                <template #id="data">
                    {{ data.value.id }}
                </template>

                <template #name="data">
                    {{ data.value.name }}
                </template>

                <template #email="data">
                    {{ data.value.email }}
                </template>

                <template #email_verified_at="data">
                    {{ data.value.formatted_email_verified_at }}
                </template>

                <template #actions="data">
                    <a class="z-10 cursor-pointer text-blue-500 underline" @click="handleImpersonate(data)">
                        <font-awesome-icon icon="user-secret" />
                        Impersonate
                    </a>
                    <Link :href="route('settings.users.show', { user: data.value })"> View </Link>
                </template>
            </Datatable>
        </SettingsLayout>
    </AppLayout>
</template>
