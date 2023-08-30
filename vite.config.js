import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

// import livewire from '@defstudio/vite-livewire-plugin';

export default defineConfig({
    server: {
        hmr: {
            host: '172.70.52.99',
        },
    },
    theme: {
        extend: {
            colors: {
                'caldy': {
                    50: '#f3f0f9',
                    100: '#e6e2f4',
                    200: '#cec6eb',
                    300: '#b4a5e1',
                    400: '#9984d6',
                    500: '#7f63cc',
                    600: '#7257c3',
                    700: '#654db8',
                    800: '#5741ae',
                    900: '#775e96',
                    950: '#2c265c'
                },
            },
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
