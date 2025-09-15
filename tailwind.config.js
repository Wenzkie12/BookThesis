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
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                text: '#070a05',
                background: '#f8faf5',
                primary: '#84b75c',
                secondary: '#e6f1dc',
                accent: '#9ad071',
                danger: '#f04f57',
            },
        },
    },

    plugins: [forms],
};
