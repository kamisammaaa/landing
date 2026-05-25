import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        manifest: true,
        outDir: 'public/build',
        sourcemap: false,
        // ✅ GANTI: hapus 'terser', pakai default (esbuild)
        // minify: 'terser',  ← HAPUS/KOMENTAR BARIS INI
    },
    resolve: {
        alias: {
            '@': '/resources/js',
        },
    },
});
