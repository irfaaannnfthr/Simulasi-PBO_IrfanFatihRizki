-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 21, 2026 at 10:20 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simulasi_pbo_trpl1a_irfanfatihrizki`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pendaftaran`
--

CREATE TABLE `tabel_pendaftaran` (
  `id_pendaftaran` int NOT NULL,
  `nama_calon` varchar(100) NOT NULL,
  `asal_sekolah` varchar(100) NOT NULL,
  `nilai_ujian` decimal(5,2) NOT NULL,
  `biaya_pendaftaran_dasar` decimal(10,2) NOT NULL,
  `jalur_pendaftaran` enum('Reguler','Prestasi','Kedinasan') NOT NULL,
  `pilihan_prodi` varchar(100) DEFAULT NULL,
  `lokasi_kampus` varchar(100) DEFAULT NULL,
  `jenis_prestasi` varchar(100) DEFAULT NULL,
  `tingkat_prestasi` varchar(50) DEFAULT NULL,
  `sk_ikatan_dinas` varchar(100) DEFAULT NULL,
  `instansi_sponsor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_pendaftaran`
--

INSERT INTO `tabel_pendaftaran` (`id_pendaftaran`, `nama_calon`, `asal_sekolah`, `nilai_ujian`, `biaya_pendaftaran_dasar`, `jalur_pendaftaran`, `pilihan_prodi`, `lokasi_kampus`, `jenis_prestasi`, `tingkat_prestasi`, `sk_ikatan_dinas`, `instansi_sponsor`) VALUES
(1, 'Andi Saputra', 'SMA N 1 Cilacap', '82.50', '300000.00', 'Reguler', 'Teknik Informatika', 'Kampus A', NULL, NULL, NULL, NULL),
(2, 'Budi Santoso', 'SMA N 2 Purwokerto', '78.00', '300000.00', 'Reguler', 'Sistem Informasi', 'Kampus B', NULL, NULL, NULL, NULL),
(3, 'Citra Dewi', 'SMK N 1 Cilacap', '80.75', '300000.00', 'Reguler', 'Manajemen', 'Kampus A', NULL, NULL, NULL, NULL),
(4, 'Dina Rahayu', 'SMA N 3 Banyumas', '76.25', '300000.00', 'Reguler', 'Akuntansi', 'Kampus B', NULL, NULL, NULL, NULL),
(5, 'Eko Prasetyo', 'SMA N 1 Purbalingga', '85.00', '300000.00', 'Reguler', 'Teknik Sipil', 'Kampus A', NULL, NULL, NULL, NULL),
(6, 'Fajar Nugroho', 'SMA N 4 Cilacap', '79.50', '300000.00', 'Reguler', 'Hukum', 'Kampus C', NULL, NULL, NULL, NULL),
(7, 'Galuh Pramesti', 'SMA N 2 Cilacap', '83.00', '300000.00', 'Reguler', 'Psikologi', 'Kampus B', NULL, NULL, NULL, NULL),
(8, 'Hana Pertiwi', 'SMA N 1 Kebumen', '90.00', '250000.00', 'Prestasi', 'Teknik Informatika', 'Kampus A', 'Olimpiade Sains', 'Nasional', NULL, NULL),
(9, 'Irfan Maulana', 'SMA N 2 Kebumen', '88.50', '250000.00', 'Prestasi', 'Kedokteran', 'Kampus B', 'Olimpiade Biologi', 'Provinsi', NULL, NULL),
(10, 'Jasmine Aulia', 'SMA N 1 Magelang', '92.00', '250000.00', 'Prestasi', 'Farmasi', 'Kampus A', 'Lomba KIR', 'Nasional', NULL, NULL),
(11, 'Kevin Ardian', 'SMA N 3 Magelang', '87.75', '250000.00', 'Prestasi', 'Teknik Elektro', 'Kampus C', 'Olimpiade Fisika', 'Provinsi', NULL, NULL),
(12, 'Laila Sari', 'SMA N 1 Wonosobo', '91.50', '250000.00', 'Prestasi', 'Matematika', 'Kampus A', 'Olimpiade MTK', 'Nasional', NULL, NULL),
(13, 'Muhammad Rizki', 'SMA N 2 Wonosobo', '89.00', '250000.00', 'Prestasi', 'Fisika', 'Kampus B', 'Olimpiade Fisika', 'Nasional', NULL, NULL),
(14, 'Nadia Kusuma', 'SMA N 1 Temanggung', '86.00', '250000.00', 'Prestasi', 'Sistem Informasi', 'Kampus C', 'Lomba Debat', 'Provinsi', NULL, NULL),
(15, 'Oki Firmansyah', 'SMA N 1 Purworejo', '88.00', '200000.00', 'Kedinasan', 'Ilmu Pemerintahan', 'Kampus A', NULL, NULL, 'SK-001/2024', 'Pemkab Purworejo'),
(16, 'Putri Anggraini', 'SMA N 2 Purworejo', '85.50', '200000.00', 'Kedinasan', 'Administrasi Negara', 'Kampus B', NULL, NULL, 'SK-002/2024', 'Pemkab Cilacap'),
(17, 'Qori Habibie', 'SMA N 1 Gombong', '87.25', '200000.00', 'Kedinasan', 'Teknik Sipil', 'Kampus A', NULL, NULL, 'SK-003/2024', 'Dinas PU Jateng'),
(18, 'Rizal Hakim', 'SMA N 2 Gombong', '83.75', '200000.00', 'Kedinasan', 'Ilmu Hukum', 'Kampus C', NULL, NULL, 'SK-004/2024', 'Kejaksaan Jateng'),
(19, 'Siti Nurhaliza', 'SMA N 1 Kroya', '86.50', '200000.00', 'Kedinasan', 'Manajemen', 'Kampus B', NULL, NULL, 'SK-005/2024', 'BUMN Jateng'),
(20, 'Taufik Hidayat', 'SMA N 2 Kroya', '84.00', '200000.00', 'Kedinasan', 'Teknik Informatika', 'Kampus A', NULL, NULL, 'SK-006/2024', 'Kominfo Jateng'),
(21, 'Andi Saputra', 'SMA N 1 Cilacap', '82.50', '300000.00', 'Reguler', 'Teknik Informatika', 'Kampus A', NULL, NULL, NULL, NULL),
(22, 'Budi Santoso', 'SMA N 2 Purwokerto', '78.00', '300000.00', 'Reguler', 'Sistem Informasi', 'Kampus B', NULL, NULL, NULL, NULL),
(23, 'Citra Dewi', 'SMK N 1 Cilacap', '80.75', '300000.00', 'Reguler', 'Manajemen', 'Kampus A', NULL, NULL, NULL, NULL),
(24, 'Dina Rahayu', 'SMA N 3 Banyumas', '76.25', '300000.00', 'Reguler', 'Akuntansi', 'Kampus B', NULL, NULL, NULL, NULL),
(25, 'Eko Prasetyo', 'SMA N 1 Purbalingga', '85.00', '300000.00', 'Reguler', 'Teknik Sipil', 'Kampus A', NULL, NULL, NULL, NULL),
(26, 'Fajar Nugroho', 'SMA N 4 Cilacap', '79.50', '300000.00', 'Reguler', 'Hukum', 'Kampus C', NULL, NULL, NULL, NULL),
(27, 'Galuh Pramesti', 'SMA N 2 Cilacap', '83.00', '300000.00', 'Reguler', 'Psikologi', 'Kampus B', NULL, NULL, NULL, NULL),
(28, 'Hana Pertiwi', 'SMA N 1 Kebumen', '90.00', '250000.00', 'Prestasi', 'Teknik Informatika', 'Kampus A', 'Olimpiade Sains', 'Nasional', NULL, NULL),
(29, 'Irfan Maulana', 'SMA N 2 Kebumen', '88.50', '250000.00', 'Prestasi', 'Kedokteran', 'Kampus B', 'Olimpiade Biologi', 'Provinsi', NULL, NULL),
(30, 'Jasmine Aulia', 'SMA N 1 Magelang', '92.00', '250000.00', 'Prestasi', 'Farmasi', 'Kampus A', 'Lomba KIR', 'Nasional', NULL, NULL),
(31, 'Kevin Ardian', 'SMA N 3 Magelang', '87.75', '250000.00', 'Prestasi', 'Teknik Elektro', 'Kampus C', 'Olimpiade Fisika', 'Provinsi', NULL, NULL),
(32, 'Laila Sari', 'SMA N 1 Wonosobo', '91.50', '250000.00', 'Prestasi', 'Matematika', 'Kampus A', 'Olimpiade MTK', 'Nasional', NULL, NULL),
(33, 'Muhammad Rizki', 'SMA N 2 Wonosobo', '89.00', '250000.00', 'Prestasi', 'Fisika', 'Kampus B', 'Olimpiade Fisika', 'Nasional', NULL, NULL),
(34, 'Nadia Kusuma', 'SMA N 1 Temanggung', '86.00', '250000.00', 'Prestasi', 'Sistem Informasi', 'Kampus C', 'Lomba Debat', 'Provinsi', NULL, NULL),
(35, 'Oki Firmansyah', 'SMA N 1 Purworejo', '88.00', '200000.00', 'Kedinasan', 'Ilmu Pemerintahan', 'Kampus A', NULL, NULL, 'SK-001/2024', 'Pemkab Purworejo'),
(36, 'Putri Anggraini', 'SMA N 2 Purworejo', '85.50', '200000.00', 'Kedinasan', 'Administrasi Negara', 'Kampus B', NULL, NULL, 'SK-002/2024', 'Pemkab Cilacap'),
(37, 'Qori Habibie', 'SMA N 1 Gombong', '87.25', '200000.00', 'Kedinasan', 'Teknik Sipil', 'Kampus A', NULL, NULL, 'SK-003/2024', 'Dinas PU Jateng'),
(38, 'Rizal Hakim', 'SMA N 2 Gombong', '83.75', '200000.00', 'Kedinasan', 'Ilmu Hukum', 'Kampus C', NULL, NULL, 'SK-004/2024', 'Kejaksaan Jateng'),
(39, 'Siti Nurhaliza', 'SMA N 1 Kroya', '86.50', '200000.00', 'Kedinasan', 'Manajemen', 'Kampus B', NULL, NULL, 'SK-005/2024', 'BUMN Jateng'),
(40, 'Taufik Hidayat', 'SMA N 2 Kroya', '84.00', '200000.00', 'Kedinasan', 'Teknik Informatika', 'Kampus A', NULL, NULL, 'SK-006/2024', 'Kominfo Jateng');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_pendaftaran`
--
ALTER TABLE `tabel_pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_pendaftaran`
--
ALTER TABLE `tabel_pendaftaran`
  MODIFY `id_pendaftaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
