-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 02, 2023 at 12:36 AM
-- Server version: 8.0.29-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart_toilette`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `names` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `names`, `phone`, `address`, `password`, `time`) VALUES
(1, 'admin@gmail.com', 'Izerimana DIdier', '0788750979', 'Huye, Rwanda', '202cb962ac59075b964b07152d234b70', '2022-06-17 13:58:07');

-- --------------------------------------------------------

--
-- Table structure for table `cleaner`
--

CREATE TABLE `cleaner` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `names` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cleaner`
--

INSERT INTO `cleaner` (`id`, `email`, `names`, `phone`, `address`, `time`) VALUES
(1, 'cleaner@gmail.com', 'Aime DIdier ', '07887850979', 'Huye, Rwanda', '2022-06-17 13:58:07');

-- --------------------------------------------------------

--
-- Table structure for table `pending_withdraw`
--

CREATE TABLE `pending_withdraw` (
  `id` int NOT NULL,
  `seller` int NOT NULL,
  `amount` int NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pending_withdraw`
--

INSERT INTO `pending_withdraw` (`id`, `seller`, `amount`, `time`) VALUES
(1, 1, 500, '2022-06-25 21:35:43');

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `id` int NOT NULL,
  `type0` int NOT NULL,
  `type1` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`id`, `type0`, `type1`) VALUES
(1, 100, 150);

-- --------------------------------------------------------

--
-- Table structure for table `reported`
--

CREATE TABLE `reported` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `toilette` enum('0','1') NOT NULL,
  `seller` int NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reported`
--

INSERT INTO `reported` (`id`, `user_id`, `toilette`, `seller`, `time`) VALUES
(1, 1, '0', 1, '2022-09-29 02:53:07'),
(2, 1, '0', 1, '2022-12-09 03:05:06'),
(3, 1, '0', 1, '2022-12-09 03:07:34'),
(4, 1, '1', 1, '2022-12-09 03:12:36'),
(5, 1, '0', 1, '2022-12-09 03:31:51');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `names` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `balance` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`id`, `email`, `names`, `phone`, `address`, `balance`, `password`, `time`) VALUES
(1, 'seller@gmail.com', 'Aime Didier', '0788750979', 'Huye, Rwanda', '300', '3b081fd5426c134088a9b1466ff4c224', '2022-06-17 13:17:29');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int NOT NULL,
  `debit` int NOT NULL DEFAULT '0',
  `credit` int NOT NULL DEFAULT '0',
  `seller` int DEFAULT NULL,
  `user` int DEFAULT NULL,
  `toy` enum('0','1') DEFAULT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `debit`, `credit`, `seller`, `user`, `toy`, `time`) VALUES
