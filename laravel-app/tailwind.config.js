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
                sans: ['DM Sans', 'Lato', ...defaultTheme.fontFamily.sans],
                serif: ['Playfair Display', ...defaultTheme.fontFamily.serif],
<<<<<<< HEAD
                script: ['Dancing Script', 'cursive'],
            },
            colors: {
                /* Legacy boho palette (kept for backward compat) */
=======
                montserrat: ['Montserrat', ...defaultTheme.fontFamily.sans],
                gerhaus: ['Gerhaus', 'Montserrat', ...defaultTheme.fontFamily.sans],
                script: ['Dancing Script', 'cursive'],
            },
            colors: {
                /* legacy boho palette */
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
                'boho-brown': '#72685E',
                'boho-orange': '#FF750F',
                'boho-cream': '#F0DE9E',
                'boho-bg': '#FFF9F0',
                'boho-light': '#FAF5E8',
<<<<<<< HEAD

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
=======
                /* Pawse / e-Doptcat user palette */
                'p-cream':  '#F5EDDD',
                'p-warm':   '#EDE4D3',
                'p-olive':  '#5B6B2E',
                'p-olive-l':'#7A8C4A',
                'p-olive-d':'#3D4A1E',
                'p-forest': '#2C3317',
                'p-brown':  '#8B7355',
                'p-accent': '#D4A574',
                'p-muted':  '#6B6352',
                /* User Page Theme Palette (Green) */
                'u-cream': '#EADFC5',
                'u-light': '#A8B981',
                'u-dark':  '#364025',
                /* Cozy Cafe Theme Palette (Requested from image) */
                'cozy-bg': '#E6C697',    /* Warm mustard/beige background */
                'cozy-brown': '#6F4E37', /* Dark brown text/buttons */
                'cozy-card': '#FFF4E3',  /* Cream card background */
                'cozy-light': '#F5DEB3', /* Lighter beige for waves */
>>>>>>> 0bb3cf11e6d92ef905b229714ead22ce22349a5c
            },
        },
    },

    plugins: [forms],
};
