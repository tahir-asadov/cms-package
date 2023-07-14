import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/tacms.css',
                'resources/js/tacms.js',
            ],
            refresh: true,
        }),
    ],
});
