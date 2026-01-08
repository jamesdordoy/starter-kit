import type { Meta, StoryObj } from '@storybook/vue3-vite';
import Slider from '@/components/ui/slider/Slider.vue';

const meta = {
    title: 'UI/Slider',
    component: Slider,
    tags: ['autodocs'],
} satisfies Meta<typeof Slider>;

export default meta;
type Story = StoryObj<typeof meta>;

export const Default: Story = {
    render: () => ({
        components: { Slider },
        template: '<Slider />',
    }),
};

export const WithLabel: Story = {
    render: () => ({
        components: { Slider },
        template: `
            <div class="space-y-2">
                <label class="text-sm font-medium">Volume</label>
                <Slider />
            </div>
        `,
    }),
};

export const Multiple: Story = {
    render: () => ({
        components: { Slider },
        template: `
            <div class="space-y-6">
                <div class="space-y-2">
                    <label class="text-sm font-medium">Volume</label>
                    <Slider />
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium">Brightness</label>
                    <Slider />
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium">Contrast</label>
                    <Slider />
                </div>
            </div>
        `,
    }),
};

