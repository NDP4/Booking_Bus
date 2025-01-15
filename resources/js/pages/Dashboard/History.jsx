import { usePage, router } from "@inertiajs/react";
import { useState, useEffect } from "react";
import { format } from "date-fns";
import { id } from "date-fns/locale";
import DashboardLayout from "@/layouts/DashboardLayout";

export default function History() {
    const { sewas } = usePage().props;
    const [filterStatus, setFilterStatus] = useState("all");
    const [searchQuery, setSearchQuery] = useState("");
    const [showReviewModal, setShowReviewModal] = useState(false);
    const [selectedSewa, setSelectedSewa] = useState(null);
    const [rating, setRating] = useState(5);
    const [review, setReview] = useState("");

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
            case "Berlangsung":
                return "bg-green-100 text-green-800";
            case "Selesai":
                return "bg-blue-100 text-blue-800";
            case "Dibatalkan":
                return "bg-red-100 text-red-800";
            default:
                return "bg-gray-100 text-gray-800";
        }
    };

    const getPaymentStatusColor = (paymentStatus) => {
        switch (paymentStatus) {
            case "unpaid":
                return "bg-yellow-100 text-yellow-800";
            case "paid":
                return "bg-green-100 text-green-800";
            default:
                return "bg-gray-100 text-gray-800";
        }
    };

    const handleCancel = (sewaId) => {
        if (confirm("Apakah anda yakin ingin membatalkan pesanan ini?")) {
            router.post(
                `/sewa/${sewaId}/cancel`,
                {},
                {
                    onSuccess: () => {
                        // Reload the current page
                        router.reload();
                    },
                    onError: () => {
                        console.error("Gagal membatalkan pesanan");
                    },
                }
            );
        }
    };

    const handleReviewSubmit = () => {
        router.post(
            `/sewa/${selectedSewa}/review`,
            {
                rating: rating,
                ulasan: review,
            },
            {
                onSuccess: () => {
                    setShowReviewModal(false);
                    setSelectedSewa(null);
                    setRating(5);
                    setReview("");
                    router.reload();
                },
                onError: (errors) => {
                    console.error("Error submitting review:", errors);
                },
            }
        );
    };

    const openReviewModal = (sewa) => {
        setSelectedSewa(sewa.id);
        setShowReviewModal(true);
    };

    const handleContinuePayment = (sewaId) => {
        // Update the path to include /dashboard prefix
        router.get(`/dashboard/sewa/${sewaId}/continue-payment`);
    };

    return (
        <DashboardLayout active="history">
            <div className="p-8">
                <div className="max-w-4xl mx-auto space-y-8">
                    {/* Header */}
                    <div className="pb-6 border-b">
                        <h2 className="text-2xl font-semibold text-gray-900">
                            Riwayat Sewa
                        </h2>
                        <p className="mt-1 text-sm text-gray-500">
                            Manage your rental history and transactions
                        </p>
                    </div>

                    {/* Filters */}
                    <div className="flex flex-col gap-4">
                        <div className="flex flex-wrap gap-2">
                            {[
                                "all",
                                "Diproses",
                                "Berlangsung",
                                "Selesai",
                                "Dibatalkan",
                            ].map((status) => (
                                <button
                                    key={status}
                                    onClick={() => setFilterStatus(status)}
                                    className={`px-4 py-2 rounded-full text-sm font-medium transition-all
                                        ${
                                            filterStatus === status
                                                ? "bg-indigo-100 text-indigo-700 ring-2 ring-indigo-600 ring-offset-2"
                                                : "bg-gray-100 text-gray-600 hover:bg-gray-200"
                                        }`}
                                >
                                    {status === "all" ? "Semua" : status}
                                </button>
                            ))}
                        </div>
                        <input
                            type="text"
                            placeholder="Cari berdasarkan bus atau tujuan..."
                            value={searchQuery}
                            onChange={(e) => setSearchQuery(e.target.value)}
                            className="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        />
                    </div>

                    {/* Transaction List */}
                    <div className="space-y-4">
                        {filteredSewas.map((sewa) => (
                            <div
                                key={sewa.id}
                                className="overflow-hidden transition-shadow bg-white border border-gray-200 rounded-xl hover:shadow-md"
                            >
                                <div className="p-6">
                                    <div className="flex flex-col gap-6 md:flex-row">
                                        {/* Bus Image */}
                                        <div className="w-full h-32 overflow-hidden bg-gray-100 rounded-lg md:w-48">
                                            <img
                                                src={
                                                    sewa.bus_image ||
                                                    "/default-bus.jpg"
                                                }
                                                alt={sewa.bus_name}
                                                className="object-cover w-full h-full"
                                            />
                                        </div>

                                        {/* Details */}
                                        <div className="flex-grow space-y-4">
                                            <div className="flex items-start justify-between">
                                                <div>
                                                    <h3 className="text-lg font-semibold text-gray-900">
                                                        {sewa.bus_name}
                                                    </h3>
                                                    <p className="text-sm text-gray-500">
                                                        {format(
                                                            new Date(
                                                                sewa.start_date
                                                            ),
                                                            "d MMMM yyyy"
                                                        )}{" "}
                                                        -{" "}
                                                        {format(
                                                            new Date(
                                                                sewa.end_date
                                                            ),
                                                            "d MMMM yyyy"
                                                        )}
                                                    </p>
                                                </div>
                                                <div className="text-right">
                                                    <span className="text-lg font-bold text-gray-900">
                                                        Rp{" "}
                                                        {sewa.total_price.toLocaleString()}
                                                    </span>
                                                    <div className="flex gap-2 mt-2">
                                                        <span
                                                            className={`px-3 py-1 text-xs font-medium rounded-full
                                                            ${getStatusColor(
                                                                sewa.status
                                                            )}`}
                                                        >
                                                            {sewa.status}
                                                        </span>
                                                        <span
                                                            className={`px-3 py-1 text-xs font-medium rounded-full
                                                            ${getPaymentStatusColor(
                                                                sewa.payment_status
                                                            )}`}
                                                        >
                                                            {sewa.payment_status ===
                                                            "unpaid"
                                                                ? "Belum Dibayar"
                                                                : "Sudah Dibayar"}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            {/* Action Buttons */}
                                            <div className="flex flex-wrap gap-3 pt-4">
                                                {/* ... existing conditional buttons with updated styling ... */}
                                                {sewa.status === "Diproses" && (
                                                    <button
                                                        onClick={() =>
                                                            handleCancel(
                                                                sewa.id
                                                            )
                                                        }
                                                        className="px-4 py-2 text-sm font-medium text-red-600 transition-colors rounded-lg bg-red-50 hover:bg-red-100"
                                                    >
                                                        Batalkan Pesanan
                                                    </button>
                                                )}

                                                {sewa.status !== "Dibatalkan" &&
                                                    sewa.payment_status ===
                                                        "unpaid" && (
                                                        <button
                                                            onClick={() =>
                                                                handleContinuePayment(
                                                                    sewa.id
                                                                )
                                                            }
                                                            className="px-4 py-2 text-sm font-medium text-white transition-colors bg-indigo-600 rounded-lg hover:bg-indigo-700"
                                                        >
                                                            Lanjutkan Pembayaran
                                                        </button>
                                                    )}

                                                {sewa.status === "Selesai" &&
                                                    !sewa.has_review && (
                                                        <button
                                                            onClick={() =>
                                                                openReviewModal(
                                                                    sewa
                                                                )
                                                            }
                                                            className="px-4 py-2 text-sm font-medium text-green-600 transition-colors rounded-lg bg-green-50 hover:bg-green-100"
                                                        >
                                                            Beri Ulasan
                                                        </button>
                                                    )}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ))}

                        {/* Empty State */}
                        {filteredSewas.length === 0 && (
                            <div className="py-12 text-center">
                                <div className="flex items-center justify-center w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full">
                                    <svg
                                        className="w-12 h-12 text-gray-400"
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
            </div>

            {/* Review Modal */}
            {showReviewModal && (
                <div className="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                    <div className="w-full max-w-md p-6 bg-white rounded-lg">
                        <h3 className="mb-4 text-lg font-semibold">
                            Beri Ulasan
                        </h3>
                        <div className="mb-4">
                            <label className="block mb-2 text-sm font-medium">
                                Rating
                            </label>
                            <div className="flex gap-2">
                                {[1, 2, 3, 4, 5].map((star) => (
                                    <button
                                        key={star}
                                        onClick={() => setRating(star)}
                                        className={`text-2xl ${
                                            star <= rating
                                                ? "text-yellow-400"
                                                : "text-gray-300"
                                        }`}
                                    >
                                        ★
                                    </button>
                                ))}
                            </div>
                        </div>
                        <div className="mb-4">
                            <label className="block mb-2 text-sm font-medium">
                                Ulasan
                            </label>
                            <textarea
                                value={review}
                                onChange={(e) => setReview(e.target.value)}
                                className="w-full px-3 py-2 border rounded-lg"
                                rows="4"
                                placeholder="Bagaimana pengalaman anda?"
                            ></textarea>
                        </div>
                        <div className="flex justify-end gap-2">
                            <button
                                onClick={() => setShowReviewModal(false)}
                                className="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 rounded-md hover:bg-gray-200"
                            >
                                Batal
                            </button>
                            <button
                                onClick={handleReviewSubmit}
                                className="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700"
                            >
                                Kirim Ulasan
                            </button>
                        </div>
                    </div>
                </div>
            )}
        </DashboardLayout>
    );
}
