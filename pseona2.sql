-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 08, 2025 at 06:47 AM
-- Server version: 8.0.36
-- PHP Version: 8.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pseona2`
--

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

CREATE TABLE `buses` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_bus` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plat_nomor` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kapasitas` int NOT NULL,
  `tahun` year NOT NULL,
  `sasis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `karoseri` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_kir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fasilitas` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_bus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kondisi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_sewa` int NOT NULL,
  `status` enum('Tersedia','Tidak Tersedia','Dalam Perawatan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`id`, `nama_bus`, `plat_nomor`, `kapasitas`, `tahun`, `sasis`, `karoseri`, `nomor_kir`, `fasilitas`, `foto_bus`, `kondisi`, `harga_sewa`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Amoxicillin', 'K 7809 OF', 50, '2018', 'Hino RK 8 R260 JSKA HNJ J08E UF Air Suspension', 'Adiputro Jetbus 3+ SHD', 'JR1111', 'DIspenser, TV, AC, Slimut, Bantal', 'bus-photos/01JCHRZ9NYGKDX31KSSXZ7HKQH.jpeg', 'Layak', 4300000, 'Tersedia', '2024-11-13 03:27:17', '2024-11-13 03:27:17'),
(2, 'Propofol', 'AB 7032 KN', 50, '2018', 'Hino RK 8 R260 JSKA HNJ J08E UF Air Suspension', 'Adiputro Jetbus 3+ SHD', 'JR1112', 'Dispenser, TV, AC, Karaoke, Slimut, Bantal', 'bus-photos/01JCHS5QVER20YGHSY66T48ZY2.jpeg', 'Layak', 4300000, 'Tersedia', '2024-11-13 03:30:48', '2024-11-13 03:30:48'),
(3, 'Acyclovir', 'K 1670 DW', 50, '2018', 'Hino RK 8 R260 JSKA HNJ J08E UF Air Suspension', 'Adiputro Jetbus 3+ SHD', 'JR1113', 'Dispenser, TV, AC, Karaoke, Slimut, Bantal', 'bus-photos/01JCHS83SM36JET34PJ7K6Q299.jpeg', 'Layak', 4300000, 'Tersedia', '2024-11-13 03:32:06', '2024-11-13 03:32:06'),
(4, 'Paracetamol', 'K 7822 OF', 50, '2018', 'Hino RK 8 R260 JSKA HNJ J08E UF Air Suspension', 'Adiputro Jetbus 3+ SHD', 'JR1114', 'Dispenser, TV, AC, Karaoke, Slimut, Bantal', 'bus-photos/01JCHSANCYG1X88AM77VBG5Q5Y.jpg', 'Layak', 4300000, 'Tersedia', '2024-11-13 03:33:29', '2024-11-13 03:33:29'),
(5, 'Boceprevir', 'K 1685 AL', 50, '2015', 'Hino RK 8 R260 JSKA HNJ J08E UF Air Suspension', 'Adiputro Jetbus 3+ SHD', 'JR1115', 'Dispenser, TV, AC, Karaoke, Slimut, Bantal', 'bus-photos/01JCHSCEKBQGX005ZMXJZGVNR0.jpeg', 'Layak', 4300000, 'Tersedia', '2024-11-13 03:34:28', '2024-11-13 03:34:28'),
(6, 'UltraFlu', 'K 7777 OF', 42, '2020', 'Hino RK 8 R260 JSKA HNJ J08E UF Air Suspension', 'Adiputro Jetbus 3+ SHD', 'JR1118', 'Banyak ', 'bus-photos/01JCHV1YQ5QTKGGXFQSE9JB1RN.jpeg', 'Baru', 4500000, 'Tersedia', '2024-11-13 04:03:41', '2024-11-13 04:03:41'),
(7, 'Paramex', 'H 2018 TV', 50, '2018', 'Hino', 'Adi Putro', '12345567', 'AC\nWifi\nTv', 'bus-photos/01JGDQYGJ1DM6YVV32B0XZM05Y.jpg', 'Layak', 10000000, 'Tersedia', '2024-12-31 06:55:12', '2024-12-31 06:55:12');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokumentasi_kerusakans`
--

