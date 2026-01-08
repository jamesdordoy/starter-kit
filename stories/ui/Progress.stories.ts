import type { Meta, StoryObj } from '@storybook/vue3-vite';
import Progress from '@/components/ui/progress/Progress.vue';

const meta = {
    title: 'UI/Progress',
    component: Progress,
    tags: ['autodocs'],
    argTypes: {
        startValue: {
            control: 'number',
            min: 0,
            max: 100,
        },
    },
} satisfies Meta<typeof Progress>;

export default meta;
type Story = StoryObj<typeof meta>;

export const Default: Story = {
    args: {
        startValue: 0,
    },
};

export const StartAt50: Story = {
    args: {
        startValue: 50,
    },
};

export const Multiple: Story = {
    render: () => ({
        components: { Progress },
        template: `
            <div class="space-y-6">
                <div>
                    <p class="mb-2 text-sm text-muted-foreground">Default (startValue = 0)</p>
                    <Progress :start-value="0" />
                </div>
                <div>
                    <p class="mb-2 text-sm text-muted-foreground">Start at 25</p>
                    <Progress :start-value="25" />
                </div>
                <div>
                    <p class="mb-2 text-sm text-muted-foreground">Start at 50</p>
                    <Progress :start-value="50" />
                </div>
                <div>
                    <p class="mb-2 text-sm text-muted-foreground">Start at 75</p>
                    <Progress :start-value="75" />
                </div>
            </div>
        `,
    }),
};

