export interface DatatableColumn {
    field: string;
    title: string;
    sortable?: boolean;
    searchable?: boolean;
    width?: string;
    align?: 'left' | 'center' | 'right';
}

export interface PaginatedCollection {
    data: any[];
    links: any[];
    meta: {
        current_page: number;
        from: number;
        last_page: number;
        per_page: number;
        to: number;
        total: number;
    };
} 