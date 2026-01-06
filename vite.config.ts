/// <reference types="vitest/config" />
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import fs from 'fs';
import laravel from 'laravel-vite-plugin';
import { resolve } from 'node:path';
import path from 'path';
import { defineConfig } from 'vite';
// No dotenv import!
import { storybookTest } from '@storybook/addon-vitest/vitest-plugin';
import { playwright } from '@vitest/browser-playwright';
import { fileURLToPath } from 'node:url';
const dirname = typeof __dirname !== 'undefined' ? __dirname : path.dirname(fileURLToPath(import.meta.url));

// More info at: https://storybook.js.org/docs/next/writing-tests/integrations/vitest-addon
function getHttpsConfig() {
    if (process.env.VITE_HTTPS_KEY && process.env.VITE_HTTPS_CERT) {
        return {
            key: fs.readFileSync(process.env.VITE_HTTPS_KEY),
            cert: fs.readFileSync(process.env.VITE_HTTPS_CERT),
        };
    }
    return undefined; // Use HTTP if not set
}
export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.ts'],
            ssr: 'resources/js/ssr.ts',
            refresh: true,
        }),
        tailwindcss(),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        // ...istanbul plugin...
    ],
    resolve: {
        alias: {
            '#': path.resolve(__dirname, './resources'),
            '@': path.resolve(__dirname, './resources/js'),
            'ziggy-js': resolve(__dirname, 'vendor/tightenco/ziggy'),
        },
    },
    server: {
        https: getHttpsConfig(),
        host: process.env.VITE_DEV_HOST || 'localhost',
        port: Number(process.env.VITE_DEV_PORT) || 5173,
        hmr: {
            host: process.env.VITE_DEV_HOST || 'localhost',
            protocol: process.env.VITE_HTTPS_KEY && process.env.VITE_HTTPS_CERT ? 'wss' : 'ws',
        },
    },
    test: {
        projects: [
            {
                extends: true,
                plugins: [
                    // The plugin will run tests for the stories defined in your Storybook config
                    // See options at: https://storybook.js.org/docs/next/writing-tests/integrations/vitest-addon#storybooktest
                    storybookTest({
                        configDir: path.join(dirname, '.storybook'),
                    }),
                ],
                test: {
                    name: 'storybook',
                    browser: {
                        enabled: true,
                        headless: true,
                        provider: playwright({}),
                        instances: [
                            {
                                browser: 'chromium',
                            },
                        ],
                    },
                    setupFiles: ['.storybook/vitest.setup.ts'],
                },
            },
        ],
    },
});
