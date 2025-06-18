<script setup lang="ts">
import {
  DateRangePickerArrow,
  DateRangePickerCalendar,
  DateRangePickerCell,
  DateRangePickerCellTrigger,
  DateRangePickerContent,
  DateRangePickerField,
  DateRangePickerGrid,
  DateRangePickerGridBody,
  DateRangePickerGridHead,
  DateRangePickerGridRow,
  DateRangePickerHeadCell,
  DateRangePickerHeader,
  DateRangePickerHeading,
  DateRangePickerInput,
  DateRangePickerNext,
  DateRangePickerPrev,
  DateRangePickerRoot,
  DateRangePickerTrigger,
  Label,
} from 'reka-ui';
import type { DateRange } from 'reka-ui';

import { CalendarIcon, ChevronLeftIcon, ChevronRightIcon, ChevronDownIcon, XMarkIcon  } from '@heroicons/vue/24/outline';


interface Props {
  modelValue?: DateRange;
  placeholder?: string;
  label?: string;
}

const props = withDefaults(defineProps<Props>(), {
  placeholder: 'Select date range...',
  label: undefined,
});

const emit = defineEmits(['update:modelValue']);


</script>

<template>
  <div class="flex flex-col gap-2">
    <DateRangePickerRoot
      :model-value="modelValue"
      @update:model-value="emit('update:modelValue', $event)"
      locale="gb"
    >
      <DateRangePickerField
        v-slot="{ segments }"
        class="inline-flex min-w-[160px] items-center justify-between rounded-lg px-[15px] text-xs leading-none h-[35px] gap-[5px] bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 hover:bg-gray-50 dark:hover:bg-gray-700 border border-gray-200 dark:border-gray-700 shadow-sm focus:shadow-[0_0_0_2px] focus:shadow-black dark:focus:shadow-white data-[placeholder]:text-gray-500 dark:data-[placeholder]:text-gray-400 outline-none"
      >
        <div class="flex items-center gap-0.5">
          <template
            v-for="item in segments.start"
            :key="item.part"
          >
            <DateRangePickerInput
              v-if="item.part === 'literal'"
              :part="item.part"
              type="start"
            >
              {{ item.value }}
            </DateRangePickerInput>
            <DateRangePickerInput
              v-else
              :part="item.part"
              class="rounded-md p-0.5 focus:outline-none focus:shadow-[0_0_0_2px] focus:shadow-black dark:focus:shadow-white data-[placeholder]:text-gray-500 dark:data-[placeholder]:text-gray-400"
              type="start"
            >
              {{ item.value }}
            </DateRangePickerInput>
          </template>
        </div>

        <span class="mx-1 text-gray-500 dark:text-gray-400">-</span>

        <div class="flex items-center gap-0.5">
          <template
            v-for="item in segments.end"
            :key="item.part"
          >
            <DateRangePickerInput
              v-if="item.part === 'literal'"
              :part="item.part"
              type="end"
            >
              {{ item.value }}
            </DateRangePickerInput>
            <DateRangePickerInput
              v-else
              :part="item.part"
              class="rounded-md p-0.5 focus:outline-none focus:shadow-[0_0_0_2px] focus:shadow-black dark:focus:shadow-white data-[placeholder]:text-gray-500 dark:data-[placeholder]:text-gray-400"
              type="end"
            >
              {{ item.value }}
            </DateRangePickerInput>
          </template>
        </div>

        <div class="flex">
          <DateRangePickerTrigger class="ml-2 focus:shadow-[0_0_0_2px] focus:shadow-black dark:focus:shadow-white focus:outline-none rounded p-1">
            <CalendarIcon class="w-4 h-4 text-gray-500 dark:text-gray-400" />
          </DateRangePickerTrigger>
          <XMarkIcon v-show="modelValue" @click="emit('update:modelValue', null)" class="w-4 h-4 mt-1 ml-1 text-gray-500 dark:text-gray-400" />
        </div>
      </DateRangePickerField>

      <DateRangePickerContent
        :side-offset="4"
        class="min-w-[160px] bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm will-change-[opacity,transform] data-[side=top]:animate-slideDownAndFade data-[side=right]:animate-slideLeftAndFade data-[side=bottom]:animate-slideUpAndFade data-[side=left]:animate-slideRightAndFade z-[100]"
      >
        <DateRangePickerArrow class="fill-white dark:fill-gray-800 stroke-gray-200 dark:stroke-gray-700" />
        <DateRangePickerCalendar
          v-slot="{ weekDays, grid }"
          class="p-4"
        >
          <DateRangePickerHeader class="flex items-center justify-between">
            <DateRangePickerPrev
              class="inline-flex items-center cursor-pointer text-gray-900 dark:text-gray-100 justify-center rounded-md bg-transparent w-7 h-7 hover:bg-gray-100 dark:hover:bg-gray-700 active:scale-98 active:transition-all focus:shadow-[0_0_0_2px] focus:shadow-black dark:focus:shadow-white"
            >
              <ChevronLeftIcon class="w-4 h-4" />
            </DateRangePickerPrev>

            <DateRangePickerHeading class="text-sm text-gray-900 dark:text-gray-100 font-medium" />
            <DateRangePickerNext
              class="inline-flex items-center cursor-pointer text-gray-900 dark:text-gray-100 justify-center rounded-md bg-transparent w-7 h-7 hover:bg-gray-100 dark:hover:bg-gray-700 active:scale-98 active:transition-all focus:shadow-[0_0_0_2px] focus:shadow-black dark:focus:shadow-white"
            >
              <ChevronRightIcon class="w-4 h-4" />
            </DateRangePickerNext>
          </DateRangePickerHeader>
          <div class="flex flex-col space-y-4 pt-4 sm:flex-row sm:space-x-4 sm:space-y-0">
            <DateRangePickerGrid
              v-for="month in grid"
              :key="month.value.toString()"
              class="w-full border-collapse select-none space-y-1"
            >
              <DateRangePickerGridHead>
                <DateRangePickerGridRow class="mb-1 flex w-full justify-between">
                  <DateRangePickerHeadCell
                    v-for="day in weekDays"
                    :key="day"
                    class="w-8 rounded-md text-xs !font-normal text-gray-500 dark:text-gray-400"
                  >
                    {{ day }}
                  </DateRangePickerHeadCell>
                </DateRangePickerGridRow>
              </DateRangePickerGridHead>
              <DateRangePickerGridBody>
                <DateRangePickerGridRow
                  v-for="(weekDates, index) in month.rows"
                  :key="`weekDate-${index}`"
                  class="flex w-full"
                >
                  <DateRangePickerCell
                    v-for="weekDate in weekDates"
                    :key="weekDate.toString()"
                    :date="weekDate"
                  >
                    <DateRangePickerCellTrigger
                      :day="weekDate"
                      :month="month.value"
                      class="relative flex items-center justify-center rounded-full whitespace-nowrap text-sm font-normal text-gray-900 dark:text-gray-100 w-8 h-8 outline-none focus:shadow-[0_0_0_2px] focus:shadow-black dark:focus:shadow-white data-[outside-view]:text-gray-400 dark:data-[outside-view]:text-gray-500 data-[selected]:!bg-gray-900 dark:data-[selected]:!bg-gray-100 data-[selected]:text-white dark:data-[selected]:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700 data-[highlighted]:bg-gray-100 dark:data-[highlighted]:bg-gray-700 data-[unavailable]:pointer-events-none data-[unavailable]:text-gray-400 dark:data-[unavailable]:text-gray-500 data-[unavailable]:line-through before:absolute before:top-[5px] before:hidden before:rounded-full before:w-1 before:h-1 before:bg-gray-900 dark:before:bg-gray-100 data-[today]:before:block"
                    />
                  </DateRangePickerCell>
                </DateRangePickerGridRow>
              </DateRangePickerGridBody>
            </DateRangePickerGrid>
          </div>
        </DateRangePickerCalendar>
      </DateRangePickerContent>
    </DateRangePickerRoot>
  </div>
</template>