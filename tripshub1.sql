-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2026 at 02:49 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tripshub1`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `trip_id` bigint(20) UNSIGNED NOT NULL,
  `number_of_seats` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_status` varchar(30) NOT NULL DEFAULT 'paid',
  `payment_method` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `trip_id`, `number_of_seats`, `total_price`, `payment_status`, `payment_method`, `created_at`, `updated_at`) VALUES
(3, 8, 6, 3, 114.00, 'paid', NULL, '2026-05-27 21:35:39', '2026-05-27 21:35:39'),
(4, 6, 1, 1, 33.25, 'paid', NULL, '2026-05-27 21:35:39', '2026-05-27 21:35:39'),
(5, 7, 2, 2, 47.50, 'paid', NULL, '2026-05-27 21:35:39', '2026-05-27 21:35:39'),
(6, 13, 7, 1, 19.00, 'paid', 'visa', '2026-05-27 23:08:09', '2026-05-27 23:08:09'),
(9, 13, 7, 2, 38.00, 'paid', 'visa', '2026-05-28 02:06:29', '2026-05-28 02:06:29'),
(11, 13, 7, 2, 38.00, 'paid', 'visa', '2026-05-28 02:12:10', '2026-05-28 02:12:10'),
(12, 6, 7, 1, 19.00, 'paid', 'visa', '2026-05-29 20:35:55', '2026-05-29 20:35:55'),
(13, 6, 7, 1, 19.00, 'paid', 'visa', '2026-05-31 21:09:35', '2026-05-31 21:09:35'),
(14, 6, 7, 1, 19.00, 'paid', 'visa', '2026-05-31 21:09:42', '2026-05-31 21:09:42'),
(15, 6, 7, 1, 19.00, 'paid', 'visa', '2026-05-31 21:09:48', '2026-05-31 21:09:48'),
(16, 6, 7, 1, 19.00, 'paid', 'visa', '2026-05-31 23:36:47', '2026-05-31 23:36:47'),
(17, 6, 7, 1, 19.00, 'paid', 'visa', '2026-05-31 23:38:34', '2026-05-31 23:38:34'),
(18, 6, 7, 1, 19.00, 'paid', 'visa', '2026-05-31 23:38:51', '2026-05-31 23:38:51'),
(19, 6, 7, 1, 19.00, 'paid', 'visa', '2026-05-31 23:38:56', '2026-05-31 23:38:56'),
(20, 6, 7, 1, 19.00, 'paid', 'visa', '2026-05-31 23:39:02', '2026-05-31 23:39:02'),
(21, 6, 3, 1, 32.55, 'paid', 'sham_cash', '2026-06-01 17:56:17', '2026-06-01 17:56:17'),
(22, 13, 7, 2, 38.00, 'paid', 'visa', '2026-06-02 07:56:48', '2026-06-02 07:56:48'),
(23, 16, 7, 3, 57.00, 'paid', 'visa', '2026-06-06 08:23:04', '2026-06-06 08:23:04'),
(24, 16, 7, 2, 38.00, 'paid', 'visa', '2026-06-06 09:25:59', '2026-06-06 09:25:59'),
(25, 16, 7, 2, 38.00, 'paid', 'visa', '2026-06-12 19:00:17', '2026-06-12 19:00:17'),
(26, 16, 7, 1, 19.00, 'paid', 'visa', '2026-06-12 19:16:08', '2026-06-12 19:16:08'),
(27, 16, 3, 1, 32.55, 'paid', 'visa', '2026-06-13 09:10:25', '2026-06-13 09:10:25'),
(28, 16, 1, 1, 33.25, 'paid', 'visa', '2026-06-27 18:46:09', '2026-06-27 18:46:09'),
(29, 16, 7, 1, 19.00, 'paid', 'visa', '2026-06-27 19:49:45', '2026-06-27 19:49:45'),
(30, 16, 7, 1, 19.00, 'paid', 'visa', '2026-06-27 19:50:19', '2026-06-27 19:50:19'),
(31, 16, 7, 1, 19.00, 'paid', 'visa', '2026-06-27 19:52:09', '2026-06-27 19:52:09'),
(32, 13, 1, 1, 33.25, 'paid', NULL, '2026-05-27 23:00:00', '2026-05-27 23:00:00'),
(33, 13, 3, 1, 32.55, 'paid', NULL, '2026-05-27 23:05:00', '2026-05-27 23:05:00'),
(34, 8, 1, 1, 33.25, 'paid', NULL, '2026-05-27 23:10:00', '2026-05-27 23:10:00'),
(35, 8, 3, 1, 32.55, 'paid', NULL, '2026-05-27 23:15:00', '2026-05-27 23:15:00'),
(36, 8, 7, 1, 19.00, 'paid', NULL, '2026-05-27 23:20:00', '2026-05-27 23:20:00'),
(37, 8, 1, 10, 332.50, 'paid', 'visa', '2026-07-12 15:35:53', '2026-07-12 15:35:53'),
(38, 8, 2, 9, 213.75, 'paid', 'visa', '2026-07-12 15:37:44', '2026-07-12 15:37:44'),
(39, 6, 2, 1, 23.75, 'paid', NULL, '2026-05-31 21:00:00', '2026-05-31 21:00:00'),
(40, 16, 2, 1, 23.75, 'paid', NULL, '2026-05-31 21:00:00', '2026-05-31 21:00:00'),
(41, 13, 2, 1, 23.75, 'paid', NULL, '2026-05-31 21:00:00', '2026-05-31 21:00:00'),
(42, 8, 2, 1, 23.75, 'paid', NULL, '2026-05-31 21:00:00', '2026-05-31 21:00:00'),
(43, 13, 4, 3, 128.25, 'paid', 'visa', '2026-07-15 06:01:21', '2026-07-15 06:01:21'),
(44, 13, 7, 1, 19.00, 'paid', 'visa', '2026-07-15 07:17:55', '2026-07-15 07:17:55'),
(45, 13, 7, 1, 19.00, 'paid', 'visa', '2026-07-15 07:18:34', '2026-07-15 07:18:34'),
(46, 16, 4, 1, 42.75, 'paid', 'visa', '2026-07-17 22:21:56', '2026-07-17 22:21:56');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('trips-hub-cache-jawad.sandouk.03@gmail.com0|127.0.0.1', 'i:1;', 1781086939),
('trips-hub-cache-jawad.sandouk.03@gmail.com0|127.0.0.1:timer', 'i:1781086939;', 1781086939),
('trips-hub-cache-sedra@trips.com|127.0.0.1', 'i:1;', 1781283759),
('trips-hub-cache-sedra@trips.com|127.0.0.1:timer', 'i:1781283759;', 1781283759);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"58fad411-0ceb-4597-a0c3-52d4ee287bc5\",\"displayName\":\"App\\\\Mail\\\\BookingTicketMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:26:\\\"App\\\\Mail\\\\BookingTicketMail\\\":5:{s:7:\\\"booking\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Booking\\\";s:2:\\\"id\\\";i:6;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"payment\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Payment\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:11:\\\"ticketEmail\\\";s:26:\\\"jawad.sandouk.03@gmail.com\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:26:\\\"jawad.sandouk.03@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"},\"createdAt\":1779934089,\"delay\":null}', 0, NULL, 1779934089, 1779934089),
(2, 'default', '{\"uuid\":\"dfd5559d-3297-47a4-979b-1ffbedc1e051\",\"displayName\":\"App\\\\Mail\\\\BookingTicketMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:26:\\\"App\\\\Mail\\\\BookingTicketMail\\\":5:{s:7:\\\"booking\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Booking\\\";s:2:\\\"id\\\";i:6;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"payment\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Payment\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:11:\\\"ticketEmail\\\";s:26:\\\"jawad.sandouk.03@gmail.com\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:26:\\\"jawad.sandouk.03@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"},\"createdAt\":1779934089,\"delay\":null}', 0, NULL, 1779934089, 1779934089),
(3, 'default', '{\"uuid\":\"d720863d-d8e7-4906-bb65-0abaef7819c4\",\"displayName\":\"App\\\\Mail\\\\BookingTicketMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:26:\\\"App\\\\Mail\\\\BookingTicketMail\\\":5:{s:7:\\\"booking\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Booking\\\";s:2:\\\"id\\\";i:7;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"payment\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Payment\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:11:\\\"ticketEmail\\\";s:26:\\\"jawad.sandouk.03@gmail.com\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:26:\\\"jawad.sandouk.03@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"},\"createdAt\":1779934155,\"delay\":null}', 0, NULL, 1779934155, 1779934155),
(4, 'default', '{\"uuid\":\"2733cdfc-34ec-4d90-8f81-3b1ce09a9946\",\"displayName\":\"App\\\\Mail\\\\BookingTicketMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:26:\\\"App\\\\Mail\\\\BookingTicketMail\\\":5:{s:7:\\\"booking\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Booking\\\";s:2:\\\"id\\\";i:7;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"payment\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Payment\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:11:\\\"ticketEmail\\\";s:26:\\\"jawad.sandouk.03@gmail.com\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:26:\\\"jawad.sandouk.03@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"},\"createdAt\":1779934155,\"delay\":null}', 0, NULL, 1779934155, 1779934155),
(5, 'default', '{\"uuid\":\"9c673e53-64fc-44cb-b42c-995f539eea04\",\"displayName\":\"App\\\\Mail\\\\BookingTicketMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:26:\\\"App\\\\Mail\\\\BookingTicketMail\\\":5:{s:7:\\\"booking\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Booking\\\";s:2:\\\"id\\\";i:8;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"payment\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Payment\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:11:\\\"ticketEmail\\\";s:26:\\\"jawad.sandouk.03@gmail.com\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:26:\\\"jawad.sandouk.03@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"},\"createdAt\":1779934263,\"delay\":null}', 0, NULL, 1779934263, 1779934263),
(6, 'default', '{\"uuid\":\"5277cf2b-9350-4988-abde-4cd49369ecc2\",\"displayName\":\"App\\\\Mail\\\\BookingTicketMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:26:\\\"App\\\\Mail\\\\BookingTicketMail\\\":5:{s:7:\\\"booking\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Booking\\\";s:2:\\\"id\\\";i:8;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"payment\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Payment\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:11:\\\"ticketEmail\\\";s:26:\\\"jawad.sandouk.03@gmail.com\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:26:\\\"jawad.sandouk.03@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"},\"createdAt\":1779934263,\"delay\":null}', 0, NULL, 1779934263, 1779934263),
(7, 'default', '{\"uuid\":\"eef9dca2-6087-4447-b6ed-22993583cf35\",\"displayName\":\"App\\\\Mail\\\\BookingTicketMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:26:\\\"App\\\\Mail\\\\BookingTicketMail\\\":5:{s:7:\\\"booking\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Booking\\\";s:2:\\\"id\\\";i:9;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"payment\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Payment\\\";s:2:\\\"id\\\";i:4;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:11:\\\"ticketEmail\\\";s:26:\\\"jawad.sandouk.03@gmail.com\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:26:\\\"jawad.sandouk.03@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"},\"createdAt\":1779944789,\"delay\":null}', 0, NULL, 1779944789, 1779944789),
(8, 'default', '{\"uuid\":\"5b08f5d0-e762-4c74-b750-e4b49bf20b94\",\"displayName\":\"App\\\\Mail\\\\BookingTicketMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:26:\\\"App\\\\Mail\\\\BookingTicketMail\\\":5:{s:7:\\\"booking\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Booking\\\";s:2:\\\"id\\\";i:9;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"payment\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Payment\\\";s:2:\\\"id\\\";i:4;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:11:\\\"ticketEmail\\\";s:26:\\\"jawad.sandouk.03@gmail.com\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:26:\\\"jawad.sandouk.03@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"},\"createdAt\":1779944789,\"delay\":null}', 0, NULL, 1779944789, 1779944789),
(9, 'default', '{\"uuid\":\"7309f84d-a6dc-47a4-a670-940774a3bfb4\",\"displayName\":\"App\\\\Mail\\\\BookingTicketMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:26:\\\"App\\\\Mail\\\\BookingTicketMail\\\":5:{s:7:\\\"booking\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Booking\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"payment\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Payment\\\";s:2:\\\"id\\\";i:5;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:11:\\\"ticketEmail\\\";s:20:\\\"tripshub26@gmail.com\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:20:\\\"tripshub26@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"},\"createdAt\":1779944872,\"delay\":null}', 0, NULL, 1779944872, 1779944872),
(10, 'default', '{\"uuid\":\"f5859c9d-7e21-4d80-a094-5fa32a428f7c\",\"displayName\":\"App\\\\Mail\\\\BookingTicketMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:26:\\\"App\\\\Mail\\\\BookingTicketMail\\\":5:{s:7:\\\"booking\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Booking\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"payment\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Payment\\\";s:2:\\\"id\\\";i:5;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:11:\\\"ticketEmail\\\";s:20:\\\"tripshub26@gmail.com\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:20:\\\"tripshub26@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"},\"createdAt\":1779944872,\"delay\":null}', 0, NULL, 1779944872, 1779944872);

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_13_220700_create_trips_table', 1),
(5, '2026_04_24_024638_create_bookings_table', 1),
(6, '2026_04_26_000001_create_ratings_table', 1),
(7, '2026_05_03_104733_add_translations_to_trips_table', 1),
(8, '2026_05_25_000001_create_payments_table', 1),
(9, '2026_05_26_000001_add_area_serviced_to_trips_table', 1),
(10, '2026_05_27_000001_create_trip_stops_table', 1),
(11, '2026_05_27_190648_add_language_fields_to_trip_stops_table', 1),
(12, '2026_05_27_203712_add_phone_fields_to_users_table', 1),
(13, '2026_05_27_212023_update_user_roles_for_owner', 1),
(14, '2026_05_27_212035_add_paused_to_trips_status_enum', 1),
(15, '2026_05_27_232542_add_is_paused_to_users_table', 1),
(16, '2026_05_28_005512_rename_phone_columns_in_users_table', 2),
(17, '2026_05_28_013330_create_settings_table', 3),
(18, '2026_05_28_013331_add_discount_to_users_table', 3),
(19, '2026_05_28_023937_add_points_to_users_table', 4),
(20, '2026_05_28_023938_create_point_transactions_table', 4),
(21, '2026_05_28_044210_add_lat_lng_to_trips_and_stops', 5),
(22, '2026_06_04_012704_add_office_discount_to_trips_table', 6),
(23, '2026_06_05_213159_create_trip_images_table', 7),
(24, '2026_06_05_213159_create_trip_stop_images_table', 7),
(25, '2026_06_06_020704_create_office_registration_requests_table', 8),
(26, '2026_06_20_001841_create_office_deletion_requests_table', 9),
(27, '2026_06_27_072028_set_default_payment_status_to_paid', 9),
(28, '2026_06_27_101133_create_withdrawal_requests_table', 9),
(29, '2026_06_27_102259_add_payment_details_to_withdrawal_requests_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `office_deletion_requests`
--

CREATE TABLE `office_deletion_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `office_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `num1` varchar(255) DEFAULT NULL,
  `num2` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `office_registration_requests`
--

CREATE TABLE `office_registration_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `office_name` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `num1` varchar(255) NOT NULL,
  `num2` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `office_registration_requests`
--

INSERT INTO `office_registration_requests` (`id`, `office_name`, `contact_person`, `email`, `num1`, `num2`, `latitude`, `longitude`, `address`, `notes`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Name Office T', 'flan', 'officea@gmail.com', '0966666666', '0955555555', NULL, NULL, 'جانب فلافل ابو سمير', 'انو يعني هيك بمعية الشباب تضيفولنا هالحساب', 'approved', '2026-06-05 23:36:30', '2026-06-05 23:43:38'),
(2, 'sm', 'sedra', 'soso@gmail.com', '0933333333', '0311111111', '33.5137305', '36.3151916', 'قدام كذا', 'ويعني هيك', 'approved', '2026-06-06 04:50:08', '2026-06-06 04:52:25');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('Ali@user.com', '$2y$12$LxRK155mar166Wl1nWNPkOcHRZUu9gtoFoQaZTDnh59farJgZ8HYy', '2026-05-30 21:20:09'),
('jawad.sandouk.03@gmail.com', '$2y$12$APXf08FT5FVUWF3j6qfkhOVsixs5srURO2mRgXZwiJEKBRlp.X4IO', '2026-05-30 21:22:50');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(100) DEFAULT NULL,
  `payment_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payment_data`)),
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `booking_id`, `user_id`, `amount`, `payment_method`, `status`, `transaction_id`, `payment_data`, `paid_at`, `created_at`, `updated_at`) VALUES
(1, 6, 13, 28.50, 'visa', 'completed', 'VIS-6a17a389d843b', '{\"phone\":null,\"card_number\":\"2000 0000 0000 0000\",\"expiry\":\"04\\/26\",\"cardholder_name\":\"SEDRA SAWAN\",\"masked_card\":\"****0000\",\"ticket_email\":\"jawad.sandouk.03@gmail.com\"}', '2026-05-27 23:08:09', '2026-05-27 23:08:09', '2026-05-27 23:08:09'),
(4, 9, 13, 57.00, 'visa', 'completed', 'VIS-6a17cd55b18a9', '{\"phone\":null,\"card_number\":\"2000 0000 0000 0000\",\"expiry\":\"12\\/26\",\"cardholder_name\":\"SEDRA SAWAN\",\"masked_card\":\"****0000\",\"ticket_email\":\"jawad.sandouk.03@gmail.com\"}', '2026-05-28 02:06:29', '2026-05-28 02:06:29', '2026-05-28 02:06:29'),
(6, 11, 13, 57.00, 'visa', 'completed', 'VIS-6a17ceaade109', '{\"phone\":null,\"card_number\":\"2000 0000 0000 0000\",\"expiry\":\"12\\/26\",\"cardholder_name\":\"SEDRA SAWAN\",\"masked_card\":\"****0000\",\"ticket_email\":\"jawad.sandouk.03@gmail.com\"}', '2026-05-28 02:12:10', '2026-05-28 02:12:10', '2026-05-28 02:12:10'),
(7, 12, 6, 28.50, 'visa', 'completed', 'VIS-6a1a22db462fa', '{\"phone\":null,\"card_number\":\"2000 0000 0000 0000\",\"expiry\":\"12\\/26\",\"cardholder_name\":\"ALI\",\"masked_card\":\"****0000\",\"ticket_email\":\"ali4sandouk7@gmail.com\"}', '2026-05-29 20:35:55', '2026-05-29 20:35:55', '2026-05-29 20:35:55'),
(8, 13, 6, 28.50, 'visa', 'completed', 'VIS-6a1ccdbf2d0d2', '{\"phone\":null,\"card_number\":\"2000 0000 0000 0000\",\"expiry\":\"12\\/26\",\"cardholder_name\":\"A\",\"masked_card\":\"****0000\",\"ticket_email\":\"Ali@user.com\"}', '2026-05-31 21:09:35', '2026-05-31 21:09:35', '2026-05-31 21:09:35'),
(9, 14, 6, 28.50, 'visa', 'completed', 'VIS-6a1ccdc680381', '{\"phone\":null,\"card_number\":\"2000 0000 0000 0000\",\"expiry\":\"12\\/26\",\"cardholder_name\":\"A\",\"masked_card\":\"****0000\",\"ticket_email\":\"Ali@user.com\"}', '2026-05-31 21:09:42', '2026-05-31 21:09:42', '2026-05-31 21:09:42'),
(10, 15, 6, 28.50, 'visa', 'completed', 'VIS-6a1ccdcc48fae', '{\"phone\":null,\"card_number\":\"2000 0000 0000 0000\",\"expiry\":\"12\\/26\",\"cardholder_name\":\"A\",\"masked_card\":\"****0000\",\"ticket_email\":\"Ali@user.com\"}', '2026-05-31 21:09:48', '2026-05-31 21:09:48', '2026-05-31 21:09:48'),
(11, 16, 6, 28.50, 'visa', 'completed', 'VIS-6a1cf03f973f8', '{\"phone\":null,\"card_number\":\"2000 0000 0000 0000\",\"expiry\":\"12\\/26\",\"cardholder_name\":\"\\u062a\",\"masked_card\":\"****0000\",\"ticket_email\":\"Ali@user.com\"}', '2026-05-31 23:36:47', '2026-05-31 23:36:47', '2026-05-31 23:36:47'),
(12, 17, 6, 28.50, 'visa', 'completed', 'VIS-6a1cf0aa3fe87', '{\"phone\":null,\"card_number\":\"2000 0000 0000 0000\",\"expiry\":\"12\\/26\",\"cardholder_name\":\"\\u062a\",\"masked_card\":\"****0000\",\"ticket_email\":\"Ali@user.com\"}', '2026-05-31 23:38:34', '2026-05-31 23:38:34', '2026-05-31 23:38:34'),
(13, 18, 6, 28.50, 'visa', 'completed', 'VIS-6a1cf0bb9c4aa', '{\"phone\":null,\"card_number\":\"2000 0000 0000 0000\",\"expiry\":\"12\\/26\",\"cardholder_name\":\"\\u062a\",\"masked_card\":\"****0000\",\"ticket_email\":\"Ali@user.com\"}', '2026-05-31 23:38:51', '2026-05-31 23:38:51', '2026-05-31 23:38:51'),
(14, 19, 6, 28.50, 'visa', 'completed', 'VIS-6a1cf0c091581', '{\"phone\":null,\"card_number\":\"2000 0000 0000 0000\",\"expiry\":\"12\\/26\",\"cardholder_name\":\"\\u062a\",\"masked_card\":\"****0000\",\"ticket_email\":\"Ali@user.com\"}', '2026-05-31 23:38:56', '2026-05-31 23:38:56', '2026-05-31 23:38:56'),
(15, 20, 6, 28.50, 'visa', 'completed', 'VIS-6a1cf0c6734dc', '{\"phone\":null,\"card_number\":\"2000 0000 0000 0000\",\"expiry\":\"12\\/26\",\"cardholder_name\":\"\\u062a\",\"masked_card\":\"****0000\",\"ticket_email\":\"Ali@user.com\"}', '2026-05-31 23:39:02', '2026-05-31 23:39:02', '2026-05-31 23:39:02'),
(16, 21, 6, 27.90, 'sham_cash', 'completed', 'SHM-6a1df1f1204be', '{\"phone\":\"0947336860\",\"card_number\":null,\"expiry\":null,\"cardholder_name\":null,\"masked_card\":null,\"ticket_email\":\"jawad.sandouk.03@gmail.com\"}', '2026-06-01 17:56:17', '2026-06-01 17:56:17', '2026-06-01 17:56:17'),
(17, 22, 13, 57.00, 'visa', 'completed', 'VIS-6a1eb6f069d0a', '{\"phone\":null,\"card_number\":\"2500 0000 0000 0000\",\"expiry\":\"12\\/26\",\"cardholder_name\":\"SEDRA SAWAN\",\"masked_card\":\"****0000\",\"ticket_email\":\"sawansoso881@gmail.com\"}', '2026-06-02 07:56:48', '2026-06-02 07:56:48', '2026-06-02 07:56:48'),
(18, 23, 16, 85.50, 'visa', 'completed', 'VIS-6a24031899651', '{\"phone\":null,\"card_number\":\"2000 0000 0000 0000\",\"expiry\":\"12\\/26\",\"cardholder_name\":\"SEDRA SAWAN\",\"masked_card\":\"****0000\",\"ticket_email\":\"jawad.sandouk.03@gmail.com\"}', '2026-06-06 08:23:04', '2026-06-06 08:23:04', '2026-06-06 08:23:04'),
(19, 24, 16, 57.00, 'visa', 'completed', 'VIS-6a2411d74daa6', '{\"phone\":null,\"card_number\":\"2000 0000 0000 0000\",\"expiry\":\"12\\/26\",\"cardholder_name\":\"SEDRA SAWAN\",\"masked_card\":\"****0000\",\"ticket_email\":\"jawad.sandouk.03@gmail.com\"}', '2026-06-06 09:25:59', '2026-06-06 09:25:59', '2026-06-06 09:25:59'),
(20, 25, 16, 57.00, 'visa', 'completed', 'VIS-6a2c8171db6ce', '{\"phone\":null,\"card_number\":\"2222 2222 2222 2222\",\"expiry\":\"12\\/26\",\"cardholder_name\":\"SEDRA SAWAN\",\"masked_card\":\"****2222\",\"ticket_email\":\"jawad.sandouk.03@gmail.com\"}', '2026-06-12 19:00:17', '2026-06-12 19:00:17', '2026-06-12 19:00:17'),
(21, 26, 16, 28.50, 'visa', 'completed', 'VIS-6a2c852810e0e', '{\"phone\":null,\"card_number\":\"2000 0000 0000 0000\",\"expiry\":\"12\\/26\",\"cardholder_name\":\"SEDRA SAWAN\",\"masked_card\":\"****0000\",\"ticket_email\":\"jawad.sandouk.03@gmail.com\"}', '2026-06-12 19:16:08', '2026-06-12 19:16:08', '2026-06-12 19:16:08'),
(22, 27, 16, 27.90, 'visa', 'completed', 'VIS-6a2d48b1df5dd', '{\"phone\":null,\"card_number\":\"2000 0000 0000 0000\",\"expiry\":\"12\\/26\",\"cardholder_name\":\"SEDRA SAWAN\",\"masked_card\":\"****0000\",\"ticket_email\":\"jawad.sandouk.03@gmail.com\"}', '2026-06-13 09:10:25', '2026-06-13 09:10:25', '2026-06-13 09:10:25'),
(23, 28, 16, 23.75, 'visa', 'completed', 'VIS-6a4044a1413d8', '{\"phone\":null,\"card_number\":\"2222 2222 2222 2222\",\"expiry\":\"12\\/26\",\"cardholder_name\":\"JAWAD\",\"masked_card\":\"****2222\",\"ticket_email\":\"jawad.sandouk.03@gmail.com\"}', '2026-06-27 18:46:09', '2026-06-27 18:46:09', '2026-06-27 18:46:09'),
(24, 29, 16, 28.50, 'visa', 'completed', 'VIS-6a405389076c0', '{\"phone\":null,\"card_number\":\"1111 1111 1111 1111\",\"expiry\":\"12\\/26\",\"cardholder_name\":\"JAWAD\",\"masked_card\":\"****1111\",\"ticket_email\":\"jawad.sandouk.03@gmail.com\"}', '2026-06-27 19:49:45', '2026-06-27 19:49:45', '2026-06-27 19:49:45'),
(25, 30, 16, 28.50, 'visa', 'completed', 'VIS-6a4053abb1ef2', '{\"phone\":null,\"card_number\":\"1111 1111 1111 1111\",\"expiry\":\"12\\/26\",\"cardholder_name\":\"JAWAD\",\"masked_card\":\"****1111\",\"ticket_email\":\"nsandook@gmail.com\"}', '2026-06-27 19:50:19', '2026-06-27 19:50:19', '2026-06-27 19:50:19'),
(26, 31, 16, 28.50, 'visa', 'completed', 'VIS-6a405419538c4', '{\"phone\":null,\"card_number\":\"2222 2222 2222 2222\",\"expiry\":\"12\\/22\",\"cardholder_name\":\"JAWAD\",\"masked_card\":\"****2222\",\"ticket_email\":\"nsandook@gmail.com\"}', '2026-06-27 19:52:09', '2026-06-27 19:52:09', '2026-06-27 19:52:09'),
(27, 37, 8, 237.50, 'visa', 'completed', 'VIS-6a53de898df75', '{\"phone\":null,\"card_number\":\"1111 1111 1111 1111\",\"expiry\":\"12\\/26\",\"cardholder_name\":\"JAWAD\",\"masked_card\":\"****1111\",\"ticket_email\":\"Noor@user.com\"}', '2026-07-12 15:35:53', '2026-07-12 15:35:53', '2026-07-12 15:35:53'),
(28, 38, 8, 299.25, 'visa', 'completed', 'VIS-6a53def8cc018', '{\"phone\":null,\"card_number\":\"5555 5555 5555 5555\",\"expiry\":\"12\\/26\",\"cardholder_name\":\"SEDRA SAWAN\",\"masked_card\":\"****5555\",\"ticket_email\":\"Noor@user.com\"}', '2026-07-12 15:37:44', '2026-07-12 15:37:44', '2026-07-12 15:37:44'),
(29, 43, 13, 128.25, 'visa', 'completed', 'VIS-6a574c61a5ad6', '{\"phone\":null,\"card_number\":\"2000 0000 0000 0000\",\"expiry\":\"12\\/22\",\"cardholder_name\":\"SEDRA SAWAN\",\"masked_card\":\"****0000\",\"ticket_email\":\"sawansoso881@gmail.com\"}', '2026-07-15 06:01:21', '2026-07-15 06:01:21', '2026-07-15 06:01:21'),
(30, 44, 13, 19.00, 'visa', 'completed', 'VIS-6a575e53539dd', '{\"phone\":null,\"card_number\":\"2122 2222 2222 2222\",\"expiry\":\"12\\/26\",\"cardholder_name\":\"SEDRA SAWAN\",\"masked_card\":\"****2222\",\"ticket_email\":\"sawansoso881@gmail.com\"}', '2026-07-15 07:17:55', '2026-07-15 07:17:55', '2026-07-15 07:17:55'),
(31, 45, 13, 19.00, 'visa', 'completed', 'VIS-6a575e7a44a4b', '{\"phone\":null,\"card_number\":\"2122 2222 2222 2222\",\"expiry\":\"12\\/26\",\"cardholder_name\":\"SEDRA SAWAN\",\"masked_card\":\"****2222\",\"ticket_email\":\"jawad.sandouk.03@gmail.com\"}', '2026-07-15 07:18:34', '2026-07-15 07:18:34', '2026-07-15 07:18:34'),
(32, 46, 16, 42.75, 'visa', 'completed', 'VIS-6a5ad534b596b', '{\"phone\":null,\"card_number\":\"5555 5555 5555 5555\",\"expiry\":\"12\\/26\",\"cardholder_name\":\"SEDRA SAWAN\",\"masked_card\":\"****5555\",\"ticket_email\":\"jawad.sandouk.03@gmail.com\"}', '2026-07-17 22:21:56', '2026-07-17 22:21:56', '2026-07-17 22:21:56');

-- --------------------------------------------------------

--
-- Table structure for table `point_transactions`
--

CREATE TABLE `point_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `points` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `booking_id` bigint(20) UNSIGNED DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `point_transactions`
--

INSERT INTO `point_transactions` (`id`, `user_id`, `points`, `type`, `booking_id`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 13, 2, 'earned', 9, '2026-08-28 02:06:29', '2026-05-28 02:06:29', '2026-05-28 02:06:29'),
(2, 13, 2, 'earned', NULL, '2026-08-28 02:07:52', '2026-05-28 02:07:52', '2026-05-28 02:07:52'),
(3, 13, -2, 'expired', NULL, NULL, '2026-05-28 02:11:19', '2026-05-28 02:11:19'),
(4, 13, 2, 'earned', 11, '2026-08-28 02:12:10', '2026-05-28 02:12:10', '2026-05-28 02:12:10'),
(5, 6, 1, 'earned', 12, '2026-08-29 20:35:55', '2026-05-29 20:35:55', '2026-05-29 20:35:55'),
(6, 6, 1, 'earned', 13, '2026-08-31 21:09:35', '2026-05-31 21:09:35', '2026-05-31 21:09:35'),
(7, 6, 1, 'earned', 14, '2026-08-31 21:09:42', '2026-05-31 21:09:42', '2026-05-31 21:09:42'),
(8, 6, 1, 'earned', 15, '2026-08-31 21:09:48', '2026-05-31 21:09:48', '2026-05-31 21:09:48'),
(9, 6, 1, 'earned', 16, '2026-08-31 23:36:47', '2026-05-31 23:36:47', '2026-05-31 23:36:47'),
(10, 6, 1, 'earned', 17, '2026-08-31 23:38:34', '2026-05-31 23:38:34', '2026-05-31 23:38:34'),
(11, 6, 1, 'earned', 18, '2026-08-31 23:38:51', '2026-05-31 23:38:51', '2026-05-31 23:38:51'),
(12, 6, 1, 'earned', 19, '2026-08-31 23:38:56', '2026-05-31 23:38:56', '2026-05-31 23:38:56'),
(13, 6, 1, 'earned', 20, '2026-08-31 23:39:02', '2026-05-31 23:39:02', '2026-05-31 23:39:02'),
(14, 6, 1, 'earned', 21, '2026-09-01 17:56:17', '2026-06-01 17:56:17', '2026-06-01 17:56:17'),
(15, 13, 2, 'earned', 22, '2026-09-02 07:56:48', '2026-06-02 07:56:48', '2026-06-02 07:56:48'),
(16, 16, 3, 'earned', 23, '2026-09-06 08:23:04', '2026-06-06 08:23:04', '2026-06-06 08:23:04'),
(17, 16, 2, 'earned', 24, '2026-09-06 09:25:59', '2026-06-06 09:25:59', '2026-06-06 09:25:59'),
(18, 16, 2, 'earned', 25, '2026-09-12 19:00:17', '2026-06-12 19:00:17', '2026-06-12 19:00:17'),
(19, 16, 1, 'earned', 26, '2026-09-12 19:16:08', '2026-06-12 19:16:08', '2026-06-12 19:16:08'),
(20, 16, 1, 'earned', 27, '2026-09-13 09:10:25', '2026-06-13 09:10:25', '2026-06-13 09:10:25'),
(21, 16, 1, 'earned', 28, '2026-09-27 18:46:09', '2026-06-27 18:46:09', '2026-06-27 18:46:09'),
(22, 16, 1, 'earned', 29, '2026-09-27 19:49:45', '2026-06-27 19:49:45', '2026-06-27 19:49:45'),
(23, 16, 1, 'earned', 30, '2026-09-27 19:50:19', '2026-06-27 19:50:19', '2026-06-27 19:50:19'),
(24, 16, 1, 'earned', 31, '2026-09-27 19:52:09', '2026-06-27 19:52:09', '2026-06-27 19:52:09'),
(25, 8, 10, 'earned', 37, '2026-10-12 15:35:53', '2026-07-12 15:35:53', '2026-07-12 15:35:53'),
(26, 8, 9, 'earned', 38, '2026-10-12 15:37:44', '2026-07-12 15:37:44', '2026-07-12 15:37:44'),
(27, 13, 3, 'earned', 43, '2026-10-15 06:01:21', '2026-07-15 06:01:21', '2026-07-15 06:01:21'),
(28, 13, 1, 'earned', 44, '2026-10-15 07:17:55', '2026-07-15 07:17:55', '2026-07-15 07:17:55'),
(29, 13, 1, 'earned', 45, '2026-10-15 07:18:34', '2026-07-15 07:18:34', '2026-07-15 07:18:34'),
(30, 16, 1, 'earned', 46, '2026-10-17 22:21:56', '2026-07-17 22:21:56', '2026-07-17 22:21:56');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `trip_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `trip_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(3, 8, 6, 5, 'Fantastic! The guide was very helpful.', '2026-05-27 21:35:39', '2026-05-27 21:35:39'),
(4, 6, 1, 5, 'Amazing tour of Old Damascus!', '2026-07-12 18:18:51', '2026-07-12 18:18:51'),
(5, 16, 1, 4, 'Very nice tour', '2026-07-12 18:18:51', '2026-07-12 18:18:51'),
(6, 13, 1, 5, 'أجمل رحلة في دمشق القديمة', '2026-07-12 18:18:51', '2026-07-12 20:43:50'),
(7, 7, 2, 4, 'Great hiking experience', '2026-07-12 18:18:51', '2026-07-12 18:18:51'),
(11, 6, 2, 5, 'Excellent multi-stop tour!', '2026-07-12 18:18:51', '2026-07-12 18:18:51'),
(12, 13, 2, 5, 'أفضل رحلة قمت بها', '2026-07-12 18:18:51', '2026-07-12 20:43:50'),
(13, 16, 2, 4, 'Good trip overall', '2026-07-12 18:18:51', '2026-07-12 18:18:51'),
(14, 8, 1, 5, 'رحلة مميزة', '2026-07-12 18:18:51', '2026-07-12 20:43:50'),
(16, 8, 2, 5, 'استمتعت كثيراً', '2026-07-12 18:18:51', '2026-07-12 20:43:50');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6mZtmLjW6KEItbxJPs8jwrZZundDzZDaJ23ZTFic', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZUNVRUFoTHl2OUgwQzlMeDFjQm5xTHVSanJlT0JiTk1sbTVXZWJhMSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vd25lci9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTU6Im93bmVyLmRhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1781442794),
('6VqLMw3vg4oCMMQCVDWV3Pu0hCsBsSjSqYYDls7z', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiN1U1cWo3bUVhZGNoSmgzMDdleHFSeUVZeHJOdndSeTFmMUtVcGVPRCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ib29raW5ncyI7czo1OiJyb3V0ZSI7czoxNDoiYm9va2luZ3MuaW5kZXgiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxNjtzOjY6ImxvY2FsZSI7czoyOiJlbiI7fQ==', 1781352640),
('MqTSAfFswzIbLfZKIMgD1MOgKk6CVGivQ7l7HyYP', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoia2JLS0hjZWdVYnlPbWl0eWh4OVd4enZNdDdrcW1Bb21rS09CMlhHcSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbi91c2VyIjtzOjU6InJvdXRlIjtzOjEwOiJsb2dpbi5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTY7fQ==', 1781347536);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'global_discount', '5', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `place_name` varchar(255) NOT NULL,
  `seat_price` decimal(10,2) NOT NULL,
  `office_discount` decimal(5,2) DEFAULT NULL,
  `duration` varchar(255) NOT NULL,
  `food_policy` enum('Allowed','Not Allowed') NOT NULL DEFAULT 'Not Allowed',
  `available_seats` int(11) NOT NULL,
  `departure_time` datetime NOT NULL,
  `meeting_point` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('open','closed','canceled','finished','paused') NOT NULL DEFAULT 'open',
  `trip_type` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `place_name_ar` varchar(255) DEFAULT NULL,
  `meeting_point_ar` varchar(255) DEFAULT NULL,
  `description_ar` text DEFAULT NULL,
  `place_name_en` varchar(255) DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `meeting_point_en` varchar(255) DEFAULT NULL,
  `area_serviced` enum('Serviced','Not Serviced') NOT NULL DEFAULT 'Serviced'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `place_name`, `seat_price`, `office_discount`, `duration`, `food_policy`, `available_seats`, `departure_time`, `meeting_point`, `description`, `status`, `trip_type`, `image`, `latitude`, `longitude`, `user_id`, `created_at`, `updated_at`, `place_name_ar`, `meeting_point_ar`, `description_ar`, `place_name_en`, `description_en`, `meeting_point_en`, `area_serviced`) VALUES
(1, 'Old Damascus City Tour', 35.00, NULL, '1 day', 'Allowed', 9, '2026-08-05 00:35:00', 'Umayyad Square', 'Discover Damascus, the oldest capital in the world, on a full-day tour of the UNESCO-listed Old City. Visit the magnificent Umayyad Mosque, wander through the legendary Al-Hamidiyah Souq, explore the historic Straight Street, and see the ancient Church of Ananias hidden beneath the old city. Enjoy a traditional Syrian lunch and captivating stories from our expert guide.\nIncludes: professional guide, traditional Syrian lunch, hotel pickup & drop-off, electronic entry ticket.', 'finished', 'cultural', 'trips/mev5es5o2saN3N3UeAL3afKoqpcakqf6qG1pn5BL.jpg', 33.5130000, 36.3070000, 3, '2026-05-27 21:35:39', '2026-07-12 21:21:06', 'جولة في دمشق القديمة', 'ساحة الأمويين', 'اكتشف دمشق، أقدم عاصمة في العالم، في جولة يوم كامل في المدينة القديمة المدرجة ضمن التراث العالمي. زر الجامع الأموي المهيب، تجول في سوق الحميدية الأسطوري، واستكشف الشارع التاريخي المستقيم وكنيسة حنانيا القديمة المخبأة تحت المدينة. استمتع بغداء سوري تقليدي وقصص آسرة من مرشدنا الخبير.\nيشمل: مرشد محترف، غداء سوري تقليدي، توصيل من الفندق، تذكرة إلكترونية للدخول.', 'Old Damascus City Tour', 'Discover Damascus, the oldest capital in the world, on a full-day tour of the UNESCO-listed Old City. Visit the magnificent Umayyad Mosque, wander through the legendary Al-Hamidiyah Souq, explore the historic Straight Street, and see the ancient Church of Ananias. Enjoy a traditional Syrian lunch and captivating stories from our expert guide.\nIncludes: professional guide, traditional Syrian lunch, hotel pickup & drop-off, electronic entry ticket.', 'Umayyad Square', 'Serviced'),
(2, 'Mount Qasioun Panoramic Bus Tour', 25.00, NULL, '4 hours', 'Allowed', 6, '2026-06-07 00:35:00', 'Jaramana Bus Station', 'Enjoy a scenic bus ride to the summit of Mount Qasioun (1,200m), offering breathtaking panoramic views of Damascus and the Ghouta green belt. Once at the top, explore panoramic viewpoints, visit historic shrines, and enjoy refreshments at a mountain cafe with traditional Syrian tea and coffee.\nIncludes: professional guide, round-trip transport, traditional tea & coffee, electronic entry ticket.', 'finished', 'cultural', 'trips/mount_qasioun_bus.jpg', 33.4870000, 36.3480000, 3, '2026-05-27 21:35:39', '2026-07-12 21:21:06', 'جولة باص بانورامية على جبل قاسيون', 'محطة جرمانا', 'استمتع برحلة باص سياحية إلى قمة جبل قاسيون (1,200م) مع إطلالات بانورامية خلابة على دمشق وغوطة دمشق الخضراء. في القمة، تمتع بمشاهدة المعالم التاريخية والمناظر الخلابة وجلسة في مقهى جبلي مع الشاي والقهوة السورية التقليدية.\nيشمل: مرشد محترف، نقل ذهاب وإياب، شاي وقهوة تقليدية، تذكرة إلكترونية للدخول.', 'Mount Qasioun Panoramic Bus Tour', 'Enjoy a scenic bus ride to the summit of Mount Qasioun (1,200m), offering breathtaking panoramic views of Damascus and the Ghouta green belt. Once at the top, explore panoramic viewpoints, visit historic shrines, and enjoy refreshments at a mountain cafe with traditional Syrian tea and coffee.\nIncludes: professional guide, round-trip transport, traditional tea & coffee, electronic entry ticket.', 'Jaramana Bus Station', 'Serviced'),
(3, 'Aleppo Souq Shopping', 35.00, NULL, '1 day', 'Allowed', 23, '2026-08-07 00:35:00', 'Central Bus Station', 'Explore the largest covered historical market in the Middle East, stretching over 13 kilometers within Aleppo\'s UNESCO-listed Old City. Start at the iconic Citadel of Aleppo, then wander through fragrant spice and textile markets. Meet master artisans and enjoy authentic Aleppian cuisine including cherry kebab and pistachio baklava.\nIncludes: professional guide, traditional Aleppian lunch, hotel pickup, electronic entry ticket.', 'open', 'shopping', 'trips/W8Qf0UxM5wG4mktEDO6mWVbA2WD8F2CiiIgjaHG3.jpg', 36.2020000, 37.1510000, 4, '2026-05-27 21:35:39', '2026-07-12 21:21:06', 'تسوق في سوق حلب', 'محطة الباص المركزية', 'استكشف أكبر سوق تاريخي مسقوف في الشرق الأوسط، ويمتد لأكثر من 13 كيلومتراً داخل مدينة حلب القديمة المدرجة ضمن التراث العالمي. ابدأ من قلعة حلب الشهيرة، ثم تجول في أسواق العطارين العطرة وأسواق المنسوجات. قابل الحرفيين المهرة واستمتع بالمأكولات الحلبية الأصيلة.\nيشمل: مرشد محترف، غداء حلبي تقليدي، توصيل من الفندق، تذكرة إلكترونية للدخول.', 'Aleppo Souq Shopping', 'Explore the largest covered historical market in the Middle East, stretching over 13 kilometers within Aleppo\'s UNESCO-listed Old City. Start at the iconic Citadel of Aleppo, then wander through fragrant spice and textile markets. Meet master artisans and enjoy authentic Aleppian cuisine.\nIncludes: professional guide, traditional Aleppian lunch, hotel pickup, electronic entry ticket.', 'Central Bus Station', 'Serviced'),
(4, 'Krak des Chevaliers Castle', 45.00, NULL, '1 day', 'Not Allowed', 14, '2026-08-07 00:35:00', 'Homs Central Square', 'Visit the finest medieval Crusader castle in the world, a UNESCO Site perched on a 650-meter hill. Built by the Knights Hospitaller (1142-1271), Krak des Chevaliers features double-ring walls, a 36-meter moat, round towers, and a Gothic great hall. Learn about Sultan Baybars\' legendary siege and enjoy panoramic views.\nIncludes: professional guide, round-trip transport, electronic entry ticket.', 'open', 'cultural', 'trips/9Zuqtt412dWSbmf2xDhITKRAdqu6L3WmVdLJN8KR.jpg', 34.7350000, 36.7170000, 5, '2026-05-27 21:35:39', '2026-07-17 22:21:56', 'قلعة الحصن', 'ساحة حمص المركزية', 'زر أروع قلعة صليبية من العصور الوسطى في العالم، إحدى مواقع اليونسكو على تل بارتفاع 650 متراً. بناها فرسان الإسبتارية (1142-1271)، وتتميز بجدارين مزدوجين وخندق بعرض 36 متراً وأبراج مستديرة وقاعة قوطية. تعرف على حصار السلطان بيبرس الأسطوري واستمتع بإطلالات بانورامية.\nيشمل: مرشد محترف، نقل ذهاب وإياب، تذكرة إلكترونية للدخول.', 'Krak des Chevaliers Castle', 'Visit the finest medieval Crusader castle in the world, a UNESCO Site perched on a 650-meter hill. Built by the Knights Hospitaller (1142-1271), Krak des Chevaliers features double-ring walls, a 36-meter moat, round towers, and a Gothic great hall. Learn about Sultan Baybars\' legendary siege and enjoy panoramic views.\nIncludes: professional guide, round-trip transport, electronic entry ticket.', 'Homs Central Square', 'Serviced'),
(6, 'Bosra Ancient City', 40.00, NULL, '1 day', 'Not Allowed', 20, '2026-05-23 00:35:39', 'Sahr al-Jannah', 'Journey back in time to the magnificent Roman city of Bosra, a UNESCO Site 120 kilometers south of Damascus. Marvel at the spectacular 2nd-century Roman theatre (seating 15,000), the colonnaded street, Nabatean gate, and the Cathedral of Bosra built in 512 AD. Discover 2,000 years of history in dramatic black basalt stone.\nIncludes: professional guide, round-trip transport from Damascus, electronic entry ticket.', 'finished', 'cultural', 'trips/9hdgeYzt0fbq7VDa1rZABarswWTi9Fm0k9rN6us6.jpg', 32.5200000, 36.4820000, 3, '2026-05-27 21:35:39', '2026-07-12 21:21:06', 'مدينة بوصرى القديمة', 'صحراء الجنة', 'سافر عبر الزمن إلى مدينة بوصرى الرومانية الرائعة، إحدى مواقع اليونسكو على بعد 120 كيلومتراً جنوب دمشق. تمتع بمشاهدة المسرح الروماني المذهل من القرن الثاني (يتسع لـ15,000)، والشارع المعمد بالأعمدة، وبوابة الأنباط، وكاتدرائية بوصرى. اكتشف 2,000 عام من التاريخ بالحجر البازلتي الأسود.\nيشمل: مرشد محترف، نقل ذهاب وإياب من دمشق، تذكرة إلكترونية للدخول.', 'Bosra Ancient City', 'Journey back in time to the magnificent Roman city of Bosra, a UNESCO Site 120 kilometers south of Damascus. Marvel at the spectacular 2nd-century Roman theatre (seating 15,000), the colonnaded street, Nabatean gate, and the Cathedral of Bosra. Discover 2,000 years of history in dramatic black basalt stone.\nIncludes: professional guide, round-trip transport from Damascus, electronic entry ticket.', 'Sahr al-Jannah', 'Serviced'),
(7, 'Damascus Old City Multi-Stop Tour', 20.00, 2.00, '3 hours', 'Allowed', 15, '2026-08-07 00:35:00', 'Bab Sharqi Arch', 'A 3-hour guided walking tour through three iconic Old Damascus locations. Begin at Bab Touma, visit the Chapel of St. Paul, explore Maktab Anbar palace museum, and end at Al-Hamidiyah Souq with famous Bakdash ice cream. Perfect for experiencing the essence of Damascus.\nIncludes: professional local guide, electronic entry tickets.', 'open', 'cultural', 'trips/iq0AKuIn4obj5qTjPhTOcLZIeVkFgS5lxbbwSSYj.jpg', 33.5137305, 36.3151916, 3, '2026-05-27 21:35:39', '2026-07-15 07:18:34', 'جولة في دمشق القديمة متعددة المحطات', 'قوس باب شرقي', 'جولة مشي مدتها 3 ساعات مع مرشد في ثلاثة معالم أيقونية في دمشق القديمة. ابدأ من باب توما، زر كنيسة القديس بولس، واستكشف قصر مكتب عنبر، واختتم في سوق الحميدية مع بوظة بكداش الشهيرة. مثالية لتجربة جوهر دمشق.\nيشمل: مرشد محلي محترف، تذاكر إلكترونية للدخول.', 'Damascus Old City Multi-Stop Tour', 'A 3-hour guided walking tour through three iconic Old Damascus locations. Begin at Bab Touma, visit the Chapel of St. Paul, explore Maktab Anbar palace museum, and end at Al-Hamidiyah Souq with famous Bakdash ice cream. Perfect for experiencing the essence of Damascus.\nIncludes: professional local guide, electronic entry tickets.', 'Bab Sharqi Arch', 'Serviced'),
(11, 'Al-Nawfara Cafe - The Damascene Storyteller Experience', 18.00, NULL, '3 hours', 'Allowed', 20, '2026-08-07 16:00:00', 'Umayyad Mosque - Eastern Gate (Bab Al-Qaymariya)', 'Visit the oldest cafe in Damascus (250+ years), behind the Umayyad Mosque\'s eastern gate. Enjoy tea, coffee, and shisha while listening to the Hakawati storyteller perform epic tales at 8 PM. The basalt courtyard and straw chairs create an unforgettable atmosphere.\r\nIncludes: traditional tea & coffee, Hakawati storytelling show, local guide, electronic entry ticket.', 'open', 'cultural', 'trips/oB238uFRCPQpUwyv3aDL1jlKkKMJYavuflriTLge.jpg', 33.5115000, 36.3065000, 5, '2026-07-12 20:37:13', '2026-07-17 17:35:23', 'مقهى النوفرة - تجربة الحكواتي الدمشقي', 'الجامع الأموي - الباب الشرقي (باب القيمرية)', 'زر أقدم مقهى في دمشق (أكثر من 250 عاماً)، خلف الباب الشرقي للجامع الأموي. استمتع بالشاي والقهوة والنرجيلة مع الحكواتي الذي يروي الحكايات الملحمية عند الساعة 8. فناء البازلت وكراسي القش تخلق جواً لا يُنسى.\r\nيشمل: شاي وقهوة تقليدية، عرض الحكواتي، مرشد محلي، تذكرة إلكترونية للدخول.', 'Al-Nawfara Cafe - The Damascene Storyteller Experience', 'Visit the oldest cafe in Damascus (250+ years), behind the Umayyad Mosque\'s eastern gate. Enjoy tea, coffee, and shisha while listening to the Hakawati storyteller perform epic tales at 8 PM. The basalt courtyard and straw chairs create an unforgettable atmosphere.\r\nIncludes: traditional tea & coffee, Hakawati storytelling show, local guide, electronic entry ticket.', 'Umayyad Mosque - Eastern Gate (Bab Al-Qaymariya)', 'Serviced'),
(12, 'Midhat Pasha Souq Tour', 12.00, NULL, '2 hours', 'Allowed', 25, '2026-08-07 10:00:00', 'Bab Al-Jabiya - Old Damascus', 'Walk through the oldest continuously inhabited street in the world, built in 64 BC as Via Recta. This 600m covered market combines Roman arches, Ayyubid gates, and an Ottoman iron roof. Discover Damascene silk, copperware, spices, and perfumes.\r\nIncludes: professional guide, electronic entry ticket.', 'open', 'shopping', 'trips/yNttmULuGGgsZNTwKJJvGyaPoSgGJEFukmpLDn0e.jpg', 33.5075000, 36.3010000, 14, '2026-07-12 20:37:13', '2026-07-17 17:45:26', 'جولة في سوق مدحت باشا', 'باب الجابية - دمشق القديمة', 'تجول في أقدم شارع مأهول باستمرار في العالم، بني عام 64 ق.م. باسم الشارع المستقيم. يمتد هذا السوق المسقوف 600 متر ويجمع الأقواس الرومانية والأبواب الأيوبية والسقف العثماني الحديدي. اكتشف الحرير الدمشقي والنحاس والبهارات والعطور.\r\nيشمل: مرشد محترف، تذكرة إلكترونية للدخول.', 'Midhat Pasha Souq Tour', 'Walk through the oldest continuously inhabited street in the world, built in 64 BC as Via Recta. This 600m covered market combines Roman arches, Ayyubid gates, and an Ottoman iron roof. Discover Damascene silk, copperware, spices, and perfumes.\r\nIncludes: professional guide, electronic entry ticket.', 'Bab Al-Jabiya - Old Damascus', 'Serviced'),
(13, 'Damascus Citadel Tour', 12.00, NULL, '2 hours', 'Not Allowed', 30, '2026-08-07 09:00:00', 'Damascus Citadel - Main Entrance', 'Explore one of the largest medieval Islamic fortresses (230m x 150m), a UNESCO Site since 1979. Built by Al-Adil (Saladin\'s brother) with 12 towers, a 20m moat, and the first stone muqarnas in Damascus. Witness to Crusader sieges, Mongol invasions, and Mamluk and Ottoman rule with panoramic city views.\r\nIncludes: professional guide, electronic entry ticket.', 'open', 'cultural', 'trips/3AKfZmcLAfsZPoygYUZo2GO5QFgko3YqcqgXjWkx.jpg', 33.5123000, 36.3020000, 14, '2026-07-12 20:37:13', '2026-07-17 17:50:33', 'جولة في قلعة دمشق', 'قلعة دمشق - المدخل الرئيسي', 'استكشف واحدة من أضخم القلاع الإسلامية (230م × 150م)، ضمن مواقع اليونسكو منذ 1979. بناها الملك العادل شقيق صلاح الدين بـ 12 برجاً وخندق بعرض 20م وأول مقرنص حجري في دمشق. شهدت حصارات صليبية وغزوات مغولية وحكماً مملوكياً وعثمانياً مع إطلالات بانورامية.\r\nيشمل: مرشد محترف، تذكرة إلكترونية للدخول.', 'Damascus Citadel Tour', 'Explore one of the largest medieval Islamic fortresses (230m x 150m), a UNESCO Site since 1979. Built by Al-Adil (Saladin\'s brother) with 12 towers, a 20m moat, and the first stone muqarnas in Damascus. Witness to Crusader sieges, Mongol invasions, and Mamluk and Ottoman rule with panoramic city views.\r\nIncludes: professional guide, electronic entry ticket.', 'Damascus Citadel - Main Entrance', 'Serviced');

-- --------------------------------------------------------

--
-- Table structure for table `trip_images`
--

CREATE TABLE `trip_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trip_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `order` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trip_images`
--

INSERT INTO `trip_images` (`id`, `trip_id`, `image_path`, `order`, `created_at`, `updated_at`) VALUES
(1, 7, 'trips/sub-images/RSs6Mx9jNnfiuBxmHbRwGJJdi4Q2kEmULl5gNDEV.jpg', 0, '2026-06-05 19:01:37', '2026-06-05 19:01:37'),
(2, 7, 'trips/sub-images/SvNEX6cXv9SDSxjfjUOItdxPheozbsWvvykRrR5J.jpg', 1, '2026-06-05 19:01:37', '2026-06-05 19:01:37'),
(3, 7, 'trips/sub-images/7qLMIrVSijSPX3jxGmWtOk9rcf7UzylwGaN96aFO.webp', 2, '2026-06-05 19:01:37', '2026-06-05 19:01:37'),
(4, 7, 'trips/sub-images/PJuQrAjO7qF2UkfvGztKWgFO1KI5Dh9mIzKVnvtB.webp', 3, '2026-06-05 19:01:37', '2026-06-05 19:01:37'),
(5, 7, 'trips/sub-images/sYb5BqSWx4TfuSIWspxN9Qggur6Zl0byWMDY0QNh.webp', 4, '2026-06-05 19:01:37', '2026-06-05 19:01:37');

-- --------------------------------------------------------

--
-- Table structure for table `trip_stops`
--

CREATE TABLE `trip_stops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trip_id` bigint(20) UNSIGNED NOT NULL,
  `place_name` varchar(255) NOT NULL,
  `place_name_ar` varchar(255) DEFAULT NULL,
  `place_name_en` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `description_ar` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `stop_duration` varchar(255) NOT NULL,
  `stop_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trip_stops`
--

INSERT INTO `trip_stops` (`id`, `trip_id`, `place_name`, `place_name_ar`, `place_name_en`, `description`, `description_ar`, `description_en`, `image`, `latitude`, `longitude`, `stop_duration`, `stop_order`, `created_at`, `updated_at`) VALUES
(1, 7, 'باب توما', 'باب توما', 'Bab Touma', 'One of the seven ancient gates of Damascus, marking the entrance to the vibrant Christian Quarter with its churches, traditional houses, and hidden cafes.', 'أحد أبواب دمشق السبعة القديمة، مدخل الحي المسيحي النابض بالحياة بكنائسه وبيوته التقليدية ومقاهيه المخفية.', 'One of the seven ancient gates of Damascus, entrance to the vibrant Christian Quarter with churches, traditional houses, and hidden cafes.', NULL, 33.5137305, 36.3151916, '0.50', 1, '2026-05-27 21:35:39', '2026-06-05 22:01:13'),
(2, 7, 'مكتب عنبر', 'مكتب عنبر', 'Maktab Anbar', 'A stunning 19th-century Damascene palace turned museum, showcasing intricate woodwork, colorful marble mosaics, painted gold-leaf ceilings, and a serene central courtyard.', 'قصر دمشقي رائع من القرن التاسع عشر تحول إلى متحف، يعرض أعمالاً خشبية معقدة وفسيفساء رخامية ملونة وأسقفاً مذهبة وفناءً مركزياً هادئاً.', 'A stunning 19th-century Damascene palace turned museum, showcasing intricate woodwork, colorful marble mosaics, painted gold-leaf ceilings, and a serene courtyard.', NULL, 33.5098616, 36.3095385, '0.50', 2, '2026-05-27 21:35:39', '2026-06-05 22:01:13'),
(3, 7, 'سوق الحميدية', 'سوق الحميدية', 'Al-Hamidiyah Souq', 'The largest and most famous souq in Damascus, covered with an iconic arched iron roof built in 1880. A bustling market since the 14th century with spices, textiles, sweets, and artisan workshops.', 'أكبر وأشهر أسواق دمشق، مسقوف بسقف حديدي مقوس شهير بني عام 1880. سوق نابض بالحياة منذ القرن الرابع عشر بالبهارات والمنسوجات والحلويات وورش الحرفيين.', 'Damascus\' largest souq with an iconic arched iron roof built in 1880. Bustling since the 14th century with spices, textiles, sweets, and artisan workshops.', NULL, 33.5114729, 36.3051540, '0.50', 3, '2026-05-27 21:35:39', '2026-06-05 22:01:13'),
(13, 11, 'الجامع الأموي - الباب الشرقي', 'الجامع الأموي - الباب الشرقي', 'Umayyad Mosque - Eastern Gate', 'بوابة رائعة تؤدي إلى صحن الجامع الأموي الكبير، أحد أقدم وأكبر المساجد في العالم. يتميز حي القيمرية المحيط بالعمارة الدمشقية التقليدية.', 'بوابة رائعة تؤدي إلى صحن الجامع الأموي الكبير، أحد أقدم وأكبر المساجد في العالم. يتميز حي القيمرية المحيط بالعمارة الدمشقية التقليدية.', 'Magnificent gate to the Great Umayyad Mosque courtyard. The surrounding Al-Qaymariya neighborhood features traditional Damascene architecture.', 'trip-stops/B0Fv3UsFcbCxawwAgzUfqmLjNoKoggzfZeCofA8U.jpg', 33.5115000, 36.3065000, '0.50', 1, '2026-07-12 20:37:13', '2026-07-17 17:35:23'),
(14, 11, 'مقهى النوفرة والحكواتي', 'مقهى النوفرة والحكواتي', 'Al-Nawfara Cafe & Hakawati', 'أقدم مقهى في دمشق (أكثر من 250 عاماً)، كان في الأصل حماماً. يشتهر بالحكواتي الذي يروي الحكايات الملحمية من التراث العربي كل مساء عند الساعة 8 مرتدياً الزي التقليدي.', 'أقدم مقهى في دمشق (أكثر من 250 عاماً)، كان في الأصل حماماً. يشتهر بالحكواتي الذي يروي الحكايات الملحمية من التراث العربي كل مساء عند الساعة 8 مرتدياً الزي التقليدي.', 'The oldest cafe in Damascus (250+ years), originally a bathhouse. Famous for the Hakawati storyteller performing epic Arab heritage tales at 8 PM.', 'trip-stops/688xA0D1SyM1NLKnaQa572ta4qAAaxn8F5zYgCer.jpg', 33.5110000, 36.3060000, '2.00', 2, '2026-07-12 20:37:13', '2026-07-17 17:35:23'),
(15, 11, 'جولة في أزقة دمشق القديمة', 'جولة في أزقة دمشق القديمة', 'Old Damascus Alleys Walk', 'نزهة هادئة في الأزقة التاريخية الضيقة لدمشق القديمة، مروراً بالمنازل التقليدية وورش الحرفيين الصغيرة والمخابز المحلية بهندسة دمشقية أصيلة.', 'نزهة هادئة في الأزقة التاريخية الضيقة لدمشق القديمة، مروراً بالمنازل التقليدية وورش الحرفيين الصغيرة والمخابز المحلية بهندسة دمشقية أصيلة.', 'A peaceful stroll through narrow historic alleyways of old Damascus, passing traditional houses, artisan workshops, and local bakeries.', 'trip-stops/KGD5rxndiqw5xNd7qfDDXVnQ1D7zb4YST7Rx4hIQ.jpg', 33.5105000, 36.3070000, '0.50', 3, '2026-07-12 20:37:13', '2026-07-17 17:35:23'),
(16, 12, 'باب الجابية - مدخل السوق', 'باب الجابية - مدخل السوق', 'Bab al-Jabiya - Souq Entrance', 'أحد أبواب دمشق السبعة التاريخية، المدخل الغربي لسوق مدحت باشا. سمي نسبةً إلى عين جابية في الجولان.', 'أحد أبواب دمشق السبعة التاريخية، المدخل الغربي لسوق مدحت باشا. سمي نسبةً إلى عين جابية في الجولان.', 'One of the seven historic gates of Damascus, marking the western entrance to Midhat Pasha Souq.', 'trip-stops/8yk6YDqwuRUspZxqyjJ3MNiC294tWcUFX4MuJtZr.jpg', 33.5075000, 36.3010000, '0.25', 1, '2026-07-12 20:37:13', '2026-07-17 17:45:26'),
(17, 12, 'سوق مدحت باشا المسقوف', 'سوق مدحت باشا المسقوف', 'Midhat Pasha Covered Market', 'قلب السوق حيث المنسوجات الدمشقية التقليدية والنحاس المشغول يدوياً والبهارات العطرية والعطور. يخلق السقف الحديدي ذو الفتحات الزجاجية لعبة جميلة من الضوء والظل.', 'قلب السوق حيث المنسوجات الدمشقية التقليدية والنحاس المشغول يدوياً والبهارات العطرية والعطور. يخلق السقف الحديدي ذو الفتحات الزجاجية لعبة جميلة من الضوء والظل.', 'The heart of the souq with Damascene textiles, copperware, spices and perfumes. The iron roof with glass openings creates a beautiful play of light and shadow.', 'trip-stops/dnAaij0hskdPJ8p92quIxshM9SrWL2Z2suUX6M6n.jpg', 33.5085000, 36.3035000, '1.25', 2, '2026-07-12 20:37:13', '2026-07-17 17:45:26'),
(18, 12, 'مخرج السوق - منطقة الجامع الأموي', 'مخرج السوق - منطقة الجامع الأموي', 'Souq Exit - Umayyad Mosque Area', 'الطرف الشرقي من السوق يفتح على المنطقة النابضة المحيطة بالجامع الأموي الكبير. مكان مثالي للراحة والاستمتاع بأحد أعظم التحف المعمارية الإسلامية.', 'الطرف الشرقي من السوق يفتح على المنطقة النابضة المحيطة بالجامع الأموي الكبير. مكان مثالي للراحة والاستمتاع بأحد أعظم التحف المعمارية الإسلامية.', 'The eastern end opens to the vibrant area surrounding the Great Umayyad Mosque. A perfect spot to rest and admire this architectural masterpiece.', 'trip-stops/5YMXRFtXaJrLnTQKOv4efTw4DOBdJpDVS8EFYuGC.jpg', 33.5105000, 36.3050000, '0.25', 3, '2026-07-12 20:37:13', '2026-07-17 17:45:26'),
(19, 13, 'البوابة الشرقية - المقرنص الحجري', 'البوابة الشرقية - المقرنص الحجري', 'Eastern Gate - Stone Muqarnas', 'أجمل أبواب القلعة فنياً، وتتميز بأول مقرنص حجري في دمشق. مزينة بألوان زاهية وزخارف من العصور الأيوبية والمملوكية والعثمانية.', 'أجمل أبواب القلعة فنياً، وتتميز بأول مقرنص حجري في دمشق. مزينة بألوان زاهية وزخارف من العصور الأيوبية والمملوكية والعثمانية.', 'The most magnificent gate with the first stone muqarnas in Damascus. Painted with motifs from Ayyubid, Mamluk, and Ottoman periods.', 'trip-stops/cd6LjowLp8UXkq21506N6tAC8kz7v7tHZIsanzGy.jpg', 33.5125000, 36.3025000, '0.50', 1, '2026-07-12 20:37:13', '2026-07-17 17:50:33'),
(20, 13, 'القاعة المقببة والأبراج الأيوبية', 'القاعة المقببة والأبراج الأيوبية', 'Vaulted Hall & Ayyubid Towers', 'قاعة ذات تسع قباب اعتُقد أنها قاعة العرش، ويعتقد الآن أنها كانت مساحة متعددة الاستخدامات. تحتوي الأبراج المحيطة على مزاغل للسهام ومنصات للمقاليع وغرف تحت الأرض.', 'قاعة ذات تسع قباب اعتُقد أنها قاعة العرش، ويعتقد الآن أنها كانت مساحة متعددة الاستخدامات. تحتوي الأبراج المحيطة على مزاغل للسهام ومنصات للمقاليع وغرف تحت الأرض.', 'A nine-vaulted hall once thought to be a throne room. Towers contain arrow slits, trebuchet platforms, and underground chambers.', 'trip-stops/ZA4Wt3Qdy27NApRDcfIeuaoJouHoiPelV68aM53P.jpg', 33.5120000, 36.3028000, '0.75', 2, '2026-07-12 20:37:13', '2026-07-17 17:50:33'),
(21, 13, 'السور الشمالي وإطلالة المدينة', 'السور الشمالي وإطلالة المدينة', 'Northern Wall & City Panorama', 'تجول على طول السور الشمالي المطل على مجرى نهر بردى القديم. استمتع بإطلالات بانورامية على دمشق القديمة بما فيها الجامع الأموي وسوق الحميدية والأحياء المحيطة.', 'تجول على طول السور الشمالي المطل على مجرى نهر بردى القديم. استمتع بإطلالات بانورامية على دمشق القديمة بما فيها الجامع الأموي وسوق الحميدية والأحياء المحيطة.', 'Northern wall walk with panoramic views of Old Damascus including the Umayyad Mosque and Al-Hamidiyah Souq.', 'trip-stops/i217vtUqA2M6zLTVgxF2vshdGMLDAlg22Uu5M3kR.jpg', 33.5130000, 36.3020000, '0.50', 3, '2026-07-12 20:37:13', '2026-07-17 17:50:33');

-- --------------------------------------------------------

--
-- Table structure for table `trip_stop_images`
--

CREATE TABLE `trip_stop_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trip_stop_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `order` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `is_paused` tinyint(1) NOT NULL DEFAULT 0,
  `num1` varchar(20) DEFAULT NULL,
  `num2` varchar(20) DEFAULT NULL,
  `discount` decimal(5,2) DEFAULT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `is_paused`, `num1`, `num2`, `discount`, `points`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jawad Owner', 'Jawad@tripshub.com', '2026-06-27 21:42:23', '$2y$12$39bqcNdWaM.pwz2HevdOyukW9Q//GQyHod9x/b3/VMkiQryY3rJVu', 'owner', 0, NULL, NULL, NULL, 0, NULL, '2026-05-27 21:35:39', '2026-05-27 21:35:39'),
(2, 'Sedra Owner', 'Sedra@tripshub.com', '2026-06-27 21:42:23', '$2y$12$YT4TA1xEEwxEhLYtAkh9we3g45hQJLC9UaPROgL2rzFVZWk7owTLq', 'owner', 0, NULL, NULL, NULL, 0, NULL, '2026-05-27 21:35:39', '2026-05-27 21:35:39'),
(3, 'Al-Atlat Al shamia', 'damascus@office.com', '2026-06-27 21:42:23', '$2y$12$AZqkyQl3S9uT2G3pVxdrJeigJVr7D80p5A01oGZlb59tbxrFwn3Q6', 'office', 0, '0912345678', '0976543210', NULL, 0, NULL, '2026-05-27 21:35:39', '2026-05-27 22:44:35'),
(4, 'Aleppo Tours', 'aleppo@office.com', '2026-06-27 21:42:23', '$2y$12$1w4GJjIY9UGFAx.iN7cET.pb0A03q6TSDfsZB.5KWsEWBSt/VHV1q', 'office', 0, '0923456789', '0987654321', 2.00, 0, NULL, '2026-05-27 21:35:39', '2026-05-27 22:49:54'),
(5, 'Al-Rasafa for Tourism and Travel', 'homs@office.com', '2026-06-27 21:42:23', '$2y$12$NjmiQ1NJjmBNIlBqNKppBugdYl9OrxFG9oQnDaqLHgKRocFh1J3HK', 'office', 0, '0934567890', '0978912345', 0.00, 0, NULL, '2026-05-27 21:35:39', '2026-05-27 22:49:38'),
(6, 'ALi Ali', 'Ali@user.com', '2026-06-27 21:42:23', '$2y$12$U2Yyz4SaDJye1u5xhzSLb.rWDK5VQhQ7OP1mhLyPPvG7vbswvCQQG', 'user', 0, '0946352718', '0971826354', NULL, 10, NULL, '2026-05-27 21:35:39', '2026-06-01 17:56:17'),
(7, 'Ahmad Aisa', 'Ahmad@user.com', '2026-06-27 21:42:23', '$2y$12$kA3hAayfD/eUQKtUDhWX6uYEWO8w8P1JOlm3j180jF2rkxokApq1a', 'user', 0, '0957283645', '0976453829', NULL, 0, NULL, '2026-05-27 21:35:39', '2026-05-27 21:35:39'),
(8, 'Noor sawan', 'Noor@user.com', '2026-06-27 21:42:23', '$2y$12$vBDQHfFKezABveaSR6T5eOcH/BPhRRut2sdyqOTx9uzeKg9YasjFe', 'user', 0, '0963748291', '0978192746', NULL, 19, NULL, '2026-05-27 21:35:39', '2026-07-12 15:37:44'),
(9, 'Admin Office Manager', 'admin@tripshub.com', '2026-06-27 21:42:23', '$2y$12$Ed00adrtV.55E4NLDcXvEedN0oRQK9y4twUXil3a0A30OxQwILOE.', 'admin', 0, '0978123456', '0987234567', NULL, 0, 'bZR16N6gJ9wIIMxhFEw8noYZqZXRcjI1Qsljaj0I7bn7ao8TcNM9gvd1SXIN', '2026-05-27 21:35:39', '2026-05-27 21:35:39'),
(13, 'Sedra sawan', 'sawansoso881@gmail.com', '2026-06-27 21:42:23', '$2y$12$jf.tNQuI9XUyDIrhw2wiLe0Z1cl7gPjapE9NRLIMPRSODG2ha1H9m', 'user', 0, '0954862749', '0912648413', NULL, 11, NULL, '2026-05-27 22:59:51', '2026-07-15 07:18:34'),
(14, 'Golden Way Tourism', 'testoffice@test.com', '2026-06-27 21:42:23', '$2y$12$DaYXgtf3sekMBf7PuDZHKugwx/brJ4EhJPO.0DDR4XrOr4/r6iTLO', 'office', 0, '0912345678', '0987654321', NULL, 0, NULL, '2026-05-28 00:46:47', '2026-07-18 00:05:13'),
(15, 'Levant Tours', 'test@test.com', '2026-06-27 21:42:23', '$2y$12$bEqEiUu5p4SHfj2En2cmxOyOQGc/TGIS.kyK16tL8KcSnnV/qgS32', 'office', 0, '0923232323', '0932313131', NULL, 0, NULL, '2026-05-28 00:47:46', '2026-07-18 00:05:13'),
(16, 'jawad', 'jawad.sandouk.03@gmail.com', '2026-06-27 21:42:23', '$2y$12$Z2I757ZbCX3LDRL9cxfTMOrpVNdzrGYkkWrUyE7xcSukk6Dhn5LfO', 'user', 0, '0900000000', '0900000000', NULL, 14, NULL, '2026-05-30 21:22:35', '2026-07-17 22:21:56');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal_requests`
--

CREATE TABLE `withdrawal_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `office_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_details` varchar(255) DEFAULT NULL,
  `status` enum('pending','processing','completed','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdrawal_requests`
--

INSERT INTO `withdrawal_requests` (`id`, `office_id`, `amount`, `payment_method`, `payment_details`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 50.00, 'sham_cash', '55555', 'completed', '2026-06-27 17:58:04', '2026-06-27 18:00:03'),
(2, 3, 100.00, 'visa', '55555', 'completed', '2026-06-27 19:22:27', '2026-06-27 19:30:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_trip_id_foreign` (`trip_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `office_deletion_requests`
--
ALTER TABLE `office_deletion_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `office_deletion_requests_user_id_foreign` (`user_id`);

--
-- Indexes for table `office_registration_requests`
--
ALTER TABLE `office_registration_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_booking_id_foreign` (`booking_id`),
  ADD KEY `payments_user_id_foreign` (`user_id`);

--
-- Indexes for table `point_transactions`
--
ALTER TABLE `point_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `point_transactions_user_id_foreign` (`user_id`),
  ADD KEY `point_transactions_booking_id_foreign` (`booking_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ratings_user_id_trip_id_unique` (`user_id`,`trip_id`),
  ADD KEY `ratings_trip_id_foreign` (`trip_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trips_user_id_foreign` (`user_id`);

--
-- Indexes for table `trip_images`
--
ALTER TABLE `trip_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trip_images_trip_id_foreign` (`trip_id`);

--
-- Indexes for table `trip_stops`
--
ALTER TABLE `trip_stops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trip_stops_trip_id_foreign` (`trip_id`);

--
-- Indexes for table `trip_stop_images`
--
ALTER TABLE `trip_stop_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trip_stop_images_trip_stop_id_foreign` (`trip_stop_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `withdrawal_requests`
--
ALTER TABLE `withdrawal_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withdrawal_requests_office_id_foreign` (`office_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `office_deletion_requests`
--
ALTER TABLE `office_deletion_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `office_registration_requests`
--
ALTER TABLE `office_registration_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `point_transactions`
--
ALTER TABLE `point_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `trip_images`
--
ALTER TABLE `trip_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `trip_stops`
--
ALTER TABLE `trip_stops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `trip_stop_images`
--
ALTER TABLE `trip_stop_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `withdrawal_requests`
--
ALTER TABLE `withdrawal_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_trip_id_foreign` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `office_deletion_requests`
--
ALTER TABLE `office_deletion_requests`
  ADD CONSTRAINT `office_deletion_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `point_transactions`
--
ALTER TABLE `point_transactions`
  ADD CONSTRAINT `point_transactions_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `point_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_trip_id_foreign` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trips`
--
ALTER TABLE `trips`
  ADD CONSTRAINT `trips_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trip_images`
--
ALTER TABLE `trip_images`
  ADD CONSTRAINT `trip_images_trip_id_foreign` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trip_stops`
--
ALTER TABLE `trip_stops`
  ADD CONSTRAINT `trip_stops_trip_id_foreign` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trip_stop_images`
--
ALTER TABLE `trip_stop_images`
  ADD CONSTRAINT `trip_stop_images_trip_stop_id_foreign` FOREIGN KEY (`trip_stop_id`) REFERENCES `trip_stops` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `withdrawal_requests`
--
ALTER TABLE `withdrawal_requests`
  ADD CONSTRAINT `withdrawal_requests_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
