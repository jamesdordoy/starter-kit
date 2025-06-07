<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
    href: string;
}

defineProps<Props>();
</script>

<template>
    <img :src="href" />
</template>
