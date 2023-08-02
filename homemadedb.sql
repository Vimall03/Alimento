-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2023 at 06:29 PM
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

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`m_id`, `r_id`, `m_name`, `m_price`, `m_type`) VALUES
(1, 1, 'menue name', 999, 'menue type'),
(2, 1, 'food 2', 2, 'food 2');

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
  `r_cuisine` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`r_id`, `p_name`, `p_email`, `p_about`, `p_password`, `r_bg`, `p_phone`, `p_image`, `r_name`, `r_rating`, `r_cuisine`) VALUES
(1, 'partner name', 'partner email', 'partner about', 'partner password', 'rest bg', 'partner phone', 'partner image', 'restaurant name', '5.0', 'restaurant cuisine');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `sl_no` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(625) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `resetcode` varchar(695) NOT NULL,
  `account_status` varchar(15) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`sl_no`, `name`, `email`, `password`, `phone`, `resetcode`, `account_status`, `date`) VALUES
(13, 'vimal', 'vimalmurali03@gmail.com', '$2y$10$oIAjA1QCZKDoIuWBnEseYebMLP15/rd3iH/KS5PCneydvdhN41aVS', '', '0', 'Verified', '2023-08-02 14:33:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`sl_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
