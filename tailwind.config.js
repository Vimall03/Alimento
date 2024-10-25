/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './**/*.php',
    './**/*.html',
    './**/*.js', 
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

