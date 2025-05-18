<script setup lang="ts">
import { computed } from 'vue';
import { cn } from '@/lib/utils';

const props = defineProps<{
    modelValue?: string | number;
    class?: string;
}>();

const emit = defineEmits<{
    (e: 'update:modelValue', value: string | number): void;
}>();

const value = computed({
    get: () => props.modelValue,
    set: (value) => emit('update:modelValue', value),
});
</script>

<template>
    <select
        v-model="value"
        :class="cn(
            'block w-full rounded-md border border-input bg-transparent px-3 py-1.5 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300',
            props.class
        )"
    >
        <slot />
    </select>
</template> 