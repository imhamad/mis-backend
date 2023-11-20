-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 07, 2023 at 06:07 AM
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
-- Table structure for table `about_page`
--

DROP TABLE IF EXISTS `about_page`;
CREATE TABLE IF NOT EXISTS `about_page` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `seo_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seo_meta_tags` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_heroic_block_pre_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `about_heroic_block_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `about_cta_link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_open_source_culture` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_page`
--

INSERT INTO `about_page` (`id`, `seo_title`, `seo_meta_tags`, `image`, `about_heroic_block_pre_title`, `about_heroic_block_title`, `about_cta_link`, `about_open_source_culture`, `created_at`, `updated_at`) VALUES
(1, 'SERVICE | CUSTOM DEVELOPMENT', 'Sustainable websites that captivate your audience by leveraging modern tech-stack', 'images/1691766138-about-page-image.png', 'ABOUT DEVELOPEVER', 'We\'re an employee-first company of friendly, creative problem solvers.', 'https://de-website-official.vercel.app/about', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum.\n\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy.\n\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that.', NULL, '2023-08-11 10:02:18');

-- --------------------------------------------------------

--
-- Table structure for table `background_colors`
--

DROP TABLE IF EXISTS `background_colors`;
CREATE TABLE IF NOT EXISTS `background_colors` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `color_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `background_colors`
--

INSERT INTO `background_colors` (`id`, `color_name`, `color_code`, `created_at`, `updated_at`) VALUES
(1, 'Red', '#ff0000', '2023-08-28 13:55:56', '2023-08-28 13:55:56'),
(2, 'Green', '#00ff00', '2023-08-28 13:56:31', '2023-08-28 13:56:31');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE IF NOT EXISTS `blogs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '1',
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `tag_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `slug`, `description`, `image`, `summary`, `status`, `user_id`, `category_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(1, 'UI/UX Design', 'ui-ux-design', 'Give your customers a web product that effectively solves their problems through intuitive navigation and clear content design. \n\nOur design team will dive deep into your audience’s wants and needs and employ their know-how of different design systems to deliver a professional web design service and create an interface that puts your customers front and center.', 'images/1693247001537-blog-image.png', NULL, 1, 13, 2, NULL, '2023-08-28 13:23:21', '2023-08-28 13:26:45'),
(2, 'Front end dev blog', 'front-end-dev-blog', 'Give your customers a web product that effectively solves their problems through intuitive navigation and clear content design.\n\nOur design team will dive deep into your audience’s wants and needs and employ their know-how of different design systems to deliver a professional web design service and create an interface that puts your customers front and center.', NULL, NULL, 2, 7, 1, NULL, '2023-09-17 11:07:15', '2023-09-17 11:07:15'),
(3, NULL, '', 'Give your customers a web product that effectively solves their problems through intuitive navigation and clear content design.\n\nOur design team will dive deep into your audience’s wants and needs and employ their know-how of different design systems to deliver a professional web design service and create an interface that puts your customers front and center.', NULL, NULL, 1, 7, 1, NULL, '2023-09-17 11:07:53', '2023-09-17 11:07:53'),
(4, NULL, '', 'Give your customers a web product that effectively solves their problems through intuitive navigation and clear content design.\n\nOur design team will dive deep into your audience’s wants and needs and employ their know-how of different design systems to deliver a professional web design service and create an interface that puts your customers front and center.', NULL, NULL, 1, 7, 1, NULL, '2023-09-17 11:09:45', '2023-09-17 11:09:45'),
(8, 'Draft blog', 'draft-blog', NULL, NULL, NULL, 1, 7, 1, NULL, '2023-09-17 11:15:56', '2023-09-17 11:15:56'),
(10, 'Front End / Backend Development', 'front-end-backend-development', 'Give your customers a web product that effectively solves their problems through intuitive navigation and clear content design.\n\nOur design team will dive deep into your audience’s wants and needs and employ their know-how of different design systems to deliver a professional web design service and create an interface that puts your customers front and center.', 'images/1695667173691-blogs.png', 'some long summary of the blog', 4, 7, 1, NULL, '2023-09-25 13:39:33', '2023-09-25 13:39:33');

-- --------------------------------------------------------

--
-- Table structure for table `blog_category`
--

DROP TABLE IF EXISTS `blog_category`;
CREATE TABLE IF NOT EXISTS `blog_category` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `blog_id` bigint UNSIGNED DEFAULT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_reviews`
--

DROP TABLE IF EXISTS `blog_reviews`;
CREATE TABLE IF NOT EXISTS `blog_reviews` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `blog_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `review` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `blog_status` int NOT NULL DEFAULT '1',
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_reviews`
--

INSERT INTO `blog_reviews` (`id`, `blog_id`, `user_id`, `review`, `blog_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 8, 3, 'The blog has some issues', 1, 1, '2023-09-22 00:11:56', '2023-09-22 00:11:56'),
(2, 8, 3, 'Blog has another issue', 1, 1, '2023-09-22 00:11:56', '2023-09-22 00:11:56');

-- --------------------------------------------------------

--
-- Table structure for table `case_studies`
--

DROP TABLE IF EXISTS `case_studies`;
CREATE TABLE IF NOT EXISTS `case_studies` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `seo_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seo_meta_tags` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pre_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `case_study_image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `about_the_client` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `industry_of_client` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `industry_of_client_image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `challenge` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `project_credit` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `category_id` int DEFAULT NULL,
  `client_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_designation` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_review` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `client_image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `case_studies`
--

