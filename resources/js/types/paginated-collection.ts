export interface PaginatedCollection<T> {
    data: Array<T>;
    current_page: number;
    first_page_url: string;
    from: number;
    to: number;
    total: number;
    per_page: number;
    last_page: number;
    last_page_url: string;
    next_page_url: string | null;
    links: Array<{
        label: string;
        url: string | null;
        active: boolean;
    }>;
}
