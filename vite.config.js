import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import globResolverPlugin from "@raquo/vite-plugin-glob-resolver";
import GlobPlugin from "vite-plugin-glob";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/sass/app.scss",
                "resources/js/app.js",
            ],
            refresh: true,

            css: {
                preprocessorOptions: {
                    sass: {
                        quietDeprecationWarning: true,
                    },
                },
            },
        }),

        GlobPlugin({
            patterns: [
                "../assets/backend/**/*.css",
                "../assets/backend/css/vendors/*.css",
                "../assets/backend/css/images/*.{jpg,png,svg}",
                "../assets/backend/images/**/*.{jpg,png,svg}",
                "../assets/backend/js/*.js",
                "../assets/backend/js/**/*.js",
                "../assets/backend/js/**/**/*.js",
            ],
        }),

        globResolverPlugin({
            cwd: __dirname,
            ignore: ["node_modules/**", "target/**"],
        }),
    ],
});
