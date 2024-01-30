-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2024 at 05:00 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auto_social_poster`
--

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(8, '2024_01_19_183014_create_tbl_master_organization', 2),
(9, '2024_01_19_183359_create_tbl_config_configuration', 2),
(10, '2019_12_22_015115_create_short_urls_table', 3),
(11, '2019_12_22_015214_create_short_url_visits_table', 3),
(12, '2020_02_11_224848_update_short_url_table_for_version_two_zero_zero', 3),
(13, '2020_02_12_008432_update_short_url_visits_table_for_version_two_zero_zero', 3),
(14, '2020_04_10_224546_update_short_url_table_for_version_three_zero_zero', 3),
(15, '2020_04_20_009283_update_short_url_table_add_option_to_forward_query_params', 3),
(16, '2024_01_27_104402_create_tbl_post', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `short_urls`
--

CREATE TABLE `short_urls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `destination_url` text NOT NULL,
  `url_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `default_short_url` varchar(255) NOT NULL,
  `single_use` tinyint(1) NOT NULL,
  `forward_query_params` tinyint(1) NOT NULL DEFAULT 0,
  `track_visits` tinyint(1) NOT NULL,
  `redirect_status_code` int(11) NOT NULL DEFAULT 301,
  `track_ip_address` tinyint(1) NOT NULL DEFAULT 0,
  `track_operating_system` tinyint(1) NOT NULL DEFAULT 0,
  `track_operating_system_version` tinyint(1) NOT NULL DEFAULT 0,
  `track_browser` tinyint(1) NOT NULL DEFAULT 0,
  `track_browser_version` tinyint(1) NOT NULL DEFAULT 0,
  `track_referer_url` tinyint(1) NOT NULL DEFAULT 0,
  `track_device_type` tinyint(1) NOT NULL DEFAULT 0,
  `activated_at` timestamp NULL DEFAULT '2024-01-27 04:49:48',
  `deactivated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `short_urls`
--

