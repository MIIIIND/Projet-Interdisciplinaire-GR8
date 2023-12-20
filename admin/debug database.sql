-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2023 at 01:27 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `1`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `author_user_id_Fk` int(11) DEFAULT NULL,
  `target_shop_Fk` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `score` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cottage`
--

CREATE TABLE `cottage` (
  `cottage_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `from_user_Fk` int(11) DEFAULT NULL,
  `to_user_Fk` int(11) DEFAULT NULL,
  `concerning_shop_Fk` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `product_Fk` int(11) DEFAULT NULL,
  `client_user_id_Fk` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `state_Fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `product_Fk`, `client_user_id_Fk`, `quantity`, `date`, `state_Fk`) VALUES
(1, 1, 1, 10, '2023-12-19 20:36:48', NULL),
(2, 2, 1, 20, '2023-12-20 01:06:51', NULL),
(3, 3, 1, 12, '2023-12-20 01:12:28', NULL),
(4, 4, 1, 21, '2023-12-20 01:12:28', NULL),
(5, 3, 1, 12, '2023-12-20 01:12:28', NULL),
(6, 4, 1, 21, '2023-12-20 01:12:28', NULL),
(7, 5, 1, 41, '2023-12-20 01:12:58', NULL),
(8, 6, 1, 52, '2023-12-20 01:12:58', NULL),
(9, 5, 1, 41, '2023-12-20 01:12:58', NULL),
(10, 6, 1, 52, '2023-12-20 01:12:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_state`
--

CREATE TABLE `order_state` (
  `order_state_id` int(11) NOT NULL,
  `state_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `Souvenir_name` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `shop_id_Fk` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `type_Fk` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `Souvenir_name`, `price`, `shop_id_Fk`, `image_url`, `type_Fk`, `description`) VALUES
(1, 'Souvenir1', 100, 1, 'url1', 1, 'description'),
(2, 'souverni2', 69, 2, 'a', 1, 'a'),
(3, 'souvernir3', 12, 1, '3', 1, 'a'),
(4, 'souvernir4', 12, 1, '3', 1, 'a'),
(5, 'souvernir5', 12, 1, '3', 1, 'a'),
(6, 'souvernir6', 12, 1, '3', 1, 'a');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `product_type_id` int(11) NOT NULL,
  `type_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`product_type_id`, `type_name`) VALUES
(1, 'producttype1');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `shop_id` int(11) NOT NULL,
  `shop_name` varchar(255) DEFAULT NULL,
  `shop_location` varchar(255) DEFAULT NULL,
  `manager_user_id_Fk` int(11) DEFAULT NULL,
  `opens_at` time DEFAULT NULL,
  `closes_at` time DEFAULT NULL,
  `shop_type_Fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`shop_id`, `shop_name`, `shop_location`, `manager_user_id_Fk`, `opens_at`, `closes_at`, `shop_type_Fk`) VALUES
(1, 'shop1', 'location1', 1, '08:00:00', '18:00:00', 1),
(2, 'shop2', 'location2', 1, '08:00:00', '18:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop_type`
--

CREATE TABLE `shop_type` (
  `shop_type_id` int(11) NOT NULL,
  `type_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop_type`
--

INSERT INTO `shop_type` (`shop_type_id`, `type_name`) VALUES
(1, 'shoptype1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `second_name` varchar(255) DEFAULT NULL,
  `role_Fk` int(11) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `password` char(40) DEFAULT NULL,
  `stays_at_Fk` int(11) DEFAULT NULL,
  `bill` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `second_name`, `role_Fk`, `login`, `password`, `stays_at_Fk`, `bill`) VALUES
(1, 'Marcin', 'Kulesza', 1, 'Marcin', 'Marcin', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `author_user_id_Fk` (`author_user_id_Fk`),
  ADD KEY `target_shop_Fk` (`target_shop_Fk`);

--
-- Indexes for table `cottage`
--
ALTER TABLE `cottage`
  ADD PRIMARY KEY (`cottage_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `from_user_Fk` (`from_user_Fk`),
  ADD KEY `to_user_Fk` (`to_user_Fk`),
  ADD KEY `concerning_shop_Fk` (`concerning_shop_Fk`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `product_Fk` (`product_Fk`),
  ADD KEY `client_user_id_Fk` (`client_user_id_Fk`),
  ADD KEY `state_Fk` (`state_Fk`);

--
-- Indexes for table `order_state`
--
ALTER TABLE `order_state`
  ADD PRIMARY KEY (`order_state_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `shop_id_Fk` (`shop_id_Fk`),
  ADD KEY `type_Fk` (`type_Fk`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`product_type_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`shop_id`),
  ADD KEY `manager_user_id_Fk` (`manager_user_id_Fk`),
  ADD KEY `shop_type_Fk` (`shop_type_Fk`);

--
-- Indexes for table `shop_type`
--
ALTER TABLE `shop_type`
  ADD PRIMARY KEY (`shop_type_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_Fk` (`role_Fk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cottage`
--
ALTER TABLE `cottage`
  MODIFY `cottage_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_state`
--
ALTER TABLE `order_state`
  MODIFY `order_state_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `product_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shop_type`
--
ALTER TABLE `shop_type`
  MODIFY `shop_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`author_user_id_Fk`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`target_shop_Fk`) REFERENCES `shop` (`shop_id`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`from_user_Fk`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`to_user_Fk`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `message_ibfk_3` FOREIGN KEY (`concerning_shop_Fk`) REFERENCES `shop` (`shop_id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`product_Fk`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`client_user_id_Fk`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`state_Fk`) REFERENCES `order_state` (`order_state_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`shop_id_Fk`) REFERENCES `shop` (`shop_id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`type_Fk`) REFERENCES `product_type` (`product_type_id`);

--
-- Constraints for table `shop`
--
ALTER TABLE `shop`
  ADD CONSTRAINT `shop_ibfk_1` FOREIGN KEY (`manager_user_id_Fk`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `shop_ibfk_2` FOREIGN KEY (`shop_type_Fk`) REFERENCES `shop_type` (`shop_type_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_Fk`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
