/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                'panel-1100': '#0A0F19',
                'panel-1000': '#0f2239',
                'panel-800': '#0E1727',
                'panel-700': '#102035',
                'panel-600': '#20375940',
                'grey-700': '##bac6cc',
                'grey-600': '#bad9fc',
            },
        },
    },
    plugins: [],
}