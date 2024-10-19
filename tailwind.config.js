/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["*.{html,js,php}"],
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

