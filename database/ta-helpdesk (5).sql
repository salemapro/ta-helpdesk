-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2024 at 05:43 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta-helpdesk`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `id_application` int(11) NOT NULL,
  `application` varchar(100) NOT NULL,
  `company_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id_application`, `application`, `company_id`, `created_at`, `updated_at`) VALUES
(1, 'Sistem Informasi Pengelolaan Keuangan Daerah (SIPKD)', 6, '2024-07-24 15:56:03', ''),
(2, 'Sistem Keuangan Bisnis dan Pemerintahan Daerah (BLUD)', 4, '2024-07-24 15:57:18', ''),
(3, 'Sistem Pembayaran BINAPAY', 3, '2024-07-24 15:57:45', ''),
(4, 'Sistem Informasi Eksekutif (SIE)', 5, '2024-07-24 15:58:10', ''),
(5, 'Sistem Pencarian Tagihan Kwetansi BasTracker', 2, '2024-07-24 15:59:51', ''),
(6, 'Sistem Informasi Pengelolaan Aset Daerah (BMD)', 7, '2024-07-24 16:01:35', '');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id_company` int(11) NOT NULL,
  `company` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id_company`, `company`, `created_at`, `updated_at`) VALUES
(1, 'CV Insaba Pratista Agya', '2024-05-29 12:16:41', ''),
(2, 'RSUD Kabupaten Subang', '2024-05-29 14:13:57', ''),
(3, 'Bank BJB', '2024-06-08 02:22:23', ''),
(4, 'Pemerintah Daerah Kab. Subang', '2024-07-14 06:15:42', ''),
(5, 'Pemerintah Daerah Kab. Sumedang', '2024-07-24 15:53:40', ''),
(6, 'Pemerintah Daerah Kab. Ciamis', '2024-07-24 15:54:30', ''),
(7, 'Pemerintah Daerah Kab. Pangandaran', '2024-07-24 16:00:55', '');

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `divisi` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `divisi`, `created_at`, `updated_at`) VALUES
(1, 'Call Center', '2024-05-29 12:30:29', '2024-06-12'),
(2, 'Developer', '2024-05-29 14:32:46', '2024-05-29'),
(3, 'Konsultan IT', '2024-05-29 14:32:57', '2024-05-29');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id_notification` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `notification` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id_notification`, `ticket_id`, `notification`, `created_at`) VALUES
(28, 1, 'New Ticket from Rizky Khatami', '2024-07-30 13:43:53'),
(29, 1, 'Your Ticket on Process', '2024-07-30 13:44:20'),
(30, 1, 'New Comment from Ryan Pribowo', '2024-07-30 13:44:38'),
(31, 1, 'New Comment from Rizky Khatami', '2024-07-30 13:45:41'),
(32, 1, 'New Comment from Ryan Pribowo', '2024-07-30 13:46:16'),
(33, 1, 'New Comment from Rizky Khatami', '2024-07-30 13:46:40'),
(34, 2, 'New Ticket from Hamda Sakhia', '2024-07-30 13:55:50'),
(35, 2, 'Your Ticket on Process', '2024-07-31 02:32:07'),
(36, 2, 'New Comment from Hamda Sakhia', '2024-07-31 02:34:20'),
(37, 2, 'New Comment from Hamda Sakhia', '2024-07-31 03:11:33'),
(38, 2, 'New Comment from Hamda Sakhia', '2024-07-31 03:16:41'),
(39, 2, 'New Comment from Hamda Sakhia', '2024-07-31 03:18:36'),
(40, 2, 'New Comment from Hamda Sakhia', '2024-07-31 03:30:06');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id_subject` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `divisi_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id_subject`, `subject`, `divisi_id`, `created_at`, `updated_at`) VALUES
(1, 'Lainnya...', 1, '2024-07-24 15:29:05', '2024-07-24'),
(2, 'Tidak bisa login ke aplikasi', 1, '2024-07-24 15:29:24', '2024-07-24'),
(3, 'Lupa password akses', 1, '2024-07-24 15:29:42', '2024-07-24'),
(4, 'Modul pembayaran tidak berfungsi', 1, '2024-07-24 15:29:59', '2024-07-24'),
(5, 'Halaman utama tidak dapat dimuat', 1, '2024-07-24 15:30:20', '2024-07-24'),
(6, 'Gangguan koneksi internet', 1, '2024-07-24 15:30:37', '2024-07-24'),
(7, 'Error saat mengirim email', 1, '2024-07-24 15:30:55', '2024-07-24'),
(8, 'Perangkat tidak terdeteksi di jaringan', 1, '2024-07-24 15:31:17', '2024-07-24'),
(9, 'Aplikasi tidak merespons', 1, '2024-07-24 15:31:39', '2024-07-24'),
(10, 'Kesalahan dalam pengisian data', 3, '2024-07-24 15:32:07', '2024-07-24'),
(11, 'Kesulitan mengoperasikan fitur pencarian', 3, '2024-07-24 15:33:31', '2024-07-24'),
(12, 'Instruksi pengguna tidak jelas', 3, '2024-07-24 15:34:00', '2024-07-24'),
(13, 'Proses verifikasi data bermasalah', 3, '2024-07-24 15:34:17', '2024-07-24'),
(14, 'Laporan hasil tidak sesuai', 3, '2024-07-24 15:34:30', '2024-07-24'),
(15, 'Konsistensi data tidak terjaga', 3, '2024-07-24 15:34:51', '2024-07-24'),
(16, 'Permintaan bantuan untuk laporan data', 3, '2024-07-24 15:35:14', '2024-07-24'),
(17, 'Permasalahan integrasi sistem', 3, '2024-07-24 15:35:30', '2024-07-24'),
(18, 'Aplikasi mengalami crash', 2, '2024-07-24 15:35:47', '2024-07-24'),
(19, 'Bug pada fitur pencarian', 2, '2024-07-24 15:36:03', '2024-07-24'),
(20, 'Error saat update data', 2, '2024-07-24 15:36:18', '2024-07-24'),
(21, 'Perubahan alur kerja tidak berjalan dengan baik', 2, '2024-07-24 15:36:41', '2024-07-24'),
(22, 'Masalah performa aplikasi', 2, '2024-07-24 15:36:59', '2024-07-24'),
(23, 'Fitur baru tidak berfungsi sebagaimana mestinya', 2, '2024-07-24 15:37:23', '2024-07-24'),
(24, 'Tampilan aplikasi tidak konsisten', 2, '2024-07-24 15:37:44', '2024-07-24'),
(25, 'Kesalahan saat menyimpan data', 2, '2024-07-24 15:38:02', '2024-07-24');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id_ticket` int(11) NOT NULL,
  `no_ticket` varchar(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `img_ticket` text NOT NULL,
  `sender_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `divisi_id` int(11) NOT NULL,
  `status_ticket` int(11) NOT NULL,
  `solved_by` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `solved_at` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id_ticket`, `no_ticket`, `subject_id`, `subject`, `message`, `img_ticket`, `sender_id`, `company_id`, `app_id`, `divisi_id`, `status_ticket`, `solved_by`, `created_at`, `solved_at`) VALUES
(1, 'T3007240001', 19, 'Bug pada fitur pencarian', 'kak saya tidak bisa menggunakan fitur pencarian kenapa yaa', '2f05bf6138554f579d093fdeb36b8836.png', 14, 2, 5, 2, 2, 'Ryan Pribowo', '2024-07-30 13:43:53', '2024-07-30');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_detail`
--

