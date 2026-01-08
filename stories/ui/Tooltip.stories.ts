import type { Meta, StoryObj } from '@storybook/vue3-vite';
import {
    Tooltip,
    TooltipProvider,
    TooltipTrigger,
    TooltipContent,
} from '@/components/ui/tooltip';
import { Button } from '@/components/ui/button';

const meta = {
    title: 'UI/Tooltip',
    component: Tooltip,
    tags: ['autodocs'],
} satisfies Meta<typeof Tooltip>;

export default meta;
type Story = StoryObj<typeof meta>;

export const Default: Story = {
    render: () => ({
        components: {
            Tooltip,
            TooltipProvider,
            TooltipTrigger,
            TooltipContent,
            Button,
        },
        template: `
            <TooltipProvider>
                <Tooltip>
                    <TooltipTrigger as-child>
                        <Button>Hover me</Button>
                    </TooltipTrigger>
                    <TooltipContent>
                        <p>This is a tooltip</p>
                    </TooltipContent>
                </Tooltip>
            </TooltipProvider>
        `,
    }),
};

export const WithText: Story = {
    render: () => ({
        components: {
            Tooltip,
            TooltipProvider,
            TooltipTrigger,
            TooltipContent,
            Button,
        },
        template: `
            <TooltipProvider>
                <Tooltip>
                    <TooltipTrigger as-child>
                        <Button variant="outline">Hover for info</Button>
                    </TooltipTrigger>
                    <TooltipContent>
                        <p>This tooltip provides additional information about the button.</p>
                    </TooltipContent>
                </Tooltip>
            </TooltipProvider>
        `,
    }),
};

export const Multiple: Story = {
    render: () => ({
        components: {
            Tooltip,
            TooltipProvider,
            TooltipTrigger,
            TooltipContent,
            Button,
        },
        template: `
            <TooltipProvider>
                <div class="flex gap-4">
                    <Tooltip>
                        <TooltipTrigger as-child>
                            <Button>Home</Button>
                        </TooltipTrigger>
                        <TooltipContent>
                            <p>Go to home page</p>
                        </TooltipContent>
                    </Tooltip>
                    <Tooltip>
                        <TooltipTrigger as-child>
                            <Button>Settings</Button>
                        </TooltipTrigger>
                        <TooltipContent>
                            <p>Open settings</p>
                        </TooltipContent>
                    </Tooltip>
                    <Tooltip>
                        <TooltipTrigger as-child>
                            <Button>Profile</Button>
                        </TooltipTrigger>
                        <TooltipContent>
                            <p>View your profile</p>
                        </TooltipContent>
                    </Tooltip>
                </div>
            </TooltipProvider>
        `,
    }),
};

export const WithIcon: Story = {
    render: () => ({
        components: {
            Tooltip,
            TooltipProvider,
            TooltipTrigger,
            TooltipContent,
        },
        template: `
            <TooltipProvider>
                <Tooltip>
                    <TooltipTrigger as-child>
                        <button class="p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M12 16v-4"/>
                                <path d="M12 8h.01"/>
                            </svg>
                        </button>
                    </TooltipTrigger>
                    <TooltipContent>
                        <p>Click for more information</p>
                    </TooltipContent>
                </Tooltip>
            </TooltipProvider>
        `,
    }),
};

export const LongContent: Story = {
    render: () => ({
        components: {
            Tooltip,
            TooltipProvider,
            TooltipTrigger,
            TooltipContent,
            Button,
        },
        template: `
            <TooltipProvider>
                <Tooltip>
                    <TooltipTrigger as-child>
                        <Button>Hover for details</Button>
                    </TooltipTrigger>
                    <TooltipContent class="max-w-xs">
                        <p>This is a longer tooltip that contains more detailed information about the action or element you're hovering over.</p>
                    </TooltipContent>
                </Tooltip>
            </TooltipProvider>
        `,
    }),
};

