module.exports = {
    content: [
        './templates/**/*.html.twig',
        './assets/**/*.{js,jsx,ts,tsx,vue}',
        './assets/**/*.scss'
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require("@tailwindcss/forms")({
            strategy: 'class',
        }),
        require('@tailwindcss/typography'),
    ],
}