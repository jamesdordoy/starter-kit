import type { Meta, StoryObj } from '@storybook/vue3-vite';
import { ref } from 'vue';
import { Pagination } from '@/components/ui/pagination';
import type { PaginatedCollection } from '@/types/paginated-collection';

const meta = {
    title: 'UI/Pagination',
    component: Pagination,
    tags: ['autodocs'],
    argTypes: {
        data: {
            control: 'object',
        },
    },
} satisfies Meta<typeof Pagination>;

export default meta;
type Story = StoryObj<typeof meta>;

const mockPaginatedData: PaginatedCollection<any> = {
    data: Array.from({ length: 10 }, (_, i) => ({ id: i + 1, name: `Item ${i + 1}` })),
    current_page: 1,
    per_page: 10,
    total: 50,
    from: 1,
    to: 10,
    last_page: 5,
    first_page_url: '/?page=1',
    last_page_url: '/?page=5',
    next_page_url: '/?page=2',
    prev_page_url: null,
    path: '/',
    links: [],
};

export const Default: Story = {
    args: {
        data: mockPaginatedData,
    },
    render: (args) => ({
        components: { Pagination },
        setup() {
            const currentPage = ref(args.data.current_page);
            return { args, currentPage };
        },
        template: '<Pagination :data="args.data" @update:page="currentPage = $event" />',
    }),
};

export const FirstPage: Story = {
    args: {
        data: { ...mockPaginatedData, current_page: 1 },
    },
    render: (args) => ({
        components: { Pagination },
        setup() {
            const currentPage = ref(args.data.current_page);
            return { args, currentPage };
        },
        template: '<Pagination :data="args.data" @update:page="currentPage = $event" />',
    }),
};

export const MiddlePage: Story = {
    args: {
        data: { ...mockPaginatedData, current_page: 3, from: 21, to: 30 },
    },
    render: (args) => ({
        components: { Pagination },
        setup() {
            const currentPage = ref(args.data.current_page);
            return { args, currentPage };
        },
        template: '<Pagination :data="args.data" @update:page="currentPage = $event" />',
    }),
};

export const LastPage: Story = {
    args: {
        data: { ...mockPaginatedData, current_page: 5, from: 41, to: 50 },
    },
    render: (args) => ({
        components: { Pagination },
        setup() {
            const currentPage = ref(args.data.current_page);
            return { args, currentPage };
        },
        template: '<Pagination :data="args.data" @update:page="currentPage = $event" />',
    }),
};

export const LargeDataset: Story = {
    args: {
        data: {
            ...mockPaginatedData,
            total: 1000,
            last_page: 100,
            current_page: 50,
            from: 491,
            to: 500,
        },
    },
    render: (args) => ({
        components: { Pagination },
        setup() {
            const currentPage = ref(args.data.current_page);
            return { args, currentPage };
        },
        template: '<Pagination :data="args.data" @update:page="currentPage = $event" />',
    }),
};

