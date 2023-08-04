-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2023 at 11:42 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homemadedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `m_id` int(11) NOT NULL,
  `r_id` int(11) NOT NULL,
  `m_name` varchar(255) NOT NULL,
  `m_price` int(11) NOT NULL,
  `m_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `sl_no` int(11) NOT NULL,
  `r_id` int(100) NOT NULL,
  `order_id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `user_id` int(100) NOT NULL,
  `order` varchar(2250) NOT NULL,
  `amount` int(5) NOT NULL,
  `address` varchar(625) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `payment` varchar(7) NOT NULL,
  `order_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`sl_no`, `r_id`, `order_id`, `name`, `user_id`, `order`, `amount`, `address`, `phone`, `payment`, `order_status`) VALUES
(1, 1, 61240, 'vimal', 13, 'food 2 - 1', 2, 'adsa', '2147483647', 'SUCCESS', 'Delivered'),
(2, 1, 61240, 'vimal', 13, 'food 2 - 1', 2, 'adsa', '7019242998', 'SUCCESS', 'Delivered'),
(3, 1, 28082, 'vimal', 13, 'menue name - 4', 3996, '', '7019242998', 'SUCCESS', 'Delivered'),
(4, 1, 28082, 'vimal', 13, 'menue name - 4', 3996, '', '7019242998', 'SUCCESS', 'Delivered'),
(5, 1, 37753, 'vimal', 13, 'menue name - 4', 3996, 'ddd', '7019242998', 'SUCCESS', 'Delivered'),
(6, 1, 52770, 'vimal', 20, 'menue name - 1', 999, 'asd', '7019242998', 'SUCCESS', 'Delivered'),
(7, 1, 92352, '', 0, 'new insert - 2', 456, 'qq', '7019242998', 'SUCCESS', 'Delivered'),
(8, 1, 65423, '', 0, 'asd - 2asd - 1new insert - 1new insert - 1', 591, 'xz', '7019242998', 'SUCCESS', 'Accecpted'),
(9, 1, 65423, '', 0, 'asd - 2asd - 1new insert - 1new insert - 1', 591, 'xz', '7019242998', 'SUCCESS', 'Accecpted'),
(10, 1, 65423, '', 0, 'asd - 2asd - 1new insert - 1new insert - 1', 591, 'xz', '7019242998', 'SUCCESS', 'Accecpted'),
(11, 1, 65423, '', 0, 'asd - 2asd - 1new insert - 1new insert - 1', 591, 'xz', '7019242998', 'SUCCESS', 'Accecpted'),
(12, 1, 33750, '', 0, 'asd - 1asd - 3new insert - 1new insert - 4', 1047, 'xcz', '7019242998', 'SUCCESS', 'Accecpted');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `r_id` int(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_email` varchar(255) NOT NULL,
  `p_about` varchar(2555) NOT NULL,
  `p_password` varchar(255) NOT NULL,
  `r_bg` varchar(9999) NOT NULL,
  `p_phone` varchar(255) NOT NULL,
  `p_image` varchar(999) NOT NULL,
  `r_name` varchar(255) NOT NULL,
  `r_rating` decimal(10,1) NOT NULL,
  `r_cuisine` varchar(255) NOT NULL,
  `reset_code` varchar(625) NOT NULL,
  `account_status` varchar(625) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`r_id`, `p_name`, `p_email`, `p_about`, `p_password`, `r_bg`, `p_phone`, `p_image`, `r_name`, `r_rating`, `r_cuisine`, `reset_code`, `account_status`) VALUES
(1, 'asdasd', 'vimalmurali03@gmail.com', 'asd', '$2y$10$2XhgS6HpziG92GhkqhtZT./ho1G5zQ6tUbtCTLycjc8XTDbRHKpJW', 'restaurant/cover/5.webp', '7019242998', 'restaurant/109758195.jpeg', 'asd', '0.0', 'asd', '$2y$10$JtSCKM1/2lKR1Tv/bNwERuXlkGq4jR9QDxA5epJgvUChPrl5ZwoZu', 'Not-Verified'),
(2, 'partner name', 'partner email', 'partner about', 'partner password', 'rest bg', 'partner phone', 'partner image', 'restaurant name', '5.0', 'restaurant cuisine', '', ''),
(3, 'asdasd', 'vimal00plus@gmail.com', 'asd', '$2y$10$qIg/NsN.InIcSHEzW2OV1.OopIYR9/7bYYnhDLiDQZ5nFOhPGtgfO', 'restaurant/cover/5.webp', '7019242998', 'restaurant/109758195.jpeg', 'asd', '0.0', 'asd', '0', 'Verified');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(625) NOT NULL,
  `phone` int(15) NOT NULL,
  `resetcode` varchar(695) NOT NULL,
  `account_status` varchar(15) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `phone`, `resetcode`, `account_status`, `date`) VALUES
(13, 'vimal', 'vimalmurali03@gmail.com', '$2y$10$oIAjA1QCZKDoIuWBnEseYebMLP15/rd3iH/KS5PCneydvdhN41aVS', 0, '0', 'Verified', '2023-08-02 14:33:05'),
(20, 'vimal', 'vimal00plus@gmail.com', '$2y$10$Dy4Zm1Xm09iILo9ZuwSNju/r2pLy8yKaZMkmH74hJu/MAa9d1z.mC', 0, '0', 'Verified', '2023-08-03 14:00:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
