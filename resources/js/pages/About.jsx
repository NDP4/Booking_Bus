import { router } from "@inertiajs/react";
import React, { useState } from "react";
import { Menu, MenuItem } from "../components/ui/navbar-menu";
import { cn } from "../lib/utils";
import { HoverBorderGradient } from "../components/ui/hover-border-gradient";
import { usePage, Link } from "@inertiajs/react";
import { BackgroundGradientAnimation } from "../components/ui/background-gradient-animation";
import {
    FaFacebook,
    FaInstagram,
    FaTwitter,
    FaWhatsapp,
    FaBus,
    FaUsers,
    FaClock,
} from "react-icons/fa";

export default function About() {
    const { auth } = usePage().props;
    const isAuthenticated = auth && auth.user;

    return (
        <div className="flex flex-col min-h-screen">
            <Navbar
                className="top-0"
                isAuthenticated={isAuthenticated}
                handleLogout={() => router.post("/logout")}
            />

            {/* Hero Section */}
            <div className="relative h-[40vh] overflow-hidden">
                <BackgroundGradientAnimation>
                    <div className="absolute inset-0 z-50 flex items-center justify-center px-4">
                        <h1 className="text-4xl font-bold text-center text-white md:text-6xl">
                            Tentang Kami
                        </h1>
                    </div>
                </BackgroundGradientAnimation>
            </div>

            {/* Company Introduction */}
            <div className="px-6 py-20 bg-gradient-to-r from-gray-100 to-gray-300">
                <div className="container mx-auto">
                    <div className="grid grid-cols-1 gap-12 md:grid-cols-2">
                        <div className="space-y-6">
                            <h2 className="text-3xl font-bold">
                                PO Rizky Putra 168
                            </h2>
                            <p className="text-lg text-gray-600">
                                Sejak 2010, kami telah melayani ribuan pelanggan
                                dengan komitmen untuk memberikan pengalaman
                                perjalanan yang aman, nyaman, dan berkesan.
                            </p>
                            <div className="grid grid-cols-3 gap-6">
                                <div className="p-4 text-center bg-white rounded-lg shadow-md">
                                    <FaBus className="w-8 h-8 mx-auto mb-2 text-blue-500" />
                                    <h3 className="font-semibold">
                                        Armada Modern
                                    </h3>
                                </div>
                                <div className="p-4 text-center bg-white rounded-lg shadow-md">
                                    <FaUsers className="w-8 h-8 mx-auto mb-2 text-green-500" />
                                    <h3 className="font-semibold">
                                        Tim Profesional
                                    </h3>
                                </div>
                                <div className="p-4 text-center bg-white rounded-lg shadow-md">
                                    <FaClock className="w-8 h-8 mx-auto mb-2 text-purple-500" />
                                    <h3 className="font-semibold">
                                        24/7 Service
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div className="relative overflow-hidden rounded-xl">
                            <img
                                src="/images/logo_rizky_putra_168.png" // Add your image
                                alt="Bus Fleet"
                                className="object-cover w-full h-full"
                            />
                        </div>
                    </div>
                </div>
            </div>

            {/* Vision & Mission */}
            <div className="px-6 py-20 bg-white">
                <div className="container mx-auto">
                    <div className="grid grid-cols-1 gap-12 md:grid-cols-2">
                        <div className="p-8 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl">
                            <h3 className="mb-4 text-2xl font-bold">Visi</h3>
                            <p className="text-gray-700">
                                Menjadi perusahaan transportasi terdepan yang
                                mengutamakan kepuasan pelanggan melalui layanan
                                berkualitas tinggi.
                            </p>
                        </div>
                        <div className="p-8 bg-gradient-to-br from-green-50 to-green-100 rounded-xl">
                            <h3 className="mb-4 text-2xl font-bold">Misi</h3>
                            <ul className="space-y-2 text-gray-700 list-disc list-inside">
                                <li>
                                    Menyediakan armada bus modern dan terawat
                                </li>
                                <li>Mengutamakan keselamatan dan kenyamanan</li>
                                <li>Memberikan pelayanan profesional</li>
                                <li>
                                    Berkontribusi pada perkembangan transportasi
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {/* Footer */}
            <footer className="bg-gradient-to-r from-gray-100 to-gray-300 dark:from-gray-900 dark:to-gray-800">
                <div className="container px-6 py-12 mx-auto">
                    <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-4">
                        <div>
                            <h3 className="text-lg font-semibold text-gray-800 dark:text-white">
                                PO Rizky Putra 168
                            </h3>
                            <p className="mt-4 text-gray-600 dark:text-gray-300">
                                Solusi transportasi terpercaya untuk perjalanan
                                Anda.
                            </p>
                        </div>

                        <div>
                            <h3 className="text-lg font-semibold text-gray-800 dark:text-white">
                                Kontak
                            </h3>
                            <ul className="mt-4 space-y-2 text-gray-600 dark:text-gray-300">
                                <li>Telepon: (0354) 123456</li>
                                <li>Email: info@rizkyputra168.com</li>
                                <li>Alamat: Jl. Raya No. 168, Kediri</li>
                            </ul>
                        </div>

                        <div>
                            <h3 className="text-lg font-semibold text-gray-800 dark:text-white">
                                Layanan
                            </h3>
                            <ul className="mt-4 space-y-2 text-gray-600 dark:text-gray-300">
                                <li>Sewa Bus</li>
                                <li>Paket Wisata</li>
                                <li>Antar Kota</li>
                            </ul>
                        </div>

                        <div>
                            <h3 className="text-lg font-semibold text-gray-800 dark:text-white">
                                Sosial Media
                            </h3>
                            <div className="flex mt-4 space-x-4">
                                <a
                                    href="#"
                                    className="text-gray-600 hover:text-blue-500 dark:text-gray-300"
                                >
                                    <FaFacebook size={24} />
                                </a>
                                <a
                                    href="#"
                                    className="text-gray-600 hover:text-pink-500 dark:text-gray-300"
                                >
                                    <FaInstagram size={24} />
                                </a>
                                <a
                                    href="#"
                                    className="text-gray-600 hover:text-blue-400 dark:text-gray-300"
                                >
                                    <FaTwitter size={24} />
                                </a>
                                <a
                                    href="#"
                                    className="text-gray-600 hover:text-green-500 dark:text-gray-300"
                                >
                                    <FaWhatsapp size={24} />
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr className="my-8 border-gray-200 dark:border-gray-700" />
                    <div className="text-center">
                        <p className="text-gray-600 dark:text-gray-300">
                            © {new Date().getFullYear()} PO Rizky Putra 168. All
                            rights reserved.
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    );
}

