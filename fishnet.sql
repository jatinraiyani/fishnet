-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2021 at 08:59 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fishnet`
--

-- --------------------------------------------------------

--
-- Table structure for table `adbanner`
--

CREATE TABLE `adbanner` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','deactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adbanner`
--

INSERT INTO `adbanner` (`id`, `title`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bahubali Net', 'promobanner-604c5333b030d.png', 'active', '2021-03-13 12:52:51', '2021-03-13 12:52:51'),
(2, 'HDPE Net', 'promobanner-604c534cb5fe0.png', 'active', '2021-03-13 12:53:16', '2021-03-13 12:53:16');

-- --------------------------------------------------------

--
-- Table structure for table `api_sessions`
--

CREATE TABLE `api_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `api_sessions`
--

INSERT INTO `api_sessions` (`id`, `session_id`, `user_id`, `created_at`, `updated_at`) VALUES
(41, '0a8d1c962f5775f750a1f7eb7cb3509d', 45, '2021-04-11 07:01:28', '2021-04-11 07:01:28'),
(42, '5aee3f4324eda4bcedf693e7a9f63b23', 46, '2021-04-11 07:27:05', '2021-04-11 07:27:05'),
(48, '8f384f688c4046e8c61dd19a74b749ec', 47, '2021-04-11 12:11:52', '2021-04-11 12:11:52'),
(49, '4e54a0b7510a4ee5a03011a1606e2d5e', 48, '2021-04-11 12:18:41', '2021-04-11 12:18:41'),
(73, '604f3c3f4a472336c46b284bbba6e63b', 49, '2021-04-15 15:20:00', '2021-04-15 15:20:00'),
(142, 'dfc58dffcdef5a599e11bd0f42faf5dc', 50, '2021-05-02 13:09:57', '2021-05-02 13:09:57'),
(231, '82f0a5c034297bd7e6269ee1d5f249fd', 22, '2021-05-15 13:06:21', '2021-05-15 13:06:21'),
(246, 'baa814bfe1be1a790e38a50e4dec5dcb', 44, '2021-05-16 10:56:58', '2021-05-16 10:56:58'),
(256, '9135bf8a90835b87328a869073d55595', 30, '2021-05-18 18:47:45', '2021-05-18 18:47:45');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(3, 'OCEAN', 'brand-603246cb0ccff.png', '2020-12-30 05:46:54', '2021-02-21 18:40:59'),
(4, 'FISHERMAN NET', 'brand-6032463377d35.png', '2021-02-21 18:38:27', '2021-02-21 18:38:27'),
(5, 'MARSHAL ROPES', 'brand-605b3db15a35e.png', '2021-03-24 20:25:05', '2021-03-24 20:25:05');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `uniqueId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product` bigint(20) NOT NULL,
  `type` bigint(20) NOT NULL,
  `product_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` bigint(20) NOT NULL,
  `subcategory` bigint(20) DEFAULT NULL,
  `price` double NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `uniqueId`, `product`, `type`, `product_unit`, `category`, `subcategory`, `price`, `size`, `qty`, `created_at`, `updated_at`) VALUES
(5, 1, '1613984728837', 73, 7, NULL, 1, 22, 9500, '900-cm', '2', '2021-02-22 16:05:29', '2021-03-22 20:01:43'),
(10, 1, '1616418100905', 63, 1, 'weight', 9, 9, 325, '2-cm', '3.5', '2021-03-22 20:01:43', '2021-03-22 20:01:43'),
(38, 48, '1618143913082', 63, 1, 'weight', 9, 9, 325, '3-cm', '8', '2021-04-11 12:25:14', '2021-04-11 12:29:53'),
(39, 48, '1618143921673', 66, 1, 'weight', 22, 15, 325, '50-cm', '1', '2021-04-11 12:25:22', '2021-04-11 12:25:22'),
(157, 44, '1621083182706', 64, 1, 'weight', 20, 10, 345, '4-cm', '1', '2021-05-15 12:53:04', '2021-05-15 12:53:04'),
(181, 30, '1621190575003', 76, 1, 'qty', 13, 12, 310, '2-cm', '3', '2021-05-16 18:42:56', '2021-05-18 16:39:57'),
(185, 30, '1621355063930', 63, 1, 'weight', 9, 9, 325, '6-cm', '3', '2021-05-18 16:24:25', '2021-05-18 16:43:22'),
(186, 30, '1621360493534', 64, 1, 'weight', 20, 10, 345, '5-cm', '9', '2021-05-18 17:54:54', '2021-05-18 18:47:45'),
(187, 30, '1621360493539', 66, 1, 'weight', 22, 15, 325, '40-cm', '3', '2021-05-18 17:54:54', '2021-05-18 17:55:04'),
(188, 30, '1621363664382', 63, 1, 'weight', 9, 9, 325, '4-cm', '1', '2021-05-18 18:47:45', '2021-05-18 18:47:45');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','deactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `type_id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 'SAFAYER', 'category-60322206970c5.png', 'active', '2020-12-10 01:37:53', '2021-02-21 16:04:06'),
(2, 7, 'RUNNER', 'category-60322344750d2.png', 'active', '2020-12-10 22:59:19', '2021-02-21 16:09:24'),
(3, 7, 'STAR', 'category-60322394e13e5.png', 'active', '2020-12-10 23:00:08', '2021-02-21 16:10:44'),
(4, 7, 'HDPE', 'category-603223f901838.png', 'active', '2020-12-10 23:01:18', '2021-02-21 16:12:25'),
(5, 2, 'DENIRE', 'category-604d0d78bf8c2.png', 'active', '2020-12-10 23:03:22', '2021-03-14 02:07:36'),
(6, 2, 'ROCKY', 'category-605b3e49088e1.png', 'active', '2020-12-10 23:04:24', '2021-03-24 20:27:37'),
(7, 3, 'CHAIN ROPE', 'category-603225ef15057.png', 'active', '2020-12-10 23:06:09', '2021-02-21 16:20:47'),
(8, 2, 'STAR', 'category-603225737793b.png', 'active', '2020-12-10 23:06:46', '2021-02-21 16:18:43'),
(9, 1, 'SAFAYER', 'category-6031ccba9e31b.png', 'active', '2020-12-10 23:07:46', '2021-02-21 16:13:20'),
(10, 1, 'DENIRE', 'category-604db3a048bcd.png', 'active', '2020-12-10 23:08:03', '2021-03-14 13:56:32'),
(11, 1, 'BLACK MARINE', 'category-604dab55a750e.png', 'active', '2020-12-10 23:08:31', '2021-03-14 13:21:09'),
(13, 1, 'HDPE', 'category-604d1fe5e9a37.png', 'active', '2020-12-10 23:13:28', '2021-03-14 03:26:13'),
(14, 2, 'RUNNER', 'category-6032185279dbd.png', 'active', '2020-12-10 23:14:08', '2021-02-21 15:22:42'),
(15, 3, 'GREY', 'category-6031e7df52d1a.png', 'active', '2020-12-10 23:14:25', '2021-02-21 11:55:59'),
(16, 2, 'SNG', 'category-6032211e3d66b.png', 'active', '2020-12-10 23:14:46', '2021-02-21 16:00:14'),
(17, 2, 'HDPE', 'category-60321675b4005.png', 'active', '2020-12-10 23:17:39', '2021-02-21 16:13:02'),
(18, 2, 'SAFAYER', 'category-60321711df540.png', 'active', '2020-12-10 23:18:01', '2021-02-21 15:17:21'),
(19, 2, 'MARINE BLACK', 'category-60321fb85164b.png', 'active', '2020-12-10 23:18:22', '2021-02-21 15:54:16'),
(20, 1, 'RUNNER', 'category-6031cd6b07d02.png', 'active', '2020-12-10 23:19:16', '2021-02-21 10:03:07'),
(21, 1, 'STAR', 'category-6031e09226535.png', 'active', '2020-12-10 23:19:40', '2021-02-21 11:24:50'),
(22, 1, 'SNG', 'category-6031e85dd721f.png', 'active', '2020-12-10 23:20:15', '2021-02-21 11:58:05'),
(23, 2, 'YELLOW HDPE', 'category-603224ac65829.png', 'active', '2021-02-20 13:36:05', '2021-02-21 16:15:24');

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `slug`, `value`, `created_at`, `updated_at`) VALUES
(1, 'privacy', '<h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-weight: 400; font-family: DauphinPlain; font-size: 24px; line-height: 24px;\">What is Lorem Ipsum?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify;\" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;\"=\"\"><span style=\"color: rgb(0, 0, 0);\"><strong style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with </span><font color=\"#000000\"><span style=\"background-color: rgb(181, 99, 8);\">desktop publishing</span> software like Aldus PageMaker including versions of Lorem Ipsum.</font></p>', '2020-12-16 00:30:26', '2021-01-22 04:55:10'),
(2, 'terms', '<h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-weight: 400; font-family: DauphinPlain; font-size: 24px; line-height: 24px;\">What is Lorem Ipsum?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;\"=\"\"><strong style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to <span style=\"background-color: rgb(0, 255, 0);\">make a type specimen book</span>. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2020-12-16 00:30:26', '2021-01-22 04:55:10'),
(3, 'address', '201,nilkanth plaza\r\nkiran chowk , varachha', '2020-12-16 00:30:26', '2021-01-22 04:55:10'),
(4, 'email', 'agastyamarine45@gmail.com', '2020-12-16 00:30:26', '2021-01-22 04:55:10'),
(5, 'contact', '8789797978', '2020-12-16 00:30:26', '2021-01-22 04:55:10'),
(6, 'logo', 'logo-5fd9eaeb4ca55.png', '2020-12-16 00:30:26', '2020-12-16 05:39:31');

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','done') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forgot_link`
--

