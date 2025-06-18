<script setup lang="ts">
import { CalendarIcon, ChevronLeftIcon, ChevronRightIcon, ChevronDownIcon, XMarkIcon, ArrowLeftIcon, ArrowRightIcon  } from '@heroicons/vue/24/outline';
import { PaginationEllipsis, PaginationFirst, PaginationLast, PaginationList, PaginationListItem, PaginationNext, PaginationPrev, PaginationRoot } from 'reka-ui'
import { computed, ref } from 'vue';
import type { PaginatedCollection } from '@/types/paginated-collection';

interface Props {
    data?: PaginatedCollection<any>;
}

const props = defineProps<Props>();

// Compute pagination values from Laravel data
const total = computed(() => props.data?.meta?.total ?? 0);
const currentPage = ref(props.data.meta.current_page ?? 1);
const perPage = computed(() => props.data?.meta?.per_page ?? 10);

// Emit page change events
const emit = defineEmits<{
    (e: 'update:page', page: number): void
}>();

const handlePageChange = (page: number) => {
    emit('update:page', page);
};
</script>

<template>
  <div class="sm:flex sm:flex-1 sm:items-center sm:justify-between">
    <div class="hidden sm:block">
      <p class="text-sm text-gray-700 dark:text-gray-300">
        Showing
        <span class="font-medium">{{ data?.meta?.from }}</span>
        to
        <span class="font-medium">{{ data?.meta?.to }}</span>
        of
        <span class="font-medium">{{ data?.meta?.total }}</span>
        results
      </p>
    </div>
    <div>
      <PaginationRoot
        v-model:page="currentPage"
        :total="total"
        :items-per-page="perPage"
        :sibling-count="1"
        show-edges
        @update:page="handlePageChange"
      >
        <PaginationList
          v-slot="{ items }"
          class="flex items-center gap-1"
        >
          <PaginationFirst class="w-9 h-9 flex items-center justify-center bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700 rounded-lg hover:bg-neutral-50 dark:hover:bg-neutral-800 transition disabled:opacity-50 shadow-sm">
            <ArrowLeftIcon class="w-5 h-5 text-gray-700 dark:text-gray-300" />
          </PaginationFirst>
          <PaginationPrev class="w-9 h-9 flex items-center justify-center bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700 rounded-lg hover:bg-neutral-50 dark:hover:bg-neutral-800 transition mr-4 disabled:opacity-50 shadow-sm">
            <ChevronLeftIcon class="w-5 h-5 text-gray-700 dark:text-gray-300" />
          </PaginationPrev>
          <template v-for="(page, index) in items">
            <PaginationListItem
              v-if="page.type === 'page'"
              :key="index"
              class="w-9 h-9 flex items-center justify-center bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700 rounded-lg data-[selected]:!bg-neutral-900 dark:data-[selected]:!bg-white data-[selected]:!text-white dark:data-[selected]:!text-neutral-900 hover:bg-neutral-50 dark:hover:bg-neutral-800 transition shadow-sm"
              :value="page.value"
            >
              {{ page.value }}
            </PaginationListItem>
            <PaginationEllipsis
              v-else
              :key="page.type"
              :index="index"
              class="w-9 h-9 flex items-center justify-center text-gray-700 dark:text-white"
            >
              &#8230;
            </PaginationEllipsis>
          </template>
          <PaginationNext class="w-9 h-9 flex items-center justify-center bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700 rounded-lg hover:bg-neutral-50 dark:hover:bg-neutral-800 transition ml-4 disabled:opacity-50 shadow-sm">
            <ChevronRightIcon class="w-5 h-5 text-gray-700 dark:text-gray-300" />
          </PaginationNext>
          <PaginationLast class="w-9 h-9 flex items-center justify-center bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700 rounded-lg hover:bg-neutral-50 dark:hover:bg-neutral-800 transition disabled:opacity-50 shadow-sm">
            <ArrowRightIcon class="w-5 h-5 text-gray-700 dark:text-gray-300" />
          </PaginationLast>
        </PaginationList>
      </PaginationRoot>
    </div>
  </div>
</template>