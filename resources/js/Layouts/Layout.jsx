// resources/js/Layouts/Layout.jsx
import { Link } from "@inertiajs/react";

const Layout = ({ children, nama }) => {
    return (
        <>
            <header>
                <nav className="fixed top-0 left-0 w-full py-4 transition duration-300 bg-transparent">
                    <div className="container flex justify-between p-0.5 mx-auto">
                        <Link href="#" className="text-lg font-bold text-white">
                            <img
                                src="/images/logo_rizky_putra_168.svg"
                                alt="Po. Rizky Putra 168"
                                className="inline-block w-10 h-12 text-white"
                            />
                            {nama}
                        </Link>
                        <ul className="flex justify-end">
                            <li className="px-2 mr-4">
                                <Link
                                    href="#"
                                    className="text-white hover:text-gray-200"
                                >
                                    Beranda
                                </Link>
                            </li>
                            <li className="px-2 mr-4">
                                <Link
                                    href="#"
                                    className="text-white hover:text-gray-200"
                                >
                                    Tentang Kami
                                </Link>
                            </li>
                            <li className="px-2">
                                <Link
                                    href="#"
                                    className="text-white hover:text-gray-200"
                                >
                                    Hubungi Kami
                                </Link>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <main>{children}</main>
        </>
    );
};

export default Layout;
