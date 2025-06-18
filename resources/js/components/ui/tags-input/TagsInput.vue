<script setup lang="ts" generic="T extends { id: number | null; name: string; email?: string; [key: string]: any }">
import Multiselect from 'vue-multiselect'
import { computed, ref } from 'vue'
import { ChevronDownIcon } from '@heroicons/vue/24/outline'

type SearchableField = keyof Pick<T, 'name' | 'email'>;

interface Props {
    modelValue: T[];
    items: T[];
    placeholder?: string;
    displayField?: SearchableField;
    searchFields?: SearchableField[];
}

const props = withDefaults(defineProps<Props>(), {
    placeholder: 'Select items...',
    displayField: 'name' as SearchableField,
    searchFields: () => ['name', 'email'] as SearchableField[]
});

const emit = defineEmits<{
    'update:modelValue': [value: T[]];
}>();

const selected = computed({
    get: () => props.modelValue,
    set: (value) => emit('update:modelValue', value)
});

const customLabel = (option: T) => {
    const value = option[props.displayField] as string | undefined;
    return value ?? '';
};
</script>

<template>
    <Multiselect
        v-model="selected"
        :options="items"
        :multiple="true"
        :close-on-select="false"
        :clear-on-select="false"
        :preserve-search="true"
        :placeholder="placeholder"
        :custom-label="customLabel"
        :preselect-first="false"
        :searchable="true"
        :allow-empty="true"
        :track-by="displayField"
        class="multiselect-custom bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700 rounded-lg shadow-sm"
        select-label=""
    >
        <template #caret="{ toggle }">
            <div class="multiselect__select" @mousedown.stop="toggle">
                <ChevronDownIcon class="h-3.5 w-3.5 text-gray-400 dark:text-gray-600" />
            </div>
        </template>
    </Multiselect>
</template>

<style>

</style>
  
<!-- Add Multiselect CSS. Can be added as a static asset or inside a component. -->
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
  
 