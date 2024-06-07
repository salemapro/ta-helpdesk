-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2024 at 07:41 AM
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
(1, 'Mobile Legends', 2, '2024-05-29 14:18:28', '');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `user_code` varchar(6) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `num_phone` varchar(20) NOT NULL,
  `company_id` int(11) NOT NULL,
  `divisi_id` int(11) NOT NULL,
  `avatar` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id_client`, `user_code`, `email`, `fullname`, `num_phone`, `company_id`, `divisi_id`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 'CLN001', 'giyu@gmail.com', 'Tomiyoka Giyu', '0897651234', 2, 0, '', '2024-05-29 14:15:04', '2024-05-29');

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
(2, 'PT Masoem ', '2024-05-29 14:13:57', '');

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
(1, 'Call Center', '2024-05-29 12:30:29', '2024-05-29'),
(2, 'Developer', '2024-05-29 14:32:46', '2024-05-29'),
(3, 'Konsultan IT', '2024-05-29 14:32:57', '2024-05-29');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id_employee` int(11) NOT NULL,
  `user_code` varchar(6) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `num_phone` varchar(20) NOT NULL,
  `company_id` int(11) NOT NULL,
  `divisi_id` int(11) NOT NULL,
  `avatar` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id_employee`, `user_code`, `email`, `fullname`, `num_phone`, `company_id`, `divisi_id`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 'EMP001', 'gojo@gmail.com', 'Gojo Satoru', '0812345678', 1, 2, '', '2024-05-29 13:17:10', '2024-05-29'),
(2, 'EMP002', 'ssayyidah18@gmail.com', 'Salma Sayyidah', '081998443418', 1, 1, '', '2024-05-29 14:35:48', '2024-05-29');

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
(1, 'Tidak Bisa Login', 2, '2024-05-30 12:40:38', '2024-05-30'),
(2, 'Bagaimana Cara Mengganti Password?', 3, '2024-05-30 12:40:50', '2024-05-30');

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
(2, 'T0206240001', '2', 'aku ga bisa bang', 'c28328928d5b38afa792c6411100ba99.jpg', 3, 2, 1, 3, 0, '0', '2024-06-01 18:03:44', '');

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
(38, 1, 2, 'pp', '2024-06-04 07:49:39');

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
(1, 'USR001', 'ssayyidah18@gmail.com', '123', 'Salma Sayyidah', 1, 1, 1, 1, '/dist/img/avatar3.png', '2024-05-29 12:02:56', '2024-05-30'),
(2, 'USR002', 'gojo@gmail.com', '123', 'Gojo Satoru', 1, 2, 2, 1, '/dist/img/avatar4.png', '2024-05-29 17:57:17', '2024-05-29'),
(3, 'USR003', 'giyu@gmail.com', '123', 'Tomiyoka Giyu', 2, 0, 3, 1, '/dist/img/avatar5.png', '2024-05-29 17:59:01', '2024-05-29'),
(4, 'USR004', 'dazai@gmail.com', '123', 'Dazai Osamu', 1, 3, 2, 1, '/dist/img/avatar4.png', '2024-05-29 18:09:42', '2024-05-29');

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
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

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
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id_employee`);

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
  MODIFY `id_application` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id_company` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id_employee` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id_subject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ticket_detail`
--
ALTER TABLE `ticket_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
