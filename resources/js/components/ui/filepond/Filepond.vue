<template>
    <div class="filepond-wrapper">
        <file-pond
            name="test"
            ref="pond"
            class="my-pond"
            label-idle="Drop files here or click to browse"
            :allowMultiple="!single"
            accepted-file-types="image/jpeg, image/png, image/jpg, application/pdf"
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
import vueFilePond from 'vue-filepond';
import { router } from '@inertiajs/vue3';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.esm.js';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.js';
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
import { ref, watch } from 'vue';
import { store, show } from '@/actions/App/Http/Controllers/Settings/MediaController';

const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview);

interface Props {
    files?: App.Data.MediaData[];
    single?: boolean,
    route?: string,
    remote?: boolean,
}

const props = withDefaults(defineProps<Props>(), {
    route: store.url() as string,
});

const transformMediaToFilePond = async (media: App.Data.MediaData) => {
    if (!media.id) return null;
    
    const url = show.url({ media_item: media.id });
    
    if (props.remote) {
        return {
            source: url,
            type: 'remote',
            metadata: {
                url,
                created_at: media.created_at,
                updated_at: media.updated_at
            }
        };
    }
    
    try {
        const response = await fetch(url);
        const blob = await response.blob();
        const fileName = media.file_name || media.name || 'file';
        const file = new File([blob], fileName, { type: media.mime_type || blob.type });
        
        return {
            source: file,
            type: 'local',
            options: {
                type: 'local',
                file
            }
        };
    } catch {
        return { source: url, type: 'remote' };
    }
};

const pondFiles = ref<Array<any>>([]);

watch(() => props.files, async (files) => {
    if (!files?.length) {
        pondFiles.value = [];
        return;
    }
    
    const transformed = await Promise.all(
        files.filter(Boolean).map(transformMediaToFilePond)
    );
    pondFiles.value = transformed.filter(Boolean);
}, { immediate: true });

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
        onSuccess: () => {
            selectedFiles.value = [];
            pondFiles.value = [];
        },
    });
};
</script>