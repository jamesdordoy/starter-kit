import type { Meta, StoryObj } from '@storybook/vue3-vite';
import { ref } from 'vue';
import Switch from '@/components/ui/switch/Switch.vue';

const meta = {
    title: 'UI/Switch',
    component: Switch,
    tags: ['autodocs'],
    argTypes: {
        checked: {
            control: 'boolean',
        },
        disabled: {
            control: 'boolean',
        },
    },
} satisfies Meta<typeof Switch>;

export default meta;
type Story = StoryObj<typeof meta>;

export const Default: Story = {
    render: () => ({
        components: { Switch },
        setup() {
            const checked = ref(false);
            return { checked };
        },
        template: `
            <div class="flex items-center space-x-2">
                <Switch v-model:checked="checked" id="switch-1" />
                <label for="switch-1" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                    Airplane Mode
                </label>
            </div>
        `,
    }),
};

export const Checked: Story = {
    render: () => ({
        components: { Switch },
        setup() {
            const checked = ref(true);
            return { checked };
        },
        template: `
            <div class="flex items-center space-x-2">
                <Switch v-model:checked="checked" id="switch-2" />
                <label for="switch-2" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                    Notifications Enabled
                </label>
            </div>
        `,
    }),
};

export const Disabled: Story = {
    render: () => ({
        components: { Switch },
        template: `
            <div class="flex flex-col gap-4">
                <div class="flex items-center space-x-2">
                    <Switch id="switch-disabled" disabled />
                    <label for="switch-disabled" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                        Disabled unchecked
                    </label>
                </div>
                <div class="flex items-center space-x-2">
                    <Switch id="switch-disabled-checked" checked disabled />
                    <label for="switch-disabled-checked" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                        Disabled checked
                    </label>
                </div>
            </div>
        `,
    }),
};

export const Multiple: Story = {
    render: () => ({
        components: { Switch },
        setup() {
            const notifications = ref(true);
            const email = ref(false);
            const sms = ref(true);
            return { notifications, email, sms };
        },
        template: `
            <div class="space-y-4">
                <div class="flex items-center space-x-2">
                    <Switch v-model:checked="notifications" id="notifications" />
                    <label for="notifications" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                        Push Notifications
                    </label>
                </div>
                <div class="flex items-center space-x-2">
                    <Switch v-model:checked="email" id="email" />
                    <label for="email" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                        Email Notifications
                    </label>
                </div>
                <div class="flex items-center space-x-2">
                    <Switch v-model:checked="sms" id="sms" />
                    <label for="sms" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                        SMS Notifications
                    </label>
                </div>
            </div>
        `,
    }),
};

