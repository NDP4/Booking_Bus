import React, { useState, useEffect } from "react";
import axios from "axios";

const Payment = ({ sewa }) => {
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(null);
    const [snapToken, setSnapToken] = useState(null);

    useEffect(() => {
        const fetchSnapToken = async () => {
            setLoading(true);
            try {
                const response = await axios.get(
                    `/api/midtrans/snap-token/${sewa.id}`
                );
                setSnapToken(response.data.snap_token);
            } catch (err) {
                setError("Gagal mengambil Snap Token");
                console.error(err);
            } finally {
                setLoading(false);
            }
        };
        fetchSnapToken();
    }, [sewa.id]);

    const handlePayment = () => {
        if (!snapToken) {
            setError("Snap Token tidak ditemukan");
            return;
        }

        if (window.midtrans) {
            window.midtrans.snap.pay(snapToken, {
                onSuccess: function (result) {
                    console.log("Payment Success: ", result);
                    axios
                        .post("/api/transaction/verify", {
                            order_id: result.order_id,
                            status: result.transaction_status,
                        })
                        .then((response) => {
                            console.log("Transaction verified", response.data);
                        })
                        .catch((error) => {
                            console.error("Error verifying transaction", error);
                        });
                },
                onPending: function (result) {
                    console.log("Payment Pending: ", result);
                },
                onError: function (result) {
                    console.log("Payment Error: ", result);
                },
            });
        }
    };

    return (
        <div>
            <h1>Pembayaran Penyewaan Bus</h1>
            {loading && <p>Loading...</p>}
            {error && <p style={{ color: "red" }}>{error}</p>}
            <button onClick={handlePayment} disabled={loading}>
                {loading ? "Memuat..." : "Bayar Sekarang"}
            </button>
        </div>
    );
};

export default Payment;
