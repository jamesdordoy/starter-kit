<script setup lang="ts">
import type { PaginatedCollection } from '@/types/paginated-collection';
import Vue3Datatable from '@bhplugin/vue3-datatable';
import '@bhplugin/vue3-datatable/dist/style.css';
import { router } from '@inertiajs/vue3';
import { ref, useSlots, watch } from 'vue';

interface Props {
    endpoint?: string;
    columns: any[];
    data?: PaginatedCollection<any>;
    showColumns?: string[];
    params?: Record<string, any>;
    filters?: any[];
    scopes?: any[];
    showColumnSelector?: boolean;
    showSearch?: boolean;
    defaultOrderBy?: string;
    defaultOrderByDir?: string;
    reload: string[];
}

const props = withDefaults(defineProps<Props>(), {
    showColumns: () => [],
    params: () => ({}),
    filters: () => [],
    scopes: () => [],
    showColumnSelector: false,
    showSearch: false,
    defaultOrderBy: '',
    defaultOrderByDir: 'asc',
});

const emits = defineEmits(['row-click']);

const search = ref('');

watch(search, () => {
    handleChange({
        change_type: 'search',
        value: search.value,
    });
});

const handleRowClick = (e) => {
    emits('row-click', e);
};

props.columns.forEach((column) => {
    column.hide = props.showColumns.length !== 0 && props.showColumns.indexOf(column.field) === -1;
});

const slots = useSlots();

const handleChange = (e) => {
    const params = {
        ...props.params,
    };

    switch (e.change_type) {
        case 'page':
            params.page = e.current_page;
            break;
        case 'pagesize':
            params.per_page = e.pagesize;
            break;
        case 'sort':
            if (e.sort_direction === 'desc') {
                params.sort = `-${e.sort_column}`;
            } else {
                params.sort = e.sort_column;
            }
            break;
        case 'search':
            params.search = e.value;
            params.page = 1;
            break;
        default:
            console.log(e.change_type, e);
            break;
    }

    // console.log(props.params)
    console.log(params);

    router.reload({
        data: {
            ...props.params,
            ...params,
        },
        only: props.reload,
    });
};
</script>

<template>
    <div class="datatable">
        <vue3-datatable
            class="dark:text-white"
            :rows="props.data?.data"
            :columns="columns"
            :total-rows="props.data?.meta.total"
            is-server-mode
            skin="table-auto w-full border border-gray-200 dark:border-gray-700 
            [&>thead>tr]:bg-gray-100 dark:[&>thead>tr]:bg-gray-800 
            [&>tbody>tr:hover]:bg-gray-50 dark:[&>tbody>tr:hover]:bg-neutral-900
            [&>thead>tr>th]:px-4 [&>thead>tr>th]:py-3 [&>thead>tr>th]:text-left [&>thead>tr>th]:text-sm [&>thead>tr>th]:font-medium [&>thead>tr>th]:text-gray-500 dark:[&>thead>tr>th]:text-gray-400
            [&>tbody>tr>td]:px-4 [&>tbody>tr>td]:py-3 [&>tbody>tr>td]:text-sm [&>tbody>tr>td]:text-gray-900 dark:[&>tbody>tr>td]:text-gray-100
            [&>tbody>tr]:border-t [&>tbody>tr]:border-gray-200 dark:[&>tbody>tr]:border-gray-700"
            @change="handleChange"
            @rowClick="handleRowClick"
            :page="props.data?.meta.current_page"
            :page-size="props.data?.meta.per_page"
            :page-size-options="[15, 30, 50, 100]"
            :sortable="true"
            :searchable="true"
            :filterable="true"
            :filter="true"
        >
            <template v-for="(_, name) in slots" v-slot:[name]="slotData"><slot :name="name" v-bind="slotData" /></template>
        </vue3-datatable>
    </div>
</template>

<style>

</style>
