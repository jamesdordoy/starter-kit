import type { Meta, StoryObj } from '@storybook/vue3-vite';
import { Separator } from '@/components/ui/separator';

const meta = {
    title: 'UI/Separator',
    component: Separator,
    tags: ['autodocs'],
    argTypes: {
        orientation: {
            control: 'select',
            options: ['horizontal', 'vertical'],
        },
        decorative: {
            control: 'boolean',
        },
    },
} satisfies Meta<typeof Separator>;

export default meta;
type Story = StoryObj<typeof meta>;

export const Horizontal: Story = {
    render: () => ({
        components: { Separator },
        template: `
            <div class="space-y-4">
                <div>Content above</div>
                <Separator />
                <div>Content below</div>
            </div>
        `,
    }),
};

export const Vertical: Story = {
    render: () => ({
        components: { Separator },
        template: `
            <div class="flex items-center gap-4 h-20">
                <div>Left</div>
                <Separator orientation="vertical" />
                <div>Middle</div>
                <Separator orientation="vertical" />
                <div>Right</div>
            </div>
        `,
    }),
};

export const InList: Story = {
    render: () => ({
        components: { Separator },
        template: `
            <div class="space-y-1">
                <div class="p-4">Item 1</div>
                <Separator />
                <div class="p-4">Item 2</div>
                <Separator />
                <div class="p-4">Item 3</div>
                <Separator />
                <div class="p-4">Item 4</div>
            </div>
        `,
    }),
};

export const WithText: Story = {
    render: () => ({
        components: { Separator },
        template: `
            <div class="flex items-center gap-4">
                <Separator class="flex-1" />
                <span class="text-sm text-muted-foreground">OR</span>
                <Separator class="flex-1" />
            </div>
        `,
    }),
};

export const InCard: Story = {
    render: () => ({
        components: { Separator, Card: () => import('@/components/ui/card').then(m => m.Card), CardHeader: () => import('@/components/ui/card').then(m => m.CardHeader), CardTitle: () => import('@/components/ui/card').then(m => m.CardTitle), CardContent: () => import('@/components/ui/card').then(m => m.CardContent), CardFooter: () => import('@/components/ui/card').then(m => m.CardFooter) },
        template: `
            <Card>
                <CardHeader>
                    <CardTitle>Card Title</CardTitle>
                </CardHeader>
                <Separator />
                <CardContent>
                    <p>Card content separated by a separator.</p>
                </CardContent>
                <Separator />
                <CardFooter>
                    <p class="text-sm text-muted-foreground">Footer content</p>
                </CardFooter>
            </Card>
        `,
    }),
};

