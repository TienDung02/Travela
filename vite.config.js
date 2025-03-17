import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'public/css/app.css',
                'public/css/style.css',
                'public/css/bootstrap.min.css',
                'public/js/app.js',
                'public/js/func.js',
                'public/js/main.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
