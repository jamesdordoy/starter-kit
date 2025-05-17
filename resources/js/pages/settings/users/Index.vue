<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { type BreadcrumbItem, type PaginatedCollection } from '@/types';
import { ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import UsersLayout from '@/layouts/settings/UsersLayout.vue';
const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Users',
        href: route('setting.index'),
    },
];

interface Props {
    users: PaginatedCollection;
}

const props = defineProps<Props>();

import Vue3Datatable from "@bhplugin/vue3-datatable";
import "@bhplugin/vue3-datatable/dist/style.css";

const cols = ref([
    { field: "id", title: "ID", width: "90px", filter: false },
    { field: "name", title: "Name" },
    { field: "email", title: "Email" },
]);

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="General settings" />
        <UsersLayout>
            <vue3-datatable :rows="props.users.data" :columns="cols"> </vue3-datatable>
        </UsersLayout>
    </AppLayout>
</template>
