-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 24, 2024 at 03:45 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newssystem2`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` int NOT NULL,
  `word` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `word`) VALUES
(1, 'សាឡាៗ', 'អូឡាៗ', 'NeathNea@gmail.com', 987654321, 'Your news page look so unique for me i like this website very much.');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
CREATE TABLE IF NOT EXISTS `favorites` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `word` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `profile` varchar(200) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint DEFAULT NULL,
  `admin_id` int NOT NULL,
  `updated-at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `profile`, `title`, `text`, `status`, `admin_id`, `updated-at`, `created_at`) VALUES
(15, '3b39c934678f3cb08b471640cf34b4a7.jpg', '123', 'Everyone was enjoyed this movie very much we rate for this 10/10.123', NULL, 5, '2024-05-20 02:27:52', '2024-05-20 07:23:04'),
(21, 'a5b75ee18f0e474f72b911792fe1c8c1.jpg', 'Kpop Star', 'Kimingyu is a korea popstar that make carat fall in love with.', NULL, 1, '2024-05-17 09:09:08', '2024-05-20 07:23:04'),
(23, 'photo_2024-03-19_16-05-46.jpg', 'Dear my lovely crush', 'We will be in love when i confess to you.', NULL, 1, '2024-05-20 02:39:14', '2024-05-20 07:23:04'),
(24, 'PONYO_SPOTLIGHT_A.webp', 'Ponyo', 'Pink Ponyo ', NULL, 1, '2024-05-20 07:20:34', '2024-05-20 07:23:04'),
(25, '9f85f2f585c27a80dcb203ca0f68e297.jpg', 'Khmer new year', 'New year is a khmer new years that we banh terk or pat msao', NULL, 1, '2024-05-20 08:13:30', '2024-05-20 08:13:30'),
(26, 'HD-wallpaper-ghibli-anime-studio-ghibli.jpg', 'Ghibli Studio', 'Hello my love', NULL, 1, '2024-05-20 08:37:55', '2024-05-20 08:37:55'),
(27, '360_F_707997132_h9rk10J5SHfOMMJ9jp2iTBywIwGccKfj (1).jpg', 'hkkjkj', 'nj kjkl', NULL, 1, '2024-05-21 03:20:37', '2024-05-21 03:20:37'),
(28, 'admin.jpg', 'uuuuuu', 'uuuut', NULL, 1, '2024-05-21 03:39:45', '2024-05-21 03:39:45'),
(29, '432640198_1073053157068111_1038108692511602190_n.jpg', 'happy new year', 'happy new year', NULL, 1, '2024-05-21 07:29:53', '2024-05-21 07:29:53'),
(30, 'HD-wallpaper-ghibli-anime-studio-ghibli.jpg', 'qwer', 'rty', NULL, 1, '2024-05-21 07:55:41', '2024-05-21 07:55:41'),
(31, 'Screenshot 2024-04-05 094816.png', 'iiiifdg', '6yhmujnb bn', NULL, 1, '2024-05-21 08:04:39', '2024-05-21 08:04:39'),
(32, 'MV5BYzJjMTYyMjQtZDI0My00ZjE2LTkyNGYtOTllNGQxNDMyZjE0XkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_.jpg', 'w', 'sfg', NULL, 1, '2024-05-21 08:16:23', '2024-05-21 08:16:23'),
(33, '360_F_621352080_jICjI2k8cA2tlkkvFXIPU0IHJmKGehvW.jpg', 'uu', 'uu', NULL, 1, '2024-05-21 08:52:15', '2024-05-21 08:52:15'),
(34, 'Screenshot 2024-03-29 170034.png', 'wra', 'gfr', NULL, 1, '2024-05-23 03:52:39', '2024-05-22 17:00:00'),
(35, 'Screenshot_20221123_084013.png', '4rfzCXD', 'rz3ec5y', NULL, 1, '2024-05-23 03:58:51', '2024-05-23 03:58:51'),
(36, 'Screenshot 2024-03-29 165451.png', 'hhh', 'kihygnikdegfnnnnsdfnhvghtsdfvgjhhrghukyhmjdchfn mjutyr5edhjbkytretszvgbhkjut76r5e4xdhjkloiuy7t6r5et4wasrdtfyuiopi9u85re4wsdfghjkl;p\'oiuytresgcnvmhjvgfvjlkbhjvgfdtreyguijoklp;\'kmvghfrydetdhyuijolkmnmbgtfrthytjgyhuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuyt5re4srdxfcgvbhjkhuygtf', NULL, 1, '2024-06-03 02:26:22', '2024-06-03 02:26:22'),
(38, '360_F_707974495_ai9oocf1IvUTvWReyZpWvygWYJgjkZ7G.jpg', 'Khmer game', 'This khmer game we always play on khmer new year.', NULL, 1, '2024-06-24 03:18:28', '2024-06-24 03:18:28');

-- --------------------------------------------------------

--
-- Table structure for table `registered`
--

DROP TABLE IF EXISTS `registered`;
CREATE TABLE IF NOT EXISTS `registered` (
  `id` int NOT NULL AUTO_INCREMENT,
  `profile` varchar(100) DEFAULT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `contact` varchar(45) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `role` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `registered`
--

INSERT INTO `registered` (`id`, `profile`, `firstname`, `lastname`, `email`, `dob`, `password`, `contact`, `gender`, `role`, `created_at`) VALUES
(1, 'admin.jpg', 'Neath', 'Neath', 'Neath@gmail.com', '2024-06-24 00:00:00', '$2y$10$scyou8DwFQPToYuBMBuYuuE.F2h5Uks54XYT4uiEfGVI7qlDWFX6e', '0987654320', 'female', 'admin', '2024-06-24 02:24:09'),
(2, 'a5b75ee18f0e474f72b911792fe1c8c1.jpg', 'Neath', 'Nea', 'NeathNea@gmail.com', '2024-06-24 00:00:00', '$2y$10$9girnJ/wMlaHFSXW2FrBsexwmMXr4FF5eumBK3N27p9Ymu1IpOuoK', '0987654321', 'male', 'user', '2024-06-24 02:26:03');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
