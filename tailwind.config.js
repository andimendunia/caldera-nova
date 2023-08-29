import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors : {
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
                    900: '#775e96', // ungu asli caldera
                    950: '#2c265c',
                },
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
