import type { Meta, StoryObj } from '@storybook/vue3-vite';
import { ref } from 'vue';
import { Select } from '@/components/ui/select';

const meta = {
    title: 'UI/Select',
    component: Select,
    tags: ['autodocs'],
    argTypes: {
        modelValue: {
            control: 'text',
        },
        placeholder: {
            control: 'text',
        },
        label: {
            control: 'text',
        },
    },
} satisfies Meta<typeof Select>;

export default meta;
type Story = StoryObj<typeof meta>;

const defaultOptions = [
    { label: 'Option 1', value: '1' },
    { label: 'Option 2', value: '2' },
    { label: 'Option 3', value: '3' },
];

export const Default: Story = {
    render: () => ({
        components: { Select },
        setup() {
            const value = ref(null);
            return { value, options: defaultOptions };
        },
        template: `
            <Select v-model="value" :options="options" placeholder="Select an option..." />
        `,
    }),
};

export const WithLabel: Story = {
    render: () => ({
        components: { Select },
        setup() {
            const value = ref(null);
            return { value, options: defaultOptions };
        },
        template: `
            <Select v-model="value" :options="options" label="Choose an option" placeholder="Select..." />
        `,
    }),
};

export const WithValue: Story = {
    render: () => ({
        components: { Select },
        setup() {
            const value = ref('2');
            return { value, options: defaultOptions };
        },
        template: `
            <Select v-model="value" :options="options" placeholder="Select an option..." />
        `,
    }),
};

export const ManyOptions: Story = {
    render: () => ({
        components: { Select },
        setup() {
            const value = ref(null);
            const options = Array.from({ length: 20 }, (_, i) => ({
                label: `Option ${i + 1}`,
                value: String(i + 1),
            }));
            return { value, options };
        },
        template: `
            <Select v-model="value" :options="options" placeholder="Select from many options..." />
        `,
    }),
};

export const Countries: Story = {
    render: () => ({
        components: { Select },
        setup() {
            const value = ref(null);
            const options = [
                { label: 'United States', value: 'us' },
                { label: 'United Kingdom', value: 'uk' },
                { label: 'Canada', value: 'ca' },
                { label: 'Australia', value: 'au' },
                { label: 'Germany', value: 'de' },
                { label: 'France', value: 'fr' },
                { label: 'Japan', value: 'jp' },
            ];
            return { value, options };
        },
        template: `
            <Select v-model="value" :options="options" placeholder="Select a country..." />
        `,
    }),
};

