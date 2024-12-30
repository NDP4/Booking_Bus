import { useEffect } from "react";
import { toast, Toaster } from "react-hot-toast";
import { router } from "@inertiajs/react";

export default function Payment({ sewa, bus, snapToken }) {
    useEffect(() => {
        console.log('Payment component props:', { sewa, bus, snapToken }); // Debug log

        // Load Midtrans Snap
        const midtransScriptUrl =
            "https://app.sandbox.midtrans.com/snap/snap.js";
        const myMidtransClientKey = import.meta.env.VITE_MIDTRANS_CLIENT_KEY;

        console.log('Midtrans client key:', myMidtransClientKey); // Debug log

        let scriptTag = document.createElement("script");
        scriptTag.src = midtransScriptUrl;
        scriptTag.setAttribute("data-client-key", myMidtransClientKey);

        document.body.appendChild(scriptTag);

        scriptTag.addEventListener('load', () => {
            console.log('Midtrans script loaded successfully'); // Debug log
        });

        scriptTag.addEventListener('error', (error) => {
            console.error('Midtrans script failed to load:', error); // Debug log
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
        <div className="min-h-screen px-4 py-12 bg-gray-100 sm:px-6 lg:px-8">
            <Toaster position="top-right" />
            <div className="max-w-3xl mx-auto">
                <div className="overflow-hidden bg-white rounded-lg shadow-xl">
                    <div className="p-6 text-white bg-indigo-600">
                        <h2 className="text-2xl font-bold">Detail Pesanan</h2>
                    </div>

                    <div className="p-6 space-y-6">
                        {/* Bus Details */}
                        <div className="pb-4 border-b">
                            <h3 className="text-lg font-medium">
                                Informasi Bus
                            </h3>
                            <p className="text-gray-600">{bus.nama_bus}</p>
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
                                        Rp {bus.harga_sewa.toLocaleString()}
                                    </span>
                                </div>
                                <div className="flex justify-between">
                                    <span>Lama sewa</span>
                                    <span>{sewa.lama_sewa} hari</span>
                                </div>
                                <div className="flex justify-between pt-2 text-lg font-bold border-t">
                                    <span>Total</span>
                                    <span>
                                        Rp {sewa.total_harga.toLocaleString()}
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
    );
}
