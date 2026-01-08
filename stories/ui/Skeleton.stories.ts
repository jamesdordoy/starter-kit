import type { Meta, StoryObj } from '@storybook/vue3-vite';
import { Skeleton } from '@/components/ui/skeleton';

const meta = {
    title: 'UI/Skeleton',
    component: Skeleton,
    tags: ['autodocs'],
} satisfies Meta<typeof Skeleton>;

export default meta;
type Story = StoryObj<typeof meta>;

export const Default: Story = {
    render: () => ({
        components: { Skeleton },
        template: '<Skeleton class="h-4 w-[250px]" />',
    }),
};

export const Circle: Story = {
    render: () => ({
        components: { Skeleton },
        template: '<Skeleton class="h-12 w-12 rounded-full" />',
    }),
};

export const Card: Story = {
    render: () => ({
        components: { Skeleton },
        template: `
            <div class="flex items-center space-x-4">
                <Skeleton class="h-12 w-12 rounded-full" />
                <div class="space-y-2">
                    <Skeleton class="h-4 w-[250px]" />
                    <Skeleton class="h-4 w-[200px]" />
                </div>
            </div>
        `,
    }),
};

export const Article: Story = {
    render: () => ({
        components: { Skeleton },
        template: `
            <div class="flex flex-col space-y-3">
                <Skeleton class="h-[125px] w-full rounded-xl" />
                <div class="space-y-2">
                    <Skeleton class="h-4 w-full" />
                    <Skeleton class="h-4 w-full" />
                    <Skeleton class="h-4 w-3/4" />
                </div>
            </div>
        `,
    }),
};

export const Profile: Story = {
    render: () => ({
        components: { Skeleton },
        template: `
            <div class="flex items-center space-x-4">
                <Skeleton class="h-16 w-16 rounded-full" />
                <div class="space-y-2 flex-1">
                    <Skeleton class="h-4 w-[200px]" />
                    <Skeleton class="h-4 w-[150px]" />
                </div>
            </div>
        `,
    }),
};

export const List: Story = {
    render: () => ({
        components: { Skeleton },
        template: `
            <div class="space-y-3">
                <div class="flex items-center space-x-4">
                    <Skeleton class="h-12 w-12 rounded-full" />
                    <div class="space-y-2 flex-1">
                        <Skeleton class="h-4 w-full" />
                        <Skeleton class="h-4 w-3/4" />
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <Skeleton class="h-12 w-12 rounded-full" />
                    <div class="space-y-2 flex-1">
                        <Skeleton class="h-4 w-full" />
                        <Skeleton class="h-4 w-3/4" />
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <Skeleton class="h-12 w-12 rounded-full" />
                    <div class="space-y-2 flex-1">
                        <Skeleton class="h-4 w-full" />
                        <Skeleton class="h-4 w-3/4" />
                    </div>
                </div>
            </div>
        `,
    }),
};

