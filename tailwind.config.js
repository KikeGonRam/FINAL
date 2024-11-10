/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.{html,js,php}",
    "./node_modules/flowbite/**/*.js",
    "./resources/**/*.{html,js,php}",  // Asegúrate de incluir los archivos que usas

  ],
  theme: {
    extend: {
      colors: {
        beige: '#f5f5dc',  // Agrega el color beige personalizado
      },
    },
  },
  plugins: [],
}
