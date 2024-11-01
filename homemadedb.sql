-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2024 at 12:51 PM
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
(1, 2, 'Grilled Halloumi & Quinoa Salad', 160, 'Veg'),
(2, 2, 'Korean BBQ Chicken Tacos', 240, 'Non-Veg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `sl_no` int(11) NOT NULL,
  `r_id` int(100) NOT NULL,
  `order_id` int(10) NOT NULL,
  `dt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `name` varchar(20) NOT NULL,
  `user_id` int(100) NOT NULL,
  `order` varchar(2250) NOT NULL,
  `amount` int(5) NOT NULL,
  `address` varchar(625) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `payment` varchar(7) NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `rating` decimal(10,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`sl_no`, `r_id`, `order_id`, `dt`, `name`, `user_id`, `order`, `amount`, `address`, `phone`, `payment`, `order_status`, `rating`) VALUES
(1, 1, 1, '2024-10-12 16:02:25', 'test', 1, 'Veg Biryani', 200, 'Sfasfafasf', 'asfqwrq32ad', 'done', 'Delivered', 4.0),
(2, 2, 2, '2024-10-12 16:02:29', 'test', 1, 'Chicken Roasted Biryani', 300, 'fdgszdfcszdc', '3423423421', 'Done', 'Delivered', 5.0);

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
  `r_rating` varchar(3) NOT NULL,
  `r_cuisine` varchar(255) NOT NULL,
  `r_pincode` varchar(6) NOT NULL,
  `reset_code` varchar(625) NOT NULL,
  `account_status` varchar(625) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`r_id`, `p_name`, `p_email`, `p_about`, `p_password`, `r_bg`, `p_phone`, `p_image`, `r_name`, `r_rating`, `r_cuisine`, `r_pincode`, `reset_code`, `account_status`) VALUES
(2, 'Vendor Name', 'aftereditofficial@gmail.com', 'Eclipse Global Kitchen brings the world to your plate, blending the vibrant flavors of different cultures into one unforgettable dining experience. Our chefs expertly fuse elements from Asian, European, Latin American, and African cuisines, creating innovative dishes that celebrate global diversity. Whether you\'re craving a spicy street food-inspired dish or a sophisticated fusion of French and Japanese techniques, Eclipse offers a dynamic menu that evolves with the seasons and trends. Join us for a culinary journey around the globe, where every meal is an adventure.', '$2y$10$LQHI87mxEOgERMNJjR9zvuJuUcHbQjQ93qIpQmxhL0LwmXGazEkFu', 'restaurant/cover/img1.jpg', '8899889988', 'restaurant/img2.jpg', 'Eclipse Global Kitchen', '', 'Global Fusion Cuisine', '560016', '0', 'Verified');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `rid` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `review` varchar(30) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `order_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`rid`, `user_id`, `review`, `rating`, `order_id`) VALUES
(1, 1, 'Good', 4, 1),
(2, 1, 'Average', 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(625) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `resetcode` varchar(695) NOT NULL,
  `account_status` varchar(15) NOT NULL,
  `date` datetime NOT NULL,
  `address` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD UNIQUE KEY `rid` (`rid`);

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
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Table structure for table `user_points`
--
  
CREATE TABLE `user_points` (
  `user_id` int(11) NOT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`user_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Trigger to update points in `user_points` after an order is placed
  
DELIMITER $$
CREATE TRIGGER `award_points_after_order`
AFTER INSERT ON `orders`
FOR EACH ROW
BEGIN
  DECLARE points_earned INT;
  SET points_earned = NEW.amount DIV 10; -- Earn 1 point for every 10 units spent

  IF EXISTS (SELECT * FROM `user_points` WHERE `user_id` = NEW.user_id) THEN
    UPDATE `user_points`
    SET `points` = `points` + points_earned
    WHERE `user_id` = NEW.user_id;
  ELSE
    INSERT INTO `user_points` (`user_id`, `points`)
    VALUES (NEW.user_id, points_earned);
  END IF;
END$$
DELIMITER ;

  
