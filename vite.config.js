import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    build: {
        outDir: "public/build",
        manifest: true,
        rollupOptions: {
            input: "resources/js/app.js",
            output: {
                manualChunks: {
                    vue: ["vue"],
                    tailwind: ["tailwindcss"],
                },
            },
        },
        chunkSizeWarningLimit: 1000,
    },
});
