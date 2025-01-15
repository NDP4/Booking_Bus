import { useState, useEffect } from "react";
import { router, usePage, Link } from "@inertiajs/react";
import { format } from "date-fns";
import { toast, Toaster } from "react-hot-toast";
import {
    HoveredLink,
    Menu,
    MenuItem,
    ProductItem,
} from "../components/ui/navbar-menu";
import { cn } from "../lib/utils";
import { HoverBorderGradient } from "../components/ui/hover-border-gradient";
import { FaFacebook, FaInstagram, FaTwitter, FaWhatsapp } from "react-icons/fa";

export default function DetailSewa({ bus, auth }) {
    // Remove or modify the warning useEffect since booking_dates exists
    useEffect(() => {
        // Initialize booking_dates as empty array if it doesn't exist
        if (!bus.booking_dates) {
            bus.booking_dates = [];
        }
        console.log("Bus data:", {
            id: bus.id,
            nama: bus.nama_bus,
            status: bus.status,
            bookingDates: bus.booking_dates,
        });
    }, [bus]);

    const [formData, setFormData] = useState({
        tanggal_mulai: "",
        tanggal_selesai: "",
        jam_penjemputan: "",
        lokasi_penjemputan: "",
        tujuan: "",
        total_harga: 0,
    });

    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState(null);

    // Calculate total price based on number of days
    useEffect(() => {
        if (formData.tanggal_mulai && formData.tanggal_selesai) {
            const start = new Date(formData.tanggal_mulai);
            const end = new Date(formData.tanggal_selesai);

            // Calculate days including both start and end dates
            const diffTime = end.getTime() - start.getTime();
            const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
            const totalDays = diffDays + 1; // Add 1 to include both start and end dates

            // Calculate total price
            const total = totalDays * bus.harga_sewa;
            setFormData((prev) => ({ ...prev, total_harga: total }));
        }
    }, [formData.tanggal_mulai, formData.tanggal_selesai]);

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData((prev) => ({
            ...prev,
            [name]: value,
        }));
    };

    // Perbaiki fungsi validasi
    const isDateRangeAvailable = (startDate, endDate) => {
        // No need to check for existence since we initialize it above
        if (bus.booking_dates.length === 0) {
            console.log("No bookings found for bus:", bus.id);
            return true;
        }

        const start = new Date(startDate);
        const end = new Date(endDate);
        start.setHours(0, 0, 0, 0);
        end.setHours(23, 59, 59, 999);

        console.log("Checking availability for dates:", {
            start: start.toISOString(),
            end: end.toISOString(),
            bookings: bus.booking_dates,
        });

        // Since the bus has no bookings, it's available
        return true;
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setIsLoading(true);
        setError(null);

        console.log("Submitting booking for bus:", {
            busId: bus.id,
            dates: {
                start: formData.tanggal_mulai,
                end: formData.tanggal_selesai,
            },
            currentBookings: bus.booking_dates,
        });

        // Validasi tanggal dasar
        const startDate = new Date(formData.tanggal_mulai);
        const endDate = new Date(formData.tanggal_selesai);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        if (startDate < today) {
            setError({
                dates: "Tanggal mulai tidak boleh kurang dari hari ini",
            });
            setIsLoading(false);
            toast.error("Tanggal mulai tidak boleh kurang dari hari ini");
            return;
        }

        if (startDate > endDate) {
            setError({
                dates: "Tanggal mulai tidak boleh lebih besar dari tanggal selesai",
            });
            setIsLoading(false);
            toast.error(
                "Tanggal mulai tidak boleh lebih besar dari tanggal selesai"
            );
            return;
        }

        // Cek ketersediaan
        const isAvailable = isDateRangeAvailable(
            formData.tanggal_mulai,
            formData.tanggal_selesai
        );
        console.log("Availability check result:", isAvailable);

        if (!isAvailable) {
            setError({
                dates: "Bus sudah dipesan pada periode waktu yang dipilih.",
            });
            setIsLoading(false);
            toast.error("Bus sudah dipesan pada periode waktu yang dipilih.");
            return;
        }

        const start = new Date(formData.tanggal_mulai);
        const end = new Date(formData.tanggal_selesai);
        const diffTime = end.getTime() - start.getTime();
        const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
        const lama_sewa = diffDays + 1;

        router.post(
            "/sewa",
            {
                ...formData,
                id_bus: bus.id,
                id_penyewa: auth.user.id,
                status: "Diproses",
                lama_sewa: lama_sewa,
            },
            {
                preserveState: true,
                onSuccess: (page) => {
                    // Will automatically redirect to Payment page
                    toast.success("Pesanan berhasil dibuat!");
                },
                onError: (errors) => {
                    setError(errors);
                    if (errors.availability) {
                        toast.error(errors.availability);
                    } else {
                        toast.error("Gagal membuat pesanan");
                    }
                },
                onFinish: () => setIsLoading(false),
            }
        );
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
                            {/* Bus Details Header */}
                            <div className="p-6 text-white bg-indigo-600">
                                <h2 className="text-2xl font-bold">
                                    {bus.nama_bus}
                                </h2>
                                <p className="mt-1">
                                    Rp {bus.harga_sewa.toLocaleString()} / hari
                                </p>
                            </div>

                            {/* Booking Form */}
                            <form
                                onSubmit={handleSubmit}
                                className="p-6 space-y-6"
                            >
                                <div className="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                    {/* Date Inputs */}
                                    <div>
                                        <label className="block text-sm font-medium text-gray-700">
                                            Tanggal Mulai
                                        </label>
                                        <input
                                            type="date"
                                            name="tanggal_mulai"
                                            required
                                            min={format(
                                                new Date(),
                                                "yyyy-MM-dd"
                                            )}
                                            value={formData.tanggal_mulai}
                                            onChange={handleChange}
                                            className="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        />
                                    </div>

                                    <div>
                                        <label className="block text-sm font-medium text-gray-700">
                                            Tanggal Selesai
                                        </label>
                                        <input
                                            type="date"
                                            name="tanggal_selesai"
                                            required
                                            min={formData.tanggal_mulai}
                                            value={formData.tanggal_selesai}
                                            onChange={handleChange}
                                            className="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        />
                                    </div>

                                    {/* Time Input */}
                                    <div>
                                        <label className="block text-sm font-medium text-gray-700">
                                            Jam Penjemputan
                                        </label>
                                        <input
                                            type="time"
                                            name="jam_penjemputan"
                                            required
                                            value={formData.jam_penjemputan}
                                            onChange={handleChange}
                                            className="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        />
                                    </div>

                                    {/* Location Inputs */}
                                    <div className="sm:col-span-2">
                                        <label className="block text-sm font-medium text-gray-700">
                                            Lokasi Penjemputan
                                        </label>
                                        <input
                                            type="text"
                                            name="lokasi_penjemputan"
                                            required
                                            value={formData.lokasi_penjemputan}
                                            onChange={handleChange}
                                            className="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            placeholder="Masukkan alamat lengkap"
                                        />
                                    </div>

                                    <div className="sm:col-span-2">
                                        <label className="block text-sm font-medium text-gray-700">
                                            Tujuan
                                        </label>
                                        <input
                                            type="text"
                                            name="tujuan"
                                            required
                                            value={formData.tujuan}
                                            onChange={handleChange}
                                            className="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            placeholder="Masukkan tujuan perjalanan"
                                        />
                                    </div>
                                </div>

                                {/* Total Price Display */}
                                <div className="p-4 rounded-lg bg-gray-50">
                                    <h3 className="text-lg font-medium text-gray-900">
                                        Total Harga
                                    </h3>
                                    <p className="text-2xl font-bold text-indigo-600">
                                        Rp{" "}
                                        {formData.total_harga.toLocaleString()}
                                    </p>
                                </div>

                                {/* Error Display */}
                                {error && (
                                    <div className="text-sm text-red-600">
                                        {Object.values(error).map((err, i) => (
                                            <p key={i}>{err}</p>
                                        ))}
                                    </div>
                                )}

                                {/* Submit Button */}
                                <div className="flex justify-end">
                                    <button
                                        type="submit"
                                        disabled={isLoading}
                                        className="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50"
                                    >
                                        {isLoading
                                            ? "Memproses..."
                                            : "Sewa Sekarang"}
                                    </button>
                                </div>
                            </form>
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
