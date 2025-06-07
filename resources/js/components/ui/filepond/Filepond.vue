<template>
    <div class="filepond-wrapper">
        <file-pond
            name="test"
            ref="pond"
            class="my-pond"
            label-idle="Drop files here or click to browse"
            :allowMultiple="!single"
            accepted-file-types="image/jpeg, image/png, image/jpg"
            :files="pondFiles"
            @updatefiles="handleFilePondUpdate"
            
        />
        <button 
            @click="uploadFiles"
            class="mt-4 px-4 py-2 bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900 rounded-lg hover:bg-gray-800 dark:hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400"
        >
            Upload
        </button>
    </div>
</template>

<script setup lang="ts">

// Add type declarations for FilePond plugins
declare module 'filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.esm.js';
declare module 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.js';

import vueFilePond from 'vue-filepond';
import { router } from '@inertiajs/vue3';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.esm.js';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.js';
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
import { ref, useTemplateRef } from 'vue';



const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview);

interface Props {
    files?: App.Data.MediaData[];
    single?: boolean,
    route?: string,
}

const props = withDefaults(defineProps<Props>(), {
    route: route('settings.media-items.store')
});

const transformMediaToFilePond = (media: App.Data.MediaData) => ({
    source: route('settings.media-items.show', {media_item:  media}),
    options: {
        type: 'remote',
        metadata: {
            url: route('settings.media-items.show', {media_item:  media}),
            created_at: media.created_at,
            updated_at: media.updated_at
        }
    }
});

// Initialize files in FilePond format
const pondFiles = ref(props.files?.filter(Boolean).map(transformMediaToFilePond) ?? []);

const handleFilePondUpdate = (fileItems: any) => {
    const newFiles = fileItems.filter((item: any) => typeof item.source !== 'string');
    selectedFiles.value = newFiles.map((fileItem: any) => fileItem.file);
};

const selectedFiles = ref<File[]>([]);

const uploadFiles = () => {
    if (selectedFiles.value.length === 0) {
        return;
    }

    const formData = new FormData();

    if (props.single) {
        formData.append('file', selectedFiles.value[0]);
    } else {
        selectedFiles.value.forEach((file) => {
            formData.append('files[]', file);
        });
    }
    
    router.post(props.route, formData, {
        onStart: () => console.log('Uploading...'),
        onSuccess: () => {
            console.log('Upload successful');
            selectedFiles.value = []; // Reset new files
            pondFiles.value = [];
        },
        onError: (errors) => {
            console.error('Upload failed:', errors);
        },
    });
};
</script>

<style>
</style>