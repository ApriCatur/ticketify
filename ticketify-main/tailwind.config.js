/** @type {import('tailwindcss').Config} */
module.export ={
    content: [
"./resources/**/*.blade.php",
"./resources/**/*.js",
"./resources/**/*.vue",
"./node_modules/flowbite/**/*.js"
],
theme: {
    extend: {},
  },
  plugins: [
    require('flowbite/plugin')
  ],
}

export default {
  content: [],
  theme: {
    extend: {},
  },
  plugins: [],
}