INSERT INTO `short_urls` (`id`, `destination_url`, `url_key`, `default_short_url`, `single_use`, `forward_query_params`, `track_visits`, `redirect_status_code`, `track_ip_address`, `track_operating_system`, `track_operating_system_version`, `track_browser`, `track_browser_version`, `track_referer_url`, `track_device_type`, `activated_at`, `deactivated_at`, `created_at`, `updated_at`) VALUES
(1, 'https://www.amazon.sa/dp/B018KS6J94?tag=salemalsubhi-21&linkCode=osi&th=1&psc=1', 'k4x9e', 'http://localhost/short/k4x9e', 0, 0, 1, 301, 1, 1, 1, 1, 1, 1, 1, '2024-01-27 04:51:53', NULL, '2024-01-27 04:51:53', '2024-01-27 04:51:53'),
(2, 'https://www.amazon.sa/dp/B08D99426R?tag=salemalsubhi-21&linkCode=osi&th=1&psc=1', 'AVMle', 'http://localhost/short/AVMle', 0, 0, 1, 301, 1, 1, 1, 1, 1, 1, 1, '2024-01-27 05:01:55', NULL, '2024-01-27 05:01:55', '2024-01-27 05:01:55'),
(3, 'https://www.amazon.sa/dp/B0BL7CPWHB?tag=salemalsubhi-21&linkCode=osi&th=1&psc=1', 'BNEqN', 'http://localhost/short/BNEqN', 0, 0, 1, 301, 1, 1, 1, 1, 1, 1, 1, '2024-01-27 05:01:56', NULL, '2024-01-27 05:01:56', '2024-01-27 05:01:56'),
(4, 'https://www.amazon.sa/dp/B08D99426R?tag=salemalsubhi-21&linkCode=osi&th=1&psc=1', 'MVwne', 'http://localhost/short/MVwne', 0, 0, 1, 301, 1, 1, 1, 1, 1, 1, 1, '2024-01-27 05:04:29', NULL, '2024-01-27 05:04:29', '2024-01-27 05:04:29'),
(5, 'https://www.amazon.sa/dp/B0BL7CPWHB?tag=salemalsubhi-21&linkCode=osi&th=1&psc=1', 'YNg3N', 'http://localhost/short/YNg3N', 0, 0, 1, 301, 1, 1, 1, 1, 1, 1, 1, '2024-01-27 05:04:31', NULL, '2024-01-27 05:04:31', '2024-01-27 05:04:31'),
(6, 'https://www.amazon.sa/dp/B08D99426R?tag=salemalsubhi-21&linkCode=osi&th=1&psc=1', 'zN2g4', 'http://localhost/short/zN2g4', 0, 0, 1, 301, 1, 1, 1, 1, 1, 1, 1, '2024-01-27 05:05:03', NULL, '2024-01-27 05:05:03', '2024-01-27 05:05:03'),
(7, 'https://www.amazon.sa/dp/B0BL7CPWHB?tag=salemalsubhi-21&linkCode=osi&th=1&psc=1', 'RVdR4', 'http://localhost/short/RVdR4', 0, 0, 1, 301, 1, 1, 1, 1, 1, 1, 1, '2024-01-27 05:05:07', NULL, '2024-01-27 05:05:07', '2024-01-27 05:05:07'),
(8, 'https://www.amazon.sa/dp/B071G29Y58?tag=salemalsubhi-21&linkCode=osi&th=1&psc=1', 'R4ane', 'http://localhost/salemalsubhi-21/R4ane', 0, 0, 1, 301, 1, 1, 1, 1, 1, 1, 1, '2024-01-27 06:22:42', NULL, '2024-01-27 06:22:42', '2024-01-27 06:22:42'),
(9, 'https://www.amazon.sa/dp/B071G29Y58?tag=salemalsubhi-21&linkCode=osi&th=1&psc=1', 'pVJp4', 'http://localhost/salemalsubhi-21/pVJp4', 0, 0, 1, 301, 1, 1, 1, 1, 1, 1, 1, '2024-01-27 06:23:24', NULL, '2024-01-27 06:23:24', '2024-01-27 06:23:24'),
(10, 'https://www.amazon.sa/dp/B071G29Y58?tag=salemalsubhi-21&linkCode=osi&th=1&psc=1', '1V9O4', 'http://localhost/salemalsubhi-21/1V9O4', 0, 0, 1, 301, 1, 1, 1, 1, 1, 1, 1, '2024-01-27 06:37:03', NULL, '2024-01-27 06:37:03', '2024-01-27 06:37:03'),
(11, 'https://www.amazon.sa/dp/B071G29Y58?tag=salemalsubhi-21&linkCode=osi&th=1&psc=1', 'aVpge', 'http://localhost/salemalsubhi-21/aVpge', 0, 0, 1, 301, 1, 1, 1, 1, 1, 1, 1, '2024-01-27 06:44:29', NULL, '2024-01-27 06:44:29', '2024-01-27 06:44:29'),
(12, 'https://www.amazon.sa/dp/B08DFPV5Y2?tag=salemalsubhi-21&linkCode=osi&th=1&psc=1', 'MenKV', 'http://localhost/salemalsubhi-21/MenKV', 0, 0, 1, 301, 1, 1, 1, 1, 1, 1, 1, '2024-01-27 06:44:31', NULL, '2024-01-27 06:44:31', '2024-01-27 06:44:31'),
(13, 'https://www.amazon.sa/dp/B09MTBHT8P?tag=salemalsubhi-21&linkCode=osi&th=1&psc=1', 'x4Lqe', 'http://localhost/salemalsubhi-21/x4Lqe', 0, 0, 1, 301, 1, 1, 1, 1, 1, 1, 1, '2024-01-27 06:44:33', NULL, '2024-01-27 06:44:33', '2024-01-27 06:44:33'),
(14, 'https://www.amazon.sa/dp/B09X1MVLQH?tag=salemalsubhi-21&linkCode=osi&th=1&psc=1', 'xVmPe', 'http://localhost/salemalsubhi-21/xVmPe', 0, 0, 1, 301, 1, 1, 1, 1, 1, 1, 1, '2024-01-27 06:44:34', NULL, '2024-01-27 06:44:34', '2024-01-27 06:44:34'),
(15, 'https://www.amazon.sa/dp/B0C5JK3Y15?tag=salemalsubhi-21&linkCode=osi&th=1&psc=1', 'QV0MN', 'http://localhost/salemalsubhi-21/QV0MN', 0, 0, 1, 301, 1, 1, 1, 1, 1, 1, 1, '2024-01-27 06:44:36', NULL, '2024-01-27 06:44:36', '2024-01-27 06:44:36'),
(16, 'https://www.amazon.sa/dp/B0C52WCW6L?tag=salemalsubhi-21&linkCode=osi&th=1&psc=1', 'Y4Qre', 'http://localhost/salemalsubhi-21/Y4Qre', 0, 0, 1, 301, 1, 1, 1, 1, 1, 1, 1, '2024-01-27 06:44:38', NULL, '2024-01-27 06:44:38', '2024-01-27 06:44:38'),
(17, 'https://www.amazon.sa/dp/B0C3L93F2Q?tag=salemalsubhi-21&linkCode=osi&th=1&psc=1', 'geq1e', 'http://localhost/salemalsubhi-21/geq1e', 0, 0, 1, 301, 1, 1, 1, 1, 1, 1, 1, '2024-01-27 06:44:40', NULL, '2024-01-27 06:44:40', '2024-01-27 06:44:40'),
(18, 'https://www.amazon.sa/dp/B093JZJ9P7?tag=salemalsubhi-21&linkCode=osi&th=1&psc=1', '5V1BN', 'http://localhost/salemalsubhi-21/5V1BN', 0, 0, 1, 301, 1, 1, 1, 1, 1, 1, 1, '2024-01-27 06:44:42', NULL, '2024-01-27 06:44:42', '2024-01-27 06:44:42'),
(19, 'https://www.amazon.sa/dp/B07N3WQ6H7?tag=salemalsubhi-21&linkCode=osi&th=1&psc=1', 'wVln4', 'http://localhost/salemalsubhi-21/wVln4', 0, 0, 1, 301, 1, 1, 1, 1, 1, 1, 1, '2024-01-27 06:44:43', NULL, '2024-01-27 06:44:43', '2024-01-27 06:44:43'),
(20, 'https://www.amazon.sa/dp/B081RJ8DW1?tag=salemalsubhi-21&linkCode=osi&th=1&psc=1', 'PeRM4', 'http://localhost/salemalsubhi-21/PeRM4', 0, 0, 1, 301, 1, 1, 1, 1, 1, 1, 1, '2024-01-27 06:44:45', NULL, '2024-01-27 06:44:45', '2024-01-27 06:44:45');

