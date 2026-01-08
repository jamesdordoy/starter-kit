import type { Meta, StoryObj } from '@storybook/vue3-vite';
import { ref } from 'vue';
import TagsInput from '@/components/ui/tags-input/TagsInput.vue';

const meta = {
    title: 'UI/TagsInput',
    component: TagsInput,
    tags: ['autodocs'],
    argTypes: {
        placeholder: {
            control: 'text',
        },
    },
} satisfies Meta<typeof TagsInput>;

export default meta;
type Story = StoryObj<typeof meta>;

const mockUsers = [
    { id: 1, name: 'John Doe', email: 'john@example.com' },
    { id: 2, name: 'Jane Smith', email: 'jane@example.com' },
    { id: 3, name: 'Bob Johnson', email: 'bob@example.com' },
    { id: 4, name: 'Alice Williams', email: 'alice@example.com' },
    { id: 5, name: 'Charlie Brown', email: 'charlie@example.com' },
];

export const Default: Story = {
    render: () => ({
        components: { TagsInput },
        setup() {
            const selectedUsers = ref([]);
            return { selectedUsers, items: mockUsers };
        },
        template: '<TagsInput v-model="selectedUsers" :items="items" placeholder="Search users by name or email..." />',
    }),
};

export const WithSelections: Story = {
    render: () => ({
        components: { TagsInput },
        setup() {
            const selectedUsers = ref([mockUsers[0], mockUsers[1]]);
            return { selectedUsers, items: mockUsers };
        },
        template: '<TagsInput v-model="selectedUsers" :items="items" placeholder="Search users by name or email..." />',
    }),
};

export const CustomPlaceholder: Story = {
    render: () => ({
        components: { TagsInput },
        setup() {
            const selectedUsers = ref([]);
            return { selectedUsers, items: mockUsers };
        },
        template: '<TagsInput v-model="selectedUsers" :items="items" placeholder="Select team members..." />',
    }),
};

export const ManyOptions: Story = {
    render: () => ({
        components: { TagsInput },
        setup() {
            const selectedUsers = ref([]);
            const manyUsers = Array.from({ length: 50 }, (_, i) => ({
                id: i + 1,
                name: `User ${i + 1}`,
                email: `user${i + 1}@example.com`,
            }));
            return { selectedUsers, items: manyUsers };
        },
        template: '<TagsInput v-model="selectedUsers" :items="items" placeholder="Search from many users..." />',
    }),
};

