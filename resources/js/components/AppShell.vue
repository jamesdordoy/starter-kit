<script setup lang="ts">
import { SidebarProvider } from '@/components/ui/sidebar';
import { useAppearanceStore } from '@/stores/appearance';

interface Props {
    variant?: 'header' | 'sidebar';
}

defineProps<Props>();

const appearanceStore = useAppearanceStore();
</script>

<template>
    <div v-if="variant === 'header'" class="flex min-h-screen w-full flex-col">
        <slot />
    </div>
    <SidebarProvider v-else :default-open="!appearanceStore.sidebarCollapsed">
        <slot />
    </SidebarProvider>
</template>
