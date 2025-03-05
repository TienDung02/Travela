import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/style.css',
                'resources/css/bootstrap.min.css',
                'resources/js/app.js',
                'resources/js/func.js',
                'resources/js/main.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
