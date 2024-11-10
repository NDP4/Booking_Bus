<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lanjutan Pembayaran Sewa Bus</title>
    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>
<body>
    <h1>Pembayaran Sewa Bus</h1>
    <p>Detail Penyewaan: {{ $sewa->bus->nama_bus }} - {{ $sewa->total_harga }}</p>

    @if($status->transaction_status == 'pending')
        <h2>Status Pembayaran: Tertunda</h2>
        <p>Silakan lanjutkan pembayaran Anda.</p>

        <button id="pay-button">Lanjutkan Pembayaran</button>

        <script>
        document.getElementById('pay-button').onclick = function() {
            var snapToken = "{{ $snapToken }}";

            window.snap.pay(snapToken, {
                onSuccess: function(result) {
                    console.log("Payment success:", result);
                    // Arahkan ke halaman sukses jika pembayaran berhasil
                    window.location.href = "{{ route('sewa.sukses', ['id' => $sewa->id]) }}";
                },
                onPending: function(result) {
                    console.log("Payment pending:", result);
                    // Tampilkan pesan jika statusnya masih tertunda
                    alert('Pembayaran masih dalam proses. Silakan tunggu.');
                },
                onError: function(result) {
                    console.log("Payment error:", result);
                    // Tampilkan pesan jika terjadi error
                    alert('Terjadi kesalahan saat memproses pembayaran.');
                }
            });
        };
        </script>
    @elseif($status->transaction_status == 'settlement')
        <h2>Status Pembayaran: Selesai</h2>
        <p>Pembayaran Anda telah berhasil!</p>
    @else
        <h2>Status Pembayaran: Gagal</h2>
        <p>Pembayaran Anda gagal atau dibatalkan. Silakan coba lagi.</p>
    @endif
</body>
</html>
