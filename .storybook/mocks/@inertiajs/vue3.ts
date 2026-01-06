import { fn } from 'storybook/test';
import { h } from 'vue';
import type { Component } from 'vue';

// Mock router with all Inertia router methods
export const router = {
    post: fn((url: string, data: any, options?: any) => {
        console.log('Mock router.post called:', { url, data, options });
        if (options?.onStart) options.onStart();
        // Simulate success after a delay
        setTimeout(() => {
            if (options?.onSuccess) options.onSuccess();
        }, 100);
    }),
    get: fn(),
    put: fn(),
    patch: fn(),
    delete: fn(),
    visit: fn(),
    reload: fn(),
    replace: fn(),
    remember: fn(),
    restore: fn(),
    forget: fn(),
    flushAll: fn(),
};

// Mock Link component - a simple wrapper that renders an anchor tag
// Handles all Inertia Link props: href, method, as, prefetch, tabindex, etc.
export const Link = {
    name: 'Link',
    props: {
        href: String,
        method: String,
        as: String,
        prefetch: [Boolean, String],
        tabindex: [Number, String],
    },
    setup(props: any, { slots }: any) {
        return () => {
            // In Storybook, render as a simple anchor tag
            // In real app, this would use Inertia router for navigation
            return h('a', {
                href: props.href || '#',
                tabindex: props.tabindex,
                onClick: (e: Event) => {
                    e.preventDefault();
                    console.log('Mock Link clicked:', props.href);
                },
            }, slots.default?.());
        };
    },
} as Component;

// Mock usePage composable
export const usePage = () => ({
    props: {
        auth: {
            user: null,
            can: {},
            impersonator: null,
        },
    },
    url: '/',
});

// Mock other Inertia exports that might be used
export const Head = {
    name: 'Head',
    template: '<head><slot /></head>',
} as Component;

export default {
    router,
    Link,
    usePage,
    Head,
};