CREATE TABLE `forgot_link` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forgot_link`
--

INSERT INTO `forgot_link` (`id`, `user_id`, `email`, `contact`, `link`, `created_at`, `updated_at`) VALUES
(8, 22, NULL, '8469536345', '7ab3e96f99460603a8b788f7d0e24fee', '2021-02-20 12:05:36', '2021-02-20 12:05:36'),
(10, 32, 'skach22@gmail.com', NULL, '264eb2b3c9fbb843b51f16cbda539883', '2021-03-22 20:03:21', '2021-03-22 20:03:21');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_11_28_112316_add_api_fields_into_users', 2),
(5, '2020_11_28_132034_add_api_session', 3),
(6, '2020_12_07_091846_type', 4),
(8, '2020_12_09_055755_category', 5),
(13, '2020_12_11_051832_product', 6),
(14, '2020_12_11_054127_product_size', 6),
(15, '2020_12_11_061051_product_image', 6),
(16, '2020_12_11_061418_product_color', 6),
(18, '2020_12_16_053822_cms', 7),
(19, '2020_12_30_043550_add_stock_status_into_product', 8),
(20, '2020_12_30_053202_slider', 9),
(21, '2020_12_30_101314_brand', 10),
(22, '2020_12_30_121646_product_brand', 11),
(23, '2021_01_22_094413_review', 12),
(24, '2021_01_29_103949_subcategory', 13),
(26, '2021_01_30_102250_add_subcategory_id_into_product', 14),
(27, '2021_01_30_105849_add_image_and_color_into_product', 15),
(28, '2021_02_10_053616_forgot_link', 16),
(29, '2021_02_13_122759_cart', 17),
(30, '2021_02_16_085754_add_is_verified_into_users', 18),
(31, '2021_02_17_085137_user_address', 19),
(32, '2021_02_17_103056_order', 20),
(33, '2021_02_17_105210_order_product', 21),
(34, '2021_02_17_110354_order_status', 22),
(35, '2021_02_17_111007_payment', 23),
(36, '2021_02_19_115526_add_size_into_order_product', 24),
(37, '2021_02_19_132620_add_slip_image_into_order', 24),
(38, '2021_02_25_043625_remove_payment_from_product', 24),
(39, '2021_02_25_052114_add_weight_and_size_availability_into_product_size', 24),
(41, '2021_03_04_052316_contactus', 25),
(42, '2021_03_04_094404_adbanner', 26),
(43, '2021_03_05_103134_add_productunit', 27),
(44, '2021_03_05_104305_add_price_and_chart_into_product_size', 27),
(45, '2021_03_18_065301_add_product_unit_into_cart_and_order_product', 28),
(46, '2021_03_19_115234_add_business_into_users', 29),
(47, '2021_06_17_103408_add_dummy_price_into_product', 30),
(48, '2021_06_17_112539_add_discount_title_into_product', 31);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `ordernumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` double NOT NULL,
  `tax` double NOT NULL,
  `delivery_charge` double NOT NULL,
  `discount` double NOT NULL,
  `promo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grand_total` double NOT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` bigint(20) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_status` enum('pending_for_call','ready_for_pay','pending','confirm','onway','cancel','success','slip_refuse') COLLATE utf8mb4_unicode_ci NOT NULL,
  `cancel_reason` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` enum('pending','success','failed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `ordernumber`, `subtotal`, `tax`, `delivery_charge`, `discount`, `promo`, `grand_total`, `note`, `address`, `payment_method`, `transaction_id`, `order_status`, `cancel_reason`, `slip`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 33, '60337d4c95d77', 9000, 0, 0, 0, '0', 9000, NULL, 1, 'cashondelivery', NULL, 'confirm', NULL, NULL, 'pending', '2021-02-22 16:45:48', '2021-02-22 16:45:48'),
(2, 33, '6033c4bc7a525', 940, 0, 0, 0, '0', 940, NULL, 2, 'cashondelivery', NULL, 'confirm', NULL, NULL, 'pending', '2021-02-22 21:50:36', '2021-02-22 21:50:36'),
(3, 33, '6033c9fd73c1c', 25645, 0, 0, 0, '0', 25645, NULL, 2, 'cashondelivery', NULL, 'confirm', NULL, NULL, 'pending', '2021-02-22 22:13:01', '2021-02-22 22:13:01'),
(4, 32, '60689012c6ac9', 42000, 0, 0, 0, '0', 42000, NULL, 3, 'pending', NULL, 'pending_for_call', NULL, NULL, 'pending', '2021-04-03 15:56:02', '2021-04-03 15:56:02'),
(5, 22, '607adda38d4c2', 6555, 0, 0, 0, '0', 6555, NULL, 4, 'pending', NULL, 'pending_for_call', NULL, NULL, 'pending', '2021-04-17 13:07:47', '2021-04-17 13:07:47'),
(6, 22, '607adde5b2229', 0, 0, 0, 0, '0', 0, NULL, 4, 'pending', NULL, 'pending_for_call', NULL, NULL, 'pending', '2021-04-17 13:08:53', '2021-04-17 13:08:53'),
(7, 22, '607ae919b69f7', 6555, 0, 0, 0, '0', 6555, NULL, 4, 'pending', NULL, 'pending_for_call', NULL, NULL, 'pending', '2021-04-17 13:56:41', '2021-04-17 13:56:41'),
(8, 22, '607aeb0501bc8', 3250, 0, 0, 0, '0', 3250, NULL, 4, 'pending', NULL, 'pending_for_call', NULL, NULL, 'pending', '2021-04-17 14:04:53', '2021-04-17 14:04:53'),
(9, 22, '607aebc57831f', 0, 0, 0, 0, '0', 0, NULL, 4, 'pending', NULL, 'pending_for_call', NULL, NULL, 'pending', '2021-04-17 14:08:05', '2021-04-17 14:08:05'),
(10, 22, '607aec0944f4c', 0, 0, 0, 0, '0', 0, NULL, 4, 'pending', NULL, 'pending_for_call', NULL, NULL, 'pending', '2021-04-17 14:09:13', '2021-04-17 14:09:13'),
(11, 30, '607db17d5407c', 5400, 0, 0, 0, '0', 5400, NULL, 5, 'pending', NULL, 'pending_for_call', NULL, NULL, 'pending', '2021-04-19 16:36:13', '2021-04-19 16:36:13'),
(12, 22, '607db3f3c70bf', 7045, 0, 0, 0, '0', 7045, NULL, 4, 'pending', NULL, 'pending_for_call', NULL, NULL, 'pending', '2021-04-19 16:46:43', '2021-04-19 16:46:43'),
(13, 30, '607db5b075028', 14725, 0, 0, 0, '0', 14725, NULL, 6, 'pending', NULL, 'pending_for_call', NULL, NULL, 'pending', '2021-04-19 16:54:08', '2021-04-19 16:54:08'),
(14, 30, '607db6a764c67', 10500, 0, 0, 0, '0', 10500, NULL, 7, 'pending', NULL, 'pending_for_call', NULL, NULL, 'pending', '2021-04-19 16:58:15', '2021-04-19 16:58:15'),
(15, 30, '607db755caf83', 11800, 0, 0, 0, '0', 11800, NULL, 8, 'pending', NULL, 'pending_for_call', NULL, NULL, 'pending', '2021-04-19 17:01:09', '2021-04-19 17:01:09'),
(16, 30, '607db808ad14e', 14195, 0, 0, 0, '0', 14195, NULL, 8, 'pending', NULL, 'pending_for_call', NULL, NULL, 'pending', '2021-04-19 17:04:08', '2021-04-19 17:04:08'),
(17, 22, '607dbe1385de8', 6900, 0, 0, 0, '0', 6900, NULL, 9, 'banktransfer', NULL, 'pending', NULL, NULL, 'pending', '2021-04-19 17:29:55', '2021-05-05 14:14:29'),
(18, 30, '607e4c6291afe', 17950, 0, 0, 0, '0', 17950, NULL, 10, 'banktransfer', NULL, 'pending', NULL, NULL, 'pending', '2021-04-20 03:37:06', '2021-05-07 15:44:12'),
(19, 44, '607e5604e049c', 17000, 0, 0, 0, '0', 17000, NULL, 11, 'cashondelivery', NULL, 'pending', NULL, 'slip-609abc2ebb88b.jpg', 'pending', '2021-04-20 04:18:12', '2021-05-11 17:17:34'),
(20, 30, '607e563419237', 12450, 0, 0, 0, '0', 12450, NULL, 10, 'banktransfer', NULL, 'pending', NULL, 'slip-6095727b5c9d4.jpg', 'pending', '2021-04-20 04:19:00', '2021-05-07 17:01:47'),
(21, 22, '6081ade0b0f9e', 10825, 0, 0, 0, '0', 10825, NULL, 4, 'pending', NULL, 'ready_for_pay', NULL, NULL, 'pending', '2021-04-22 17:09:52', '2021-04-23 04:35:04'),
(22, 22, '6081adf886314', 0, 0, 0, 0, '0', 0, NULL, 4, 'cashondelivery', NULL, 'pending', NULL, NULL, 'pending', '2021-04-22 17:10:16', '2021-04-24 18:28:25'),
(23, 30, '6085747a2cce1', 23275, 0, 0, 0, '0', 23275, NULL, 12, 'online', 'pay_H7yezxS0DleTa0', 'confirm', NULL, NULL, 'success', '2021-04-25 13:54:02', '2021-05-07 17:01:22'),
(24, 44, '608eb8c490e72', 5850, 0, 0, 0, '0', 5850, NULL, 13, 'pending', NULL, 'pending_for_call', NULL, NULL, 'pending', '2021-05-02 14:35:48', '2021-05-02 14:35:48'),
(25, 30, '6092a7eb866d5', 5525, 0, 0, 0, '0', 5525, NULL, 10, 'banktransfer', NULL, 'pending', NULL, NULL, 'pending', '2021-05-05 14:12:59', '2021-05-12 13:58:47'),
(26, 44, '609c229a89d10', 6500, 0, 0, 0, '0', 6500, NULL, 14, 'pending', NULL, 'pending_for_call', NULL, NULL, 'pending', '2021-05-12 18:46:50', '2021-05-12 18:46:50'),
(27, 44, '609c22da50eea', 8590, 0, 0, 0, '0', 8590, NULL, 15, 'pending', NULL, 'pending_for_call', NULL, NULL, 'pending', '2021-05-12 18:47:54', '2021-05-12 18:47:54'),
(28, 30, '609ccab72fa5f', 5930, 0, 0, 0, '0', 5930, NULL, 10, 'pending', NULL, 'pending_for_call', NULL, NULL, 'pending', '2021-05-13 06:44:07', '2021-05-13 06:44:07'),
(29, 30, '609ccae751333', 5525, 0, 0, 0, '0', 5525, NULL, 10, 'pending', NULL, 'pending_for_call', NULL, NULL, 'pending', '2021-05-13 06:44:55', '2021-05-13 06:44:55'),
(30, 30, '609d50e6b71db', 5525, 0, 0, 0, '0', 5525, NULL, 10, 'pending', NULL, 'pending_for_call', NULL, NULL, 'pending', '2021-05-13 16:16:38', '2021-05-13 16:16:38'),
(31, 30, '609d57a56d3fd', 5985, 0, 0, 0, '0', 5985, NULL, 10, 'pending', NULL, 'pending_for_call', NULL, NULL, 'pending', '2021-05-13 16:45:25', '2021-05-13 16:45:25'),
(32, 30, '609d65468531f', 36375, 0, 0, 0, '0', 36375, NULL, 16, 'pending', NULL, 'pending_for_call', NULL, NULL, 'pending', '2021-05-13 17:43:34', '2021-05-13 17:43:34'),
(34, 30, '609ff816c0d83', 5820, 0, 0, 0, '0', 5820, NULL, 10, 'pending', NULL, 'pending_for_call', NULL, NULL, 'pending', '2021-05-15 16:34:30', '2021-05-15 16:34:30');

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `uniqueId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `qty` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`id`, `user_id`, `order_id`, `product_id`, `uniqueId`, `product_name`, `product_unit`, `size`, `price`, `qty`, `created_at`, `updated_at`) VALUES
(1, 33, 1, 74, '1613986990326', '1000 KAN BLUE', NULL, '', 9000, '1', '2021-02-22 16:45:48', '2021-02-22 16:45:48'),
(2, 33, 2, 68, '1614005390210', 'STAR TWINE', NULL, '', 235, '4', '2021-02-22 21:50:36', '2021-02-22 21:50:36'),
(3, 33, 3, 68, '1614006690811', 'STAR TWINE', NULL, '', 235, '7', '2021-02-22 22:13:01', '2021-02-22 22:13:01'),
(4, 33, 3, 72, '1614006703965', '1100 KAN STAR', NULL, '', 12000, '2', '2021-02-22 22:13:01', '2021-02-22 22:13:01'),
(5, 32, 4, 83, '1617465256363', 'STARBELLY  PUCHHDA', 'qty', '1200-mesh', 10500, '3', '2021-04-03 15:56:02', '2021-04-03 15:56:02'),
(6, 32, 4, 81, '1617465284175', 'RUNNER  PUCHHDA', 'qty', '1200-mesh', 10500, '1', '2021-04-03 15:56:02', '2021-04-03 15:56:02'),
(7, 22, 5, 64, '1613885891731', 'OCEAN RUNNER 18 PLY NET', 'weight', '2-cm', 335, '9', '2021-04-17 13:07:47', '2021-04-17 13:07:47'),
(8, 22, 5, 64, '1618709790845', 'OCEAN RUNNER 18 PLY NET', 'weight', '4-cm', 345, '10', '2021-04-17 13:07:47', '2021-04-17 13:07:47'),
(9, 22, 7, 64, '1613885891731', 'OCEAN RUNNER 18 PLY NET', 'weight', '2-cm', 335, '9', '2021-04-17 13:56:41', '2021-04-17 13:56:41'),
(10, 22, 7, 64, '1618709790845', 'OCEAN RUNNER 18 PLY NET', 'weight', '4-cm', 345, '10', '2021-04-17 13:56:41', '2021-04-17 13:56:41'),
(11, 22, 8, 63, '1618668222113', 'OCEAN SAFAYER 15 PLY NET', 'weight', '2-cm', 500, '10', '2021-04-17 14:04:53', '2021-04-17 14:04:53'),
(12, 30, 11, 65, '1618673616404', 'OCEAN STAR NET', 'weight', '2-cm', 345, '3', '2021-04-19 16:36:13', '2021-04-19 16:36:13'),
(13, 30, 11, 78, '1618850040332', 'OCEAN SAFAYER 30 PLY NET', 'weight', '50-cm', 325, '6', '2021-04-19 16:36:13', '2021-04-19 16:36:13'),
(14, 30, 11, 65, '1618850118528', 'OCEAN STAR NET', 'weight', '5-cm', 345, '7', '2021-04-19 16:36:13', '2021-04-19 16:36:13'),
(15, 22, 12, 66, '1618895729744', 'SNG 60 PLY NET', 'weight', '500-cm', 325, '10', '2021-04-19 16:46:43', '2021-04-19 16:46:43'),
(16, 22, 12, 64, '1618895744048', 'OCEAN RUNNER 18 PLY NET', 'weight', '2-cm', 345, '11', '2021-04-19 16:46:43', '2021-04-19 16:46:43'),
(17, 30, 13, 63, '1618851144064', 'OCEAN SAFAYER 15 PLY NET', 'weight', '2-cm', 325, '13', '2021-04-19 16:54:08', '2021-04-19 16:54:08'),
(18, 30, 13, 83, '1618851213059', 'STARBELLY  PUCHHDA', 'qty', '1200-mesh', 10500, '1', '2021-04-19 16:54:08', '2021-04-19 16:54:08'),
(19, 30, 14, 88, '1618851428265', 'SAFAYER PUCHHDA', 'qty', '1200-mesh', 10500, '1', '2021-04-19 16:58:15', '2021-04-19 16:58:15'),
(20, 30, 15, 63, '1618851535184', 'OCEAN SAFAYER 15 PLY NET', 'weight', '2-cm', 325, '4', '2021-04-19 17:01:09', '2021-04-19 17:01:09'),
(21, 30, 15, 81, '1618851585097', 'RUNNER  PUCHHDA', 'qty', '1200-mesh', 10500, '1', '2021-04-19 17:01:09', '2021-04-19 17:01:09'),
(22, 30, 16, 65, '1618851805947', 'OCEAN STAR NET', 'weight', '2-cm', 345, '6', '2021-04-19 17:04:08', '2021-04-19 17:04:08'),
(23, 30, 16, 66, '1618851818274', 'SNG 60 PLY NET', 'weight', '26-cm', 325, '5', '2021-04-19 17:04:08', '2021-04-19 17:04:08'),
(24, 30, 16, 81, '1618851832826', 'RUNNER  PUCHHDA', 'qty', '1200-mesh', 10500, '1', '2021-04-19 17:04:08', '2021-04-19 17:04:08'),
(25, 22, 17, 64, '1618898333315', 'OCEAN RUNNER 18 PLY NET', 'weight', '5-cm', 345, '12', '2021-04-19 17:29:55', '2021-04-19 17:29:55'),
(26, 22, 17, 65, '1618898343939', 'OCEAN STAR NET', 'weight', '2-cm', 345, '8', '2021-04-19 17:29:55', '2021-04-19 17:29:55'),
(27, 30, 18, 67, '1618852870474', 'RUNNER TWINE OCEAN', 'weight', '24-ply', 335, '3', '2021-04-20 03:37:06', '2021-04-20 03:37:06'),
(28, 30, 18, 66, '1618852892954', 'SNG 60 PLY NET', 'weight', '30-cm', 325, '7', '2021-04-20 03:37:06', '2021-04-20 03:37:06'),
(29, 30, 18, 88, '1618856214304', 'SAFAYER PUCHHDA', 'qty', '1200-mesh', 10500, '1', '2021-04-20 03:37:06', '2021-04-20 03:37:06'),
(30, 30, 18, 65, '1618889479459', 'OCEAN STAR NET', 'weight', '4-cm', 345, '8', '2021-04-20 03:37:06', '2021-04-20 03:37:06'),
(31, 30, 18, 86, '1618889618094', 'OCEAN ROCKY TWINE', 'qty', '15-ply', 235, '6', '2021-04-20 03:37:06', '2021-04-20 03:37:06'),
(32, 44, 19, 83, '1618856169041', 'STARBELLY  PUCHHDA', 'qty', '1200-mesh', 10500, '1', '2021-04-20 04:18:12', '2021-04-20 04:18:12'),
(33, 44, 19, 63, '1618892267978', 'OCEAN SAFAYER 15 PLY NET', 'weight', '2-cm', 325, '20', '2021-04-20 04:18:12', '2021-04-20 04:18:12'),
(34, 30, 20, 63, '1618892305333', 'OCEAN SAFAYER 15 PLY NET', 'weight', '3-cm', 325, '6', '2021-04-20 04:19:00', '2021-04-20 04:19:00'),
(35, 30, 20, 83, '1618892316197', 'STARBELLY  PUCHHDA', 'qty', '1200-mesh', 10500, '1', '2021-04-20 04:19:00', '2021-04-20 04:19:00'),
(36, 22, 21, 63, '1618892808622', 'OCEAN SAFAYER 15 PLY NET', 'weight', '3-cm', 325, '1', '2021-04-22 17:09:52', '2021-04-22 17:09:52'),
(37, 22, 21, 81, '1619156331937', 'RUNNER  PUCHHDA', 'qty', '1200-mesh', 10500, '1', '2021-04-22 17:09:52', '2021-04-22 17:09:52'),
(38, 30, 23, 63, '1619028551305', 'OCEAN SAFAYER 15 PLY NET', 'weight', '5-cm', 325, '7', '2021-04-25 13:54:02', '2021-04-25 13:54:02'),
(39, 30, 23, 88, '1619028572713', 'SAFAYER PUCHHDA', 'qty', '1200-mesh', 10500, '2', '2021-04-25 13:54:02', '2021-04-25 13:54:02'),
(40, 44, 24, 63, '1619965402037', 'OCEAN SAFAYER 15 PLY NET', 'weight', '2-cm', 325, '18', '2021-05-02 14:35:48', '2021-05-02 14:35:48'),
(41, 30, 25, 78, '1620223961313', 'OCEAN SAFAYER 30 PLY NET', 'weight', '50-cm', 325, '17', '2021-05-05 14:12:59', '2021-05-05 14:12:59'),
(42, 44, 26, 63, '1620845182885', 'OCEAN SAFAYER 15 PLY NET', 'weight', '2-cm', 325, '20', '2021-05-12 18:46:50', '2021-05-12 18:46:50'),
(43, 44, 27, 63, '1620845245386', 'OCEAN SAFAYER 15 PLY NET', 'weight', '2-cm', 325, '19', '2021-05-12 18:47:54', '2021-05-12 18:47:54'),
(44, 44, 27, 64, '1620845255539', 'OCEAN RUNNER 18 PLY NET', 'weight', '2-cm', 345, '7', '2021-05-12 18:47:54', '2021-05-12 18:47:54'),
(45, 30, 28, 65, '1620888237879', 'OCEAN STAR NET', 'weight', '4-cm', 345, '10', '2021-05-13 06:44:07', '2021-05-13 06:44:07'),
(46, 30, 28, 76, '1620888237880', 'HDPE NET OCEAN', 'qty', '2-cm', 310, '8', '2021-05-13 06:44:07', '2021-05-13 06:44:07'),
(47, 30, 29, 63, '1620888285936', 'OCEAN SAFAYER 15 PLY NET', 'weight', '5-cm', 325, '17', '2021-05-13 06:44:55', '2021-05-13 06:44:55'),
(48, 30, 30, 63, '1620922575369', 'OCEAN SAFAYER 15 PLY NET', 'weight', '5-cm', 325, '17', '2021-05-13 16:16:38', '2021-05-13 16:16:38'),
(49, 30, 31, 87, '1620922639399', 'OCEAN SNG TWINE', 'weight', '45-ply', 235, '5', '2021-05-13 16:45:25', '2021-05-13 16:45:25'),
(50, 30, 31, 65, '1620923172052', 'OCEAN STAR NET', 'weight', '6-cm', 345, '8', '2021-05-13 16:45:25', '2021-05-13 16:45:25'),
(51, 30, 31, 66, '1620924304207', 'SNG 60 PLY NET', 'weight', '60-cm', 325, '1', '2021-05-13 16:45:25', '2021-05-13 16:45:25'),
(52, 30, 31, 64, '1620924304210', 'OCEAN RUNNER 18 PLY NET', 'weight', '5-cm', 345, '5', '2021-05-13 16:45:25', '2021-05-13 16:45:25'),
(53, 30, 32, 63, '1620925028457', 'OCEAN SAFAYER 15 PLY NET', 'weight', '5-cm', 325, '4', '2021-05-13 17:43:34', '2021-05-13 17:43:34'),
(54, 30, 32, 66, '1620927567686', 'SNG 60 PLY NET', 'weight', '40-cm', 325, '1', '2021-05-13 17:43:34', '2021-05-13 17:43:34'),
(55, 30, 32, 88, '1620927722496', 'SAFAYER PUCHHDA', 'qty', '1200-mesh', 10500, '3', '2021-05-13 17:43:34', '2021-05-13 17:43:34'),
(56, 30, 32, 63, '1620927774842', 'OCEAN SAFAYER 15 PLY NET', 'weight', '2-cm', 325, '5', '2021-05-13 17:43:34', '2021-05-13 17:43:34'),
(57, 30, 32, 63, '1620927774842', 'OCEAN SAFAYER 15 PLY NET', 'weight', '3-cm', 325, '5', '2021-05-13 17:43:34', '2021-05-13 17:43:34'),
(60, 30, 34, 66, '1621095433343', 'SNG 60 PLY NET', 'weight', '50-cm', 325, '1', '2021-05-15 16:34:30', '2021-05-15 16:34:30'),
(61, 30, 34, 76, '1621096458955', 'HDPE NET OCEAN', 'qty', '2-cm', 310, '2', '2021-05-15 16:34:30', '2021-05-15 16:34:30'),
(62, 30, 34, 63, '1621096458975', 'OCEAN SAFAYER 15 PLY NET', 'weight', '5-cm', 325, '15', '2021-05-15 16:34:30', '2021-05-15 16:34:30');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `order_status` enum('pending_for_call','ready_for_pay','pending','confirm','onway','cancel','success','slip_refuse') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `user_id`, `order_id`, `order_status`, `created_at`, `updated_at`) VALUES
(1, 33, 1, 'pending', '2021-02-22 16:45:48', '2021-02-22 16:45:48'),
(2, 33, 2, 'pending', '2021-02-22 21:50:36', '2021-02-22 21:50:36'),
(3, 33, 3, 'pending', '2021-02-22 22:13:01', '2021-02-22 22:13:01'),
(4, 22, 22, 'pending', '2021-04-24 18:28:25', '2021-04-24 18:28:25'),
(5, 44, 19, 'pending', '2021-04-25 13:59:27', '2021-04-25 13:59:27'),
(6, 22, 17, 'pending', '2021-05-05 14:14:29', '2021-05-05 14:14:29'),
(7, 22, 18, 'pending', '2021-05-07 05:00:30', '2021-05-07 05:00:30'),
(8, 30, 18, 'pending', '2021-05-07 15:44:12', '2021-05-07 15:44:12'),
(9, 30, 20, 'pending', '2021-05-07 15:56:06', '2021-05-07 15:56:06'),
(10, 30, 23, 'confirm', '2021-05-07 17:01:22', '2021-05-07 17:01:22'),
(11, 30, 25, 'pending', '2021-05-12 13:58:47', '2021-05-12 13:58:47');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_expire` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` enum('pending','success','failed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `user_id`, `order_id`, `payment_method`, `transaction_id`, `card_last`, `card_expire`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 33, 1, 'cashondelivery', NULL, '0', '0', 'pending', '2021-02-22 16:45:48', '2021-02-22 16:45:48'),
(2, 33, 2, 'cashondelivery', NULL, '0', '0', 'pending', '2021-02-22 21:50:36', '2021-02-22 21:50:36'),
(3, 33, 3, 'cashondelivery', NULL, '0', '0', 'pending', '2021-02-22 22:13:01', '2021-02-22 22:13:01'),
(4, 22, 22, 'cashondelivery', NULL, '0', '0', 'pending', '2021-04-24 18:28:25', '2021-04-24 18:28:25'),
(5, 44, 19, 'cashondelivery', NULL, '0', '0', 'pending', '2021-04-25 13:59:27', '2021-04-25 13:59:27'),
(6, 22, 17, 'banktransfer', NULL, '0', '0', 'pending', '2021-05-05 14:14:29', '2021-05-05 14:14:29'),
(7, 22, 18, 'banktransfer', NULL, '0', '0', 'pending', '2021-05-07 05:00:30', '2021-05-07 05:00:30'),
(8, 30, 18, 'banktransfer', NULL, '0', '0', 'pending', '2021-05-07 15:44:12', '2021-05-07 15:44:12'),
(9, 30, 20, 'banktransfer', NULL, '0', '0', 'pending', '2021-05-07 15:56:06', '2021-05-07 15:56:06'),
(10, 30, 23, 'online', 'pay_H7yezxS0DleTa0', '0', '0', 'success', '2021-05-07 17:01:22', '2021-05-07 17:01:22'),
(11, 30, 25, 'banktransfer', NULL, '0', '0', 'pending', '2021-05-12 13:58:47', '2021-05-12 13:58:47');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_id` bigint(20) NOT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `subcategory_id` bigint(20) DEFAULT NULL,
  `product_unit` enum('qty','weight') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `old_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','deactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stock_status` enum('available','out_of_stock','few_available','pre_order') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `type_id`, `category_id`, `subcategory_id`, `product_unit`, `description`, `image`, `color`, `price`, `old_price`, `discount_title`, `status`, `created_at`, `updated_at`, `stock_status`) VALUES
