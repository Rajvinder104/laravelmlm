-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2024 at 06:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mlm_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `user_id`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'eyJpdiI6InZnNlZYaUFrOWtyWFFPd2RUekNVanc9PSIsInZhbHVlIjoiOHRJM0JjVk9Relk5YlVwUzBDdWN0QT09IiwibWFjIjoiNGM5ZmVhOWJmYmYzMDA2MzAxNGFlNDZmY2I5NDM3YjYwZWY1NGUzY2E0YTZjNTZhOTM1NTgwZTBmYzFmMDE3YiIsInRhZyI6IiJ9', 'admin', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bank_detail`
--

CREATE TABLE `bank_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `ifsc_code` varchar(255) DEFAULT NULL,
  `holder_name` varchar(255) DEFAULT NULL,
  `nominee` varchar(255) DEFAULT NULL,
  `pan` varchar(255) DEFAULT NULL,
  `aadhar` varchar(255) DEFAULT NULL,
  `kyc_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_detail`
--

INSERT INTO `bank_detail` (`id`, `user_id`, `bank_name`, `account_number`, `branch`, `ifsc_code`, `holder_name`, `nominee`, `pan`, `aadhar`, `kyc_status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Axis bank', '5656565656', 'Axis bank', '1234', 'admin', NULL, NULL, NULL, 1, '2024-10-21 09:00:18', '2024-10-28 11:16:52'),
(2, 'WG416963', 'national bank', '8978984', 'national', '12445', 'test', NULL, NULL, NULL, 2, '2024-10-21 09:03:06', '2024-10-28 08:45:41'),
(3, 'WG507647', 'ssdadsad', '6575675', 'hgfgh', '455', 'gfhfgh', NULL, NULL, NULL, 3, '2024-10-21 09:20:51', '2024-10-28 08:45:49'),
(4, 'WG178505', 'fdgsfdgsfd', '343543534', 'vbfgg', '4343', 'fgb', NULL, NULL, NULL, 1, '2024-10-23 09:45:50', '2024-10-28 08:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `binary_users`
--

CREATE TABLE `binary_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `upline_id` varchar(255) DEFAULT NULL,
  `last_left` varchar(255) DEFAULT NULL,
  `last_right` varchar(255) DEFAULT NULL,
  `left_node` varchar(255) DEFAULT NULL,
  `right_node` varchar(255) DEFAULT NULL,
  `left_count` int(11) NOT NULL DEFAULT 0,
  `right_count` int(11) NOT NULL DEFAULT 0,
  `position` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `downline_count`
--

CREATE TABLE `downline_count` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `downline` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
(1, '2024_09_24_084848_create_users_table', 1),
(2, '2024_09_24_085119_create_admin_table', 1),
(3, '2024_09_24_121609_create_sessions_table', 1),
(4, '2024_09_25_050211_create_plan_setting_table', 1),
(5, '2024_09_25_064843_create_cache_table', 1),
(6, '2024_09_28_065855_add_password_to_users_table', 1),
(7, '2024_09_28_071533_add_role_to_users_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(9, '2024_10_14_095131_create_news_table', 2),
(10, '2024_10_14_100436_create_news_table', 3),
(11, '2024_10_14_113426_create_tbl_wallet_table', 4),
(12, '2024_10_15_072321_create_bank_detail_table', 5),
(13, '2024_10_15_091014_create_sponsor_count_table', 6),
(14, '2024_10_16_055012_create_binary_users_table', 7),
(15, '2024_10_16_060610_create_binary_users_table', 8),
(16, '2024_10_16_060826_create_binary_users_table', 9),
(17, '2024_10_16_101327_create_binary_users_table', 10),
(18, '2024_10_16_101509_create_binary_users_table', 11),
(19, '2024_10_16_102506_create_downline_count_table', 12),
(20, '2024_10_17_072516_create_support_message_table', 13),
(21, '2024_10_17_092515_create_tbl_package_table', 14),
(22, '2024_10_17_110105_create_tbl_activation_details_table', 15),
(23, '2024_10_17_110424_create_tbl_activation_details_table', 16),
(24, '2024_10_17_110639_create_tbl_income_wallet_table', 17),
(25, '2024_10_17_113138_create_tbl_roi_table', 18),
(26, '2024_10_29_045810_create_tbl_payment_request_table', 19),
(27, '2024_10_29_065716_create_tbl_qrcode_table', 20),
(28, '2024_10_29_065957_create_tbl_qrcode_table', 21),
(29, '2024_10_29_070036_create_tbl_qrcode_table', 22),
(30, '2024_10_30_061458_create_tbl_withdraw_table', 23),
(31, '2024_10_30_071930_create_tbl_token_value_table', 24),
(32, '2024_11_05_084402_create_tbl_popup_table', 25),
(33, '2024_11_07_083940_create_tbl_rewards_table', 26),
(34, '2024_11_07_085118_create_tbl_reward_wallet_table', 27),
(35, '2024_11_07_090635_create_tbl_reward_wallet_table', 28),
(36, '2024_11_07_103547_create_tbl_cron_table', 29);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `news` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `news`, `created_at`, `updated_at`) VALUES
(1, 'News', 'Laravel Project', '2024-10-23 11:04:43', '2024-10-23 11:04:43');

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
-- Table structure for table `plan_setting`
--

CREATE TABLE `plan_setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `base_url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `favicon` varchar(500) NOT NULL,
  `prefix` varchar(50) NOT NULL,
  `registration` varchar(50) NOT NULL DEFAULT '0',
  `currency` varchar(50) NOT NULL,
  `activation` int(11) NOT NULL DEFAULT 0,
  `withdraw` int(11) NOT NULL COMMENT '0=>bank , 1=>wallet ',
  `withdraw_status` int(11) NOT NULL DEFAULT 0,
  `min_withdraw` varchar(500) NOT NULL,
  `max_withdraw` varchar(500) NOT NULL,
  `multiple_withdraw` varchar(500) NOT NULL,
  `withdraw_charges` varchar(500) NOT NULL,
  `incomeLimit` int(11) NOT NULL DEFAULT 0,
  `roi_access` int(11) NOT NULL DEFAULT 0,
  `level_access` int(11) NOT NULL DEFAULT 0,
  `direct_access` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plan_setting`
--

INSERT INTO `plan_setting` (`id`, `base_url`, `title`, `logo`, `favicon`, `prefix`, `registration`, `currency`, `activation`, `withdraw`, `withdraw_status`, `min_withdraw`, `max_withdraw`, `multiple_withdraw`, `withdraw_charges`, `incomeLimit`, `roi_access`, `level_access`, `direct_access`, `created_at`, `updated_at`) VALUES
(1, 'http://127.0.0.1:8000/', 'laravel', 'logo.png', 'favicon.png', 'WG', '0', '$', 1, 1, 0, '1', '10', '1', '5', 0, 0, 0, 0, NULL, NULL);

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
('Ap3SR2vziFfKjabHcxzpgkXiEjlyVRZdp1QPUQ2D', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:131.0) Gecko/20100101 Firefox/131.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWjJ4UnV4empjd2llUnF1c2FySmhtVnJQSXNSOTV2VERMMDlFd2xzYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi1sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1728016974),
('TrHVY54Zd6JoXzkviMDoAc4ZYqrw7nQraawHsCJ4', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:130.0) Gecko/20100101 Firefox/130.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMWhRbXpTUlVPVGNVQ2lTbjBNUlZOajM3UHJ3cVNBb21mb3hjZHBubyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi1sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1727936219),
('Ur4KHrlNkNBy6InAZCCBBrYmzuybL5esNBolvayF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:130.0) Gecko/20100101 Firefox/130.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU3c5U0FaNnRwaG1pQ0RiSHgzQ0hZdkFYSE5yM3VJMHJSVVdDQUo1NiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1727946953);

-- --------------------------------------------------------

--
-- Table structure for table `sponsor_count`
--

CREATE TABLE `sponsor_count` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `downline` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sponsor_count`
--

INSERT INTO `sponsor_count` (`id`, `user_id`, `downline`, `position`, `level`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'WG416963', '', 1, '2024-10-21 09:03:06', '2024-10-21 09:03:06'),
(2, 'WG416963', 'WG507647', '', 1, '2024-10-21 09:20:51', '2024-10-21 09:20:51'),
(3, 'admin', 'WG507647', '', 2, '2024-10-21 09:20:51', '2024-10-21 09:20:51'),
(4, 'admin', 'WG178505', '', 1, '2024-10-23 09:45:51', '2024-10-23 09:45:51');

-- --------------------------------------------------------

--
-- Table structure for table `support_message`
--

CREATE TABLE `support_message` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `reciever_id` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `remark` varchar(500) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_message`
--

INSERT INTO `support_message` (`id`, `user_id`, `reciever_id`, `title`, `message`, `remark`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'WG367231', 'support message', 'email', NULL, 'uploads/4CqhXS63hFoVDszuMQJH5gulEx36VP7g8yxrIl2d.png', 0, '2024-10-17 07:28:52', '2024-10-17 07:28:52'),
(2, 'Admin', 'WG416963', 'first mail', 'good to meet you...!', NULL, 'uploads/csTrUkeE7r5kLwmlEs5bf0EmwFwekkE315TfBBG7.png', 0, '2024-10-23 05:12:06', '2024-10-23 05:12:06'),
(3, 'WG416963', NULL, 'admin mail', 'hello admin', NULL, 'uploads/FIDaC9lOthGAex5lZ6HVoiM3bFk0dY9oCmBScK1V.jpg', 0, '2024-10-23 06:10:13', '2024-10-23 06:10:13'),
(4, 'WG416963', NULL, 'second mail', 'hi...!  admin', 'good', 'uploads/BQ3APZzQma0uee9nvLIyrxsrLHPyP9NNNiqbLwwS.webp', 1, '2024-10-23 06:39:28', '2024-10-23 09:31:53'),
(5, 'Admin', 'WG416963', 'good title', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.', NULL, 'uploads/bUJYw7S4q85t33JSthkq4k8uJJyax129NXzk5kEC.png', 0, '2024-10-23 09:26:27', '2024-10-23 09:26:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activation_details`
--

CREATE TABLE `tbl_activation_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `package` varchar(255) NOT NULL,
  `activater` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_activation_details`
--

INSERT INTO `tbl_activation_details` (`id`, `user_id`, `package`, `activater`, `type`, `created_at`, `updated_at`) VALUES
(1, 'WG416963', '200', 'WG416963', 'upgradation', '2024-10-21 09:04:53', '2024-10-21 09:04:53'),
(2, 'WG507647', '100', 'WG416963', 'activation', '2024-10-21 09:21:06', '2024-10-21 09:21:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cron`
--

CREATE TABLE `tbl_cron` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cron_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_income_wallet`
--

CREATE TABLE `tbl_income_wallet` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `dollar` int(11) DEFAULT NULL,
  `admin_status` int(11) NOT NULL DEFAULT 0,
  `token_price` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_income_wallet`
--

INSERT INTO `tbl_income_wallet` (`id`, `user_id`, `amount`, `type`, `remark`, `dollar`, `admin_status`, `token_price`, `created_at`, `updated_at`) VALUES
(1, 'admin', '10', 'direct_income', 'Direct Income for WG416963 Activation Amount 200', NULL, 0, '', '2024-10-21 09:04:53', '2024-10-21 09:04:53'),
(2, 'WG416963', '5', 'direct_income', 'Direct Income for WG507647 Activation Amount 100', NULL, 0, '', '2024-10-21 09:21:06', '2024-10-21 09:21:06'),
(3, 'admin', '4', 'level_income', 'Level Income from Activation of Member ($100) WG507647 At level 2', NULL, 0, '', '2024-10-21 09:21:06', '2024-10-21 09:21:06'),
(4, 'WG416963', '-1', 'withdraw_request', 'Withdrawal Amount ', 1, 0, '0', '2024-10-30 08:59:26', '2024-10-30 08:59:26'),
(5, 'WG416963', '-1', 'withdraw_request', 'Withdrawal Amount ', 1, 0, '0', '2024-10-30 10:11:45', '2024-10-30 10:11:45'),
(6, 'WG416963', '-1', 'withdraw_request', 'Withdrawal Amount ', NULL, 0, NULL, '2024-10-30 10:12:54', '2024-10-30 10:12:54'),
(7, 'WG416963', '1', 'withdraw_request', 'rejected request', NULL, 0, NULL, '2024-11-04 05:25:44', '2024-11-04 05:25:44'),
(8, 'WG416963', '100', 'roi_income', 'Income CREDIT by Admin ', NULL, 1, NULL, '2024-11-04 06:45:57', '2024-11-04 11:43:36'),
(9, 'WG416963', '-5', 'roi_income', 'Income DEBIT by Admin ', NULL, 1, NULL, '2024-11-04 06:46:42', '2024-11-04 06:47:02'),
(10, 'WG416963', '-1', 'income_wallet_transfer', 'Sent 1 to 56756756', NULL, 0, NULL, '2024-11-04 09:51:37', '2024-11-04 09:51:37'),
(11, 'WG416963', '-1', 'income_wallet_transfer', 'Sent 1 to WG416963', NULL, 0, NULL, '2024-11-04 10:00:27', '2024-11-04 10:00:27'),
(12, 'WG416963', '-1', 'income_wallet_transfer', 'Sent 1 to 545454', NULL, 0, NULL, '2024-11-04 10:06:55', '2024-11-04 10:06:55'),
(13, 'WG416963', '-1', 'income_wallet_transfer', 'Sent 1 to WG416963', NULL, 0, NULL, '2024-11-04 10:22:15', '2024-11-04 10:22:15'),
(14, 'WG416963', '-50', 'income_transfer', 'Sent 50 to admin', NULL, 0, NULL, '2024-11-04 11:39:48', '2024-11-04 11:39:48'),
(15, 'admin', '47.5', 'income_transfer', 'Got 2375 from WG416963', NULL, 0, NULL, '2024-11-04 11:39:48', '2024-11-04 11:39:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_package`
--

CREATE TABLE `tbl_package` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `commision` bigint(20) UNSIGNED NOT NULL,
  `days` varchar(255) NOT NULL,
  `direct_income` varchar(255) NOT NULL,
  `level_income` varchar(255) NOT NULL,
  `roi_income` varchar(255) NOT NULL,
  `capping` bigint(20) UNSIGNED NOT NULL,
  `direct_percent` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_package`
--

INSERT INTO `tbl_package` (`id`, `title`, `description`, `price`, `commision`, `days`, `direct_income`, `level_income`, `roi_income`, `capping`, `direct_percent`, `created_at`, `updated_at`) VALUES
(1, 'Basic Package', 'silver', '100', 0, '365', '0.05', '1,1,1,1,1', '0.02', 1000, '5', '2024-10-17 09:50:14', '2024-10-17 09:50:14'),
(2, 'premium Package', 'Gold', '200', 1, '365', '0.05', '1,1,1,1,1', '0.02', 2000, '5', '2024-10-17 09:50:14', '2024-10-17 09:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_request`
--

CREATE TABLE `tbl_payment_request` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `remarks` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_payment_request`
--

INSERT INTO `tbl_payment_request` (`id`, `user_id`, `payment_method`, `amount`, `image`, `status`, `remarks`, `type`, `transaction_id`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'bank', '100', 'uploads/o4mouBCAhACvBc7fNoZw7arWhnYLq5ANLR9UZSQq.jpg', '1', 'payment way', 'fund_request', '846289', '2024-10-29 06:10:07', '2024-10-30 04:18:10'),
(2, 'admin', 'bank', '10', 'uploads/9Mq3uSCrKhVDkEJHjCb9i4kHbFlMdhaFs7ixTih4.jpg', '0', NULL, 'fund_request', '846289', '2024-10-30 04:23:48', '2024-10-30 04:23:48'),
(4, 'admin', 'bank', '10', 'uploads/ds8vemWqJvpwnRspIGVAUTcGnTSNCNkTszOTzQUL.jpg', '2', 'rejected request', 'fund_request', '846289', '2024-10-30 04:54:55', '2024-10-30 04:55:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_popup`
--

CREATE TABLE `tbl_popup` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `media` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_popup`
--

INSERT INTO `tbl_popup` (`id`, `media`, `type`, `caption`, `status`, `created_at`, `updated_at`) VALUES
(1, 'uploads/popup.png', NULL, 'popup image', '1', '2024-11-05 09:03:33', '2024-11-05 10:39:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_qrcode`
--

CREATE TABLE `tbl_qrcode` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `status` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_qrcode`
--

INSERT INTO `tbl_qrcode` (`id`, `image`, `type`, `caption`, `status`, `created_at`, `updated_at`) VALUES
(1, 'uploads/OrF2krxw6n5x0QjUDBWXWn06hcUU2Lm0ZyDFrSfy.png', NULL, NULL, 0, '2024-10-29 07:21:08', '2024-10-29 07:29:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rewards`
--

CREATE TABLE `tbl_rewards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `status` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `award_id` varchar(255) DEFAULT NULL,
  `rank` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_rewards`
--

INSERT INTO `tbl_rewards` (`id`, `user_id`, `amount`, `status`, `award_id`, `rank`, `created_at`, `updated_at`) VALUES
(3, 'admin', '10', 0, '1', 'T1', '2024-11-07 09:08:52', '2024-11-07 09:08:52'),
(4, 'WG416963', '10', 0, '1', 'T1', '2024-11-07 09:08:52', '2024-11-07 09:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reward_wallet`
--

CREATE TABLE `tbl_reward_wallet` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `amount` varchar(255) NOT NULL DEFAULT '0',
  `type` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_reward_wallet`
--

INSERT INTO `tbl_reward_wallet` (`id`, `user_id`, `amount`, `type`, `description`, `created_at`, `updated_at`) VALUES
(3, 'admin', '10', 'reward_income', 'You have Achieved your 1 Reward Income ', '2024-11-07 09:08:52', '2024-11-07 09:08:52'),
(4, 'WG416963', '10', 'reward_income', 'You have Achieved your 1 Reward Income ', '2024-11-07 09:08:52', '2024-11-07 09:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roi`
--

CREATE TABLE `tbl_roi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `package` varchar(255) NOT NULL,
  `roi_amount` varchar(255) NOT NULL,
  `days` varchar(255) NOT NULL,
  `total_days` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `creditDate` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_roi`
--

INSERT INTO `tbl_roi` (`id`, `user_id`, `amount`, `package`, `roi_amount`, `days`, `total_days`, `type`, `status`, `creditDate`, `created_at`, `updated_at`) VALUES
(1, 'WG416963', '1460', '200', '4', '200', '200', 'roi_income', 0, '2024-10-21 09:04:53', '2024-10-21 09:04:53', '2024-10-21 09:04:53'),
(2, 'WG507647', '730', '100', '2', '200', '200', 'roi_income', 0, '2024-10-21 09:21:06', '2024-10-21 09:21:06', '2024-10-21 09:21:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_token_value`
--

CREATE TABLE `tbl_token_value` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` varchar(255) NOT NULL DEFAULT '0',
  `sellvalue` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_token_value`
--

INSERT INTO `tbl_token_value` (`id`, `amount`, `sellvalue`, `created_at`, `updated_at`) VALUES
(1, '0', '0', '2024-10-30 07:21:17', '2024-10-30 07:21:17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wallet`
--

CREATE TABLE `tbl_wallet` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `sender_id` varchar(255) DEFAULT NULL,
  `receiver_id` mediumtext DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_wallet`
--

INSERT INTO `tbl_wallet` (`id`, `user_id`, `amount`, `sender_id`, `receiver_id`, `type`, `remark`, `created_at`, `updated_at`) VALUES
(1, 'WG416963', '1000', 'admin', NULL, 'admin_amount', 'Fundcredit by admin', '2024-10-21 09:03:20', '2024-10-21 09:03:20'),
(2, 'WG416963', '-200', NULL, NULL, 'account_activation', 'Account Activation Deduction for WG416963', '2024-10-21 09:04:53', '2024-10-21 09:04:53'),
(3, 'WG416963', '-100', NULL, NULL, 'account_activation', 'Account Activation Deduction for WG507647', '2024-10-21 09:21:06', '2024-10-21 09:21:06'),
(4, 'admin', '100', 'admin', NULL, 'admin_fund', 'Fundcredit by admin', '2024-10-30 04:18:10', '2024-10-30 04:31:11'),
(6, '56756756', '0.1', NULL, NULL, 'income_wallet_transfer', 'Got 0.1 from WG416963', '2024-11-04 09:51:37', '2024-11-04 09:51:37'),
(7, 'WG416963', '0.1', NULL, NULL, 'income_wallet_transfer', 'Got 0.1 from WG416963', '2024-11-04 10:00:27', '2024-11-04 10:00:27'),
(8, '545454', '0.1', NULL, NULL, 'income_wallet_transfer', 'Got 0.1 from WG416963', '2024-11-04 10:06:55', '2024-11-04 10:06:55'),
(10, 'WG416963', '-1', 'admin', NULL, 'fund_transfer', 'Fund Transfer To admin', '2024-11-05 04:41:12', '2024-11-05 04:41:12'),
(11, 'admin', '1', 'WG416963', NULL, 'fund_transfer', 'Fund Transfer From WG416963', '2024-11-05 04:41:12', '2024-11-05 04:41:12'),
(12, 'WG416963', '-1', 'WG416963', 'admin', 'fund_transfer', 'Fund Transfer To admin', '2024-11-05 04:47:21', '2024-11-05 04:47:21'),
(13, 'admin', '1', 'WG416963', NULL, 'fund_transfer', 'Fund Transfer From WG416963', '2024-11-05 04:47:21', '2024-11-05 04:47:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_withdraw`
--

CREATE TABLE `tbl_withdraw` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `amount` bigint(20) UNSIGNED NOT NULL,
  `admin_charges` bigint(20) UNSIGNED NOT NULL,
  `tds` bigint(20) UNSIGNED DEFAULT NULL,
  `fund_conversion` varchar(255) DEFAULT NULL,
  `payable_amount` varchar(255) NOT NULL,
  `coin` varchar(255) NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `remark` varchar(500) DEFAULT NULL,
  `zil_address` varchar(255) DEFAULT NULL,
  `credit_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_withdraw`
--

INSERT INTO `tbl_withdraw` (`id`, `user_id`, `amount`, `admin_charges`, `tds`, `fund_conversion`, `payable_amount`, `coin`, `type`, `status`, `remark`, `zil_address`, `credit_type`, `created_at`, `updated_at`) VALUES
(1, 'WG416963', 1, 0, 0, NULL, '0.95', '0', 'withdraw_request', '1', 'approved request', 'abc', 'Wallet', '2024-10-30 08:59:26', '2024-11-04 05:24:19'),
(2, 'WG416963', 1, 0, NULL, NULL, '0.95', '0', 'withdraw_request', '2', 'rejected request', NULL, 'Wallet', '2024-10-30 10:11:45', '2024-11-04 05:25:44'),
(3, 'WG416963', 1, 0, NULL, NULL, '0.95', '0', 'withdraw_request', '0', '', NULL, 'Bank', '2024-10-30 10:12:54', '2024-11-04 05:22:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `sponsor` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` int(50) NOT NULL,
  `master_key` int(15) NOT NULL,
  `incomes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`incomes`)),
  `package_id` int(11) NOT NULL DEFAULT 0,
  `package_amount` varchar(100) NOT NULL DEFAULT '0',
  `total_package` varchar(100) NOT NULL DEFAULT '0',
  `paid_status` int(11) NOT NULL DEFAULT 0,
  `directs` int(11) NOT NULL DEFAULT 0,
  `eth_address` varchar(5000) NOT NULL,
  `disabled` varchar(50) NOT NULL DEFAULT '0',
  `rewardLevel` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `topup_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT 'reader'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `sponsor`, `name`, `email`, `phone`, `master_key`, `incomes`, `package_id`, `package_amount`, `total_package`, `paid_status`, `directs`, `eth_address`, `disabled`, `rewardLevel`, `created_at`, `updated_at`, `topup_date`, `password`, `role`) VALUES
(1, 'admin', 'none', 'Admin', 'admin@gmail.com', 8489498, 846289, '{\"direct_income\":10,\"roi_income\":0,\"level_income\":4}', 0, '0', '0', 1, 1, '', '0', 1, '2024-10-21 09:00:18', '2024-10-21 09:00:18', '2024-10-21 09:00:18', 'eyJpdiI6InZCS1Z3eHc5VFowTjNWSWExcE81REE9PSIsInZhbHVlIjoiOG5uMmpYWmhTcExmRy81a3hHYkQ1dz09IiwibWFjIjoiOGJiMDQ4Yjk4YmExZTczNTNjOGRjYmUyYjhhMjc3ZjI0ODc2NTFhZTNhYjU4MmI3Yzc4ZGIyNDQ4NjkyOGQxZiIsInRhZyI6IiJ9', 'reader'),
(2, 'WG416963', 'admin', 'test', 'manish@gmail.com', 98798745, 758240, '{\"direct_income\":5,\"roi_income\":0,\"level_income\":0}', 1, '200', '200', 1, 1, '', '0', 1, '2024-10-21 09:03:06', '2024-10-21 09:03:06', '2024-10-21 03:34:53', 'eyJpdiI6IlMxOWF0OVpsVHdvR2RmS055L0YvMGc9PSIsInZhbHVlIjoicVZMcjczVHpQZ0FpbDViUjJ3OVFDdz09IiwibWFjIjoiOWVjNzA3MGNjZjVjOWJhOWQxOTQyMTAzNzAxNTUyYmU1YzQ2MmE2ZWM3NGFkZTNhYjY4NTc2ZDcxYzY2MjQxNyIsInRhZyI6IiJ9', 'reader'),
(3, 'WG507647', 'WG416963', 'test1', 'ravi@gmail.com', 46598489, 405350, '{\"direct_income\":0,\"roi_income\":0,\"level_income\":0}', 1, '100', '100', 1, 0, '', '0', 0, '2024-10-21 09:20:51', '2024-10-21 09:20:51', '2024-10-21 03:51:06', 'eyJpdiI6InFJdVNGTndESmh1bnBEamloUkJCcWc9PSIsInZhbHVlIjoiL25Fb2NFSHpRb0RVaVlxVkVhS0pMQT09IiwibWFjIjoiN2UzM2RkNTgzNjM5ZTJhMDA5N2Y0MjA0MzUyYmZhNTA2OTdhOWVhZmY0YzcyMDc2ZjJmMTdmYzU0MmI0NjRkYiIsInRhZyI6IiJ9', 'reader'),
(4, 'WG178505', 'admin', 'guru', 'guru@gmail.com', 984984, 344455, '{\"direct_income\":0,\"roi_income\":0,\"level_income\":0}', 0, '0', '0', 0, 0, '', '0', 0, '2024-10-23 09:45:50', '2024-10-23 09:45:50', '2024-10-23 09:45:50', 'eyJpdiI6IkNZZ255cWErTzJtS0RpelBFdnBFVGc9PSIsInZhbHVlIjoiTjB1TzFSU1V3cjF1TXQ0U0xtZVMyZz09IiwibWFjIjoiMzE0ZTFjNzhlNjVmOWQ2MDFlODFhNmEzNTlkNTFlOWZkZTVlZGQzMTJhZDRiMWMyZmZhZGI0NTFiNDc2NjI5NiIsInRhZyI6IiJ9', 'reader');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_detail`
--
ALTER TABLE `bank_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `binary_users`
--
ALTER TABLE `binary_users`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `downline_count`
--
ALTER TABLE `downline_count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plan_setting`
--
ALTER TABLE `plan_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sponsor_count`
--
ALTER TABLE `sponsor_count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_message`
--
ALTER TABLE `support_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_activation_details`
--
ALTER TABLE `tbl_activation_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cron`
--
ALTER TABLE `tbl_cron`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_income_wallet`
--
ALTER TABLE `tbl_income_wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_package`
--
ALTER TABLE `tbl_package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payment_request`
--
ALTER TABLE `tbl_payment_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_popup`
--
ALTER TABLE `tbl_popup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_qrcode`
--
ALTER TABLE `tbl_qrcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rewards`
--
ALTER TABLE `tbl_rewards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reward_wallet`
--
ALTER TABLE `tbl_reward_wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roi`
--
ALTER TABLE `tbl_roi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_token_value`
--
ALTER TABLE `tbl_token_value`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_wallet`
--
ALTER TABLE `tbl_wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_withdraw`
--
ALTER TABLE `tbl_withdraw`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bank_detail`
--
ALTER TABLE `bank_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `binary_users`
--
ALTER TABLE `binary_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `downline_count`
--
ALTER TABLE `downline_count`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plan_setting`
--
ALTER TABLE `plan_setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sponsor_count`
--
ALTER TABLE `sponsor_count`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `support_message`
--
ALTER TABLE `support_message`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_activation_details`
--
ALTER TABLE `tbl_activation_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_cron`
--
ALTER TABLE `tbl_cron`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_income_wallet`
--
ALTER TABLE `tbl_income_wallet`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_package`
--
ALTER TABLE `tbl_package`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_payment_request`
--
ALTER TABLE `tbl_payment_request`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_popup`
--
ALTER TABLE `tbl_popup`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_qrcode`
--
ALTER TABLE `tbl_qrcode`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_rewards`
--
ALTER TABLE `tbl_rewards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_reward_wallet`
--
ALTER TABLE `tbl_reward_wallet`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_roi`
--
ALTER TABLE `tbl_roi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_token_value`
--
ALTER TABLE `tbl_token_value`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_wallet`
--
ALTER TABLE `tbl_wallet`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_withdraw`
--
ALTER TABLE `tbl_withdraw`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
