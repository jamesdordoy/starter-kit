import { defineStore } from 'pinia';
import { ref, watch } from 'vue';

type Theme = 'light' | 'dark' | 'system';

export const useAppearanceStore = defineStore('appearance', () => {
    const theme = ref<Theme>(localStorage.getItem('theme') as Theme || 'system');
    const sidebarCollapsed = ref(localStorage.getItem('sidebarCollapsed') === 'true');
    const fontSize = ref(localStorage.getItem('fontSize') || 'medium');

    // Function to get system preference
    const getSystemTheme = () => {
        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    };

    // Function to apply theme
    const applyTheme = (newTheme: Theme) => {
        const effectiveTheme = newTheme === 'system' ? getSystemTheme() : newTheme;
        document.documentElement.classList.remove('light', 'dark');
        document.documentElement.classList.add(effectiveTheme);
    };

    // Watch for theme changes and update localStorage and document
    watch(theme, (newTheme) => {
        localStorage.setItem('theme', newTheme);
        applyTheme(newTheme);
    }, { immediate: true });

    // Watch for system theme changes
    if (typeof window !== 'undefined') {
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
            if (theme.value === 'system') {
                applyTheme('system');
            }
        });
    }

    // Watch for sidebar state changes
    watch(sidebarCollapsed, (newValue) => {
        localStorage.setItem('sidebarCollapsed', String(newValue));
    });

    // Watch for font size changes
    watch(fontSize, (newSize) => {
        localStorage.setItem('fontSize', newSize);
        document.documentElement.setAttribute('data-font-size', newSize);
    }, { immediate: true });

    function setTheme(newTheme: Theme) {
        theme.value = newTheme;
    }

    function toggleSidebar() {
        sidebarCollapsed.value = !sidebarCollapsed.value;
    }

    function setFontSize(size: 'small' | 'medium' | 'large') {
        fontSize.value = size;
    }

    return {
        theme,
        sidebarCollapsed,
        fontSize,
        setTheme,
        toggleSidebar,
        setFontSize,
    };
}); 