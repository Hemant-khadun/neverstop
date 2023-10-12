/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme')

export default {

    theme: {
        extend: {
            fontFamily: {
                sans: ['SFProDisplayRegular', 'Inter var', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    variants: {
        extend: {
            backgroundColor: ['active'],
        }
    },
    content: [
        './app/**/*.php',
        './resources/**/*.html',
        './resources/**/*.js',
        './resources/**/*.jsx',
        './resources/**/*.ts',
        './resources/**/*.tsx',
        './resources/**/*.php',
        './resources/**/*.vue',
        './resources/**/*.twig',
    ],
    plugins: [
    ],
}
