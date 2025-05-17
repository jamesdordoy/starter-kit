<script setup lang="ts">
import {useDataTableable} from "@/composables/datatableable";
import { ref, useSlots, watch} from "vue";
import { router } from '@inertiajs/vue3';
import { type PaginatedCollection, type DatatableColumn } from '@/types';
import Vue3Datatable from "@bhplugin/vue3-datatable";
import "@bhplugin/vue3-datatable/dist/style.css";

interface Props {
    endpoint?: string;
    columns: DatatableColumn[];
    data?: PaginatedCollection;
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

props.columns.forEach(column => {
    column.hide = props.showColumns.length !== 0 && props.showColumns.indexOf(column.field) === -1;
});


watch(() => props.scopes, (scopes) => {
    getData(scopes);
}, {
    deep: true
});

const {
    // loading,
    getData,
    // rows,
    meta,
    sortable,
    page,
    pageSize,
    // handleChange,
    skin,
    firstArrow,
    lastArrow,
    previousArrow,
    nextArrow,
} = useDataTableable(
    props.endpoint,
    {
        ...props.params,
        ... props.defaultOrderBy ? {
            sort: (props.defaultOrderByDir === 'desc' ? '-' : '') + props.defaultOrderBy
        } : {},
    },
    props.filters,
    props.scopes
);

const slots = useSlots()


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
            params.sortColumn = e.sort_column;
            params.sortDirection = e.sort_direction;
            break;
        case 'search':
            params.search = e.value;
            params.page = 1;
            break;
        default:
            console.log(e.change_type, e);
            break;
    }
    router.reload({
        data: params,
        only: props.reload,
    });
};
</script>

<template>
    <div class="datatable">
        <vue3-datatable
            :rows="props.data.data"
            :columns="columns"
            :total-rows="props.data.meta.total"
            is-server-mode
            @change="handleChange"
            :page="props.data.meta.current_page"
            :page-size="props.data.meta.per_page"
            :page-size-options="[15, 30, 50, 100]"
            :sortable="true"
            :first-arrow="firstArrow"
            :last-arrow="lastArrow"
            :previous-arrow="previousArrow"
            :next-arrow="nextArrow"
            :searchable="true"
            :filterable="true"
            :filter="true"
        >
            <template v-for="(_, name) in slots" v-slot:[name]="slotData"><slot :name="name" v-bind="slotData" /></template>
        </vue3-datatable>
    </div>
</template>

<style scoped>

</style>