INSERT INTO `case_studies` (`id`, `seo_title`, `seo_meta_tags`, `image`, `pre_title`, `title`, `slug`, `button_title`, `cta`, `case_study_image`, `tags`, `about_the_client`, `industry_of_client`, `industry_of_client_image`, `challenge`, `value`, `project_credit`, `category_id`, `client_name`, `client_designation`, `client_review`, `client_image`, `created_at`, `updated_at`) VALUES
(5, 'Your SEO Title', 'Your SEO Meta Tags', 'images/1691914068-sharing-image.png', NULL, 'Your Case Study Title', 'your-case-study-title', 'Your Button Title', 'Your Call to Action Text', 'images/1691914068-your-case-study-title.png', '\"Tag1, Tag2, Tag3\"', 'About the Client Text', 'Industry of the Client', 'images/1691914068-industry-of-client.png', 'Challenge Text', 'Value Text', 'Project Credit Text', 6, 'Client\'s Name', 'Client\'s Designation', 'Client\'s Review Text', 'images/1691914068-client-image.png', '2023-08-13 03:07:48', '2023-08-13 03:07:48'),
(6, 'Your SEO Title', 'Your SEO Meta Tags', 'images/1691918808-sharing-image.png', NULL, 'Perfect counter', 'perfect-counter', 'Your Button Title', 'Your Call to Action Text', 'images/1691918808-perfect-counter.png', '\"react\"', 'About the Client Text', 'Industry of the Client', 'images/1691918808-industry-of-client.png', 'Challenge Text', 'Value Text', 'Project Credit Text', 6, 'Client\'s Name', 'Client\'s Designation', 'Client\'s Review Text', 'images/1691918808-client-image.png', '2023-08-13 04:26:48', '2023-08-13 04:26:48'),
(13, 'Your SEO Title', 'Your SEO Meta Tags', 'images/1693469454699-sharing-image.png', NULL, 'Salty Lemon Social', 'salty-lemon-social', 'Your Button Title', 'Your Call to Action Text', 'images/1693469454873-salty-lemon-social.png', '\"next\"', 'About the Client Text', 'Industry of the Client', 'images/1693469454609-industry-of-client.png', 'Challenge Text', 'Value Text', 'Project Credit Text', 7, 'Client\'s Name', 'Client\'s Designation', 'Client\'s Review Text', 'images/1693469454727-client-image.png', '2023-08-28 11:44:16', '2023-08-31 03:10:54'),
(14, 'Your SEO Title', 'Your SEO Meta Tags', 'images/1693469040487-sharing-image.png', NULL, 'Supper App', 'supper-app', 'Your Button Title', 'Your Call to Action Text', 'images/1693469040855-supper-app.png', '\"next\"', 'About the Client Text', 'Industry of the Client', 'images/1693469040615-industry-of-client.png', 'Challenge Text', 'Value Text', NULL, 7, 'Client\'s Name', 'Client\'s Designation', 'Client\'s Review Text', 'images/1693469040691-client-image.png', '2023-08-31 03:04:00', '2023-08-31 03:04:00'),
(15, 'Your SEO Title', 'Your SEO Meta Tags', 'images/1693639388361-sharing-image.png', NULL, 'Supper App', 'supper-app', 'Your Button Title', 'Your Call to Action Text', 'images/1693639388786-supper-app.png', '\"next\"', 'About the Client Text', 'Industry of the Client', 'images/1693639388848-industry-of-client.png', 'Challenge Text', 'Value Text', NULL, 1, 'Client\'s Name', 'Client\'s Designation', 'Client\'s Review Text', 'images/1693639388399-client-image.png', '2023-09-02 02:23:08', '2023-09-02 02:23:08');

-- --------------------------------------------------------

--
-- Table structure for table `case_study_credits`
--

DROP TABLE IF EXISTS `case_study_credits`;
CREATE TABLE IF NOT EXISTS `case_study_credits` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `case_study_id` bigint UNSIGNED NOT NULL,
  `member_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `case_study_credits`
--

INSERT INTO `case_study_credits` (`id`, `case_study_id`, `member_id`, `created_at`, `updated_at`) VALUES
(1, 14, 1, '2023-08-31 03:04:00', '2023-08-31 03:04:00'),
(2, 14, 4, '2023-08-31 03:04:00', '2023-08-31 03:04:00'),
(3, 13, 1, '2023-08-31 03:10:54', '2023-08-31 03:10:54'),
(4, 13, 4, '2023-08-31 03:10:54', '2023-08-31 03:10:54'),
(5, 15, 1, '2023-09-02 02:23:08', '2023-09-02 02:23:08'),
(6, 15, 4, '2023-09-02 02:23:08', '2023-09-02 02:23:08');

-- --------------------------------------------------------

--
-- Table structure for table `case_study_members`
--

DROP TABLE IF EXISTS `case_study_members`;
CREATE TABLE IF NOT EXISTS `case_study_members` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `case_study_id` bigint UNSIGNED NOT NULL,
  `member_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `case_study_members`
--

INSERT INTO `case_study_members` (`id`, `case_study_id`, `member_id`, `created_at`, `updated_at`) VALUES
(3, 11, 1, '2023-08-28 11:23:39', '2023-08-28 11:23:39'),
(4, 11, 4, '2023-08-28 11:23:39', '2023-08-28 11:23:39'),
(5, 12, 1, '2023-08-28 11:24:19', '2023-08-28 11:24:19'),
(6, 12, 4, '2023-08-28 11:24:19', '2023-08-28 11:24:19'),
(7, 13, 1, '2023-08-28 11:44:16', '2023-08-28 11:44:16'),
(8, 13, 4, '2023-08-28 11:44:16', '2023-08-28 11:44:16'),
(9, 10, 1, '2023-08-28 12:20:49', '2023-08-28 12:20:49'),
(10, 10, 4, '2023-08-28 12:20:49', '2023-08-28 12:20:49'),
(11, 13, 1, '2023-08-31 03:06:59', '2023-08-31 03:06:59'),
(12, 13, 4, '2023-08-31 03:06:59', '2023-08-31 03:06:59');

-- --------------------------------------------------------

--
-- Table structure for table `case_study_page`
--

DROP TABLE IF EXISTS `case_study_page`;
CREATE TABLE IF NOT EXISTS `case_study_page` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `seo_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seo_meta_tags` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `casestudy_heroic_block_pre_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `casestudy_heroic_block_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `case_study_page`
--

INSERT INTO `case_study_page` (`id`, `seo_title`, `seo_meta_tags`, `image`, `casestudy_heroic_block_pre_title`, `casestudy_heroic_block_title`, `created_at`, `updated_at`) VALUES
(1, 'SERVICE | CUSTOM DEVELOPMENT', 'Sustainable websites that captivate your audience by leveraging modern tech-stack', 'images/1691766735-case-study-page-image.png', 'SERVICE | CUSTOM DEVELOPMENT', 'Sustainable websites that captivate your audience by leveraging modern tech-stack', NULL, '2023-08-11 10:12:15');

-- --------------------------------------------------------

--
-- Table structure for table `case_study_services`
--

DROP TABLE IF EXISTS `case_study_services`;
CREATE TABLE IF NOT EXISTS `case_study_services` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `case_study_id` bigint UNSIGNED NOT NULL,
  `service` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `case_study_services`
--

