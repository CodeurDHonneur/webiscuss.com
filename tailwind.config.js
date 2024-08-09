import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class', //avec l'option class, il est recherché une class 'dark'
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'text-primary': 'var(--text-color)',
                'bg-primary': 'var(--bg-color)',
                'accent': 'var(--accent)',
                'border': 'var(--border)',
                'icon': 'var(--icon)',
                'icon-hover': 'var(--icon-hover)',
            }
        },
    },

    plugins: 
    [
        forms,
        require('tailwind-scrollbar')
    ],
};
