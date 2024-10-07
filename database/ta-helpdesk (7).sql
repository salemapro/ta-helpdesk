-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2024 at 12:35 PM
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
(6, 'Sistem Informasi Pengelolaan Aset Daerah (BMD)', 7, '2024-07-24 16:01:35', ''),
(7, 'siakad', 8, '2024-08-06 01:27:58', '');

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
(7, 'Pemerintah Daerah Kab. Pangandaran', '2024-07-24 16:00:55', ''),
(8, 'Masoem', '2024-08-06 01:27:44', '');

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
(64, 4, 'New Comment from Rizky Khatami', '2024-08-06 01:19:34'),
(65, 5, 'New Ticket from Rizky Khatami', '2024-08-06 01:21:21'),
(66, 5, 'Your Ticket on Process', '2024-08-06 01:21:58'),
(67, 6, 'New Ticket from Rizky Khatami', '2024-08-06 01:46:21'),
(68, 6, 'Your Ticket on Process', '2024-08-06 01:47:08'),
(69, 6, 'New Comment from Irham', '2024-08-06 01:50:21'),
(70, 6, 'New Comment from Rizky Khatami', '2024-08-06 01:50:41'),
(71, 7, 'New Ticket from Rizky Khatami', '2024-08-08 03:14:51'),
(72, 8, 'New Ticket from Rizky Khatami', '2024-08-08 03:15:25'),
(73, 9, 'New Ticket from Hamda Sakhia', '2024-08-08 03:23:01');

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
(1, 'T3007240001', 19, 'Bug pada fitur pencarian', 'kak saya tidak bisa menggunakan fitur pencarian kenapa yaa', '2f05bf6138554f579d093fdeb36b8836.png', 14, 2, 5, 2, 2, 'Ryan Pribowo', '2024-07-30 13:43:53', '2024-07-30'),
(3, 'T0308240001', 3, 'Lupa password akses', 'saya lupa password, tolong beritahu password saya apa', 'f0a16c989e46859570042c1646b5c37b.png', 15, 4, 2, 1, 0, '', '2024-08-03 04:05:53', ''),
(4, 'T0308240002', 7, 'Error saat mengirim email', 'saya gabisa kirim email kak kenapa ya', '7674801c9ea7d56a668610e77654347b.png', 14, 2, 5, 1, 1, '', '2024-08-03 14:00:13', ''),
(5, 'T0608240001', 19, 'Bug pada fitur pencarian', 'deks', 'bb01484319da442333db4725c6a6ce21.png', 14, 2, 5, 2, 1, '', '2024-08-06 01:21:21', ''),
(6, 'T0608240002', 1, 'test', 'test', 'ed7b8bfd15213c8b0bb8988cfda174fe.jpg', 14, 2, 5, 1, 1, '', '2024-08-06 01:46:21', ''),
(7, 'T0808240001', 24, 'Tampilan aplikasi tidak konsisten', 'test', 'e562defa9bbef23708bc0d9944259698.jpeg', 14, 2, 5, 2, 0, '', '2024-08-08 03:14:51', ''),
(8, 'T0808240002', 25, 'Kesalahan saat menyimpan data', 'p', '5dae2d3acdb3ef5f5482e38fb3a97df3.png', 14, 2, 5, 2, 0, '', '2024-08-08 03:15:25', ''),
(9, 'T0808240003', 5, 'Halaman utama tidak dapat dimuat', 'p', 'c38ffa42135e4066b61035ba6931add6.png', 15, 4, 2, 1, 0, '', '2024-08-08 03:23:01', '');

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
(4, 1, 14, 'udah bisa kak makasih', '2024-07-30 13:46:40'),
(10, 3, 1, 'okee', '2024-08-03 04:06:23'),
(28, 4, 12, 'okee di proses kak', '2024-08-03 14:04:19'),
(29, 4, 14, 'sipp', '2024-08-03 14:04:52'),
(30, 4, 14, 'udah bisa pak?', '2024-08-06 01:19:34'),
(31, 6, 13, 'di proses kak', '2024-08-06 01:50:21'),
(32, 6, 14, 'oke kak', '2024-08-06 01:50:41');

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
(8, 'USR002', 'ryan@gmail.com', '1234', 'Ryan Pribowo', 1, 2, 2, 0, '/dist/img/avatar/avatar_8.jpg', '2024-07-24 15:39:42', '2024-08-06'),
(9, 'USR003', 'mulki@gmail.com', '1234', 'Mulki Mantasya', 1, 2, 2, 1, '/dist/img/avatar4.png', '2024-07-24 15:40:32', '2024-07-24'),
(10, 'USR004', 'dida@gmail.com', '1234', 'Dida Kusdiana', 1, 3, 2, 1, '/dist/img/avatar4.png', '2024-07-24 15:41:11', '2024-07-24'),
(11, 'USR005', 'arie@gmail.com', '1234', 'Arie Afriadi', 1, 3, 2, 1, '/dist/img/avatar4.png', '2024-07-24 15:42:18', '2024-07-30'),
(12, 'USR006', 'irfan@gmail.com', '1234', 'Irfan Miftahul Khoir', 1, 1, 2, 1, '/dist/img/avatar4.png', '2024-07-24 15:44:40', '2024-07-24'),
(13, 'USR007', 'irham@gmail.com', '1234', 'Irham', 1, 1, 2, 1, '/dist/img/avatar4.png', '2024-07-30 13:37:35', '2024-07-30'),
(14, 'USR008', 'rizky@gmail.com', '1234', 'Rizky Khatami', 2, 0, 3, 1, '/dist/img/avatar/avatar_14.png', '2024-07-30 13:38:22', '2024-07-30'),
(15, 'USR009', 'hamda@gmail.com', '1234', 'Hamda Sakhia', 4, 0, 3, 1, '/dist/img/avatar5.png', '2024-07-30 13:54:16', '2024-07-30'),
(16, 'USR010', 'salma@gmail.com', '123', 'salma', 8, 0, 3, 1, '/dist/img/avatar5.png', '2024-08-06 01:28:22', '2024-08-06'),
(17, 'USR011', 'admin@gmail.com', '12345678', 'Admin', 1, 1, 1, 1, '/dist/img/avatar3.png', '2024-09-06 04:00:55', '2024-09-06');

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
(70, 1, 64, 1),
(71, 12, 64, 0),
(72, 13, 64, 0),
(73, 8, 65, 1),
(74, 9, 65, 0),
(75, 14, 66, 1),
(76, 1, 67, 1),
(77, 12, 67, 0),
(78, 13, 67, 1),
(79, 14, 68, 1),
(80, 14, 69, 1),
(81, 1, 70, 1),
(82, 12, 70, 0),
(83, 13, 70, 0),
(84, 8, 71, 0),
(85, 9, 71, 0),
(86, 8, 72, 0),
(87, 9, 72, 0),
(88, 1, 73, 1),
(89, 12, 73, 0),
(90, 13, 73, 0);

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
  MODIFY `id_application` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id_company` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id_notification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id_subject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ticket_detail`
--
ALTER TABLE `ticket_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_notification`
--
ALTER TABLE `user_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

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
