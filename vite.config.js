import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

// import livewire from '@defstudio/vite-livewire-plugin';

export default defineConfig({
    server: {
        hmr: {
            host: '172.70.52.99',
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        // livewire({  // <-- add livewire plugin
        //     refresh: ['resources/css/app.css'],  // <-- will refresh css (tailwind ) as well
        // }),
    ],
});