(71, 0, 100, NULL, 1, '0', '2022-12-19 21:46:41'),
(72, 0, 150, NULL, 1, '1', '2022-12-19 21:47:24'),
(73, 0, 150, NULL, 1, '1', '2022-12-19 21:50:55'),
(74, 0, 150, NULL, 1, '1', '2022-12-19 21:51:26'),
(75, 0, 150, NULL, 1, '1', '2022-12-19 21:52:11'),
(76, 0, 100, NULL, 1, '0', '2022-12-19 21:52:53'),
(77, 0, 150, NULL, 1, '1', '2022-12-19 21:53:16'),
(78, 0, 150, NULL, 1, '1', '2022-12-19 21:56:17'),
(79, 0, 100, 1, 1, '0', '2022-12-19 22:05:19'),
(80, 100, 0, NULL, 1, NULL, '2022-12-19 22:08:16'),
(81, 100, 0, NULL, 1, NULL, '2022-12-19 22:12:32'),
(82, 100, 0, NULL, 1, NULL, '2022-12-19 22:14:19'),
(83, 100, 0, NULL, 1, NULL, '2022-12-19 22:18:07'),
(84, 100, 0, NULL, 1, NULL, '2022-12-19 22:19:38'),
(85, 100, 0, NULL, 1, NULL, '2022-12-19 22:19:43'),
(86, 100, 0, NULL, 1, NULL, '2022-12-19 22:20:23'),
(87, 100, 0, NULL, 1, NULL, '2022-12-19 22:20:23'),
(88, 100, 0, NULL, 1, NULL, '2022-12-19 22:21:30'),
(89, 100, 0, NULL, 1, NULL, '2022-12-19 22:24:17'),
(90, 100, 0, NULL, 1, NULL, '2022-12-19 22:25:12'),
(91, 200, 0, NULL, 1, NULL, '2022-12-19 22:26:17'),
(92, 100, 0, NULL, 1, NULL, '2022-12-19 22:27:06'),
(93, 100, 0, NULL, 1, NULL, '2022-12-19 22:28:42'),
(94, 100, 0, NULL, 1, NULL, '2022-12-19 22:29:27'),
(95, 100, 0, NULL, 1, NULL, '2022-12-19 22:35:03'),
(96, 100, 0, NULL, 1, NULL, '2022-12-19 22:36:13'),
(97, 100, 0, NULL, 1, NULL, '2022-12-19 22:40:05'),
(98, 0, 100, 1, 1, '0', '2022-12-21 06:33:08'),
(99, 0, 100, 1, 1, '0', '2022-12-21 07:11:16'),
(100, 0, 150, 1, 1, '1', '2022-12-21 07:12:47'),
(101, 0, 150, 1, 1, '1', '2022-12-21 07:13:44'),
(102, 0, 150, 1, 1, '1', '2022-12-21 07:14:46'),
(103, 0, 150, 1, 1, '1', '2022-12-21 07:16:14'),
(104, 0, 100, 1, 1, '0', '2022-12-21 07:17:48'),
(105, 0, 100, 1, 1, '0', '2022-12-21 07:18:43'),
(106, 0, 150, 1, 1, '1', '2022-12-21 07:19:13'),
(107, 0, 150, 1, 1, '1', '2022-12-21 07:21:02'),
(108, 0, 150, 1, 1, '1', '2022-12-21 07:21:36'),
(109, 0, 150, 1, 1, '1', '2022-12-21 07:22:06'),
(110, 0, 100, 1, 1, '0', '2022-12-21 07:22:51'),
(111, 0, 100, 1, 1, '0', '2022-12-21 07:23:44'),
(112, 0, 100, 1, 1, '0', '2022-12-21 07:24:59'),
(113, 0, 150, 1, 1, '1', '2022-12-21 07:25:33'),
(114, 0, 100, 1, 1, '0', '2022-12-21 07:26:28'),
(115, 0, 100, 1, 1, '0', '2022-12-21 07:30:53'),
(116, 0, 150, 1, 1, '1', '2022-12-21 07:31:31'),
(117, 0, 100, 1, 1, '0', '2022-12-21 07:34:26'),
(118, 0, 150, 1, 1, '1', '2022-12-21 07:35:04'),
(119, 0, 150, 1, 1, '1', '2022-12-21 07:36:04'),
(120, 0, 150, 1, 1, '1', '2022-12-21 07:36:40'),
(121, 0, 100, 1, 1, '0', '2022-12-21 07:38:10'),
(122, 0, 100, 1, 1, '0', '2022-12-21 07:42:40'),
(123, 0, 100, 1, 1, '0', '2022-12-21 07:44:01'),
(124, 0, 100, 1, 1, '0', '2022-12-21 07:46:31'),
(125, 0, 100, 1, 1, '0', '2022-12-21 07:51:09'),
(126, 0, 100, 1, 1, '0', '2022-12-21 07:53:49'),
(127, 0, 150, 1, 1, '1', '2022-12-21 07:54:13'),
(128, 0, 100, 1, 1, '0', '2022-12-21 07:56:47'),
(129, 0, 100, 1, 1, '0', '2022-12-21 07:57:15'),
(130, 0, 100, 1, 1, '0', '2022-12-21 07:57:49'),
(131, 0, 150, 1, 1, '1', '2022-12-21 07:59:42'),
(132, 0, 100, 1, 1, '0', '2022-12-21 08:01:17'),
(133, 0, 100, 1, 1, '0', '2022-12-21 08:45:00'),
(134, 0, 100, 1, 1, '0', '2022-12-21 08:45:41'),
(135, 0, 100, 1, 1, '0', '2022-12-21 08:46:42'),
(136, 0, 150, 1, 1, '1', '2022-12-21 08:47:16'),
(137, 0, 100, 1, 1, '0', '2022-12-21 08:49:37'),
(138, 0, 150, 1, 1, '1', '2022-12-21 08:50:09'),
(139, 0, 100, 1, 1, '0', '2022-12-21 10:52:45'),
(140, 0, 150, 1, 1, '1', '2022-12-21 10:53:46'),
(141, 0, 150, 1, 1, '1', '2022-12-21 10:54:56'),
(142, 0, 150, 1, 1, '1', '2022-12-21 10:56:05'),
(143, 0, 100, 1, 1, '0', '2022-12-21 11:04:19');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `names` varchar(255) NOT NULL,
  `card` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL DEFAULT '0',
  `balance` int NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `names`, `card`, `email`, `phone`, `balance`, `time`) VALUES
(1, 'Edissa', '5314B2AB', 'edissa@gmail.com', '0788750979', 3800, '2022-06-25 22:23:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cleaner`
--
ALTER TABLE `cleaner`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `pending_withdraw`
--
ALTER TABLE `pending_withdraw`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller` (`seller`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reported`
--
ALTER TABLE `reported`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `seller` (`seller`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller` (`seller`),
  ADD KEY `student` (`user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `card` (`card`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cleaner`
--
ALTER TABLE `cleaner`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pending_withdraw`
--
ALTER TABLE `pending_withdraw`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reported`
--
ALTER TABLE `reported`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
