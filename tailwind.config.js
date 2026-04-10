/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.jsx",
  ],
  theme: {
    extend: {
      colors: {
        // Forest palette
        'forest-light': '#428177',
        'forest': '#054239',
        'forest-dark': '#002623',
        
        // Golden Wheat palette
        'wheat-light': '#EDEBE0',
        'wheat': '#B9A779',
        'wheat-dark': '#988561',
        
        // Deep Umber palette
        'umber-light': '#6B1F2A',
        'umber': '#4A151E',
        'umber-dark': '#260F14',
        
        // Charcoal palette
        'charcoal-light': '#FFFFFF',
        'charcoal': '#3D3A3B',
        'charcoal-dark': '#161616',
        
        // Common usage aliases
        'primary': '#054239',
        'primary-light': '#428177',
        'primary-dark': '#002623',
        'secondary': '#B9A779',
        'secondary-light': '#EDEBE0',
        'secondary-dark': '#988561',
        'background': '#EDEBE0',
        'text-primary': '#161616',
        'text-secondary': '#3D3A3B',
      },
    },
  },
  plugins: [],
}
