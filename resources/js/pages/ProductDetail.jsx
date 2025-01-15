import { router } from "@inertiajs/react";
import React, { useState, useEffect } from "react";
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
    const [reviews, setReviews] = useState(null);
    const [isLoading, setIsLoading] = useState(true);

    useEffect(() => {
        fetch(`/api/buses/${bus.id}/reviews`)
            .then(res => res.json())
            .then(data => {
                setReviews(data);
                setIsLoading(false);
            })
            .catch(error => {
                console.error('Error fetching reviews:', error);
                setIsLoading(false);
            });
    }, [bus.id]);

    console.log("Product Detail Props:", { bus, auth });

    return (
        <div className="flex flex-col min-h-screen">
            <Toaster position="top-right" />
            <Navbar
                className="top-0"
                isAuthenticated={auth?.user}
                handleLogout={() => router.post("/logout")}
            />

            {/* Main Content */}
            <div className="flex-grow px-4 py-8 bg-white md:px-6 lg:px-8">
                <div className="max-w-7xl mx-auto">
                    {/* Product Grid */}
                    <div className="grid grid-cols-1 gap-8 lg:grid-cols-2">
                        {/* Left Column - Image */}
                        <div className="sticky top-24">
                            <div className="aspect-w-16 aspect-h-12 rounded-2xl overflow-hidden bg-gray-100">
                                <img
                                    src={bus.image}
                                    alt={bus.nama_bus}
                                    className="object-cover w-full h-full"
                                />
                            </div>
                        </div>

                        {/* Right Column - Details */}
                        <div className="space-y-8">
                            {/* Basic Info */}
                            <div className="space-y-4">
                                <h1 className="text-3xl font-bold text-gray-900">
                                    {bus.nama_bus}
                                </h1>

                                {/* Rating Summary */}
                                {!isLoading && reviews && (
                                    <div className="flex items-center gap-4">
                                        <div className="flex items-center">
                                            {[1, 2, 3, 4, 5].map((star) => (
                                                <svg
                                                    key={star}
                                                    className={`w-5 h-5 ${
                                                        star <= reviews.average_rating
                                                            ? "text-yellow-400"
                                                            : "text-gray-200"
                                                    }`}
                                                    fill="currentColor"
                                                    viewBox="0 0 20 20"
                                                >
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            ))}
                                        </div>
                                        <span className="text-sm text-gray-500">
                                            {reviews.average_rating} / 5.0 ({reviews.review_count} ulasan)
                                        </span>
                                    </div>
                                )}

                                <div className="flex items-center gap-6 pt-2">
                                    <div className="flex items-center gap-2">
                                        <FaUsers className="w-5 h-5 text-gray-400" />
                                        <span className="text-lg text-gray-900">{bus.kapasitas} Seats</span>
                                    </div>
                                    <div className="text-2xl font-bold text-indigo-600">
                                        Rp {bus.harga_sewa.toLocaleString()}<span className="text-sm font-normal text-gray-500">/day</span>
                                    </div>
                                </div>
                            </div>

                            {/* Action Button */}
                            <div className="flex gap-4">
                                {auth?.user ? (
                                    <Link
                                        href={`/product/${bus.id}/sewa`}
                                        onClick={(e) => {
                                            if (bus.is_booked) {
                                                e.preventDefault();
                                                toast.error("Bus ini sudah dibooking untuk periode yang dipilih");
                                                return;
                                            }
                                            if (bus.status === "maintenance") {
                                                e.preventDefault();
                                                toast.error("Bus sedang dalam perawatan");
                                                return;
                                            }
                                        }}
                                        className={`w-full py-4 text-center text-lg font-semibold rounded-xl transition-all ${
                                            bus.is_booked
                                                ? "bg-gray-100 text-gray-400 cursor-not-allowed"
                                                : "bg-indigo-600 text-white hover:bg-indigo-700 shadow-lg hover:shadow-indigo-200"
                                        }`}
                                    >
                                        {bus.is_booked ? "Tidak Tersedia" : "Sewa Sekarang"}
                                    </Link>
                                ) : (
                                    <Link
                                        href="/admin/login"
                                        className="w-full py-4 text-center text-lg font-semibold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-all shadow-lg hover:shadow-indigo-200"
                                        onClick={() => {
                                            toast.info("Silakan login terlebih dahulu untuk melakukan pemesanan");
                                        }}
                                    >
                                        Login untuk Menyewa
                                    </Link>
                                )}
                            </div>

                            {/* Info Cards */}
                            <div className="grid gap-6">
                                {/* Description */}
                                <div className="p-6 bg-gray-50 rounded-xl">
                                    <h2 className="text-lg font-semibold text-gray-900 mb-4">Deskripsi</h2>
                                    <p className="text-gray-600 leading-relaxed">{bus.deskripsi}</p>
                                </div>

                                {/* Facilities */}
                                <div className="p-6 bg-gray-50 rounded-xl">
                                    <h2 className="text-lg font-semibold text-gray-900 mb-4">Fasilitas</h2>
                                    <div className="grid grid-cols-2 gap-4">
                                        {bus.fasilitas.split(",").map((fasilitas, index) => (
                                            <div key={index} className="flex items-center gap-2">
                                                <div className="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center">
                                                    <FaBus className="w-4 h-4 text-indigo-600" />
                                                </div>
                                                <span className="text-gray-600">{fasilitas.trim()}</span>
                                            </div>
                                        ))}
                                    </div>
                                </div>

                                {/* Reviews Section */}
                                <div className="p-6 bg-gray-50 rounded-xl">
                                    <h2 className="text-lg font-semibold text-gray-900 mb-4">
                                        Ulasan Pelanggan
                                    </h2>
                                    <div className="space-y-4">
                                        {isLoading ? (
                                            <div className="flex justify-center py-8">
                                                <div className="w-6 h-6 border-2 border-indigo-600 border-t-transparent rounded-full animate-spin"></div>
                                            </div>
                                        ) : reviews?.reviews?.length > 0 ? (
                                            reviews.reviews.map((review) => (
                                                <div key={review.id} className="p-4 bg-white rounded-lg">
                                                    <div className="flex items-center justify-between mb-2">
                                                        <div className="flex items-center gap-3">
                                                            <div className="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                                                <span className="text-indigo-600 font-medium">
                                                                    {review.user_name.charAt(0)}
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <h3 className="font-medium text-gray-900">{review.user_name}</h3>
                                                                <p className="text-sm text-gray-500">
                                                                    {new Date(review.created_at).toLocaleDateString()}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div className="flex">
                                                            {[...Array(5)].map((_, index) => (
                                                                <svg
                                                                    key={index}
                                                                    className={`w-4 h-4 ${
                                                                        index < review.rating ? "text-yellow-400" : "text-gray-200"
                                                                    }`}
                                                                    fill="currentColor"
                                                                    viewBox="0 0 20 20"
                                                                >
                                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                                </svg>
                                                            ))}
                                                        </div>
                                                    </div>
                                                    <p className="text-gray-600 mt-2">{review.ulasan}</p>
                                                </div>
                                            ))
                                        ) : (
                                            <div className="text-center py-8">
                                                <p className="text-gray-500">Belum ada ulasan</p>
                                            </div>
                                        )}
                                    </div>
                                </div>
                            </div>
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
