import type { Meta, StoryObj } from '@storybook/vue3-vite';
import Icon from '@/components/Icon.vue';

const meta = {
    title: 'Components/Icon',
    component: Icon,
    tags: ['autodocs'],
    argTypes: {
        name: {
            control: 'text',
            description: 'Name of the Lucide icon (e.g., "home", "user", "settings")',
        },
        size: {
            control: 'number',
        },
        color: {
            control: 'color',
        },
        strokeWidth: {
            control: 'number',
        },
    },
    args: {
        name: 'home',
        size: 16,
        strokeWidth: 2,
    },
} satisfies Meta<typeof Icon>;

export default meta;
type Story = StoryObj<typeof meta>;

export const Default: Story = {
    args: {
        name: 'home',
    },
};

export const CommonIcons: Story = {
    render: () => ({
        components: { Icon },
        template: `
            <div class="flex flex-wrap gap-6">
                <div class="flex flex-col items-center gap-2">
                    <Icon name="home" />
                    <span class="text-xs">home</span>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <Icon name="user" />
                    <span class="text-xs">user</span>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <Icon name="settings" />
                    <span class="text-xs">settings</span>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <Icon name="search" />
                    <span class="text-xs">search</span>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <Icon name="bell" />
                    <span class="text-xs">bell</span>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <Icon name="heart" />
                    <span class="text-xs">heart</span>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <Icon name="star" />
                    <span class="text-xs">star</span>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <Icon name="mail" />
                    <span class="text-xs">mail</span>
                </div>
            </div>
        `,
    }),
};

export const Sizes: Story = {
    render: () => ({
        components: { Icon },
        template: `
            <div class="flex items-center gap-6">
                <div class="flex flex-col items-center gap-2">
                    <Icon name="home" :size="12" />
                    <span class="text-xs">12px</span>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <Icon name="home" :size="16" />
                    <span class="text-xs">16px</span>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <Icon name="home" :size="24" />
                    <span class="text-xs">24px</span>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <Icon name="home" :size="32" />
                    <span class="text-xs">32px</span>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <Icon name="home" :size="48" />
                    <span class="text-xs">48px</span>
                </div>
            </div>
        `,
    }),
};

export const Colors: Story = {
    render: () => ({
        components: { Icon },
        template: `
            <div class="flex flex-wrap gap-6">
                <div class="flex flex-col items-center gap-2">
                    <Icon name="heart" color="red" />
                    <span class="text-xs">Red</span>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <Icon name="heart" color="blue" />
                    <span class="text-xs">Blue</span>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <Icon name="heart" color="green" />
                    <span class="text-xs">Green</span>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <Icon name="heart" color="#ff6b6b" />
                    <span class="text-xs">Custom</span>
                </div>
            </div>
        `,
    }),
};

export const StrokeWidths: Story = {
    render: () => ({
        components: { Icon },
        template: `
            <div class="flex items-center gap-6">
                <div class="flex flex-col items-center gap-2">
                    <Icon name="home" :stroke-width="1" />
                    <span class="text-xs">1</span>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <Icon name="home" :stroke-width="2" />
                    <span class="text-xs">2</span>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <Icon name="home" :stroke-width="3" />
                    <span class="text-xs">3</span>
                </div>
            </div>
        `,
    }),
};

export const WithText: Story = {
    render: () => ({
        components: { Icon },
        template: `
            <div class="flex flex-col gap-4">
                <div class="flex items-center gap-2">
                    <Icon name="home" />
                    <span>Home</span>
                </div>
                <div class="flex items-center gap-2">
                    <Icon name="user" />
                    <span>Profile</span>
                </div>
                <div class="flex items-center gap-2">
                    <Icon name="settings" />
                    <span>Settings</span>
                </div>
                <div class="flex items-center gap-2">
                    <Icon name="mail" />
                    <span>Messages</span>
                </div>
            </div>
        `,
    }),
};

