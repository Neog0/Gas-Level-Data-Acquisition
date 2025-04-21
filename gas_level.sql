-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2025 at 03:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gas`
--

-- --------------------------------------------------------

--
-- Table structure for table `gas_level`
--

CREATE TABLE `gas_level` (
  `ID` int(11) NOT NULL,
  `gas_value` float NOT NULL,
  `status` varchar(50) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gas_level`
--

INSERT INTO `gas_level` (`ID`, `gas_value`, `status`, `timestamp`) VALUES
(405, 448, 'Gas Detected', '2025-04-15 20:51:46'),
(406, 395, 'Gas Detected', '2025-04-15 20:51:57'),
(407, 341, 'Gas Detected', '2025-04-15 20:52:30'),
(408, 364, 'Gas Detected', '2025-04-15 20:52:47'),
(409, 393, 'Gas Detected', '2025-04-15 20:53:10'),
(411, 550, 'Gas Detected', '2025-04-15 20:55:47'),
(413, 373, 'Gas Detected', '2025-04-15 20:59:28'),
(414, 295, 'Gas Detected', '2025-04-15 21:00:29'),
(415, 296, 'Gas Detected', '2025-04-15 21:00:55'),
(416, 230, 'Gas Detected', '2025-04-15 21:01:08'),
(417, 289, 'Gas Detected', '2025-04-15 21:01:51'),
(418, 342, 'Gas Detected', '2025-04-15 21:02:05'),
(419, 477, 'Gas Detected', '2025-04-16 20:03:52'),
(420, 407, 'Gas Detected', '2025-04-16 20:04:03'),
(421, 210, 'Gas Detected', '2025-04-16 20:04:45'),
(423, 294, 'Gas Detected', '2025-04-16 20:05:41'),
(424, 453, 'Gas Detected', '2025-04-16 20:05:53'),
(425, 399, 'Gas Detected', '2025-04-16 20:06:54'),
(426, 361, 'Gas Detected', '2025-04-16 20:14:20'),
(428, 275, 'Gas Detected', '2025-04-16 20:15:18'),
(431, 469, 'Gas Detected', '2025-04-16 20:41:30'),
(433, 238, 'Gas Detected', '2025-04-16 20:42:20'),
(434, 229, 'Gas Detected', '2025-04-16 20:42:46'),
(438, 328, 'Gas Detected', '2025-04-16 20:44:36'),
(439, 319, 'Gas Detected', '2025-04-16 20:45:07'),
(441, 450, 'Gas Detected', '2025-04-16 20:48:12'),
(442, 219, 'Gas Detected', '2025-04-16 20:50:29'),
(443, 220, 'Gas Detected', '2025-04-16 20:53:31'),
(444, 324, 'Gas Detected', '2025-04-16 20:53:49'),
(446, 291, 'Gas Detected', '2025-04-16 20:55:02'),
(447, 227, 'Gas Detected', '2025-04-16 20:57:04'),
(448, 263, 'Gas Detected', '2025-04-16 20:59:21'),
(450, 484, 'Gas Detected', '2025-04-18 18:19:53'),
(451, 409, 'Gas Detected', '2025-04-18 18:20:03'),
(452, 401, 'Gas Detected', '2025-04-18 18:20:14'),
(453, 401, 'Gas Detected', '2025-04-18 18:20:27'),
(454, 398, 'Gas Detected', '2025-04-18 18:20:37'),
(455, 394, 'Gas Detected', '2025-04-18 18:20:48'),
(456, 396, 'Gas Detected', '2025-04-18 18:20:58'),
(457, 395, 'Gas Detected', '2025-04-18 18:21:08'),
(458, 453, 'Gas Detected', '2025-04-18 18:21:19'),
(459, 259, 'Gas Detected', '2025-04-18 18:21:59'),
(463, 482, 'Gas Detected', '2025-04-18 18:42:57'),
(464, 284, 'Gas Detected', '2025-04-18 18:43:33'),
(466, 412, 'Gas Detected', '2025-04-18 18:57:29'),
(468, 339, 'Gas Detected', '2025-04-18 19:10:11'),
(469, 317, 'Gas Detected', '2025-04-18 19:11:07'),
(471, 325, 'Gas Detected', '2025-04-18 19:16:40'),
(472, 281, 'Gas Detected', '2025-04-18 19:16:52'),
(473, 215, 'Gas Detected', '2025-04-18 19:24:30'),
(474, 240, 'Gas Detected', '2025-04-18 19:28:20'),
(475, 400, 'Gas Detected', '2025-04-18 19:28:32'),
(476, 364, 'Gas Detected', '2025-04-18 19:29:22'),
(477, 492, 'Gas Detected', '2025-04-18 19:29:37'),
(478, 265, 'Gas Detected', '2025-04-18 19:29:47'),
(480, 239, 'Gas Detected', '2025-04-18 19:32:03'),
(482, 235, 'Gas Detected', '2025-04-18 19:34:10'),
(483, 389, 'Gas Detected', '2025-04-18 19:34:26'),
(484, 395, 'Gas Detected', '2025-04-18 19:36:03'),
(486, 279, 'Gas Detected', '2025-04-18 19:38:14'),
(488, 210, 'Gas Detected', '2025-04-18 19:40:40'),
(489, 333, 'Gas Detected', '2025-04-18 19:43:29'),
(490, 392, 'Gas Detected', '2025-04-18 19:43:46'),
(491, 212, 'Gas Detected', '2025-04-18 19:44:00'),
(493, 471, 'Gas Detected', '2025-04-18 19:44:33'),
(495, 511, 'Gas Detected', '2025-04-19 20:53:44'),
(496, 413, 'Gas Detected', '2025-04-19 20:53:55'),
(497, 413, 'Gas Detected', '2025-04-19 20:54:08'),
(498, 405, 'Gas Detected', '2025-04-19 20:54:18'),
(499, 404, 'Gas Detected', '2025-04-19 20:54:31'),
(500, 394, 'Gas Detected', '2025-04-19 20:54:42'),
(501, 398, 'Gas Detected', '2025-04-19 20:54:52'),
(502, 411, 'Gas Detected', '2025-04-19 20:55:02'),
(503, 202, 'Gas Detected', '2025-04-19 20:56:01'),
(504, 299, 'Gas Detected', '2025-04-19 20:56:18'),
(505, 449, 'Gas Detected', '2025-04-19 20:56:36'),
(506, 296, 'Gas Detected', '2025-04-19 20:56:59'),
(507, 352, 'Gas Detected', '2025-04-19 20:57:19'),
(508, 300, 'Gas Detected', '2025-04-19 20:58:21'),
(509, 253, 'Gas Detected', '2025-04-19 20:59:02'),
(510, 291, 'Gas Detected', '2025-04-19 20:59:20'),
(511, 353, 'Gas Detected', '2025-04-19 20:59:40'),
(512, 263, 'Gas Detected', '2025-04-19 21:00:24'),
(513, 210, 'Gas Detected', '2025-04-19 21:00:39'),
(514, 508, 'Gas Detected', '2025-04-19 21:00:57'),
(515, 274, 'Gas Detected', '2025-04-19 21:03:36'),
(516, 574, 'Gas Detected', '2025-04-19 21:03:52'),
(517, 329, 'Gas Detected', '2025-04-19 21:04:12'),
(518, 356, 'Gas Detected', '2025-04-19 21:04:27'),
(519, 211, 'Gas Detected', '2025-04-19 21:06:53'),
(520, 204, 'Gas Detected', '2025-04-19 21:08:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gas_level`
--
ALTER TABLE `gas_level`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gas_level`
--
ALTER TABLE `gas_level`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=521;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
