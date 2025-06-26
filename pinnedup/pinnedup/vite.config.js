import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/index.jsx'],
            refresh: true,
        }),
        react({
            // Ensure proper JSX runtime
            jsxRuntime: 'automatic', // Use 'classic' if you're explicitly importing React
        }),
    ],
});
