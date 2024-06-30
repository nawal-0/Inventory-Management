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
        // 'primary': '#818cf8',
        'primary': '#6366f1',
        'primary-dark': '#3730a3',
      }
    },
  },
  plugins: [],
}

