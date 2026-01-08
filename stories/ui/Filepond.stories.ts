import type { Meta, StoryObj } from '@storybook/vue3-vite';
import { Filepond } from '@/components/ui/filepond';

const meta = {
    title: 'UI/Filepond',
    component: Filepond,
    tags: ['autodocs'],
    argTypes: {
        single: {
            control: 'boolean',
        },
        route: {
            control: 'text',
        },
    },
} satisfies Meta<typeof Filepond>;

export default meta;
type Story = StoryObj<typeof meta>;

export const Default: Story = {
    args: {
        files: [],
        single: false,
        route: '/api/upload',
    },
};

export const SingleFile: Story = {
    args: {
        files: [],
        single: true,
        route: '/api/upload',
    },
};

export const MultipleFiles: Story = {
    args: {
        files: [],
        single: false,
        route: '/api/upload',
    },
};

export const WithExistingFiles: Story = {
    args: {
        files: [
            {
                id: 1,
                name: 'example.jpg',
                file_name: 'example.jpg',
                mime_type: 'image/jpeg',
                size: 1024000,
                created_at: '2024-01-01T00:00:00Z',
                updated_at: '2024-01-01T00:00:00Z',
            },
        ] as App.Data.MediaData[],
        single: false,
        route: '/api/upload',
    },
};

