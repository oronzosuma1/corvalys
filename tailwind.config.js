/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './app/Livewire/**/*.php',
    ],
    theme: {
        extend: {
            colors: {
                primary: { DEFAULT: '#0F7B6C', dark: '#085249', light: '#E6F4F2' },
                navy: { DEFAULT: '#1B3A5C', light: '#2D5F8F' },
                amber: { DEFAULT: '#D97706', light: '#FEF3C7' },
            },
            fontFamily: {
                heading: ['Plus Jakarta Sans', 'sans-serif'],
                body: ['Inter', 'sans-serif'],
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
};