INSERT INTO `case_study_services` (`id`, `case_study_id`, `service`, `url`, `created_at`, `updated_at`) VALUES
(1, 3, 'Service 1', 'https://youtube.com', '2023-08-12 00:46:41', '2023-08-12 00:46:41'),
(2, 3, 'Service 2', 'https://youtube.com', '2023-08-12 00:46:42', '2023-08-12 00:46:42'),
(3, 4, 'Service 1', 'https://youtube.com', '2023-08-12 00:48:05', '2023-08-12 00:48:05'),
(4, 4, 'Service 2', 'https://youtube.com', '2023-08-12 00:48:05', '2023-08-12 00:48:05'),
(5, 5, 'Service 1', 'https://youtube.com', '2023-08-13 03:07:48', '2023-08-13 03:07:48'),
(6, 5, 'Service 2', 'https://youtube.com', '2023-08-13 03:07:48', '2023-08-13 03:07:48'),
(7, 6, 'Service 1', 'https://youtube.com', '2023-08-13 04:26:48', '2023-08-13 04:26:48'),
(8, 6, 'Service 2', 'https://youtube.com', '2023-08-13 04:26:48', '2023-08-13 04:26:48'),
(9, 7, 'Service 1', 'https://youtube.com', '2023-08-13 04:27:44', '2023-08-13 04:27:44'),
(10, 7, 'Service 2', 'https://youtube.com', '2023-08-13 04:27:44', '2023-08-13 04:27:44'),
(11, 8, 'Service 1', 'https://youtube.com', '2023-08-21 12:24:23', '2023-08-21 12:24:23'),
(12, 8, 'Service 2', 'https://youtube.com', '2023-08-21 12:24:23', '2023-08-21 12:24:23'),
(13, 9, 'Service 1', 'https://youtube.com', '2023-08-21 12:25:57', '2023-08-21 12:25:57'),
(14, 9, 'Service 2', 'https://youtube.com', '2023-08-21 12:25:57', '2023-08-21 12:25:57'),
(17, 11, 'Service 1', 'https://youtube.com', '2023-08-28 11:23:39', '2023-08-28 11:23:39'),
(18, 11, 'Service 2', 'https://youtube.com', '2023-08-28 11:23:39', '2023-08-28 11:23:39'),
(19, 12, 'Service 1', 'https://youtube.com', '2023-08-28 11:24:19', '2023-08-28 11:24:19'),
(20, 12, 'Service 2', 'https://youtube.com', '2023-08-28 11:24:19', '2023-08-28 11:24:19'),
(23, 10, 'Service 1', 'https://youtube.com', '2023-08-28 12:20:49', '2023-08-28 12:20:49'),
(24, 10, 'Service 2', 'https://youtube.com', '2023-08-28 12:20:49', '2023-08-28 12:20:49'),
(25, 14, 'Service 1', 'https://youtube.com', '2023-08-31 03:04:00', '2023-08-31 03:04:00'),
(26, 14, 'Service 2', 'https://youtube.com', '2023-08-31 03:04:00', '2023-08-31 03:04:00'),
(31, 13, 'Service 1', 'https://youtube.com', '2023-08-31 03:10:54', '2023-08-31 03:10:54'),
(32, 13, 'Service 2', 'https://youtube.com', '2023-08-31 03:10:54', '2023-08-31 03:10:54'),
(33, 15, 'Service 1', 'https://youtube.com', '2023-09-02 02:23:08', '2023-09-02 02:23:08'),
(34, 15, 'Service 2', 'https://youtube.com', '2023-09-02 02:23:08', '2023-09-02 02:23:08');

-- --------------------------------------------------------

--
-- Table structure for table `case_study_sliders`
--

DROP TABLE IF EXISTS `case_study_sliders`;
CREATE TABLE IF NOT EXISTS `case_study_sliders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `case_study_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descriptive_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `case_study_sliders`
--

INSERT INTO `case_study_sliders` (`id`, `case_study_id`, `title`, `descriptive_title`, `image`, `cta`, `created_at`, `updated_at`) VALUES
(1, 5, 'Drupal 9 Based Website', 'Build amazing Website', 'images/1691924473-drupal-9-based-website.png', 'call-to-action', '2023-08-13 06:01:13', '2023-08-13 06:01:13'),
(2, 5, 'Laravel Website with Vuejs', 'Build amazing Website', 'images/1691924906-laravel-website-with-vuejs.png', 'call-to-action', '2023-08-13 06:01:40', '2023-08-13 06:08:26'),
(3, 5, 'Laravel Website', 'Build amazing Website', 'images/1691924920-laravel-website.png', 'call-to-action', '2023-08-13 06:08:40', '2023-08-13 06:08:40');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('blog','case-study') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'blog',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `description`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Front End Dev', '', 'Laravel Dev', 'blog', '2023-08-28 13:34:34', '2023-08-28 13:34:34'),
(4, 'Back End Dev', 'back-end-dev', 'Laravel Dev', 'blog', '2023-08-28 13:50:13', '2023-08-28 13:50:13'),
(5, 'Full Stack', 'full-stack', 'Laravel Dev', 'blog', '2023-08-28 14:08:07', '2023-08-28 14:08:07'),
(6, 'drupal', 'drupal', 'Laravel Dev', 'case-study', '2023-09-02 03:00:24', '2023-09-02 03:00:24'),
(7, 'WordPress', 'wordpress', 'Laravel Dev', 'case-study', '2023-09-02 03:00:37', '2023-09-02 03:00:37');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '1=active, 0=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experties_and_offerings`
--

