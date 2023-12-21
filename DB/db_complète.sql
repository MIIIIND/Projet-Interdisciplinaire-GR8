-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 21, 2023 at 10:03 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grp8_gestion_souvenirs`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int NOT NULL,
  `author_user_id_Fk` int DEFAULT NULL,
  `target_shop_Fk` int DEFAULT NULL,
  `content` text,
  `score` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `author_user_id_Fk`, `target_shop_Fk`, `content`, `score`) VALUES
(1, 11, 1, 'J\'ai récemment visité ce magasin et l\'expérience a été décevante. Le personnel semblait désintéressé et peu serviable. Les produits étaient mal organisés, ce qui rendait difficile de trouver ce que je cherchais. ', 1),
(2, 12, 3, 'J\'ai eu une expérience exceptionnelle dans ce magasin ! Le personnel était incroyablement accueillant et serviable, toujours prêt à répondre à mes questions.', 4),
(3, 5, 4, 'Je recommande vivement ce magasin à tous ceux qui recherchent un excellent service, une sélection de produits de qualité, et une atmosphère agréable.\"', 4);

-- --------------------------------------------------------

--
-- Table structure for table `cottage`
--

CREATE TABLE `cottage` (
  `cottage_id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cottage`
--

INSERT INTO `cottage` (`cottage_id`, `name`, `location`) VALUES
(1, 'Étoile d\'Azur', 'cote d\'azur'),
(2, 'Oasis Royal', 'La Reunion'),
(3, 'Lumière Urbaine', 'Mons'),
(4, 'Mirage d\'Or', 'Namur'),
(5, 'Ciel Étoilé', 'bruxelles'),
(6, 'bureau', 'parc');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int NOT NULL,
  `from_user_Fk` int DEFAULT NULL,
  `to_user_Fk` int DEFAULT NULL,
  `concerning_shop_Fk` int DEFAULT NULL,
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `from_user_Fk`, `to_user_Fk`, `concerning_shop_Fk`, `content`) VALUES
(1, 10, 8, 3, 'je n\'est pas reçu mon colis '),
(2, 5, 2, 4, 'je n\'est pas vu un jouets dans le magasin qui pourtant y était dans le catalogue ');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int NOT NULL,
  `product_Fk` int DEFAULT NULL,
  `client_user_id_Fk` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `state_Fk` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `product_Fk`, `client_user_id_Fk`, `quantity`, `date`, `state_Fk`) VALUES
(1, 5, 10, 1, '2023-12-28 10:39:06', 3),
(2, 1, 5, 2, '2023-12-25 10:39:58', 2),
(3, 3, 7, 1, '2023-12-29 10:40:29', 3);

-- --------------------------------------------------------

--
-- Table structure for table `order_state`
--

CREATE TABLE `order_state` (
  `order_state_id` int NOT NULL,
  `state_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_state`
--

INSERT INTO `order_state` (`order_state_id`, `state_name`) VALUES
(1, 'commande reçu'),
(2, 'commande prête'),
(3, 'commande en livraison'),
(4, 'commande livrer');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int NOT NULL,
  `Souvenir_name` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `shop_id_Fk` int DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `type_Fk` int DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `Souvenir_name`, `price`, `shop_id_Fk`, `image_url`, `type_Fk`, `description`) VALUES
(1, 'Ourson en peluche géant ', 49.99, 2, 'remplissage', 1, 'une peluche géante '),
(2, 'Coffret de chocolats fins artisanaux', 24.99, 4, 'remplissage', 2, 'boite de chocolat'),
(3, ' Écharpe en laine tricotée à la main', 34.99, 4, 'remplissage', 3, 'une écharpe'),
(4, 'Puzzle en bois ', 19.99, 3, 'remplissage', 5, 'jouets éducatif pour enfants'),
(5, 'Palette de fards à paupières naturels', 29.99, 1, 'remplissage', 4, 'produit de beauté ');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `product_type_id` int NOT NULL,
  `type_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`product_type_id`, `type_name`) VALUES
