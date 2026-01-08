import type { Meta, StoryObj } from '@storybook/vue3-vite';
import { ref } from 'vue';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { Checkbox } from '@/components/ui/checkbox';

const meta = {
    title: 'UI/Label',
    component: Label,
    tags: ['autodocs'],
    argTypes: {
        for: {
            control: 'text',
        },
    },
} satisfies Meta<typeof Label>;

export default meta;
type Story = StoryObj<typeof meta>;

export const Default: Story = {
    render: () => ({
        components: { Label },
        template: '<Label>Label Text</Label>',
    }),
};

export const WithInput: Story = {
    render: () => ({
        components: { Label, Input },
        template: `
            <div class="space-y-2">
                <Label for="email">Email</Label>
                <Input id="email" type="email" placeholder="Enter your email" />
            </div>
        `,
    }),
};

export const WithCheckbox: Story = {
    render: () => ({
        components: { Label, Checkbox },
        setup() {
            const checked = ref(false);
            return { checked };
        },
        template: `
            <div class="flex items-center space-x-2">
                <Checkbox id="terms" v-model:checked="checked" />
                <Label for="terms">Accept terms and conditions</Label>
            </div>
        `,
    }),
};

export const Multiple: Story = {
    render: () => ({
        components: { Label, Input },
        template: `
            <div class="space-y-4 w-full max-w-md">
                <div class="space-y-2">
                    <Label for="name">Name</Label>
                    <Input id="name" placeholder="Enter your name" />
                </div>
                <div class="space-y-2">
                    <Label for="email">Email</Label>
                    <Input id="email" type="email" placeholder="Enter your email" />
                </div>
                <div class="space-y-2">
                    <Label for="password">Password</Label>
                    <Input id="password" type="password" placeholder="Enter your password" />
                </div>
            </div>
        `,
    }),
};

export const Required: Story = {
    render: () => ({
        components: { Label, Input },
        template: `
            <div class="space-y-2">
                <Label for="required-field">
                    Required Field
                    <span class="text-destructive">*</span>
                </Label>
                <Input id="required-field" placeholder="This field is required" />
            </div>
        `,
    }),
};

