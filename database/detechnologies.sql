-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 10, 2023 at 11:01 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `detechnologies`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1=Active, 0=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `countries_code_unique` (`code`),
  UNIQUE KEY `countries_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PK', 'Pakistan', 1, '2023-08-09 06:34:57', '2023-08-09 06:34:57'),
(2, 'US', 'United States', 1, '2023-08-09 06:34:57', '2023-08-09 06:34:57'),
(3, 'UK', 'United Kingdom', 1, '2023-08-09 06:34:57', '2023-08-09 06:34:57'),
(4, 'CN', 'China', 1, '2023-08-09 06:34:57', '2023-08-09 06:34:57');

-- --------------------------------------------------------

--
-- Table structure for table `experties_and_offerings`
--

DROP TABLE IF EXISTS `experties_and_offerings`;
CREATE TABLE IF NOT EXISTS `experties_and_offerings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '1=active, 0=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experties_and_offerings`
--

INSERT INTO `experties_and_offerings` (`id`, `title`, `description`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(6, 'Brand Identity', 'We create unique and powerful brand identities that help companies achieve their goals and stand out amoungst the competition.', 'images/1691611502-brand-identity.png', 1, '2023-08-09 14:39:49', '2023-08-09 15:06:05'),
(9, 'Company Profile', 'Our unique and powerful brand identities that help companies achieve their goals and stand out amoungst the competition.', 'images/1691612137-company-profile.png', 1, '2023-08-09 15:15:37', '2023-08-09 15:15:37');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2013_05_24_042018_create_settings_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_02_07_175529_create_motps_table', 1),
(7, '2023_05_15_185835_create_categories_table', 1),
(8, '2023_05_24_040932_create_supports_table', 1),
(9, '2023_08_09_112925_create_countries_table', 2),
(10, '2023_08_09_175304_create_experties_and_offerings_table', 3),
(11, '2023_08_10_043201_create_s_e_o_tags_table', 4),
(12, '2023_08_10_100233_create_themes_table', 5),
(13, '2023_08_10_104446_create_open_source_cultures_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `motps`
--

DROP TABLE IF EXISTS `motps`;
CREATE TABLE IF NOT EXISTS `motps` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `open_source_cultures`
--

DROP TABLE IF EXISTS `open_source_cultures`;
CREATE TABLE IF NOT EXISTS `open_source_cultures` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '1=active, 0=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `open_source_cultures`
--

INSERT INTO `open_source_cultures` (`id`, `title`, `description`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Company Profile', 'We create unique and powerful brand identities that help companies achieve their goals and stand out amoungst the competition.', 'images/1691665081-company-profile.png', 1, '2023-08-10 05:57:12', '2023-08-10 05:58:01');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_id`, `tokenable_type`, `name`, `avatar`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'b381cd38-ae0b-4cfe-b683-813e5f7e8f6f', 'App\\Models\\User', 'b381cd38-ae0b-4cfe-b683-813e5f7e8f6f', NULL, '08e363396ab33e6227f82c0f1d037566dccd6a4784c78b1ff02d2434650dbe71', '[\"*\"]', NULL, NULL, '2023-08-09 05:30:19', '2023-08-09 05:30:19'),
(2, '47f958da-2189-46ee-81b5-b6696c069435', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, 'c2c3a87c928640391d013473e49fe3567d62bfad42725d13ac588584a1d4c8af', '[\"*\"]', NULL, NULL, '2023-08-09 06:09:54', '2023-08-09 06:09:54'),
(3, '47f958da-2189-46ee-81b5-b6696c069435', 'App\\Models\\User', 'Laravel Password Grant Client', NULL, 'bbd4d090d689052c4595080db847f028d8fec268ee10ed9d81d40c9777d92539', '[\"*\"]', NULL, NULL, '2023-08-09 06:10:00', '2023-08-09 06:10:00'),
(4, '47f958da-2189-46ee-81b5-b6696c069435', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, '5e911a964b930529114140f61a703ba6c1875af30018531e2051430caa3aeed5', '[\"*\"]', NULL, NULL, '2023-08-09 06:11:38', '2023-08-09 06:11:38'),
(5, '47f958da-2189-46ee-81b5-b6696c069435', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, 'f18c0793bbac481c502ceb98abb6e2870eb7650603899a67f9743c2404f97797', '[\"*\"]', NULL, NULL, '2023-08-09 06:12:01', '2023-08-09 06:12:01'),
(6, '47f958da-2189-46ee-81b5-b6696c069435', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, '991ddd8b477a2d5edc1a5f09a5c8d8762264e65fb55eb7e5fb438f72e388042f', '[\"*\"]', NULL, NULL, '2023-08-09 13:50:37', '2023-08-09 13:50:37'),
(7, '47f958da-2189-46ee-81b5-b6696c069435', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, '7b3d8f0638b077e0e8aff2f5802064be4a7c973536b9c6c98c17c793d1301df8', '[\"*\"]', '2023-08-09 13:51:22', NULL, '2023-08-09 13:51:09', '2023-08-09 13:51:22'),
(8, '4aee638f-fc7d-49e2-82fe-79b2448147aa', 'App\\Models\\User', '4aee638f-fc7d-49e2-82fe-79b2448147aa', NULL, 'e2f2605e85609dd3b88185918cdd9186b07fec8b7607b5251e4e343cf9773786', '[\"*\"]', '2023-08-10 05:58:10', NULL, '2023-08-09 13:51:51', '2023-08-10 05:58:10');

-- --------------------------------------------------------

--
-- Table structure for table `seo_tags`
--

DROP TABLE IF EXISTS `seo_tags`;
CREATE TABLE IF NOT EXISTS `seo_tags` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8mb4_unicode_ci,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1=Active, 0=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `seo_tags_page_name_unique` (`page_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seo_tags`
--

INSERT INTO `seo_tags` (`id`, `page_name`, `seo_title`, `seo_description`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(2, 'home', 'Home Page', 'We create unique and powerful brand identities that help companies achieve their goals and stand out amoungst the competition.', 'images/1691643598-.png', 1, '2023-08-09 23:59:58', '2023-08-09 23:59:58');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `terms_of_use` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `privacy_policy` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_name` text COLLATE utf8mb4_unicode_ci,
  `app_logo` text COLLATE utf8mb4_unicode_ci,
  `app_icon` text COLLATE utf8mb4_unicode_ci,
  `app_email` text COLLATE utf8mb4_unicode_ci,
  `app_phone` text COLLATE utf8mb4_unicode_ci,
  `app_address` text COLLATE utf8mb4_unicode_ci,
  `about_us` text COLLATE utf8mb4_unicode_ci,
  `facebook` text COLLATE utf8mb4_unicode_ci,
  `twitter` text COLLATE utf8mb4_unicode_ci,
  `instagram` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supports`
--

DROP TABLE IF EXISTS `supports`;
CREATE TABLE IF NOT EXISTS `supports` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `about_heroic_block_pre_title` text COLLATE utf8mb4_unicode_ci,
  `about_heroic_block_title` text COLLATE utf8mb4_unicode_ci,
  `about_cta_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_open_source_culture` longtext COLLATE utf8mb4_unicode_ci,
  `services_heroic_block_pre_title` text COLLATE utf8mb4_unicode_ci,
  `services_heroic_block_title` text COLLATE utf8mb4_unicode_ci,
  `services_process_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `casestudy_heroic_block_pre_title` text COLLATE utf8mb4_unicode_ci,
  `casestudy_heroic_block_title` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`id`, `about_heroic_block_pre_title`, `about_heroic_block_title`, `about_cta_link`, `about_open_source_culture`, `services_heroic_block_pre_title`, `services_heroic_block_title`, `services_process_image`, `casestudy_heroic_block_pre_title`, `casestudy_heroic_block_title`, `created_at`, `updated_at`) VALUES
(1, 'ABOUT DEVELOPEVER', 'We\'re an employee-first company of friendly, creative problem solvers.', 'https://de-website-official.vercel.app/about', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum.\n\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy.\n\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that.', NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-10 05:40:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_code` bigint NOT NULL,
  `user_uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin' COMMENT 'admin, contributor',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `user_code`, `user_uuid`, `email_verified_at`, `password`, `user_type`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Sulaiman', 'sulaimanbarki@gmail.com', 19575473, '47f958da-2189-46ee-81b5-b6696c069435', NULL, '$2y$10$d7jmD.3r8BOY1.YsO1LxM.YKyisrHYvJxKVAv6REJYVRjeP/J7uVi', 'admin', NULL, 1, '2023-08-09 06:09:54', '2023-08-09 06:09:54'),
(4, 'Sulaiman', 'sulaimanbarkii@gmail.com', 61952528, '4aee638f-fc7d-49e2-82fe-79b2448147aa', NULL, '$2y$10$Q12iaEtHhufngqcYzKl0GuMBXFZ5k3gkmp0.PBCiRyFLEJxcdMRby', 'admin', NULL, 1, '2023-08-09 13:51:51', '2023-08-09 13:51:51');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
