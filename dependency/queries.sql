/*Creating the database umms*/
CREATE DATABASE IF NOT EXISTS umms;


/*Creating the users table*/
CREATE TABLE `umms`.`users` (
 `id` INT NOT NULL AUTO_INCREMENT ,
 `username` VARCHAR(60) NOT NULL , 
 `email` VARCHAR(60) NOT NULL , 
 `password` VARCHAR(32) NOT NULL ,
 `password_change` VARCHAR(30) NOT NULL DEFAULT 'Never' ,
 `role` VARCHAR(10) NOT NULL , 
 PRIMARY KEY (`id`)
);

/*Creating the ordinary user*/
INSERT INTO `umms`.`users` (`id`, `username`, `password`, `role`) 
VALUES (NULL, 'ucsc', 'ucsc', 'ordinary');

/*Creating the admin user*/
INSERT INTO `umms`.`users` (`id`, `username`, `password`, `role`) 
VALUES (NULL, 'admin', 'admin', 'admin');

/*Creating the delivery user*/
INSERT INTO `umms`.`users` (`id`, `username`, `password`, `role`) 
VALUES (NULL, 'deliver', 'deliver', 'delivery');


CREATE TABLE `umms`. `materials` (
  `material_id` INT NOT NULL AUTO_INCREMENT ,
  `category_id` INT NOT NULL ,
  `material_name` VARCHAR(60) NOT NULL ,
  `buy_price` INT NOT NULL , 
  `price` INT NOT NULL ,
  `added_date` DATE NOT NULL , 
  `quantity` INT NOT NULL,
  `img_ext` VARCHAR(6) NOT NULL,
  PRIMARY KEY (`material_id`)
);

CREATE TABLE `umms`.`material_category` (
 `category_id` INT NOT NULL AUTO_INCREMENT ,
 `category_name` VARCHAR(60) NOT NULL ,
 `quantity_all` INT NOT NULL , 
 `unit` VARCHAR(10) NOT NULL ,
 `extension` VARCHAR(6) NOT NULL, 
 PRIMARY KEY (`category_id`)
);

CREATE TABLE `umms`.`orders` (
  `order_id` INT NOT NULL AUTO_INCREMENT , 
  `customer_id` INT NOT NULL , 
  `customer_name` VARCHAR(100) NOT NULL, 
  `material_id` INT NOT NULL , 
  `phone` VARCHAR(20) NOT NULL , 
  `email` VARCHAR(60) NOT NULL ,
  `address` VARCHAR(100) NOT NULL,
  `quantity` INT NOT NULL , 
  `sent` VARCHAR(6) NOT NULL DEFAULT 'NO' , 
  `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
  PRIMARY KEY (`order_id`)
);

CREATE TABLE `umms`.`messages` (
  `msg_id` INT NOT NULL AUTO_INCREMENT , 
  `user_id` INT NOT NULL , 
  `name` VARCHAR(30) NOT NULL , 
  `email` VARCHAR(60) NOT NULL , 
  `message` VARCHAR(2000) NOT NULL , 
  `answered` BOOLEAN NOT NULL DEFAULT FALSE ,
  PRIMARY KEY (`msg_id`)
);

CREATE TABLE `umms`.`delete_log` (`delete_id` INT NOT NULL AUTO_INCREMENT , 
 `user_id` INT NOT NULL , 
 `reason` VARCHAR(200) NOT NULL , 
 `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
 PRIMARY KEY (`delete_id`)
); 
    