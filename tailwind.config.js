/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'pink-custom': '#FADADD',
        'mint-custom': '#D6F5E3',
        'white-custom': '#FAFAFA',
        'brown-custom': '#CBA37C',
        'purple-custom': '#E3D1F4'
      },
      fontFamily: {
        'poppins': ['Poppins', 'sans-serif'],
        'quicksand': ['Quicksand', 'sans-serif']
      }
    },
  },
  plugins: [],
}