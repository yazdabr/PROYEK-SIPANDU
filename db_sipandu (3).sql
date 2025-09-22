-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 22, 2025 at 05:22 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sipandu`
--

-- --------------------------------------------------------

--
-- Table structure for table `arsip_publik`
--

CREATE TABLE `arsip_publik` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` text NOT NULL,
  `nomor_arsip` varchar(100) DEFAULT NULL,
  `kode_klasifikasi_id` int DEFAULT NULL,
  `kategori` enum('-','PPID') NOT NULL,
  `status_verifikasi` enum('pending','publik','tidak_publik') NOT NULL DEFAULT 'publik',
  `indeks` varchar(100) DEFAULT NULL,
  `uraian_informasi` text,
  `tanggal` date DEFAULT NULL,
  `tingkat_perkembangan` varchar(100) DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `satuan` enum('lembar','jilid','bundle') DEFAULT NULL,
  `unit_pengolah_id` int DEFAULT NULL,
  `ruangan` varchar(100) DEFAULT NULL,
  `no_box` varchar(50) DEFAULT NULL,
  `no_filling` varchar(50) DEFAULT NULL,
  `no_laci` varchar(50) DEFAULT NULL,
  `no_folder` varchar(50) DEFAULT NULL,
  `keterangan` text,
  `skkaad` varchar(100) DEFAULT NULL,
  `upload_dokumen` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `arsip_unit`
--

CREATE TABLE `arsip_unit` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` text NOT NULL,
  `nomor_arsip` varchar(100) DEFAULT NULL,
  `kode_klasifikasi_id` int DEFAULT NULL,
  `kategori` enum('-','PPID') NOT NULL,
  `status_verifikasi` enum('pending','publik','tidak_publik') NOT NULL DEFAULT 'pending',
  `indeks` varchar(100) DEFAULT NULL,
  `uraian_informasi` text,
  `tanggal` date DEFAULT NULL,
  `tingkat_perkembangan` varchar(100) DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `satuan` enum('lembar','jilid','bundle') DEFAULT NULL,
  `unit_pengolah_id` int DEFAULT NULL,
  `ruangan` varchar(100) DEFAULT NULL,
  `no_box` varchar(50) DEFAULT NULL,
  `no_filling` varchar(50) DEFAULT NULL,
  `no_laci` varchar(50) DEFAULT NULL,
  `no_folder` varchar(50) DEFAULT NULL,
  `keterangan` text,
  `skkaad` varchar(100) DEFAULT NULL,
  `upload_dokumen` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `arsip_unit`
--

INSERT INTO `arsip_unit` (`id`, `judul`, `nomor_arsip`, `kode_klasifikasi_id`, `kategori`, `status_verifikasi`, `indeks`, `uraian_informasi`, `tanggal`, `tingkat_perkembangan`, `jumlah`, `satuan`, `unit_pengolah_id`, `ruangan`, `no_box`, `no_filling`, `no_laci`, `no_folder`, `keterangan`, `skkaad`, `upload_dokumen`, `created_at`, `updated_at`) VALUES
(31, 'Laporan Senin', '343', 1, 'PPID', 'pending', 'Indeks', 'ssdhuisfhd', '2025-09-22', 'Fotocopy', 5, 'jilid', 1, 'kmb', '02', '3', '21', '12', 'sdssdsdsmkm', 'Rahasia', 'arsip/s5He0m6QgFas35fJe3jY0zsHrNEt2aqmQPE73LMh.pdf', '2025-09-22 05:20:50', '2025-09-22 05:20:50'),
(32, 'Laporan Senin', '343', 1, '-', 'pending', 'Indeks', 'ssdhuisfhd', '2025-09-22', 'Asli', 5, 'bundle', 1, 'kmb', '02', '3', '21', '12', 'sdssdsdsmkm', 'Terbatas', 'arsip/ffVLcoTicVyRSbi3JachAVMEm2dKryljawTtSXIp.jpg', '2025-09-22 05:22:14', '2025-09-22 05:22:14');

--
-- Triggers `arsip_unit`
--
DELIMITER $$
CREATE TRIGGER `copy_to_arsip_verifikasi` AFTER INSERT ON `arsip_unit` FOR EACH ROW BEGIN
    -- hanya copy jika kategori = 'PPID'
    IF NEW.kategori = 'PPID' THEN
        INSERT INTO arsip_verifikasi (
            judul,
            nomor_arsip,
            kode_klasifikasi_id,
            kategori,
            status_verifikasi,
            indeks,
            uraian_informasi,
            tanggal,
            tingkat_perkembangan,
            jumlah,
            satuan,
            unit_pengolah_id,
            ruangan,
            no_box,
            no_filling,
            no_laci,
            no_folder,
            keterangan,
            skkaad,
            upload_dokumen,
            created_at,
            updated_at
        ) VALUES (
            NEW.judul,
            NEW.nomor_arsip,
            NEW.kode_klasifikasi_id,
            NEW.kategori,
            NEW.status_verifikasi,
            NEW.indeks,
            NEW.uraian_informasi,
            NEW.tanggal,
            NEW.tingkat_perkembangan,
            NEW.jumlah,
            NEW.satuan,
            NEW.unit_pengolah_id,
            NEW.ruangan,
            NEW.no_box,
            NEW.no_filling,
            NEW.no_laci,
            NEW.no_folder,
            NEW.keterangan,
            NEW.skkaad,
            NEW.upload_dokumen,
            NEW.created_at,
            NEW.updated_at
        );
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `arsip_verifikasi`
--

CREATE TABLE `arsip_verifikasi` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` text NOT NULL,
  `nomor_arsip` varchar(100) DEFAULT NULL,
  `kode_klasifikasi_id` int DEFAULT NULL,
  `kategori` enum('-','PPID') NOT NULL,
  `status_verifikasi` enum('pending','publik','tidak_publik') NOT NULL DEFAULT 'pending',
  `indeks` varchar(100) DEFAULT NULL,
  `uraian_informasi` text,
  `tanggal` date DEFAULT NULL,
  `tingkat_perkembangan` varchar(100) DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `satuan` enum('lembar','jilid','bundle') DEFAULT NULL,
  `unit_pengolah_id` int DEFAULT NULL,
  `ruangan` varchar(100) DEFAULT NULL,
  `no_box` varchar(50) DEFAULT NULL,
  `no_filling` varchar(50) DEFAULT NULL,
  `no_laci` varchar(50) DEFAULT NULL,
  `no_folder` varchar(50) DEFAULT NULL,
  `keterangan` text,
  `skkaad` varchar(100) DEFAULT NULL,
  `upload_dokumen` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Table structure for table `kodeklasifikasi`
