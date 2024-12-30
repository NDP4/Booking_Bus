import { usePage } from "@inertiajs/react";
import { useState, useEffect } from "react";
import { format } from "date-fns";
import { id } from "date-fns/locale";

export default function History() {
    const { sewas } = usePage().props;
    const [filterStatus, setFilterStatus] = useState("all");
    const [searchQuery, setSearchQuery] = useState("");
    const [isLoading, setIsLoading] = useState(true);

    // Debug logs
    useEffect(() => {
        console.log("History component rendered");
        console.log("Sewas data:", sewas);
        setIsLoading(false);
    }, [sewas]);

    // Add error handling
    if (!sewas) {
        console.error("No sewas data available");
        return <div>Error: No data available</div>;
    }

    // Loading state
    if (isLoading) {
        return (
            <div className="flex items-center justify-center min-h-screen">
                <div className="w-32 h-32 border-b-2 border-indigo-600 rounded-full animate-spin"></div>
            </div>
        );
    }

    const filteredSewas = sewas.filter((sewa) => {
        const matchesStatus =
            filterStatus === "all" || sewa.status === filterStatus;
        const matchesSearch =
            sewa.bus_name.toLowerCase().includes(searchQuery.toLowerCase()) ||
            sewa.destination.toLowerCase().includes(searchQuery.toLowerCase());
        return matchesStatus && matchesSearch;
    });

    const getStatusColor = (status) => {
        switch (status) {
            case "Diproses":
                return "bg-yellow-100 text-yellow-800";
            case "Dibayar":
                return "bg-green-100 text-green-800";
            case "Selesai":
                return "bg-blue-100 text-blue-800";
            case "Dibatalkan":
                return "bg-red-100 text-red-800";
            default:
                return "bg-gray-100 text-gray-800";
        }
    };

    return (
        <div className="min-h-screen py-8 bg-gray-50">
            <div className="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <h1 className="mb-8 text-3xl font-bold text-gray-900">
                    Riwayat Sewa
                </h1>

                {/* Filters and Search */}
                <div className="p-6 mb-6 bg-white rounded-lg shadow">
                    <div className="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                        <div className="flex flex-wrap gap-2">
                            <button
                                onClick={() => setFilterStatus("all")}
                                className={`px-4 py-2 rounded-full text-sm font-medium ${
                                    filterStatus === "all"
                                        ? "bg-indigo-100 text-indigo-800"
                                        : "bg-gray-100 text-gray-600 hover:bg-gray-200"
                                }`}
                            >
                                Semua
                            </button>
                            {[
                                "Diproses",
                                "Dibayar",
                                "Selesai",
                                "Dibatalkan",
                            ].map((status) => (
                                <button
                                    key={status}
                                    onClick={() => setFilterStatus(status)}
                                    className={`px-4 py-2 rounded-full text-sm font-medium ${
                                        filterStatus === status
                                            ? "bg-indigo-100 text-indigo-800"
                                            : "bg-gray-100 text-gray-600 hover:bg-gray-200"
                                    }`}
                                >
                                    {status}
                                </button>
                            ))}
                        </div>
                        <div className="relative">
                            <input
                                type="text"
                                placeholder="Cari berdasarkan bus atau tujuan..."
                                value={searchQuery}
                                onChange={(e) => setSearchQuery(e.target.value)}
                                className="w-full px-4 py-2 border border-gray-300 rounded-lg md:w-80 focus:ring-indigo-500 focus:border-indigo-500"
                            />
                        </div>
                    </div>
                </div>

                {/* Transaction List */}
                <div className="space-y-4">
                    {filteredSewas.map((sewa) => (
                        <div
                            key={sewa.id}
                            className="overflow-hidden transition-shadow duration-200 bg-white rounded-lg shadow hover:shadow-md"
                        >
                            <div className="p-6">
                                <div className="flex flex-col md:flex-row md:items-center md:justify-between">
                                    <div className="flex items-center space-x-4">
                                        <div className="w-24 h-24 overflow-hidden rounded-lg">
                                            {sewa.bus_image ? (
                                                <img
                                                    src={sewa.bus_image}
                                                    alt={sewa.bus_name}
                                                    className="object-cover w-full h-full"
                                                />
                                            ) : (
                                                <div className="flex items-center justify-center w-full h-full bg-gray-200">
                                                    <span className="text-gray-400">
                                                        No image
                                                    </span>
                                                </div>
                                            )}
                                        </div>
                                        <div>
                                            <h3 className="text-lg font-semibold text-gray-900">
                                                {sewa.bus_name}
                                            </h3>
                                            <p className="text-sm text-gray-600">
                                                {format(
                                                    new Date(sewa.start_date),
                                                    "d MMMM yyyy",
                                                    { locale: id }
                                                )}{" "}
                                                -{" "}
                                                {format(
                                                    new Date(sewa.end_date),
                                                    "d MMMM yyyy",
                                                    { locale: id }
                                                )}
                                            </p>
                                            <p className="text-sm text-gray-600">
                                                Jam Penjemputan:{" "}
                                                {sewa.pickup_time}
                                            </p>
                                            <p className="text-sm text-gray-600">
                                                {sewa.location} →{" "}
                                                {sewa.destination}
                                            </p>
                                        </div>
                                    </div>
                                    <div className="flex flex-col items-end mt-4 md:mt-0">
                                        <span className="text-lg font-bold text-gray-900">
                                            Rp{" "}
                                            {sewa.total_price.toLocaleString()}
                                        </span>
                                        <span
                                            className={`mt-2 px-3 py-1 rounded-full text-sm font-medium ${getStatusColor(
                                                sewa.status
                                            )}`}
                                        >
                                            {sewa.status}
                                        </span>
                                        <span className="mt-1 text-sm text-gray-500">
                                            {sewa.created_at}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ))}

                    {filteredSewas.length === 0 && (
                        <div className="py-12 text-center">
                            <svg
                                className="w-12 h-12 mx-auto text-gray-400"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    strokeWidth="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                />
                            </svg>
                            <h3 className="mt-2 text-sm font-medium text-gray-900">
                                Tidak ada riwayat sewa
                            </h3>
                            <p className="mt-1 text-sm text-gray-500">
                                Belum ada transaksi sewa yang tercatat.
                            </p>
                        </div>
                    )}
                </div>
            </div>
        </div>
    );
}
