-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2023 at 03:23 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms-example`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_posts`
--

CREATE TABLE `db_posts` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `contact` varchar(191) NOT NULL,
  `image` varchar(255) NOT NULL,
  `op` int(11) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `db_posts`
--

INSERT INTO `db_posts` (`id`, `title`, `content`, `contact`, `image`, `op`, `date_posted`) VALUES
(18, 'This is an example post', 'This is an example post which contains and image', 'martinhutch1@gmail.com', 'image_64753da774404_1685405095.PNG', 5, '2023-05-30 00:09:52'),
(20, 'djaidnan', 'asjsdnajd a asds ada dada', 'martinhutch1@gmail.com', 'image_647541c63731a_1685406150.gif', 5, '2023-05-30 00:22:30'),
(21, 'Post with breaks', 'THis is a post\r\n\r\nAnd I leftr some breaks behind\r\n\r\nwill it work???? YeShjghjkgbbhjk', 'martinhutch1@gmail.com', 'image_64754fc6ac1c1_1685409734.jpeg', 5, '2023-05-30 01:22:14');

-- --------------------------------------------------------

--
-- Table structure for table `db_user`
--

CREATE TABLE `db_user` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_me` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `db_user`
--

INSERT INTO `db_user` (`id`, `name`, `email`, `password`, `remember_me`, `status`, `created_at`) VALUES
(1, 'Ilori Stephen A', 'stephenilori458@gmail.com', '$2y$10$ToVd7fYSm8ufLlD4S6nHH.nbnDEwOoWsQ2Th1VGIw0S33auYxVE2q', NULL, 1, '2020-05-06 23:12:38'),
(2, '83289jdjds', 'stephenilori458@gmail.com', '$2y$10$3DzZwbF/rBY9DjhbyzayZOqe.2cGIXpNziE23BlhdU3C2zTKSvmpC', NULL, 1, '2020-05-06 23:23:54'),
(3, '87567hj', 'stephenilori458@gmail.com', '$2y$10$dWgg98rdx5sIAzzLra3MXu4WRdvpLtmqPX9Rux5b/bDMGeRY2Nqdq', NULL, 1, '2020-05-06 23:27:01'),
(4, '87656', 'stephenilori458@gmail.com', '$2y$10$0ILrTll7TdZoHPT.Qr/HbObf7xFpMYQzT1mnP1k4myC.nmJZhO2U6', NULL, 1, '2020-05-06 23:27:31'),
(5, 'Martin Hutchings', 'martinhutch1@gmail.com', '$2y$10$DO2NSaIe3a.QZZiYePSQ.ef.jkTDnUrFShMwLwlybui8jQ/dhsrwG', NULL, 1, '2023-05-29 15:30:42'),
(6, 'Jasmin Fischli', 'jasmin@fisch.io', '$2y$10$y1yzdnHU.7BWlOvTDGqhqe./pAIvAG.x0nN/HIRDs4MkhuZSVAo8a', NULL, 1, '2023-05-29 15:40:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_posts`
--
ALTER TABLE `db_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `op` (`op`);

--
-- Indexes for table `db_user`
--
ALTER TABLE `db_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `db_posts`
--
ALTER TABLE `db_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `db_user`
--
ALTER TABLE `db_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `db_posts`
--
ALTER TABLE `db_posts`
  ADD CONSTRAINT `db_posts_ibfk_1` FOREIGN KEY (`op`) REFERENCES `db_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