--

CREATE TABLE `kodeklasifikasi` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kodeklasifikasi`
--

INSERT INTO `kodeklasifikasi` (`id`, `kode`, `created_at`, `updated_at`) VALUES
(1, 'PR', NULL, NULL),
(2, 'PW', NULL, NULL),
(3, 'UM', NULL, NULL),
(4, 'KP', NULL, NULL),
(5, 'KU', NULL, NULL),
(6, 'PL', NULL, NULL),
(7, 'HK', NULL, NULL),
(8, 'OT', NULL, NULL),
(9, 'KS', NULL, NULL),
(10, 'HM', NULL, NULL),
(11, 'PB', NULL, NULL),
(12, 'DT', NULL, NULL),
(13, 'LT', NULL, NULL),
(14, 'STO', NULL, NULL),
(15, 'TX', NULL, NULL),
(16, 'IT', NULL, NULL),
(17, 'PPS', NULL, NULL),
(18, 'PPP', NULL, NULL),
(19, 'KJM', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kode_klasifikasi`
--

CREATE TABLE `kode_klasifikasi` (
  `id` int UNSIGNED NOT NULL,
  `kode` varchar(20) NOT NULL,
  `uraian` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kode_klasifikasi`
--

INSERT INTO `kode_klasifikasi` (`id`, `kode`, `uraian`) VALUES
(1, 'PR', 'Program dan Evaluasi'),
(2, 'PR.01', 'Rencana dan Program'),
(3, 'PR.02', 'Pelaporan'),
(4, 'PR.03', 'Evaluasi'),
(5, 'PW', 'Pengawasan'),
(6, 'PW.01', 'Hasil Pengawasan/LHKPN/Gratifikasi');

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
(4, '2025_09_18_011149_create_kodeklasifikasi_table', 1),
(6, '2025_09_19_183548_create_users_table', 2),
(7, '2025_09_22_024017_add_is_publik_to_arsip_publik_table', 3),
(8, '2025_09_22_030710_add_status_verifikasi_to_arsip_unit_table', 4),
(9, '2025_09_22_032634_create_arsip_verifikasi_table', 5);

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
('KURn150aFjBohw6OfarQleucZfeKN991LHP8Gcex', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWTQ0M0RWRFFpQmJDaWJDa0VBR0xUM3BpMUFPMFZ3bGpPSnowV2ZyUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC92ZXJpZmlrYXNpIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758518541);

-- --------------------------------------------------------

--
-- Table structure for table `unit_pengolah`
--

CREATE TABLE `unit_pengolah` (
  `id` int NOT NULL,
  `nama_unit` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `unit_pengolah`
--

INSERT INTO `unit_pengolah` (`id`, `nama_unit`) VALUES
(1, 'TMB'),
(2, 'SIARAN'),
(3, 'KMB'),
(4, 'LPU'),
(5, 'TATA USAHA KEUANGAN'),
(6, 'TATA USAHA UMUM'),
(7, 'TATA USAHA SDM');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arsip_publik`
--
ALTER TABLE `arsip_publik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arsip_unit`
--
ALTER TABLE `arsip_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arsip_verifikasi`
--
ALTER TABLE `arsip_verifikasi`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `kodeklasifikasi`
--
ALTER TABLE `kodeklasifikasi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kodeklasifikasi_kode_unique` (`kode`);

--
-- Indexes for table `kode_klasifikasi`
--
ALTER TABLE `kode_klasifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `unit_pengolah`
--
ALTER TABLE `unit_pengolah`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `arsip_publik`
--
ALTER TABLE `arsip_publik`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `arsip_unit`
--
ALTER TABLE `arsip_unit`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `arsip_verifikasi`
--
ALTER TABLE `arsip_verifikasi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kodeklasifikasi`
--
ALTER TABLE `kodeklasifikasi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kode_klasifikasi`
--
ALTER TABLE `kode_klasifikasi`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `unit_pengolah`
--
ALTER TABLE `unit_pengolah`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
