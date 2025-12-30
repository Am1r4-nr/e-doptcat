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
                sans: ['Lato', ...defaultTheme.fontFamily.sans],
                serif: ['Playfair Display', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                'boho-brown': '#72685E',
                'boho-orange': '#FF750F',
                'boho-cream': '#F0DE9E',
                'boho-bg': '#FFF9F0',
                'boho-light': '#FAF5E8',
            },
        },
    },

    plugins: [forms],
};
