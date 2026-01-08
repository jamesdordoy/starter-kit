import type { Meta, StoryObj } from '@storybook/vue3-vite';
import TextLink from '@/components/TextLink.vue';

const meta = {
    title: 'Components/TextLink',
    component: TextLink,
    tags: ['autodocs'],
    argTypes: {
        href: {
            control: 'text',
        },
        method: {
            control: 'select',
            options: ['get', 'post', 'put', 'patch', 'delete'],
        },
        as: {
            control: 'text',
        },
        tabindex: {
            control: 'number',
        },
    },
    args: {
        href: '/example',
    },
} satisfies Meta<typeof TextLink>;

export default meta;
type Story = StoryObj<typeof meta>;

export const Default: Story = {
    args: {
        href: '/example',
        children: 'Click me',
    },
    render: (args) => ({
        components: { TextLink },
        setup() {
            return { args };
        },
        template: '<TextLink v-bind="args">{{ args.children || "Link" }}</TextLink>',
    }),
};

export const InParagraph: Story = {
    render: () => ({
        components: { TextLink },
        template: `
            <p>
                This is a paragraph with a <TextLink href="/link">text link</TextLink> inside it.
                You can have multiple <TextLink href="/another">links</TextLink> in the same paragraph.
            </p>
        `,
    }),
};

export const Multiple: Story = {
    render: () => ({
        components: { TextLink },
        template: `
            <div class="flex flex-col gap-2">
                <TextLink href="/home">Home</TextLink>
                <TextLink href="/about">About</TextLink>
                <TextLink href="/contact">Contact</TextLink>
                <TextLink href="/blog">Blog</TextLink>
            </div>
        `,
    }),
};

export const WithMethod: Story = {
    args: {
        href: '/logout',
        method: 'post',
        children: 'Logout',
    },
    render: (args) => ({
        components: { TextLink },
        setup() {
            return { args };
        },
        template: '<TextLink v-bind="args">{{ args.children || "Submit" }}</TextLink>',
    }),
};

