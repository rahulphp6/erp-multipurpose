-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2026 at 04:30 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alamin`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_users`
--

CREATE TABLE `active_users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact_id` varchar(100) DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `live_ip` varchar(100) DEFAULT NULL,
  `pc_ip` varchar(100) DEFAULT NULL,
  `user_ip` varchar(100) DEFAULT NULL,
  `time_in` varchar(50) DEFAULT NULL,
  `time_out` varchar(50) DEFAULT NULL,
  `last_active` datetime DEFAULT NULL,
  `pc_details` varchar(500) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE `configuration` (
  `id` int(11) NOT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `short` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `currency` varchar(30) DEFAULT NULL,
  `carrier` varchar(5000) DEFAULT NULL,
  `ret_des` varchar(500) DEFAULT NULL,
  `payment_mode` varchar(3000) DEFAULT NULL,
  `logo` varchar(500) NOT NULL,
  `address` varchar(300) DEFAULT NULL,
  `linkedin` varchar(500) DEFAULT NULL,
  `instagram` varchar(500) DEFAULT NULL,
  `facebook` varchar(500) DEFAULT NULL,
  `twitter` varchar(300) DEFAULT NULL,
  `wapp` int(11) NOT NULL DEFAULT 0,
  `chat` int(11) NOT NULL DEFAULT 0,
  `store` bigint(20) DEFAULT NULL,
  `server_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`id`, `brand`, `short`, `phone`, `email`, `currency`, `carrier`, `ret_des`, `payment_mode`, `logo`, `address`, `linkedin`, `instagram`, `facebook`, `twitter`, `wapp`, `chat`, `store`, `server_date`) VALUES
(5, 'Alamin', 'AlA', '9990099237', 'rahulp6@gmail.com', 'AED', 'Hand Delivery,DHL Express,Century Courier,FedEx, Emirates Post, Other Local Courier', 'Advance Payment,Retainer Payment,Example', 'Cash-POS,Credit Card,Online Payment,Tabby Installments,Tabby Card, Tamara Installments', 'logo.png', '', '', '', '', '', 0, 0, NULL, '2020-12-12 04:49:15');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `MKey` varchar(200) NOT NULL,
  `about` varchar(500) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `name`, `MKey`, `about`, `status`, `date`) VALUES
(2, 'login', 'c4ca4238a0b923820dcc509a6f75849b', 'manage logins', 1, '2020/08/26 11:17:53 am'),
(3, 'roles', 'c4ca4238a0b923820dcc509a6f75849b', 'manage roles activity', 1, '2020/08/26 11:19:28 am'),
(4, 'pro', 'cfcd208495d565ef66e7dff9f98764da', 'enable extra features', 1, '2020/08/26 11:26:17 am');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `level` int(11) NOT NULL DEFAULT 2,
  `status` int(11) NOT NULL DEFAULT 1,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`, `level`, `status`, `date`) VALUES
