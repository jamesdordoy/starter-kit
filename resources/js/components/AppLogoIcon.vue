<script setup lang="ts">
import Logo from '#/assets/images/softvize-logo.svg';
import type { HTMLAttributes } from 'vue';

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
