<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import Logo from '#/assets/images/softvize-logo.svg';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <img :src="Logo" />
</template>
