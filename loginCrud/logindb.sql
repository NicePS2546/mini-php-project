-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2024 at 05:38 PM
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
-- Database: `logindb`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(9) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` tinytext NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` int(1) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `reg_date`) VALUES
(1, 'maoezx056', '$2y$10$uTVAy5tijFQh57UMmHZ46.vfAfsJCRX1JCtTK.NWtpRglFeZPjkwm', 'maoezxooo@gmail.com', 0, '2024-07-27 16:51:22'),
(3, 'maoezx056a', '$2y$10$SvtsCVgmrmcS3UBtvKKzrOoQp1VaoOEWNfdykrzxEKS/risqeBmG6', 'maoezxooo@gmail.com', 0, '2024-07-27 16:53:26'),
(4, 'maoezx0560', '$2y$10$Z9iV3CGsxFJH6kZBLsSFzO3bE49IbDry4VCH.gRd5I1IdHRCTNtyG', 'ejemplo@ejemplo.mx', 0, '2024-07-31 14:10:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
