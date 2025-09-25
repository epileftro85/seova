import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/tools/keyword-explorer.js',
                'resources/js/tools/meta-tag-analyzer.js',
                'resources/js/tools/site-crawler.js',
                'resources/js/tools/serp-preview.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
