import type { Meta, StoryObj } from '@storybook/vue3-vite';
import { Input } from '@/components/ui/input';

const meta = {
    title: 'UI/Input',
    component: Input,
    tags: ['autodocs'],
    argTypes: {
        modelValue: {
            control: 'text',
        },
        defaultValue: {
            control: 'text',
        },
    },
} satisfies Meta<typeof Input>;

export default meta;
type Story = StoryObj<typeof meta>;

export const Default: Story = {
    args: {
        modelValue: '',
        placeholder: 'Enter text...',
    },
    render: (args) => ({
        components: { Input },
        setup() {
            return { args };
        },
        template: '<Input v-bind="args" />',
    }),
};

export const WithValue: Story = {
    args: {
        modelValue: 'Hello World',
    },
    render: (args) => ({
        components: { Input },
        setup() {
            return { args };
        },
        template: '<Input v-bind="args" />',
    }),
};

export const Placeholders: Story = {
    render: () => ({
        components: { Input },
        template: `
            <div class="flex flex-col gap-4 w-full max-w-md">
                <Input placeholder="Enter your name" />
                <Input placeholder="Enter your email" type="email" />
                <Input placeholder="Enter password" type="password" />
                <Input placeholder="Enter number" type="number" />
            </div>
        `,
    }),
};

export const Disabled: Story = {
    render: () => ({
        components: { Input },
        template: `
            <div class="flex flex-col gap-4 w-full max-w-md">
                <Input placeholder="Disabled input" disabled />
                <Input model-value="Disabled with value" disabled />
            </div>
        `,
    }),
};

export const Invalid: Story = {
    render: () => ({
        components: { Input },
        template: `
            <div class="flex flex-col gap-4 w-full max-w-md">
                <Input placeholder="Invalid input" aria-invalid="true" />
                <Input model-value="Invalid with value" aria-invalid="true" />
            </div>
        `,
    }),
};

export const Types: Story = {
    render: () => ({
        components: { Input },
        template: `
            <div class="flex flex-col gap-4 w-full max-w-md">
                <Input type="text" placeholder="Text" />
                <Input type="email" placeholder="Email" />
                <Input type="password" placeholder="Password" />
                <Input type="number" placeholder="Number" />
                <Input type="tel" placeholder="Telephone" />
                <Input type="url" placeholder="URL" />
                <Input type="date" />
                <Input type="time" />
            </div>
        `,
    }),
};

