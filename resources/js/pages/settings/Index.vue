<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';

import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'General settings',
        href: route('setting.index'),
    },
];

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="General settings" />
        <SettingsLayout>

        </SettingsLayout>
    </AppLayout>
</template>
