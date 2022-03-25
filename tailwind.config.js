module.exports = {
    content: [
        './templates/**/*.html.twig',
        './assets/**/*.{js,jsx,ts,tsx,vue}',
        './assets/**/*.scss'
    ],
    theme: {
        extend: {
            colors: {
                'pink-dark': '#F03B7A',
                'blue-dark-900': '#14163E',
                'blue-dark-700': '#242870',
                'slate-custom': '#FAFAFB'
            }
        },
    },
    plugins: [
        require("@tailwindcss/forms")({
            strategy: 'class',
        }),
        require('@tailwindcss/typography'),
    ],
}