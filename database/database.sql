DROP DATABASE IF EXISTS `theshoesbox`;
CREATE DATABASE `theshoesbox`;
USE `theshoesbox`;

CREATE TABLE `users`
(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `phoneno` VARCHAR(10) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    `usertype` VARCHAR(20) DEFAULT "user" 
);

CREATE TABLE `category`
(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL
);

CREATE TABLE `brand`
(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL
);

CREATE TABLE `product`
(   
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `cat_id` INT NOT NULL,
    `brand_id` INT NOT NULL,
    `price` INT NOT NULL,
    `pro_img` VARCHAR(59) NOT NULL,
    `pro_details` VARCHAR (10000) NOT NULL,
    FOREIGN KEY (brand_id) REFERENCES brand(id),
    FOREIGN KEY (cat_id) REFERENCES category(id)
);

CREATE TABLE `cart`
(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL, 
    `product_id` INT NOT NULL,
    `quantity` INT NOT NULL,
    FOREIGN KEY (product_id) REFERENCES product(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE `addressdetails`
(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `pro_id` INT NOT NULL,
    `name` VARCHAR(50) NOT NULL,
    `address` VARCHAR(100) NOT NULL,
    `city` VARCHAR(50) NOT NULL,
    `state` VARCHAR(50) NOT NULL,
    `pincode` INT NOT NULL,
    `phoneno` INT NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    FOREIGN KEY (pro_id) REFERENCES product(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE `order`
(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `product_id` INT NOT NULL,
    `address_id` INT NOT NULL,
    `rate` INT NOT NULL,
    `pro_size` INT NOT NULL,
    `quantity` INT NOT NULL,
    `totalprice` INT NOT NULL,
    `status` VARCHAR(50) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES product(id),
    FOREIGN KEY (address_id) REFERENCES AddressDetails(id)
);

CREATE TABLE `contact`
(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(50) not NULL,
    `email` VARCHAR(50) NOT NULL,
    `subject` VARCHAR(50) NOT NULL,
    `message` VARCHAR(200) NOT NULL
);