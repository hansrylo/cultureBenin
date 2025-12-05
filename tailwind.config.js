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
            colors: {
                primary: {
                    DEFAULT: '#002B6A', // Original Deep Blue
                    light: '#007FE6',   // Original Bright Blue
                    dark: '#001F4D',
                },
                secondary: {
                    DEFAULT: '#D4AF37', // Metallic Gold
                    light: '#FCD116',   // Standard Benin Yellow
                    dark: '#B5952F',
                },
                accent: {
                    DEFAULT: '#E8112D', // Benin Red
                    light: '#FF4D6A',
                    dark: '#C00E25',
                },
                neutral: {
                    50: '#F9FAFB',
                    100: '#F3F4F6',
                    200: '#E5E7EB',
                    300: '#D1D5DB',
                    400: '#9CA3AF',
                    500: '#6B7280',
                    600: '#4B5563',
                    700: '#374151',
                    800: '#1F2937',
                    900: '#111827',
                },
                cream: '#F7F6F1', // Off-white background
            },
            fontFamily: {
                sans: ['Outfit', 'sans-serif'],
                serif: ['Playfair Display', 'serif'],
                display: ['Playfair Display', 'serif'],
            },
            boxShadow: {
                'premium': '0 4px 20px -2px rgba(0, 0, 0, 0.1)',
                'premium-hover': '0 10px 25px -5px rgba(0, 0, 0, 0.15), 0 8px 10px -6px rgba(0, 0, 0, 0.1)',
            },
        },
    },

    plugins: [forms],
};
