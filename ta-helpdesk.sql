-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2024 at 09:44 AM
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
(1, 'Mobile Legends', 2, '2024-05-29 14:18:28', ''),
(3, 'Point Blank', 3, '2024-06-08 02:24:11', ''),
(4, 'Gensin Impact', 2, '2024-06-16 02:32:13', '');

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
(2, 'PT Masoem ', '2024-05-29 14:13:57', ''),
(3, 'PT Astra', '2024-06-08 02:22:23', '');

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
(1, 'Tidak Bisa Login', 2, '2024-05-30 12:40:38', '2024-06-12'),
(2, 'Bagaimana Cara Mengganti Password?', 3, '2024-05-30 12:40:50', '2024-05-30'),
(3, 'Tidak Bisa Ganti Image Profile', 2, '2024-06-08 02:50:39', '2024-06-08'),
(4, 'lainnya..', 1, '2024-06-16 06:54:28', '2024-06-16');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id_ticket` int(11) NOT NULL,
  `no_ticket` varchar(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
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

INSERT INTO `ticket` (`id_ticket`, `no_ticket`, `subject`, `message`, `img_ticket`, `sender_id`, `company_id`, `app_id`, `divisi_id`, `status_ticket`, `solved_by`, `created_at`, `solved_at`) VALUES
(1, 'T0106240001', '1', 'abcd', 'dd511dc18cc46a09ced3d0bd11b55424.jpg', 3, 2, 1, 2, 2, 'Gojo Satoru', '2024-06-01 04:02:35', '2024-06-06'),
(3, 'T0806240001', '3', 'bang kenapa aku tidak bisa login bang', '3d322ee80f002538fac7615532f11395.png', 5, 3, 3, 2, 1, '', '2024-06-08 02:25:48', ''),
(5, 'T1606240001', '2', 'bang tutor ganti password dong :(', '7f78fb11e67161adfe42f322922aa8bf.png', 3, 2, 4, 3, 0, '', '2024-06-16 03:11:35', ''),
(6, 'T1606240002', '2', 'bang tutor ganti pw bang', '593e48fa7b30750f66ef9fc1dd007e67.png', 5, 3, 3, 3, 0, '', '2024-06-16 03:47:31', ''),
(7, 'T1606240003', '4', 'bangg tolong banggg', 'ac120f1874c1de5c48f8db1531fdbcb5.png', 3, 2, 4, 1, 0, '', '2024-06-16 06:57:33', '');

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
(1, 1, 3, 'gimana kak sudah?', '2024-06-02 22:59:42'),
(33, 1, 3, 'kak?', '2024-06-02 23:21:34'),
(34, 1, 2, 'dalam proses ya', '2024-06-02 23:23:11'),
(35, 1, 1, 'sipp', '2024-06-03 09:39:40'),
(36, 2, 4, 'halo bang', '2024-06-03 17:23:04'),
(37, 2, 3, 'p balap', '2024-06-03 17:23:46'),
(38, 1, 2, 'pp', '2024-06-04 07:49:39'),
(39, 3, 2, 'salah password kali bang', '2024-06-08 02:27:20'),
(40, 3, 5, 'mana ada', '2024-06-08 02:27:40'),
(41, 7, 1, 'apaa bang', '2024-06-16 06:58:19');

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
(1, 'USR001', 'ssayyidah18@gmail.com', '123', 'salemaaa', 1, 1, 1, 1, '/dist/img/avatar/avatar_1.jpg', '2024-05-29 12:02:56', '2024-05-30'),
(2, 'USR002', 'gojo@gmail.com', '123', 'Gojo Satoru', 1, 2, 2, 1, '/dist/img/avatar/avatar_22.png', '2024-05-29 17:57:17', '2024-06-12'),
(3, 'USR003', 'giyu@gmail.com', '123', 'Tomiyoka Giyu', 2, 0, 3, 1, '/dist/img/avatar/avatar_3.jpg', '2024-05-29 17:59:01', '2024-05-29'),
(4, 'USR004', 'dazai@gmail.com', '123', 'Dazai Osamu', 1, 3, 2, 1, '/dist/img/avatar/avatar_4.jpg', '2024-05-29 18:09:42', '2024-06-12'),
(5, 'USR005', 'yami@gmail.com', '123', 'Yami Sukehiro', 3, 0, 3, 1, '/dist/img/avatar/avatar_5.jpg', '2024-06-08 02:22:54', '2024-06-08');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id_role`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2024-05-29 16:53:24', ''),
(2, 'Agent', '2024-05-29 16:53:24', ''),
(3, 'Client', '2024-05-29 16:53:36', '');

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
  MODIFY `id_application` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id_company` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id_subject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ticket_detail`
--
ALTER TABLE `ticket_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
