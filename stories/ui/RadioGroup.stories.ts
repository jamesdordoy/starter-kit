import type { Meta, StoryObj } from '@storybook/vue3-vite';
import RadioGroup from '@/components/ui/radio-group/RadioGroup.vue';

const meta = {
    title: 'UI/RadioGroup',
    component: RadioGroup,
    tags: ['autodocs'],
} satisfies Meta<typeof RadioGroup>;

export default meta;
type Story = StoryObj<typeof meta>;

export const Default: Story = {
    render: () => ({
        components: { RadioGroup },
        template: '<RadioGroup />',
    }),
};

export const CustomOptions: Story = {
    render: () => ({
        components: { RadioGroup },
        template: `
            <div class="space-y-4">
                <RadioGroup />
                <div class="text-sm text-muted-foreground">
                    This component has hardcoded options. To customize, modify the RadioGroup.vue component.
                </div>
            </div>
        `,
    }),
};

