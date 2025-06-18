<script setup lang="ts">
import { Button } from '@/components/ui/button';
import Filepond from '@/components/ui/filepond/Filepond.vue';
import { Input } from '@/components/ui/input';
import { Pagination } from '@/components/ui/pagination';
import { useFileSize } from '@/composables/useFileSize';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import type { PaginatedCollection } from '@/types/paginated-collection';
import { Head, router } from '@inertiajs/vue3';
import { FileIcon, FileTextIcon, ImageIcon } from 'lucide-vue-next';
import { ref, watch } from 'vue';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Users',
        href: route('settings.index'),
    },
];

interface Props {
    assets: PaginatedCollection<App.Data.MediaData>;
    params: {
        page: number;
        per_page: number;
        sortColumn: string;
        sortDirection: string;
        filter: Record<App.Enums.FilterEnum, string>;
    };
}

defineProps<Props>();

const { formatFileSize } = useFileSize();

const isImageFile = (mimeType: string | null): boolean => {
    return mimeType?.startsWith('image/') ?? false;
};

const searchValue = ref('');

watch(searchValue, (value) => {
    router.get(
        route('settings.media-items.index'),
        { filter: { search: value } },
        {
            only: ['assets'],
            preserveState: true,
            preserveScroll: true,
        },
    );
});

const getFileIcon = (mimeType: string | null) => {
    if (!mimeType) return FileIcon;

    if (isImageFile(mimeType)) {
        return ImageIcon;
    }
    if (mimeType === 'application/pdf') {
        return FileTextIcon;
    }
    return FileIcon;
};

const reloadAssets = (page: number) => {
    router.get(
        route('settings.media-items.index'),
        { page },
        {
            only: ['assets'],
            preserveState: true,
            preserveScroll: true,
        },
    );
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="General settings" />
        <SettingsLayout>
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-semibold tracking-tight">Assets</h2>
                    <div class="flex items-center gap-2">
                        <Input type="search" placeholder="Search assets..." class="w-[200px]" v-model="searchValue" />
                    </div>
                </div>

                <div class="flex flex-col space-y-4 sm:w-full md:w-1/2">
                    <Filepond />
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    <div
                        v-for="item in assets.data"
                        :key="item.id"
                        class="group relative overflow-hidden rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900"
                    >
                        <!-- Preview Image -->
                        <div class="flex aspect-square items-center justify-center overflow-hidden rounded-md bg-gray-100 dark:bg-gray-800">
                            <template v-if="isImageFile(item.mime_type)">
                                <img
                                    :src="route('settings.media-items.show', { media_item: item.id })"
                                    :alt="item.file_name"
                                    class="h-full w-full object-cover transition-transform group-hover:scale-105"
                                />
                            </template>
                            <template v-else>
                                <component :is="getFileIcon(item.mime_type)" class="h-16 w-16 text-gray-400" />
                            </template>
                        </div>

                        <!-- File Info -->
                        <div class="mt-4 space-y-2">
                            <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ item.custom_properties.client_name ?? item.file_name }}
                            </h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ formatFileSize(Number(item.size), true) }}
                            </p>
                            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                                <span>{{ item.mime_type }}</span>
                                <span>•</span>
                                <span>{{ item.created_at }}</span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="absolute right-5 bottom-5 opacity-0 transition-opacity group-hover:opacity-100">
                            <div class="flex gap-2">
                                <a :href="route('settings.media-items.show', { media_item: item.id })" variant="secondary" size="sm"> Download </a>
                                <Button variant="destructive" size="sm"> Delete </Button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <Pagination :data="assets" @update:page="reloadAssets" />
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
