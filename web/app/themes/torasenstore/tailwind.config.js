/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./parts/**/*.html",
    "./patterns/**/*.php",
    "./templates/**/*.html",
    "./resources/js/**/*.js",
    "./acf/**/*.php",
  ],
  theme: {
    extend: {},
  },
  corePlugins: {
    preflight: false
  },
  plugins: [],
}

