import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css',
                    'resources/css/nosotros.css',
                    'resources/css/servicios.css',
                    'resources/css/corporativo.css',
                    'resources/css/login.css', 
                    'resources/js/app.js'],
            refresh: true,
        }),
    ],
      build: {
        manifest: 'manifest.json',
        outDir: 'public/build',
        assetsDir: 'assets',
        emptyOutDir: true,
        rollupOptions: {
            output: {
                manualChunks: undefined,
            },
        },
    },
});