(63, 'OCEAN SAFAYER 15 PLY NET', 1, 9, 9, 'weight', '<p><span style=\"font-family: \"Arial Black\";\" arial=\"\" black\";\"=\"\">﻿</span><font color=\"#000000\" style=\"\"><span style=\"\" arial=\"\" black\";\"=\"\" good=\"\" times=\"\" rg\";\"=\"\"><span style=\"font-family: \"Arial Black\";\" arial=\"\" black\";\"=\"\">NAME</span></span><span style=\"font-family: \"Arial Black\";\" arial=\"\" black\";\"=\"\" good=\"\" times=\"\" rg\";\"=\"\"> = 15 PLY SAFAYER </span></font></p><p><font color=\"#000000\"><span style=\"font-family: \"Arial Black\";\" arial=\"\" black\";\"=\"\" good=\"\" times=\"\" rg\";\"=\"\">\r\nBRAND</span><span style=\"font-family: \"Arial Black\";\" arial=\"\" black\";\"=\"\" good=\"\" times=\"\" rg\";\"=\"\"> = OCEAN\r\nBRAND </span></font></p><p><font color=\"#000000\"><span style=\"font-family: \"Arial Black\";\" arial=\"\" black\";\"=\"\" good=\"\" times=\"\" rg\";\"=\"\">PRODUCT NAME</span><span style=\"font-family: \"Arial Black\";\" arial=\"\" black\";\"=\"\" good=\"\" times=\"\" rg\";\"=\"\"> = MARINE BLUE\r\n</span></font></p><p><font color=\"#000000\"><span style=\"font-family: \"Arial Black\";\" arial=\"\" black\";\"=\"\" good=\"\" times=\"\" rg\";\"=\"\">PLY</span><span style=\"font-family: \"Arial Black\";\" arial=\"\" black\";\"=\"\" good=\"\" times=\"\" rg\";\"=\"\"> = 15 (3x5)</span></font></p><p><span arial=\"\" black\";\"=\"\" good=\"\" times=\"\" rg\";\"=\"\" style=\"color: rgb(0, 0, 0); font-size: 0.875rem; font-family: \"Arial Black\";\">COLOUR</span><span arial=\"\" black\";\"=\"\" good=\"\" times=\"\" rg\";\"=\"\" style=\"color: rgb(0, 0, 0); font-size: 0.875rem; font-family: \"Arial Black\";\"> = DARK BLUE</span></p>', 'product-6031cef166e49.png', '#033163', '325.00', NULL, NULL, 'active', '2021-02-21 10:09:37', '2021-03-25 18:55:13', 'available'),
(64, 'OCEAN RUNNER 18 PLY NET', 1, 20, 10, 'weight', '<p><font color=\"#000000\"><b><span style=\"font-family: \"Arial Black\";\" arial=\"\" black\";\"=\"\">NAME = RUNNER </span><span style=\"font-size: 0.875rem; font-family: \"Arial Black\";\" arial=\"\" black\";\"=\"\">18 PLY</span></b></font></p><p><span style=\"font-size: 0.875rem; font-family: \"Arial Black\";\" arial=\"\" black\";\"=\"\"><font color=\"#000000\"><b> NET\r\nBRAND = OCEAN\r\nBRAND </b></font></span></p><p><span style=\"font-size: 0.875rem; font-family: \"Arial Black\";\" arial=\"\" black\";\"=\"\"><font color=\"#000000\"><b>PRODUCT NAME = GOLDEN YELLOW\r\n</b></font></span></p><p><span style=\"font-size: 0.875rem; font-family: \"Arial Black\";\" arial=\"\" black\";\"=\"\"><font color=\"#000000\"><b>PLY = 18 (6X3)</b></font></span></p><p><span style=\"font-size: 0.875rem; font-family: \"Arial Black\";\" arial=\"\" black\";\"=\"\"><font color=\"#000000\"><b>\r\n</b></font></span></p><p><span style=\"font-size: 0.875rem; font-family: \"Arial Black\";\" arial=\"\" black\";\"=\"\"><font color=\"#000000\"><b>DENIRE = 280</b></font></span></p><p><span style=\"font-size: 0.875rem; font-family: \"Arial Black\";\" arial=\"\" black\";\"=\"\"><font color=\"#000000\"><b>COLOUR = YELLOW</b></font></span></p>', 'product-6031dfdeafbaa.png', '#e8cd23', '345.00', NULL, NULL, 'active', '2021-02-21 11:21:50', '2021-03-22 20:44:27', 'available'),
(65, 'OCEAN STAR NET', 1, 21, 13, 'weight', '<p>NAME = STAR NET\r\n</p><p>BRAND = OCEAN\r\nBRAND </p><p>PRODUCT NAME = STAR BLUE</p><p>PLY = 54 PLY&nbsp;</p><p><span style=\"font-size: 0.875rem;\">COLOUR = SKY BLUE</span></p>', 'product-6031e2964007a.png', '#a9eff4', '345.00', NULL, NULL, 'active', '2021-02-21 11:33:26', '2021-03-22 21:02:45', 'available'),
(66, 'SNG 60 PLY NET', 1, 22, 15, 'weight', 'SNG', 'product-6031e57b71eeb.png', '#ea7739', '325.00', NULL, NULL, 'active', '2021-02-21 11:38:59', '2021-03-22 21:04:24', 'available'),
(67, 'RUNNER TWINE OCEAN', 2, 14, 7, 'weight', '<p><span style=\"font-family: &quot;Arial Black&quot;;\"><b>NAME = RUNNER TWINE\r\n</b></span></p><p><span style=\"font-family: &quot;Arial Black&quot;;\"><b>BRAND = OCEAN\r\nBRAND </b></span></p><p><span style=\"font-family: &quot;Arial Black&quot;;\"><b>PRODUCT NAME = G.YELLOW TWINE\r\n</b></span></p><p><span style=\"font-family: &quot;Arial Black&quot;;\"><b>PLY = 18PLY / 24 PLY </b></span></p><p><span style=\"font-family: &quot;Arial Black&quot;;\"><b>COLOUR&nbsp; = GOLDEN YELLOW</b></span></p>', 'product-60322c2413920.png', '#f3c41b', '335.00', NULL, NULL, 'active', '2021-02-21 16:47:16', '2021-03-22 21:19:58', 'available'),
(68, 'OCEAN STAR TWINE', 2, 8, 19, 'weight', '<p><span style=\"font-family: \"Arial Black\";\"><b>NAME = STAR TWINE\r\n</b></span></p><p><span style=\"font-family: \"Arial Black\";\"><b>BRAND = OCEAN\r\nBRAND </b></span></p><p><span style=\"font-family: \"Arial Black\";\"><b>PRODUCT NAME = S.BLUE  TWINE\r\n</b></span></p><p><span style=\"font-family: \"Arial Black\";\"><b>PLY = 54 ply / 90 ply </b></span></p><p><span style=\"font-family: \"Arial Black\";\"><b>COLOUR = SKY BLUE</b></span></p>', 'product-603239d501b36.png', '#adfaff', '245.00', NULL, NULL, 'active', '2021-02-21 16:49:20', '2021-03-22 21:52:25', 'available'),
(69, 'BLACK MARINE TWINE', 2, 19, 4, NULL, '<p><font color=\"#000000\"><b><span style=\"font-family: &quot;Arial Black&quot;;\">NAME = BLACK MARINE TWINE\r\n</span></b></font></p><p><font color=\"#000000\"><b><span style=\"font-family: &quot;Arial Black&quot;;\">BRAND = OCEAN\r\nBRAND </span></b></font></p><p><font color=\"#000000\"><b><span style=\"font-family: &quot;Arial Black&quot;;\">PRODUCT NAME = B.MARINE TWINE\r\n</span></b></font></p><p><font color=\"#000000\"><b><span style=\"font-family: &quot;Arial Black&quot;;\">PLY = 36\r\n</span></b></font></p><p><font color=\"#000000\"><b><span style=\"font-family: &quot;Arial Black&quot;;\">DENIRE = 360</span></b></font></p><p><font color=\"#000000\"><b><span style=\"font-family: &quot;Arial Black&quot;;\">COLOUR = BLACK</span></b></font></p>', 'product-60323a8150e50.png', '#000000', '235.00', NULL, NULL, 'active', '2021-02-21 17:48:33', '2021-03-14 01:41:26', 'available'),
(75, 'OCEAN DENIRE NET', 1, 10, 18, 'weight', '<p><span style=\"font-family: \"Arial Black\";\"><b><font color=\"#000000\">NAME = DENIRE TWINE</font></b></span></p><p><span style=\"font-family: \"Arial Black\";\"><b><font color=\"#000000\">BRAND = OCEAN BRAND</font></b></span></p><p><span style=\"font-family: \"Arial Black\";\"><b><font color=\"#000000\">BRAND NAME = LONAWALA GREEN</font></b></span></p><p><span style=\"font-family: \"Arial Black\";\"><b><font color=\"#000000\">PLY = 18 (6X3)</font></b></span></p><p><span style=\"font-family: \"Arial Black\";\"><b><font color=\"#000000\">DENIRE = 500</font></b></span></p><p><br></p>', NULL, NULL, '310.00', NULL, NULL, 'active', '2021-03-14 02:19:01', '2021-03-22 21:05:22', 'available'),
(76, 'HDPE NET OCEAN', 1, 13, 12, 'qty', '<p><span style=\"font-family: &quot;Arial Black&quot;;\"><font color=\"#000000\">LOCAL NAME = HDPE NET</font></span></p><p><span style=\"font-family: &quot;Arial Black&quot;;\"><font color=\"#000000\">BRAND&nbsp; = OCEAN NET</font></span></p><p><span style=\"font-family: &quot;Arial Black&quot;;\"><font color=\"#000000\">PRODUCT NAME = LONAVALA BLUE</font></span></p><p><span style=\"font-family: &quot;Arial Black&quot;;\"><font color=\"#000000\">PLY = 24</font></span></p><p><span style=\"font-family: &quot;Arial Black&quot;;\"><font color=\"#000000\">DENIRE = 280</font></span></p><p><span style=\"font-family: &quot;Arial Black&quot;;\"><font color=\"#000000\">COLOUR = BLUE</font></span></p><p><span style=\"font-family: &quot;Arial Black&quot;;\"><font color=\"#000000\"><br></font>﻿</span><br></p>', NULL, NULL, '310.00', NULL, NULL, 'active', '2021-03-14 03:31:35', '2021-03-14 03:31:35', 'available'),
(78, 'OCEAN SAFAYER 30 PLY NET', 1, 9, 27, 'weight', '<p><span style=\"font-family: &quot;Arial Black&quot;;\"><b>LOCAL NAME = SFAYER</b></span></p><p><span style=\"font-family: &quot;Arial Black&quot;;\"><b>BRAND = OCEAN</b></span></p><p><span style=\"font-family: &quot;Arial Black&quot;;\"><b>BRAND NAME = MARINE BLUE</b></span></p><p><span style=\"font-family: &quot;Arial Black&quot;;\"><b>PLY = 30 PLY</b></span></p><p><span style=\"font-family: &quot;Arial Black&quot;;\"><b>COLOUR = DARK BLUE</b></span></p><p><br></p>', NULL, NULL, '325.00', NULL, NULL, 'active', '2021-03-24 15:06:51', '2021-03-24 20:35:07', 'available'),
(81, 'RUNNER  PUCHHDA', 7, 2, 21, 'qty', '<p><span style=\"font-family: &quot;Arial Black&quot;;\">NAME = RUNNER PUCHHDA</span></p><p><span style=\"font-family: &quot;Arial Black&quot;;\">MATERIAL = RUNNER</span></p><p><span style=\"font-family: &quot;Arial Black&quot;;\">MATERIAL BRAND = OCEAN</span></p><p><span style=\"font-family: &quot;Arial Black&quot;;\">MATERIAL PLY = 18 PLY / 24 PLY</span></p><p><span style=\"font-family: &quot;Arial Black&quot;;\"><b>WEIGHT = 20 TO 25 KGS</b></span></p><p><span style=\"font-family: &quot;Arial Black&quot;;\"><b><br></b></span></p>', NULL, NULL, '10500.00', NULL, NULL, 'active', '2021-03-24 20:50:58', '2021-03-25 19:21:02', 'available'),
(83, 'STARBELLY  PUCHHDA', 7, 3, 23, 'qty', '<p><span style=\"font-family: &quot;Arial Black&quot;;\"><b>NAME = STAR PUCHHDA</b></span></p><p><span style=\"font-family: &quot;Arial Black&quot;;\"><b>BRAND = FISHERMAN NET</b></span></p><p><span style=\"font-family: &quot;Arial Black&quot;;\"><b>MATERIAL = STAR</b></span></p><p><span style=\"font-family: &quot;Arial Black&quot;;\"><b>MATERIAL BRAND = OCEAN</b></span></p><p><span style=\"font-family: &quot;Arial Black&quot;;\"><b>MATERIAL PLY = 54 PLY</b></span></p><p><span style=\"font-family: &quot;Arial Black&quot;;\"><b>WEIGHT = 22 KGS TO 25 KGS</b></span></p><p><br></p><p><br></p>', NULL, NULL, '10500.00', NULL, NULL, 'active', '2021-03-25 19:18:24', '2021-03-25 19:21:32', 'available'),
(85, 'SAFAYER 45 PLY TWINE', 2, 18, 29, 'weight', '<p>ABC</p>', NULL, NULL, '235.00', NULL, NULL, 'active', '2021-03-25 21:32:35', '2021-03-25 21:32:35', 'available'),
(86, 'OCEAN ROCKY TWINE', 2, 6, 30, 'qty', '<p>abc</p>', NULL, NULL, '235.00', NULL, NULL, 'active', '2021-03-25 21:40:10', '2021-03-25 21:40:10', 'available'),
(87, 'OCEAN SNG TWINE', 2, 16, 6, 'weight', '<p>ABC</p>', NULL, NULL, '235.00', NULL, NULL, 'active', '2021-03-25 21:41:31', '2021-03-25 21:58:57', 'available'),
(88, 'SAFAYER PUCHHDA', 7, 1, 22, 'qty', '<p>ABC</p>', NULL, NULL, '10500.00', NULL, NULL, 'active', '2021-03-25 22:16:57', '2021-03-25 22:17:45', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `product_brand`
--

CREATE TABLE `product_brand` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_brand`
--

INSERT INTO `product_brand` (`id`, `product_id`, `brand_id`, `created_at`, `updated_at`) VALUES
(181, 69, 3, '2021-03-14 01:41:26', '2021-03-14 01:41:26'),
(189, 76, 3, '2021-03-14 03:31:35', '2021-03-14 03:31:35'),
(198, 64, 3, '2021-03-22 20:44:27', '2021-03-22 20:44:27'),
(203, 65, 3, '2021-03-22 21:02:45', '2021-03-22 21:02:45'),
(205, 66, 3, '2021-03-22 21:04:24', '2021-03-22 21:04:24'),
(206, 75, 3, '2021-03-22 21:05:22', '2021-03-22 21:05:22'),
(207, 67, 3, '2021-03-22 21:19:58', '2021-03-22 21:19:58'),
(217, 68, 3, '2021-03-22 21:52:25', '2021-03-22 21:52:25'),
(226, 78, 3, '2021-03-24 20:35:07', '2021-03-24 20:35:07'),
(232, 63, 3, '2021-03-25 18:55:13', '2021-03-25 18:55:13'),
(238, 81, 4, '2021-03-25 19:21:02', '2021-03-25 19:21:02'),
(239, 83, 4, '2021-03-25 19:21:32', '2021-03-25 19:21:32'),
(240, 85, 3, '2021-03-25 21:32:35', '2021-03-25 21:32:35'),
(241, 86, 3, '2021-03-25 21:40:10', '2021-03-25 21:40:10'),
(244, 87, 3, '2021-03-25 21:58:57', '2021-03-25 21:58:57'),
(246, 88, 4, '2021-03-25 22:17:45', '2021-03-25 22:17:45');

-- --------------------------------------------------------

--
-- Table structure for table `product_color`
--

CREATE TABLE `product_color` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(33, 63, 'product-604cb7d765a06.jpg', '2021-03-13 20:02:15', '2021-03-13 20:02:15'),
(34, 69, 'product-604d06500bb01.jpg', '2021-03-14 01:37:04', '2021-03-14 01:37:04'),
(36, 69, 'product-604d06a8f169f.jpg', '2021-03-14 01:38:32', '2021-03-14 01:38:32'),
(37, 69, 'product-604d06a8f2e06.jpg', '2021-03-14 01:38:32', '2021-03-14 01:38:32'),
(40, 76, 'product-604d212730699.jpg', '2021-03-14 03:31:35', '2021-03-14 03:31:35'),
(41, 76, 'product-604d212731937.jpg', '2021-03-14 03:31:35', '2021-03-14 03:31:35'),
(42, 64, 'product-60589f3bdb937.jpg', '2021-03-22 20:44:27', '2021-03-22 20:44:27'),
(43, 64, 'product-60589f3bdc48b.jpg', '2021-03-22 20:44:27', '2021-03-22 20:44:27'),
(45, 65, 'product-6058a2e8430c8.jpg', '2021-03-22 21:00:08', '2021-03-22 21:00:08'),
(46, 65, 'product-6058a3301aa61.jpg', '2021-03-22 21:01:20', '2021-03-22 21:01:20'),
(47, 75, 'product-6058a3c64717f.jpg', '2021-03-22 21:03:50', '2021-03-22 21:03:50'),
(48, 66, 'product-6058a3e8bde24.jpg', '2021-03-22 21:04:24', '2021-03-22 21:04:24'),
(49, 75, 'product-6058a4226fe16.jpg', '2021-03-22 21:05:22', '2021-03-22 21:05:22'),
(50, 67, 'product-6058a78e6aed6.jpg', '2021-03-22 21:19:58', '2021-03-22 21:19:58'),
(60, 68, 'product-6058aed9eed47.jpg', '2021-03-22 21:51:05', '2021-03-22 21:51:05'),
(62, 68, 'product-6058af2984062.jpg', '2021-03-22 21:52:25', '2021-03-22 21:52:25'),
(63, 68, 'product-6058af2984f00.jpg', '2021-03-22 21:52:25', '2021-03-22 21:52:25'),
(68, 78, 'product-605af49aa1ea7.jpg', '2021-03-24 15:13:14', '2021-03-24 15:13:14'),
(70, 78, 'product-605af5add505d.jpg', '2021-03-24 15:17:49', '2021-03-24 15:17:49'),
(75, 81, 'product-605c7d763e6ef.jpg', '2021-03-25 19:09:26', '2021-03-25 19:09:26'),
(76, 81, 'product-605c7d763fdab.jpg', '2021-03-25 19:09:26', '2021-03-25 19:09:26'),
(77, 83, 'product-605c7f90e359b.jpg', '2021-03-25 19:18:24', '2021-03-25 19:18:24'),
(78, 83, 'product-605c804c73bdc.jpg', '2021-03-25 19:21:32', '2021-03-25 19:21:32'),
(79, 85, 'product-605c9f033f6a6.jpg', '2021-03-25 21:32:35', '2021-03-25 21:32:35'),
(80, 86, 'product-605ca0ca34fa4.jpg', '2021-03-25 21:40:10', '2021-03-25 21:40:10'),
(81, 86, 'product-605ca0ca35608.jpg', '2021-03-25 21:40:10', '2021-03-25 21:40:10'),
(82, 86, 'product-605ca0ca359f6.jpg', '2021-03-25 21:40:10', '2021-03-25 21:40:10'),
(86, 87, 'product-605ca5073ab3a.jpg', '2021-03-25 21:58:15', '2021-03-25 21:58:15'),
(87, 87, 'product-605ca531128bd.jpg', '2021-03-25 21:58:57', '2021-03-25 21:58:57'),
(88, 87, 'product-605ca5311376f.jpg', '2021-03-25 21:58:57', '2021-03-25 21:58:57'),
(89, 88, 'product-605ca9692db73.jpg', '2021-03-25 22:16:57', '2021-03-25 22:16:57'),
(90, 88, 'product-605ca9692e658.jpg', '2021-03-25 22:16:57', '2021-03-25 22:16:57');

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_size` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size_unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chart` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size_available` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_size`
--

INSERT INTO `product_size` (`id`, `product_id`, `size_unit`, `size`, `weight`, `price`, `chart`, `size_available`, `created_at`, `updated_at`) VALUES
(355, 63, 'cm', '2', NULL, '500', 'chart-605aea28a4ad1.png', 'yes', '2021-02-21 10:12:51', '2021-03-25 18:55:13'),
(356, 63, 'cm', '3', NULL, '500', 'chart-605aea28a557c.png', 'yes', '2021-02-21 10:12:51', '2021-03-25 18:55:13'),
(357, 63, 'cm', '4', NULL, '325', 'chart-605aea28a5d29.png', 'yes', '2021-02-21 10:12:51', '2021-03-25 18:55:13'),
(358, 63, 'cm', '5', NULL, '370', 'chart-605aea28a6661.png', 'yes', '2021-02-21 10:12:51', '2021-03-25 18:55:13'),
(359, 63, 'cm', '6', NULL, '325', 'chart-605aea28a6dbc.png', 'yes', '2021-02-21 10:12:51', '2021-03-25 18:55:13'),
(360, 64, 'cm', '2', NULL, '345', NULL, 'yes', '2021-02-21 11:21:50', '2021-03-22 20:44:27'),
(361, 64, 'cm', '3', NULL, '345', NULL, 'yes', '2021-02-21 11:21:50', '2021-03-22 20:44:27'),
(362, 64, 'cm', '4', NULL, '345', NULL, 'yes', '2021-02-21 11:21:50', '2021-03-22 20:44:27'),
(363, 64, 'cm', '5', NULL, '345', NULL, 'yes', '2021-02-21 11:21:50', '2021-03-22 20:44:27'),
(364, 64, 'cm', '6', NULL, '345', NULL, 'yes', '2021-02-21 11:21:50', '2021-03-22 20:44:27'),
(365, 65, 'cm', '2', NULL, '345', NULL, 'yes', '2021-02-21 11:33:26', '2021-03-22 21:02:45'),
(366, 65, 'cm', '3', NULL, '345', NULL, 'yes', '2021-02-21 11:33:26', '2021-03-22 21:02:45'),
(367, 65, 'cm', '4', NULL, '345', NULL, 'yes', '2021-02-21 11:33:26', '2021-03-22 21:02:45'),
(368, 65, 'cm', '5', NULL, '345', NULL, 'yes', '2021-02-21 11:33:26', '2021-03-22 21:02:45'),
(369, 65, 'cm', '6', NULL, '345', NULL, 'yes', '2021-02-21 11:33:26', '2021-03-22 21:02:45'),
(398, 66, 'cm', '26', NULL, '325', 'chart-604d1446a56a7.png', 'yes', '2021-02-21 11:46:40', '2021-03-22 21:04:24'),
(399, 66, 'cm', '30', NULL, '325', 'chart-604d1446a655e.png', 'yes', '2021-02-21 11:46:40', '2021-03-22 21:04:24'),
(400, 66, 'cm', '40', NULL, '325', 'chart-604d1446a7309.png', 'yes', '2021-02-21 11:46:40', '2021-03-22 21:04:24'),
(401, 66, 'cm', '50', NULL, '325', 'chart-604d1446a8020.png', 'yes', '2021-02-21 11:46:40', '2021-03-22 21:04:24'),
(402, 66, 'cm', '60', NULL, '325', 'chart-604d1446a8c8d.png', 'yes', '2021-02-21 11:46:40', '2021-03-22 21:04:24'),
(403, 66, 'cm', '80', NULL, '325', 'chart-604d1446a9919.png', 'yes', '2021-02-21 11:46:40', '2021-03-22 21:04:24'),
(404, 66, 'cm', '100', NULL, '325', 'chart-604d1446aa5a0.png', 'yes', '2021-02-21 11:46:40', '2021-03-22 21:04:24'),
(405, 66, 'cm', '120', NULL, '325', 'chart-604d1446aaf87.png', 'yes', '2021-02-21 11:46:40', '2021-03-22 21:04:24'),
(406, 66, 'cm', '150', NULL, '325', 'chart-604d1446abc72.png', 'yes', '2021-02-21 11:46:40', '2021-03-22 21:04:24'),
(407, 66, 'cm', '200', NULL, '325', 'chart-604d1446ac87b.png', 'yes', '2021-02-21 11:46:40', '2021-03-22 21:04:24'),
(408, 66, 'cm', '300', NULL, '325', 'chart-604d1446ad55b.png', 'yes', '2021-02-21 11:46:40', '2021-03-22 21:04:24'),
(409, 66, 'cm', '400', NULL, '325', 'chart-604d1446adf98.png', 'yes', '2021-02-21 11:46:40', '2021-03-22 21:04:24'),
(410, 66, 'cm', '500', NULL, '325', 'chart-604d1446aec8d.png', 'yes', '2021-02-21 11:46:40', '2021-03-22 21:04:24'),
(411, 66, 'cm', '600', NULL, '325', 'chart-604d1446af860.png', 'yes', '2021-02-21 11:46:40', '2021-03-22 21:04:24'),
(416, 67, 'ply', '18', NULL, '245', NULL, 'yes', '2021-02-21 16:49:34', '2021-03-22 21:19:58'),
(417, 67, 'ply', '24', NULL, '245', NULL, 'yes', '2021-02-21 16:49:34', '2021-03-22 21:19:58'),
(422, 68, 'ply', '54', NULL, '245', NULL, 'yes', '2021-02-21 17:45:41', '2021-03-22 21:52:25'),
(423, 68, 'ply', '90', NULL, '245', NULL, 'yes', '2021-02-21 17:45:41', '2021-03-22 21:52:25'),
(424, 69, 'ply', '36', NULL, '235', NULL, 'yes', '2021-02-21 17:48:33', '2021-03-14 01:41:26'),
(438, 75, 'cm', '2', NULL, '310', 'chart-604d10b390823.png', 'yes', '2021-03-14 02:19:01', '2021-03-22 21:05:22'),
(439, 75, 'cm', '3', NULL, '310', 'chart-604d12ffd6f15.png', 'yes', '2021-03-14 02:31:11', '2021-03-22 21:05:22'),
(440, 75, 'cm', '4', NULL, '310', 'chart-604d12ffd73e0.png', 'yes', '2021-03-14 02:31:11', '2021-03-22 21:05:22'),
(441, 75, 'cm', '6', NULL, '310', 'chart-604d12ffd7808.png', 'yes', '2021-03-14 02:31:11', '2021-03-22 21:05:22'),
(442, 75, 'cm', '8', NULL, '310', 'chart-604d12ffd7e52.png', 'yes', '2021-03-14 02:31:11', '2021-03-22 21:05:22'),
(443, 75, 'cm', '10', NULL, '310', 'chart-604d12ffd821e.png', 'yes', '2021-03-14 02:31:11', '2021-03-22 21:05:22'),
(444, 75, 'cm', '12', NULL, '310', 'chart-604d12ffd8b2a.png', 'yes', '2021-03-14 02:31:11', '2021-03-22 21:05:22'),
(445, 75, 'cm', '16', NULL, '310', 'chart-604d12ffd9192.png', 'yes', '2021-03-14 02:31:11', '2021-03-22 21:05:22'),
(446, 75, 'cm', '20', NULL, '310', 'chart-604d12ffd9546.png', 'yes', '2021-03-14 02:31:11', '2021-03-22 21:05:22'),
(447, 75, 'cm', '24', NULL, '310', 'chart-604d12ffd98e3.png', 'yes', '2021-03-14 02:31:11', '2021-03-22 21:05:22'),
(448, 75, 'cm', '30', NULL, '310', 'chart-604d13990d293.png', 'yes', '2021-03-14 02:33:45', '2021-03-22 21:05:22'),
(449, 75, 'cm', '40', NULL, '310', 'chart-604d13990d82b.png', 'yes', '2021-03-14 02:33:45', '2021-03-22 21:05:22'),
(450, 75, 'cm', '50', NULL, '310', 'chart-604d13990dee9.png', 'yes', '2021-03-14 02:33:45', '2021-03-22 21:05:22'),
(451, 75, 'cm', '60', NULL, '310', 'chart-604d13990ecc3.png', 'yes', '2021-03-14 02:33:45', '2021-03-22 21:05:22'),
(452, 75, 'cm', '80', NULL, '310', 'chart-604d13990f086.png', 'yes', '2021-03-14 02:33:45', '2021-03-22 21:05:22'),
(453, 75, 'cm', '100', NULL, '310', 'chart-604d13990f490.png', 'yes', '2021-03-14 02:33:45', '2021-03-22 21:05:22'),
(454, 75, 'cm', '120', NULL, '310', 'chart-604d13990f8c1.png', 'yes', '2021-03-14 02:33:45', '2021-03-22 21:05:22'),
(455, 75, 'cm', '150', NULL, '310', 'chart-604d13990fed2.png', 'yes', '2021-03-14 02:33:45', '2021-03-22 21:05:22'),
(456, 75, 'cm', '200', NULL, '310', 'chart-604d13991031d.png', 'yes', '2021-03-14 02:33:45', '2021-03-22 21:05:22'),
(457, 76, 'cm', '2', NULL, '310', 'chart-604d2127327eb.png', 'yes', '2021-03-14 03:31:35', '2021-03-14 03:31:35'),
(458, 78, 'cm', '30', NULL, '325', 'chart-605af34293552.png', 'yes', '2021-03-24 15:06:51', '2021-03-24 20:35:07'),
(459, 78, 'cm', '40', NULL, '325', 'chart-605af5add80a1.png', 'yes', '2021-03-24 15:17:49', '2021-03-24 20:35:07'),
(460, 78, 'cm', '50', NULL, '325', 'chart-605af5add872e.png', 'yes', '2021-03-24 15:17:49', '2021-03-24 20:35:07'),
(461, 78, 'cm', '60', NULL, '325', 'chart-605af5add8b7c.png', 'yes', '2021-03-24 15:17:49', '2021-03-24 20:35:07'),
(462, 78, 'cm', '80', NULL, '325', 'chart-605af5add9393.png', 'yes', '2021-03-24 15:17:49', '2021-03-24 20:35:07'),
(463, 78, 'cm', '100', NULL, '325', 'chart-605b400bc673e.png', 'yes', '2021-03-24 20:35:07', '2021-03-24 20:35:07'),
(464, 78, 'cm', '120', NULL, '325', 'chart-605b400bc6ec4.png', 'yes', '2021-03-24 20:35:07', '2021-03-24 20:35:07'),
(465, 78, 'cm', '150', NULL, '325', 'chart-605b400bc7666.png', 'yes', '2021-03-24 20:35:07', '2021-03-24 20:35:07'),
(466, 78, 'cm', '200', NULL, '325', 'chart-605b400bc7b5e.png', 'yes', '2021-03-24 20:35:07', '2021-03-24 20:35:07'),
(467, 81, 'mesh', '1200', NULL, '10500', 'chart-605b43c29ad8c.png', 'yes', '2021-03-24 20:50:58', '2021-03-25 19:21:02'),
(468, 81, 'mesh', '1100', NULL, '10000', 'chart-605c7dcf7a876.png', 'yes', '2021-03-25 19:10:55', '2021-03-25 19:21:02'),
(469, 81, 'mesh', '1000', NULL, '9500', 'chart-605c7dcf7acab.png', 'yes', '2021-03-25 19:10:55', '2021-03-25 19:21:02'),
(470, 83, 'mesh', '1200', NULL, '10500', 'chart-605c7f90e467f.png', 'yes', '2021-03-25 19:18:24', '2021-03-25 19:21:32'),
(471, 85, 'ply', '45', NULL, '245', 'chart-605c9f0340ba2.png', 'yes', '2021-03-25 21:32:35', '2021-03-25 21:32:35'),
(472, 86, 'ply', '15', NULL, '245', 'chart-605ca0ca36e8c.png', 'yes', '2021-03-25 21:40:10', '2021-03-25 21:40:10'),
(473, 87, 'ply', '45', NULL, '245', 'chart-605ca11b2fee9.png', 'yes', '2021-03-25 21:41:31', '2021-03-25 21:58:57'),
(474, 88, 'mesh', '1200', NULL, '10500', 'chart-605ca9692f48e.png', 'yes', '2021-03-25 22:16:57', '2021-03-25 22:17:45');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `title`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Welcome to our Website', '<p><br></p>', 'slider-60096be7ce887.png', 'active', '2021-01-21 06:26:23', '2021-02-22 13:38:44');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','deactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `type_id`, `category_id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '45 PLY', NULL, 'active', '2021-02-02 04:03:09', '2021-02-21 14:59:57'),
(2, 2, 14, '24 PLY', NULL, 'active', '2021-02-02 04:04:14', '2021-02-21 16:42:27'),
(3, 2, 18, '30 PLY', NULL, 'active', '2021-02-02 04:09:28', '2021-02-21 16:40:28'),
(4, 2, 19, '36 PLY', NULL, 'active', '2021-02-02 04:10:11', '2021-02-21 16:39:37'),
(5, 2, 16, '60 PLY', NULL, 'active', '2021-02-02 04:10:38', '2021-02-21 16:38:56'),
(6, 2, 16, '45 PLY', NULL, 'active', '2021-02-02 04:10:57', '2021-02-21 16:38:32'),
(7, 2, 14, '18 PLY', NULL, 'active', '2021-02-02 04:13:23', '2021-02-21 16:35:14'),
(8, 2, 8, '90 PLY', NULL, 'active', '2021-02-02 04:13:39', '2021-02-21 16:36:09'),
(9, 1, 9, '15 PLY', 'subcategory-604cbba767958.png', 'active', '2021-02-02 04:14:50', '2021-03-13 20:18:31'),
(10, 1, 20, '18 PLY', NULL, 'active', '2021-02-02 04:15:05', '2021-03-13 20:19:34'),
(11, 1, 9, '45 PLY', NULL, 'active', '2021-02-02 04:15:19', '2021-02-21 10:04:47'),
(12, 1, 13, '24 PLY', 'subcategory-604d2009d8632.png', 'active', '2021-02-02 04:15:57', '2021-03-14 03:26:49'),
(13, 1, 21, '54 PLY', NULL, 'active', '2021-02-02 04:16:20', '2021-02-21 11:27:14'),
(14, 3, 15, 'GREY', NULL, 'active', '2021-02-02 04:16:44', '2021-02-21 11:27:41'),
(15, 1, 22, '45 PLY', 'subcategory-604d162d8a1d3.png', 'active', '2021-02-02 04:16:59', '2021-03-14 02:44:45'),
(16, 3, 17, 'TWINE RUNNER', NULL, 'active', '2021-02-02 04:17:22', '2021-02-02 04:17:22'),
(17, 3, 18, 'TWINE STAR', NULL, 'active', '2021-02-02 04:18:26', '2021-02-02 04:18:26'),
(18, 1, 10, '18 PLY', 'subcategory-604d0df62cab2.png', 'active', '2021-02-02 04:18:44', '2021-03-14 02:09:42'),
(19, 2, 8, '54 PLY', NULL, 'active', '2021-02-21 16:34:14', '2021-02-21 16:34:14'),
(20, 2, 17, '24 PLY', 'subcategory-60323b5082de9.png', 'active', '2021-02-21 17:52:00', '2021-02-21 18:15:24'),
(21, 7, 2, '18 PLY', NULL, 'active', '2021-02-21 18:05:18', '2021-02-21 18:05:18'),
(22, 7, 1, '15 PLY', NULL, 'active', '2021-02-21 18:06:00', '2021-02-21 18:06:00'),
(23, 7, 3, '54 PLY', NULL, 'active', '2021-02-21 18:06:20', '2021-02-21 18:06:20'),
(24, 7, 4, '9 PLY', NULL, 'active', '2021-02-21 18:08:17', '2021-02-21 18:08:17'),
(25, 3, 7, 'YELLOW', NULL, 'active', '2021-02-21 18:14:57', '2021-02-21 18:15:42'),
(27, 1, 9, '30 PLY', NULL, 'active', '2021-03-24 14:36:12', '2021-03-24 14:36:12'),
(28, 1, 9, '21 PLY', NULL, 'active', '2021-03-24 14:51:01', '2021-03-24 14:51:01'),
(29, 2, 18, '45 PLY', NULL, 'active', '2021-03-25 21:31:14', '2021-03-25 21:31:14'),
(30, 2, 6, '15 PLY', NULL, 'active', '2021-03-25 21:36:31', '2021-03-25 21:36:31'),
(31, 2, 16, '45 PLY', NULL, 'active', '2021-03-25 21:36:54', '2021-03-25 21:36:54'),
(32, 2, 16, '60 PLY', NULL, 'active', '2021-03-25 21:37:10', '2021-03-25 21:37:10');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'NETS', 'type-600975a7c2b06.png', '2020-12-07 23:18:36', '2021-02-20 18:16:12'),
(2, 'TWINES', 'type-6009759adf40e.png', '2020-12-10 01:38:23', '2021-02-20 18:16:42'),
(3, 'ROPES', 'type-600975b83b930.png', '2020-12-10 22:54:36', '2021-02-20 18:15:46'),
(4, 'CODEN', 'type-603350e512c09.png', '2020-12-10 22:57:02', '2021-02-22 13:36:21'),
(7, 'TRAWL NET', 'type-6033af4f00232.png', '2021-02-20 18:13:31', '2021-02-22 20:19:11'),
(8, 'BATTERY', 'type-603114b14b712.png', '2021-02-20 18:17:14', '2021-02-20 20:54:57'),
(9, 'CHAIN', 'type-6031151632706.png', '2021-02-20 18:18:48', '2021-02-20 20:56:38'),
(10, 'ANCOR', 'type-60335ac9da509.png', '2021-02-22 14:04:03', '2021-02-22 15:55:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isVerified` enum('false','true') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'false',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `profile`, `password`, `contact`, `state`, `city`, `business`, `role`, `device_token`, `device_id`, `device_type`, `remember_token`, `isVerified`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@fishnet.com', NULL, 'admin-5fc231c0ee9db.jpg', '$2y$10$B0coPgOvcUzTpWC7IR3GO.oNbtUxKDhF5OZwpNYbXV5rH9tJkE1xe', '8956236584', NULL, NULL, NULL, 'admin', NULL, NULL, NULL, NULL, 'false', '2020-11-25 04:24:41', '2020-11-28 05:47:20'),
(22, 'jtn', 'jatinraiyani061@gmail.com', NULL, 'user-6023c49cab0d9.png', '$2y$10$HBJiyBUe4CwCPStUmQ0AAeCkGrjhLHrtxxIruB0AbNiHS5pNnBn6m', '8469536345', 'gujarat', 'porbandar', NULL, 'user', NULL, NULL, NULL, NULL, 'true', '2021-02-07 23:40:24', '2021-03-31 12:45:00'),
(30, 'vrunda', 'vrunda1209@gmail.com', NULL, 'user-607300ae0f12e.jpg', '$2y$10$e1hThklFkKo7qWkTJK71kepCxYUiWJI8kZdGdELF9PpCwHgPAfkwy', '9824102030', 'Gujarat', 'Surat', NULL, 'user', 'k', 'fghj', 'ghj', NULL, 'false', '2021-02-19 22:44:14', '2021-04-11 15:41:39'),
(32, 'CHINTAN HODAR', 'skach22@gmail.com', NULL, NULL, '$2y$10$gKKWFqeiyEvkaSr3QlRlae6vt6xCpjl2bnKAGL4wDAZdrHwfkEwly', '8401934536', 'gujarat', 'porbandar', NULL, 'user', NULL, NULL, NULL, NULL, 'true', '2021-02-21 17:58:42', '2021-04-03 15:52:51'),
(44, 'yash panchal', 'yash@yopmail.com', NULL, 'user-60731656a4947.jpg', '$2y$10$hpbH2HB4gdOqTUPHlga1XOqMUD3azA.AxXE82octYVeNUJ9wO1Q6S', '9737888672', 'null', 'null', NULL, 'user', 'token', 'idss', 'type', NULL, 'true', '2021-04-11 06:00:46', '2021-04-11 15:31:34'),
(45, 'yax', 'yax@yopmail.com', NULL, NULL, '$2y$10$8wIGmHCDrGpvAv4lM7y/5.bLnyxueAwcFnDOjhSCShD.dSguDtFH.', '9824339660', 'gujarat', 'surat', NULL, 'user', 'token', 'idss', 'type', NULL, 'false', '2021-04-11 07:01:28', '2021-04-11 07:01:28'),
(46, 'test', 'test@gmail.com', NULL, 'user-6072b70c9da8c.jpg', '$2y$10$a06yeiybLrMKnLaqnI3E4O7gsfX2vZOwJgj2IhMauPK/TCmsswbAa', '9865325698', 'Gujarat', 'Bhavnagar', NULL, 'user', 'device_token', 'device_id', 'device_type', NULL, 'false', '2021-04-11 07:27:05', '2021-04-11 08:45:00'),
(47, 'test', 'test13@gmail.com', NULL, NULL, '$2y$10$bkqoDJYcSvtqQuV/rP6iXehUbc3WQC2RpWe0H9XDJ1/noHWfRAG8W', '9824702770', 'Gujarat', 'Bhavnagar', NULL, 'user', 'device_token', 'device_id', 'device_type', NULL, 'false', '2021-04-11 12:11:52', '2021-04-11 12:11:52'),
(48, 'test', 'test14@gmail.com', NULL, NULL, '$2y$10$2Zj8ND.7AH7POb/YKfwVKezwf0NRHVkc..zXwnrt6xC07VGgYoaEG', '9925789508', 'Gujarat', 'Porbandar', NULL, 'user', 'device_token', 'device_id', 'device_type', NULL, 'false', '2021-04-11 12:18:41', '2021-04-11 12:43:15'),
(49, 'Yash Panchal', 'Yash99@yopmail.com', NULL, NULL, '$2y$10$GOxRVQHeIH05iwbYv3DVPuovaXganKO2FSqw/x0dkLahrnc1W5tzi', '7990351492', 'Gujarat', 'Surat', NULL, 'user', 'device_token', 'device_id', 'device_type', NULL, 'true', '2021-04-15 15:20:00', '2021-04-15 15:20:28'),
(50, 'helo', 'hello@gmail.com', NULL, NULL, '$2y$10$dxpnUwPJ1jDHGnEksaaUQu4.GG/C3O3sWMfQ7MyeflIbs7vty28lu', '9848459459', 'Gujarat', 'Surat', NULL, 'user', 'device_token', 'device_id', 'device_type', NULL, 'false', '2021-05-02 13:09:57', '2021-05-02 13:09:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` bigint(20) NOT NULL,
  `set_as` enum('primary','secondary') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`id`, `user_id`, `name`, `email`, `contact`, `address`, `state`, `city`, `zipcode`, `set_as`, `created_at`, `updated_at`) VALUES
