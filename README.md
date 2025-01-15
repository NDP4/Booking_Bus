# 🚌 Po. Rizky Putra 168 - Sistem Penyewaan Bus

Sistem manajemen penyewaan bus modern menggunakan Laravel, React, dan Filament Admin Panel dengan pembayaran online melalui Midtrans.

## ✨ Fitur Utama

-   **Sistem Pemesanan**

    -   Pencarian dan filter bus berdasarkan kapasitas/harga
    -   Cek ketersediaan secara real-time
    -   Pemilihan lokasi dengan Google Maps
    -   Kalender pemesanan interaktif

-   **Pembayaran**

    -   Integrasi dengan Midtrans
    -   Status pembayaran real-time
    -   Invoice otomatis
    -   Notifikasi pembayaran

-   **Panel Admin**

    -   Manajemen armada bus
    -   Tracking pemesanan
    -   Laporan keuangan
    -   Manajemen pengguna

-   **Fitur Pelanggan**
    -   Profil pengguna
    -   Riwayat pemesanan
    -   Sistem review dan rating
    -   Status pemesanan real-time

## 🛠️ Teknologi

### Backend

-   Laravel 10.x dengan PHP 8.2
-   MariaDB 10.5
-   Filament Admin Panel
-   Inertia.js

### Frontend

-   React.js
-   Tailwind CSS
-   Vite

### Services

-   Midtrans Payment Gateway
-   Docker & Docker Compose
-   NGINX

## 📋 Prasyarat

-   PHP 8.2 atau lebih tinggi
-   Node.js 18 atau lebih tinggi
-   Composer
-   Docker & Docker Compose
-   Akun Midtrans

## 💻 Instalasi

### Pengembangan Lokal

1. Clone repositori & instal dependensi

```
git clone https://github.com/NDP4/Booking_Bus.git
```

⚙️ Konfigurasi
Environment Variables

```
APP_NAME="Po. Rizky Putra 168"
APP_ENV=production
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_IS_PRODUCTION=false
```

👥 Peran Pengguna
Admin

-   Manajemen bus dan pemesanan
-   Lihat laporan dan analitik
-   Kelola pengguna
-   Proses pembatalan/refund
    Pelanggan

-   Cari dan pesan bus
-   Lakukan pembayaran
-   Lihat riwayat pemesanan
-   Beri ulasan

📱 Endpoint API

-   /product - Daftar bus
-   /product/{id} - Detail bus
-   /product/{id}/sewa - Form pemesanan
-   /dashboard/history - Riwayat pemesanan
-   /sewa/{id}/review - Submit ulasan

🔒 Keamanan

-   CSRF Protection
-   SQL Injection Prevention
-   XSS Protection
-   Rate Limiting
-   Secure Payment Handling

🤝 Kontribusi

1.  Fork repositori
2.  Buat branch fitur (git checkout -b fitur/AmazingFeature)
3.  Commit perubahan (git commit -m 'Menambahkan fitur')
4.  Push ke branch (git push origin fitur/AmazingFeature)
5.  Buat Pull Request

📄 Lisensi

Proyek ini dilisensikan di bawah Lisensi MIT.

Email: nurdwipriyambodo@proton.me
WhatsApp: +6285951657887
Website: (https://ndp4.showwcase.com/)
