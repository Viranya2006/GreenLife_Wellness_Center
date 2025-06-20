-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 18, 2025 at 08:54 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `greenlife_db`
--
CREATE DATABASE IF NOT EXISTS `greenlife_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `greenlife_db`;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE IF NOT EXISTS `appointments` (
  `appointment_id` int NOT NULL AUTO_INCREMENT,
  `client_id` int NOT NULL,
  `therapist_id` int NOT NULL,
  `service_id` int NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`appointment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `client_id`, `therapist_id`, `service_id`, `appointment_date`, `appointment_time`, `status`, `created_at`) VALUES
(17, 1, 28, 1, '2025-06-17', '22:55:00', 'cancelled', '2025-06-18 20:03:16'),
(16, 1, 28, 5, '2025-06-19', '01:29:00', 'confirmed', '2025-06-18 19:59:39'),
(15, 25, 27, 4, '2025-07-01', '10:00:00', 'pending', '2025-06-18 19:04:15'),
(14, 1, 3, 4, '2025-06-17', '12:31:00', 'confirmed', '2025-06-17 17:56:18');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

DROP TABLE IF EXISTS `inquiries`;
CREATE TABLE IF NOT EXISTS `inquiries` (
  `inquiry_id` int NOT NULL AUTO_INCREMENT,
  `client_name` varchar(100) NOT NULL,
  `client_email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `therapist_reply` text,
  `status` varchar(10) NOT NULL DEFAULT 'open',
  `submitted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`inquiry_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`inquiry_id`, `client_name`, `client_email`, `subject`, `message`, `therapist_reply`, `status`, `submitted_at`) VALUES
(11, 'Saman Kumara', 'samankumara@gmail.com', 'Question about Yoga classes', 'Hello, I would like to know the schedule for the evening yoga classes. Thank you.', 'Hello, I would like to know the schedule for the evening yoga classes. Thank you.', 'closed', '2025-06-17 17:45:12'),
(12, 'Saman Kumara', 'samankumara@gmail.com', 'Parking Information', 'Do you have dedicated parking available for clients?', 'Yes, we have a private parking area available for all our clients. It is located at the back of the building.', 'closed', '2025-06-17 17:56:58'),
(13, 'John Doe', 'john.doe@example.com', 'Query about Yoga Classes, Message', 'Can you provide more details on your beginner yoga classes?', NULL, 'open', '2025-06-18 19:17:11'),
(14, 'Saman Kumara', 'samankumara@gmail.com', 'Test Inquiry', 'Hey ! are you there', NULL, 'open', '2025-06-18 19:40:22');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `service_id` int NOT NULL AUTO_INCREMENT,
  `service_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) NOT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `description`, `image_path`) VALUES
(1, 'Nutrition and Diet Consultation', 'Personalized diet plans to help you achieve your health goals.\r\n\r\n', 'images/Nutrition and Diet Consultation.jpg'),
(2, 'Physiotherapy', 'Expert care to help you recover from injury and improve mobility.\r\n\r\n', 'images/Physiotherapy.jpg'),
(3, 'Yoga & Meditation', 'Find your inner peace and enhance your flexibility with our guided sessions.\r\n\r\n', 'images/Yoga & Meditation.jpg'),
(4, 'Ayurvedic Therapy	', 'Ancient healing traditions to restore your body\'s natural balance.\r\n\r\n', 'images/Ayurvedic Therapy.jpg'),
(5, 'Massage Therapy', 'Release tension and soothe your muscles with our range of therapeutic massages.\r\n\r\n', 'images/Massage Therapy.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'client',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`, `role`, `created_at`) VALUES
(30, 'Dr. Emily Watson', 'emily.white@greenlife.lk', '$2y$10$zQw0HaEeFX9YPrsTSg/khu1PdtYZs13TvPV1ojia9azvX47TRP8VC', 'therapist', '2025-06-18 20:15:09'),
(29, 'admin2', 'admin@greenlife.lk', '$2y$10$xfaSqOS7W7yKUjctWxSpMui4.S0.xqEYsMhY0NYdw8.ZWtKrsqDZi', 'admin', '2025-06-18 20:12:23'),
(25, 'John Doe', 'jonathan.doe@example.com', '$2y$10$e6s9dnED6quYMLYlSW6ncOYwVT1w7gBpaGmb3/gm/Bja3qFDP726e', 'client', '2025-06-18 17:35:10'),
(28, 'therapist', 'therapist@greenlife.lk', '$2y$10$InAVZL//94HYq5ba1x9HPuJ27y4dUr4eDehH/VnmDyc8lhPl3TTqS', 'therapist', '2025-06-18 19:57:15'),
(22, 'Dr. Anya Sharma', 'anyashrma@gmail.com', '$2y$10$Dy.WdUAHjcKY4THtEFqmcuAaw14SCmAHJ7lXz268a8U6/P7UDJjhq', 'therapist', '2025-06-17 18:01:05'),
(21, 'Dr. Adhithya Perera', 'adhithyaperera@gmail.com', '$2y$10$WtKCoQSdYe1fNgCL9PPg3uu2ZIzPhLGQt5V07QhFahjrlRBX1dPf6', 'therapist', '2025-06-17 17:54:53'),
(5, 'Admin', 'admin@gmail.com', '$2y$10$QPeEQ1rmUdJwGY3ySfJdLuPZUH8F4HxG8AWs/wqxnwdK5Xf5LDb6a', 'admin', '2025-06-17 17:52:46'),
(4, 'Dr. Kamal Rajapaksha', 'kamalrajapaksha@gmail.com', '$2y$10$A7/aohKSp33917ag4fZuNOuEs60oIyWKi/qJKkGr30fyhSWy6r62K', 'therapist', '2025-06-17 17:51:34'),
(3, 'Dr. Anura Perera', 'anuraperera@gmail.com', '$2y$10$7aBRI2WnG4L8KU9jGGp1H.8fqovD.tECha3uRVYMpXgcg89DikO.a', 'therapist', '2025-06-17 17:49:31'),
(2, 'Ms. Priya Silva', 'priyasilva@gmail.com', '$2y$10$xQoTDlZSzWjW.dBr7gGC/e2Nqd3lH1GWukFXVDk/6kN8hJI3paYJa', 'therapist', '2025-06-17 17:47:36'),
(1, 'Saman Kumara', 'samankumara@gmail.com', '$2y$10$j2wP9qUfurqk3fhP2.rNCeJKuz3NTjDS8MzCreB3uq3/ABOrAK8Je', 'client', '2025-06-17 17:38:02');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
