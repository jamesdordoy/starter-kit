import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import path from 'path';
import tailwindcss from "@tailwindcss/vite";
import { resolve } from 'node:path';
import { defineConfig } from 'vite';
import fs from 'fs';
// No dotenv import!

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
});