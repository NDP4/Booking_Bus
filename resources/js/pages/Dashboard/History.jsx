import { usePage } from "@inertiajs/react";
import { useState, useEffect } from "react";
import { format } from "date-fns";
import { id } from "date-fns/locale";
import DashboardLayout from "@/layouts/DashboardLayout";

export default function History() {
    const { sewas } = usePage().props;
    const [filterStatus, setFilterStatus] = useState("all");
    const [searchQuery, setSearchQuery] = useState("");

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
        <DashboardLayout active="history">
            <div className="p-6">
                {/* Filters */}
                <div className="mb-6 space-y-4">
                    <div className="flex flex-wrap gap-2">
                        <button
                            onClick={() => setFilterStatus("all")}
                            className={`px-4 py-2 text-sm font-medium rounded-full ${
                                filterStatus === "all"
                                    ? "bg-indigo-100 text-indigo-800"
                                    : "bg-gray-100 text-gray-600 hover:bg-gray-200"
                            }`}
                        >
                            Semua
                        </button>
                        {["Diproses", "Dibayar", "Selesai", "Dibatalkan"].map(
                            (status) => (
                                <button
                                    key={status}
                                    onClick={() => setFilterStatus(status)}
                                    className={`px-4 py-2 text-sm font-medium rounded-full ${
                                        filterStatus === status
                                            ? "bg-indigo-100 text-indigo-800"
                                            : "bg-gray-100 text-gray-600 hover:bg-gray-200"
                                    }`}
                                >
                                    {status}
                                </button>
                            )
                        )}
                    </div>
                    <input
                        type="text"
                        placeholder="Cari berdasarkan bus atau tujuan..."
                        value={searchQuery}
                        onChange={(e) => setSearchQuery(e.target.value)}
                        className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                    />
                </div>

                {/* Transaction List */}
                <div className="space-y-4">
                    {filteredSewas.map((sewa) => (
                        <div
                            key={sewa.id}
                            className="overflow-hidden bg-white border rounded-lg shadow-sm"
                        >
                            <div className="p-4">
                                <div className="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                                    <div className="flex gap-4">
                                        <div className="w-24 h-24 overflow-hidden bg-gray-100 rounded-lg">
                                            <img
                                                src={
                                                    sewa.bus_image ||
                                                    "/default-bus.jpg"
                                                }
                                                alt={sewa.bus_name}
                                                className="object-cover w-full h-full"
                                            />
                                        </div>
                                        <div>
                                            <h3 className="text-lg font-semibold">
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
                                                {sewa.location} →{" "}
                                                {sewa.destination}
                                            </p>
                                        </div>
                                    </div>
                                    <div className="flex flex-col items-end gap-2">
                                        <span className="text-lg font-bold">
                                            Rp{" "}
                                            {sewa.total_price.toLocaleString()}
                                        </span>
                                        <span
                                            className={`px-3 py-1 text-sm font-medium rounded-full ${getStatusColor(
                                                sewa.status
                                            )}`}
                                        >
                                            {sewa.status}
                                        </span>
                                        <span className="text-sm text-gray-500">
                                            {sewa.created_at}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ))}

                    {filteredSewas.length === 0 && (
                        <div className="py-12 text-center">
                            <div className="inline-flex items-center justify-center w-16 h-16 mb-4 rounded-full bg-gray-50">
                                <svg
                                    className="w-8 h-8 text-gray-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth={2}
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                                    />
                                </svg>
                            </div>
                            <h3 className="text-sm font-medium text-gray-900">
                                Tidak ada riwayat sewa
                            </h3>
                            <p className="mt-1 text-sm text-gray-500">
                                Belum ada transaksi sewa yang tercatat.
                            </p>
                        </div>
                    )}
                </div>
            </div>
        </DashboardLayout>
    );
}