CREATE TABLE `ticket_detail` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_detail`
--

INSERT INTO `ticket_detail` (`id`, `ticket_id`, `user_id`, `comment`, `date`) VALUES
(1, 1, 8, 'okee bentar kak', '2024-07-30 13:44:38'),
(2, 1, 14, 'siap', '2024-07-30 13:45:41'),
(3, 1, 8, 'di coba lagi kak', '2024-07-30 13:46:16'),
(4, 1, 14, 'udah bisa kak makasih', '2024-07-30 13:46:40');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `code_user` varchar(6) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `company_id` int(11) NOT NULL,
  `divisi_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `code_user`, `email`, `password`, `fullname`, `company_id`, `divisi_id`, `role_id`, `status`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 'USR001', 'ssayyidah18@gmail.com', '123', 'Salma Sayyidah', 1, 1, 1, 1, '/dist/img/avatar/avatar_1.jpg', '2024-05-29 12:02:56', '2024-07-24'),
(8, 'USR002', 'ryan@gmail.com', '1234', 'Ryan Pribowoo', 1, 2, 2, 1, '/dist/img/avatar/avatar_8.jpg', '2024-07-24 15:39:42', '2024-07-24'),
(9, 'USR003', 'mulki@gmail.com', '1234', 'Mulki Mantasya', 1, 2, 2, 1, '/dist/img/avatar4.png', '2024-07-24 15:40:32', '2024-07-24'),
(10, 'USR004', 'dida@gmail.com', '1234', 'Dida Kusdiana', 1, 3, 2, 1, '/dist/img/avatar4.png', '2024-07-24 15:41:11', '2024-07-24'),
(11, 'USR005', 'arie@gmail.com', '1234', 'Arie Afriadi', 1, 3, 2, 1, '/dist/img/avatar4.png', '2024-07-24 15:42:18', '2024-07-30'),
(12, 'USR006', 'irfan@gmail.com', '1234', 'Irfan Miftahul Khoir', 1, 1, 2, 1, '/dist/img/avatar4.png', '2024-07-24 15:44:40', '2024-07-24'),
(13, 'USR007', 'irham@gmail.com', '1234', 'Irham', 1, 1, 2, 1, '/dist/img/avatar4.png', '2024-07-30 13:37:35', '2024-07-30'),
(14, 'USR008', 'rizky@gmail.com', '1234', 'Rizky Khatami', 2, 0, 3, 1, '/dist/img/avatar/avatar_14.png', '2024-07-30 13:38:22', '2024-07-30'),
(15, 'USR009', 'hamda@gmail.com', '1234', 'Hamda Sakhia', 4, 0, 3, 1, '/dist/img/avatar5.png', '2024-07-30 13:54:16', '2024-07-30');

