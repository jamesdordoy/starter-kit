import type { Meta, StoryObj } from '@storybook/vue3-vite';
import {
    Avatar,
    AvatarImage,
    AvatarFallback,
} from '@/components/ui/avatar';

const meta = {
    title: 'UI/Avatar',
    component: Avatar,
    tags: ['autodocs'],
} satisfies Meta<typeof Avatar>;

export default meta;
type Story = StoryObj<typeof meta>;

export const Default: Story = {
    render: () => ({
        components: { Avatar, AvatarImage, AvatarFallback },
        template: `
            <Avatar>
                <AvatarImage src="https://github.com/shadcn.png" alt="@shadcn" />
                <AvatarFallback>CN</AvatarFallback>
            </Avatar>
        `,
    }),
};

export const WithFallback: Story = {
    render: () => ({
        components: { Avatar, AvatarImage, AvatarFallback },
        template: `
            <Avatar>
                <AvatarImage src="https://invalid-url.png" alt="User" />
                <AvatarFallback>JD</AvatarFallback>
            </Avatar>
        `,
    }),
};

export const Initials: Story = {
    render: () => ({
        components: { Avatar, AvatarFallback },
        template: `
            <div class="flex gap-4">
                <Avatar>
                    <AvatarFallback>JD</AvatarFallback>
                </Avatar>
                <Avatar>
                    <AvatarFallback>AB</AvatarFallback>
                </Avatar>
                <Avatar>
                    <AvatarFallback>CD</AvatarFallback>
                </Avatar>
            </div>
        `,
    }),
};

export const Sizes: Story = {
    render: () => ({
        components: { Avatar, AvatarImage, AvatarFallback },
        template: `
            <div class="flex items-center gap-4">
                <Avatar class="h-8 w-8">
                    <AvatarImage src="https://github.com/shadcn.png" alt="Small" />
                    <AvatarFallback class="text-xs">SM</AvatarFallback>
                </Avatar>
                <Avatar class="h-12 w-12">
                    <AvatarImage src="https://github.com/shadcn.png" alt="Medium" />
                    <AvatarFallback>MD</AvatarFallback>
                </Avatar>
                <Avatar class="h-16 w-16">
                    <AvatarImage src="https://github.com/shadcn.png" alt="Large" />
                    <AvatarFallback class="text-lg">LG</AvatarFallback>
                </Avatar>
            </div>
        `,
    }),
};

export const Multiple: Story = {
    render: () => ({
        components: { Avatar, AvatarImage, AvatarFallback },
        template: `
            <div class="flex -space-x-2">
                <Avatar class="border-2 border-white">
                    <AvatarImage src="https://github.com/shadcn.png" alt="User 1" />
                    <AvatarFallback>U1</AvatarFallback>
                </Avatar>
                <Avatar class="border-2 border-white">
                    <AvatarImage src="https://github.com/shadcn.png" alt="User 2" />
                    <AvatarFallback>U2</AvatarFallback>
                </Avatar>
                <Avatar class="border-2 border-white">
                    <AvatarImage src="https://github.com/shadcn.png" alt="User 3" />
                    <AvatarFallback>U3</AvatarFallback>
                </Avatar>
                <Avatar class="border-2 border-white">
                    <AvatarFallback>+5</AvatarFallback>
                </Avatar>
            </div>
        `,
    }),
};

