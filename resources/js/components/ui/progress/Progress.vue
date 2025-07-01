<script setup lang="ts">
import { ProgressIndicator, ProgressRoot } from 'reka-ui'
import { onBeforeUnmount, onMounted, ref } from 'vue'

const props = defineProps({
  startValue: {
    type: Number,
    default: 0,
  },
})

const progressValue = ref(props.startValue)
const timer = ref()

onMounted(() => {
  timer.value = setInterval(() => {
    if (progressValue.value === 100) {
      progressValue.value = props.startValue
    }
    else {
      progressValue.value += 10
    }
  }, 2000)
})

onBeforeUnmount(() => {
  clearTimeout(timer.value)
})
</script>

<template>
  <ProgressRoot
    v-model="progressValue"
    class="rounded-full relative h-4 w-[300px] overflow-hidden bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700"
  >
    <ProgressIndicator
      class="indicator rounded-full block relative w-full h-full bg-blue-600 dark:bg-blue-500 transition-transform overflow-hidden duration-[660ms] ease-[cubic-bezier(0.65, 0, 0.35, 1)] after:animate-progress after:content-[''] after:absolute after:inset-0  after:bg-[linear-gradient(-45deg,_rgba(255,255,255,0.2)_25%,_transparent_25%,_transparent_50%,_rgba(255,255,255,0.2)_50%,_rgba(255,255,255,0.2)_75%,_transparent_75%,_transparent)] after:bg-[length:30px_30px]"
      :style="`transform: translateX(-${100 - progressValue}%)`"
    />
  </ProgressRoot>
</template>