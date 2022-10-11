import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/chart/line.js',
                'resources/js/chart/pie.js',
                'resources/js/chart/sells.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        target: 'esnext'
    }
});
