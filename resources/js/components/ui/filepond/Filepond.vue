<template>
    <div class="filepond-wrapper">
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
    </div>
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

<style>

</style>