(1, '404', '', 2, 1, '2022-03-05'),
(5, 'configuration', '', 2, 1, '2022-03-05'),
(10, 'customers', '', 2, 1, '2022-03-05'),
(12, 'dashboard', '', 2, 1, '2022-03-05'),
(14, 'departments', '', 2, 1, '2022-03-05'),
(26, 'mail', '', 2, 1, '2022-03-05'),
(27, 'module', '', 2, 1, '2022-03-05'),
(28, 'notes', '', 2, 1, '2022-03-05'),
(29, 'outh', '', 2, 1, '2022-03-05'),
(34, 'permission', '', 2, 1, '2022-03-05'),
(36, 'permissions', '', 2, 1, '2022-03-05'),
(39, 'prescription', '', 2, 1, '2022-03-05'),
(40, 'product', '', 2, 1, '2022-03-05'),
(41, 'products', '', 2, 1, '2022-03-05'),
(42, 'profile', '', 2, 1, '2022-03-05'),
(43, 'redeem', '', 2, 1, '2022-03-05'),
(44, 'report', '', 2, 1, '2022-03-05'),
(45, 'retainer', '', 2, 1, '2022-03-05'),
(46, 'retainerinvoice', '', 2, 1, '2022-03-05'),
(47, 'roles', '', 2, 1, '2022-03-05'),
(48, 'sales', '', 2, 1, '2022-03-05'),
(50, 'salesorder', '', 2, 1, '2022-03-05'),
(52, 'sample', '', 2, 1, '2022-03-05'),
(53, 'sms', '', 2, 1, '2022-03-05'),
(54, 'store', '', 2, 1, '2022-03-05'),
(55, 'support', '', 2, 1, '2022-03-05'),
(56, 'target', '', 2, 1, '2022-03-05'),
(57, 'task', '', 2, 1, '2022-03-05'),
(58, 'tasks', '', 2, 1, '2022-03-05'),
(61, 'test', '', 2, 1, '2022-03-05'),
(62, 'todo', '', 2, 1, '2022-03-05'),
(63, 'user', '', 2, 1, '2022-03-05'),
(64, 'users', '', 2, 1, '2022-03-05'),
(136, 'contacts', '', 2, 1, '2022-03-06'),
(220, 'invoices', '', 2, 1, '2022-03-08'),
(327, 'login', '', 2, 1, '2022-03-09'),
(395, 'notifications', '', 2, 1, '2022-03-11'),
(396, 'setting', '', 2, 1, '2022-03-15'),
(397, 'currencies', '', 2, 1, '2022-03-21'),
(398, 'warehouses', '', 2, 1, '2022-03-22'),
(617, 'retainerinvoices', '', 2, 1, '2022-05-07'),
(700, 'items', '', 2, 1, '2022-05-13'),
(851, 'barcodes', '', 2, 1, '2022-06-01'),
(929, 'pos', 'point of sale, tab version', 2, 1, '2022-08-09'),
(1006, 'unused', '', 2, 1, '2022-12-21'),
(1104, 'salespersons', '', 2, 1, '2023-01-06'),
(1105, 'payment', 'payment modes', 2, 1, '2023-02-21'),
(1106, 'repair', 'repairing services', 2, 1, '2023-04-04'),
(1107, 'issues', '', 2, 1, '2023-04-04'),
(1108, 'warranty', '', 2, 1, '2023-06-29'),
(1110, 'theme', '', 2, 1, '2024-03-09'),
(1111, 'menu', '', 2, 1, '2024-03-09');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `isRead` int(11) DEFAULT 0,
  `isWrite` int(11) DEFAULT 0,
  `isEdit` int(11) DEFAULT 0,
  `isDelete` int(11) DEFAULT 0,
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `role_id`, `permission_id`, `isRead`, `isWrite`, `isEdit`, `isDelete`, `status`) VALUES
(1, 5, 1, 1, 1, 1, 1, 0),
(5, 5, 5, 1, 1, 1, 1, 0),
(8, 5, 10, 1, 1, 1, 1, 0),
(9, 5, 12, 1, 1, 1, 1, 0),
(11, 5, 14, 1, 1, 1, 1, 0),
(16, 5, 26, 1, 1, 1, 1, 0),
(17, 5, 27, 1, 1, 1, 1, 0),
(18, 5, 28, 1, 1, 1, 1, 0),
(19, 5, 29, 1, 1, 1, 1, 0),
(22, 5, 34, 1, 1, 1, 1, 0),
(23, 5, 36, 1, 1, 1, 1, 0),
(26, 5, 39, 1, 1, 1, 1, 0),
(27, 5, 40, 1, 1, 1, 1, 0),
(28, 5, 41, 1, 1, 1, 1, 0),
(29, 5, 42, 1, 1, 1, 1, 0),
(30, 5, 43, 1, 1, 1, 1, 0),
(31, 5, 44, 1, 1, 1, 1, 0),
(32, 5, 45, 1, 1, 1, 1, 0),
(33, 5, 46, 1, 1, 1, 1, 0),
(34, 5, 47, 1, 1, 1, 1, 0),
(35, 5, 48, 1, 1, 1, 1, 0),
(36, 5, 50, 1, 1, 1, 1, 0),
(37, 5, 52, 1, 1, 1, 1, 0),
(38, 5, 53, 1, 1, 1, 1, 0),
(39, 5, 54, 1, 1, 1, 1, 0),
(40, 5, 55, 1, 1, 1, 1, 0),
(41, 5, 56, 1, 1, 1, 1, 0),
(42, 5, 57, 1, 1, 1, 1, 0),
(43, 5, 58, 1, 1, 1, 1, 0),
(44, 5, 61, 1, 1, 1, 1, 0),
(45, 5, 62, 1, 1, 1, 1, 0),
(46, 5, 63, 1, 1, 1, 1, 0),
(47, 5, 64, 1, 1, 1, 1, 0),
(48, 1, 1, 1, 1, 1, 1, 0),
(52, 1, 5, 1, 1, 1, 1, 0),
(55, 1, 10, 1, 1, 1, 1, 0),
(56, 1, 12, 1, 1, 1, 1, 0),
(58, 1, 14, 1, 1, 1, 1, 0),
(63, 1, 26, 1, 1, 1, 1, 0),
(64, 1, 27, 1, 1, 1, 1, 0),
(65, 1, 28, 1, 1, 1, 1, 0),
(66, 1, 29, 1, 1, 1, 1, 0),
(69, 1, 34, 1, 1, 1, 1, 0),
(70, 1, 36, 1, 1, 1, 1, 0),
(73, 1, 39, 1, 1, 1, 1, 0),
(74, 1, 40, 1, 1, 1, 1, 0),
(75, 1, 41, 1, 1, 1, 1, 0),
(76, 1, 42, 1, 1, 1, 1, 0),
(77, 1, 43, 1, 1, 1, 1, 0),
(78, 1, 44, 1, 1, 1, 1, 0),
(79, 1, 45, 1, 1, 1, 1, 0),
(80, 1, 46, 1, 1, 1, 1, 0),
(81, 1, 47, 1, 1, 1, 1, 0),
(82, 1, 48, 1, 1, 1, 1, 0),
(83, 1, 50, 1, 1, 1, 1, 0),
(84, 1, 52, 1, 1, 1, 1, 0),
(85, 1, 53, 1, 1, 1, 1, 0),
(86, 1, 54, 1, 1, 1, 1, 0),
(87, 1, 55, 1, 1, 1, 1, 0),
(88, 1, 56, 1, 1, 1, 1, 0),
(89, 1, 57, 1, 1, 1, 1, 0),
(90, 1, 58, 1, 1, 1, 1, 0),
(91, 1, 61, 1, 1, 1, 1, 0),
(92, 1, 62, 1, 1, 1, 1, 0),
(93, 1, 63, 1, 1, 1, 1, 0),
(94, 1, 64, 1, 1, 1, 1, 0),
(95, 1, 136, 1, 1, 1, 1, 0),
(96, 1, 220, 1, 1, 1, 1, 0),
(97, 1, 327, 1, 1, 1, 1, 0),
(98, 1, 395, 1, 1, 1, 1, 0),
(99, 1, 396, 1, 1, 1, 1, 0),
(100, 1, 397, 1, 1, 1, 1, 0),
(101, 1, 398, 1, 1, 1, 1, 0),
(102, 5, 136, 1, 1, 1, 1, 0),
(103, 5, 220, 1, 1, 1, 0, 0),
(104, 5, 327, 1, 1, 1, 1, 0),
(105, 5, 395, 1, 1, 1, 1, 0),
(106, 5, 396, 1, 1, 1, 1, 0),
(107, 5, 397, 1, 1, 1, 1, 0),
(108, 5, 398, 1, 1, 1, 1, 0),
(109, 8, 1, 1, 1, 1, 1, 0),
(113, 8, 5, 1, 1, 1, 1, 0),
(116, 8, 10, 1, 1, 1, 1, 0),
(117, 8, 12, 1, 1, 1, 1, 0),
(119, 8, 14, 1, 1, 1, 1, 0),
(124, 8, 26, 1, 1, 1, 1, 0),
(125, 8, 27, 1, 1, 1, 1, 0),
(126, 8, 28, 1, 1, 1, 1, 0),
(127, 8, 29, 1, 1, 1, 1, 0),
(130, 8, 34, 1, 1, 1, 1, 0),
(131, 8, 36, 1, 1, 1, 1, 0),
(134, 8, 39, 1, 1, 1, 1, 0),
(135, 8, 40, 1, 1, 1, 1, 0),
(136, 8, 41, 1, 1, 1, 1, 0),
(137, 8, 42, 1, 1, 1, 1, 0),
(138, 8, 43, 1, 1, 1, 1, 0),
(139, 8, 44, 1, 1, 1, 1, 0),
(140, 8, 45, 1, 1, 1, 1, 0),
(141, 8, 46, 1, 1, 1, 1, 0),
(142, 8, 47, 1, 1, 1, 1, 0),
(143, 8, 48, 1, 1, 1, 1, 0),
(144, 8, 50, 1, 1, 1, 1, 0),
(145, 8, 52, 1, 1, 1, 1, 0),
(146, 8, 53, 1, 1, 1, 1, 0),
(147, 8, 54, 1, 1, 1, 1, 0),
(148, 8, 55, 1, 1, 1, 1, 0),
(149, 8, 56, 1, 1, 1, 1, 0),
(150, 8, 57, 1, 1, 1, 1, 0),
(151, 8, 58, 1, 1, 1, 1, 0),
(152, 8, 61, 1, 1, 1, 1, 0),
(153, 8, 62, 1, 1, 1, 1, 0),
(154, 8, 63, 1, 1, 1, 1, 0),
(155, 8, 64, 1, 1, 1, 1, 0),
(156, 8, 136, 1, 1, 1, 1, 0),
(157, 8, 220, 1, 1, 1, 1, 0),
(158, 8, 327, 1, 1, 1, 1, 0),
(159, 8, 395, 1, 1, 1, 1, 0),
(160, 8, 396, 1, 1, 1, 1, 0),
(161, 8, 397, 1, 1, 1, 1, 0),
(162, 8, 398, 1, 1, 1, 1, 0),
(163, 5, 617, 1, 1, 1, 1, 0),
(164, 5, 700, 1, 1, 1, 0, 0),
(165, 8, 617, 1, 1, 1, 1, 0),
(166, 8, 700, 0, 0, 0, 0, 0),
(167, 5, 851, 1, 0, 0, 0, 0),
(168, 5, 929, 1, 1, 1, 0, 0),
(169, 1, 617, 1, 1, 1, 1, 0),
(170, 1, 700, 1, 1, 1, 1, 0),
(171, 1, 851, 1, 1, 1, 1, 0),
(172, 1, 929, 1, 1, 1, 1, 0),
(173, 1, 1006, 1, 1, 1, 1, 0),
(174, 2, 1, 1, 1, 1, 1, 0),
(178, 2, 5, 1, 1, 1, 1, 0),
(181, 2, 10, 1, 1, 1, 1, 0),
(182, 2, 12, 1, 1, 1, 1, 0),
(184, 2, 14, 1, 1, 1, 1, 0),
(189, 2, 26, 1, 1, 1, 1, 0),
(190, 2, 27, 1, 1, 1, 1, 0),
(191, 2, 28, 1, 1, 1, 1, 0),
(192, 2, 29, 1, 1, 1, 1, 0),
(195, 2, 34, 1, 1, 1, 1, 0),
(196, 2, 36, 1, 1, 1, 1, 0),
(199, 2, 39, 1, 1, 1, 1, 0),
(200, 2, 40, 1, 1, 1, 1, 0),
(201, 2, 41, 1, 1, 1, 1, 0),
(202, 2, 42, 1, 1, 1, 1, 0),
(203, 2, 43, 1, 1, 1, 1, 0),
(204, 2, 44, 1, 1, 1, 1, 0),
(205, 2, 45, 1, 1, 1, 1, 0),
(206, 2, 46, 1, 1, 1, 1, 0),
(207, 2, 47, 1, 1, 1, 1, 0),
(208, 2, 48, 1, 1, 1, 1, 0),
(209, 2, 50, 1, 1, 1, 1, 0),
(210, 2, 52, 1, 1, 1, 1, 0),
(211, 2, 53, 1, 1, 1, 1, 0),
(212, 2, 54, 1, 1, 1, 1, 0),
(213, 2, 55, 1, 1, 1, 1, 0),
(214, 2, 56, 1, 1, 1, 1, 0),
(215, 2, 57, 1, 1, 1, 1, 0),
(216, 2, 58, 1, 1, 1, 1, 0),
(217, 2, 61, 1, 1, 1, 1, 0),
(218, 2, 62, 1, 1, 1, 1, 0),
(219, 2, 63, 1, 1, 1, 1, 0),
(220, 2, 64, 1, 1, 1, 1, 0),
(221, 2, 136, 1, 1, 1, 1, 0),
(222, 2, 220, 1, 1, 1, 1, 0),
(223, 2, 327, 1, 1, 1, 1, 0),
(224, 2, 395, 1, 1, 1, 1, 0),
(225, 2, 396, 1, 1, 1, 1, 0),
(226, 2, 397, 1, 1, 1, 1, 0),
(227, 2, 398, 1, 1, 1, 1, 0),
(228, 2, 617, 1, 1, 1, 1, 0),
(229, 2, 700, 1, 1, 1, 1, 0),
(230, 2, 851, 1, 1, 1, 1, 0),
(231, 2, 929, 1, 1, 1, 1, 0),
(232, 2, 1006, 1, 1, 1, 1, 0),
(233, 3, 1, 1, 1, 1, 1, 0),
(237, 3, 5, 1, 1, 1, 1, 0),
(240, 3, 10, 1, 1, 1, 1, 0),
(241, 3, 12, 1, 1, 1, 1, 0),
(243, 3, 14, 1, 1, 1, 1, 0),
(248, 3, 26, 1, 1, 1, 1, 0),
(249, 3, 27, 1, 1, 1, 1, 0),
(250, 3, 28, 1, 1, 1, 1, 0),
(251, 3, 29, 1, 1, 1, 1, 0),
(254, 3, 34, 1, 1, 1, 1, 0),
(255, 3, 36, 1, 1, 1, 1, 0),
(258, 3, 39, 1, 1, 1, 1, 0),
(259, 3, 40, 1, 1, 1, 1, 0),
(260, 3, 41, 1, 1, 1, 1, 0),
(261, 3, 42, 1, 1, 1, 1, 0),
(262, 3, 43, 1, 1, 1, 1, 0),
(263, 3, 44, 1, 1, 1, 1, 0),
(264, 3, 45, 1, 1, 1, 1, 0),
(265, 3, 46, 1, 1, 1, 1, 0),
(266, 3, 47, 1, 1, 1, 1, 0),
(267, 3, 48, 1, 1, 1, 1, 0),
(268, 3, 50, 1, 1, 1, 1, 0),
(269, 3, 52, 1, 1, 1, 1, 0),
(270, 3, 53, 1, 1, 1, 1, 0),
(271, 3, 54, 1, 1, 1, 1, 0),
(272, 3, 55, 1, 1, 1, 1, 0),
(273, 3, 56, 1, 1, 1, 1, 0),
(274, 3, 57, 1, 1, 1, 1, 0),
(275, 3, 58, 1, 1, 1, 1, 0),
(276, 3, 61, 1, 1, 1, 1, 0),
(277, 3, 62, 1, 1, 1, 1, 0),
(278, 3, 63, 1, 1, 1, 1, 0),
(279, 3, 64, 1, 1, 1, 1, 0),
(280, 3, 136, 1, 1, 1, 1, 0),
(281, 3, 220, 1, 1, 1, 1, 0),
(282, 3, 327, 1, 1, 1, 1, 0),
(283, 3, 395, 1, 1, 1, 1, 0),
(284, 3, 396, 1, 1, 1, 1, 0),
(285, 3, 397, 1, 1, 1, 1, 0),
(286, 3, 398, 1, 1, 1, 1, 0),
(287, 3, 617, 1, 1, 1, 1, 0),
(288, 3, 700, 1, 1, 1, 1, 0),
(289, 3, 851, 1, 1, 1, 1, 0),
(290, 3, 929, 1, 1, 1, 1, 0),
(291, 3, 1006, 1, 1, 1, 1, 0),
(292, 3, 1104, 1, 1, 1, 1, 0),
(293, 3, 1105, 1, 1, 1, 1, 0),
(294, 3, 1106, 1, 1, 1, 1, 0),
(295, 3, 1107, 1, 1, 1, 1, 0),
(296, 2, 1104, 1, 1, 1, 1, 0),
(297, 2, 1105, 1, 1, 1, 1, 0),
(298, 2, 1106, 1, 1, 1, 1, 0),
(299, 2, 1107, 1, 1, 1, 1, 0),
(300, 5, 1006, 1, 0, 0, 0, 0),
(301, 5, 1104, 1, 0, 0, 0, 0),
(302, 5, 1105, 1, 0, 0, 0, 0),
(303, 5, 1106, 1, 0, 0, 0, 0),
(304, 5, 1107, 1, 0, 0, 0, 0),
(305, 2, 1108, 1, 1, 1, 1, 0),
(306, 3, 1108, 1, 1, 1, 1, 0),
(307, 5, 1108, 1, 1, 0, 0, 0),
(308, 5, 1110, 1, 1, 0, 0, 0),
(309, 5, 1111, 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `status`, `date`) VALUES
(1, 'administrator', 'you can manage', 1, '2024-03-12 00:30:47'),
(2, 'super admin', 'advance admin', 1, '2024-03-12 00:30:47'),
(3, 'admin', 'simple admin', 1, '2024-03-12 00:30:47'),
(5, 'user', 'front end user also read user', 1, '2024-03-12 00:30:47'),
(8, 'other', 'they can manage reporting module like deposit and all.', 1, '2024-03-12 08:31:01');

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `id` int(11) NOT NULL,
  `sid` varchar(300) NOT NULL,
  `token` varchar(400) NOT NULL,
  `sms_no` bigint(20) NOT NULL,
  `wp_no` bigint(20) NOT NULL,
  `store` bigint(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `date` date DEFAULT NULL,
  `server_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `smtp`
--

CREATE TABLE `smtp` (
  `id` int(11) NOT NULL,
  `host` varchar(100) DEFAULT NULL,
  `port` int(11) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `pwd` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `multi_ph` varchar(500) DEFAULT NULL,
  `server_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `smtp`
--

INSERT INTO `smtp` (`id`, `host`, `port`, `user`, `pwd`, `status`, `phone`, `email`, `multi_ph`, `server_date`) VALUES
(3, 'imaxxe.com', 465, 'sales@imaxxe.com', 'JHNsc0AxODE5ODI=', 1, '971521994000', 'suheail@hotmail.com', '', '2020-10-17 23:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `UserName` varchar(500) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `role` int(11) DEFAULT 5,
  `depid` int(11) DEFAULT NULL,
  `store` varchar(20) DEFAULT NULL,
  `profilePic` varchar(300) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `Gender` int(11) DEFAULT NULL,
  `dob` varchar(100) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `CountryName` varchar(100) DEFAULT NULL,
  `EndUserIp` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `date` datetime DEFAULT NULL,
  `role_id` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `UserName`, `last_name`, `role`, `depid`, `store`, `profilePic`, `password`, `email`, `phone`, `Gender`, `dob`, `address`, `City`, `CountryName`, `EndUserIp`, `status`, `date`, `role_id`) VALUES
(1, 'Suheail at iSpexe', 'Suheail_iSpexe', NULL, 1, NULL, NULL, NULL, 'acf23cda03dfabbf4c481ca2c44849ea', 'suheail@hotmail.com', '9715219945454', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(2, 'Administrator', 'SuperAdmin', NULL, 1, NULL, NULL, NULL, '351ccea804da6f877ff247d6eac38108', 'rahulphp7@gmail.com', '919990099237', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(62, 'suheail', 'suheail', 'Km', 3, 6, NULL, NULL, '7966b1d6051560952de2e72b91e8b038', 'suheail@admin.com', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-07-22 10:34:39', NULL),
(166, 'Suheail Mohammedali', NULL, NULL, 5, NULL, '705054324', NULL, '7966b1d6051560952de2e72b91e8b038', 'suheail@imaxxe.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2118231000000000619'),
(231, 'Naseeb at iSpexe', NULL, 'at iSpexe', 5, NULL, '772285939', NULL, '7966b1d6051560952de2e72b91e8b038', 'naseeb@ispexe.com', '97563815668', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-12-26 04:12:56', '3106697000018293548');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_users`
--
ALTER TABLE `active_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unq_phone` (`phone`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_module` (`name`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_perm` (`permission_id`),
  ADD KEY `fk_role_id` (`role_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `user` (`UserName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `active_users`
--
ALTER TABLE `active_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13013;

--
-- AUTO_INCREMENT for table `configuration`
--
ALTER TABLE `configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1112;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=310;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `fk_perm` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
