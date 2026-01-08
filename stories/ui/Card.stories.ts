import type { Meta, StoryObj } from '@storybook/vue3-vite';
import {
    Card,
    CardHeader,
    CardTitle,
    CardDescription,
    CardContent,
    CardFooter,
    CardAction,
} from '@/components/ui/card';
import { Button } from '@/components/ui/button';

const meta = {
    title: 'UI/Card',
    component: Card,
    tags: ['autodocs'],
} satisfies Meta<typeof Card>;

export default meta;
type Story = StoryObj<typeof meta>;

export const Default: Story = {
    render: () => ({
        components: { Card, CardHeader, CardTitle, CardContent },
        template: `
            <Card>
                <CardHeader>
                    <CardTitle>Card Title</CardTitle>
                </CardHeader>
                <CardContent>
                    <p>This is the card content. You can put any content here.</p>
                </CardContent>
            </Card>
        `,
    }),
};

export const WithDescription: Story = {
    render: () => ({
        components: { Card, CardHeader, CardTitle, CardDescription, CardContent },
        template: `
            <Card>
                <CardHeader>
                    <CardTitle>Card Title</CardTitle>
                    <CardDescription>This is a description of the card content.</CardDescription>
                </CardHeader>
                <CardContent>
                    <p>Card content goes here.</p>
                </CardContent>
            </Card>
        `,
    }),
};

export const WithFooter: Story = {
    render: () => ({
        components: { Card, CardHeader, CardTitle, CardDescription, CardContent, CardFooter, Button },
        template: `
            <Card>
                <CardHeader>
                    <CardTitle>Card Title</CardTitle>
                    <CardDescription>Card description text.</CardDescription>
                </CardHeader>
                <CardContent>
                    <p>This is the main content of the card.</p>
                </CardContent>
                <CardFooter>
                    <Button>Action</Button>
                </CardFooter>
            </Card>
        `,
    }),
};

export const WithAction: Story = {
    render: () => ({
        components: { Card, CardHeader, CardTitle, CardDescription, CardContent, CardAction, Button },
        template: `
            <Card>
                <CardHeader>
                    <CardTitle>Card Title</CardTitle>
                    <CardDescription>Card with action button in header.</CardDescription>
                    <CardAction>
                        <Button variant="ghost" size="sm">Action</Button>
                    </CardAction>
                </CardHeader>
                <CardContent>
                    <p>Card content with action button in the header.</p>
                </CardContent>
            </Card>
        `,
    }),
};

export const Complex: Story = {
    render: () => ({
        components: { Card, CardHeader, CardTitle, CardDescription, CardContent, CardFooter, Button },
        template: `
            <Card>
                <CardHeader>
                    <CardTitle>Project Settings</CardTitle>
                    <CardDescription>Manage your project settings and preferences.</CardDescription>
                </CardHeader>
                <CardContent>
                    <div class="space-y-4">
                        <div>
                            <h4 class="font-medium mb-2">Project Name</h4>
                            <p class="text-sm text-muted-foreground">My Awesome Project</p>
                        </div>
                        <div>
                            <h4 class="font-medium mb-2">Status</h4>
                            <p class="text-sm text-muted-foreground">Active</p>
                        </div>
                    </div>
                </CardContent>
                <CardFooter class="flex justify-between">
                    <Button variant="outline">Cancel</Button>
                    <Button>Save Changes</Button>
                </CardFooter>
            </Card>
        `,
    }),
};

export const Multiple: Story = {
    render: () => ({
        components: { Card, CardHeader, CardTitle, CardDescription, CardContent },
        template: `
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <Card>
                    <CardHeader>
                        <CardTitle>Card 1</CardTitle>
                        <CardDescription>First card</CardDescription>
                    </CardHeader>
                    <CardContent>
                        <p>Content for card 1</p>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader>
                        <CardTitle>Card 2</CardTitle>
                        <CardDescription>Second card</CardDescription>
                    </CardHeader>
                    <CardContent>
                        <p>Content for card 2</p>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader>
                        <CardTitle>Card 3</CardTitle>
                        <CardDescription>Third card</CardDescription>
                    </CardHeader>
                    <CardContent>
                        <p>Content for card 3</p>
                    </CardContent>
                </Card>
            </div>
        `,
    }),
};

