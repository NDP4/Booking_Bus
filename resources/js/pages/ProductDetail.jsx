import { router } from "@inertiajs/react";
import React, { useState } from "react";
import { Menu, MenuItem } from "@/components/ui/navbar-menu";
import { BackgroundGradientAnimation } from "@/components/ui/background-gradient-animation";
import { Link } from "@inertiajs/react";
import {
    FaBus,
    FaUsers,
    FaMoneyBill,
    FaFacebook,
    FaInstagram,
    FaTwitter,
    FaWhatsapp,
} from "react-icons/fa";
import { HoverBorderGradient } from "@/components/ui/hover-border-gradient";
import { cn } from "@/lib/utils";
import { toast, Toaster } from "react-hot-toast"; // Add this import if not exists

// Updated Navbar Component
function Navbar({ className, isAuthenticated, handleLogout }) {
    const [active, setActive] = useState(null);

    const handleNavigation = (path) => {
        router.get(path);
    };

    return (
        <div className={cn(" top-10 inset-x-0 w-full mx-auto z-50", className)}>
            <div className="flex items-center justify-between mx-5">
                <div className="flex items-center justify-start min-w-48">
                    <Link href="/">
                        <img
                            src="/images/logo_rizky_putra_168.svg"
                            className="w-8 h-8"
                            alt="Logo"
                        />
                    </Link>
                </div>

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
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
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

export default function ProductDetail({ bus, auth }) {
    console.log("Product Detail Props:", { bus, auth });

    return (
        <div className="flex flex-col min-h-screen">
            <Toaster position="top-right" />
            <Navbar
                className="top-0"
                isAuthenticated={auth?.user}
                handleLogout={() => router.post("/logout")}
            />

            <div className="flex-grow px-6 py-12 bg-gradient-to-r from-gray-100 to-gray-300">
                <div className="container mx-auto">
                    <div className="grid grid-cols-1 gap-8 md:grid-cols-2">
                        {/* Image Section */}
                        <div>
                            <img
                                src={bus.image}
                                alt={bus.nama_bus}
                                className="object-cover w-full rounded-lg shadow-lg h-96"
                            />
                        </div>

                        {/* Details Section */}
                        <div className="space-y-6">
                            <h1 className="text-4xl font-bold text-gray-900">
                                {bus.nama_bus}
                            </h1>

                            <div className="flex items-center space-x-4 text-gray-600">
                                <div className="flex items-center">
                                    <FaUsers className="mr-2" />
                                    <span>{bus.kapasitas} Seats</span>
                                </div>
                                <div className="flex items-center">
                                    <FaMoneyBill className="mr-2" />
                                    <span>
                                        Rp {bus.harga_sewa.toLocaleString()}/day
                                    </span>
                                </div>
                            </div>

                            <div className="p-4 bg-white rounded-lg shadow-md">
                                <h2 className="mb-2 text-xl font-semibold">
                                    Deskripsi
                                </h2>
                                <p className="text-gray-600">{bus.deskripsi}</p>
                            </div>

                            <div className="p-4 bg-white rounded-lg shadow-md">
                                <h2 className="mb-2 text-xl font-semibold">
                                    Fasilitas
                                </h2>
                                <ul className="grid grid-cols-2 gap-2">
                                    {bus.fasilitas
                                        .split(",")
                                        .map((fasilitas, index) => (
                                            <li
                                                key={index}
                                                className="flex items-center text-gray-600"
                                            >
                                                <FaBus className="mr-2" />
                                                {fasilitas.trim()}
                                            </li>
                                        ))}
                                </ul>
                            </div>

                            {auth?.user ? (
                                <Link
                                    href={`/product/${bus.id}/sewa`} // Changed from /admin/sewas/create
                                    onClick={(e) => {
                                        // Check if bus is already booked
                                        if (bus.is_booked) {
                                            e.preventDefault();
                                            toast.error(
                                                "Bus ini sudah dibooking untuk periode yang dipilih"
                                            );
                                            return;
                                        }

                                        // Check if bus is under maintenance or not available
                                        if (bus.status === "maintenance") {
                                            e.preventDefault();
                                            toast.error(
                                                "Bus sedang dalam perawatan"
                                            );
                                            return;
                                        }

                                        // You can add more validation checks here
                                    }}
                                    className={`inline-block px-8 py-3 text-lg font-semibold text-white transition-colors rounded-lg ${
                                        bus.is_booked
                                            ? "bg-gray-400 cursor-not-allowed"
                                            : "bg-blue-600 hover:bg-blue-700"
                                    }`}
                                >
                                    {bus.is_booked
                                        ? "Tidak Tersedia"
                                        : "Sewa Sekarang"}
                                </Link>
                            ) : (
                                <Link
                                    href="/admin/login"
                                    className="inline-block px-8 py-3 text-lg font-semibold text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700"
                                    onClick={() => {
                                        toast.info(
                                            "Silakan login terlebih dahulu untuk melakukan pemesanan"
                                        );
                                    }}
                                >
                                    Login untuk Menyewa
                                </Link>
                            )}

                            {/* Add booking dates information if any */}
                            {bus.booking_dates &&
                                bus.booking_dates.length > 0 && (
                                    <div className="p-4 mt-4 rounded-lg bg-red-50">
                                        <h4 className="font-medium text-red-700">
                                            Tanggal Tidak Tersedia:
                                        </h4>
                                        <ul className="mt-2 space-y-1">
                                            {bus.booking_dates.map(
                                                (date, index) => (
                                                    <li
                                                        key={index}
                                                        className="text-red-600"
                                                    >
                                                        {format(
                                                            new Date(
                                                                date.start
                                                            ),
                                                            "dd MMM yyyy"
                                                        )}{" "}
                                                        -{" "}
                                                        {format(
                                                            new Date(date.end),
                                                            "dd MMM yyyy"
                                                        )}
                                                    </li>
                                                )
                                            )}
                                        </ul>
                                    </div>
                                )}

                            {/* Add bus status information */}
                            {bus.status && bus.status !== "available" && (
                                <div className="p-4 mt-4 rounded-lg bg-yellow-50">
                                    <p className="text-yellow-700">
                                        Status Bus:{" "}
                                        {bus.status === "maintenance"
                                            ? "Sedang Dalam Perawatan"
                                            : bus.status}
                                    </p>
                                </div>
                            )}
                        </div>
                    </div>
                </div>
            </div>

            {/* Updated Footer */}
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
