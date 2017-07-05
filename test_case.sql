-- Valentina Studio --
-- MySQL dump --
-- ---------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- ---------------------------------------------------------


-- CREATE TABLE "users" ------------------------------------
-- CREATE TABLE "users" ----------------------------------------
CREATE TABLE `users` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`email` VarChar( 128 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`first_name` VarChar( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`last_name` VarChar( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`country_id` Int( 11 ) NOT NULL,
	`city_id` Int( 11 ) NOT NULL,
	`register_date` DateTime NOT NULL,
	`register_ip` BigInt( 20 ) NULL,
	`sex` Enum( '0', '1', '2' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
	`dob` Date NOT NULL,
	`is_admin` TinyInt( 1 ) NOT NULL DEFAULT '0',
	`password` VarChar( 60 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 2;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE TABLE "sessions" ---------------------------------
-- CREATE TABLE "sessions" -------------------------------------
CREATE TABLE `sessions` ( 
	`id` VarChar( 128 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`ip_address` VarChar( 45 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`timestamp` Int( 10 ) UNSIGNED NOT NULL DEFAULT '0',
	`data` Blob NOT NULL )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE TABLE "users_sessions" ---------------------------
-- CREATE TABLE "users_sessions" -------------------------------
CREATE TABLE `users_sessions` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`user_id` Int( 11 ) NOT NULL,
	`hash` VarChar( 32 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`ip` BigInt( 20 ) NOT NULL,
	`user_agent` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`logged_in` DateTime NOT NULL,
	`last_visit` DateTime NOT NULL,
	`closed` TinyInt( 1 ) NOT NULL DEFAULT '0',
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 3;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE TABLE "users_stat" -------------------------------
-- CREATE TABLE "users_stat" -----------------------------------
CREATE TABLE `users_stat` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`user_id` Int( 11 ) NOT NULL,
	`date` Date NOT NULL,
	`visits` Int( 11 ) NOT NULL DEFAULT '1',
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 2;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE TABLE "countries" --------------------------------
-- CREATE TABLE "countries" ------------------------------------
CREATE TABLE `countries` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`name` VarChar( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 5;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE TABLE "cities" -----------------------------------
-- CREATE TABLE "cities" ---------------------------------------
CREATE TABLE `cities` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`country_id` Int( 11 ) NOT NULL,
	`name` VarChar( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 2;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- Dump data of "users" ------------------------------------
INSERT INTO `users`(`id`,`email`,`first_name`,`last_name`,`country_id`,`city_id`,`register_date`,`register_ip`,`sex`,`dob`,`is_admin`,`password`) VALUES 
( '1', 'admin@admin.com', 'Admin', 'Admin', '1', '1', '2017-07-05 00:00:00', '2130706433', '1', '1989-05-01', '1', '$2y$16$aoCdJmcAf9iPmeoJzXa5Y.G7pMA7cuZrylDfKJ1XvpQLTuyc78UjO' ),
( '2', 'test1@admin.com', 'Test', 'User 1', '1', '3', '2017-07-05 11:27:54', '2130706433', '2', '2002-03-17', '0', '$2y$16$NFx0SvqDqD3s7/UYRlOaKuSAsgXkr/DAMT5Y3s.IoI5P8EUPnF7s2' ),
( '3', 'test2@admin.com', 'Test', 'User 2', '1', '1', '2017-07-05 11:29:45', '2130706433', '1', '2001-07-15', '0', '$2y$16$ni7KZXSxdAYo7D1FZlDzAOmfNWzloEsm2hOUuPxsiE9sGcTV5My/i' ),
( '4', 'test3@admin.com', 'Test', 'User 3', '1', '3', '2017-07-05 11:30:47', '2130706433', '0', '2017-03-17', '0', '$2y$16$qW0H.cdRbcMI0/YPSE2LReML1H16tpsEuZ0sx6Q4o6IVaOlCBXjQK' ),
( '5', 'test4@admin.com', 'Test', 'User 4', '1', '1', '2017-06-03 11:29:45', '2130706433', '1', '2001-07-15', '0', '$2y$16$ni7KZXSxdAYo7D1FZlDzAOmfNWzloEsm2hOUuPxsiE9sGcTV5My/i' ),
( '6', 'test5@admin.com', 'Test', 'User 5', '2', '4', '2017-06-03 11:29:45', '2130706433', '1', '2001-07-15', '0', '$2y$16$ni7KZXSxdAYo7D1FZlDzAOmfNWzloEsm2hOUuPxsiE9sGcTV5My/i' ),
( '7', 'test6@admin.com', 'Test', 'User 6', '2', '4', '2017-06-03 11:29:45', '2130706433', '1', '2001-07-15', '0', '$2y$16$ni7KZXSxdAYo7D1FZlDzAOmfNWzloEsm2hOUuPxsiE9sGcTV5My/i' ),
( '8', 'test7@admin.com', 'Test', 'User 7', '2', '5', '2017-06-03 11:29:45', '2130706433', '2', '2001-07-15', '0', '$2y$16$ni7KZXSxdAYo7D1FZlDzAOmfNWzloEsm2hOUuPxsiE9sGcTV5My/i' ),
( '9', 'test8@admin.com', 'Test', 'User 8', '2', '6', '2017-06-03 11:29:45', '2130706433', '1', '2001-07-15', '0', '$2y$16$ni7KZXSxdAYo7D1FZlDzAOmfNWzloEsm2hOUuPxsiE9sGcTV5My/i' ),
( '10', 'test9@admin.com', 'Test', 'User 9', '2', '4', '2011-01-20 10:15:10', '2130706433', '1', '2001-07-15', '0', '$2y$16$ni7KZXSxdAYo7D1FZlDzAOmfNWzloEsm2hOUuPxsiE9sGcTV5My/i' ),
( '11', 'test10@admin.com', 'Test', 'User 10', '3', '7', '2011-01-20 10:15:10', '2130706433', '2', '2001-07-15', '0', '$2y$16$ni7KZXSxdAYo7D1FZlDzAOmfNWzloEsm2hOUuPxsiE9sGcTV5My/i' ),
( '12', 'test11@admin.com', 'Test', 'User 11', '3', '8', '2011-01-20 10:15:10', '2130706433', '1', '2001-07-15', '0', '$2y$16$ni7KZXSxdAYo7D1FZlDzAOmfNWzloEsm2hOUuPxsiE9sGcTV5My/i' ),
( '13', 'test12@admin.com', 'Test', 'User 12', '4', '10', '2017-05-05 11:29:45', '2130706433', '2', '2001-07-15', '0', '$2y$16$ni7KZXSxdAYo7D1FZlDzAOmfNWzloEsm2hOUuPxsiE9sGcTV5My/i' ),
( '14', 'test13@admin.com', 'Test', 'User 13', '4', '10', '2017-05-20 10:15:10', '2130706433', '1', '2001-07-15', '0', '$2y$16$ni7KZXSxdAYo7D1FZlDzAOmfNWzloEsm2hOUuPxsiE9sGcTV5My/i' ),
( '15', 'test14@admin.com', 'Test', 'User 14', '4', '11', '2017-05-20 10:15:10', '2130706433', '2', '2001-07-15', '0', '$2y$16$ni7KZXSxdAYo7D1FZlDzAOmfNWzloEsm2hOUuPxsiE9sGcTV5My/i' ),
( '16', 'test15@admin.com', 'Test', 'User 15', '4', '10', '2017-05-20 10:15:10', '2130706433', '1', '2001-07-15', '0', '$2y$16$ni7KZXSxdAYo7D1FZlDzAOmfNWzloEsm2hOUuPxsiE9sGcTV5My/i' );
-- ---------------------------------------------------------


-- Dump data of "sessions" ---------------------------------
-- ---------------------------------------------------------


-- Dump data of "users_sessions" ---------------------------
INSERT INTO `users_sessions`(`id`,`user_id`,`hash`,`ip`,`user_agent`,`logged_in`,`last_visit`,`closed`) VALUES 
( '2', '1', '61c48b73e758bcb3eb7220e76bf48888', '2130706433', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', '2017-07-05 10:06:58', '2017-07-05 10:35:45', '1' ),
( '3', '1', '3fe7082f31efc2466f084a7e940a9a0d', '2130706433', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', '2017-07-05 10:40:55', '2017-07-05 10:41:39', '1' ),
( '4', '1', 'f98d133c5d5a8ca62824a2559f7129d6', '2130706433', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', '2017-07-05 10:52:58', '2017-07-05 10:58:40', '1' ),
( '5', '1', 'b8499e0e659723520e389a1df2e8aaaa', '2130706433', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', '2017-07-05 10:59:15', '2017-07-05 11:09:11', '1' ),
( '6', '1', 'a97e3341a4a00370cee92e789df86705', '2130706433', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', '2017-07-05 11:09:26', '2017-07-05 12:32:28', '1' ),
( '7', '2', 'cfcbb8caad8559d97c27b312529a8efe', '2130706433', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', '2017-07-05 11:28:15', '2017-07-05 11:28:50', '1' );
-- ---------------------------------------------------------


-- Dump data of "users_stat" -------------------------------
INSERT INTO `users_stat`(`id`,`user_id`,`date`,`visits`) VALUES 
( '1', '1', '2017-07-05', '123' ),
( '2', '2', '2017-07-05', '4' );
-- ---------------------------------------------------------


-- Dump data of "countries" --------------------------------
INSERT INTO `countries`(`id`,`name`) VALUES 
( '1', 'Russia' ),
( '2', 'USA' ),
( '3', 'China' ),
( '4', 'Japan' );
-- ---------------------------------------------------------


-- Dump data of "cities" -----------------------------------
INSERT INTO `cities`(`id`,`country_id`,`name`) VALUES 
( '1', '1', 'Moscow' ),
( '2', '1', 'Chita' ),
( '3', '1', 'Orel' ),
( '4', '2', 'New York' ),
( '5', '2', 'Chicago' ),
( '6', '2', 'Las Vegas' ),
( '7', '3', 'Pekin' ),
( '8', '3', 'Hong-Kong' ),
( '9', '3', 'Manjuria' ),
( '10', '4', 'Tokio' ),
( '11', '5', 'Herosima' );
-- ---------------------------------------------------------


-- CREATE INDEX "ci_sessions_timestamp" --------------------
-- CREATE INDEX "ci_sessions_timestamp" ------------------------
CREATE INDEX `ci_sessions_timestamp` USING BTREE ON `sessions`( `timestamp` );
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE INDEX "uid" --------------------------------------
-- CREATE INDEX "uid" ------------------------------------------
CREATE INDEX `uid` USING BTREE ON `users_sessions`( `user_id` );
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE INDEX "lnk_countries_cities" ---------------------
-- CREATE INDEX "lnk_countries_cities" -------------------------
CREATE INDEX `lnk_countries_cities` USING BTREE ON `cities`( `country_id` );
-- -------------------------------------------------------------
-- ---------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


