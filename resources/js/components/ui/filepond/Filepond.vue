<template>
    <file-pond
        name="test"
        ref="pond"
        class="my-pond"
        label-idle="Drop files here or click to browse"
        allow-multiple="true"
        accepted-file-types="image/jpeg, image/png"
        v-on:init="handleFilePondInit"
        @updatefiles="handleFilePondUpdate"
    />
</template>

<script setup lang="ts">
// Import FilePond
import vueFilePond from 'vue-filepond';

// Import plugins
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.esm.js';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.js';

// Import styles
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
import { ref, useTemplateRef } from 'vue';

// Create FilePond component
const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview);

const myFiles = ref(['index.html']);

const handleFilePondInit = function () {
    console.log('FilePond has initialized');
    const files = useTemplateRef('pond');
}

const handleFilePondUpdate = (files: any) => {
    console.log('hit');
};

</script>

<style lang="postcss">
.my-pond {
    --filepond-background: theme('colors.gray.50');
    --filepond-panel-background: theme('colors.gray.50');
    --filepond-item-background: theme('colors.gray.50');
    --filepond-item-panel-background: theme('colors.gray.50');
    --filepond-drop-label-color: theme('colors.gray.500');
    --filepond-drop-label-color-dark: theme('colors.gray.400');
    --filepond-panel-background-dark: theme('colors.gray.800');
    --filepond-item-background-dark: theme('colors.gray.800');
    --filepond-item-panel-background-dark: theme('colors.gray.800');
}

.dark .my-pond {
    --filepond-background: theme('colors.gray.800');
    --filepond-panel-background: theme('colors.gray.800');
    --filepond-item-background: theme('colors.gray.800');
    --filepond-item-panel-background: theme('colors.gray.800');
}
</style>