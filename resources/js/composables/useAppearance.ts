import { ref, watch } from 'vue';

type Appearance = 'light' | 'dark' | 'system';

const appearance = ref<Appearance>((localStorage.getItem('appearance') as Appearance) || 'system');

watch(
    appearance,
    (value) => {
        localStorage.setItem('appearance', value);
        if (value === 'system') {
            document.documentElement.classList.remove('dark', 'light');
        } else {
            document.documentElement.classList.remove('dark', 'light');
            document.documentElement.classList.add(value);
        }
    },
    { immediate: true },
);

export const useAppearance = () => {
    const updateAppearance = (value: Appearance) => {
        appearance.value = value;
    };

    return {
        appearance,
        updateAppearance,
    };
};