// Navbar component - same as in Home.jsx
function Navbar({ className, isAuthenticated, handleLogout }) {
    const [active, setActive] = useState(null);

    const handleNavigation = (path) => {
        router.get(path);
    };

    return (
        <div className={cn(" top-10 inset-x-0 w-full mx-auto z-50", className)}>
            <div className="flex items-center justify-between mx-5">
                {/* Logo di kiri */}
                <div className="flex items-center justify-start min-w-48">
                    <Link href="/">
                        <img
                            src="/images/logo_rizky_putra_168.svg"
                            className="w-8 h-8"
                            alt="Logo"
                        />
                    </Link>
                </div>

                {/* Menu di tengah */}
                <Menu
                    setActive={setActive}
                    className="flex justify-center flex-grow"
                >
                    <MenuItem
                        setActive={setActive}
                        active={active}
                        item="Home"
                        onClick={() => handleNavigation("/")}
                    />
                    <MenuItem
                        setActive={setActive}
                        active={active}
                        item="Produk"
                        onClick={() => handleNavigation("/product")}
                    />
                    <MenuItem
                        setActive={setActive}
                        active={active}
                        item="Tentang Kami"
                        onClick={() => handleNavigation("/about")}
                    />
                </Menu>

                {/* Rest of navbar code */}
                <div className="flex items-center justify-center space-x-4">
                    {isAuthenticated ? (
                        <>
                            <div className="relative group">
                                <button className="flex items-center space-x-1 text-gray-700 hover:text-indigo-600">
                                    <span>Dashboard</span>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        className="w-4 h-4"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fillRule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 011.414 1.414l-4 4a1 1 01-1.414 0l-4-4a1 1 010-1.414z"
                                            clipRule="evenodd"
                                        />
                                    </svg>
                                </button>
                                <div className="absolute right-0 invisible w-48 py-2 mt-2 transition-all duration-200 ease-in-out bg-white rounded-md shadow-lg opacity-0 group-hover:opacity-100 group-hover:visible">
                                    <Link
                                        href="/dashboard/profile"
                                        className="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600"
                                    >
                                        Edit Profile
                                    </Link>
                                    <Link
                                        href="/dashboard/history"
                                        className="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600"
                                    >
                                        Riwayat Sewa
                                    </Link>
                                </div>
                            </div>
                            <HoverBorderGradient
                                borderRadius="1.75rem"
                                className="text-black bg-white dark:bg-slate-900 dark:text-white border-neutral-200 dark:border-slate-800"
                                onClick={handleLogout}
                            >
                                Logout
                            </HoverBorderGradient>
                        </>
                    ) : (
                        <a href="/admin">
                            <HoverBorderGradient
                                containerClassName="rounded-full mx-1"
                                as="button"
                                className="flex items-center space-x-2 text-black bg-white dark:bg-black dark:text-white"
                            >
                                <span>Login</span>
                            </HoverBorderGradient>
                        </a>
                    )}
                </div>
            </div>
        </div>
    );
}
