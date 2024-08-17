/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        // You will probably also need these lines
        './resources/**/**/*.blade.php',
        './resources/**/**/*.js',
        './app/View/Components/**/**/*.php',
        './app/Livewire/**/**/*.php',

        // Add mary
        './vendor/robsontenorio/mary/src/View/Components/**/*.php',

        // Laravel built in pagination
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],
    theme: {
        extend: {},
        container: {
            center: true,
            padding: {
                DEFAULT: '1rem',
                sm: '2rem',
                lg: '4rem',
                xl: '6rem',
                '2xl': '8rem',
            },
        },
        fontFamily: {
            body: ["'DM Sans'", 'sans-serif'],
        },
    },
    safelist: [
        {
            pattern: /badge-|(bg-primary|bg-success|bg-info|bg-error|bg-warning|bg-neutral|bg-purple|bg-yellow)/,
        },
    ],
    // Add daisyUI
    plugins: [require('daisyui')],

    // Change theme primary color (TODO: better way?)
    daisyui: {
        themes: [
            {
                light: {
                    ...require('daisyui/src/theming/themes').light,
                    primary: '#9b3bf5',
                    'primary-content': '#ffffff',
                    secondary: '#494949',
                    neutral: '#03131a',
                    info: '#00e1ff',
                    warning: '#ff8800',
                    error: '#ff7f7f',
                },
                dark: {
                    ...require('daisyui/src/theming/themes').dark,
                    primary: '#9b3bf5',
                    'primary-content': '#ffffff',
                    secondary: '#494949',
                    neutral: '#03131a',
                    info: '#00e1ff',
                    warning: '#ff8800',
                    error: '#ff7f7f',
                    'base-100': '#14181c',
                    'base-200': '#1e2328',
                    'base-300': '#28323c',
                    'base-content': '#dcebfa',
                },
            },
        ],
    },
};
