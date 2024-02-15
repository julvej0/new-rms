/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors:{
          "grey": "var(--grey)",
          "dark-grey": "var(--dark-grey)",
          "light": "var(--light)",
          "dark": "var(--dark)",
          "primary": "var(--primary)",
          "blue": "var(--blue)",
          "light-blue": "var(--light-blue)",
          "text-color": "var(--text-color)",
          "danger": "var(--danger)",
          "green": "var(--green)",
          "accent": "var(--accent)",
          "bg-grey": "var(--bg-grey)",
      }
    },
  },
  plugins: [],
}