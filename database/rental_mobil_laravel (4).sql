-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2025 at 10:40 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_mobil_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `armada`
--

CREATE TABLE `armada` (
  `id` int(11) NOT NULL,
  `merk` varchar(30) DEFAULT NULL,
  `nopol` varchar(20) DEFAULT NULL,
  `thn_beli` int(11) DEFAULT NULL,
  `deskripsi` varchar(200) DEFAULT NULL,
  `jenis_kendaraan_id` int(11) DEFAULT NULL,
  `kapasitas_kursi` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `gambar` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `armada`
--

INSERT INTO `armada` (`id`, `merk`, `nopol`, `thn_beli`, `deskripsi`, `jenis_kendaraan_id`, `kapasitas_kursi`, `rating`, `harga`, `gambar`) VALUES
(1, 'Tesla Model S', 'B 1234 EV', 2023, 'Electric • Auto • Range 300 mi', 1, 5, 5, 5000000, 'f2OX8pYQnhSqmeG5uM5bIqTXEEkkQOa4PgrZXd8k.jpg'),
(2, 'Toyota Prius', 'B 5678 HB', 2022, 'Hybrid • Auto • MPG 54', 2, 5, 5, 1200000, 'gbNB3jX5BzHCfNRdxZ5jW8LC3DN8KXCYtI5YyQhK.jpg'),
(3, 'Porsche 911', 'B 911 SP', 2023, 'Gas • Manual • 0-60 in 3.2s', 3, 2, 5, 2000000, 'Mfkz1Nzws360awqrC3xEQhSqHEhnR8z6Gb1ozW4G.jpg'),
(4, 'Mercedes-Benz GLC', 'B 4321 MB', 2022, 'Gas • Auto • Luxury SUV', 4, 5, 4, 3000000, 'kUzdn02hqXUbHmEICo13wZejY5EQ369uiN7EAVHi.jpg'),
(5, 'BMW i4', 'B 8765 BM', 2023, 'Electric • Auto • Range 270 mi', 1, 5, 4, 4000000, 'zos0OOdPbk0STmc2AMwSPauRa9H3DUMNfZBlBkHC.jpg'),
(6, 'Honda Civic', 'B 2468 HC', 2021, 'Gas • Auto • MPG 36', 2, 5, 4, 1000000, '1749352600_A9BpKU.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kendaraan`
--

CREATE TABLE `jenis_kendaraan` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_kendaraan`
--

INSERT INTO `jenis_kendaraan` (`id`, `nama`) VALUES
(1, 'Premium'),
(2, 'Eco'),
(3, 'Sport'),
(4, 'SUV'),
(7, 'test updated');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `koordinat` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id`, `nama`, `alamat`, `koordinat`, `image`) VALUES
(1, 'Jakarta Pusat, Kemayoran', 'RW.6, Gn. Sahari Sel, Kec. Kemayoran, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta', '-6.158013, 106.850549', 'f790u7FFX8vW5G1g52wm.png'),
(2, 'Depok, Cimanggis', 'Jl. Cimanggis Boulevard, Tapos, Kec. Tapos, Kota Depok, Jawa Barat 16457', '-6.42156327862143, 106.89212612344899', 'JBsjocIZKP20CG8SxkPs.png'),
(3, 'Bogor, Cibanteng', 'Jl. Kapten Muslihat No.17 A, RT.04/RW.06, Pabaton, Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat 16121', '-6.594472597007156, 106.79167679574043', '4JbUYvY17D9YPE6uy5ZP.png'),
(4, 'Bekasi, Tambun', 'P29M+JRJ, Lambangsari, Kec. Bekasi Bar., Kota Bks, Jawa Barat', '-6.278129, 107.033101', 'C30r27VSgE8kG89vyEsN.png');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_30_115120_add_profile_fields_to_users_table', 2),
(5, '2025_05_30_115130_add_profile_fields_to_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('raffayudapratama20@gmail.com', '$2y$12$5RYkU0Knp7negoGKwni45.HHE5Emi2rdJMOxHxWsVcFKu35wcyZku', '2025-05-23 04:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jumlah_bayar` double DEFAULT NULL,
  `peminjaman_id` int(11) NOT NULL,
  `status_pembayaran` varchar(20) DEFAULT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `tanggal`, `jumlah_bayar`, `peminjaman_id`, `status_pembayaran`, `metode_pembayaran`, `keterangan`, `created_by`, `created_at`, `updated_at`) VALUES
(9, '2025-06-08', 6000000, 39, 'Lunas', 'Transfer', 'test aja', 2, '2025-06-07 20:23:51', '2025-06-07 20:32:42'),
(10, '2025-06-18', 10000000, 40, 'Lunas', 'QRIS', NULL, 2, '2025-06-17 22:01:43', '2025-06-17 22:01:43');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `nama_peminjam` varchar(45) NOT NULL,
  `ktp_peminjam` varchar(255) NOT NULL,
  `keperluan_pinjam` varchar(100) DEFAULT NULL,
  `mulai` date NOT NULL,
  `selesai` date NOT NULL,
  `biaya` double NOT NULL,
  `armada_id` int(11) NOT NULL,
  `komentar_peminjam` varchar(100) DEFAULT NULL,
  `status_pinjam` varchar(20) NOT NULL,
  `pengembalian_id` int(11) DEFAULT NULL,
  `pengambilan_id` int(11) DEFAULT NULL,
  `waktu_pengambilan` time DEFAULT NULL,
  `waktu_pengembalian` time DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `nama_peminjam`, `ktp_peminjam`, `keperluan_pinjam`, `mulai`, `selesai`, `biaya`, `armada_id`, `komentar_peminjam`, `status_pinjam`, `pengembalian_id`, `pengambilan_id`, `waktu_pengambilan`, `waktu_pengembalian`, `phone`, `user_id`, `created_at`, `updated_at`) VALUES
(37, 'Sipa', '1749351014_P9jYw1.jpg', 'Balap', '2025-06-08', '2025-06-10', 8000000, 5, NULL, 'Dibatalkan', 2, 1, '09:53:00', '12:48:00', '0121374', 2, '2025-06-07 19:50:14', '2025-06-07 20:22:29'),
(39, 'test', '1749352692_fQ5VvU.png', 'test', '2025-06-08', '2025-06-13', 6000000, 2, NULL, 'Selesai', 3, 1, '10:15:00', '12:11:00', '08889623663', 2, '2025-06-07 20:11:59', '2025-06-07 20:19:32'),
(40, 'hiuhsi', '1750222798_tOtNyO.png', 'Ngopi', '2025-06-18', '2025-06-20', 10000000, 1, NULL, 'Dipinjam', 2, 1, '13:59:00', '11:00:00', '07987126781', 3, '2025-06-17 21:59:58', '2025-06-17 22:01:07');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `nama`) VALUES
(3, 'admin'),
(4, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5eHKPWEMGeYGNcyMkRhbLV7vk5HUFuBHUEiHum5X', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicEY2TzBJb0hsemozbDFmVk9yZXk4NVByd3F0TDhab29qdGxGWmpmbCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZW1iYXlhcmFuIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1750222904),
('h10Jn2LwsguX6640y38LsvuWvLTYCxhABnQ4GVoo', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNVJjaTZPeXdJeE5KcVh5ckFyQ0FnUmY4Z1BBT0xUUUMwWXVSSjdwUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9teWJvb2tpbmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1750222908),
('IuSGYpK4VDWZ4EPvwLLLXGrqZsh1WV4b2emjWtCl', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibVY4VFRFcGpId2gwdGJtMnZ2NkxRZ3RPeUJqczZIOWlEbXhsSFFaVSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1750215506),
('Uh05WzZIHKPUlnhS83rVQwonoNbgD5mjH8tvjG0P', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib3dqYXdXQzlPNzczb2Y4dE9PQnR5NXNMa2xVSllkak9JY21pWnM0TCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1749958518),
('xkEnnWigmBgIUG19uy2kgl6CxVjXjLN1x4fDCzsY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT0p2TVVuVXV1QWM0TzVsRmUyZUY1Nnl3dFczSDFlN1pVRm9XR3RlNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750235910);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_user_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `avatar`, `email_verified_at`, `password`, `role_user_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Raffa Yuda Pratama', 'raffayudapratama20@gmail.com', '08889623663', 'Bogor test bro', '1748607531_WhatsApp Image 2025-05-13 at 09.18.01_f832da21.jpg', NULL, '$2y$12$31K9fz9PZqnTo3HtWiNH2OTAdhLOS57qFrmzG/wIpkDCOnOf5uNTq', 3, NULL, NULL, '2025-06-07 04:30:28'),
(3, 'user', 'user@gmail.com', '0889623663', 'bogor', 'test.png', NULL, '$2y$12$6hO3YHHYRU1VCFUHoZgeveGPqugbg9pqQ/mhNqgTW5xHYa/sSLz5i', 4, NULL, NULL, '2025-06-17 21:58:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `armada`
--
ALTER TABLE `armada`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_kendaraan_id` (`jenis_kendaraan_id`);

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
-- Indexes for table `jenis_kendaraan`
--
ALTER TABLE `jenis_kendaraan`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
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
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pembayaran_peminjaman` (`peminjaman_id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_peminjaman_armada` (`armada_id`),
  ADD KEY `role_user_id` (`user_id`),
  ADD KEY `pengembalian_id` (`pengembalian_id`),
  ADD KEY `pengambilan_id` (`pengambilan_id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `role_user_id` (`role_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `armada`
--
ALTER TABLE `armada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_kendaraan`
--
ALTER TABLE `jenis_kendaraan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `armada`
--
ALTER TABLE `armada`
  ADD CONSTRAINT `armada_ibfk_1` FOREIGN KEY (`jenis_kendaraan_id`) REFERENCES `jenis_kendaraan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_pembayaran_peminjaman` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`armada_id`) REFERENCES `armada` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_3` FOREIGN KEY (`pengambilan_id`) REFERENCES `lokasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_6` FOREIGN KEY (`pengembalian_id`) REFERENCES `lokasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_user_id`) REFERENCES `role_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
