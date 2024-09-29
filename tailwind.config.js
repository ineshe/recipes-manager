/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      colors: {
        'primary-color': '#f5bd0b',
        // 'secondary-color': '#2a4d38',
        // 'text-color': '#566150'
        // 'text-color': '#213B2C'
        'secondary-color': '#264c37',
        'text-color': '#264c37'
        
      },
    },
  },
  plugins: [],
}
