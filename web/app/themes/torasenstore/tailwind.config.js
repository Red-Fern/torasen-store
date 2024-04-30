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
    fontFamily: {
      'sans': 'var(--wp--preset--font-family--sohne)',
      'mono': 'var(--wp--preset--font-family--inconsolata)'
    },
    fontSize: {
      'xs': 'var(--wp--preset--font-size--xs)',
      'sm': 'var(--wp--preset--font-size--sm)',
      'base': 'var(--wp--preset--font-size--base)',
      'md': 'var(--wp--preset--font-size--md)',
      'lg': 'var(--wp--preset--font-size--lg)',
      'xl': 'var(--wp--preset--font-size--xl)',
      '2xl': 'var(--wp--preset--font-size--xxl)',
      '3xl': 'var(--wp--preset--font-size--xxxl)'
    },
    extend: {
      colors: {
        'black': 'var(--wp--preset--color--black)',
        'dark-grey': 'var(--wp--preset--color--dark-grey)',
        'mid-grey': 'var(--wp--preset--color--mid-grey)',
        'light-grey': 'var(--wp--preset--color--light-grey)',
        'lightest-grey': 'var(--wp--preset--color--lightest-grey)',
        'white': 'var(--wp--preset--color--white)',
        'dark-green': 'var(--wp--preset--color--dark-green)',
        'light-blue': 'var(--wp--preset--color--light-blue)',
        'dark-greige': 'var(--wp--preset--color--dark-greige)',
        'light-greige': 'var(--wp--preset--color--light-greige)'
      },
      spacing: {
        'xs': 'var(--wp--preset--spacing--xs)',
        'sm': 'var(--wp--preset--spacing--sm)',
        'md': 'var(--wp--preset--spacing--md)',
        'lg': 'var(--wp--preset--spacing--lg)',
        'xl': 'var(--wp--preset--spacing--xl)',
        '2xl': 'var(--wp--preset--spacing--xxl)'
      }
    },
  },
  corePlugins: {
    preflight: false
  },
  plugins: [],
}

