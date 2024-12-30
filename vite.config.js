import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from "@vitejs/plugin-react";

export default defineConfig({
    plugins: [
        laravel({
            input: "resources/js/app.jsx",
            refresh: true,
        }),
        react(),
    ],
    resolve: {
        alias: {
            "@": "/resources/js",
        },
    },
    build: {
        outDir: "public/build",
    },
    define: {
        "process.env.GOOGLE_MAPS_API_KEY": JSON.stringify(
            process.env.GOOGLE_MAPS_API_KEY
        ),
    },
    // server: {
    //     host: "0.0.0.0", // Ekspos ke semua IP
    //     port: 5173, // Port default Vite
    //     hmr: {
    //         host: "192.168.5.145", // Ganti dengan IP lokal
    //     },
    // },
});
