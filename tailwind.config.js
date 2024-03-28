const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    daisyui: {
        themes: [
            "light", "dark", "cupcake", "sunset", "nord", "corporate",
            {
                mytheme: {

                    "primary": "#e8b68f",

                    "secondary": "#b560f7",

                    "accent": "#f954bd",

                    "neutral": "#1f1826",

                    "base-100": "#f1ffff",

                    "info": "#4461ca",

                    "success": "#16c079",

                    "warning": "#f9a448",

                    "error": "#ea1a47",
                },
            },
        ],
    },
    theme: {
        screens: {
            'sm': '640px',
            // => @media (min-width: 640px) { ... }

            'md': '768px',
            // => @media (min-width: 768px) { ... }

            'lg': '1024px',
            // => @media (min-width: 1024px) { ... }

            'xl': '1280px',
            // => @media (min-width: 1280px) { ... }
            'xxl': '1340px',
            // => @media (min-width: 1280px) { ... }

            '2xl': '1536px',
            // => @media (min-width: 1536px) { ... }
        },
        fontFamily: {
            sans: ['Graphik', 'sans-serif'],
            serif: ['Merriweather', 'serif'],
        },
        extend: {
            spacing: {
                '125': '18rem',
                '126': '23rem',
                '127': '30rem',
                '128': '38rem',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require("daisyui")],
};
