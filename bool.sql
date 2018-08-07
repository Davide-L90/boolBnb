-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Ago 07, 2018 alle 14:53
-- Versione del server: 5.7.22-0ubuntu0.16.04.1
-- Versione PHP: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bool`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `advertisements`
--

CREATE TABLE IF NOT EXISTS `advertisements` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `price` decimal(3,2) NOT NULL,
  `validity` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `advertisements`
--

INSERT INTO `advertisements` (`id`, `price`, `validity`, `created_at`, `updated_at`) VALUES
(1, '2.99', 24, NULL, NULL),
(2, '5.99', 72, NULL, NULL),
(3, '9.99', 144, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `advertisement_apartament`
--

CREATE TABLE IF NOT EXISTS `advertisement_apartament` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `apartament_id` int(10) UNSIGNED DEFAULT NULL,
  `advertisement_id` int(10) UNSIGNED DEFAULT NULL,
  `valid_until` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `advertisement_apartament_apartament_id_foreign` (`apartament_id`),
  KEY `advertisement_apartament_advertisement_id_foreign` (`advertisement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `advertisement_apartament`
--

INSERT INTO `advertisement_apartament` (`id`, `apartament_id`, `advertisement_id`, `valid_until`, `created_at`, `updated_at`) VALUES
(4, 4, 2, '2018-08-10 10:11:33', NULL, NULL),
(5, 5, 3, '2018-08-13 10:16:47', NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `apartaments`
--

CREATE TABLE IF NOT EXISTS `apartaments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `beds_number` tinyint(3) UNSIGNED NOT NULL,
  `bathrooms_number` tinyint(3) UNSIGNED NOT NULL,
  `area` smallint(5) UNSIGNED NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` decimal(11,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `apartaments_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `apartaments`
--

INSERT INTO `apartaments` (`id`, `user_id`, `title`, `beds_number`, `bathrooms_number`, `area`, `address`, `latitude`, `longitude`, `price`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'FORLANINI', 4, 1, 50, 'Viale Enrico Forlanini, Milano, MI, Italia', '45.46188600', '9.25875200', 350, 1, '2018-08-07 05:52:10', '2018-08-07 06:20:12'),
(4, 1, 'MONTE NERO', 5, 2, 95, 'Viale Monte Nero, Milano, MI, Italia', '45.45717900', '9.20548260', 650, 1, '2018-08-07 08:10:42', '2018-08-07 08:11:58'),
(5, 1, 'V. MOLISE', 9, 2, 130, 'Viale Molise, Milano, MI, Italia', '45.45618320', '9.22422300', 980, 1, '2018-08-07 08:16:01', '2018-08-07 08:16:01'),
(6, 1, 'MONTE NERO 2', 3, 1, 90, 'Viale Monte Nero, 30, Milano, MI, Italia', '45.45554900', '9.20470410', 550, 1, '2018-08-07 08:17:33', '2018-08-07 08:17:33'),
(7, 2, 'sdasd', 7, 2, 150, 'Viale Enrico Forlanini, 40, Milano, MI, Italia', '45.46184660', '9.24310790', 600, 1, '2018-08-07 09:55:40', '2018-08-07 09:55:40');

-- --------------------------------------------------------

--
-- Struttura della tabella `apartament_feature`
--

CREATE TABLE IF NOT EXISTS `apartament_feature` (
  `apartament_id` int(10) UNSIGNED NOT NULL,
  `feature_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`apartament_id`,`feature_id`),
  KEY `apartament_feature_feature_id_foreign` (`feature_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `apartament_feature`
--

INSERT INTO `apartament_feature` (`apartament_id`, `feature_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(1, 3, NULL, NULL),
(5, 1, NULL, NULL),
(5, 2, NULL, NULL),
(5, 6, NULL, NULL),
(6, 1, NULL, NULL),
(7, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `features`
--

CREATE TABLE IF NOT EXISTS `features` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `features`
--

INSERT INTO `features` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'wifi', NULL, NULL),
(2, 'garden', NULL, NULL),
(3, 'swimming pool', NULL, NULL),
(4, 'sea view', NULL, NULL),
(5, 'mountain view', NULL, NULL),
(6, 'parking place', NULL, NULL),
(7, 'gatehouse', NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `guestusers`
--

CREATE TABLE IF NOT EXISTS `guestusers` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `guestusers_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `guestusers`
--

INSERT INTO `guestusers` (`id`, `name`, `surname`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Aaaa', 'bbbb', 'aaaa@gmail.com', '2018-08-07 06:21:58', '2018-08-07 06:21:58'),
(2, 'prova', 'provaaaa', 'prova@gmail.com', '2018-08-07 08:20:11', '2018-08-07 08:20:11');

-- --------------------------------------------------------

--
-- Struttura della tabella `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `apartament_id` int(10) UNSIGNED DEFAULT NULL,
  `filename` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_thumbnail` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `images_apartament_id_foreign` (`apartament_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `images`
--

INSERT INTO `images` (`id`, `apartament_id`, `filename`, `is_thumbnail`, `created_at`, `updated_at`) VALUES
(1, 1, '1533628346027.jpg', NULL, '2018-08-07 05:52:26', '2018-08-07 05:52:26'),
(2, 1, '1533628346124.jpg', NULL, '2018-08-07 05:52:26', '2018-08-07 05:52:26'),
(3, 1, '1533628346127.jpg', NULL, '2018-08-07 05:52:27', '2018-08-07 05:52:27'),
(9, 4, '1533636656218.jpg', NULL, '2018-08-07 08:10:56', '2018-08-07 08:10:56'),
(10, 4, '1533636656230.jpg', NULL, '2018-08-07 08:10:56', '2018-08-07 08:10:56'),
(11, 4, '1533636661202.jpg', NULL, '2018-08-07 08:11:01', '2018-08-07 08:11:01'),
(12, 5, '1533636979307.jpg', NULL, '2018-08-07 08:16:19', '2018-08-07 08:16:19'),
(13, 5, '1533636979315.jpg', NULL, '2018-08-07 08:16:19', '2018-08-07 08:16:19'),
(14, 5, '1533636979323.jpg', NULL, '2018-08-07 08:16:19', '2018-08-07 08:16:19'),
(15, 6, '1533637067199.jpg', NULL, '2018-08-07 08:17:47', '2018-08-07 08:17:47'),
(16, 6, '1533637067187.jpg', NULL, '2018-08-07 08:17:47', '2018-08-07 08:17:47'),
(17, 7, '1533642947842.jpg', NULL, '2018-08-07 09:55:48', '2018-08-07 09:55:48');

-- --------------------------------------------------------

--
-- Struttura della tabella `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `apartament_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `guest_user_id` int(10) UNSIGNED DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sanding_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_apartament_id_foreign` (`apartament_id`),
  KEY `messages_guest_user_id_foreign` (`guest_user_id`),
  KEY `messages_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `messages`
--

INSERT INTO `messages` (`id`, `apartament_id`, `user_id`, `guest_user_id`, `content`, `sanding_date`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 1, 'Messaggio di prova', '2018-08-07 08:21:59', '2018-08-07 06:21:59', '2018-08-07 06:21:59'),
(2, 5, NULL, 2, 'prova 2', '2018-08-07 10:20:11', '2018-08-07 08:20:11', '2018-08-07 08:20:11');

-- --------------------------------------------------------

--
-- Struttura della tabella `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_07_18_143332_create_apartaments_table', 1),
(4, '2018_07_18_152047_create_guestusers_table', 1),
(5, '2018_07_18_153057_create_images_table', 1),
(6, '2018_07_18_154022_create_messages_table', 1),
(7, '2018_07_18_161345_create_services_table', 1),
(8, '2018_07_18_162838_create_advertisements_table', 1),
(9, '2018_07_18_164827_create_apartament_service_table', 1),
(10, '2018_07_18_165144_create_advertisement_apartament_table', 1),
(11, '2018_07_19_153222_create_features_table', 1),
(12, '2018_07_19_153838_create_apartament_feature_table', 1),
(13, '2018_07_21_134058_update_apartaments_table', 1),
(14, '2018_07_25_074606_update_images_table', 1),
(15, '2018_07_30_141245_update_advertisement_apartament_table', 1),
(16, '2018_07_31_134212_update_image_table', 1),
(17, '2018_07_31_134829_delete_apartament_service_table', 1),
(18, '2018_07_31_135310_delete_services_table', 1),
(19, '2018_08_02_150500_delete_advertisement_apartament_table', 1),
(20, '2018_08_02_150816_create_newadvertisement_apartament_table', 1),
(21, '2018_08_03_153538_update_messages_table', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `date_of_birth`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', '1991-10-10', 'admin.admin@gmail.com', '$2y$10$82AT1rkd8ujdxBQOQZjuFOJK22BT28bMzu2DnXJUZvwQUZPmo49NC', 'DFJDNEDAR1OuUFCUFVKL3VpSDTlV03UPdFkmFryvjUXvl05ZSez3i23BXY4F', '2018-08-07 05:50:39', '2018-08-07 05:50:39'),
(2, 'alessandro', 'lausdei', '1991-12-10', 'alessandro.lausdei@gmail.com', '$2y$10$Qkw2E3Sj1hHzZbBcjdBcVuHbcm5r0lyB8H0.3/IKfG644fD91ZRt.', NULL, '2018-08-07 09:55:11', '2018-08-07 09:55:11');

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `advertisement_apartament`
--
ALTER TABLE `advertisement_apartament`
  ADD CONSTRAINT `advertisement_apartament_advertisement_id_foreign` FOREIGN KEY (`advertisement_id`) REFERENCES `advertisements` (`id`),
  ADD CONSTRAINT `advertisement_apartament_apartament_id_foreign` FOREIGN KEY (`apartament_id`) REFERENCES `apartaments` (`id`);

--
-- Limiti per la tabella `apartaments`
--
ALTER TABLE `apartaments`
  ADD CONSTRAINT `apartaments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Limiti per la tabella `apartament_feature`
--
ALTER TABLE `apartament_feature`
  ADD CONSTRAINT `apartament_feature_apartament_id_foreign` FOREIGN KEY (`apartament_id`) REFERENCES `apartaments` (`id`),
  ADD CONSTRAINT `apartament_feature_feature_id_foreign` FOREIGN KEY (`feature_id`) REFERENCES `features` (`id`);

--
-- Limiti per la tabella `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_apartament_id_foreign` FOREIGN KEY (`apartament_id`) REFERENCES `apartaments` (`id`);

--
-- Limiti per la tabella `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_apartament_id_foreign` FOREIGN KEY (`apartament_id`) REFERENCES `apartaments` (`id`),
  ADD CONSTRAINT `messages_guest_user_id_foreign` FOREIGN KEY (`guest_user_id`) REFERENCES `guestusers` (`id`),
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
