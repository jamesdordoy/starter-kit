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

        <button @click="uploadFiles">Upload</button>

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


import { router } from '@inertiajs/vue3'; // Make sure you're using @inertiajs/vue3

const selectedFiles = ref<File[]>([]);

const handleFilePondUpdate = (fileItems: any) => {
    // Extract raw File objects from FilePond items
    selectedFiles.value = fileItems.map((fileItem: any) => fileItem.file);
};

const uploadFiles = () => {
    if (selectedFiles.value.length === 0) {
        return;
    }

    const formData = new FormData();
    selectedFiles.value.forEach((file, index) => {
        formData.append('files[]', file);
    });

    router.post('/settings/media-items', formData, {
        onStart: () => console.log('Uploading...'),
        onSuccess: () => {
            console.log('Upload successful');
            selectedFiles.value = []; // Reset files
        },
        onError: (errors) => {
            console.error('Upload failed:', errors);
        },
    });
};


</script>

<style>

</style>