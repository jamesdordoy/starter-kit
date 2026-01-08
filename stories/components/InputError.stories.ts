import type { Meta, StoryObj } from '@storybook/vue3-vite';
import InputError from '@/components/InputError.vue';

const meta = {
    title: 'Components/InputError',
    component: InputError,
    tags: ['autodocs'],
    argTypes: {
        message: {
            control: 'text',
        },
    },
} satisfies Meta<typeof InputError>;

export default meta;
type Story = StoryObj<typeof meta>;

export const Default: Story = {
    args: {
        message: 'This field is required.',
    },
};

export const Empty: Story = {
    args: {
        message: undefined,
    },
};

export const LongMessage: Story = {
    args: {
        message: 'This is a longer error message that might wrap to multiple lines and provide more detailed information about what went wrong.',
    },
};

export const MultipleErrors: Story = {
    render: () => ({
        components: { InputError },
        template: `
            <div class="space-y-2">
                <InputError message="Email is required." />
                <InputError message="Password must be at least 8 characters." />
                <InputError message="Passwords do not match." />
            </div>
        `,
    }),
};

export const WithInput: Story = {
    render: () => ({
        components: { InputError, Input: () => import('@/components/ui/input').then(m => m.Input) },
        template: `
            <div class="space-y-2 w-full max-w-md">
                <input
                    type="text"
                    placeholder="Enter your email"
                    class="flex h-9 w-full rounded-md border border-red-500 bg-transparent px-3 py-1 text-sm shadow-sm transition-colors"
                />
                <InputError message="Please enter a valid email address." />
            </div>
        `,
    }),
};

