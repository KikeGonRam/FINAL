import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/admin/login.css',  // Agrega aquí el archivo CSS del login
                'resources/js/admin/login.js',    // Agrega aquí el archivo JS del login
                'resources/css/admin/admin-panel.css',
                'resources/js/admin/admin-panel.js',
                'resources/js//user/dashboard.js',
                'resources/js//user/dashboard.css',
                'resources/css/user/profile.css', // Asegúrate de incluir tu archivo CSS aquí si usas la entrada múltiple.
                'resources/js/user/profile.js',   // Incluye tu archivo JS si deseas que Vite lo maneje.
                'resources/js/admin/users/index.js',
                'resources/js/admin/users/index.css'
            ],
            refresh: true,
        }),
    ],
});