(3, 32, 'CHINTAN HODAR', 'skach22@gmail.com', '8401934536', 'JURIBAG KAILASH GEREG', 'gujarat', 'porbandar', 360575, 'primary', '2021-04-03 15:56:02', '2021-04-03 15:56:02'),
(4, 22, 'jtn', 'jatinraiyani061@gmail.com', '8469536345', 'surat', 'gujarat', 'porbandar', 395006, 'primary', '2021-04-17 13:07:47', '2021-04-22 17:10:16'),
(5, 30, 'vrunda', 'vrunda1209@gmail.com', '9824102030', 'surat', 'Gujrat', 'Surat', 395007, 'secondary', '2021-04-19 16:36:13', '2021-05-13 17:43:34'),
(6, 30, 'vrunda', 'vrunda1209@gmail.com', '9824102030', 'vrunda1209@gmail.com', 'Gujarat', 'Surat', 395007, 'secondary', '2021-04-19 16:54:08', '2021-05-13 17:43:34'),
(7, 30, 'vrunda', 'vrunda1209@gmail.com', '9824102030', 'vrunda1209@gmail.com', 'Gujarat', 'Surat', 395009, 'secondary', '2021-04-19 16:58:15', '2021-05-13 17:43:34'),
(8, 30, 'vrunda', 'vrunda1209@gmail.com', '9824102030', 'surat', 'Gujarat', 'Surat', 395007, 'secondary', '2021-04-19 17:01:09', '2021-05-13 17:43:34'),
(9, 22, 'jtn', 'jatinraiyani061@gmail.com', '8469536345', 'surat', 'gujarat', 'porbandar', 395008, 'primary', '2021-04-19 17:29:55', '2021-04-19 17:29:55'),
(10, 30, 'vrunda', 'vrunda1209@gmail.com', '9824102030', 'surat', 'Gujarat', 'Surat', 395006, 'primary', '2021-04-20 03:37:06', '2021-05-15 16:34:30'),
(11, 44, 'yash panchal', 'yash@yopmail.com', '9737888672', 'test', 'Gujarat', 'Surat', 949197, 'secondary', '2021-04-20 04:18:12', '2021-05-12 18:47:54'),
(12, 30, 'vrunda', 'vrunda1209@gmail.com', '9824102030', 'vdtf', 'Gujarat', 'Surat', 852695, 'secondary', '2021-04-25 13:54:02', '2021-05-13 17:43:34'),
(13, 44, 'yash panchal', 'yash@yopmail.com', '9737888672', 'jajs', 'गुजरात', 'सूरत', 949197, 'secondary', '2021-05-02 14:35:48', '2021-05-12 18:47:54'),
(14, 44, 'yash panchal', 'yash@yopmail.com', '9737888672', 'xyz', 'Gujarat', 'Surat', 979497, 'secondary', '2021-05-12 18:46:50', '2021-05-12 18:47:54'),
(15, 44, 'yash panchal', 'yash@yopmail.com', '9737888672', 'abc', 'Gujarat', 'Bhavnagar', 949797, 'primary', '2021-05-12 18:47:54', '2021-05-12 18:47:54'),
(16, 30, 'vrunda', 'vrunda1209@gmail.com', '9824102030', 'surat', 'Gujarat', 'Surat', 394326, 'primary', '2021-05-13 17:43:34', '2021-05-13 17:43:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adbanner`
--
ALTER TABLE `adbanner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_sessions`
--
ALTER TABLE `api_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `api_sessions_user_id_foreign` (`user_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_user_id_foreign` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `forgot_link`
--
ALTER TABLE `forgot_link`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forgot_link_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_product_order_id_foreign` (`order_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_status_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_order_id_foreign` (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_brand`
--
ALTER TABLE `product_brand`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_brand_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_color`
--
ALTER TABLE `product_color`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_color_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_image_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_size_product_id_foreign` (`product_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_address_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adbanner`
--
ALTER TABLE `adbanner`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `api_sessions`
--
ALTER TABLE `api_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forgot_link`
--
ALTER TABLE `forgot_link`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `product_brand`
--
ALTER TABLE `product_brand`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `product_color`
--
ALTER TABLE `product_color`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `product_size`
--
ALTER TABLE `product_size`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=475;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `api_sessions`
--
ALTER TABLE `api_sessions`
  ADD CONSTRAINT `api_sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `forgot_link`
--
ALTER TABLE `forgot_link`
  ADD CONSTRAINT `forgot_link_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_status`
--
ALTER TABLE `order_status`
  ADD CONSTRAINT `order_status_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_brand`
--
ALTER TABLE `product_brand`
  ADD CONSTRAINT `product_brand_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_color`
--
ALTER TABLE `product_color`
  ADD CONSTRAINT `product_color_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `product_image_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_size`
--
ALTER TABLE `product_size`
  ADD CONSTRAINT `product_size_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_address_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
