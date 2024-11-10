/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './**/*.php',
    './**/*.html',
    './**/*/*.html',
    './**/*.js', 
    './**/*/*.js', 
  ],
  theme: {
    extend: {
      fontFamily: {
        'poppins': ["Poppins", "sans-serif"],
      },
      backgroundImage:{
        'pizza-img': "url('images/pizza-img-membership.png')",
      }
    },
  },
  plugins: [],
}