(1, 'peluche'),
(2, 'alimentaire'),
(3, 'vêtement'),
(4, 'produit de beauté'),
(5, 'Jouets');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int NOT NULL,
  `role_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(0, 'administrateur'),
(1, 'moérateur'),
(2, 'client');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `shop_id` int NOT NULL,
  `shop_name` varchar(255) DEFAULT NULL,
  `shop_location` varchar(255) DEFAULT NULL,
  `manager_user_id_Fk` int DEFAULT NULL,
  `opens_at` time DEFAULT NULL,
  `closes_at` time DEFAULT NULL,
  `shop_type_Fk` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`shop_id`, `shop_name`, `shop_location`, `manager_user_id_Fk`, `opens_at`, `closes_at`, `shop_type_Fk`) VALUES
(1, 'L\'Arc-en-Shop', 'La Reunion', 4, '08:00:05', '19:00:00', 5),
(2, 'Épicurien Express', 'cote d\'azur', 6, '08:00:05', '19:00:00', 2),
(3, 'TechDream Emporium', 'bruxelles', 8, '08:00:05', '19:00:00', 3),
(4, 'Zénithal Gourmand', 'Namur', 2, '08:00:05', '19:00:00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `shop_type`
--

CREATE TABLE `shop_type` (
  `shop_type_id` int NOT NULL,
  `type_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shop_type`
--

INSERT INTO `shop_type` (`shop_type_id`, `type_name`) VALUES
(1, 'forêt'),
(2, 'ciel\r\n'),
(3, 'mer'),
(4, 'terre\r\n'),
(5, 'décoration');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `second_name` varchar(255) DEFAULT NULL,
  `role_Fk` int DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `password` char(40) DEFAULT NULL,
  `stays_at_Fk` int DEFAULT NULL,
  `bill` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `second_name`, `role_Fk`, `login`, `password`, `stays_at_Fk`, `bill`) VALUES
(1, 'Nicolas', 'FORIEZ ', 0, 'Nicolas', '74dad9e7c8500a7fd750ba478263f5956dc3dee9', 6, 0),
(2, 'Alexandre', 'MARCEL', 1, 'Alexandre', '74dad9e7c8500a7fd750ba478263f5956dc3dee9', 6, 0),
(3, 'Thomas', 'VENTURINI ', 0, 'Thomas', '74dad9e7c8500a7fd750ba478263f5956dc3dee9', 6, 0),
(4, 'Marcin', 'KULESZA ', 1, 'Marcin', '74dad9e7c8500a7fd750ba478263f5956dc3dee9', 6, 0),
(5, 'Leandro', 'SPINOSI', 2, 'Leandro', '74dad9e7c8500a7fd750ba478263f5956dc3dee9', 1, 0),
(6, 'Camille', 'Lefevre', 1, 'Camille', '74dad9e7c8500a7fd750ba478263f5956dc3dee9', 6, 0),
(7, 'Antoine', 'Dubois', 0, 'Antoine', '74dad9e7c8500a7fd750ba478263f5956dc3dee9', 6, 0),
(8, 'Elodie', 'Renaud', 1, 'Elodie', '74dad9e7c8500a7fd750ba478263f5956dc3dee9', 6, 0),
(9, 'Julien', 'Leroy', 2, 'Julien', '74dad9e7c8500a7fd750ba478263f5956dc3dee9', 2, 0),
(10, 'Laura', 'Girard', 2, 'Laura', '74dad9e7c8500a7fd750ba478263f5956dc3dee9', 1, 0),
(11, 'Lucas', 'Dupont', 2, 'Lucas', '74dad9e7c8500a7fd750ba478263f5956dc3dee9', 3, 0),
(12, 'Emma', 'Lefevre', 2, 'Emma', '74dad9e7c8500a7fd750ba478263f5956dc3dee9', 2, 0);

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
  MODIFY `comment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cottage`
--
ALTER TABLE `cottage`
  MODIFY `cottage_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_state`
--
ALTER TABLE `order_state`
  MODIFY `order_state_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `product_type_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `shop_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shop_type`
--
ALTER TABLE `shop_type`
  MODIFY `shop_type_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
