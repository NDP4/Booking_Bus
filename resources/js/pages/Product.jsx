import { useState, useEffect, useRef } from "react";
import { router } from "@inertiajs/react";
import { format } from "date-fns";
import Slider from "rc-slider";
import "rc-slider/assets/index.css";
import { FaFacebook, FaInstagram, FaTwitter, FaWhatsapp } from "react-icons/fa";
import { HoverBorderGradient } from "../components/ui/hover-border-gradient";
import { usePage, Link } from "@inertiajs/react";
import { cn } from "../lib/utils";
import { Menu, MenuItem } from "../components/ui/navbar-menu";

export default function Product({
    buses,
    filters,
    uniqueCapacities,
    priceRange,
}) {
    const { auth } = usePage().props;
    const isAuthenticated = auth && auth.user;
    const [filterData, setFilterData] = useState({
        tanggal_mulai: filters.tanggal_mulai || "",
        tanggal_selesai: filters.tanggal_selesai || "",
        kapasitas: filters.kapasitas || "",
        harga_min: filters.harga_min || "",
        harga_max: filters.harga_max || "",
        search: filters.search || "",
    });

    const [priceValues, setPriceValues] = useState([
        filters.harga_min || priceRange.min,
        filters.harga_max || priceRange.max,
    ]);

    const handleFilterChange = (e) => {
        const { name, value } = e.target;
        // Ensure capacity is a positive number
        if (name === "kapasitas" && value !== "") {
            const numValue = parseInt(value);
            if (numValue < 0) return;
        }

        setFilterData((prev) => ({
            ...prev,
            [name]: value,
        }));
    };

    const handlePriceChange = (value) => {
        setPriceValues(value);
        setFilterData((prev) => ({
            ...prev,
            harga_min: value[0],
            harga_max: value[1],
        }));
    };

    // Format price to Rupiah
    const formatPrice = (value) => {
        return `Rp ${value.toLocaleString()}`;
    };

    const applyFilters = () => {
        const filters = {
            ...filterData,
            harga_min: priceValues[0],
            harga_max: priceValues[1],
        };

        // Remove empty filters
        Object.keys(filters).forEach(
            (key) => !filters[key] && delete filters[key]
        );

        router.get("/product", filters, {
            preserveState: true,
            preserveScroll: true,
        });
    };

    const resetFilters = () => {
        setPriceValues([priceRange.min, priceRange.max]);
        setFilterData({
            tanggal_mulai: "",
            tanggal_selesai: "",
            kapasitas: "",
            harga_min: "",
            harga_max: "",
            search: "",
        });
        router.get("/product");
    };

    const handleSearch = (e) => {
        const { value } = e.target;
        setFilterData((prev) => ({
            ...prev,
            search: value,
        }));

        // Optional: Debounce the search
        if (searchTimeout.current) {
            clearTimeout(searchTimeout.current);
        }

        searchTimeout.current = setTimeout(() => {
            router.get(
                "/product",
                {
                    ...filterData,
                    search: value,
                },
                {
                    preserveState: true,
                    preserveScroll: true,
                }
            );
        }, 300);
    };

    // Add debounce ref
    const searchTimeout = useRef(null);

    return (
        <div className="flex flex-col min-h-screen">
            <Navbar
                className="top-0"
                isAuthenticated={isAuthenticated}
                handleLogout={() => router.post("/logout")}
            />

            <div className="flex-grow min-h-screen py-8 bg-gray-100">
                <div className="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="flex gap-6">
                        {/* Sidebar Filter */}
                        <div className="w-64 shrink-0">
                            <div className="sticky p-6 bg-white rounded-lg shadow top-8">
                                <h2 className="mb-4 text-lg font-semibold">
                                    Filter Bus
                                </h2>

                                <div className="space-y-4">
                                    <div>
                                        <label className="block text-sm font-medium text-gray-700">
                                            Tanggal Mulai
                                        </label>
                                        <input
                                            type="date"
                                            name="tanggal_mulai"
                                            value={filterData.tanggal_mulai}
                                            onChange={handleFilterChange}
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
                                            value={filterData.tanggal_selesai}
                                            onChange={handleFilterChange}
                                            className="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        />
                                    </div>

                                    <div>
                                        <label className="block text-sm font-medium text-gray-700">
                                            Kapasitas Bus
                                        </label>
                                        <select
                                            name="kapasitas"
                                            value={filterData.kapasitas}
                                            onChange={handleFilterChange}
                                            className="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        >
                                            <option value="">
                                                Semua Kapasitas
                                            </option>
                                            {uniqueCapacities.map(
                                                (capacity) => (
                                                    <option
                                                        key={capacity}
                                                        value={capacity}
                                                    >
                                                        {capacity} orang
                                                    </option>
                                                )
                                            )}
                                        </select>
                                    </div>

                                    <div>
                                        <label className="block mb-2 text-sm font-medium text-gray-700">
                                            Range Harga
                                        </label>
                                        <div className="px-2 pt-2">
                                            <Slider
                                                range
                                                min={priceRange.min}
                                                max={priceRange.max}
                                                value={priceValues}
                                                onChange={handlePriceChange}
                                                step={100000}
                                                vertical={false}
                                                railStyle={{
                                                    backgroundColor: "#E5E7EB",
                                                }}
                                                trackStyle={[
                                                    {
                                                        backgroundColor:
                                                            "#4F46E5",
                                                    },
                                                ]}
                                                handleStyle={[
                                                    {
                                                        backgroundColor:
                                                            "white",
                                                        borderColor: "#4F46E5",
                                                        opacity: 1,
                                                    },
                                                    {
                                                        backgroundColor:
                                                            "white",
                                                        borderColor: "#4F46E5",
                                                        opacity: 1,
                                                    },
                                                ]}
                                            />
                                            <div className="flex justify-between mt-2 text-sm text-gray-600">
                                                <span>
                                                    {formatPrice(
                                                        priceValues[0]
                                                    )}
                                                </span>
                                                <span>
                                                    {formatPrice(
                                                        priceValues[1]
                                                    )}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label className="block text-sm font-medium text-gray-700">
                                            Cari Bus
                                        </label>
                                        <input
                                            type="text"
                                            name="search"
                                            value={filterData.search}
                                            onChange={handleSearch}
                                            placeholder="Nama atau deskripsi bus..."
                                            className="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        />
                                    </div>

                                    <div className="flex flex-col gap-2 pt-4">
                                        <button
                                            onClick={applyFilters}
                                            className="w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700"
                                        >
                                            Terapkan Filter
                                        </button>
                                        <button
                                            onClick={resetFilters}
                                            className="w-full px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50"
                                        >
                                            Reset
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {/* Main Content */}
                        <div className="flex-1">
                            {/* Active Filters */}
                            {(filterData.kapasitas ||
                                filterData.harga_max ||
                                filterData.search ||
                                filterData.tanggal_mulai) && (
                                <div className="flex flex-wrap gap-2 mb-4">
                                    {filterData.kapasitas && (
                                        <span className="inline-flex items-center px-3 py-1 text-sm font-medium text-indigo-800 bg-indigo-100 rounded-full">
                                            Kapasitas: {filterData.kapasitas}{" "}
                                            orang
                                            <button
                                                onClick={() => {
                                                    setFilterData((prev) => ({
                                                        ...prev,
                                                        kapasitas: "",
                                                    }));
                                                    router.get("/product", {
                                                        ...filterData,
                                                        kapasitas: "",
                                                    });
                                                }}
                                                className="ml-2 hover:text-indigo-500"
                                            >
                                                ×
                                            </button>
                                        </span>
                                    )}
                                    {filterData.harga_min &&
                                        filterData.harga_max && (
                                            <span className="inline-flex items-center px-3 py-1 text-sm font-medium text-indigo-800 bg-indigo-100 rounded-full">
                                                Harga:{" "}
                                                {formatPrice(
                                                    filterData.harga_min
                                                )}{" "}
                                                -{" "}
                                                {formatPrice(
                                                    filterData.harga_max
                                                )}
                                                <button
                                                    onClick={() => {
                                                        setPriceValues([
                                                            priceRange.min,
                                                            priceRange.max,
                                                        ]);
                                                        setFilterData(
                                                            (prev) => ({
                                                                ...prev,
                                                                harga_min: "",
                                                                harga_max: "",
                                                            })
                                                        );
                                                    }}
                                                    className="ml-2 hover:text-indigo-500"
                                                >
                                                    ×
                                                </button>
                                            </span>
                                        )}
                                    {filterData.search && (
                                        <span className="inline-flex items-center px-3 py-1 text-sm font-medium text-indigo-800 bg-indigo-100 rounded-full">
                                            Pencarian: {filterData.search}
                                            <button
                                                onClick={() => {
                                                    setFilterData((prev) => ({
                                                        ...prev,
                                                        search: "",
                                                    }));
                                                    router.get(
                                                        "/product",
                                                        {
                                                            ...filterData,
                                                            search: "",
                                                        },
                                                        {
                                                            preserveState: true,
                                                            preserveScroll: true,
                                                        }
                                                    );
                                                }}
                                                className="ml-2 hover:text-indigo-500"
                                            >
                                                ×
                                            </button>
                                        </span>
                                    )}
                                </div>
                            )}

                            {/* Bus List */}
                            <div className="mb-6">
                                <h2 className="mb-4 text-xl font-semibold text-gray-900">
                                    {filterData.tanggal_mulai &&
                                    filterData.tanggal_selesai
                                        ? "Bus Tersedia"
                                        : "Semua Bus"}
                                </h2>
                                <div className="grid grid-cols-1 gap-6 md:grid-cols-2">
                                    {buses
                                        .filter((bus) => !bus.is_booked)
                                        .map((bus) => (
                                            <BusCard
                                                key={bus.id}
                                                bus={bus}
                                                filterData={filterData}
                                            />
                                        ))}
                                </div>
                            </div>

                            {/* Booked Buses Section */}
                            {filterData.tanggal_mulai &&
                                filterData.tanggal_selesai &&
                                buses.some((bus) => bus.is_booked) && (
                                    <div className="mt-8">
                                        <h2 className="mb-4 text-xl font-semibold text-gray-900">
                                            Bus Tidak Tersedia pada Tanggal
                                            Terpilih
                                        </h2>
                                        <div className="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                                            {buses
                                                .filter((bus) => bus.is_booked)
                                                .map((bus) => (
                                                    <BusCard
                                                        key={bus.id}
                                                        bus={bus}
                                                        filterData={filterData}
                                                    />
                                                ))}
                                        </div>
                                    </div>
                                )}

                            {buses.length === 0 && (
                                <div className="py-12 text-center">
                                    <h3 className="text-lg font-medium text-gray-900">
                                        Tidak ada bus yang tersedia
                                    </h3>
                                    <p className="mt-1 text-sm text-gray-500">
                                        Coba ubah filter atau cari di tanggal
                                        lain
                                    </p>
                                </div>
                            )}
                        </div>
                    </div>
                </div>
            </div>

            {/* Add Footer */}
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

// Create a separate BusCard component for reusability
const BusCard = ({ bus, filterData }) => (
    <div className="overflow-hidden bg-white rounded-lg shadow">
        <div className="relative">
            <img
                src={bus.image || "/default-bus.jpg"}
                alt={bus.nama_bus}
                className="object-cover w-full h-48"
            />
            {bus.is_booked && filterData.tanggal_mulai && (
                <div className="absolute top-0 left-0 right-0 py-1 text-sm text-center text-white bg-red-500">
                    Sudah Dibooking pada periode ini
                </div>
            )}
        </div>
        <div className="p-4">
            <h3 className="text-lg font-semibold text-gray-900">
                {bus.nama_bus}
            </h3>
            <p className="mt-1 text-sm text-gray-600">{bus.deskripsi}</p>
            <div className="flex items-center justify-between mt-2">
                <span className="text-gray-600">
                    Kapasitas: {bus.kapasitas} orang
                </span>
                <span className="font-semibold text-indigo-600">
                    Rp {bus.harga_sewa.toLocaleString()}
                </span>
            </div>

            {bus.booking_dates.length > 0 && (
                <div className="mt-2 text-sm text-red-600">
                    <p>Tanggal yang sudah dibooking:</p>
                    {bus.booking_dates.map((date, index) => (
                        <p key={index}>
                            {format(new Date(date.start), "dd MMM yyyy")} -{" "}
                            {format(new Date(date.end), "dd MMM yyyy")}
                        </p>
                    ))}
                </div>
            )}

            <div className="mt-4">
                <a
                    href={`/product/${bus.id}`}
                    className={`block text-center px-4 py-2 rounded-md text-sm font-medium ${
                        bus.is_booked
                            ? "bg-gray-300 cursor-not-allowed"
                            : "bg-indigo-600 text-white hover:bg-indigo-700"
                    }`}
                    onClick={(e) => {
                        if (bus.is_booked) {
                            e.preventDefault();
                        }
                    }}
                >
                    {bus.is_booked ? "Tidak Tersedia" : "Lihat Detail"}
                </a>
            </div>
        </div>
    </div>
);
