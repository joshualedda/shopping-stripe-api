-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 25, 2024 at 02:15 PM
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
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
CREATE TABLE IF NOT EXISTS `carts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(50, 3, 2, 1, '2024-03-22 11:53:49', NULL),
(48, 3, 1, 1, '2024-03-22 10:46:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `quantity`, `name`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, '', '', 0, '2024-03-25 19:02:09', NULL),
(2, 2, 1, 1, 'Chava', 'Nihil magni minima q', 0, '2024-03-25 19:03:19', NULL),
(3, 2, 1, 1, 'Wayne', 'Eligendi pariatur B', 0, '2024-03-25 19:18:24', NULL),
(4, 2, 1, 2, 'Darrel', 'Eiusmod distinctio ', 0, '2024-03-25 19:22:43', NULL),
(5, 2, 1, 1, 'Davis', 'Qui suscipit quos ni', 0, '2024-03-25 22:07:03', NULL),
(6, 2, 1, 1, 'Rafael', 'Consectetur duis qu', 0, '2024-03-25 22:14:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `subtotal` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 'Iphone', 'Iphone lorem ipsum', 500, 100, '2024-03-17 13:35:34', NULL),
(2, 2, 'Headphone', 'Headphone lorem', 200, 200, '2024-03-17 13:35:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Isaac', 'Hicks', 'zoliz@mailinator.com', '$2y$10$q4tGBYL0WViTQaUqOyqS3.rkqriVqZi7PTSxh3mT1WANh3y6sXvOS', '2024-03-17 15:11:46', NULL),
(2, 'Ferdinand', 'Christian', 'admin@gmail.com', '$2y$10$dtBLFkbs/XtglqbKtMhrTOgMm9JE3dejQCjwKFnAspYP6RRK2KIgG', '2024-03-17 15:13:10', NULL),
(3, 'Malik', 'Rosa', 'user@gmail.com', '$2y$10$bFstkIRFDxBgk/dQVywW6uwzRHEmrxyYHtUjPG5yqkB1rILzGtuvC', '2024-03-22 10:40:40', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
