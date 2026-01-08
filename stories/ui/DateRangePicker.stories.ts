import type { Meta, StoryObj } from '@storybook/vue3-vite';
import { ref } from 'vue';
import { DateRangePicker } from '@/components/ui/date-range-picker';
import type { DateRange } from 'reka-ui';

const meta = {
    title: 'UI/DateRangePicker',
    component: DateRangePicker,
    tags: ['autodocs'],
    argTypes: {
        placeholder: {
            control: 'text',
        },
        label: {
            control: 'text',
        },
    },
} satisfies Meta<typeof DateRangePicker>;

export default meta;
type Story = StoryObj<typeof meta>;

export const Default: Story = {
    render: () => ({
        components: { DateRangePicker },
        setup() {
            const dateRange = ref<DateRange | undefined>(undefined);
            return { dateRange };
        },
        template: '<DateRangePicker v-model="dateRange" placeholder="Select date range" />',
    }),
};

export const WithValue: Story = {
    render: () => ({
        components: { DateRangePicker },
        setup() {
            const dateRange = ref<DateRange | undefined>({
                start: new Date(2024, 0, 1),
                end: new Date(2024, 0, 15),
            });
            return { dateRange };
        },
        template: '<DateRangePicker v-model="dateRange" placeholder="Select date range" />',
    }),
};

export const CustomPlaceholder: Story = {
    render: () => ({
        components: { DateRangePicker },
        setup() {
            const dateRange = ref<DateRange | undefined>(undefined);
            return { dateRange };
        },
        template: '<DateRangePicker v-model="dateRange" placeholder="Choose your dates..." />',
    }),
};