INSERT INTO `experties_and_offerings` (`id`, `title`, `description`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(6, 'Company Profile', 'We create unique and powerful brand identities that help companies achieve their goals and stand out amoungst the competition.', 'images/1693836978141-company-profile.png', 1, '2023-08-09 14:39:49', '2023-09-04 09:16:18'),
(9, 'Company Profile', 'Our unique and powerful brand identities that help companies achieve their goals and stand out amoungst the competition.', 'images/1691612137-company-profile.png', 1, '2023-08-09 15:15:37', '2023-08-09 15:15:37');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_page`
--

DROP TABLE IF EXISTS `home_page`;
CREATE TABLE IF NOT EXISTS `home_page` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `seo_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seo_meta_tags` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `countries` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_page`
--

INSERT INTO `home_page` (`id`, `seo_title`, `seo_meta_tags`, `image`, `countries`, `created_at`, `updated_at`) VALUES
(1, 'SERVICE | CUSTOM DEVELOPMENT', 'Sustainable websites that captivate your audience by leveraging modern tech-stack', 'images/1691895946-home-page-image.png', 'Pakistan,United States,United Kingdom,China', NULL, '2023-08-12 22:05:46');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(13, '2023_08_10_104446_create_open_source_cultures_table', 6),
(14, '2023_08_10_112938_create_our_clients_table', 7),
(15, '2023_08_10_121808_create_our_team_members_table', 8),
(22, '2023_08_11_144417_create_about_pages_table', 13),
(23, '2023_08_11_145306_create_service_pages_table', 14),
(24, '2023_08_11_150423_create_case_study_pages_table', 15),
(25, '2023_08_11_121510_create_case_studies_table', 16),
(26, '2023_08_11_122436_create_case_study_services_table', 17),
(28, '2023_08_11_132902_create_home_pages_table', 18),
(29, '2023_08_13_075143_add_col_to_case_studies_table', 19),
(30, '2023_08_13_104636_create_case_study_sliders_table', 20),
(33, '2023_08_21_172058_create_case_study_members_table', 22),
(34, '2023_08_27_031925_create_blogs_table', 23),
(35, '2023_08_27_032535_blog_category', 23),
(36, '2023_08_28_161436_add_cols_to_users', 24),
(37, '2023_08_28_184349_create_background_colors_table', 25),
(38, '2023_08_31_075531_create_case_study_credits_table', 26),
(39, '2023_09_19_130427_create_notifications_table', 27),
(40, '2023_09_21_115209_create_blog_reviews_table', 28),
(41, '2023_09_25_183441_add_summary_to_blog', 29),
(43, '2023_09_29_190005_add_request_status_to_user', 30),
(44, '2023_10_07_071319_create_testimonials_table', 31),
(45, '2023_08_10_130010_create_services_table', 32),
(48, '2023_10_17_182050_create_service_sections_table', 33),
(49, '2023_08_10_181741_create_service_deliverable_lists_table', 34),
(50, '2023_08_10_181954_create_service_deliverable_icons_table', 34),
(51, '2023_10_19_173017_add_slug_to_service', 35);

-- --------------------------------------------------------

--
-- Table structure for table `motps`
--

DROP TABLE IF EXISTS `motps`;
CREATE TABLE IF NOT EXISTS `motps` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `motps`
--

INSERT INTO `motps` (`id`, `user_email`, `otp_code`, `otp_type`, `created_at`, `updated_at`) VALUES
(4, 'contributor@gmail.com', '541439', 'forgot_password', '2023-08-18 06:06:54', '2023-08-18 06:06:54'),
(8, 'muhammad.suliman.75436@gmail.com', '145048', 'forgot_password', '2023-10-10 13:16:13', '2023-10-10 13:16:13');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `notification_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `notification_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'accept',
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `notification_title`, `notification_description`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 'Blog Approved', 'Admin has approved your blog. Ans is now available on website.', 'published', 'read', '2023-09-19 13:16:41', '2023-10-16 11:14:06'),
(2, 7, 'Blog Rejected', 'Admin has rejected your blog. Please review it.', 'cancelled', 'read', '2023-09-19 13:16:57', '2023-10-16 11:12:51'),
(3, 15, 'Account Approved', 'Your account has been approved by admin.', 'account_approved', 'unread', '2023-09-29 23:47:49', '2023-09-29 23:47:49'),
(4, NULL, 'Account Request', 'There is a new account request.', 'account_creation', 'unread', '2023-10-05 22:40:52', '2023-10-05 22:40:52'),
(5, NULL, 'Account Request', 'There is a new account request.', 'account_creation', 'unread', '2023-10-10 11:51:56', '2023-10-10 11:51:56'),
(6, NULL, 'Account Request', 'There is a new account request.', 'account_creation', 'unread', '2023-10-10 11:57:26', '2023-10-10 11:57:26'),
(7, NULL, 'Account Request', 'There is a new account request.', 'account_creation', 'unread', '2023-10-10 12:06:56', '2023-10-10 12:06:56'),
(8, NULL, 'Account Request', 'There is a new account request.', 'account_creation', 'unread', '2023-10-10 12:07:58', '2023-10-10 12:07:58'),
(9, NULL, 'Account Request', 'There is a new account request.', 'account_creation', 'unread', '2023-10-10 12:13:36', '2023-10-10 12:13:36'),
(10, NULL, 'Account Request', 'There is a new account request.', 'account_creation', 'unread', '2023-10-10 12:35:17', '2023-10-10 12:35:17'),
(11, NULL, 'Account Request', 'There is a new account request.', 'account_creation', 'unread', '2023-10-10 12:37:52', '2023-10-10 12:37:52'),
(12, NULL, 'Account Request', 'There is a new account request.', 'account_creation', 'unread', '2023-10-10 12:39:40', '2023-10-10 12:39:40'),
(13, NULL, 'Account Request', 'There is a new account request.', 'account_creation', 'unread', '2023-10-10 12:41:51', '2023-10-10 12:41:51'),
(14, 25, 'Account Approved', 'Your account has been approved by admin.', 'account_approved', 'unread', '2023-10-10 12:59:17', '2023-10-10 12:59:17');

-- --------------------------------------------------------

--
-- Table structure for table `open_source_cultures`
--

DROP TABLE IF EXISTS `open_source_cultures`;
CREATE TABLE IF NOT EXISTS `open_source_cultures` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '1=active, 0=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `open_source_cultures`
--

