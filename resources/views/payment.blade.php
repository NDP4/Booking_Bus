<!-- resources/views/payment.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Sewa Bus</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>

<body class="bg-blue-50 font-sans">

    <div class="max-w-4xl mx-auto px-4 py-12">

        <div class="text-center mb-8">
            <h1 class="text-3xl font-semibold text-blue-600">Pembayaran Sewa Bus</h1>
            <p class="text-lg text-gray-600 mt-2">Segera lakukan pembayaran untuk mengkonfirmasi penyewaan bus Anda.</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-gray-800">Detail Penyewaan</h2>
            <p class="mt-4 text-gray-600">Bus: <span class="font-semibold text-blue-500">{{ $sewa->bus->nama_bus }}</span></p>

            <p class="mt-4 text-gray-600">Tanggal Sewa: <span class="font-semibold text-blue-500">{{ \Carbon\Carbon::parse($sewa->tanggal_mulai)->format('d M Y') }}</span></p>

            <p class="mt-2 text-gray-600">Jam Penjemputan: <span class="font-semibold text-blue-500">{{ \Carbon\Carbon::parse($sewa->jam_penjemputan)->format('H:i') }}</span></p>

            <p class="mt-2 text-gray-600">Tujuan: <span class="font-semibold text-blue-500">{{ $sewa->tujuan }}</span></p>
            <p class="mt-4 text-1xl  ">
                Total yang harus dibayarkan: <span class="text-3xl font-bold text-blue-500">Rp {{ number_format($sewa->total_harga, 0, ',', '.') }}</span>
            </p>
        </div>

        <div class="mt-4 text-gray-500">
            <p><strong>Catatan:</strong></p>
            <p class="italic text-sm">Jika Anda mengalami kendala dalam pembayaran, Anda dapat menyimpan nomor Virtual Account untuk pembayaran tertunda.</p>
            <p class="italic text-sm">Atau, download QRCode untuk metode pembayaran QRIS.</p>
        </div>

        <div class="mt-8 flex justify-center">
            <button id="pay-button"
                class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 focus:outline-none transition duration-300">
                Bayar Sekarang
            </button>
        </div>
    </div>

    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>


    <script>
        document.getElementById('pay-button').onclick = function () {
            var snapToken = "{{ $snapToken }}";

            window.snap.pay(snapToken, {
                onSuccess: function (result) {
                    console.log("Payment success:", result);
                    // Kirim data menggunakan metode POST ke endpoint payment-callback
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/sewa/{{ $sewa->id }}/payment-callback';  // URL tujuan

                    // Tambahkan CSRF token
                    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    var csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;
                    form.appendChild(csrfInput);

                    // Tambahkan parameter untuk status transaksi
                    var statusInput = document.createElement('input');
                    statusInput.type = 'hidden';
                    statusInput.name = 'transaction_status';
                    statusInput.value = 'settlement'; // status pembayaran
                    form.appendChild(statusInput);

                    // Kirim form
                    document.body.appendChild(form);
                    form.submit();
                },
                onPending: function (result) {
                    console.log("Payment pending:", result);
                },
                onError: function (result) {
                    console.log("Payment error:", result);
                }
            });
        };

    </script>

</body>

</html>
