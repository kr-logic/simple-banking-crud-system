-- ---------------------------------------------------------------
-- Author: Princzinger Krisztián
-- bank_db v1.0 for github.com/kr-logic/simple-banking-crud-system
-- ---------------------------------------------------------------

CREATE DATABASE IF NOT EXISTS bank_db;
USE bank_db;

-- ---------------------------------------------------------------
-- Table structure for table `accounts`
-- ---------------------------------------------------------------

DROP TABLE IF EXISTS `accounts`;

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(100) DEFAULT NULL,
  `balance` double DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ---------------------------------------------------------------
-- Dumping data for table `accounts`
-- ---------------------------------------------------------------

INSERT INTO `accounts` (`id`, `client_name`, `balance`) VALUES
(1, 'Teszt Elek', 1000000),
(2, 'Kovács Béla', 3000000),
(3, 'Nagy Géza', 750000),
(4, 'Gipsz Jakab', 950000),
(5, 'Kovács István', 1250000),
(6, 'Pénzes Lajos', 5000000);

-- ---------------------------------------------------------------
-- Table structure for table `users`
-- ---------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `registration_date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ---------------------------------------------------------------
-- Dumping data for table `users`
-- ---------------------------------------------------------------

INSERT INTO `users` (`id`, `username`, `password_hash`, `registration_date`) VALUES
(1, 'admin', '$2y$10$6B7P7diWSTz29bkdw0AguuSUvyXihe7bh7ame8ZgcRHH.cGLEU.GC', '2026-02-14 19:07:02');
