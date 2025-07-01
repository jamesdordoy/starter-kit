<script setup lang="ts">
import { cn } from '@/lib/utils'
import {
    ToastProvider,
  type ToastProviderProps,
} from 'reka-ui'
import { computed, type HTMLAttributes } from 'vue'

const props = defineProps<ToastProviderProps & { class?: HTMLAttributes['class'] }>()


const delegatedProps = computed(() => {
  const { class: _, ...delegated } = props

  return delegated
});

</script>

<template>
  <ToastProvider
    data-slot="toast-provider"
    v-bind="delegatedProps">
    <slot />
  </ToastProvider>
</template>
