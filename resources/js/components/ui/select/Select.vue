<script setup lang="ts">
// import { Icon } from '@iconify/vue'
import {
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectItemIndicator,
  SelectItemText,
  SelectLabel,
  SelectPortal,
  SelectRoot,
  SelectScrollDownButton,
  SelectScrollUpButton,
  SelectTrigger,
  SelectValue,
  SelectViewport,
} from 'reka-ui'
import { ChevronDownIcon, XMarkIcon } from '@heroicons/vue/24/outline';

interface Option {
  label: string;
  value: string | number;
}

interface Props {
  modelValue?: string | number;
  options: Option[];
  placeholder?: string;
  label?: string;
}

const props = withDefaults(defineProps<Props>(), {
  placeholder: 'Select an option...',
  label: undefined,
});

const emit = defineEmits(['update:modelValue']);
</script>

<template>
  <SelectRoot :model-value="modelValue" @update:model-value="emit('update:modelValue', $event)">
    <SelectTrigger
      class="inline-flex min-w-[160px] items-center justify-between rounded-lg px-[15px] text-xs leading-none h-[40px] gap-[5px] bg-white dark:bg-neutral-900 text-gray-900 dark:text-white hover:bg-neutral-50 dark:hover:bg-neutral-800 border border-neutral-200 dark:border-neutral-700 shadow-sm focus:shadow-[0_0_0_2px] focus:shadow-black dark:focus:shadow-white data-[placeholder]:text-gray-500 dark:data-[placeholder]:text-neutral-400 outline-none"
      aria-label="Customise options"
    >
      <SelectValue :placeholder="placeholder" />

      <ChevronDownIcon class="h-3.5 w-3.5" />
    </SelectTrigger>

    <SelectPortal>
      <SelectContent
        class="min-w-[160px] bg-white dark:bg-neutral-900 rounded-lg border border-neutral-200 dark:border-neutral-700 shadow-sm will-change-[opacity,transform] data-[side=top]:animate-slideDownAndFade data-[side=right]:animate-slideLeftAndFade data-[side=bottom]:animate-slideUpAndFade data-[side=left]:animate-slideRightAndFade z-[100]"
        :side-offset="5"
      >
        <SelectScrollUpButton class="flex items-center justify-center h-[25px] bg-white dark:bg-neutral-900 text-gray-900 dark:text-white cursor-default">
          <ChevronDownIcon class="h-3.5 w-3.5 rotate-180" />
        </SelectScrollUpButton>

        <SelectViewport class="p-[5px]">
          <SelectLabel v-if="label" class="px-[25px] text-xs leading-[25px] text-gray-500 dark:text-neutral-400">
            {{ label }}
          </SelectLabel>
          <SelectGroup>
            <SelectItem
              v-for="option in options"
              :key="option.value"
              class="text-xs leading-none text-gray-900 dark:text-white rounded-[3px] flex items-center h-[25px] pr-[35px] pl-[25px] relative select-none data-[disabled]:text-gray-400 dark:data-[disabled]:text-gray-500 data-[disabled]:pointer-events-none data-[highlighted]:outline-none data-[highlighted]:bg-neutral-100 dark:data-[highlighted]:bg-neutral-800 data-[highlighted]:text-gray-900 dark:data-[highlighted]:text-white"
              :value="option.value"
            >
              <SelectItemIndicator class="absolute left-0 w-[25px] inline-flex items-center justify-center">
                <XMarkIcon @click="emit('update:modelValue', null)" class="h-3.5 w-3.5" />
              </SelectItemIndicator>
              <SelectItemText>
                {{ option.label }}
              </SelectItemText>
            </SelectItem>
          </SelectGroup>
        </SelectViewport>

        <SelectScrollDownButton class="flex items-center justify-center h-[25px] bg-white dark:bg-neutral-900 text-gray-900 dark:text-white cursor-default">
          <ChevronDownIcon class="h-3.5 w-3.5" />
        </SelectScrollDownButton>
      </SelectContent>
    </SelectPortal>
  </SelectRoot>
</template>