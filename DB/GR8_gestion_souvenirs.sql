CREATE TABLE `role` (
  `role_id` INT PRIMARY KEY AUTO_INCREMENT,
  `role_name` VARCHAR(255)
);

CREATE TABLE `user` (
  `user_id` INT PRIMARY KEY AUTO_INCREMENT,
  `first_name` VARCHAR(255),
  `second_name` VARCHAR(255),
  `role_Fk` INT,
  `login` VARCHAR(255),
  `password` CHAR(40),
  `stays_at_Fk` INT,
  `bill` INT,
  FOREIGN KEY (`role_Fk`) REFERENCES `role` (`role_id`)
);

CREATE TABLE `product_type` (
  `product_type_id` INT PRIMARY KEY AUTO_INCREMENT,
  `type_name` VARCHAR(255)
);

CREATE TABLE `shop_type` (
  `shop_type_id` INT PRIMARY KEY AUTO_INCREMENT,
  `type_name` VARCHAR(255)
);

CREATE TABLE `shop` (
  `shop_id` INT PRIMARY KEY AUTO_INCREMENT,
  `shop_name` VARCHAR(255),
  `shop_location` VARCHAR(255),
  `manager_user_id_Fk` INT,
  `opens_at` TIME,
  `closes_at` TIME,
  `shop_type_Fk` INT,
  FOREIGN KEY (`manager_user_id_Fk`) REFERENCES `user` (`user_id`),
  FOREIGN KEY (`shop_type_Fk`) REFERENCES `shop_type` (`shop_type_id`)
);

CREATE TABLE `product` (
  `product_id` INT PRIMARY KEY AUTO_INCREMENT,
  `Souvenir_name` VARCHAR(255),
  `price` FLOAT,
  `shop_id_Fk` INT,
  `image_url` VARCHAR(255),
  `type_Fk` INT,
  `description` TEXT,
  FOREIGN KEY (`shop_id_Fk`) REFERENCES `shop` (`shop_id`),
  FOREIGN KEY (`type_Fk`) REFERENCES `product_type` (`product_type_id`)
);

CREATE TABLE `order_state` (
  `order_state_id` INT PRIMARY KEY AUTO_INCREMENT,
  `state_name` VARCHAR(255)
);

CREATE TABLE `order` (
  `order_id` INT PRIMARY KEY AUTO_INCREMENT,
  `product_Fk` INT,
  `client_user_id_Fk` INT,
  `quantity` INT,
  `date` DATETIME,
  `state_Fk` INT,
  FOREIGN KEY (`product_Fk`) REFERENCES `product` (`product_id`),
  FOREIGN KEY (`client_user_id_Fk`) REFERENCES `user` (`user_id`),
  FOREIGN KEY (`state_Fk`) REFERENCES `order_state` (`order_state_id`)
);

CREATE TABLE `cottage` (
  `cottage_id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(255),
  `location` VARCHAR(255)
);

CREATE TABLE `comment` (
  `comment_id` INT PRIMARY KEY AUTO_INCREMENT,
  `author_user_id_Fk` INT,
  `target_shop_Fk` INT,
  `content` TEXT,
  `score` INT,
  FOREIGN KEY (`author_user_id_Fk`) REFERENCES `user` (`user_id`),
  FOREIGN KEY (`target_shop_Fk`) REFERENCES `shop` (`shop_id`)
);

CREATE TABLE `message` (
  `message_id` INT PRIMARY KEY AUTO_INCREMENT,
  `from_user_Fk` INT,
  `to_user_Fk` INT,
  `concerning_shop_Fk` INT,
  `content` TEXT,
  FOREIGN KEY (`from_user_Fk`) REFERENCES `user` (`user_id`),
  FOREIGN KEY (`to_user_Fk`) REFERENCES `user` (`user_id`),
  FOREIGN KEY (`concerning_shop_Fk`) REFERENCES `shop` (`shop_id`)
);
