<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { usePage } from '@inertiajs/vue3';
const appName = usePage().props.name;
</script>

<template>
    <div class="flex flex-col">
        <div class="text-sidebar-primary-foreground aspect-square size-8 w-full items-center justify-center rounded-md">
            <AppLogoIcon class="size-5 fill-current text-white dark:text-black" />
        </div>
        <div class="ml-1 text-left text-sm">
            <span class="mb-0.5 truncate leading-none font-semibold">{{ appName }}</span>
        </div>
    </div>
</template>
