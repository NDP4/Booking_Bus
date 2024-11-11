<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $invoice->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .invoice-header { text-align: center; margin-bottom: 20px; }
        .invoice-details { margin-bottom: 30px; }
        .invoice-items table { width: 100%; border-collapse: collapse; }
        .invoice-items th, .invoice-items td { border: 1px solid #ddd; padding: 8px; }
        .company-info { margin-top: 20px; font-size: 12px; text-align: center; }
        .footer { margin-top: 30px; text-align: center; }
        .footer img { width: 100px; }
        .signature { margin-top: 30px; text-align: center; }
    </style>
</head>
<body>

<!-- Header Section -->
<div class="invoice-header">
    <img src="data:image/png;base64,{{ $logoBase64 }}" alt="Logo Perusahaan" style="max-width: 150px; margin-bottom: 20px;">
    <h1>Invoice #{{ $invoice->id }}</h1>
    <p>Date: {{ \Carbon\Carbon::parse($invoice->tanggal_terbit)->format('d M Y') }}</p>
</div>

<!-- Customer Information Section -->
<div class="invoice-details">
    <p><strong>Customer Name:</strong> {{ $invoice->sewa->penyewa->name ?? 'Unknown Customer' }}</p>
    <p><strong>Customer Address:</strong> {{ $invoice->sewa->penyewa->address ?? 'N/A' }}</p>
    <p><strong>Customer Phone:</strong> {{ $invoice->sewa->penyewa->phone_number ?? 'N/A' }}</p>
</div>

<!-- Invoice Details Section -->
<div class="invoice-items">
    <h3>Invoice Details</h3>
    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Date Started</th>
                <th>Destination</th>
                <th>Unit Price</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $invoice->sewa->bus->nama_bus ?? 'Unknown Bus' }}</td>
                <td>{{ \Carbon\Carbon::parse($invoice->sewa->tanggal_mulai)->format('d M Y') ?? 'N/A' }}</td>
                <td>{{ $invoice->sewa->tujuan ?? 'N/A' }}</td>
                <td>IDR {{ number_format($invoice->sewa->bus->harga_sewa, 0, ',', '.') }}</td>
                <td>IDR {{ number_format($invoice->jumlah, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Company Info Section -->
<div class="company-info">
    <h4>PO. Rizky Putra 168</h4>
    <p>Address: Ngrombo 02/015, Depok, Kec. Toroh, Kabupaten Grobogan, Jawa Tengah 58171</p>
    <p>Phone: 0813-1077-4168</p>
    <p>Instagram: <a href="https://www.instagram.com/rizkyputra168_/">https://www.instagram.com/rizkyputra168_/</a></p>
</div>

<!-- Company Logo -->
{{-- <div class="footer">
    <img src="data:image/png;base64,{{ $logoBase64 }}" alt="Company Logo">
</div> --}}

<!-- Signature Section -->
<div class="signature">
    <p>Admin Signature:</p>
    <p>______________________</p>
</div>

</body>
</html>