-- --------------------------------------------------------

--
-- Table structure for table `user_notification`
--

CREATE TABLE `user_notification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `notification_id` int(11) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_notification`
--

INSERT INTO `user_notification` (`id`, `user_id`, `notification_id`, `is_read`) VALUES
(1, 8, 28, 1),
(2, 9, 28, 0),
(3, 14, 29, 1),
(4, 14, 30, 1),
(5, 8, 31, 1),
(6, 9, 31, 0),
(7, 14, 32, 1),
(8, 8, 33, 1),
(9, 9, 33, 0),
(10, 1, 34, 1),
(11, 12, 34, 0),
(12, 13, 34, 0),
(13, 15, 35, 1),
(14, 1, 36, 1),
(15, 12, 36, 0),
(16, 13, 36, 0),
(17, 1, 37, 1),
(18, 12, 37, 0),
(19, 13, 37, 0),
(20, 1, 38, 1),
(21, 12, 38, 0),
(22, 13, 38, 0),
(23, 1, 39, 1),
(24, 12, 39, 0),
(25, 13, 39, 0),
(26, 1, 40, 1),
(27, 12, 40, 0),
(28, 13, 40, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id_role`, `role`, `created_at`) VALUES
(1, 'Admin', '2024-05-29 16:53:24'),
(2, 'Agent', '2024-05-29 16:53:24'),
(3, 'Client', '2024-05-29 16:53:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id_application`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id_company`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id_notification`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id_subject`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id_ticket`);

--
-- Indexes for table `ticket_detail`
--
ALTER TABLE `ticket_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_notification`
--
ALTER TABLE `user_notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `notification_id` (`notification_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `id_application` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id_company` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id_notification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id_subject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ticket_detail`
--
ALTER TABLE `ticket_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_notification`
--
ALTER TABLE `user_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_notification`
--
ALTER TABLE `user_notification`
  ADD CONSTRAINT `user_notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `user_notification_ibfk_2` FOREIGN KEY (`notification_id`) REFERENCES `notification` (`id_notification`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
