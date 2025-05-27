<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';

import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import Filepond from '@/components/ui/filepond/Filepond.vue';
const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'General settings',
        href: route('settings.index'),
    },
];

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="General settings" />
        <SettingsLayout>
            <Filepond />
        </SettingsLayout>
    </AppLayout>
</template>
