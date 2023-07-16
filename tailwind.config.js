/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      fontFamily: {
        poppins: ["Poppins", "sans-serif"],
        crimson: ['Crimson Text', 'serif'],
        merienda: ['Merienda', 'cursive'],
        raleway: ['Raleway', 'sans-serif']
    },
    colors: {
      bgGreen:"#f6ffeb",
      darkGreen:"#0d3c1c",
      olive:"#939f31",
      error: "#ff1616",
      input: "#0d3c1c",
        primary: {
            // 50: "#eff6ff",
            // 100: "#dbeafe",
            // 200: "#bfdbfe",
            // 300: "#93c5fd",
            // 400: "#60a5fa",
            500: "#939f31",
            600: "#0d3c1c",
            // 700: "#1d4ed8",
            // 800: "#1e40af",
            // 900: "#1e3a8a",
        },
    },
    },
  },
  plugins: [
    require('flowbite/plugin')
]
}