-- --------------------------------------------------------

--
-- Table structure for table `short_url_visits`
--

CREATE TABLE `short_url_visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `short_url_id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `operating_system` varchar(255) DEFAULT NULL,
  `operating_system_version` varchar(255) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `browser_version` varchar(255) DEFAULT NULL,
  `referer_url` varchar(255) DEFAULT NULL,
  `device_type` varchar(255) DEFAULT NULL,
  `visited_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_config_configuration`
--

CREATE TABLE `tbl_config_configuration` (
  `id` int(11) NOT NULL,
  `configuration_id` varchar(255) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `deleted_on` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_config_configuration`
--

INSERT INTO `tbl_config_configuration` (`id`, `configuration_id`, `organization_id`, `key`, `value`, `is_active`, `created_on`, `created_by`, `modified_on`, `modified_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 'CONF_2_1705763942', 2, 'AccessKey', 'AKIAI4LTDXVC67KT35QA', 1, '2024-01-20 15:19:02', NULL, '2024-01-20 15:30:50', NULL, 0, NULL, NULL),
(2, 'CONF_2_1705764673', 2, 'SecretKey', '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', 1, '2024-01-20 15:31:13', NULL, NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_organization`
--

CREATE TABLE `tbl_master_organization` (
  `organization_id` int(11) NOT NULL,
  `organization_code` varchar(20) NOT NULL,
  `organization_name` varchar(255) NOT NULL,
  `is_social_media` tinyint(4) DEFAULT NULL,
  `is_market_place` tinyint(4) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_master_organization`
--

INSERT INTO `tbl_master_organization` (`organization_id`, `organization_code`, `organization_name`, `is_social_media`, `is_market_place`, `is_active`) VALUES
(2, 'ORGM_1705695453', 'Amazon Market Place', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post`
--

CREATE TABLE `tbl_post` (
  `id` int(11) NOT NULL,
  `post_id` varchar(255) NOT NULL,
  `short_url_id` int(11) NOT NULL,
  `social_media_id` varchar(255) NOT NULL,
  `post_content_text` varchar(255) DEFAULT NULL,
  `is_media_post` tinyint(4) DEFAULT NULL,
  `post_url` varchar(255) NOT NULL,
  `created_on` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_post`
--

INSERT INTO `tbl_post` (`id`, `post_id`, `short_url_id`, `social_media_id`, `post_content_text`, `is_media_post`, `post_url`, `created_on`, `created_by`) VALUES
(1, '1751215239000187030', 10, '1', 'Best Seller 2pcs SMA Female Jack to RP-SMA Male Socket RF Connector Adapter Straight goldplated USA Shipping', 1, 'http://localhost/salemalsubhi-21/1V9O4', '2024-01-27 17:37:05', NULL),
(2, '1751217108334322071', 11, '1', 'Best Seller 2pcs SMA Female Jack to RP-SMA Male Socket RF Connector Adapter Straight goldplated USA Shipping', 1, 'http://localhost/salemalsubhi-21/aVpge', '2024-01-27 17:44:31', NULL),
(3, '1751217115716317202', 12, '1', 'Fitbit Versa 3, Health &amp; Fitness Smartwatch with GPS, 24/7 Heart Rate, Voice Assistant &amp; up to 6+ Days Battery, Black/Black Aluminium', 1, 'http://localhost/salemalsubhi-21/MenKV', '2024-01-27 17:44:33', NULL),
(4, '1751217122842452394', 13, '1', 'KALINCO Unisex Fitness Tracker with Heart Rate Monitor, Blood Pressure Oxygen Tracking Touch Screen Smartwatch Compatible with Android iOS (Golden)', 1, 'http://localhost/salemalsubhi-21/x4Lqe', '2024-01-27 17:44:34', NULL),
(5, '1751217129888833621', 14, '1', 'Amazfit Bip 3 Smart Watch for Women, Health &amp; Fitness Tracker with 1.69\" Large Color Display,14-Day Battery Life, 60+ Sports Modes, Blood Oxygen Heart Rate Sleep Monitor, 5 ATM Water-Resistant (Blue)', 1, 'http://localhost/salemalsubhi-21/xVmPe', '2024-01-27 17:44:36', NULL),
(6, '1751217138151657552', 15, '1', '1.83\" Military Smart Watches for Men with Bluetooth Call, Activity Tracker with 123 Sports Modes, IP68 Waterproof, Men\'s Smartwatch with Heart Rate Blood Pressure AI Voice Assistant(Black)', 1, 'http://localhost/salemalsubhi-21/QV0MN', '2024-01-27 17:44:38', NULL),
(7, '1751217145680433287', 16, '1', 'JYX Karaoke Machine for Adults and Kids, Bluetooth Speaker with 2 Microphones, Portable Party Karaoke Speaker with DJ Lights Support TWS/REC, PA System Best Gift for Brithday etc…', 1, 'http://localhost/salemalsubhi-21/Y4Qre', '2024-01-27 17:44:40', NULL),
(8, '1751217152768811018', 17, '1', 'Nelko Label Printer, Bluetooth P21 Self-Adhesive Labelling Device, Portable Labelling Device, Self-Adhesive Label Printer, Wireless, Mini Label Printer with iOS Android, for Home, Office, White', 1, 'http://localhost/salemalsubhi-21/geq1e', '2024-01-27 17:44:42', NULL),
(9, '1751217160998039565', 18, '1', 'DLC Bluetooth Radio Speaker 32228B', 1, 'http://localhost/salemalsubhi-21/5V1BN', '2024-01-27 17:44:43', NULL),
(10, '1751217167604060260', 19, '1', 'MATEIN Travel Laptop Backpacks for Men and Women, Black, 17 Inch, 17 Inch Travel Laptop Backpack Black', 1, 'http://localhost/salemalsubhi-21/wVln4', '2024-01-27 17:44:45', NULL),
(11, '1751217175082463523', 20, '1', 'Gskyer Telescope, 70mm Aperture 400mm AZ Mount Astronomical Refracting Telescope for Kids Beginners - Travel Telescope with Carry Bag, Phone Adapter and Wireless Remote', 1, 'http://localhost/salemalsubhi-21/PeRM4', '2024-01-27 17:44:47', NULL);

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `short_urls`
--
ALTER TABLE `short_urls`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `short_urls_url_key_unique` (`url_key`);

--
-- Indexes for table `short_url_visits`
--
ALTER TABLE `short_url_visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `short_url_visits_short_url_id_foreign` (`short_url_id`);

--
-- Indexes for table `tbl_config_configuration`
--
ALTER TABLE `tbl_config_configuration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_config_configuration_configuration_id_unique` (`configuration_id`);

--
-- Indexes for table `tbl_master_organization`
--
ALTER TABLE `tbl_master_organization`
  ADD PRIMARY KEY (`organization_id`),
  ADD UNIQUE KEY `tbl_master_organization_organization_code_unique` (`organization_code`);

--
-- Indexes for table `tbl_post`
--
ALTER TABLE `tbl_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `short_urls`
--
ALTER TABLE `short_urls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `short_url_visits`
--
ALTER TABLE `short_url_visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_config_configuration`
--
ALTER TABLE `tbl_config_configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_master_organization`
--
ALTER TABLE `tbl_master_organization`
  MODIFY `organization_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_post`
--
ALTER TABLE `tbl_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `short_url_visits`
--
ALTER TABLE `short_url_visits`
  ADD CONSTRAINT `short_url_visits_short_url_id_foreign` FOREIGN KEY (`short_url_id`) REFERENCES `short_urls` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
