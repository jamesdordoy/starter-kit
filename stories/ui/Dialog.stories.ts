import type { Meta, StoryObj } from '@storybook/vue3-vite';
import { ref } from 'vue';
import {
    Dialog,
    DialogTrigger,
    DialogContent,
    DialogHeader,
    DialogTitle,
    DialogDescription,
    DialogFooter,
    DialogClose,
} from '@/components/ui/dialog';
import { Button } from '@/components/ui/button';

const meta = {
    title: 'UI/Dialog',
    component: Dialog,
    tags: ['autodocs'],
} satisfies Meta<typeof Dialog>;

export default meta;
type Story = StoryObj<typeof meta>;

export const Default: Story = {
    render: () => ({
        components: {
            Dialog,
            DialogTrigger,
            DialogContent,
            DialogHeader,
            DialogTitle,
            DialogDescription,
            DialogFooter,
            Button,
        },
        setup() {
            const open = ref(false);
            return { open };
        },
        template: `
            <Dialog v-model:open="open">
                <DialogTrigger as-child>
                    <Button>Open Dialog</Button>
                </DialogTrigger>
                <DialogContent>
                    <DialogHeader>
                        <DialogTitle>Are you sure?</DialogTitle>
                        <DialogDescription>
                            This action cannot be undone. This will permanently delete your account
                            and remove your data from our servers.
                        </DialogDescription>
                    </DialogHeader>
                    <DialogFooter>
                        <Button variant="outline" @click="open = false">Cancel</Button>
                        <Button variant="destructive" @click="open = false">Delete</Button>
                    </DialogFooter>
                </DialogContent>
            </Dialog>
        `,
    }),
};

export const Simple: Story = {
    render: () => ({
        components: {
            Dialog,
            DialogTrigger,
            DialogContent,
            DialogHeader,
            DialogTitle,
            Button,
        },
        setup() {
            const open = ref(false);
            return { open };
        },
        template: `
            <Dialog v-model:open="open">
                <DialogTrigger as-child>
                    <Button>Open Simple Dialog</Button>
                </DialogTrigger>
                <DialogContent>
                    <DialogHeader>
                        <DialogTitle>Simple Dialog</DialogTitle>
                    </DialogHeader>
                    <p class="py-4">This is a simple dialog with just a title.</p>
                    <DialogFooter>
                        <Button @click="open = false">Close</Button>
                    </DialogFooter>
                </DialogContent>
            </Dialog>
        `,
    }),
};

export const WithForm: Story = {
    render: () => ({
        components: {
            Dialog,
            DialogTrigger,
            DialogContent,
            DialogHeader,
            DialogTitle,
            DialogDescription,
            DialogFooter,
            Button,
        },
        setup() {
            const open = ref(false);
            const name = ref('');
            return { open, name };
        },
        template: `
            <Dialog v-model:open="open">
                <DialogTrigger as-child>
                    <Button>Edit Profile</Button>
                </DialogTrigger>
                <DialogContent>
                    <DialogHeader>
                        <DialogTitle>Edit Profile</DialogTitle>
                        <DialogDescription>
                            Make changes to your profile here. Click save when you're done.
                        </DialogDescription>
                    </DialogHeader>
                    <div class="grid gap-4 py-4">
                        <div class="grid gap-2">
                            <label for="name" class="text-sm font-medium">Name</label>
                            <input
                                id="name"
                                v-model="name"
                                placeholder="Enter your name"
                                class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors"
                            />
                        </div>
                    </div>
                    <DialogFooter>
                        <Button variant="outline" @click="open = false">Cancel</Button>
                        <Button @click="open = false">Save Changes</Button>
                    </DialogFooter>
                </DialogContent>
            </Dialog>
        `,
    }),
};

export const Confirmation: Story = {
    render: () => ({
        components: {
            Dialog,
            DialogTrigger,
            DialogContent,
            DialogHeader,
            DialogTitle,
            DialogDescription,
            DialogFooter,
            Button,
        },
        setup() {
            const open = ref(false);
            return { open };
        },
        template: `
            <Dialog v-model:open="open">
                <DialogTrigger as-child>
                    <Button variant="destructive">Delete Item</Button>
                </DialogTrigger>
                <DialogContent>
                    <DialogHeader>
                        <DialogTitle>Confirm Deletion</DialogTitle>
                        <DialogDescription>
                            Are you sure you want to delete this item? This action cannot be undone.
                        </DialogDescription>
                    </DialogHeader>
                    <DialogFooter>
                        <Button variant="outline" @click="open = false">Cancel</Button>
                        <Button variant="destructive" @click="open = false">Delete</Button>
                    </DialogFooter>
                </DialogContent>
            </Dialog>
        `,
    }),
};

export const LongContent: Story = {
    render: () => ({
        components: {
            Dialog,
            DialogTrigger,
            DialogContent,
            DialogHeader,
            DialogTitle,
            DialogDescription,
            DialogFooter,
            Button,
        },
        setup() {
            const open = ref(false);
            return { open };
        },
        template: `
            <Dialog v-model:open="open">
                <DialogTrigger as-child>
                    <Button>View Long Content</Button>
                </DialogTrigger>
                <DialogContent>
                    <DialogHeader>
                        <DialogTitle>Terms and Conditions</DialogTitle>
                        <DialogDescription>
                            Please read through our terms and conditions carefully.
                        </DialogDescription>
                    </DialogHeader>
                    <div class="max-h-[400px] overflow-y-auto py-4">
                        <p class="mb-4">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                            nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                        <p class="mb-4">
                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                            eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                            sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                        <p class="mb-4">
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                            doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                            veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                        </p>
                        <p class="mb-4">
                            Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit,
                            sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
                        </p>
                        <p>
                            Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                            adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et
                            dolore magnam aliquam quaerat voluptatem.
                        </p>
                    </div>
                    <DialogFooter>
                        <Button variant="outline" @click="open = false">Decline</Button>
                        <Button @click="open = false">Accept</Button>
                    </DialogFooter>
                </DialogContent>
            </Dialog>
        `,
    }),
};