CREATE TABLE `dokumentasi_kerusakans` (
  `id` bigint UNSIGNED NOT NULL,
  `maintenance_id` bigint UNSIGNED NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exports`
--

CREATE TABLE `exports` (
  `id` bigint UNSIGNED NOT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `file_disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exporter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processed_rows` int UNSIGNED NOT NULL DEFAULT '0',
  `total_rows` int UNSIGNED NOT NULL,
  `successful_rows` int UNSIGNED NOT NULL DEFAULT '0',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_import_rows`
--

CREATE TABLE `failed_import_rows` (
  `id` bigint UNSIGNED NOT NULL,
  `data` json NOT NULL,
  `import_id` bigint UNSIGNED NOT NULL,
  `validation_error` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foto_dokumentasis`
--

CREATE TABLE `foto_dokumentasis` (
  `id` bigint UNSIGNED NOT NULL,
  `bus_id` bigint UNSIGNED NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `imports`
--

CREATE TABLE `imports` (
  `id` bigint UNSIGNED NOT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `importer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processed_rows` int UNSIGNED NOT NULL DEFAULT '0',
  `total_rows` int UNSIGNED NOT NULL,
  `successful_rows` int UNSIGNED NOT NULL DEFAULT '0',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint UNSIGNED NOT NULL,
  `sewa_id` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `tanggal_terbit` datetime DEFAULT NULL,
  `status` enum('Belum Dibayar','Dibayar') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `sewa_id`, `jumlah`, `tanggal_terbit`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 8600000, '2024-11-13 10:55:49', 'Belum Dibayar', '2024-11-13 03:55:49', '2024-11-13 03:55:49');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `aktivitas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maintenances`
--

CREATE TABLE `maintenances` (
  `id` bigint UNSIGNED NOT NULL,
  `bus_id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Belum Diperbaiki','Dalam Perbaikan','Selesai') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_items`
--

CREATE TABLE `maintenance_items` (
  `id` bigint UNSIGNED NOT NULL,
  `maintenance_id` bigint UNSIGNED NOT NULL,
  `nama_item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biaya` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_10_29_134123_add_custom_fields_to_users_table', 1),
(5, '2024_10_29_134124_add_avatar_url_to_users_table', 1),
(6, '2024_10_30_215103_create_buses_table', 1),
(7, '2024_10_30_231228_create_sewas_table', 1),
(8, '2024_10_31_010515_create_penilaians_table', 1),
(9, '2024_10_31_010559_create_maintenances_table', 1),
(10, '2024_10_31_010629_create_maintenance_items_table', 1),
(11, '2024_10_31_010717_create_dokumentasi_kerusakans_table', 1),
(12, '2024_10_31_010746_create_log_aktivitas_table', 1),
(13, '2024_10_31_010825_create_sewa_crews_table', 1),
(14, '2024_10_31_010855_create_foto_dokumentasis_table', 1),
(15, '2024_10_31_010924_create_riwayat_sewas_table', 1),
(16, '2024_10_31_010950_create_invoices_table', 1),
(17, '2024_11_02_200639_create_notifications_table', 1),
(18, '2024_11_10_023417_create_imports_table', 1),
(19, '2024_11_10_023418_create_exports_table', 1),
(20, '2024_11_10_023419_create_failed_import_rows_table', 1),
(21, '2024_12_31_231444_add_payment_columns_to_sewas', 2),
(22, '2025_01_03_235030_add_payment_columns_to_sewas_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('03112866-15fd-41f4-b532-0de5e6e2c28b', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 9, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah menambahkan bus baru\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Bus baru telah bertambah\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-11-13 04:03:41', '2024-11-13 04:03:41'),
('0ac2d0c4-8cb6-4723-a128-b6a4633c9449', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 5, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah menambahkan bus baru\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Bus baru telah bertambah\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-11-13 04:03:41', '2024-11-13 04:03:41'),
('0f81e6af-0768-4fb9-8b3c-059284ed49f1', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 11, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah menambahkan bus baru\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Bus baru telah bertambah\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-12-31 06:55:12', '2024-12-31 06:55:12'),
('15d3f70a-d8b1-45ac-a515-f17635e3217f', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 13, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah memperbarui status sewa Anda.\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-exclamation-circle\",\"iconColor\":\"warning\",\"status\":\"warning\",\"title\":\"Status sewa Anda telah diperbarui\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2025-01-03 17:11:26', '2025-01-03 17:11:26'),
('185c94a0-a93a-490f-9a73-4783145aa7f2', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 14, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah menambahkan bus baru\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Bus baru telah bertambah\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-12-31 06:55:12', '2024-12-31 06:55:12'),
('20caaa8b-8ccd-42bc-9ea0-27f93ca1372e', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 1, '{\"actions\":[],\"body\":\"Penyewaan baru telah dibuat oleh user.\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Penyewaan Baru Telah Dibuat\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-11-13 03:55:31', '2024-11-13 03:55:31'),
('23cd44d1-8636-49a7-a082-50fb8e84afd5', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 13, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah memperbarui status sewa Anda.\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-exclamation-circle\",\"iconColor\":\"warning\",\"status\":\"warning\",\"title\":\"Status sewa Anda telah diperbarui\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-12-31 07:00:39', '2024-12-31 07:00:39'),
('322bdc14-85db-40d3-87ef-eb559b39317e', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 3, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah menambahkan bus baru\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Bus baru telah bertambah\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-12-31 06:55:12', '2024-12-31 06:55:12'),
('33041355-e161-4f0e-98e4-a7a03ec7f07e', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 10, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah menambahkan bus baru\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Bus baru telah bertambah\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-12-31 06:55:12', '2024-12-31 06:55:12'),
('3dfcd618-53a8-4fea-95bc-dd7f7528be94', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 13, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah memperbarui status sewa Anda.\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-exclamation-circle\",\"iconColor\":\"warning\",\"status\":\"warning\",\"title\":\"Status sewa Anda telah diperbarui\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2025-01-03 17:07:07', '2025-01-03 17:07:07'),
('4414054c-7e67-4cdf-bd31-e7e7ca4d1792', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 9, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah menambahkan bus baru\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Bus baru telah bertambah\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-12-31 06:55:12', '2024-12-31 06:55:12'),
('44c8ac7f-b9b1-4a12-bb81-7dffc6ee0a0c', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 4, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah menambahkan bus baru\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Bus baru telah bertambah\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-12-31 06:55:12', '2024-12-31 06:55:12'),
('4c75b92f-5e51-44e1-a87d-2d85f5d6178e', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 6, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah menambahkan bus baru\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Bus baru telah bertambah\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-11-13 04:03:41', '2024-11-13 04:03:41'),
('4d6e47a7-5825-438e-a0be-2502228f48f7', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 1, '{\"actions\":[],\"body\":\"Penyewaan baru telah dibuat oleh user.\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Penyewaan Baru Telah Dibuat\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-11-13 04:05:25', '2024-11-13 04:05:25'),
('4fb81fb4-702e-4932-96dc-e0b2febca125', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 13, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah memperbarui status sewa Anda.\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-exclamation-circle\",\"iconColor\":\"warning\",\"status\":\"warning\",\"title\":\"Status sewa Anda telah diperbarui\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2025-01-03 18:19:19', '2025-01-03 18:19:19'),
('50bd9735-4446-4cc5-aad3-e239236e0701', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 1, '{\"actions\":[],\"body\":\"Penyewaan baru telah dibuat oleh user.\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Penyewaan Baru Telah Dibuat\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-11-13 04:07:09', '2024-11-13 04:07:09'),
('52088e5b-5bb9-40de-a3d1-a6877ced3269', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 2, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah menambahkan bus baru\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Bus baru telah bertambah\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-11-13 04:03:41', '2024-11-13 04:03:41'),
('54be499c-a69a-4c73-88a5-d3a105f66625', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 3, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah menambahkan bus baru\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Bus baru telah bertambah\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-11-13 04:03:41', '2024-11-13 04:03:41'),
('5f0b9acc-7823-40d3-9f0a-37e23123897a', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 9, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah memperbarui status sewa Anda.\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-exclamation-circle\",\"iconColor\":\"warning\",\"status\":\"warning\",\"title\":\"Status sewa Anda telah diperbarui\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-12-31 05:48:55', '2024-12-31 05:48:55'),
('64db08e4-c921-4f2f-bfb9-f17931aaf84e', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 12, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah memperbarui status sewa Anda.\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-exclamation-circle\",\"iconColor\":\"warning\",\"status\":\"warning\",\"title\":\"Status sewa Anda telah diperbarui\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-12-31 06:32:54', '2024-12-31 06:32:54'),
('6da6d06c-e3bd-4091-bc6a-debbf18a40f2', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 4, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah menambahkan bus baru\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Bus baru telah bertambah\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-11-13 04:03:41', '2024-11-13 04:03:41'),
('80b3dbeb-6c06-465c-875b-cc5dfbcb5466', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 12, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah menambahkan bus baru\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Bus baru telah bertambah\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-12-31 06:55:12', '2024-12-31 06:55:12'),
('986dd4b3-bbcb-4e83-943f-a916599e8c53', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 7, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah menambahkan bus baru\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Bus baru telah bertambah\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-12-31 06:55:12', '2024-12-31 06:55:12'),
('9a1d5f02-6886-455e-acec-46482e14eb6c', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 13, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah menambahkan bus baru\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Bus baru telah bertambah\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-12-31 06:55:12', '2024-12-31 06:55:12'),
('a0a97072-41ec-4107-bdd8-317d0d8d757e', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 2, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah menambahkan bus baru\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Bus baru telah bertambah\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-12-31 06:55:12', '2024-12-31 06:55:12'),
('bb5e73df-3cb5-4309-a8b4-1f71abae5947', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 13, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah memperbarui status sewa Anda.\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-exclamation-circle\",\"iconColor\":\"warning\",\"status\":\"warning\",\"title\":\"Status sewa Anda telah diperbarui\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2025-01-03 17:07:28', '2025-01-03 17:07:28'),
('bb784d7e-5bdd-4486-9919-55e9deaa0c83', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 9, '{\"actions\":[],\"body\":\"Data penyewaan Anda telah berhasil dibuat.\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Penyewaan Anda Telah Dibuat\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-11-13 04:07:09', '2024-11-13 04:07:09'),
('bd0e7730-c393-4f10-9978-3721507ca598', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 8, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah menambahkan bus baru\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Bus baru telah bertambah\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-11-13 04:03:41', '2024-11-13 04:03:41'),
('cf165c4e-96f3-4994-a86a-bc84d81bd8af', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 6, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah menambahkan bus baru\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Bus baru telah bertambah\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-12-31 06:55:12', '2024-12-31 06:55:12'),
('cf4333ce-b05d-40ff-8e29-20362dbea934', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 13, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah memperbarui status sewa Anda.\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-exclamation-circle\",\"iconColor\":\"warning\",\"status\":\"warning\",\"title\":\"Status sewa Anda telah diperbarui\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-12-31 06:44:14', '2024-12-31 06:44:14'),
('d4012d12-289c-4847-9ced-aa0597a260d3', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 5, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah menambahkan bus baru\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Bus baru telah bertambah\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-12-31 06:55:12', '2024-12-31 06:55:12'),
('d54039e6-49a3-49a6-9f3a-a33db48c1930', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 13, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah memperbarui status sewa Anda.\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-exclamation-circle\",\"iconColor\":\"warning\",\"status\":\"warning\",\"title\":\"Status sewa Anda telah diperbarui\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2025-01-03 17:50:15', '2025-01-03 17:50:15'),
('deda17ec-fffb-48cf-a442-81c18492b9ce', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 9, '{\"actions\":[],\"body\":\"Data penyewaan Anda telah berhasil dibuat.\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Penyewaan Anda Telah Dibuat\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-11-13 04:05:25', '2024-11-13 04:05:25'),
('e0582873-2186-4d40-9456-e1d3e8f7145c', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 9, '{\"actions\":[],\"body\":\"Data penyewaan Anda telah berhasil dibuat.\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Penyewaan Anda Telah Dibuat\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-11-13 03:55:31', '2024-11-13 03:55:31'),
('e7536bce-5be2-43d4-81c9-2966fead256f', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 7, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah menambahkan bus baru\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Bus baru telah bertambah\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-11-13 04:03:41', '2024-11-13 04:03:41'),
('f893ed1d-7416-4980-9fa9-b37dc532ccfa', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 8, '{\"actions\":[{\"name\":\"Tandai sudah dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai sudah dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"},{\"name\":\"Tandai belum dibaca\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Tandai belum dibaca\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":true,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":null,\"view\":\"filament-actions::link-action\"}],\"body\":\"Admin telah menambahkan bus baru\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Bus baru telah bertambah\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2024-12-31 06:55:12', '2024-12-31 06:55:12');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penilaians`
--

CREATE TABLE `penilaians` (
  `id` bigint UNSIGNED NOT NULL,
  `sewa_id` bigint UNSIGNED NOT NULL,
  `penyewa_id` bigint UNSIGNED NOT NULL,
  `rating` tinyint UNSIGNED NOT NULL,
  `ulasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penilaians`
--

INSERT INTO `penilaians` (`id`, `sewa_id`, `penyewa_id`, `rating`, `ulasan`, `created_at`, `updated_at`) VALUES
(1, 1, 9, 5, 'Mantullll', NULL, NULL),
(2, 2, 9, 3, 'sedap mantap', NULL, NULL),
(3, 16, 9, 5, 'sad', '2024-12-31 06:37:59', '2024-12-31 06:37:59'),
(4, 28, 12, 5, 'msntul', '2024-12-31 06:38:11', '2024-12-31 06:38:11'),
(5, 29, 13, 4, 'Layanan Sangat Bagus dan Nyaman', '2024-12-31 06:44:58', '2024-12-31 06:44:58'),
(6, 30, 13, 5, 'Mantap', '2024-12-31 07:01:03', '2024-12-31 07:01:03'),
(7, 31, 13, 3, 'kurang bersih', '2025-01-03 18:43:25', '2025-01-03 18:43:25');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_sewas`
--

CREATE TABLE `riwayat_sewas` (
  `id` bigint UNSIGNED NOT NULL,
  `sewa_id` bigint UNSIGNED NOT NULL,
  `status_sebelumnya` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_saat_ini` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `riwayat_sewas`
--

INSERT INTO `riwayat_sewas` (`id`, `sewa_id`, `status_sebelumnya`, `status_saat_ini`, `waktu`, `created_at`, `updated_at`) VALUES
(1, 24, 'Diproses', 'Berlangsung', '2024-12-31 05:48:55', '2024-12-31 05:48:55', '2024-12-31 05:48:55'),
(2, 23, 'Diproses', 'Dibatalkan', '2024-12-31 06:21:10', '2024-12-31 06:21:10', '2024-12-31 06:21:10'),
(3, 22, 'Diproses', 'Dibatalkan', '2024-12-31 06:22:55', '2024-12-31 06:22:55', '2024-12-31 06:22:55'),
(4, 27, 'Diproses', 'Dibatalkan', '2024-12-31 06:22:56', '2024-12-31 06:22:56', '2024-12-31 06:22:56'),
(5, 25, 'Diproses', 'Dibatalkan', '2024-12-31 06:23:23', '2024-12-31 06:23:23', '2024-12-31 06:23:23'),
(6, 28, 'Diproses', 'Selesai', '2024-12-31 06:32:54', '2024-12-31 06:32:54', '2024-12-31 06:32:54'),
(7, 26, 'Diproses', 'Dibatalkan', '2024-12-31 06:41:17', '2024-12-31 06:41:17', '2024-12-31 06:41:17'),
(8, 29, 'Diproses', 'Selesai', '2024-12-31 06:44:14', '2024-12-31 06:44:14', '2024-12-31 06:44:14'),
(9, 30, 'Diproses', 'Selesai', '2024-12-31 07:00:39', '2024-12-31 07:00:39', '2024-12-31 07:00:39'),
(10, 32, 'Diproses', 'Dibayar', '2025-01-03 17:07:07', '2025-01-03 17:07:07', '2025-01-03 17:07:07'),
(11, 34, 'Diproses', 'Dibatalkan', '2025-01-03 17:50:15', '2025-01-03 17:50:15', '2025-01-03 17:50:15');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('34kJdONUF2egtUyClR3xhyH0yucpR2rNimxdRRNF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiclIxVGFISGVIalZkNXVmc1dsRVU2eVY3MUpxSjNXTk1sU1hmZVp2RyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1735933824),
('YmJ4y5rNJPCfVPYrc3vxlgdzvFmjEeTN1FwBe0Gu', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiVlhtSFdOVFV3UDF3ajhTWWNHNEJvRGQ3Q3htU0hCcTB2WkNMemRCVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9zZXdhcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkLmVkckV3czdDQ0hRLk1adjhMNEduTzZSRWJkVDk1bDIzaU11NjB2YnF0eC96Q1AuZWZFcmkiO3M6ODoiZmlsYW1lbnQiO2E6MDp7fX0=', 1735932730);

-- --------------------------------------------------------

--
-- Table structure for table `sewas`
--

CREATE TABLE `sewas` (
  `id` bigint UNSIGNED NOT NULL,
  `id_penyewa` bigint UNSIGNED NOT NULL,
  `id_bus` bigint UNSIGNED NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `jam_penjemputan` time NOT NULL,
  `lokasi_penjemputan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_harga` int NOT NULL,
  `tujuan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Diproses','Berlangsung','Selesai','Dibatalkan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `snap_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sewas`
--

INSERT INTO `sewas` (`id`, `id_penyewa`, `id_bus`, `tanggal_mulai`, `tanggal_selesai`, `jam_penjemputan`, `lokasi_penjemputan`, `total_harga`, `tujuan`, `status`, `created_at`, `updated_at`, `snap_token`, `payment_status`) VALUES
(1, 9, 1, '2024-11-14', '2024-11-15', '10:55:26', 'dad', 8600000, 'asd', 'Diproses', '2024-11-13 03:55:31', '2024-11-13 03:55:31', NULL, 'unpaid'),
(2, 9, 6, '2024-11-14', '2024-11-16', '11:04:21', 'Semarang', 13500000, 'Jogja', 'Diproses', '2024-11-13 04:05:25', '2024-11-13 04:05:25', NULL, 'unpaid'),
(3, 9, 6, '2025-01-01', '2025-01-01', '04:20:00', 'https://maps.app.goo.gl/1QPNx7Niz58rvxoFA', 4500000, 'Bali', 'Diproses', '2024-12-29 17:20:12', '2024-12-29 17:20:12', NULL, 'unpaid'),
(4, 9, 6, '2025-01-03', '2025-01-04', '05:24:00', 'https://maps.app.goo.gl/1QPNx7Niz58rvxoFA', 9000000, 'Bali', 'Diproses', '2024-12-29 17:24:49', '2024-12-29 17:24:49', NULL, 'unpaid'),
(5, 9, 5, '2025-01-01', '2025-01-01', '05:34:00', 'https://maps.app.goo.gl/1QPNx7Niz58rvxoFA', 4300000, 'Jogja', 'Diproses', '2024-12-29 17:34:24', '2024-12-29 17:34:24', NULL, 'unpaid'),
(6, 9, 5, '2025-01-02', '2025-01-03', '05:34:00', 'https://maps.app.goo.gl/1QPNx7Niz58rvxoFA', 8600000, 'Jogja', 'Diproses', '2024-12-29 17:35:14', '2024-12-29 17:35:14', NULL, 'unpaid'),
(7, 9, 5, '2025-01-10', '2025-01-11', '05:38:00', 'https://maps.app.goo.gl/1QPNx7Niz58rvxoFA', 8600000, 'smg', 'Selesai', '2024-12-29 17:39:03', '2024-12-29 17:39:03', NULL, 'unpaid'),
(8, 9, 5, '2025-01-05', '2025-01-05', '05:39:00', 'https://maps.app.goo.gl/1QPNx7Niz58rvxoFA', 4300000, 'smg', 'Diproses', '2024-12-29 17:39:55', '2024-12-29 17:39:55', NULL, 'unpaid'),
(9, 9, 4, '2025-01-01', '2025-01-01', '05:45:00', 'https://maps.app.goo.gl/1QPNx7Niz58rvxoFA', 4300000, 'mana aja', 'Diproses', '2024-12-29 17:45:50', '2024-12-29 17:45:50', NULL, 'unpaid'),
(10, 9, 2, '2025-01-02', '2025-01-02', '05:13:00', 'https://maps.app.goo.gl/1QPNx7Niz58rvxoFA', 4300000, 'Bali', 'Diproses', '2024-12-29 18:13:11', '2024-12-29 18:13:11', NULL, 'unpaid'),
(11, 9, 2, '2025-01-03', '2025-01-03', '05:14:00', 'https://maps.app.goo.gl/1QPNx7Niz58rvxoFA', 4300000, 'smg', 'Diproses', '2024-12-29 18:14:19', '2024-12-29 18:14:19', NULL, 'unpaid'),
(12, 9, 2, '2025-01-04', '2025-01-04', '03:19:00', 'https://maps.app.goo.gl/1QPNx7Niz58rvxoFA', 4300000, 'Jogja', 'Diproses', '2024-12-29 18:19:54', '2024-12-29 18:19:54', NULL, 'unpaid'),
(13, 9, 2, '2025-01-05', '2025-01-05', '05:24:00', 'https://maps.app.goo.gl/1QPNx7Niz58rvxoFA', 4300000, 'mana aja', 'Diproses', '2024-12-29 18:24:49', '2024-12-29 18:24:49', NULL, 'unpaid'),
(14, 9, 2, '2025-01-06', '2025-01-06', '05:31:00', 'https://maps.app.goo.gl/1QPNx7Niz58rvxoFA', 4300000, 'mana aja boleh', 'Diproses', '2024-12-29 18:31:22', '2024-12-29 18:31:22', NULL, 'unpaid'),
(15, 9, 2, '2025-01-07', '2025-01-07', '06:33:00', 'https://maps.app.goo.gl/1QPNx7Niz58rvxoFA', 4300000, 'Jogja', 'Diproses', '2024-12-29 18:33:28', '2024-12-29 18:33:28', NULL, 'unpaid'),
(16, 9, 2, '2025-01-08', '2025-01-08', '05:35:00', 'https://maps.app.goo.gl/1QPNx7Niz58rvxoFA', 4300000, 'Bali', 'Selesai', '2024-12-29 18:35:12', '2024-12-29 18:35:12', NULL, 'unpaid'),
(17, 9, 1, '2025-01-01', '2025-01-02', '19:46:00', 'Sembarang', 8600000, 'brebes', 'Diproses', '2024-12-30 10:46:55', '2024-12-30 10:46:55', NULL, 'unpaid'),
(19, 9, 2, '2025-01-11', '2025-01-11', '04:23:00', 'https://maps.app.goo.gl/1QPNx7Niz58rvxoFA', 4300000, 'mana aja boleh', 'Diproses', '2024-12-30 18:23:54', '2024-12-30 18:23:54', NULL, 'unpaid'),
(20, 9, 2, '2025-01-12', '2025-01-12', '04:24:00', 'https://maps.app.goo.gl/1QPNx7Niz58rvxoFA', 4300000, 'mana aja boleh', 'Diproses', '2024-12-30 18:24:55', '2024-12-30 18:24:55', NULL, 'unpaid'),
(21, 9, 2, '2025-01-13', '2025-01-13', '05:26:00', 'https://maps.app.goo.gl/1QPNx7Niz58rvxoFA', 4300000, 'Bali', 'Diproses', '2024-12-30 18:26:38', '2024-12-30 18:26:38', NULL, 'unpaid'),
(22, 9, 3, '2025-01-10', '2025-01-11', '04:40:00', 'https://maps.app.goo.gl/1QPNx7Niz58rvxoFA', 8600000, 'mana aja', 'Dibatalkan', '2024-12-30 18:40:57', '2024-12-31 06:22:55', NULL, 'unpaid'),
(23, 9, 2, '2025-01-25', '2025-01-25', '04:58:00', 'https://maps.app.goo.gl/1QPNx7Niz58rvxoFA', 4300000, 'mana aja boleh', 'Dibatalkan', '2024-12-30 18:58:45', '2024-12-31 06:21:10', NULL, 'unpaid'),
(24, 9, 2, '2025-01-20', '2025-01-20', '15:44:00', 'https://maps.app.goo.gl/1QPNx7Niz58rvxoFA', 4300000, 'Bali', 'Berlangsung', '2024-12-31 05:44:54', '2024-12-31 05:48:55', NULL, 'unpaid'),
(25, 12, 1, '2025-01-10', '2025-02-13', '13:06:00', '-', 150500000, '-', 'Dibatalkan', '2024-12-31 06:06:21', '2024-12-31 06:23:23', NULL, 'unpaid'),
(26, 13, 3, '2025-01-02', '2025-01-07', '13:30:00', 'Udinus', 25800000, 'Bali', 'Dibatalkan', '2024-12-31 06:09:10', '2024-12-31 06:41:17', NULL, 'unpaid'),
(27, 14, 1, '2025-12-30', '2026-12-31', '13:15:00', 'ungaran', 1578100000, 'bali', 'Dibatalkan', '2024-12-31 06:16:07', '2024-12-31 06:22:56', NULL, 'unpaid'),
(28, 12, 1, '2025-01-04', '2025-01-04', '13:31:00', '-', 4300000, '-', 'Selesai', '2024-12-31 06:31:35', '2024-12-31 06:32:54', NULL, 'unpaid'),
(29, 13, 1, '2025-01-07', '2025-01-09', '13:45:00', 'Udinus', 12900000, 'Bali', 'Selesai', '2024-12-31 06:43:36', '2025-01-03 17:11:26', '55ab43e8-0055-4486-bcd8-5e000741afc2', 'paid'),
(30, 13, 7, '2025-01-01', '2025-01-11', '13:58:00', 'ungaran', 110000000, 'bali', 'Berlangsung', '2024-12-31 06:58:42', '2025-01-03 18:16:28', 'c8475f4b-72d4-4826-bd6f-72c5d1a5eb72', 'paid'),
(31, 13, 3, '2025-01-01', '2025-01-01', '02:21:00', 'https://maps.app.goo.gl/1QPNx7Niz58rvxoFA', 4300000, 'Bali', 'Selesai', '2024-12-31 16:21:58', '2025-01-03 18:16:28', 'a857549d-fdd7-4589-8f5e-3f49c153b0c8', 'paid'),
(32, 13, 7, '2025-01-22', '2025-01-23', '04:31:00', 'https://maps.app.goo.gl/1QPNx7Niz58rvxoFA', 20000000, 'mana aja boleh', 'Diproses', '2025-01-03 16:32:01', '2025-01-03 17:07:28', 'a11655b4-5059-4630-9840-f1c8a60aa091', 'paid'),
(33, 13, 4, '2025-01-04', '2025-01-05', '03:28:00', 'https://maps.app.goo.gl/1QPNx7Niz58rvxoFA', 8600000, 'mana aja', 'Berlangsung', '2025-01-03 17:28:44', '2025-01-03 18:19:19', 'a8d36807-ab13-4e9e-918e-850cf055ee9e', 'paid'),
(34, 13, 5, '2025-01-06', '2025-01-07', '02:49:00', 'https://maps.app.goo.gl/1QPNx7Niz58rvxoFA', 8600000, 'mana aja boleh', 'Dibatalkan', '2025-01-03 17:49:16', '2025-01-03 17:50:15', NULL, 'unpaid'),
(35, 13, 6, '2025-01-06', '2025-01-07', '02:53:00', 'https://maps.app.goo.gl/1QPNx7Niz58rvxoFA', 9000000, 'smg', 'Diproses', '2025-01-03 17:53:41', '2025-01-03 19:47:44', 'e9fddc24-ced4-492f-a5c4-6155ae1db674', 'unpaid'),
(36, 13, 2, '2025-01-09', '2025-01-10', '03:05:00', 'https://maps.app.goo.gl/1QPNx7Niz58rvxoFA', 8600000, 'smg', 'Diproses', '2025-01-03 18:05:24', '2025-01-03 18:05:34', '014f7537-732e-424e-a118-c28cb83714d1', 'unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `sewa_crews`
--

CREATE TABLE `sewa_crews` (
  `id` bigint UNSIGNED NOT NULL,
  `sewa_id` bigint UNSIGNED NOT NULL,
  `crew_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik` int DEFAULT NULL,
  `role` enum('admin','crew','konsumen') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'konsumen',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `custom_fields` json DEFAULT NULL,
  `avatar_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `phone_number`, `address`, `nik`, `role`, `created_at`, `updated_at`, `custom_fields`, `avatar_url`) VALUES
(1, 'admin', 'admin@mail.com', '2024-11-13 03:21:38', '$2y$12$.edrEws7CCHQ.MZv8L4GnO6REbdT95l23iMu60vbqtx/zCP.efEri', NULL, NULL, NULL, NULL, 'admin', NULL, '2024-11-13 03:28:24', NULL, 'avatars/01JCHS1BQ8ABMXE77172WAEPFE.png'),
(2, 'Pak Said', 'said@mail.com', '2024-11-13 03:51:34', '$2y$12$0lZg4gul7UH0q/HZMYcAOOBLgXk5sKOOXyc/jZKYizjOen5Lk7GAW', NULL, '081282286027', 'Jl. Grobogan', 15478, 'crew', '2024-11-13 03:43:23', '2024-11-13 03:51:34', NULL, NULL),
(3, 'Kang Imam', 'imam@mail.com', NULL, '$2y$12$r837dkcXQBHnVsjH4DLSS.my.vl7Yjp7F2hobEYi.9PfBzIefmzhO', NULL, '081310774151', 'Jl. Grobogan', 15546, 'crew', '2024-11-13 03:44:30', '2024-11-13 03:44:30', NULL, NULL),
(4, 'Pak Warto', 'warto@mail.com', NULL, '$2y$12$.dO61sA0TlTOdlZn4CKS0ejlBGwpSAT96HKy9ghCH6ec4N2ci598W', NULL, '081310774161', 'Jl. Grobogan', 51546, 'crew', '2024-11-13 03:45:44', '2024-11-13 03:45:44', NULL, NULL),
(5, 'Mas Ahmed', 'ahmed@mail.com', NULL, '$2y$12$cxSvCFAlW6gLM4X1ncLMTeTA9O2zxo1fb0fMJPQ67E/7ptalTp4cW', NULL, '081310774162', 'Jl. Grobogan', 46468, 'crew', '2024-11-13 03:47:07', '2024-11-13 03:47:07', NULL, NULL),
(6, 'Pak Budi', 'budi@mail.com', NULL, '$2y$12$MGBaRjtxw2eXgbKEYtGPyeaSB/JAhHcEN9O8tXEURj6F04C1n5nBC', NULL, '081310774165', 'Jl. Grobogan', 65549, 'crew', '2024-11-13 03:48:23', '2024-11-13 03:48:23', NULL, NULL),
(7, 'Mas Totok', 'totok@mail.com', NULL, '$2y$12$oFuLLNXi8dwn27rSOj2a6..gx7TIpAum.dW0vFND2rTTISOgwJZjG', NULL, '081310774166', 'Jl. Grobogan', 44898, 'crew', '2024-11-13 03:49:16', '2024-11-13 03:49:16', NULL, NULL),
(8, 'Om Jujuk', 'jujuk@mail.com', NULL, '$2y$12$qy3QkDh4QhUlOrSHQIB8UuElSqzfMG5oKmrXyOo6bd9t5O9Hw58wm', NULL, '081310774164', 'Jl. grobogan', 54545, 'crew', '2024-11-13 03:50:39', '2024-11-13 03:50:39', NULL, NULL),
(9, 'user', 'user@mail.com', '2024-11-13 03:54:34', '$2y$12$1RCLioMx/qMcMv/7haMQEOMXklOgg6ajMREwrt9qVhbZv/2K63nBi', NULL, NULL, NULL, NULL, 'konsumen', '2024-11-13 03:52:54', '2024-12-31 05:41:48', NULL, 'avatars/2f5LFBy1APRigjPKZW77qdNA8NzULlYXhUH6BW1I.jpg'),
(10, 'nandito', 'dito@mail.com', NULL, '$2y$12$QipZ8CE8i6JEFtjjqr.CAeHhfcQLGjRuoCqrwwmUwrk1BV0/Tt4Pe', NULL, NULL, NULL, NULL, 'konsumen', '2024-12-31 06:01:03', '2024-12-31 06:01:03', NULL, NULL),
(11, 'user1', 'user1@mail.com', NULL, '$2y$12$tCM1qeX6cC0cbbbKLDohU.n2i.D25Be4RKPZcxxhmofrNad0zacgm', NULL, NULL, NULL, NULL, 'konsumen', '2024-12-31 06:03:44', '2024-12-31 06:03:44', NULL, NULL),
(12, 'nandito', 'dito@gmail.com', NULL, '$2y$12$QLNitFdgTib0UoCLk6RCxOEir1L4mpACp7e9K1gGBCxdxmT5Vm732', NULL, NULL, NULL, NULL, 'konsumen', '2024-12-31 06:04:19', '2024-12-31 06:04:19', NULL, NULL),
(13, 'user3', 'user3@gmail.com', NULL, '$2y$12$v/ZK/9QGw9cBG0ZxArRwY.r955ucD7Cg7al4UkRO/ZDv.dwTTNZL6', 'LFQnalU5cqYbrhH9XoglV8VIFdMg5dBgHktawx6zuOurlk4s0uuJI011YzMv', NULL, NULL, NULL, 'konsumen', '2024-12-31 06:05:14', '2025-01-03 19:50:18', NULL, 'avatars/1P70eZCE6LR1h6Efmim5Y21kvzQpKAUJZ8Fq2zZL.png'),
(14, 'dito', 'dito1@gmail.com', NULL, '$2y$12$Q.TNXNerNLgkUzquJp2dmuPci9Wxs9FZMo51kyn946iRxpzmZlIGi', NULL, NULL, NULL, NULL, 'konsumen', '2024-12-31 06:08:33', '2024-12-31 06:08:33', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `buses_plat_nomor_unique` (`plat_nomor`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `dokumentasi_kerusakans`
--
ALTER TABLE `dokumentasi_kerusakans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokumentasi_kerusakans_maintenance_id_foreign` (`maintenance_id`);

--
-- Indexes for table `exports`
--
ALTER TABLE `exports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exports_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_import_rows`
--
ALTER TABLE `failed_import_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `failed_import_rows_import_id_foreign` (`import_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `foto_dokumentasis`
--
ALTER TABLE `foto_dokumentasis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foto_dokumentasis_bus_id_foreign` (`bus_id`);

--
-- Indexes for table `imports`
--
ALTER TABLE `imports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imports_user_id_foreign` (`user_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_sewa_id_foreign` (`sewa_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_aktivitas_user_id_foreign` (`user_id`);

--
-- Indexes for table `maintenances`
--
ALTER TABLE `maintenances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maintenances_bus_id_foreign` (`bus_id`);

--
-- Indexes for table `maintenance_items`
--
ALTER TABLE `maintenance_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maintenance_items_maintenance_id_foreign` (`maintenance_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `penilaians`
--
ALTER TABLE `penilaians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penilaians_sewa_id_foreign` (`sewa_id`),
  ADD KEY `penilaians_penyewa_id_foreign` (`penyewa_id`);

--
-- Indexes for table `riwayat_sewas`
--
ALTER TABLE `riwayat_sewas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `riwayat_sewas_sewa_id_foreign` (`sewa_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sewas`
--
ALTER TABLE `sewas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sewas_id_penyewa_foreign` (`id_penyewa`),
  ADD KEY `sewas_id_bus_foreign` (`id_bus`);

--
-- Indexes for table `sewa_crews`
--
ALTER TABLE `sewa_crews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sewa_crews_sewa_id_foreign` (`sewa_id`),
  ADD KEY `sewa_crews_crew_id_foreign` (`crew_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buses`
--
ALTER TABLE `buses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dokumentasi_kerusakans`
--
ALTER TABLE `dokumentasi_kerusakans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exports`
--
ALTER TABLE `exports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_import_rows`
--
ALTER TABLE `failed_import_rows`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foto_dokumentasis`
--
ALTER TABLE `foto_dokumentasis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `imports`
--
ALTER TABLE `imports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maintenances`
--
ALTER TABLE `maintenances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maintenance_items`
--
ALTER TABLE `maintenance_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `penilaians`
--
ALTER TABLE `penilaians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `riwayat_sewas`
--
ALTER TABLE `riwayat_sewas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sewas`
--
ALTER TABLE `sewas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `sewa_crews`
--
ALTER TABLE `sewa_crews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokumentasi_kerusakans`
--
ALTER TABLE `dokumentasi_kerusakans`
  ADD CONSTRAINT `dokumentasi_kerusakans_maintenance_id_foreign` FOREIGN KEY (`maintenance_id`) REFERENCES `maintenances` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exports`
--
ALTER TABLE `exports`
  ADD CONSTRAINT `exports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `failed_import_rows`
--
ALTER TABLE `failed_import_rows`
  ADD CONSTRAINT `failed_import_rows_import_id_foreign` FOREIGN KEY (`import_id`) REFERENCES `imports` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `foto_dokumentasis`
--
ALTER TABLE `foto_dokumentasis`
  ADD CONSTRAINT `foto_dokumentasis_bus_id_foreign` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `imports`
--
ALTER TABLE `imports`
  ADD CONSTRAINT `imports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_sewa_id_foreign` FOREIGN KEY (`sewa_id`) REFERENCES `sewas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD CONSTRAINT `log_aktivitas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `maintenances`
--
ALTER TABLE `maintenances`
  ADD CONSTRAINT `maintenances_bus_id_foreign` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `maintenance_items`
--
ALTER TABLE `maintenance_items`
  ADD CONSTRAINT `maintenance_items_maintenance_id_foreign` FOREIGN KEY (`maintenance_id`) REFERENCES `maintenances` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penilaians`
--
ALTER TABLE `penilaians`
  ADD CONSTRAINT `penilaians_penyewa_id_foreign` FOREIGN KEY (`penyewa_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaians_sewa_id_foreign` FOREIGN KEY (`sewa_id`) REFERENCES `sewas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `riwayat_sewas`
--
ALTER TABLE `riwayat_sewas`
  ADD CONSTRAINT `riwayat_sewas_sewa_id_foreign` FOREIGN KEY (`sewa_id`) REFERENCES `sewas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sewas`
--
ALTER TABLE `sewas`
  ADD CONSTRAINT `sewas_id_bus_foreign` FOREIGN KEY (`id_bus`) REFERENCES `buses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sewas_id_penyewa_foreign` FOREIGN KEY (`id_penyewa`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sewa_crews`
--
ALTER TABLE `sewa_crews`
  ADD CONSTRAINT `sewa_crews_crew_id_foreign` FOREIGN KEY (`crew_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sewa_crews_sewa_id_foreign` FOREIGN KEY (`sewa_id`) REFERENCES `sewas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
