const {
    default: flattenColorPalette,
} = require("tailwindcss/lib/util/flattenColorPalette");

/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: "class", // Mode gelap menggunakan kelas
    content: [
        "./pages/**/*.{ts,tsx}",
        "./components/**/*.{ts,tsx}",
        "./app/**/*.{ts,tsx}",
        "./src/**/*.{ts,tsx}",
        "./resources/**/*.blade.php",
        "./resources/**/*.tsx",
        "./resources/**/*.jsx",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./resources/js/**/*.{html,js,jsx,ts,tsx}",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
        "./resources/css/**/*.css",
    ],
    prefix: "",
    theme: {
        container: {
            center: true,
            padding: "2rem",
            screens: {
                "2xl": "1400px",
            },
        },
        extend: {
            keyframes: {
                "accordion-down": {
                    from: { height: "0" },
                    to: { height: "var(--radix-accordion-content-height)" },
                },
                "accordion-up": {
                    from: { height: "var(--radix-accordion-content-height)" },
                    to: { height: "0" },
                },
            },
            animation: {
                "accordion-down": "accordion-down 0.2s ease-out",
                "accordion-up": "accordion-up 0.2s ease-out",
            },
        },
    },
    plugins: [
        require("tailwindcss-animate"), // Tailwind plugin untuk animasi
        addVariablesForColors, // Menambahkan plugin untuk variabel warna CSS
    ],
};

// Plugin untuk mengubah setiap warna dari Tailwind menjadi variabel CSS global
function addVariablesForColors({ addBase, theme }) {
    // Mengambil palet warna dari tema Tailwind dan meratakannya
    let allColors = flattenColorPalette(theme("colors"));

    // Mengonversi palet warna menjadi variabel CSS dengan nama --{color-name}
    let newVars = Object.fromEntries(
        Object.entries(allColors).map(([key, val]) => {
            // Jika nilai adalah objek (misalnya gradien), kita string-kan
            if (typeof val === "object") {
                return [`--${key}`, JSON.stringify(val)]; // Mengonversi objek warna menjadi string JSON
            } else {
                return [`--${key}`, val]; // Menggunakan nilai langsung untuk variabel
            }
        })
    );

    // Menambahkan variabel-variabel tersebut ke dalam :root agar bisa digunakan di seluruh aplikasi
    addBase({
        ":root": newVars,
    });
}
