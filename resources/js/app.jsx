import "./bootstrap";
import "../css/app.css";

import { createInertiaApp } from "@inertiajs/react";
import { createRoot } from "react-dom/client";
// import { useEffect } from "react";

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.jsx", { eager: true });
        return pages[`./Pages/${name}.jsx`];
    },
    setup({ el, App, props }) {
        createRoot(el).render(<App {...props} />);
    },
});
// export default function App() {
//     useEffect(() => {
//         // Memuat script Midtrans Snap
//         const script = document.createElement("script");
//         script.src = "https://app.midtrans.com/snap/snap.js";
//         script.setAttribute(
//             "data-client-key",
//             "SB-Mid-client-qxA7e0wpu9hUGyhk"
//         );
//         document.head.appendChild(script);
//     }, []);

//     return <div>{/* Your app content here */}</div>;
// }
