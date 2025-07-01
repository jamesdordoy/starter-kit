<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { DateRangePicker } from '@/components/ui/date-range-picker';
import { Filepond } from '@/components/ui/filepond';
import { Input } from '@/components/ui/input';
import { Pagination } from '@/components/ui/pagination';
import { Select } from '@/components/ui/select';
import TagsInput from '@/components/ui/tags-input/TagsInput.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import type { PaginatedCollection } from '@/types/paginated-collection';
import { Head } from '@inertiajs/vue3';
import type { DateRange } from 'reka-ui';
import { ref } from 'vue';
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import Progress from '@/components/ui/progress/Progress.vue';
import Switch from '@/components/ui/switch/Switch.vue';
import Slider from '@/components/ui/slider/Slider.vue';
import RadioGroup from '@/components/ui/radio-group/RadioGroup.vue';

interface Props {
    users: PaginatedCollection<App.Data.UserData>;
}

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Sink',
        href: '/time-to-wash-up',
    },
];

// Example state for components
const searchQuery = ref('');
const selectedUser = ref<string | number | undefined>(undefined);
const dateRange = ref<DateRange>();
const currentPage = ref(1);
const selectedUsers = ref<App.Data.UserData[]>([]);

// Example options for Select
const userOptions = [
    { label: 'Select a user', value: undefined },
    ...props.users.data.map((user) => ({
        label: user.name,
        value: user.id,
    })),
];
</script>

<template>
    <Head title="Kitchen Sink" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto space-y-12 py-8">
            <!-- Section Headers -->
            <div class="space-y-2">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-gray-100">Kitchen Sink</h1>
                <p class="text-lg text-gray-500 dark:text-gray-400">A showcase of all UI components</p>
            </div>

            <!-- Form Controls Section -->
            <section class="space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">Form Controls</h2>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Interactive form elements</div>
                </div>

                <div class="grid gap-8 md:grid-cols-2">
                    <!-- Input Examples -->
                    <div class="space-y-6 rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                        <div class="space-y-2">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Input</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Text input fields with various types</p>
                        </div>
                        <div class="space-y-4">
                            <Input v-model="searchQuery" type="text" placeholder="Search users..." />
                            <Input type="email" placeholder="Email address" />
                            <Input type="password" placeholder="Password" />
                        </div>
                    </div>

                    <!-- Select Example -->
                    <div class="space-y-6 rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                        <div class="space-y-2">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Select</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Dropdown selection with custom options</p>
                        </div>
                        <Select v-model="selectedUser" :options="userOptions" placeholder="Select a user" />
                    </div>

                    <!-- DateRangePicker Example -->
                    <div class="space-y-6 rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                        <div class="space-y-2">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Date Range Picker</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Select a range of dates</p>
                        </div>
                        <DateRangePicker v-model="dateRange" placeholder="Select date range" />
                    </div>

                    <!-- Filepond Example -->
                    <div class="space-y-6 rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                        <div class="space-y-2">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">File Upload</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Drag and drop file uploader</p>
                        </div>
                        <Filepond :files="[]" :single="false" route="settings.media-items.store" />
                    </div>

                    <!-- TagsInput Examples -->
                    <div class="space-y-6 rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                        <div class="space-y-2">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">User Selection</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Select multiple users</p>
                        </div>
                        <TagsInput v-model="selectedUsers" :items="props.users.data" placeholder="Search users by name or email..." />
                    </div>
                </div>
            </section>

            <!-- Button Section -->
            <section class="space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">Buttons</h2>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Various button styles and variants</div>
                </div>
                <div class="rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                    <div class="flex flex-wrap gap-4">
                        <Button>Default</Button>
                        <Button variant="secondary">Secondary</Button>
                        <Button variant="destructive">Destructive</Button>
                        <Button variant="outline">Outline</Button>
                        <Button variant="ghost">Ghost</Button>
                        <Button variant="link">Link</Button>
                    </div>
                </div>
            </section>

            <!-- Dialog Example Section -->
            <section class="space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">Dialog</h2>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Modal dialog example</div>
                </div>
                <div class="rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                    <Dialog>
                        <DialogTrigger as-child>
                            <Button variant="outline">Open Dialog</Button>
                        </DialogTrigger>
                        <DialogContent>
                            <DialogHeader class="space-y-3">
                                <DialogTitle>Dialog Example</DialogTitle>
                                <DialogDescription>
                                    This is a simple dialog example. You can use dialogs to display important information or ask for user confirmation.
                                </DialogDescription>
                            </DialogHeader>
                            <DialogFooter class="gap-2">
                                <DialogClose as-child>
                                    <Button variant="secondary">Cancel</Button>
                                </DialogClose>
                                <DialogClose as-child>
                                    <Button variant="destructive">Confirm</Button>
                                </DialogClose>
                            </DialogFooter>
                        </DialogContent>
                    </Dialog>
                </div>
            </section>

            <!-- Progress Example Section -->
            <section class="space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">Progress</h2>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Animated progress bar example</div>
                </div>
                <div class="rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900 space-y-6">
                    <div>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">Default (startValue = 0)</p>
                        <Progress />
                    </div>
                    <div>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">Start at 50</p>
                        <Progress :startValue="50" />
                    </div>
                </div>
            </section>

            <!-- Switch & Slider Example Section -->
            <section class="space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">Switch & Slider</h2>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Toggle and range input components</div>
                </div>
                <div class="rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900 space-y-6">
                    <div>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">Switch Example</p>
                        <Switch />
                    </div>
                    <div>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">Slider Example</p>
                        <Slider />
                    </div>
                </div>
            </section>

            <!-- Radio Group Example Section -->
            <section class="space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">Radio Group</h2>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Single-select radio group component</div>
                </div>
                <div class="rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900 space-y-6">
                    <RadioGroup />
                </div>
            </section>

            <!-- Pagination Section -->
            <section class="space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">Pagination</h2>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Page navigation with data</div>
                </div>
                <div class="rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                    <Pagination :data="users" @update:page="currentPage = $event" />
                </div>
            </section>

            <!-- Data Display Section -->
            <section class="space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">Data Display</h2>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Current component states</div>
                </div>
                <div class="rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Current State</h3>
                        <div class="grid gap-4 text-sm md:grid-cols-2">
                            <div class="space-y-2">
                                <p class="text-gray-500 dark:text-gray-400">Search Query</p>
                                <p class="font-medium text-gray-900 dark:text-gray-100">{{ searchQuery || 'Empty' }}</p>
                            </div>
                            <div class="space-y-2">
                                <p class="text-gray-500 dark:text-gray-400">Selected User</p>
                                <p class="font-medium text-gray-900 dark:text-gray-100">{{ selectedUser || 'None' }}</p>
                            </div>
                            <div class="space-y-2">
                                <p class="text-gray-500 dark:text-gray-400">Date Range</p>
                                <p class="font-medium text-gray-900 dark:text-gray-100">
                                    {{ dateRange ? `${dateRange.start} to ${dateRange.end}` : 'Not selected' }}
                                </p>
                            </div>
                            <div class="space-y-2">
                                <p class="text-gray-500 dark:text-gray-400">Current Page</p>
                                <p class="font-medium text-gray-900 dark:text-gray-100">{{ currentPage }}</p>
                            </div>
                            <div class="space-y-2">
                                <p class="text-gray-500 dark:text-gray-400">Selected Users</p>
                                <p class="font-medium text-gray-900 dark:text-gray-100">
                                    {{ selectedUsers.length ? selectedUsers.map((user) => user.name).join(', ') : 'None' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </AppLayout>
</template>
