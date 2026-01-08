import type { StorybookConfig } from '@storybook/vue3-vite';
import path from 'path';
import { fileURLToPath } from 'url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));

const config: StorybookConfig = {
  "stories": [
    "../stories/**/*.mdx",
    "../stories/**/*.stories.@(js|jsx|mjs|ts|tsx)"
  ],
  "addons": [
    "@chromatic-com/storybook",
    "@storybook/addon-vitest",
    "@storybook/addon-a11y",
    "@storybook/addon-docs",
    "@storybook/addon-onboarding"
  ],
  "framework": "@storybook/vue3-vite",
  staticDirs: [{ from: "../src/stories/assets", to: "../stories/assets" }],
  async viteFinal(config) {
    // Set base path explicitly to prevent undefined in asset URLs
    config.base = config.base || '/';
    
    // Add alias to mock @inertiajs/vue3 in Storybook
    config.resolve = config.resolve || {};
    config.resolve.alias = {
      ...config.resolve.alias,
      '@inertiajs/vue3': path.resolve(__dirname, './mocks/@inertiajs/vue3.ts'),
    };
    
    // Ensure SVG and image files are treated as static assets
    // This makes imports return URL strings instead of undefined
    if (!config.assetsInclude) {
      config.assetsInclude = [];
    }
    config.assetsInclude.push('**/*.svg', '**/*.png', '**/*.jpg', '**/*.jpeg', '**/*.gif', '**/*.webp', '**/*.avif');
    
    return config;
  },
};
export default config;