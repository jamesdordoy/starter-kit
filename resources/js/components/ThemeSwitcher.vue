<template>
    <div class="relative">
        <button
            @click="isOpen = !isOpen"
            class="flex items-center space-x-2 rounded-lg px-3 py-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800"
            type="button"
        >
            <SunIcon v-if="appearance.theme === 'light'" class="h-5 w-5" />
            <MoonIcon v-else-if="appearance.theme === 'dark'" class="h-5 w-5" />
            <ComputerDesktopIcon v-else class="h-5 w-5" />
            <span class="sr-only">Toggle theme</span>
        </button>

        <div v-if="isOpen" class="ring-opacity-5 absolute right-0 z-50 mt-2 w-48 rounded-md bg-white shadow-lg ring-1 ring-black dark:bg-gray-800">
            <div class="py-1" role="menu">
                <button
                    v-for="option in themeOptions"
                    :key="option.value"
                    @click="selectTheme(option.value)"
                    class="flex w-full items-center space-x-2 px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                    :class="{ 'bg-gray-50 dark:bg-gray-700': appearance.theme === option.value }"
                    role="menuitem"
                >
                    <component :is="option.icon" class="h-5 w-5" />
                    <span>{{ option.label }}</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useAppearanceStore } from '@/stores/appearance';
import { ComputerDesktopIcon, MoonIcon, SunIcon } from '@heroicons/vue/24/outline';
import { ref } from 'vue';

type Theme = 'light' | 'dark' | 'system';

const appearance = useAppearanceStore();
const isOpen = ref(false);

const themeOptions = [
    { value: 'light' as Theme, label: 'Light', icon: SunIcon },
    { value: 'dark' as Theme, label: 'Dark', icon: MoonIcon },
    { value: 'system' as Theme, label: 'System', icon: ComputerDesktopIcon },
];

function selectTheme(theme: Theme) {
    appearance.setTheme(theme);
    isOpen.value = false;
}

// Close dropdown when clicking outside
if (typeof window !== 'undefined') {
    window.addEventListener('click', (e) => {
        const target = e.target as HTMLElement;
        if (!target.closest('.relative')) {
            isOpen.value = false;
        }
    });
}
</script>
