<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { type BreadcrumbItem, type PaginatedCollection } from '@/types';
import { ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import Datatable from '@/components/Datatable.vue';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Users',
        href: route('settings.index'),
    },
];

interface Props {
    users: PaginatedCollection;
}

const props = defineProps<Props>();


const cols = ref([
    { field: "id", title: "ID", width: "90px", filter: false },
    { field: "name", title: "Name" },
    { field: "email", title: "Email" },
    { field: "email_verified_at", title: "Email Verified At" },
]);

const params = {
    page: 1,
    per_page: 15,
    sortColumn: 'id',
    sortDirection: 'asc',
    search: '',
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="General settings" />
        <SettingsLayout>
            <Datatable
                :columns="cols"
                :data="props.users"
                :reload="['users']"
                :params="params">

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
            </Datatable>
        </SettingsLayout>
    </AppLayout>
</template>
