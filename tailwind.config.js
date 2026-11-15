import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.blade.php',      // ← catch everything under resources
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                community: {
                    ink: '#182723',
                    'ink-hover': '#1f302b',
                    'ink-deep': '#111b18',
                    'ink-panel': '#24332e',
                    ochre: '#e5b64f',
                    'ochre-hover': '#d7a93f',
                    'ochre-dark': '#80600f',
                },
            },
            fontFamily: {
                sans: [ '',   'Figtree', ...defaultTheme.fontFamily.sans],
                mono: ['DM Mono', ...defaultTheme.fontFamily.mono],
                display: ['Instrument Serif', ...defaultTheme.fontFamily.serif],
            },
        },
    },

    plugins: [forms],
};
