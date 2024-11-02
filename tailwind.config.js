/** @type {import('tailwindcss').Config} */
export default {
  // content: [
  //   './resources/views/**/*.blade.php',
  //   './resources/js/**/*.js',
  //   './resources/css/**/*.css',
  // ],

  content: [
    '/resources/views/**/*.blade.php', // Blade templates
    '/resources/js/**/*.js',           // JavaScript files
    './resources/css/**/*.css',         // CSS files
    './resources/js/**/*.vue',          // Vue components (if applicable)
    './resources/js/**/*.ts',           // TypeScript files
    './resources/**/*.html',            // HTML files
],
  theme: {
    extend: {},
  },
  plugins: [],
}

