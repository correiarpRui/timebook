import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                roboto: ["Roboto"],
            },
            gridTemplateColumns: {
                29: "120px repeat(28, minmax(30px,1fr))",
                30: "120px repeat(29, minmax(30px,1fr))",
                31: "120px repeat(30, minmax(30px,1fr))",
                32: "120px repeat(31, minmax(30px,1fr))",
            },
        },
    },
    plugins: [],
};
