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
                'grey-500': '#62748b',
                'grey-400': '#ebedf1',
                'grey-100': '#d8e3ee',
                'blue-0': '#1b55ac',
                'blue-1000': '#1b55ac0d',
                'blue-1100': '#1b55ac33',
                'blue-1200': '#1b55ac',
                'blue-1300': '#1b55ac21',
                'blue-1400': '#1b55ac33',
                'blue-1500': '#1b55ac1a',
                'blue-1600': '#1b55ac12',
                'blue-1700': '#102035',
                'blue-1800': '#1b55ac26',
            },
            fontSize: {
                '2xs': '.75rem',
                '10xl': '10rem',
            },
        },
    },

    plugins: [],
}