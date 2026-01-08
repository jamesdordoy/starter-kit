import type { Meta, StoryObj } from '@storybook/vue3-vite';
import { ref } from 'vue';
import { Checkbox } from '@/components/ui/checkbox';

const meta = {
    title: 'UI/Checkbox',
    component: Checkbox,
    tags: ['autodocs'],
    argTypes: {
        checked: {
            control: 'boolean',
        },
        disabled: {
            control: 'boolean',
        },
    },
} satisfies Meta<typeof Checkbox>;

export default meta;
type Story = StoryObj<typeof meta>;

export const Default: Story = {
    render: () => ({
        components: { Checkbox },
        setup() {
            const checked = ref(false);
            return { checked };
        },
        template: `
            <div class="flex items-center space-x-2">
                <Checkbox v-model:checked="checked" id="checkbox-1" />
                <label for="checkbox-1" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                    Accept terms and conditions
                </label>
            </div>
        `,
    }),
};

export const Checked: Story = {
    render: () => ({
        components: { Checkbox },
        setup() {
            const checked = ref(true);
            return { checked };
        },
        template: `
            <div class="flex items-center space-x-2">
                <Checkbox v-model:checked="checked" id="checkbox-2" />
                <label for="checkbox-2" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                    Already checked
                </label>
            </div>
        `,
    }),
};

export const Disabled: Story = {
    render: () => ({
        components: { Checkbox },
        template: `
            <div class="flex flex-col gap-4">
                <div class="flex items-center space-x-2">
                    <Checkbox id="checkbox-disabled" disabled />
                    <label for="checkbox-disabled" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                        Disabled unchecked
                    </label>
                </div>
                <div class="flex items-center space-x-2">
                    <Checkbox id="checkbox-disabled-checked" checked disabled />
                    <label for="checkbox-disabled-checked" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                        Disabled checked
                    </label>
                </div>
            </div>
        `,
    }),
};

export const Multiple: Story = {
    render: () => ({
        components: { Checkbox },
        setup() {
            const items = ref([
                { id: '1', label: 'Item 1', checked: false },
                { id: '2', label: 'Item 2', checked: true },
                { id: '3', label: 'Item 3', checked: false },
            ]);
            return { items };
        },
        template: `
            <div class="flex flex-col gap-4">
                <div v-for="item in items" :key="item.id" class="flex items-center space-x-2">
                    <Checkbox :id="'checkbox-' + item.id" v-model:checked="item.checked" />
                    <label :for="'checkbox-' + item.id" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                        {{ item.label }}
                    </label>
                </div>
            </div>
        `,
    }),
};

export const WithForm: Story = {
    render: () => ({
        components: { Checkbox },
        setup() {
            const newsletter = ref(false);
            const marketing = ref(true);
            const updates = ref(false);
            return { newsletter, marketing, updates };
        },
        template: `
            <div class="space-y-4">
                <h3 class="text-lg font-semibold">Notification Preferences</h3>
                <div class="flex items-center space-x-2">
                    <Checkbox id="newsletter" v-model:checked="newsletter" />
                    <label for="newsletter" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                        Subscribe to newsletter
                    </label>
                </div>
                <div class="flex items-center space-x-2">
                    <Checkbox id="marketing" v-model:checked="marketing" />
                    <label for="marketing" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                        Receive marketing emails
                    </label>
                </div>
                <div class="flex items-center space-x-2">
                    <Checkbox id="updates" v-model:checked="updates" />
                    <label for="updates" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                        Product updates
                    </label>
                </div>
            </div>
        `,
    }),
};

