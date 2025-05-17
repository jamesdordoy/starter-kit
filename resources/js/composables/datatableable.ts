import {ref} from "vue";
import http from "@/http";
import qs from "qs";

export const useDataTableable = (endpoint, params, filters = [], scopes = []) => {

    const defaultSort = params.sort || '';

    const loading = ref(true);
    const rows = ref([]);
    const meta = ref({ total: 0 });
    const sortable = ref(true);
    const page = ref(1);
    const pageSize = ref(10);
    const sortColumn = ref(defaultSort.replace('-', '')); //
    const sortDirection = ref(defaultSort.indexOf('-') > -1 ? 'desc' : 'asc');
    const search = ref(null);
    const cachedScopes = ref(scopes);


    const getData = async (scopes = cachedScopes.value) => {

        const sort = sortColumn.value
            ? (sortDirection.value === 'desc' ? '-' : '') + sortColumn.value
            : null;

        const filter = {
            ... (params.filter || {})
        };

        if (search.value) {
            filter.search_all = search.value;
        }

        cachedScopes.value = scopes;

        scopes.forEach(scope => {
            filter[scope] = scope;
        });

        if (! search.value && params.filter && params.filter.search_all) {
            delete params.filter.search_all;
        }

        // const {data} = await http.get(
        //     endpoint,
        //     {
        //         params: {
        //             ...params,
        //             page: page.value,
        //             per_page: pageSize.value,
        //             sort,
        //             filter: filter
        //         },
        //         paramsSerializer: function(params) {
        //             return qs.stringify(params, { encode: false });
        //         }
        //     });
        // rows.value = data.data;
        // meta.value = data.meta;
        loading.value = false
    };

    const handleChange = (e) => {
        switch (e.change_type) {
            case 'page':
                page.value = e.current_page;
                break;
            case 'pagesize':
                pageSize.value = e.pagesize;
                break;
            case 'sort':
                sortColumn.value = e.sort_column;
                sortDirection.value = e.sort_direction;
                break;
            case 'search':
                search.value = e.value;
                page.value = 1;
                break;
            default:
                console.log(e.change_type, e);
                break;
        }
        getData();
    };

    return {
        loading,
        getData,
        rows,
        meta,
        sortable,
        page,
        pageSize,
        handleChange,
        skin: 'whitespace-nowrap table-hover',
        firstArrow: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
        lastArrow: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M6.99976 19L12.9998 12L6.99976 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
        previousArrow: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
        nextArrow: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
    };
}
