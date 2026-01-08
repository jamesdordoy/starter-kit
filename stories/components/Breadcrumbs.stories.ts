import type { Meta, StoryObj } from '@storybook/vue3-vite';
import Breadcrumbs from '@/components/Breadcrumbs.vue';

const meta = {
    title: 'Components/Breadcrumbs',
    component: Breadcrumbs,
    tags: ['autodocs'],
    argTypes: {
        breadcrumbs: {
            control: 'object',
        },
    },
} satisfies Meta<typeof Breadcrumbs>;

export default meta;
type Story = StoryObj<typeof meta>;

export const Default: Story = {
    args: {
        breadcrumbs: [
            { title: 'Home', href: '/' },
            { title: 'Settings', href: '/settings' },
            { title: 'Profile' },
        ],
    },
};

export const Simple: Story = {
    args: {
        breadcrumbs: [
            { title: 'Home', href: '/' },
            { title: 'Current Page' },
        ],
    },
};

export const Long: Story = {
    args: {
        breadcrumbs: [
            { title: 'Home', href: '/' },
            { title: 'Products', href: '/products' },
            { title: 'Electronics', href: '/products/electronics' },
            { title: 'Computers', href: '/products/electronics/computers' },
            { title: 'Laptops', href: '/products/electronics/computers/laptops' },
            { title: 'Current Item' },
        ],
    },
};

export const Single: Story = {
    args: {
        breadcrumbs: [
            { title: 'Home' },
        ],
    },
};

export const WithoutLinks: Story = {
    args: {
        breadcrumbs: [
            { title: 'Home' },
            { title: 'Section' },
            { title: 'Subsection' },
            { title: 'Current' },
        ],
    },
};