INSERT INTO `open_source_cultures` (`id`, `title`, `description`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Company Profile', 'We create unique and powerful brand identities that help companies achieve their goals and stand out amoungst the competition.', 'images/1691665081-company-profile.png', 1, '2023-08-10 05:57:12', '2023-08-10 05:58:01'),
(3, 'In publishing and gr', 'Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a ty', 'images/1692515630-in-publishing-and-gr.png', 1, '2023-08-20 02:13:50', '2023-08-20 02:13:50');

-- --------------------------------------------------------

--
-- Table structure for table `our_clients`
--

DROP TABLE IF EXISTS `our_clients`;
CREATE TABLE IF NOT EXISTS `our_clients` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('client','partner','current','previous') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'client',
  `status` tinyint DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `our_clients`
--

INSERT INTO `our_clients` (`id`, `name`, `logo`, `link`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Company Profile', 'images/1691669566-company-profile.png', 'https://facebook.com', 'current', 1, '2023-08-10 06:51:03', '2023-08-10 07:12:46'),
(2, 'YouTube', 'images/1691669593-youtube.png', 'https://youtube.com', 'current', 1, '2023-08-10 07:13:13', '2023-08-10 07:13:13'),
(4, 'YouTube', 'images/1691669644-youtube.png', 'https://youtube.com', 'previous', 1, '2023-08-10 07:14:04', '2023-08-10 07:14:04');

-- --------------------------------------------------------

--
-- Table structure for table `our_team_members`
--

DROP TABLE IF EXISTS `our_team_members`;
CREATE TABLE IF NOT EXISTS `our_team_members` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `our_team_members`
--

INSERT INTO `our_team_members` (`id`, `name`, `designation`, `image`, `url`, `created_at`, `updated_at`) VALUES
(1, 'Barki', 'Programmer', 'images/1692529429-barki.png', 'https://facebook.com', '2023-08-10 07:30:21', '2023-08-20 06:03:49'),
(2, 'Wali Ullah', 'Front End Dev', 'images/1691670643-wali-ullah.png', 'https://youtube.com', '2023-08-10 07:30:43', '2023-08-10 07:30:43'),
(4, 'Suliman Barki', 'Laravel Dev', 'images/1691670665-suliman-barki.png', NULL, '2023-08-10 07:31:05', '2023-08-10 07:31:05');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `tokenable_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_id`, `tokenable_type`, `name`, `avatar`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(4, '11', 'App\\Models\\User', 'd0aa52c6-ad29-4051-a2b9-260731285dd2', NULL, '4592132cf4b96f28bff3a7eb59a2d46c33c25495a9b581f0a1d74426871f5fa9', '[\"*\"]', '2023-08-18 06:24:31', NULL, '2023-08-18 05:24:07', '2023-08-18 06:24:31'),
(5, '11', 'App\\Models\\User', 'd0aa52c6-ad29-4051-a2b9-260731285dd2', NULL, '53d89305a5d1e707d9701609d1d68f5386db37899f97eb68731d8d63554775ad', '[\"*\"]', NULL, NULL, '2023-08-18 06:31:45', '2023-08-18 06:31:45'),
(7, '3', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, 'c5447ba05e2c2d447116f2f91dbee2fdf1a63b3b0f4473f1dd0d24e98624fb92', '[\"*\"]', '2023-08-18 06:36:47', NULL, '2023-08-18 06:35:45', '2023-08-18 06:36:47'),
(8, '11', 'App\\Models\\User', 'd0aa52c6-ad29-4051-a2b9-260731285dd2', NULL, '79583507cff7422af875f4a3b28735eaa4ce4b375060eb07799eb7b29edcb0c9', '[\"*\"]', '2023-08-18 06:50:47', NULL, '2023-08-18 06:47:42', '2023-08-18 06:50:47'),
(9, '3', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, '746862af403fbfaf6698b1d8d8c932513adaa5c67162cd2f5c3613c359a08f17', '[\"*\"]', NULL, NULL, '2023-08-18 20:27:39', '2023-08-18 20:27:39'),
(10, '3', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, '75fccc4a8f671301f8520cca36a019283ba9d0743e1718ec274c15decb8b645c', '[\"*\"]', NULL, NULL, '2023-08-18 20:30:26', '2023-08-18 20:30:26'),
(11, '3', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, '23b372567a90f9e4883e01e30e4308d76dd708f921ec08cf770f84ab0c7b75a2', '[\"*\"]', NULL, NULL, '2023-08-18 20:39:15', '2023-08-18 20:39:15'),
(12, '3', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, 'f4a24745c6a0932b89c6983c6a4e37ea60c646c6f2bf0a2befe6d70f6b35805e', '[\"*\"]', '2023-08-28 12:20:49', NULL, '2023-08-18 20:45:00', '2023-08-28 12:20:49'),
(13, '3', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, '48a274e2fb072c3b237f0798001bed1c7c1ff5cda70b7d8271d7cd4680f7e320', '[\"*\"]', NULL, NULL, '2023-08-19 05:06:56', '2023-08-19 05:06:56'),
(14, '3', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, 'aae84df84cc023126288f666925f9058c6d2b4b8fe8db70ae4c77491afc45196', '[\"*\"]', NULL, NULL, '2023-08-19 05:09:25', '2023-08-19 05:09:25'),
(15, '3', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, '36d84792f5497b867c33d14a89a11fdcddd419815b2435cecdf46d0a5cf1bbc0', '[\"*\"]', '2023-08-20 05:51:30', NULL, '2023-08-20 01:01:06', '2023-08-20 05:51:30'),
(16, '12', 'App\\Models\\User', '85f00e37-26d1-4d3b-ae70-f0ed6b54f98c', NULL, 'e62a3838ff9922806d39af88be74c3b546137e724c70ed65ef3461d2ca8bbe08', '[\"*\"]', NULL, NULL, '2023-08-28 12:28:20', '2023-08-28 12:28:20'),
(17, '12', 'App\\Models\\User', '85f00e37-26d1-4d3b-ae70-f0ed6b54f98c', NULL, '5fc3d48b64369eb7b037535b1762de3d7c45e4273a3d4502805002d77dcfc7dc', '[\"*\"]', NULL, NULL, '2023-08-28 12:29:44', '2023-08-28 12:29:44'),
(18, '13', 'App\\Models\\User', '3ea93e79-b529-4325-9420-561d745c8e79', NULL, '44aca26700bfba95dd23ad113702c06c354baa8c2dc327f8fa020d379872be50', '[\"*\"]', NULL, NULL, '2023-08-28 12:30:46', '2023-08-28 12:30:46'),
(19, '13', 'App\\Models\\User', '3ea93e79-b529-4325-9420-561d745c8e79', NULL, '6361d2061e2b9424c832454633fecb2b9fb0e4089a9e4124c5169a70fd5077f1', '[\"*\"]', '2023-08-28 13:34:11', NULL, '2023-08-28 12:30:54', '2023-08-28 13:34:11'),
(20, '3', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, '93795ed2438d9ef876b5a7fae254a2162cbe95ad97e174f754e0729f74342208', '[\"*\"]', '2023-08-28 14:00:11', NULL, '2023-08-28 13:34:29', '2023-08-28 14:00:11'),
(21, '3', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, '883a66363975ac751e35a1442de96056b7a7dcb604c264ae472c920f509a34b5', '[\"*\"]', '2023-08-28 14:08:07', NULL, '2023-08-28 14:07:34', '2023-08-28 14:08:07'),
(22, '3', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, 'def09b74c2f1f96cb9f2dd382fed525de6168c7866026416fca75184aed84d62', '[\"*\"]', '2023-08-31 03:10:54', NULL, '2023-08-31 03:03:55', '2023-08-31 03:10:54'),
(23, '3', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, '8c59968bbd1037ae9bb8b7af6e44824cfea675e3feedd7100338b83658e1e410', '[\"*\"]', '2023-09-04 09:16:18', NULL, '2023-09-02 02:22:29', '2023-09-04 09:16:18'),
(24, '13', 'App\\Models\\User', '3ea93e79-b529-4325-9420-561d745c8e79', NULL, '6891974dcff67494c6dbd5c7ff284d6003ce71df0b48e7e8c88e5deffe78b04b', '[\"*\"]', NULL, NULL, '2023-09-15 13:05:33', '2023-09-15 13:05:33'),
(25, '14', 'App\\Models\\User', '379f613e-7266-4a39-8d2a-a6cdf3c79f28', NULL, 'e933373aa53516be7cd8e56aea7faabdb593a6468da3df2ac780e851a14855ea', '[\"*\"]', '2023-09-18 13:09:50', NULL, '2023-09-17 07:27:55', '2023-09-18 13:09:50'),
(26, '14', 'App\\Models\\User', '379f613e-7266-4a39-8d2a-a6cdf3c79f28', NULL, '56f406667a1938e862a125c268ad963a0cf7183c8b9e0600d6b44c128fa7b1c9', '[\"*\"]', '2023-09-19 08:11:48', NULL, '2023-09-18 13:11:55', '2023-09-19 08:11:48'),
(27, '7', 'App\\Models\\User', '379f613e-7266-4a39-8d2a-a6cdf3c79f28', NULL, '584719d127a2bf0498c98f46d61e46a338a0410a94cbc97b88301dc9f7e4b89c', '[\"*\"]', '2023-09-21 06:26:37', NULL, '2023-09-19 08:55:07', '2023-09-21 06:26:37'),
(28, '3', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, '22d839c22b430be0ed4d05f8e244475e2c38c73bf951ab705aa80071197903cf', '[\"*\"]', '2023-09-21 09:55:10', NULL, '2023-09-21 06:26:53', '2023-09-21 09:55:10'),
(29, '3', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, '4d0a1092430df5aaa97e8cb1713d18dde49be779e4ec74dfdd8973435ad0fbde', '[\"*\"]', '2023-09-22 00:11:56', NULL, '2023-09-21 23:49:36', '2023-09-22 00:11:56'),
(30, '7', 'App\\Models\\User', '379f613e-7266-4a39-8d2a-a6cdf3c79f28', NULL, 'b4fae23b7c9835d44e0acd2717610e2d51f3c1765be81a0a641be231b57baa56', '[\"*\"]', '2023-09-22 02:03:26', NULL, '2023-09-22 01:37:19', '2023-09-22 02:03:26'),
(31, '7', 'App\\Models\\User', '379f613e-7266-4a39-8d2a-a6cdf3c79f28', NULL, 'efe61f3fdcdf4620f4b3120c39dc9d30b101a4a9ef2e75e72b0b28363742b51a', '[\"*\"]', '2023-09-23 08:03:25', NULL, '2023-09-23 07:50:04', '2023-09-23 08:03:25'),
(32, '7', 'App\\Models\\User', '379f613e-7266-4a39-8d2a-a6cdf3c79f28', NULL, '780b3dff9c94122f8f483c53a9fe61003fb1e538b0c9112260ae9701c64abd0a', '[\"*\"]', NULL, NULL, '2023-09-23 08:03:46', '2023-09-23 08:03:46'),
(33, '7', 'App\\Models\\User', '379f613e-7266-4a39-8d2a-a6cdf3c79f28', NULL, 'c4ffeb7f9cc4d02662bfd8a7275b2b4b5716163d66f46bad4d1233f7ad4d8c50', '[\"*\"]', '2023-09-23 08:52:31', NULL, '2023-09-23 08:51:52', '2023-09-23 08:52:31'),
(34, '7', 'App\\Models\\User', '379f613e-7266-4a39-8d2a-a6cdf3c79f28', NULL, '166f5b9bceb24f799bf210a3f700523d02c8f29b9a4d8f30a3ea774dafc198d1', '[\"*\"]', '2023-09-25 13:42:46', NULL, '2023-09-25 13:39:27', '2023-09-25 13:42:46'),
(35, '7', 'App\\Models\\User', '379f613e-7266-4a39-8d2a-a6cdf3c79f28', NULL, '639b0ef4bb6171b8f11c72bf95f7ef79cae2af1727e0647e7206ebbb6d922678', '[\"*\"]', '2023-09-26 12:02:42', NULL, '2023-09-26 12:01:21', '2023-09-26 12:02:42'),
(36, '7', 'App\\Models\\User', '379f613e-7266-4a39-8d2a-a6cdf3c79f28', NULL, 'e718e403b814d7867407e6d612895e476d89ed5859711cb7b752b8bc59727feb', '[\"*\"]', NULL, NULL, '2023-09-26 12:01:34', '2023-09-26 12:01:34'),
(37, '7', 'App\\Models\\User', '379f613e-7266-4a39-8d2a-a6cdf3c79f28', NULL, '67610c9cc5dc1e2a2829533c47cb0fedc43e9edfb3ec7bbbf17343c13b0199c0', '[\"*\"]', NULL, NULL, '2023-09-26 12:02:30', '2023-09-26 12:02:30'),
(38, '7', 'App\\Models\\User', '379f613e-7266-4a39-8d2a-a6cdf3c79f28', NULL, '083a53994d1a2a4b41d936fcc4d47ec8b16e85b3aaafacaf648f423d90722dcd', '[\"*\"]', NULL, NULL, '2023-09-26 12:02:42', '2023-09-26 12:02:42'),
(39, '3', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, '51cb8d9a59327f13bfad5c42b8121b1e65e3ade9303d44f98e814118123a6180', '[\"*\"]', '2023-09-27 00:30:17', NULL, '2023-09-26 12:09:10', '2023-09-27 00:30:17'),
(40, '3', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, 'bfac68eb4b3b4e4ebf17cc645e7d434fd03285d5a1e652cd02b30c7f4c0dba9c', '[\"*\"]', '2023-09-27 00:43:12', NULL, '2023-09-27 00:42:52', '2023-09-27 00:43:12'),
(41, '7', 'App\\Models\\User', '379f613e-7266-4a39-8d2a-a6cdf3c79f28', NULL, '837245e446b391a99c247f95b32216932534aa54a2b7bec9031c1c11d188068e', '[\"*\"]', '2023-09-27 00:49:31', NULL, '2023-09-27 00:43:30', '2023-09-27 00:49:31'),
(42, '3', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, '186fe5e5b9a3ed5c547c53aa0ca072b87d5aa0447b80578be695e546a271bb68', '[\"*\"]', '2023-09-29 22:59:10', NULL, '2023-09-28 11:42:31', '2023-09-29 22:59:10'),
(43, '3', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, 'e751c79b26b3d106b06e4f15e6c13fdc9fbd33b9c7abc2ca647c6b57e230fb15', '[\"*\"]', '2023-10-05 13:02:04', NULL, '2023-09-29 23:06:08', '2023-10-05 13:02:04'),
(44, '3', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, 'b30dc5dc4ad26ac9cda711b7b04d8ce443bee0c6a9880d158aa357748f550ab0', '[\"*\"]', '2023-10-05 13:11:23', NULL, '2023-10-05 13:05:15', '2023-10-05 13:11:23'),
(45, '7', 'App\\Models\\User', '379f613e-7266-4a39-8d2a-a6cdf3c79f28', NULL, '5bd7040cb2a4898867ad0ab6bd8106e2ab9dd65e1a9be0b61b105622a2be46f2', '[\"*\"]', '2023-10-05 13:26:40', NULL, '2023-10-05 13:12:18', '2023-10-05 13:26:40'),
(46, '3', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, '0cec3e57f77406f033c5748b1df754b4aedeac0df235fbfcdfca416d142df8df', '[\"*\"]', '2023-10-05 13:37:38', NULL, '2023-10-05 13:37:26', '2023-10-05 13:37:38'),
(47, '3', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, '25d78161fef0403658245a384b4a26d92cdcfd9cbb5f0f3ab80419787a920596', '[\"*\"]', '2023-10-05 13:48:08', NULL, '2023-10-05 13:37:51', '2023-10-05 13:48:08'),
(48, '3', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, '54d83b3513563a3eb24537bca2bccf8ad88c15c3618159667519f30f1b60e781', '[\"*\"]', '2023-10-08 11:34:14', NULL, '2023-10-06 00:39:02', '2023-10-08 11:34:14'),
(49, '3', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, '7c3a4553f5ce1bbf8e98e6d65e26ef1de0787af09c641900c7eeec187df13740', '[\"*\"]', '2023-10-10 13:08:07', NULL, '2023-10-10 12:58:24', '2023-10-10 13:08:07'),
(50, '7', 'App\\Models\\User', '379f613e-7266-4a39-8d2a-a6cdf3c79f28', NULL, '1463c7fc0600e69388b5c66a9f47d1a56cb672d876146c90255fa3fcf6834a30', '[\"*\"]', '2023-10-17 13:01:20', NULL, '2023-10-16 10:47:28', '2023-10-17 13:01:20'),
(51, '3', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, '904304ce203521982685c718caa9b584b4d6732abbe4310024b44672f43ba713', '[\"*\"]', '2023-10-17 13:10:36', NULL, '2023-10-17 13:01:33', '2023-10-17 13:10:36'),
(52, '3', 'App\\Models\\User', '47f958da-2189-46ee-81b5-b6696c069435', NULL, '0e63f63569c5064b044140bd033603b8babd0477710284030ce4562226d2c47f', '[\"*\"]', '2023-10-19 12:49:56', NULL, '2023-10-18 02:25:42', '2023-10-19 12:49:56');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `seo_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seo_meta_tags` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_pre_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `service_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `service_icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_designation` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_review` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `client_image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `seo_title`, `seo_meta_tags`, `image`, `service_pre_title`, `service_title`, `slug`, `service_description`, `service_icon`, `client_name`, `client_designation`, `client_review`, `client_image`, `created_at`, `updated_at`) VALUES
(1, 'SEO title of the service details', 'Planning SEO title of the service details', 'images/1697565699321-service-image.png', 'A Short pre title', 'This service describes itself', NULL, 'Give your customers a web product that effectively solves their problems through intuitive navigation and clear content design.\nOur design team will dive deep into your audience’s wants and needs and employ their know-how of different design systems to deliver a professional web design service and create an interface that puts your customers front and center.', 'images/1697565699233-service-icon.png', 'John Doe', 'Shawn Doe', 'Give your customers a web product that effectively solves their problems through intuitive navigation and clear content design.\nOur design team will dive deep into your audience’s wants and needs and employ their know-how of different design systems to deliver a professional web design service and create an interface that puts your customers front and center.', 'images/1697565699864-client-image.png', '2023-10-17 13:01:39', '2023-10-17 13:01:39'),
(3, 'A Second Service', 'Planning SEO title of the service details', 'images/1697566223923-service-image.png', 'A Short pre title', 'This service describes itself', NULL, 'Give your customers a web product that effectively solves their problems through intuitive navigation and clear content design.\nOur design team will dive deep into your audience’s wants and needs and employ their know-how of different design systems to deliver a professional web design service and create an interface that puts your customers front and center.', 'images/1697566223370-service-icon.png', 'John Doe', 'Shawn Doe', 'Give your customers a web product that effectively solves their problems through intuitive navigation and clear content design.\nOur design team will dive deep into your audience’s wants and needs and employ their know-how of different design systems to deliver a professional web design service and create an interface that puts your customers front and center.', 'images/1697566223926-client-image.png', '2023-10-17 13:10:23', '2023-10-17 13:10:23'),
(4, 'A Second Service', 'Planning SEO title of the service details', 'images/1697736861681-service-image.png', 'A Short pre title', 'This service describes itself', 'this-service-describes-itself', 'Give your customers a web product that effectively solves their problems through intuitive navigation and clear content design.\nOur design team will dive deep into your audience’s wants and needs and employ their know-how of different design systems to deliver a professional web design service and create an interface that puts your customers front and center.', 'images/1697736861782-service-icon.png', 'John Doe', 'Shawn Doe', 'Give your customers a web product that effectively solves their problems through intuitive navigation and clear content design.\nOur design team will dive deep into your audience’s wants and needs and employ their know-how of different design systems to deliver a professional web design service and create an interface that puts your customers front and center.', 'images/1697736861868-client-image.png', '2023-10-19 12:34:21', '2023-10-19 12:34:21');

-- --------------------------------------------------------

--
-- Table structure for table `service_deliverable_icons`
--

DROP TABLE IF EXISTS `service_deliverable_icons`;
CREATE TABLE IF NOT EXISTS `service_deliverable_icons` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_section_id` bigint UNSIGNED NOT NULL,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_deliverable_icons`
--

INSERT INTO `service_deliverable_icons` (`id`, `service_section_id`, `icon`, `created_at`, `updated_at`) VALUES
(1, 1, 'images/1697614695972-service-deliverable-icon.png', '2023-10-18 02:38:15', '2023-10-18 02:38:15'),
(2, 1, 'images/1697614695161-service-deliverable-icon.png', '2023-10-18 02:38:15', '2023-10-18 02:38:15'),
(3, 2, 'images/1697737236630-service-deliverable-icon.png', '2023-10-19 12:40:36', '2023-10-19 12:40:36'),
(4, 2, 'images/1697737236796-service-deliverable-icon.png', '2023-10-19 12:40:36', '2023-10-19 12:40:36'),
(5, 3, 'images/1697737238262-service-deliverable-icon.png', '2023-10-19 12:40:38', '2023-10-19 12:40:38'),
(6, 3, 'images/1697737238717-service-deliverable-icon.png', '2023-10-19 12:40:38', '2023-10-19 12:40:38'),
(7, 4, 'images/1697737796986-service-deliverable-icon.png', '2023-10-19 12:49:56', '2023-10-19 12:49:56'),
(8, 4, 'images/1697737796388-service-deliverable-icon.png', '2023-10-19 12:49:56', '2023-10-19 12:49:56');

-- --------------------------------------------------------

--
-- Table structure for table `service_deliverable_lists`
--

DROP TABLE IF EXISTS `service_deliverable_lists`;
CREATE TABLE IF NOT EXISTS `service_deliverable_lists` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_section_id` bigint UNSIGNED NOT NULL,
  `bullet_point` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_deliverable_lists`
--

INSERT INTO `service_deliverable_lists` (`id`, `service_section_id`, `bullet_point`, `created_at`, `updated_at`) VALUES
(1, 1, 'AI', '2023-10-18 02:38:15', '2023-10-18 02:38:15'),
(2, 1, 'UX', '2023-10-18 02:38:15', '2023-10-18 02:38:15'),
(3, 1, 'UI', '2023-10-18 02:38:15', '2023-10-18 02:38:15'),
(4, 2, 'AI', '2023-10-19 12:40:36', '2023-10-19 12:40:36'),
(5, 2, 'UX', '2023-10-19 12:40:36', '2023-10-19 12:40:36'),
(6, 2, 'UI', '2023-10-19 12:40:36', '2023-10-19 12:40:36'),
(7, 3, 'AI', '2023-10-19 12:40:38', '2023-10-19 12:40:38'),
(8, 3, 'UX', '2023-10-19 12:40:38', '2023-10-19 12:40:38'),
(9, 3, 'UI', '2023-10-19 12:40:38', '2023-10-19 12:40:38'),
(10, 4, 'AI', '2023-10-19 12:49:56', '2023-10-19 12:49:56'),
(11, 4, 'UX', '2023-10-19 12:49:56', '2023-10-19 12:49:56'),
(12, 4, 'UI', '2023-10-19 12:49:56', '2023-10-19 12:49:56');

-- --------------------------------------------------------

--
-- Table structure for table `service_page`
--

DROP TABLE IF EXISTS `service_page`;
CREATE TABLE IF NOT EXISTS `service_page` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `seo_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seo_meta_tags` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `services_heroic_block_pre_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `services_heroic_block_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `services_process_image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_page`
--

INSERT INTO `service_page` (`id`, `seo_title`, `seo_meta_tags`, `image`, `services_heroic_block_pre_title`, `services_heroic_block_title`, `services_process_image`, `created_at`, `updated_at`) VALUES
(1, 'SERVICE | CUSTOM DEVELOPMENT', 'Sustainable websites that captivate your audience by leveraging modern tech-stack', 'images/1692531016-service-page-image.png', 'SERVICE | CUSTOM DEVELOPMENT', 'Sustainable websites that captivate your audience by leveraging modern tech-stack', 'images/1692531016-service-page-process-image.png', NULL, '2023-08-20 06:30:16');

-- --------------------------------------------------------

--
-- Table structure for table `service_sections`
--

DROP TABLE IF EXISTS `service_sections`;
CREATE TABLE IF NOT EXISTS `service_sections` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_id` bigint UNSIGNED DEFAULT NULL,
  `breadcrumb_title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `breadcrumb_slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `service_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `service_background_color` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_content_direction` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ltr',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_sections`
--

INSERT INTO `service_sections` (`id`, `service_id`, `breadcrumb_title`, `breadcrumb_slug`, `service_title`, `service_description`, `service_background_color`, `service_content_direction`, `created_at`, `updated_at`) VALUES
(1, 1, 'Front-End', 'front-end', 'Planning SEO title of the service details', 'Give your customers a web product that effectively solves their problems through intuitive navigation and clear content design.\nOur design team will dive deep into your audience’s wants and needs and employ their know-how of different design systems to deliver a professional web design service and create an interface that puts your customers front and center.', '#ffddaa', 'rtl', '2023-10-18 02:38:15', '2023-10-18 02:38:15'),
(2, 4, 'Front-End', 'front-end', 'Planning SEO title of the service details', 'Give your customers a web product that effectively solves their problems through intuitive navigation and clear content design.\nOur design team will dive deep into your audience’s wants and needs and employ their know-how of different design systems to deliver a professional web design service and create an interface that puts your customers front and center.', '#ffddaa', 'rtl', '2023-10-19 12:40:36', '2023-10-19 12:40:36'),
(3, 4, 'Front-End', 'front-end', 'Planning SEO title of the service details', 'Give your customers a web product that effectively solves their problems through intuitive navigation and clear content design.\nOur design team will dive deep into your audience’s wants and needs and employ their know-how of different design systems to deliver a professional web design service and create an interface that puts your customers front and center.', '#ffddaa', 'rtl', '2023-10-19 12:40:38', '2023-10-19 12:40:38'),
(4, 4, 'Back-End', 'back-end', 'Planning SEO title of the service details', 'Give your customers a web product that effectively solves their problems through intuitive navigation and clear content design.\nOur design team will dive deep into your audience’s wants and needs and employ their know-how of different design systems to deliver a professional web design service and create an interface that puts your customers front and center.', '#ffddaa', 'rtl', '2023-10-19 12:49:56', '2023-10-19 12:49:56');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `terms_of_use` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `privacy_policy` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `app_logo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `app_icon` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `app_email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `app_phone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `app_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `about_us` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `facebook` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `twitter` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `instagram` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `description`, `name`, `designation`, `company`, `image`, `video`, `type`, `created_at`, `updated_at`) VALUES
(1, 'review of the client about us', 'name of the client', 'CEO', 'Barki Graph', 'images/1696664294941-name-of-the-client.png', NULL, 'home-page', '2023-10-07 02:38:14', '2023-10-07 02:38:14'),
(2, 'review of the client about us', 'John Doe', 'Manager', 'Barki Graph', 'images/1696664346914-john-doe.png', NULL, 'service-page', '2023-10-07 02:39:06', '2023-10-07 02:39:06'),
(4, 'review of the client about us', 'John Doe', 'Manager', 'Barki Graph', 'images/1696664745633-john-doe.png', NULL, 'casestudy-page', '2023-10-07 02:45:45', '2023-10-07 02:45:45'),
(5, 'review of the client about us', 'John Doe', 'Manager', 'Barki Graph', 'images/1696782840679-john-doe.png', NULL, NULL, '2023-10-08 11:34:00', '2023-10-08 11:34:00');

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `about_heroic_block_pre_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `about_heroic_block_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `about_cta_link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_open_source_culture` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `services_heroic_block_pre_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `services_heroic_block_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `services_process_image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `casestudy_heroic_block_pre_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `casestudy_heroic_block_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`id`, `about_heroic_block_pre_title`, `about_heroic_block_title`, `about_cta_link`, `about_open_source_culture`, `services_heroic_block_pre_title`, `services_heroic_block_title`, `services_process_image`, `casestudy_heroic_block_pre_title`, `casestudy_heroic_block_title`, `created_at`, `updated_at`) VALUES
(1, 'ABOUT DEVELOPEVER', 'We\'re an employee-first company of friendly, creative problem solvers.', 'https://de-website-official.vercel.app/about', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum.\n\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy.\n\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that.', 'SERVICE | CUSTOM DEVELOPMENT', 'Sustainable websites that captivate your audience by leveraging modern tech-stack', 'images/1691680757-service-process-imag.png', 'CASE STUDIES', 'Impact of Sustainable work under friendly environment', NULL, '2023-08-10 10:19:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `linkedin_url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_code` bigint NOT NULL,
  `user_uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin' COMMENT 'admin, contributor',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `request_status` enum('pending','approved','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `last_name`, `description`, `linkedin_url`, `email`, `user_code`, `user_uuid`, `email_verified_at`, `password`, `avatar`, `user_type`, `remember_token`, `status`, `request_status`, `created_at`, `updated_at`) VALUES
