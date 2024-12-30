import { router } from "@inertiajs/react";
import React, { useState, useEffect } from "react";
import {
    HoveredLink,
    Menu,
    MenuItem,
    ProductItem,
} from "../components/ui/navbar-menu"; // Sesuaikan path jika perlu
import { cn } from "../lib/utils"; // Pastikan utils berada di folder yang benar
// import { Cover } from "../components/ui/cover"; // Sesuaikan path jika perlu
import { FlipWords } from "../components/ui/flip-words"; // Sesuaikan path jika perlu
import { Button } from "../components/ui/moving-border";
import { HoverBorderGradient } from "../components/ui/hover-border-gradient";
import { usePage, Link } from "@inertiajs/react";
import { Inertia } from "@inertiajs/inertia";
import { BackgroundGradientAnimation } from "../components/ui/background-gradient-animation";
import { MaskContainer } from "../components/ui/svg-mask-effect";
import { TextHoverEffect } from "../components/ui/text-hover-effect";
import { Counter } from "../components/ui/counter";
import { AnimatedTestimonials } from "../components/ui/animated-testimonials.tsx";
import { FaFacebook, FaInstagram, FaTwitter, FaWhatsapp } from "react-icons/fa";

export default function Home() {
    const { auth, stats, testimonials } = usePage().props;
    console.log("Page Props:", usePage().props); // Debug all props
    console.log("Testimonials:", testimonials); // Debug testimonials specifically

    // Add debugging logs
    console.log("Total testimonials:", testimonials?.length);
    console.log("Testimonials data:", testimonials);

    const isAuthenticated = auth && auth.user;

    const words = ["Kenyamanan", "Keamanan", "Kepercayaan"];

    const handleLogout = () => {
        router.post(
            "/logout",
            {},
            {
                onSuccess: () => {
                    window.location.href = "/";
                },
            }
        );
    };

    return (
        <div className="flex flex-col min-h-screen">
            {/* Navbar positioned at the top */}
            <Navbar
                className="top-0"
                isAuthenticated={isAuthenticated}
                handleLogout={handleLogout}
            />

            {/* Content below Navbar with margin */}
            <div className="flex-grow">
                <BackgroundGradientAnimation>
                    <div className="absolute inset-0 z-50 flex items-center justify-center px-4 text-3xl font-bold text-center text-white pointer-events-none md:text-4xl lg:text-7xl">
                        <p className="text-transparent bg-clip-text drop-shadow-2xl bg-gradient-to-b from-white/80 to-white/20">
                            Po Rizky Putra 168
                        </p>
                    </div>
                </BackgroundGradientAnimation>
            </div>

            <div className="flex items-center justify-center h-[20rem] px-6 py-8 bg-gradient-to-r from-gray-100 to-gray-300">
                <p className="text-lg font-semibold leading-relaxed text-center text-gray-800 dark:text-gray-200 md:text-xl md:px-12">
                    Rizky Putra 168 menjadi moda transportasi yang unggul dalam
                    kualitas melalui pelayanan terbaik yang diberikan untuk
                    kenyamanan dan Keamanan para penumpang.
                </p>
            </div>

            {/* Stats Section */}
            <div className="grid grid-cols-1 gap-8 px-6 py-12 md:grid-cols-3 bg-gradient-to-r from-gray-100 to-gray-300">
                <div className="text-center">
                    <h3 className="text-4xl font-bold text-gray-800">
                        <Counter end={stats?.total_buses || 0} />
                    </h3>
                    <p className="mt-2 text-lg text-gray-600">
                        Total Armada Bus
                    </p>
                </div>
                <div className="text-center">
                    <h3 className="text-4xl font-bold text-gray-800">
                        <Counter end={stats?.total_users || 0} />
                    </h3>
                    <p className="mt-2 text-lg text-gray-600">Total Pengguna</p>
                </div>
                <div className="text-center">
                    <h3 className="text-4xl font-bold text-gray-800">
                        <Counter end={stats?.total_sewas || 0} />
                    </h3>
                    <p className="mt-2 text-lg text-gray-600">
                        Total Penyewaan
                    </p>
                </div>
            </div>

            <div className="bg-white dark:bg-gray-900">
                {Array.isArray(testimonials) && testimonials.length > 0 ? (
                    <div className="container px-4 py-12 mx-auto">
                        <h2 className="mb-8 text-3xl font-bold text-center">
                            Testimonials dari Pelanggan Kami
                        </h2>
                        <AnimatedTestimonials
                            testimonials={testimonials}
                            autoplay={testimonials.length > 1}
                        />
                    </div>
                ) : (
                    <div className="p-8 text-center">
                        <p className="text-gray-600">
                            No testimonials available
                        </p>
                    </div>
                )}
            </div>

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
                            src="images/logo_rizky_putra_168.svg"
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
                            {/* Dashboard Dropdown */}
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
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clipRule="evenodd"
                                        />
                                    </svg>
                                </button>
                                {/* Dropdown menu */}
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
                    {/* <a href="chatbot">
                        <Button
                            borderRadius="1.75rem"
                            className="text-black bg-white dark:bg-slate-900 dark:text-white border-neutral-200 dark:border-slate-800"
                        >
                            Tanya CS
                        </Button>
                    </a> */}
                </div>
            </div>
        </div>
    );
}
