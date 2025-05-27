<template>
    <file-pond
        name="test"
        ref="pond"
        class-name="my-pond"
        label-idle="Drop files here..."
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

    // example of instance method call on pond reference

    const files = useTemplateRef('pond');

    // console.log(files)
}

const handleFilePondUpdate = (files) => {
    console.log('hit');
    // console.log(files)
};

</script>