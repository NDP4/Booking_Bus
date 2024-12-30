import { useState, useEffect } from "react";
import { router } from "@inertiajs/react";
import { format } from "date-fns";
import { toast, Toaster } from "react-hot-toast";

export default function DetailSewa({ bus, auth }) {
    console.log("DetailSewa Props:", { bus, auth }); // Add this line

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

    const handleSubmit = async (e) => {
        e.preventDefault();
        setIsLoading(true);
        setError(null);

        const start = new Date(formData.tanggal_mulai);
        const end = new Date(formData.tanggal_selesai);
        const diffTime = end.getTime() - start.getTime();
        const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
        const lama_sewa = diffDays + 1;

        router.post("/sewa", {
            ...formData,
            id_bus: bus.id,
            id_penyewa: auth.user.id,
            status: "Diproses",
            lama_sewa: lama_sewa
        }, {
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
            onFinish: () => setIsLoading(false)
        });
    };

    return (
        <div className="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
            <Toaster position="top-right" />
            <div className="max-w-3xl mx-auto">
                <div className="bg-white shadow-xl rounded-lg overflow-hidden">
                    {/* Bus Details Header */}
                    <div className="p-6 bg-indigo-600 text-white">
                        <h2 className="text-2xl font-bold">{bus.nama_bus}</h2>
                        <p className="mt-1">
                            Rp {bus.harga_sewa.toLocaleString()} / hari
                        </p>
                    </div>

                    {/* Booking Form */}
                    <form onSubmit={handleSubmit} className="p-6 space-y-6">
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
                                    min={format(new Date(), "yyyy-MM-dd")}
                                    value={formData.tanggal_mulai}
                                    onChange={handleChange}
                                    className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
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
                                    className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
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
                                    className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
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
                                    className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
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
                                    className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Masukkan tujuan perjalanan"
                                />
                            </div>
                        </div>

                        {/* Total Price Display */}
                        <div className="bg-gray-50 p-4 rounded-lg">
                            <h3 className="text-lg font-medium text-gray-900">
                                Total Harga
                            </h3>
                            <p className="text-2xl font-bold text-indigo-600">
                                Rp {formData.total_harga.toLocaleString()}
                            </p>
                        </div>

                        {/* Error Display */}
                        {error && (
                            <div className="text-red-600 text-sm">
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
                                className="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50"
                            >
                                {isLoading ? "Memproses..." : "Sewa Sekarang"}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    );
}
