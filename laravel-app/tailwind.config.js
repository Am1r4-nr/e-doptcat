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
                script: ['Dancing Script', 'cursive'],
            },
            colors: {
                /* Legacy boho palette (kept for backward compat) */
                'boho-brown': '#72685E',
                'boho-orange': '#FF750F',
                'boho-cream': '#F0DE9E',
                'boho-bg': '#FFF9F0',
                'boho-light': '#FAF5E8',

                /* ── Cozy Cafe palette ──────────────── */
                'cozy-bg':     '#F5E6D3',   // warm latte background
                'cozy-card':   '#FDF6EC',   // cream card surface
                'cozy-brown':  '#3C2415',   // deep espresso text
                'cozy-accent': '#C8956D',   // caramel accent
                'cozy-warm':   '#E8C9A0',   // warm highlight
                'cozy-gold':   '#D4A574',   // golden accent
                'cozy-light':  '#F9EFE2',   // very light cream
            },
            animation: {
                'blob': 'blobPulse 10s ease-in-out infinite',
                'float': 'floatSlow 8s ease-in-out infinite',
            },
            keyframes: {
                blobPulse: {
                    '0%, 100%': { borderRadius: '60% 40% 70% 30% / 50% 60% 40% 70%' },
                    '50%': { borderRadius: '40% 60% 30% 70% / 60% 40% 70% 50%' },
                },
                floatSlow: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-15px)' },
                },
            },
        },
    },

    plugins: [forms],
};
