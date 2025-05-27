import { defineStore } from 'pinia';
import { ref, watch } from 'vue';

export const usePreferencesStore = defineStore('preferences', () => {
    const notificationsEnabled = ref(localStorage.getItem('notificationsEnabled') !== 'false');
    const language = ref(localStorage.getItem('language') || 'en');
    const timezone = ref(localStorage.getItem('timezone') || Intl.DateTimeFormat().resolvedOptions().timeZone);
    const dateFormat = ref(localStorage.getItem('dateFormat') || 'MM/DD/YYYY');

    // Watch for changes and update localStorage
    watch(notificationsEnabled, (newValue) => {
        localStorage.setItem('notificationsEnabled', String(newValue));
    });

    watch(language, (newValue) => {
        localStorage.setItem('language', newValue);
    });

    watch(timezone, (newValue) => {
        localStorage.setItem('timezone', newValue);
    });

    watch(dateFormat, (newValue) => {
        localStorage.setItem('dateFormat', newValue);
    });

    function toggleNotifications() {
        notificationsEnabled.value = !notificationsEnabled.value;
    }

    function setLanguage(lang: string) {
        language.value = lang;
    }

    function setTimezone(tz: string) {
        timezone.value = tz;
    }

    function setDateFormat(format: string) {
        dateFormat.value = format;
    }

    return {
        notificationsEnabled,
        language,
        timezone,
        dateFormat,
        toggleNotifications,
        setLanguage,
        setTimezone,
        setDateFormat,
    };
});
