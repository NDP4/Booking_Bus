import { useEffect } from "react";
import { toast, Toaster } from "react-hot-toast";
import { router, Link } from "@inertiajs/react";
import { HoveredLink, Menu, MenuItem } from "../components/ui/navbar-menu";
import { cn } from "../lib/utils";
import { HoverBorderGradient } from "../components/ui/hover-border-gradient";
import { FaFacebook, FaInstagram, FaTwitter, FaWhatsapp } from "react-icons/fa";
import { useState } from "react";

export default function Payment({ sewa, bus, snapToken, auth }) {
    useEffect(() => {
        console.log("Payment component props:", { sewa, bus, snapToken }); // Debug log

        // Load Midtrans Snap
        const midtransScriptUrl =
            "https://app.sandbox.midtrans.com/snap/snap.js";
        const myMidtransClientKey = import.meta.env.VITE_MIDTRANS_CLIENT_KEY;

        console.log("Midtrans client key:", myMidtransClientKey); // Debug log

        let scriptTag = document.createElement("script");
        scriptTag.src = midtransScriptUrl;
        scriptTag.setAttribute("data-client-key", myMidtransClientKey);

        document.body.appendChild(scriptTag);

        scriptTag.addEventListener("load", () => {
            console.log("Midtrans script loaded successfully"); // Debug log
        });

        scriptTag.addEventListener("error", (error) => {
            console.error("Midtrans script failed to load:", error); // Debug log
        });

        return () => {
            document.body.removeChild(scriptTag);
        };
    }, []);

    const handlePayment = () => {
        window.snap.pay(snapToken, {
            onSuccess: function (result) {
                toast.success("Pembayaran berhasil!");
                router.visit("/product");
            },
            onPending: function (result) {
                toast.info("Menunggu pembayaran...");
            },
            onError: function (result) {
                toast.error("Pembayaran gagal!");
            },
            onClose: function () {
                toast.error("Pembayaran dibatalkan");
            },
        });
    };

    return (
        <div className="flex flex-col min-h-screen">
            {/* Navbar */}
            <Navbar
                className="top-0"
                isAuthenticated={auth && auth.user}
                handleLogout={() => {
                    router.post(
                        "/logout",
                        {},
                        {
                            onSuccess: () => {
                                window.location.href = "/";
                            },
                        }
                    );
                }}
            />

            {/* Main Content */}
            <main className="flex-grow">
                <div className="min-h-screen px-4 py-12 bg-gray-100 sm:px-6 lg:px-8">
                    <Toaster position="top-right" />
                    <div className="max-w-3xl mx-auto">
                        <div className="overflow-hidden bg-white rounded-lg shadow-xl">
                            <div className="p-6 text-white bg-indigo-600">
                                <h2 className="text-2xl font-bold">
                                    Detail Pesanan
                                </h2>
                            </div>

                            <div className="p-6 space-y-6">
                                {/* Bus Details */}
                                <div className="pb-4 border-b">
                                    <h3 className="text-lg font-medium">
                                        Informasi Bus
                                    </h3>
                                    <p className="text-gray-600">
                                        {bus.nama_bus}
                                    </p>
                                    <p className="text-gray-600">
                                        Kapasitas: {bus.kapasitas} orang
                                    </p>
                                </div>

                                {/* Booking Details */}
                                <div className="pb-4 border-b">
                                    <h3 className="text-lg font-medium">
                                        Detail Penyewaan
                                    </h3>
                                    <p className="text-gray-600">
                                        Tanggal Mulai: {sewa.tanggal_mulai}
                                    </p>
                                    <p className="text-gray-600">
                                        Tanggal Selesai: {sewa.tanggal_selesai}
                                    </p>
                                    <p className="text-gray-600">
                                        Jam Penjemputan: {sewa.jam_penjemputan}
                                    </p>
                                    <p className="text-gray-600">
                                        Lokasi: {sewa.lokasi_penjemputan}
                                    </p>
                                    <p className="text-gray-600">
                                        Tujuan: {sewa.tujuan}
                                    </p>
                                </div>

                                {/* Price Details */}
                                <div className="p-4 rounded-lg bg-gray-50">
                                    <h3 className="text-lg font-medium">
                                        Rincian Biaya
                                    </h3>
                                    <div className="mt-2 space-y-2">
                                        <div className="flex justify-between">
                                            <span>Harga per hari</span>
                                            <span>
                                                Rp{" "}
                                                {bus.harga_sewa.toLocaleString()}
                                            </span>
                                        </div>
                                        <div className="flex justify-between">
                                            <span>Lama sewa</span>
                                            <span>{sewa.lama_sewa} hari</span>
                                        </div>
                                        <div className="flex justify-between pt-2 text-lg font-bold border-t">
                                            <span>Total</span>
                                            <span>
                                                Rp{" "}
                                                {sewa.total_harga.toLocaleString()}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                {/* Payment Button */}
                                <div className="flex justify-end">
                                    <button
                                        onClick={handlePayment}
                                        className="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    >
                                        Bayar Sekarang
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

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

// Add Navbar component
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