(3, 'Sulaima Barki', NULL, NULL, NULL, NULL, 'sulaimanbarki@gmail.com', 19575473, '47f958da-2189-46ee-81b5-b6696c069435', NULL, '$2y$10$LflAO2Crwh3sEaeybQ6diODNaSKT.3hc6PO0mIavxbT92H.OhLjey', NULL, 'admin', NULL, 2, 'pending', '2023-08-09 06:09:54', '2023-08-18 06:36:47'),
(7, 'Contributor Khan', 'Contributor', 'Khan', 'some long detailed description', 'https://www.linkedin.com/barki', 'contributor@gmail.com', 2583285, '379f613e-7266-4a39-8d2a-a6cdf3c79f28', NULL, '$2y$10$LflAO2Crwh3sEaeybQ6diODNaSKT.3hc6PO0mIavxbT92H.OhLjey', 'images/1695747762784-2583285.png', 'contributor', NULL, 2, 'approved', '2023-09-17 07:27:55', '2023-09-29 22:59:36'),
(13, 'Contributor Khan', 'Contributor', 'Khan', 'some long detailed description', 'https://www.linkedin.com/barki', 'contributorkhan@gmail.com', 25515667, '3ea93e79-b529-4325-9420-561d745c8e79', NULL, '$2y$10$Av3cYmbCoYh0bBWJEC50He7D/GpgtO7TnH4X3Lhk.98xJ5kJ154dS', NULL, 'contributor', NULL, 2, 'pending', '2023-08-28 12:30:46', '2023-08-28 12:33:21'),
(15, 'Muhammad Suliman', 'Muhammad', 'Suliman', 'writer', 'https://www.linkedin.com/', 'muhammad.suliman.75436@gmail.com', 17933684, '1cc62fbf-d9f5-4d02-af03-6528261b080f', NULL, '$2y$10$W0TS6n16W4zyaTZIM3sZhedDdUIbD6FPyFDn9VRy0LIpOTWcxQFH.', NULL, 'contributor', NULL, 2, 'approved', '2023-09-29 23:02:40', '2023-09-29 23:47:44');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
