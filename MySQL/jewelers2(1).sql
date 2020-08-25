-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2020 at 10:34 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jewelers2`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` int(10) UNSIGNED NOT NULL,
  `bangla_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `english_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `founder` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `establish_year` date DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `bangla_name`, `english_name`, `founder`, `establish_year`, `phone`, `email`, `web`, `about`, `address`, `favicon`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Jewelers Management System', 'Jewelers Management System', 'Md Abc', '2019-07-17', '01792102040', 'supershop@gmail.com', 'http://supershop.com', 'Technosoft is renouned IT/Software company in bangladesh', 'MTB Vabon, Sheikh Hasina Software Technology Park Jessore', 'favicon-2020-03-10-5e67bd4a39b2d.png', 'logo-2020-03-10-5e67bd4a41faa.png', NULL, '2020-03-10 10:18:54');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_holder_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `bank_name`, `account_holder_name`, `account_no`, `branch_name`, `bank_location`, `created_at`, `updated_at`) VALUES
(1, 'IBBL', NULL, '3221', 'Jashore Branch', 'Jashore', '2020-08-19 15:33:01', '2020-08-19 15:33:01'),
(2, 'DBBL', NULL, '454665', 'Jashore Branch', 'Monihar', '2020-08-19 15:33:24', '2020-08-19 15:33:24');

-- --------------------------------------------------------

--
-- Table structure for table `bank_transactions`
--

CREATE TABLE `bank_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `account_no` bigint(20) DEFAULT NULL,
  `cheque_no` bigint(20) DEFAULT NULL,
  `transaction_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_amount` decimal(10,2) NOT NULL,
  `transaction_date` date NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'default.png',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_transactions`
--

INSERT INTO `bank_transactions` (`id`, `bank_id`, `user_id`, `account_no`, `cheque_no`, `transaction_status`, `transaction_amount`, `transaction_date`, `note`, `image`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 454665, 102, 'Deposit', '100.00', '2020-08-19', NULL, 'default.png', NULL, NULL, '2020-08-19 15:35:12', '2020-08-19 15:35:12');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `created_at`, `updated_at`) VALUES
(1, 'Tiffany & Co.', '2020-03-10 10:20:15', '2020-03-10 10:20:15'),
(2, 'Harry Winston', '2020-03-10 10:20:25', '2020-03-10 10:20:25');

-- --------------------------------------------------------

--
-- Table structure for table `carets`
--

CREATE TABLE `carets` (
  `id` int(10) UNSIGNED NOT NULL,
  `caret_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carets`
--

INSERT INTO `carets` (`id`, `caret_name`, `created_at`, `updated_at`) VALUES
(1, '22', '2020-03-10 10:29:59', '2020-03-10 10:29:59'),
(2, '21', '2020-03-10 10:30:01', '2020-03-10 10:30:01'),
(3, '20', '2020-03-10 10:30:04', '2020-03-10 10:30:04');

-- --------------------------------------------------------

--
-- Table structure for table `cash_closings`
--

CREATE TABLE `cash_closings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `closing_date` date NOT NULL,
  `lastday_balance` decimal(10,2) NOT NULL,
  `receipt` decimal(10,2) NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cash_closings`
--

INSERT INTO `cash_closings` (`id`, `closing_date`, `lastday_balance`, `receipt`, `payment`, `balance`, `created_at`, `updated_at`) VALUES
(1, '2019-08-22', '0.00', '2874.00', '500.00', '2374.00', '2019-08-26 01:01:37', '2019-08-26 01:01:37'),
(2, '2019-08-25', '2374.00', '11768.00', '5468.00', '8674.00', '2019-08-26 01:15:59', '2019-08-26 01:15:59'),
(3, '2019-08-23', '8674.00', '0.00', '0.00', '8674.00', '2019-08-29 03:48:34', '2019-08-29 03:48:34'),
(4, '2019-08-29', '8674.00', '105000.00', '219.00', '113455.00', '2019-08-29 05:30:44', '2019-08-29 05:30:44'),
(5, '2019-09-14', '113455.00', '16000.00', '16800.00', '112655.00', '2019-09-14 21:11:15', '2019-09-14 21:11:15'),
(6, '2019-09-15', '112655.00', '0.00', '0.00', '112655.00', '2019-10-09 21:51:38', '2019-10-09 21:51:38'),
(7, '2019-10-07', '112655.00', '72000.00', '0.00', '184655.00', '2019-10-09 22:12:46', '2019-10-09 22:12:46'),
(8, '2019-10-10', '184655.00', '0.00', '0.00', '184655.00', '2019-10-09 22:15:06', '2019-10-09 22:15:06'),
(9, '2019-10-12', '184655.00', '7710.00', '22810.00', '169555.00', '2019-10-12 02:24:50', '2019-10-12 02:24:50'),
(10, '2019-11-20', '169555.00', '0.00', '0.00', '169555.00', '2019-11-24 22:52:37', '2019-11-24 22:52:37'),
(11, '2019-11-24', '169555.00', '100392.00', '3235.00', '266712.00', '2019-11-24 22:55:30', '2019-11-24 22:55:30');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Diamond', '2020-03-10 10:19:20', '2020-03-10 10:19:20'),
(2, 'Gold', '2020-03-10 10:19:24', '2020-03-10 10:19:24'),
(3, 'Silver', '2020-03-10 10:19:33', '2020-03-10 10:19:33');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `distric_id` int(10) UNSIGNED DEFAULT NULL,
  `upozila_id` int(10) UNSIGNED DEFAULT NULL,
  `union_id` int(10) UNSIGNED DEFAULT NULL,
  `village_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `distric_id`, `upozila_id`, `union_id`, `village_id`, `customer_name`, `customer_phone`, `customer_email`, `customer_address`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 23, NULL, 'Md Asadul Islam', '019335285966', NULL, '9/4 Bezpara', '2020-03-10 10:37:45', '2020-03-10 10:37:45'),
(2, 3, 7, 61, NULL, 'Rimi Islam', '+6181818606317', NULL, '9/4 Bezpara', '2020-03-10 10:38:25', '2020-03-10 10:38:25'),
(3, 3, 1, 23, NULL, 'Md Asaduzzaman', '019335285966', NULL, '9/4 Bezpara', '2020-03-10 10:38:48', '2020-03-10 10:38:48'),
(7, NULL, NULL, NULL, NULL, 'Meghla', '01935025870', NULL, 'Nazirshankor pur', '2020-08-19 22:47:38', '2020-08-19 22:47:38'),
(8, NULL, NULL, NULL, NULL, 'Md Saidul Islam', '0198745235', NULL, NULL, '2020-08-20 03:29:24', '2020-08-20 03:29:24'),
(9, NULL, NULL, NULL, NULL, 'Mst Nasima Khatun', '0175646564', NULL, 'Satkhira', '2020-08-24 09:51:36', '2020-08-24 09:51:36'),
(10, NULL, NULL, NULL, NULL, 'Kamal', '01744852314', NULL, 'safdasf af df', '2020-08-24 12:27:42', '2020-08-24 12:27:42'),
(11, NULL, NULL, NULL, NULL, 'MD Moinul Islam', '0174425632', NULL, NULL, '2020-08-25 10:27:03', '2020-08-25 10:27:03'),
(12, NULL, NULL, NULL, NULL, 'Md Arif Hossain', '017446546565', NULL, NULL, '2020-08-25 13:34:08', '2020-08-25 13:34:08');

-- --------------------------------------------------------

--
-- Table structure for table `customer_accounts`
--

CREATE TABLE `customer_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ca_date` date NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_accounts`
--

INSERT INTO `customer_accounts` (`id`, `ca_date`, `customer_id`, `sale_id`, `order_id`, `amount`, `note`, `created_at`, `updated_at`) VALUES
(4, '2020-08-20', 3, 3, NULL, 55, NULL, '2020-08-20 03:14:03', '2020-08-20 03:14:03'),
(5, '2020-08-20', 7, 4, NULL, 15000, NULL, '2020-08-20 03:14:57', '2020-08-20 03:14:57'),
(6, '2020-08-20', 8, 5, NULL, 8600, NULL, '2020-08-20 03:29:24', '2020-08-20 03:29:24'),
(9, '2020-08-24', 1, NULL, 4, 250000, NULL, '2020-08-24 10:59:51', '2020-08-24 10:59:51'),
(10, '2020-08-24', 1, NULL, 5, 385200, NULL, '2020-08-24 11:00:55', '2020-08-24 11:00:55'),
(11, '2020-08-24', 9, NULL, 6, 25000, NULL, '2020-08-24 11:58:57', '2020-08-24 11:58:57'),
(12, '2020-08-24', 10, NULL, 7, 150000, NULL, '2020-08-24 12:27:42', '2020-08-24 12:27:42'),
(13, '2020-08-25', 11, NULL, 8, 20000, NULL, '2020-08-25 10:27:03', '2020-08-25 10:27:03'),
(14, '2020-08-25', 12, 6, NULL, 7775, NULL, '2020-08-25 13:34:08', '2020-08-25 13:34:08');

-- --------------------------------------------------------

--
-- Table structure for table `districs`
--

CREATE TABLE `districs` (
  `id` int(10) UNSIGNED NOT NULL,
  `distric_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districs`
--

INSERT INTO `districs` (`id`, `distric_name`, `created_at`, `updated_at`) VALUES
(2, 'Meherpur', '2019-05-22 11:37:57', '2019-05-22 11:57:22'),
(3, 'Jashore', '2019-05-22 11:50:24', '2019-05-31 13:39:22'),
(4, 'Magura', '2019-05-22 11:51:29', '2019-05-22 11:56:30'),
(5, 'Satkhira', '2019-05-22 11:51:41', '2019-05-22 11:51:41'),
(6, 'Jhenaida', '2019-05-22 11:51:50', '2019-05-22 12:54:15'),
(7, 'Kustia', '2019-05-22 11:51:57', '2019-05-22 11:51:57'),
(8, 'Khulna', '2019-05-22 11:52:05', '2019-05-22 11:57:37'),
(9, 'Foridpur', '2019-05-22 11:52:19', '2019-05-22 11:58:01'),
(10, 'Bagerhat', '2019-05-22 12:53:23', '2019-05-22 12:53:23'),
(11, 'Chuadanga', '2019-05-22 12:53:54', '2019-05-22 12:53:54'),
(12, 'Narail', '2019-05-22 12:54:46', '2019-05-22 12:54:46');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expensetype_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `expense_date` date NOT NULL,
  `expense_amount` decimal(10,2) NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expensetypes`
--

CREATE TABLE `expensetypes` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` int(10) UNSIGNED NOT NULL,
  `incometype_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `income_date` date NOT NULL,
  `income_amount` decimal(10,2) NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incometypes`
--

CREATE TABLE `incometypes` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `income_expenses`
--

CREATE TABLE `income_expenses` (
  `user_id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `income_amount` decimal(8,2) DEFAULT NULL,
  `expense_amount` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loaners`
--

CREATE TABLE `loaners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loaner_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loaner_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loaner_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loaner_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_date` date NOT NULL,
  `debit` double(8,2) NOT NULL,
  `credit` double(8,2) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Due',
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(21, '2019_01_01_053014_create_abouts_table', 1),
(28, '2019_06_27_112256_create_permission_tables', 2),
(61, '2019_08_25_103036_create_cash_closings_table', 12),
(75, '2018_06_01_182324_create_categories_table', 13),
(76, '2018_06_02_041613_create_warehouses_table', 13),
(77, '2018_06_02_153613_create_districs_table', 13),
(78, '2018_06_02_154303_create_upozilas_table', 13),
(79, '2018_06_02_154332_create_unions_table', 13),
(80, '2018_07_02_112236_create_villages_table', 13),
(81, '2018_07_15_110802_create_brands_table', 13),
(82, '2018_07_15_111024_create_types_table', 13),
(83, '2018_07_15_111218_create_units_table', 13),
(84, '2018_07_15_111951_create_carets_table', 13),
(85, '2018_07_15_112221_create_suppliers_table', 13),
(86, '2018_07_15_112236_create_products_table', 13),
(89, '2018_07_18_111019_create_customers_table', 14),
(92, '2018_07_19_075520_create_sales_table', 14),
(93, '2018_07_19_075521_create_sale_details_table', 14),
(95, '2018_09_05_054317_create_supplier_accounts_table', 14),
(96, '2018_11_28_124539_create_expensetypes_table', 14),
(97, '2018_11_28_125502_create_expenses_table', 14),
(98, '2019_03_10_121157_create_incometypes_table', 14),
(99, '2019_03_10_121848_create_incomes_table', 14),
(100, '2019_06_19_074358_create_purchase_returns_table', 14),
(101, '2019_06_19_074450_create_purchase_return_details_table', 14),
(102, '2019_06_19_074512_create_sale_returns_table', 15),
(103, '2019_06_19_074529_create_sale_return_details_table', 15),
(104, '2019_08_04_094105_create_banks_table', 15),
(105, '2019_08_04_100455_create_bank_transactions_table', 15),
(106, '2019_08_06_105606_create_loaners_table', 15),
(107, '2019_08_06_105619_create_loans_table', 15),
(108, '2019_08_20_083924_create_wastage_returns_table', 15),
(109, '2019_10_09_092158_create_income_expenses_table', 15),
(110, '2018_07_18_141711_create_orders_table', 16),
(111, '2018_07_18_142027_create_order_details_table', 17),
(112, '2018_07_16_112527_create_purchases_table', 18),
(113, '2018_07_16_184440_create_purchase_details_table', 18),
(114, '2018_09_04_064817_create_customer_accounts_table', 19),
(115, '2020_08_20_181959_create_settings_table', 20),
(116, '2020_08_21_013616_create_raw_purchases_table', 21),
(117, '2020_08_21_013629_create_raw_purchase_details_table', 21),
(118, '2020_08_21_094441_create_workers_table', 21),
(121, '2020_08_21_096542_create_worker_accounts_table', 22),
(122, '2020_08_21_095442_create_worker_orders_table', 23),
(124, '2020_08_21_095514_create_worker_order_details_table', 24);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(1, 'App\\User', 7),
(1, 'App\\User', 8),
(2, 'App\\User', 3),
(2, 'App\\User', 4),
(3, 'App\\User', 5),
(4, 'App\\User', 6);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `gross_price` decimal(10,2) NOT NULL,
  `per_rote_price` decimal(10,2) NOT NULL,
  `total_weight` decimal(10,2) DEFAULT NULL,
  `total_wage` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `grand_total` decimal(10,2) DEFAULT NULL,
  `payment` decimal(10,2) NOT NULL,
  `due_amount` decimal(10,2) NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_no`, `customer_id`, `user_id`, `gross_price`, `per_rote_price`, `total_weight`, `total_wage`, `total_price`, `discount`, `grand_total`, `payment`, `due_amount`, `note`, `order_date`, `delivery_date`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '2008201', 2, 3, '4500.00', '450.00', NULL, NULL, '450.00', '0.00', '450.00', '0.00', '450.00', NULL, '2020-08-20', '1970-01-01', 'Pending', 3, NULL, '2020-08-20 01:39:15', '2020-08-20 01:39:15'),
(4, '2408204', 1, 3, '63200.00', '6320.00', NULL, NULL, '252680.00', '0.00', '252680.00', '250000.00', '2680.00', NULL, '2020-08-24', '1970-01-01', 'Pending', 3, NULL, '2020-08-24 10:59:51', '2020-08-24 10:59:51'),
(5, '2408205', 1, 3, '63200.00', '6320.00', NULL, NULL, '385200.00', '0.00', '385200.00', '385200.00', '0.00', NULL, '2020-08-24', '1970-01-01', 'Pending', 3, NULL, '2020-08-24 11:00:55', '2020-08-24 11:00:55'),
(6, '2408206', 9, 3, '63200.00', '6320.00', NULL, NULL, '39002.64', '0.00', '39002.64', '25000.00', '14002.00', NULL, '2020-08-24', '1970-01-01', 'Pending', 3, NULL, '2020-08-24 11:58:57', '2020-08-24 11:58:57'),
(7, '2408207', 10, 3, '63200.00', '6320.00', NULL, NULL, '176040.00', '0.00', '176040.00', '150000.00', '26040.00', NULL, '2020-08-24', '1970-01-01', 'Pending', 3, NULL, '2020-08-24 12:27:42', '2020-08-24 12:27:42'),
(8, '2508208', 11, 3, '63200.00', '6320.00', NULL, NULL, '143440.00', '0.00', '143440.00', '20000.00', '123440.00', NULL, '2020-08-25', '1970-01-01', 'Pending', 3, NULL, '2020-08-25 10:27:03', '2020-08-25 10:27:03');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  `caret_id` int(10) UNSIGNED NOT NULL,
  `order_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` decimal(10,2) UNSIGNED DEFAULT NULL,
  `wage` decimal(10,2) UNSIGNED DEFAULT NULL,
  `sub_total` decimal(10,2) UNSIGNED DEFAULT NULL,
  `lost_weight` decimal(10,2) UNSIGNED DEFAULT NULL,
  `delivery_weight` decimal(10,2) UNSIGNED DEFAULT NULL,
  `order_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `stock_in_date` date DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `made_by` int(10) UNSIGNED DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `user_id`, `product_id`, `category_id`, `type_id`, `caret_id`, `order_no`, `weight`, `wage`, `sub_total`, `lost_weight`, `delivery_weight`, `order_date`, `delivery_date`, `stock_in_date`, `status`, `made_by`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 2, 2, 2, 3, '2008201', '1.00', '0.00', '450.00', NULL, NULL, '2020-08-20', '0000-00-00', NULL, 'Pending', NULL, 3, NULL, '2020-08-20 01:39:15', '2020-08-20 01:39:15'),
(4, 4, 3, 1, 2, 1, 3, '2408204', '12.00', '1200.00', '77040.00', NULL, NULL, '2020-08-24', '0000-00-00', NULL, 'Pending', NULL, 3, NULL, '2020-08-24 10:59:51', '2020-08-24 10:59:51'),
(5, 4, 3, 2, 2, 2, 3, '2408204', '13.00', '2000.00', '84160.00', NULL, NULL, '2020-08-24', '0000-00-00', NULL, 'Pending', NULL, 3, NULL, '2020-08-24 10:59:51', '2020-08-24 10:59:51'),
(6, 4, 3, 4, 2, 2, 3, '2408204', '14.00', '3000.00', '91480.00', NULL, NULL, '2020-08-24', '0000-00-00', NULL, 'Pending', NULL, 3, NULL, '2020-08-24 10:59:51', '2020-08-24 10:59:51'),
(7, 5, 3, 2, 2, 2, 3, '2408205', '15.00', '1500.00', '96300.00', NULL, NULL, '2020-08-24', '0000-00-00', NULL, 'Pending', NULL, 3, NULL, '2020-08-24 11:00:55', '2020-08-24 11:00:55'),
(8, 5, 3, 4, 2, 2, 3, '2408205', '20.00', '2000.00', '128400.00', NULL, NULL, '2020-08-24', '0000-00-00', NULL, 'Pending', NULL, 3, NULL, '2020-08-24 11:00:55', '2020-08-24 11:00:55'),
(9, 5, 3, 1, 2, 1, 3, '2408205', '25.00', '2500.00', '160500.00', NULL, NULL, '2020-08-24', '0000-00-00', NULL, 'Pending', NULL, 3, NULL, '2020-08-24 11:00:55', '2020-08-24 11:00:55'),
(10, 6, 3, 2, 2, 2, 3, '2408206', '2.37', '200.00', '15191.00', NULL, NULL, '2020-08-24', '0000-00-00', NULL, 'Pending', NULL, 3, NULL, '2020-08-24 11:58:57', '2020-08-24 11:58:57'),
(11, 6, 3, 4, 2, 2, 3, '2408206', '3.61', '200.00', '23015.00', NULL, NULL, '2020-08-24', '0000-00-00', NULL, 'Pending', NULL, 3, NULL, '2020-08-24 11:58:57', '2020-08-24 11:58:57'),
(12, 7, 3, 2, 2, 2, 2, '2408207', '14.00', '200.00', '88680.00', NULL, NULL, '2020-08-24', '0000-00-00', NULL, 'Pending', NULL, 3, NULL, '2020-08-24 12:27:42', '2020-08-24 12:27:42'),
(13, 7, 3, 4, 2, 2, 1, '2408207', '13.00', '200.00', '82360.00', NULL, NULL, '2020-08-24', '0000-00-00', NULL, 'Pending', NULL, 3, NULL, '2020-08-24 12:27:42', '2020-08-24 12:27:42'),
(14, 8, 3, 1, 2, 1, 1, '2508208', '22.00', '200.00', '139240.00', NULL, NULL, '2020-08-25', '0000-00-00', NULL, 'Pending', NULL, 3, NULL, '2020-08-25 10:27:03', '2020-08-25 10:27:03');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2019-06-27 05:27:51', '2019-06-27 05:27:51'),
(2, 'role-entry', 'web', '2019-06-27 05:27:51', '2019-06-27 05:27:51'),
(3, 'role-edit', 'web', '2019-06-27 05:27:51', '2019-06-27 05:27:51'),
(4, 'role-delete', 'web', '2019-06-27 05:27:51', '2019-06-27 05:27:51'),
(5, 'user-list', 'web', '2019-06-27 05:27:51', '2019-06-27 05:27:51'),
(6, 'user-entry', 'web', '2019-06-27 05:27:51', '2019-06-27 05:27:51'),
(7, 'user-edit', 'web', '2019-06-27 05:27:51', '2019-06-27 05:27:51'),
(8, 'user-delete', 'web', '2019-06-27 05:27:51', '2019-06-27 05:27:51'),
(11, 'role-group', 'web', '2019-06-28 23:51:31', '2019-06-29 05:22:19'),
(12, 'permission-list', 'web', '2019-06-29 05:23:09', '2019-06-29 05:23:09'),
(13, 'permission-entry', 'web', '2019-06-29 05:23:21', '2019-06-29 05:23:21'),
(14, 'permission-edit', 'web', '2019-06-29 05:23:28', '2019-06-29 05:23:28'),
(15, 'permission-delete', 'web', '2019-06-29 05:23:37', '2019-06-29 05:23:37'),
(16, 'setting-group', 'web', '2019-06-29 21:45:38', '2019-06-29 21:45:38'),
(17, 'about-information', 'web', '2019-06-29 21:45:54', '2019-06-29 21:45:54'),
(18, 'category-entry', 'web', '2019-06-29 21:46:03', '2019-06-29 21:46:03'),
(19, 'category-list', 'web', '2019-06-29 21:46:11', '2019-06-29 21:46:11'),
(20, 'category-edit', 'web', '2019-06-29 21:46:27', '2019-06-29 21:46:27'),
(21, 'category-delete', 'web', '2019-06-29 21:46:37', '2019-06-29 21:46:37'),
(22, 'brand-entry', 'web', '2019-06-29 21:46:57', '2019-06-29 21:46:57'),
(23, 'brand-list', 'web', '2019-06-29 21:47:11', '2019-06-29 21:47:11'),
(24, 'brand-edit', 'web', '2019-06-29 21:47:23', '2019-06-29 21:47:23'),
(25, 'brand-delete', 'web', '2019-06-29 21:47:33', '2019-06-29 21:47:33'),
(26, 'unit-list', 'web', '2019-06-29 21:47:55', '2019-06-29 21:47:55'),
(27, 'unit-entry', 'web', '2019-06-29 21:48:00', '2019-06-29 21:48:00'),
(28, 'unit-edit', 'web', '2019-06-29 21:48:08', '2019-06-29 21:48:08'),
(29, 'unit-delete', 'web', '2019-06-29 21:48:20', '2019-06-29 21:48:20'),
(30, 'address-group', 'web', '2019-06-29 21:48:50', '2019-06-29 21:48:50'),
(31, 'district-list', 'web', '2019-06-29 21:50:02', '2019-06-29 21:50:02'),
(32, 'district-entry', 'web', '2019-06-29 21:50:18', '2019-06-29 21:50:18'),
(33, 'district-edit', 'web', '2019-06-29 21:50:29', '2019-06-29 21:50:29'),
(34, 'district-delete', 'web', '2019-06-29 21:50:58', '2019-06-29 21:50:58'),
(35, 'upozila-list', 'web', '2019-06-29 21:51:26', '2019-06-29 21:51:26'),
(36, 'upozila-entry', 'web', '2019-06-29 21:51:36', '2019-06-29 21:51:36'),
(37, 'upozila-edit', 'web', '2019-06-29 21:51:48', '2019-06-29 21:51:48'),
(38, 'upozila-delete', 'web', '2019-06-29 21:52:02', '2019-06-29 21:52:02'),
(39, 'union-list', 'web', '2019-06-29 21:52:43', '2019-06-29 21:52:43'),
(40, 'union-entry', 'web', '2019-06-29 21:52:53', '2019-06-29 21:52:53'),
(41, 'union-edit', 'web', '2019-06-29 21:53:05', '2019-06-29 21:53:05'),
(42, 'union-delete', 'web', '2019-06-29 21:53:17', '2019-06-29 21:53:17'),
(43, 'supplier-group', 'web', '2019-06-29 21:54:03', '2019-06-29 21:54:03'),
(44, 'supplier-list', 'web', '2019-06-29 21:54:12', '2019-06-29 21:54:12'),
(45, 'supplier-entry', 'web', '2019-06-29 21:54:19', '2019-06-29 21:54:19'),
(46, 'supplier-edit', 'web', '2019-06-29 21:54:28', '2019-06-29 21:54:28'),
(47, 'supplier-delete', 'web', '2019-06-29 21:54:45', '2019-06-29 21:54:45'),
(48, 'customer-group', 'web', '2019-06-29 21:55:06', '2019-06-29 21:55:06'),
(49, 'customer-list', 'web', '2019-06-29 21:55:17', '2019-06-29 21:55:17'),
(50, 'customer-entry', 'web', '2019-06-29 21:55:28', '2019-06-29 21:55:28'),
(51, 'customer-edit', 'web', '2019-06-29 21:55:38', '2019-06-29 21:55:38'),
(52, 'customer-delete', 'web', '2019-06-29 21:55:46', '2019-06-29 21:55:46'),
(53, 'product-group', 'web', '2019-06-29 21:56:20', '2019-06-29 21:56:20'),
(54, 'product-list', 'web', '2019-06-29 21:56:28', '2019-06-29 21:56:28'),
(55, 'product-entry', 'web', '2019-06-29 21:56:50', '2019-06-29 21:56:50'),
(56, 'product-edit', 'web', '2019-06-29 21:57:13', '2019-06-29 21:57:13'),
(57, 'product-delete', 'web', '2019-06-29 21:57:31', '2019-06-29 21:57:31'),
(58, 'purchase-group', 'web', '2019-06-29 21:57:55', '2019-06-29 21:57:55'),
(59, 'purchase-list', 'web', '2019-06-29 21:58:07', '2019-06-29 21:58:07'),
(60, 'purchase-entry', 'web', '2019-06-29 22:00:12', '2019-06-29 22:00:12'),
(61, 'purchase-edit', 'web', '2019-06-29 22:00:22', '2019-06-29 22:00:22'),
(62, 'purchase-delete', 'web', '2019-06-29 22:00:32', '2019-06-29 22:00:32'),
(63, 'sale-group', 'web', '2019-06-29 22:01:02', '2019-06-29 22:01:02'),
(64, 'sale-list', 'web', '2019-06-29 22:01:08', '2019-06-29 22:01:08'),
(65, 'sale-entry', 'web', '2019-06-29 22:01:19', '2019-06-29 22:01:19'),
(66, 'sale-edit', 'web', '2019-06-29 22:01:29', '2019-06-29 22:01:29'),
(67, 'sale-delete', 'web', '2019-06-29 22:01:38', '2019-06-29 22:01:38'),
(68, 'stock-list', 'web', '2019-06-29 22:02:53', '2019-06-29 22:02:53'),
(69, 'return-group', 'web', '2019-06-29 22:03:10', '2019-06-29 22:03:10'),
(70, 'purchase-return-list', 'web', '2019-06-29 22:03:28', '2019-08-18 23:43:12'),
(71, 'purchase-return-entry', 'web', '2019-06-29 22:03:42', '2019-08-18 23:42:52'),
(72, 'purchase-return-edit', 'web', '2019-06-29 22:04:15', '2019-08-18 23:42:42'),
(73, 'purchase-return-delete', 'web', '2019-06-29 22:04:27', '2019-08-18 23:42:18'),
(74, 'sale-return-list', 'web', '2019-06-29 22:04:45', '2019-08-18 23:41:27'),
(75, 'sale-return-entry', 'web', '2019-06-29 22:04:55', '2019-08-18 23:41:37'),
(76, 'sale-return-edit', 'web', '2019-06-29 22:05:11', '2019-08-18 23:41:46'),
(77, 'sale-return-delete', 'web', '2019-06-29 22:05:28', '2019-08-18 23:41:56'),
(78, 'wastage-return-list', 'web', '2019-06-29 22:05:41', '2019-06-29 22:05:41'),
(79, 'wastage-return-entry', 'web', '2019-06-29 22:05:56', '2019-06-29 22:05:56'),
(80, 'wastage-return-edit', 'web', '2019-06-29 22:06:15', '2019-06-29 22:06:15'),
(81, 'wastage-return-delete', 'web', '2019-06-29 22:06:27', '2019-06-29 22:06:27'),
(82, 'expense-group', 'web', '2019-06-29 22:06:48', '2019-06-29 22:06:48'),
(83, 'expense-type-list', 'web', '2019-06-29 22:07:01', '2019-06-29 22:07:01'),
(84, 'expense-type-entry', 'web', '2019-06-29 22:07:14', '2019-06-29 22:07:14'),
(85, 'expense-type-edit', 'web', '2019-06-29 22:07:46', '2019-06-29 22:07:46'),
(86, 'expense-type-delete', 'web', '2019-06-29 22:07:55', '2019-06-29 22:07:55'),
(87, 'expense-list', 'web', '2019-06-29 22:08:15', '2019-06-29 22:08:15'),
(88, 'expense-entry', 'web', '2019-06-29 22:08:25', '2019-06-29 22:08:25'),
(89, 'expense-edit', 'web', '2019-06-29 22:08:34', '2019-06-29 22:08:34'),
(90, 'expense-delete', 'web', '2019-06-29 22:12:19', '2019-06-29 22:12:19'),
(91, 'payment-group', 'web', '2019-06-29 22:12:50', '2019-06-29 22:12:50'),
(92, 'supplier-payment-list', 'web', '2019-06-29 22:13:14', '2019-06-29 22:13:14'),
(93, 'supplier-payment-entry', 'web', '2019-06-29 22:13:28', '2019-06-29 22:13:28'),
(94, 'supplier-payment-edit', 'web', '2019-06-29 22:13:41', '2019-06-29 22:13:41'),
(95, 'supplier-payment-delete', 'web', '2019-06-29 22:13:54', '2019-06-29 22:13:54'),
(96, 'customer-payment-list', 'web', '2019-06-29 22:14:07', '2019-06-29 22:14:07'),
(97, 'customer-payment-entry', 'web', '2019-06-29 22:14:17', '2019-06-29 22:14:17'),
(98, 'customer-payment-edit', 'web', '2019-06-29 22:14:29', '2019-06-29 22:14:29'),
(99, 'customer-payment-delete', 'web', '2019-06-29 22:14:50', '2019-06-29 22:14:50'),
(100, 'bank-group', 'web', '2019-06-29 22:16:29', '2019-06-29 22:16:29'),
(101, 'bank-name-list', 'web', '2019-06-29 22:17:01', '2019-06-29 22:17:01'),
(102, 'bank-name-entry', 'web', '2019-06-29 22:17:11', '2019-06-29 22:17:11'),
(103, 'bank-name-edit', 'web', '2019-06-29 22:17:21', '2019-06-29 22:17:21'),
(104, 'bank-name-delete', 'web', '2019-06-29 22:17:34', '2019-06-29 22:17:34'),
(105, 'bank-transaction-list', 'web', '2019-06-29 22:17:56', '2019-06-29 22:17:56'),
(106, 'bank-transaction-entry', 'web', '2019-06-29 22:18:08', '2019-06-29 22:18:08'),
(107, 'bank-transaction-edit', 'web', '2019-06-29 22:18:20', '2019-06-29 22:18:20'),
(108, 'bank-transaction-delete', 'web', '2019-06-29 22:18:40', '2019-06-29 22:18:40'),
(109, 'ledger-group', 'web', '2019-06-29 22:19:40', '2019-06-29 22:19:40'),
(110, 'purchase-ledger', 'web', '2019-06-29 22:20:01', '2019-06-29 22:20:01'),
(111, 'sale-ledger', 'web', '2019-06-29 22:20:12', '2019-06-29 22:20:12'),
(112, 'supplier-ledger', 'web', '2019-06-29 22:20:22', '2019-06-29 22:20:22'),
(113, 'customer-ledger', 'web', '2019-06-29 22:20:35', '2019-06-29 22:20:35'),
(114, 'bank-transaction-ledger', 'web', '2019-06-29 22:20:55', '2019-06-29 22:20:55'),
(115, 'trail-balance', 'web', '2019-06-29 22:21:42', '2019-06-29 22:21:42'),
(116, 'warehouse-list', 'web', '2019-07-14 03:06:32', '2019-07-14 03:06:32'),
(117, 'warehouse-entry', 'web', '2019-07-14 03:06:41', '2019-07-14 03:06:41'),
(118, 'warehouse-edit', 'web', '2019-07-14 03:06:49', '2019-07-14 03:06:49'),
(119, 'warehouse-delete', 'web', '2019-07-14 03:06:57', '2019-07-14 03:06:57'),
(120, 'order-group', 'web', '2019-07-14 04:59:52', '2019-07-14 04:59:52'),
(121, 'order-list', 'web', '2019-07-14 05:00:01', '2019-07-14 05:00:01'),
(122, 'order-entry', 'web', '2019-07-14 05:00:13', '2019-07-14 05:00:13'),
(123, 'order-edit', 'web', '2019-07-14 05:00:25', '2019-07-14 05:00:25'),
(124, 'order-delete', 'web', '2019-07-14 05:00:34', '2019-07-14 05:00:34'),
(125, 'stock-group', 'web', '2019-07-16 04:13:54', '2019-07-16 04:13:54'),
(126, 'stock-transfer', 'web', '2019-07-16 04:14:09', '2019-07-16 04:14:09'),
(127, 'warehouse-group', 'web', '2019-07-16 04:47:44', '2019-07-16 04:47:44'),
(128, 'loan-group', 'web', '2019-08-06 05:38:48', '2019-08-06 05:42:04'),
(129, 'loaner-list', 'web', '2019-08-06 05:39:20', '2019-08-06 06:10:47'),
(130, 'loaner-entry', 'web', '2019-08-06 05:40:30', '2019-08-06 05:40:30'),
(131, 'loaner-edit', 'web', '2019-08-06 05:40:41', '2019-08-06 05:40:41'),
(132, 'loaner-delete', 'web', '2019-08-06 05:40:52', '2019-08-06 05:40:52'),
(133, 'loan-list', 'web', '2019-08-06 05:41:11', '2019-08-06 05:41:11'),
(134, 'loan-entry', 'web', '2019-08-06 05:41:20', '2019-08-06 05:41:20'),
(135, 'loan-edit', 'web', '2019-08-06 05:41:30', '2019-08-06 05:41:30'),
(136, 'loan-delete', 'web', '2019-08-06 05:41:40', '2019-08-06 05:41:40'),
(137, 'bank-balance', 'web', '2019-08-18 01:07:53', '2019-08-18 01:07:53'),
(138, 'report-group', 'web', '2019-08-21 04:43:43', '2019-08-21 04:43:43'),
(139, 'purchase-report', 'web', '2019-08-21 04:44:22', '2019-08-21 04:44:22'),
(140, 'sale-report', 'web', '2019-08-21 04:44:29', '2019-08-21 04:44:29'),
(141, 'return-report', 'web', '2019-08-21 04:44:45', '2019-08-21 04:44:45'),
(142, 'expense-report', 'web', '2019-08-21 04:44:58', '2019-08-21 04:44:58'),
(143, 'cash-report', 'web', '2019-08-21 04:45:50', '2019-08-21 04:45:50'),
(144, 'pos-sale', 'web', '2019-08-24 00:33:11', '2019-08-24 00:33:11'),
(145, 'barcode-generate', 'web', '2019-08-24 00:33:40', '2019-08-24 00:33:40'),
(146, 'cash-group', 'web', '2019-08-25 03:47:48', '2019-08-25 03:47:48'),
(147, 'cash-closing', 'web', '2019-08-25 03:48:03', '2019-08-25 03:48:03'),
(148, 'profit-balance', 'web', '2019-08-26 22:16:47', '2019-08-26 22:16:47'),
(149, 'dashboard', 'web', '2019-09-02 05:08:10', '2019-09-02 05:08:10'),
(150, 'income-expense', 'web', '2019-09-14 00:03:59', '2019-09-14 00:03:59'),
(151, 'daily-summary', 'web', '2019-10-09 21:17:00', '2019-10-09 21:17:00'),
(152, 'cash-flow-summary', 'web', '2020-02-21 10:23:59', '2020-02-21 10:23:59'),
(153, 'type-list', 'web', '2020-02-21 10:24:12', '2020-02-21 10:24:12'),
(154, 'type-entry', 'web', '2020-02-21 10:24:18', '2020-02-21 10:24:18'),
(155, 'type-edit', 'web', '2020-02-21 10:26:12', '2020-02-21 10:26:12'),
(156, 'type-delete', 'web', '2020-02-21 10:26:19', '2020-02-21 10:26:19'),
(157, 'caret-list', 'web', '2020-02-21 10:26:28', '2020-02-21 10:26:28'),
(158, 'caret-entry', 'web', '2020-02-21 10:26:35', '2020-02-21 10:26:35'),
(159, 'caret-edit', 'web', '2020-02-21 10:26:41', '2020-02-21 10:26:50'),
(160, 'caret-delete', 'web', '2020-02-21 10:27:01', '2020-02-21 10:27:01'),
(161, 'worker-group', 'web', '2020-08-23 08:21:26', '2020-08-23 08:21:26'),
(162, 'worker-list', 'web', '2020-08-23 08:21:33', '2020-08-23 08:21:33'),
(163, 'worker-entry', 'web', '2020-08-23 08:21:40', '2020-08-23 08:21:40'),
(164, 'worker-edit', 'web', '2020-08-23 08:21:49', '2020-08-23 08:21:49'),
(165, 'worker-delete', 'web', '2020-08-23 08:21:58', '2020-08-23 08:21:58'),
(166, 'worker-order-entry', 'web', '2020-08-23 08:22:55', '2020-08-23 08:22:55'),
(167, 'worker-order-list', 'web', '2020-08-23 08:23:07', '2020-08-23 08:23:07'),
(168, 'worker-order-edit', 'web', '2020-08-23 08:23:27', '2020-08-23 08:23:38'),
(169, 'worker-order-delete', 'web', '2020-08-23 08:23:46', '2020-08-23 08:23:46'),
(170, 'worker-order-group', 'web', '2020-08-23 10:48:43', '2020-08-23 10:48:43');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED DEFAULT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  `caret_id` int(10) UNSIGNED DEFAULT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED DEFAULT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) NOT NULL,
  `re_order_label` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `brand_id`, `type_id`, `caret_id`, `unit_id`, `supplier_id`, `product_name`, `model_no`, `supplier_price`, `sale_price`, `re_order_label`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 1, 1, 1, 1, 'Ring Neckels', '744', '4410.00', '4520.00', 5, NULL, NULL, '2020-03-10 10:39:36', '2020-03-10 10:39:36'),
(2, 2, 2, 2, 1, 1, 1, 'Ring', '74', '20.00', '1350.00', 5, NULL, NULL, '2020-03-10 10:52:46', '2020-03-10 10:52:46'),
(3, 2, 2, 6, 3, 1, 1, 'Gold bar', '01', '52300.00', '55500.00', 10, NULL, NULL, '2020-08-21 05:43:01', '2020-08-21 05:43:01'),
(4, 2, 2, 2, 3, 1, 1, 'Second hand Product', '02', '50000.00', '52200.00', 2, NULL, NULL, '2020-08-21 05:44:57', '2020-08-21 05:44:57');

-- --------------------------------------------------------

--
-- Stand-in structure for view `product_stocks`
-- (See below for the actual view)
--
CREATE TABLE `product_stocks` (
`product_id` int(10) unsigned
,`category_id` int(10) unsigned
,`brand_id` int(10) unsigned
,`unit_id` int(10) unsigned
,`re_order_label` int(10) unsigned
,`product_stock` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `chalan_no` int(11) NOT NULL,
  `per_10_gram_price` decimal(10,2) NOT NULL,
  `per_gram_price` decimal(10,2) DEFAULT NULL,
  `total_weight` decimal(10,2) DEFAULT NULL,
  `total_purchase_price` decimal(10,2) DEFAULT NULL,
  `total_quantity` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `grand_total` decimal(10,2) DEFAULT NULL,
  `payment` decimal(10,2) DEFAULT NULL,
  `due_amount` decimal(10,2) DEFAULT NULL,
  `purchase_date` date NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `supplier_id`, `chalan_no`, `per_10_gram_price`, `per_gram_price`, `total_weight`, `total_purchase_price`, `total_quantity`, `discount`, `grand_total`, `payment`, `due_amount`, `purchase_date`, `note`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(5, 1, 1908205, '6750.00', NULL, NULL, NULL, NULL, '0.00', '6750.00', '500.00', '6250.00', '2020-08-19', NULL, NULL, NULL, '2020-08-19 15:24:00', '2020-08-19 15:24:00'),
(6, 2, 1908206, '187680.00', NULL, NULL, NULL, NULL, '0.00', '187680.00', '20000.00', '167680.00', '2020-08-19', NULL, NULL, NULL, '2020-08-19 15:25:16', '2020-08-19 15:25:16'),
(7, 1, 1908207, '85400.00', NULL, NULL, NULL, NULL, '40.00', '85400.00', '80000.00', '5400.00', '2020-08-19', NULL, NULL, NULL, '2020-08-19 15:37:08', '2020-08-19 15:37:08'),
(8, 1, 1908208, '101520.00', NULL, NULL, NULL, NULL, '0.00', '101520.00', '0.00', '101520.00', '2020-08-19', NULL, NULL, NULL, '2020-08-19 15:42:59', '2020-08-19 15:42:59'),
(9, 1, 2008209, '17500.00', NULL, NULL, NULL, NULL, '50.00', '17500.00', '15000.00', '2500.00', '2020-08-20', NULL, NULL, NULL, '2020-08-19 21:56:04', '2020-08-19 21:56:04');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  `caret_id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(10) UNSIGNED DEFAULT NULL,
  `code_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rack_no` int(11) NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `per_gram_price` decimal(10,2) NOT NULL,
  `purchase_price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `now_stock` int(10) UNSIGNED NOT NULL,
  `purchase_date` date NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`id`, `purchase_id`, `warehouse_id`, `product_id`, `supplier_id`, `category_id`, `brand_id`, `type_id`, `caret_id`, `unit_id`, `code_no`, `rack_no`, `weight`, `per_gram_price`, `purchase_price`, `sale_price`, `quantity`, `now_stock`, `purchase_date`, `note`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 2, 1, 2, 2, 2, 3, 1, '74', 0, '15.00', '450.00', '6750.00', '7087.50', 1, 0, '2020-08-19', NULL, NULL, NULL, '2020-08-19 15:24:00', '2020-08-19 15:24:00'),
(2, 6, 1, 1, 2, 2, 2, 1, 3, 1, '744', 0, '18.00', '460.00', '8280.00', '8694.00', 12, 10, '2020-08-19', NULL, NULL, NULL, '2020-08-19 15:25:16', '2020-08-19 15:25:16'),
(3, 6, 1, 2, 2, 2, 2, 2, 3, 1, '74', 0, '16.00', '460.00', '7360.00', '7728.00', 12, 2, '2020-08-19', NULL, NULL, NULL, '2020-08-19 15:25:16', '2020-08-19 15:25:16'),
(4, 7, 1, 1, 1, 2, 2, 1, 3, 1, '744', 0, '22.00', '480.00', '10560.00', '11088.00', 3, 3, '2020-08-19', NULL, NULL, NULL, '2020-08-19 15:37:08', '2020-08-19 15:37:08'),
(5, 7, 1, 2, 1, 2, 2, 2, 3, 1, '74', 0, '16.00', '480.00', '7680.00', '8064.00', 7, 6, '2020-08-19', NULL, NULL, NULL, '2020-08-19 15:37:08', '2020-08-19 15:37:08'),
(6, 8, 1, 1, 1, 2, 2, 1, 3, 1, '744', 0, '18.00', '470.00', '8460.00', '8883.00', 12, 12, '2020-08-19', NULL, NULL, NULL, '2020-08-19 15:42:59', '2020-08-19 15:42:59'),
(7, 9, 1, 2, 1, 2, 2, 2, 3, 1, '74', 0, '25.00', '450.00', '11250.00', '11812.50', 1, 1, '2020-08-20', NULL, NULL, NULL, '2020-08-19 21:56:04', '2020-08-19 21:56:04'),
(8, 9, 1, 1, 1, 2, 2, 1, 3, 1, '744', 0, '14.00', '450.00', '6300.00', '6615.00', 1, 1, '2020-08-20', NULL, NULL, NULL, '2020-08-19 21:56:04', '2020-08-19 21:56:04');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_returns`
--

CREATE TABLE `purchase_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `chalan_no` int(11) NOT NULL,
  `custom_cost` decimal(10,2) DEFAULT NULL,
  `transport_cost` decimal(10,2) DEFAULT NULL,
  `labor_cost` decimal(10,2) DEFAULT NULL,
  `other_cost` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `payment` decimal(10,2) DEFAULT NULL,
  `return_date` date NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return_details`
--

CREATE TABLE `purchase_return_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_return_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_detail_id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `model_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rack_no` int(11) NOT NULL,
  `purchase_price` decimal(10,2) UNSIGNED NOT NULL,
  `return_price` decimal(10,2) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `return_date` date NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `purchase_stocks`
-- (See below for the actual view)
--
CREATE TABLE `purchase_stocks` (
`id` bigint(20) unsigned
,`purchase_id` bigint(20) unsigned
,`warehouse_id` bigint(20) unsigned
,`product_id` int(10) unsigned
,`supplier_id` int(10) unsigned
,`category_id` int(10) unsigned
,`brand_id` int(10) unsigned
,`type_id` int(10) unsigned
,`caret_id` int(10) unsigned
,`unit_id` int(10) unsigned
,`code_no` varchar(191)
,`rack_no` int(11)
,`weight` decimal(10,2)
,`per_gram_price` decimal(10,2)
,`purchase_price` decimal(10,2)
,`sale_price` decimal(10,2)
,`quantity` int(10) unsigned
,`now_stock` int(10) unsigned
,`purchase_date` date
,`note` varchar(191)
,`created_by` int(11)
,`updated_by` int(11)
,`created_at` timestamp
,`updated_at` timestamp
,`product_name` varchar(191)
);

-- --------------------------------------------------------

--
-- Table structure for table `raw_purchases`
--

CREATE TABLE `raw_purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `nid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `old_memo_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `per_10_gram_price` decimal(10,3) DEFAULT NULL,
  `per_gram_price` decimal(10,3) DEFAULT NULL,
  `less_percent` int(11) DEFAULT NULL,
  `less_price` decimal(10,3) DEFAULT NULL,
  `total_price` decimal(10,3) DEFAULT NULL,
  `paid_amount` decimal(10,3) DEFAULT NULL,
  `purchase_date` date NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `raw_purchase_details`
--

CREATE TABLE `raw_purchase_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `raw_purchase_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `caret_id` int(10) UNSIGNED NOT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  `weight` decimal(10,3) NOT NULL,
  `purchase_date` date NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', NULL, '2019-08-18 01:01:03'),
(2, 'Admin', 'web', '2019-06-29 01:33:23', '2019-08-18 01:01:11'),
(3, 'Accounce', 'web', '2019-06-29 04:58:00', '2019-06-29 04:58:00'),
(4, 'Sadmin', 'web', '2019-06-29 05:13:31', '2019-08-18 01:00:32');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 4),
(2, 1),
(2, 2),
(2, 4),
(3, 1),
(3, 2),
(3, 4),
(4, 1),
(4, 2),
(4, 4),
(5, 1),
(5, 2),
(5, 4),
(6, 1),
(6, 2),
(6, 4),
(7, 1),
(7, 2),
(7, 4),
(8, 1),
(8, 2),
(8, 4),
(11, 1),
(11, 2),
(11, 4),
(12, 1),
(12, 2),
(12, 4),
(13, 1),
(13, 2),
(13, 4),
(14, 1),
(14, 2),
(14, 4),
(15, 1),
(15, 2),
(15, 4),
(16, 1),
(16, 2),
(16, 4),
(17, 1),
(17, 2),
(17, 4),
(18, 1),
(18, 2),
(18, 4),
(19, 1),
(19, 2),
(19, 4),
(20, 1),
(20, 2),
(20, 4),
(21, 1),
(21, 2),
(21, 4),
(22, 1),
(22, 2),
(22, 4),
(23, 1),
(23, 2),
(23, 4),
(24, 1),
(24, 2),
(24, 4),
(25, 1),
(25, 2),
(25, 4),
(26, 1),
(26, 2),
(26, 4),
(27, 1),
(27, 2),
(27, 4),
(28, 1),
(28, 2),
(28, 4),
(29, 1),
(29, 2),
(29, 4),
(30, 1),
(30, 2),
(30, 4),
(31, 1),
(31, 2),
(31, 4),
(32, 1),
(32, 2),
(32, 4),
(33, 1),
(33, 2),
(33, 4),
(34, 1),
(34, 2),
(34, 4),
(35, 1),
(35, 2),
(35, 4),
(36, 1),
(36, 2),
(36, 4),
(37, 1),
(37, 2),
(37, 4),
(38, 1),
(38, 2),
(38, 4),
(39, 1),
(39, 2),
(39, 4),
(40, 1),
(40, 2),
(40, 4),
(41, 1),
(41, 2),
(41, 4),
(42, 1),
(42, 2),
(42, 4),
(43, 1),
(43, 2),
(43, 4),
(44, 1),
(44, 2),
(44, 4),
(45, 1),
(45, 2),
(45, 4),
(46, 1),
(46, 2),
(46, 4),
(47, 1),
(47, 2),
(47, 4),
(48, 1),
(48, 2),
(48, 4),
(49, 1),
(49, 2),
(49, 4),
(50, 1),
(50, 2),
(50, 4),
(51, 1),
(51, 2),
(51, 4),
(52, 1),
(52, 2),
(52, 4),
(53, 1),
(53, 2),
(53, 3),
(53, 4),
(54, 1),
(54, 2),
(54, 3),
(54, 4),
(55, 1),
(55, 2),
(55, 3),
(55, 4),
(56, 1),
(56, 2),
(56, 3),
(56, 4),
(57, 1),
(57, 2),
(57, 4),
(58, 1),
(58, 2),
(58, 3),
(58, 4),
(59, 1),
(59, 2),
(59, 3),
(59, 4),
(60, 1),
(60, 2),
(60, 3),
(60, 4),
(61, 1),
(61, 2),
(61, 3),
(61, 4),
(62, 1),
(62, 2),
(62, 4),
(63, 1),
(63, 2),
(63, 4),
(64, 1),
(64, 2),
(64, 4),
(65, 1),
(65, 2),
(65, 4),
(66, 1),
(66, 2),
(66, 4),
(67, 1),
(67, 2),
(67, 4),
(68, 1),
(68, 2),
(68, 4),
(69, 1),
(69, 2),
(69, 4),
(70, 1),
(70, 2),
(70, 4),
(71, 1),
(71, 2),
(71, 4),
(72, 1),
(72, 2),
(72, 4),
(73, 1),
(73, 2),
(73, 4),
(74, 1),
(74, 2),
(74, 4),
(75, 1),
(75, 2),
(75, 4),
(76, 1),
(76, 2),
(76, 4),
(77, 1),
(77, 2),
(77, 4),
(78, 1),
(78, 2),
(78, 4),
(79, 1),
(79, 2),
(79, 4),
(80, 1),
(80, 2),
(80, 4),
(81, 1),
(81, 2),
(81, 4),
(82, 1),
(82, 2),
(82, 4),
(83, 1),
(83, 2),
(83, 4),
(84, 1),
(84, 2),
(84, 4),
(85, 1),
(85, 2),
(85, 4),
(86, 1),
(86, 2),
(86, 4),
(87, 1),
(87, 2),
(87, 4),
(88, 1),
(88, 2),
(88, 4),
(89, 1),
(89, 2),
(89, 4),
(90, 1),
(90, 2),
(90, 4),
(91, 1),
(91, 2),
(91, 4),
(92, 1),
(92, 2),
(92, 4),
(93, 1),
(93, 2),
(93, 4),
(94, 1),
(94, 2),
(94, 4),
(95, 1),
(95, 2),
(95, 4),
(96, 1),
(96, 2),
(96, 4),
(97, 1),
(97, 2),
(97, 4),
(98, 1),
(98, 2),
(98, 4),
(99, 1),
(99, 2),
(99, 4),
(100, 1),
(100, 2),
(100, 4),
(101, 1),
(101, 2),
(101, 4),
(102, 1),
(102, 2),
(102, 4),
(103, 1),
(103, 2),
(103, 4),
(104, 1),
(104, 2),
(104, 4),
(105, 1),
(105, 2),
(105, 4),
(106, 1),
(106, 2),
(106, 4),
(107, 1),
(107, 2),
(107, 4),
(108, 1),
(108, 2),
(108, 4),
(109, 1),
(109, 2),
(109, 4),
(110, 1),
(110, 2),
(110, 3),
(110, 4),
(111, 1),
(111, 2),
(111, 4),
(112, 1),
(112, 2),
(112, 4),
(113, 1),
(113, 2),
(113, 4),
(114, 1),
(114, 2),
(114, 4),
(115, 1),
(115, 2),
(115, 4),
(116, 1),
(116, 3),
(116, 4),
(117, 1),
(117, 4),
(118, 1),
(118, 4),
(119, 1),
(119, 2),
(119, 4),
(120, 1),
(120, 2),
(120, 3),
(120, 4),
(121, 1),
(121, 2),
(121, 3),
(121, 4),
(122, 1),
(122, 2),
(122, 3),
(122, 4),
(123, 1),
(123, 2),
(123, 4),
(124, 1),
(124, 2),
(124, 4),
(125, 1),
(125, 2),
(126, 1),
(128, 1),
(129, 1),
(129, 2),
(130, 1),
(130, 2),
(131, 1),
(131, 2),
(132, 1),
(132, 2),
(133, 1),
(133, 2),
(134, 1),
(134, 2),
(135, 1),
(135, 2),
(136, 1),
(136, 2),
(137, 1),
(137, 2),
(138, 1),
(138, 2),
(139, 1),
(139, 2),
(140, 1),
(140, 2),
(141, 1),
(141, 2),
(142, 1),
(142, 2),
(143, 1),
(143, 2),
(144, 1),
(144, 2),
(145, 1),
(145, 2),
(146, 1),
(146, 2),
(147, 1),
(147, 2),
(148, 1),
(148, 2),
(149, 1),
(149, 2),
(150, 1),
(150, 2),
(151, 1),
(151, 2),
(152, 2),
(153, 1),
(153, 2),
(154, 1),
(154, 2),
(155, 1),
(155, 2),
(156, 1),
(156, 2),
(157, 1),
(157, 2),
(158, 1),
(158, 2),
(159, 1),
(159, 2),
(160, 1),
(160, 2),
(161, 2),
(162, 2),
(163, 2),
(164, 2),
(165, 2),
(166, 2),
(167, 2),
(168, 2),
(169, 2),
(170, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` int(10) UNSIGNED NOT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `wage` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `grand_total_price` decimal(10,2) DEFAULT NULL,
  `payment` decimal(10,2) DEFAULT NULL,
  `payment_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_no` int(11) DEFAULT NULL,
  `payment_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_amount` decimal(10,2) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `sale_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `customer_id`, `user_id`, `invoice_no`, `total_price`, `wage`, `discount`, `grand_total_price`, `payment`, `payment_by`, `transaction_no`, `payment_status`, `due_amount`, `note`, `sale_date`, `created_at`, `updated_at`) VALUES
(3, 3, 3, 2008201, '7087.50', NULL, '0.00', '7087.50', '55.00', NULL, NULL, 'Due', '7032.00', NULL, '2020-08-20', '2020-08-20 03:14:03', '2020-08-20 03:14:03'),
(4, 7, 3, 2008204, '16758.00', NULL, '0.00', '16758.00', '15000.00', NULL, NULL, 'Due', '1758.00', NULL, '2020-08-20', '2020-08-20 03:14:57', '2020-08-20 03:14:57'),
(5, 8, 3, 2008205, '8694.00', NULL, '94.00', '8600.00', '8600.00', NULL, NULL, 'Due', '0.00', NULL, '2020-08-20', '2020-08-20 03:29:24', '2020-08-20 03:29:24'),
(6, 12, 3, 2508206, '77252.00', NULL, '0.00', '77252.00', '7775.00', 'Card', 245234, 'Due', '69477.00', NULL, '2020-08-25', '2020-08-25 13:34:08', '2020-08-25 13:34:08');

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE `sale_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_detail_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_detail_id` bigint(20) UNSIGNED DEFAULT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  `caret_id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `weight` decimal(10,2) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `return_qty` int(11) DEFAULT NULL,
  `rack_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_price` decimal(10,2) UNSIGNED NOT NULL,
  `discount` decimal(10,2) UNSIGNED DEFAULT NULL,
  `sale_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_details`
--

INSERT INTO `sale_details` (`id`, `sale_id`, `customer_id`, `purchase_detail_id`, `order_detail_id`, `warehouse_id`, `product_id`, `category_id`, `brand_id`, `type_id`, `caret_id`, `unit_id`, `weight`, `quantity`, `return_qty`, `rack_no`, `unit_price`, `discount`, `sale_date`, `created_at`, `updated_at`) VALUES
(2, 3, 3, 1, NULL, 1, 2, 2, 2, 2, 3, 1, '15.00', 1, NULL, '0', '7087.50', NULL, '2020-08-20', '2020-08-20 03:14:03', '2020-08-20 03:14:03'),
(3, 4, 7, 2, NULL, 1, 1, 2, 2, 1, 3, 1, '18.00', 1, NULL, '0', '8694.00', NULL, '2020-08-20', '2020-08-20 03:14:57', '2020-08-20 03:14:57'),
(4, 4, 7, 5, NULL, 1, 2, 2, 2, 2, 3, 1, '16.00', 1, NULL, '0', '8064.00', NULL, '2020-08-20', '2020-08-20 03:14:57', '2020-08-20 03:14:57'),
(5, 5, 8, 2, NULL, 1, 1, 2, 2, 1, 3, 1, '18.00', 1, NULL, '0', '8694.00', NULL, '2020-08-20', '2020-08-20 03:29:24', '2020-08-20 03:29:24'),
(6, 6, 12, 3, NULL, 1, 2, 2, 2, 2, 3, 1, '16.00', 10, NULL, '0', '7728.00', '28.00', '2020-08-25', '2020-08-25 13:34:08', '2020-08-25 13:34:08');

-- --------------------------------------------------------

--
-- Table structure for table `sale_returns`
--

CREATE TABLE `sale_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` int(10) UNSIGNED NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `grand_total_price` decimal(10,2) NOT NULL,
  `payment` decimal(10,2) DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `return_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_return_details`
--

CREATE TABLE `sale_return_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_return_id` bigint(20) UNSIGNED NOT NULL,
  `sale_detail_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `model_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rack_no` int(11) NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `return_price` decimal(10,2) UNSIGNED NOT NULL,
  `return_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_profit_percentage` int(11) DEFAULT NULL,
  `vat_percentage` int(11) DEFAULT NULL,
  `per_10_gm_price` decimal(10,2) DEFAULT NULL,
  `customer_wage_per_gram` decimal(10,2) NOT NULL,
  `worker_wage_per_gram` decimal(10,2) NOT NULL,
  `ddspinp` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `sale_profit_percentage`, `vat_percentage`, `per_10_gm_price`, `customer_wage_per_gram`, `worker_wage_per_gram`, `ddspinp`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 5, 5, '63200.00', '200.00', '160.00', 10, 3, NULL, '2020-08-21 05:33:56');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `supplier_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_name`, `phone`, `email`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Md Asaduzzaman', '01744526325', 'nilimasat@gmail.com', '9/4 Bezpara', '2020-03-10 10:36:35', '2020-03-10 10:36:35'),
(2, 'Md Saidul Islam', '017448596325', 'Delgado52l68@mail.com', '9/4 Bezpara', '2020-03-10 10:36:47', '2020-03-10 10:36:47');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_accounts`
--

CREATE TABLE `supplier_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pay_date` date NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `purchase_id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_accounts`
--

INSERT INTO `supplier_accounts` (`id`, `pay_date`, `supplier_id`, `purchase_id`, `amount`, `note`, `created_at`, `updated_at`) VALUES
(3, '2020-08-19', 1, 5, 500, NULL, '2020-08-19 15:24:00', '2020-08-19 15:24:00'),
(4, '2020-08-19', 2, 6, 20000, NULL, '2020-08-19 15:25:16', '2020-08-19 15:25:16'),
(5, '2020-08-19', 1, 7, 80000, NULL, '2020-08-19 15:37:08', '2020-08-19 15:37:08'),
(7, '2020-08-20', 1, 9, 15000, NULL, '2020-08-19 21:56:04', '2020-08-19 21:56:04');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `type_name`, `created_at`, `updated_at`) VALUES
(1, 'Neckles', '2020-03-10 10:29:23', '2020-03-10 10:29:23'),
(2, 'Ring', '2020-03-10 10:29:27', '2020-03-10 10:29:27'),
(3, 'Braslet', '2020-03-10 10:29:36', '2020-03-10 10:29:36'),
(4, 'Year Ring', '2020-03-10 10:29:43', '2020-03-10 10:29:43'),
(5, 'Nose Pin', '2020-03-10 10:29:52', '2020-03-10 10:29:52'),
(6, 'Bar', '2020-08-21 05:41:56', '2020-08-21 05:41:56');

-- --------------------------------------------------------

--
-- Table structure for table `unions`
--

CREATE TABLE `unions` (
  `id` int(10) UNSIGNED NOT NULL,
  `upozila_id` int(10) UNSIGNED NOT NULL,
  `union_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unions`
--

INSERT INTO `unions` (`id`, `upozila_id`, `union_name`, `created_at`, `updated_at`) VALUES
(2, 11, 'Kusodanga', '2019-05-22 13:32:52', '2019-05-22 13:32:52'),
(3, 11, 'Koyla', '2019-05-22 13:40:06', '2019-05-22 13:41:12'),
(4, 11, 'Deara', '2019-05-22 13:57:45', '2019-05-22 14:02:08'),
(5, 11, 'Helatala', '2019-05-22 14:04:02', '2019-05-22 14:04:02'),
(6, 5, 'Basuary', '2019-05-31 13:24:13', '2019-05-31 13:24:13'),
(7, 5, 'Bondabila', '2019-05-31 13:24:41', '2019-05-31 13:24:41'),
(8, 4, 'Chaluahati', '2019-05-31 13:37:56', '2019-05-31 13:37:56'),
(9, 4, 'Dhakuria', '2019-05-31 13:39:04', '2019-05-31 13:39:04'),
(10, 4, 'Durbadanga', '2019-05-31 13:39:30', '2019-05-31 13:39:30'),
(11, 4, 'Jhampa', '2019-05-31 13:39:51', '2019-05-31 13:39:51'),
(12, 4, 'Khanpur', '2019-05-31 13:40:18', '2019-05-31 13:40:18'),
(13, 4, 'Khodapara', '2019-05-31 13:40:38', '2019-05-31 13:40:38'),
(14, 12, 'Babrahachla', '2019-05-31 13:40:54', '2019-05-31 13:40:54'),
(15, 4, 'Maswimnagar', '2019-05-31 13:40:54', '2019-05-31 13:40:54'),
(16, 4, 'Monirampur', '2019-05-31 13:41:10', '2019-05-31 13:41:10'),
(17, 12, 'Bawishona', '2019-05-31 13:41:26', '2019-05-31 13:41:26'),
(18, 4, 'Monohorpur', '2019-05-31 13:41:31', '2019-05-31 13:41:31'),
(19, 4, 'Nehalpur', '2019-05-31 13:41:47', '2019-05-31 13:41:47'),
(20, 12, 'Chanchuri', '2019-05-31 13:41:50', '2019-05-31 13:41:50'),
(21, 4, 'Rohita', '2019-05-31 13:42:10', '2019-05-31 13:42:10'),
(22, 12, 'Hamidpur', '2019-05-31 13:42:14', '2019-05-31 13:42:14'),
(23, 1, 'baghutia', '2019-05-31 13:42:14', '2019-05-31 13:42:14'),
(24, 4, 'Shamkur', '2019-05-31 13:42:28', '2019-05-31 13:42:28'),
(25, 12, 'Ilisabad', '2019-05-31 13:42:43', '2019-05-31 13:42:43'),
(26, 12, 'Joynagar', '2019-05-31 13:43:29', '2019-05-31 13:43:29'),
(27, 1, 'chalishia', '2019-05-31 13:43:40', '2019-05-31 13:43:40'),
(28, 12, 'Kalabaria', '2019-05-31 13:43:42', '2019-05-31 13:43:42'),
(29, 7, 'Arabpur', '2019-05-31 13:43:52', '2019-05-31 13:43:52'),
(30, 12, 'Khasial', '2019-05-31 13:44:02', '2019-05-31 13:44:02'),
(31, 1, 'Shundoli', '2019-05-31 13:44:12', '2019-05-31 13:44:12'),
(32, 7, 'Basundia', '2019-05-31 13:44:16', '2019-05-31 13:44:16'),
(33, 12, 'Mauli', '2019-05-31 13:44:22', '2019-05-31 13:44:22'),
(34, 7, 'Chacera', '2019-05-31 13:44:35', '2019-05-31 13:44:35'),
(35, 12, 'Paroly', '2019-05-31 13:44:49', '2019-05-31 13:44:49'),
(36, 7, 'Churamonkati', '2019-05-31 13:44:54', '2019-05-31 13:44:54'),
(37, 1, 'Shiddhipasha', '2019-05-31 13:45:01', '2019-05-31 13:45:01'),
(38, 12, 'Pohardanga', '2019-05-31 13:45:10', '2019-05-31 13:45:10'),
(39, 20, 'Dhandia', '2019-05-31 13:45:12', '2019-05-31 15:04:48'),
(40, 12, 'Purulia', '2019-05-31 13:45:30', '2019-05-31 13:45:30'),
(41, 7, 'Fatepur', '2019-05-31 13:45:31', '2019-05-31 13:45:31'),
(42, 1, 'Sreedhorpur', '2019-05-31 13:45:33', '2019-05-31 13:45:33'),
(43, 7, 'Haibatpur', '2019-05-31 13:45:48', '2019-05-31 13:45:48'),
(44, 12, 'Salmabad', '2019-05-31 13:45:54', '2019-05-31 13:45:54'),
(45, 1, 'Shuvarara', '2019-05-31 13:46:06', '2019-05-31 13:46:06'),
(46, 7, 'Ichali', '2019-05-31 13:46:11', '2019-05-31 13:46:11'),
(47, 13, 'Dighalia', '2019-05-31 13:46:23', '2019-05-31 13:46:23'),
(48, 1, 'Prembag', '2019-05-31 13:46:27', '2019-05-31 13:46:27'),
(49, 7, 'Kashimpur', '2019-05-31 13:46:29', '2019-05-31 13:46:29'),
(50, 13, 'Itna', '2019-05-31 13:46:40', '2019-05-31 13:46:40'),
(51, 7, 'Kochua', '2019-05-31 13:46:48', '2019-05-31 13:46:48'),
(52, 13, 'Joypur', '2019-05-31 13:46:52', '2019-05-31 13:46:52'),
(53, 1, 'Payra', '2019-05-31 13:47:01', '2019-05-31 13:47:01'),
(54, 7, 'Labutala', '2019-05-31 13:47:05', '2019-05-31 13:47:05'),
(55, 13, 'Kashipur', '2019-05-31 13:47:10', '2019-05-31 13:47:10'),
(56, 7, 'Narandropur', '2019-05-31 13:47:24', '2019-05-31 13:47:24'),
(57, 7, 'Nowapara', '2019-05-31 13:47:44', '2019-05-31 13:47:44'),
(58, 7, 'Ram Nagar', '2019-05-31 13:48:00', '2019-05-31 13:48:00'),
(59, 2, 'Hakimpur', '2019-05-31 13:48:00', '2019-05-31 13:48:00'),
(60, 13, 'Kotkool', '2019-05-31 13:48:09', '2019-05-31 13:48:09'),
(61, 7, 'Upashahar', '2019-05-31 13:48:16', '2019-05-31 13:48:16'),
(62, 2, 'Jagodishpur', '2019-05-31 13:48:20', '2019-05-31 13:48:20'),
(63, 13, 'Lahuria', '2019-05-31 13:48:25', '2019-05-31 13:48:25'),
(64, 13, 'Lakshmipasha', '2019-05-31 13:48:41', '2019-05-31 13:48:41'),
(65, 2, 'Naray anpur', '2019-05-31 13:48:41', '2019-05-31 13:48:41'),
(66, 2, 'Pashapole', '2019-05-31 13:49:07', '2019-05-31 13:49:07'),
(67, 13, 'Lohagora', '2019-05-31 13:49:10', '2019-05-31 13:49:10'),
(68, 2, 'Patibila', '2019-05-31 13:49:26', '2019-05-31 13:49:26'),
(69, 13, 'Mallikpur', '2019-05-31 13:49:28', '2019-05-31 13:49:28'),
(70, 13, 'Naldi', '2019-05-31 13:49:41', '2019-05-31 13:49:57'),
(71, 2, 'Shingjhuly', '2019-05-31 13:49:48', '2019-05-31 13:49:48'),
(72, 2, 'Sukpukuria', '2019-05-31 13:50:09', '2019-05-31 13:50:09'),
(73, 13, 'Nowagram', '2019-05-31 13:50:30', '2019-05-31 13:50:30'),
(74, 2, 'Sukpukuria', '2019-05-31 13:50:42', '2019-05-31 13:50:42'),
(75, 2, 'Sworupdaha', '2019-05-31 13:51:02', '2019-05-31 13:51:02'),
(76, 13, 'Shalnogar', '2019-05-31 13:51:02', '2019-05-31 13:51:02'),
(77, 8, 'Benapole', '2019-05-31 13:51:13', '2019-05-31 13:51:13'),
(78, 14, 'Auria', '2019-05-31 13:51:23', '2019-05-31 13:51:23'),
(79, 8, 'Bahadurpur', '2019-05-31 13:51:33', '2019-05-31 13:51:33'),
(80, 14, 'Bashgram', '2019-05-31 13:51:42', '2019-05-31 13:51:42'),
(81, 8, 'Bagachra', '2019-05-31 13:51:51', '2019-05-31 13:51:51'),
(82, 14, 'Bhadrobilla', '2019-05-31 13:52:01', '2019-05-31 13:52:01'),
(83, 8, 'Kaiba', '2019-05-31 13:52:11', '2019-05-31 13:52:11'),
(84, 14, 'Bichali', '2019-05-31 13:52:17', '2019-05-31 13:52:33'),
(85, 3, 'Sufalakati', '2019-05-31 13:52:22', '2019-05-31 13:52:22'),
(86, 8, 'Ulashi', '2019-05-31 13:52:28', '2019-05-31 13:52:28'),
(87, 8, 'Sharsa', '2019-05-31 13:52:43', '2019-05-31 13:52:43'),
(88, 3, 'Sagardari', '2019-05-31 13:52:47', '2019-05-31 13:52:47'),
(89, 14, 'Calora', '2019-05-31 13:52:55', '2019-05-31 13:52:55'),
(90, 8, 'Goga', '2019-05-31 13:52:58', '2019-05-31 13:52:58'),
(91, 8, 'Gorpara', '2019-05-31 13:53:16', '2019-05-31 13:53:16'),
(92, 3, 'Majidpur', '2019-05-31 13:53:17', '2019-05-31 13:53:17'),
(93, 14, 'Chandiborpur', '2019-05-31 13:53:21', '2019-05-31 13:53:21'),
(94, 8, 'Putkhali', '2019-05-31 13:53:33', '2019-05-31 13:53:33'),
(95, 3, 'Mongolkot', '2019-05-31 13:53:40', '2019-05-31 13:53:40'),
(96, 8, 'Lakshampur', '2019-05-31 13:53:51', '2019-05-31 13:53:51'),
(97, 14, 'Habokhali', '2019-05-31 13:54:08', '2019-05-31 13:54:08'),
(98, 8, 'Navaron', '2019-05-31 13:54:08', '2019-05-31 13:54:08'),
(99, 3, 'Biddyanandankati', '2019-05-31 13:54:17', '2019-05-31 13:54:17'),
(100, 14, 'Maijpara', '2019-05-31 13:54:24', '2019-05-31 13:54:24'),
(101, 14, 'Mulia', '2019-05-31 13:54:40', '2019-05-31 13:54:40'),
(102, 3, 'Panjia', '2019-05-31 13:54:42', '2019-05-31 13:54:42'),
(103, 14, 'Shahabad', '2019-05-31 13:54:59', '2019-05-31 13:54:59'),
(104, 3, 'Trimohini', '2019-05-31 13:55:14', '2019-05-31 13:55:14'),
(105, 14, 'Shekhati', '2019-05-31 13:55:17', '2019-05-31 13:55:17'),
(106, 14, 'Singia Sholepur', '2019-05-31 13:55:33', '2019-05-31 13:55:33'),
(107, 3, 'Gaurighona', '2019-05-31 13:55:34', '2019-05-31 13:55:34'),
(108, 14, 'Tularampur', '2019-05-31 13:55:56', '2019-05-31 13:55:56'),
(109, 3, 'Keshabpur', '2019-05-31 13:55:57', '2019-05-31 13:55:57'),
(110, 5, 'Basuary', '2019-05-31 13:58:32', '2019-05-31 13:58:32'),
(111, 6, 'Bankra', '2019-05-31 13:58:43', '2019-05-31 13:58:43'),
(112, 5, 'Bondabila', '2019-05-31 13:58:53', '2019-05-31 13:58:53'),
(113, 6, 'Gangananda', '2019-05-31 13:59:00', '2019-05-31 13:59:00'),
(114, 5, 'Darajhat', '2019-05-31 13:59:11', '2019-05-31 13:59:11'),
(115, 6, 'Godkhali', '2019-05-31 13:59:20', '2019-05-31 13:59:20'),
(116, 5, 'Dhalgram', '2019-05-31 13:59:32', '2019-05-31 13:59:32'),
(117, 6, 'Hazirbag', '2019-05-31 13:59:37', '2019-05-31 13:59:37'),
(118, 5, 'Dohakula', '2019-05-31 13:59:44', '2019-05-31 13:59:44'),
(119, 6, 'Jhikargacha', '2019-05-31 13:59:56', '2019-05-31 13:59:56'),
(120, 5, 'Jahurpur', '2019-05-31 13:59:59', '2019-05-31 13:59:59'),
(121, 6, 'Magura', '2019-05-31 14:00:13', '2019-05-31 14:00:13'),
(122, 6, 'Navaran', '2019-05-31 14:00:30', '2019-05-31 14:00:30'),
(123, 6, 'Nirbaskhola', '2019-05-31 14:00:47', '2019-05-31 14:00:47'),
(124, 5, 'Jamdia', '2019-05-31 14:01:00', '2019-05-31 14:01:00'),
(125, 6, 'Panishara', '2019-05-31 14:01:10', '2019-05-31 14:01:10'),
(126, 5, 'Narikelbaria', '2019-05-31 14:01:25', '2019-05-31 14:01:25'),
(127, 6, 'Shankarpur', '2019-05-31 14:01:25', '2019-05-31 14:01:25'),
(128, 6, 'Simulia', '2019-05-31 14:01:41', '2019-05-31 14:01:41'),
(129, 5, 'Raipur', '2019-05-31 14:01:41', '2019-05-31 14:01:41'),
(130, 3, 'Mongolkote', '2019-05-31 14:10:23', '2019-05-31 14:10:39'),
(131, 16, 'Anulia', '2019-05-31 14:29:46', '2019-05-31 14:29:46'),
(132, 16, 'Assasuni', '2019-05-31 14:29:58', '2019-05-31 14:29:58'),
(133, 16, 'Bardal', '2019-05-31 14:30:09', '2019-05-31 14:30:09'),
(134, 16, 'Budhata', '2019-05-31 14:30:28', '2019-05-31 14:30:28'),
(135, 16, 'Dharghapur', '2019-05-31 14:36:17', '2019-05-31 14:36:17'),
(136, 16, 'Kada Kati', '2019-05-31 14:36:32', '2019-05-31 14:36:32'),
(137, 16, 'Khazra', '2019-05-31 14:36:43', '2019-05-31 14:36:43'),
(138, 16, 'Kulla', '2019-05-31 14:37:00', '2019-05-31 14:37:00'),
(139, 16, 'Protapnager', '2019-05-31 14:37:16', '2019-05-31 14:37:16'),
(140, 16, 'Sovenali', '2019-05-31 14:37:31', '2019-05-31 14:37:31'),
(141, 16, 'Sriula', '2019-05-31 14:38:00', '2019-05-31 14:38:00'),
(142, 17, 'Debhata', '2019-05-31 14:40:06', '2019-05-31 14:40:06'),
(143, 17, 'Kulia', '2019-05-31 14:40:23', '2019-05-31 14:40:23'),
(144, 17, 'Parulia', '2019-05-31 14:40:51', '2019-05-31 14:40:51'),
(145, 17, 'Sakhipur', '2019-05-31 14:41:26', '2019-05-31 14:41:26'),
(146, 11, 'Chandanpur', '2019-05-31 14:44:18', '2019-05-31 14:44:18'),
(147, 11, 'Jalalabad', '2019-05-31 14:45:51', '2019-05-31 14:45:51'),
(148, 11, 'Joynagar', '2019-05-31 14:46:08', '2019-05-31 14:46:08'),
(149, 11, 'Karalkata', '2019-05-31 14:46:58', '2019-05-31 14:46:58'),
(150, 11, 'Keragachi', '2019-05-31 14:47:13', '2019-05-31 14:47:13'),
(151, 11, 'Langoljhara', '2019-05-31 14:48:17', '2019-05-31 14:48:17'),
(152, 11, 'Sonabaria', '2019-05-31 14:48:36', '2019-05-31 14:48:36'),
(153, 11, 'Yugikhali', '2019-05-31 14:49:00', '2019-05-31 14:49:00'),
(154, 18, 'Agordari', '2019-05-31 14:50:43', '2019-05-31 14:50:43'),
(155, 18, 'Alipur', '2019-05-31 14:51:27', '2019-05-31 14:51:27'),
(156, 18, 'Balli', '2019-05-31 14:51:36', '2019-05-31 14:51:36'),
(157, 18, 'Bansdasha', '2019-05-31 14:51:46', '2019-05-31 14:51:46'),
(158, 18, 'Baykari', '2019-05-31 14:51:58', '2019-05-31 14:51:58'),
(159, 18, 'Bhomra', '2019-05-31 14:53:51', '2019-05-31 14:53:51'),
(160, 18, 'Brahmarazpur', '2019-05-31 14:54:03', '2019-05-31 14:54:03'),
(161, 18, 'Dhulihor', '2019-05-31 14:54:44', '2019-05-31 14:54:44'),
(162, 18, 'Fingri', '2019-05-31 14:54:56', '2019-05-31 14:54:56'),
(163, 18, 'Kushkhali', '2019-05-31 14:55:05', '2019-05-31 14:55:05'),
(164, 18, 'Labsha', '2019-05-31 14:56:22', '2019-05-31 14:56:22'),
(165, 18, 'Shibpur', '2019-05-31 14:56:34', '2019-05-31 14:56:34'),
(166, 19, 'Shaymnagar', '2019-05-31 14:57:19', '2019-05-31 14:57:19'),
(167, 19, 'Atulia', '2019-05-31 14:58:21', '2019-05-31 14:58:21'),
(168, 19, 'Bhurulia', '2019-05-31 14:58:33', '2019-05-31 14:58:33'),
(169, 19, 'Burigoalini', '2019-05-31 14:58:50', '2019-05-31 14:58:50'),
(170, 19, 'Gabura', '2019-05-31 14:59:01', '2019-05-31 14:59:01'),
(171, 19, 'Kashimari', '2019-05-31 14:59:15', '2019-05-31 14:59:15'),
(172, 19, 'Khykali', '2019-05-31 14:59:27', '2019-05-31 14:59:27'),
(173, 19, 'Munshigonj', '2019-05-31 14:59:36', '2019-05-31 14:59:36'),
(174, 19, 'Nurnagar', '2019-05-31 14:59:49', '2019-05-31 14:59:49'),
(175, 19, 'Padmapukur', '2019-05-31 15:00:04', '2019-05-31 15:00:04'),
(176, 19, 'Ramzannagar', '2019-05-31 15:00:14', '2019-05-31 15:00:14'),
(177, 20, 'Islamkati', '2019-05-31 15:05:12', '2019-05-31 15:05:12'),
(178, 20, 'Khalilnagor', '2019-05-31 15:05:32', '2019-05-31 15:05:32'),
(179, 20, 'Khalishkhali', '2019-05-31 15:05:49', '2019-05-31 15:05:49'),
(180, 20, 'Khesra', '2019-05-31 15:06:02', '2019-05-31 15:06:02'),
(181, 20, 'Kumira', '2019-05-31 15:06:22', '2019-05-31 15:06:22'),
(182, 20, 'Magura', '2019-05-31 15:06:36', '2019-05-31 15:06:36'),
(183, 20, 'Nagorghata', '2019-05-31 15:09:44', '2019-05-31 15:09:44'),
(184, 20, 'Sarulia', '2019-05-31 15:09:45', '2019-05-31 15:10:02'),
(185, 20, 'Tala', '2019-05-31 15:10:15', '2019-05-31 15:10:15'),
(186, 20, 'Talalpur', '2019-05-31 15:10:39', '2019-05-31 15:10:39'),
(187, 20, 'Tentulia', '2019-05-31 15:10:51', '2019-05-31 15:10:51');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(10) UNSIGNED NOT NULL,
  `unit_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_name`, `created_at`, `updated_at`) VALUES
(1, 'Gram', '2020-03-10 10:30:17', '2020-03-10 10:30:17'),
(2, 'Pieces', '2020-03-10 10:30:26', '2020-03-10 10:30:26');

-- --------------------------------------------------------

--
-- Table structure for table `upozilas`
--

CREATE TABLE `upozilas` (
  `id` int(10) UNSIGNED NOT NULL,
  `distric_id` int(10) UNSIGNED NOT NULL,
  `upozila_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `upozilas`
--

INSERT INTO `upozilas` (`id`, `distric_id`, `upozila_name`, `created_at`, `updated_at`) VALUES
(1, 3, 'Abhaynagar', '2019-05-22 12:57:20', '2019-05-22 12:57:20'),
(2, 3, 'Chaugachha', '2019-05-22 12:58:34', '2019-05-22 12:58:34'),
(3, 3, 'Keshabpur', '2019-05-22 12:58:51', '2019-05-22 12:58:51'),
(4, 3, 'Manirampur', '2019-05-22 13:00:51', '2019-05-22 13:00:51'),
(5, 3, 'Bagherpara', '2019-05-22 13:01:10', '2019-05-22 13:01:10'),
(6, 3, 'Jhikargachha', '2019-05-22 13:01:24', '2019-05-22 13:01:24'),
(7, 3, 'Jashore Sadar', '2019-05-22 13:01:41', '2019-05-22 13:01:41'),
(8, 3, 'Sharsha', '2019-05-22 13:01:54', '2019-05-22 13:01:54'),
(10, 8, 'Batiaghata', '2019-05-22 13:04:39', '2019-05-22 13:12:14'),
(11, 5, 'Kalaroa', '2019-05-22 13:29:54', '2019-05-31 14:41:55'),
(12, 12, 'Kalia', '2019-05-31 13:35:06', '2019-05-31 13:35:06'),
(13, 12, 'Lohagara', '2019-05-31 13:35:30', '2019-05-31 13:35:30'),
(14, 12, 'Narail Sadar', '2019-05-31 13:36:34', '2019-05-31 13:36:34'),
(15, 12, 'Naragati', '2019-05-31 13:37:18', '2019-05-31 13:37:18'),
(16, 5, 'Assasuni', '2019-05-31 14:29:17', '2019-05-31 14:29:17'),
(17, 5, 'Debhata', '2019-05-31 14:39:27', '2019-05-31 14:39:27'),
(18, 5, 'Satkhira Sador', '2019-05-31 14:50:09', '2019-05-31 14:50:09'),
(19, 5, 'Shaymnagar', '2019-05-31 14:56:53', '2019-05-31 14:56:53'),
(20, 5, 'Tala', '2019-05-31 15:04:24', '2019-05-31 15:04:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `image`, `address`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', NULL, 'sadmin@gmail.com', 'super-admin-2020-08-20-5f3eae4d33dac.jpg', NULL, NULL, '$2y$10$JBqWPNXA8I.n5fFVfrOMHuxE3NiRhtX3viOi/oItlMboSSAWYTBkG', NULL, '2019-06-22 23:00:02', '2020-08-20 11:09:33'),
(3, 'Admin', NULL, 'admin@gmail.com', 'admin-2020-02-21-5e4ffc54065b7.png', NULL, NULL, '$2y$10$msb3dr4WH01xahCDKwdcx.9TzxMfuEY5o.zV7r6BioZzXxC.xCg4S', '7nk2ZlQgnax6OYAw14SQAXyfBzY3MT26Ip4kiscu0sriXsaiOWw6esRML3SL', '2019-06-29 05:04:54', '2020-02-21 09:50:44'),
(4, 'Md Manager', NULL, 'manager@gmail.com', NULL, NULL, NULL, '$2y$10$Rl8HQQ19x22b4z.jqXBY4.opVSc5fKskdkwUsMx1uGgw/z/I/ow/i', 'ZvoeigLmrK3fOlLQnYpD70ttJzVPgNFAs3koyMraCGPThqBwpBbGibOzGOjn', '2019-07-16 00:04:55', '2019-11-13 05:45:09');

-- --------------------------------------------------------

--
-- Table structure for table `villages`
--

CREATE TABLE `villages` (
  `id` int(10) UNSIGNED NOT NULL,
  `union_id` int(10) UNSIGNED NOT NULL,
  `village_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `warehouse_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warehouse_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warehouse_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse_location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `user_id`, `warehouse_name`, `warehouse_code`, `warehouse_phone`, `warehouse_email`, `warehouse_location`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 3, 'Warehouse-1', '101', '017000000', 'warehouse1@gmail.com', 'Jashore', 'Active', 3, NULL, '2020-03-10 11:03:40', '2020-03-10 11:03:40');

-- --------------------------------------------------------

--
-- Table structure for table `wastage_returns`
--

CREATE TABLE `wastage_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_detail_id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `model_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rack_no` int(11) NOT NULL,
  `purchase_price` decimal(10,2) UNSIGNED NOT NULL,
  `return_price` decimal(10,2) UNSIGNED NOT NULL,
  `return_quantity` int(10) UNSIGNED NOT NULL,
  `return_date` date NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`id`, `name`, `phone`, `address`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Md Rofikul Islam', '01744526325', 'Jashore', 'Active', NULL, NULL, '2020-08-23 09:19:21', '2020-08-23 09:19:21'),
(2, 'Md Mofizul Islam', '01722276314', 'Salika', 'Active', NULL, NULL, '2020-08-23 09:23:49', '2020-08-23 09:24:10');

-- --------------------------------------------------------

--
-- Table structure for table `worker_accounts`
--

CREATE TABLE `worker_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `worker_id` bigint(20) UNSIGNED NOT NULL,
  `worker_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `worker_accounts`
--

INSERT INTO `worker_accounts` (`id`, `worker_id`, `worker_order_id`, `payment_date`, `amount`, `note`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, 2, 4, '2020-08-25', '2000.00', NULL, NULL, NULL, '2020-08-25 12:35:57', '2020-08-25 12:35:57'),
(4, 2, 5, '2020-08-25', '1000.00', NULL, NULL, NULL, '2020-08-25 12:36:49', '2020-08-25 12:36:49'),
(5, 1, 6, '2020-08-25', '0.00', NULL, NULL, NULL, '2020-08-25 13:20:57', '2020-08-25 13:20:57');

-- --------------------------------------------------------

--
-- Table structure for table `worker_orders`
--

CREATE TABLE `worker_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `worker_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `caret_id` int(10) UNSIGNED NOT NULL,
  `order_no` int(11) NOT NULL,
  `gold_amount` decimal(10,2) NOT NULL,
  `per_gram_wage` decimal(10,2) NOT NULL,
  `loss_gold` decimal(10,2) DEFAULT NULL,
  `return_gold` decimal(10,2) DEFAULT NULL,
  `total_wage` decimal(10,2) NOT NULL,
  `payment` decimal(10,2) DEFAULT NULL,
  `due` decimal(10,2) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `worker_orders`
--

INSERT INTO `worker_orders` (`id`, `worker_id`, `user_id`, `caret_id`, `order_no`, `gold_amount`, `per_gram_wage`, `loss_gold`, `return_gold`, `total_wage`, `payment`, `due`, `order_date`, `return_date`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(4, 2, 3, 3, 2508203, '10.00', '160.00', NULL, NULL, '6880.00', '2000.00', '4880.00', '2020-08-25', NULL, 'Pending', 3, NULL, '2020-08-25 12:35:57', '2020-08-25 12:35:57'),
(5, 2, 3, 3, 2508205, '20.00', '160.00', NULL, NULL, '5920.00', '1000.00', '4920.00', '2020-08-25', NULL, 'Pending', 3, NULL, '2020-08-25 12:36:49', '2020-08-25 12:36:49'),
(6, 1, 3, 3, 2508206, '10.00', '160.00', NULL, NULL, '10720.00', '0.00', '10720.00', '2020-08-25', NULL, 'Pending', 3, NULL, '2020-08-25 13:20:57', '2020-08-25 13:20:57');

-- --------------------------------------------------------

--
-- Table structure for table `worker_order_details`
--

CREATE TABLE `worker_order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `worker_order_id` bigint(20) UNSIGNED NOT NULL,
  `worker_id` bigint(20) UNSIGNED NOT NULL,
  `order_detail_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  `caret_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_no` int(11) NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `wage` decimal(10,2) NOT NULL,
  `order_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `deliveried_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `worker_order_details`
--

INSERT INTO `worker_order_details` (`id`, `worker_order_id`, `worker_id`, `order_detail_id`, `product_id`, `category_id`, `type_id`, `caret_id`, `user_id`, `order_no`, `weight`, `wage`, `order_date`, `delivery_date`, `status`, `deliveried_date`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, 4, 2, 5, 2, 2, 2, 3, 3, 2508203, '13.00', '2080.00', '2020-08-25', '0000-00-00', 'Pending', NULL, 3, NULL, '2020-08-25 12:35:57', '2020-08-25 12:35:57'),
(4, 4, 2, 8, 4, 2, 2, 3, 3, 2508203, '20.00', '3200.00', '2020-08-25', '0000-00-00', 'Pending', NULL, 3, NULL, '2020-08-25 12:35:57', '2020-08-25 12:35:57'),
(5, 4, 2, NULL, 2, 2, 2, 3, 3, 2508203, '10.00', '1600.00', '2020-08-25', '0000-00-00', 'Pending', NULL, 3, NULL, '2020-08-25 12:35:57', '2020-08-25 12:35:57'),
(6, 5, 2, 5, 2, 2, 2, 3, 3, 2508205, '13.00', '2080.00', '2020-08-25', '0000-00-00', 'Pending', NULL, 3, NULL, '2020-08-25 12:36:49', '2020-08-25 12:36:49'),
(7, 5, 2, 6, 4, 2, 2, 3, 3, 2508205, '14.00', '2240.00', '2020-08-25', '0000-00-00', 'Pending', NULL, 3, NULL, '2020-08-25 12:36:49', '2020-08-25 12:36:49'),
(8, 5, 2, NULL, 2, 2, 2, 3, 3, 2508205, '10.00', '1600.00', '2020-08-25', '0000-00-00', 'Pending', NULL, 3, NULL, '2020-08-25 12:36:49', '2020-08-25 12:36:49'),
(9, 6, 1, NULL, 2, 2, 2, 2, 3, 2508206, '10.00', '1600.00', '2020-08-25', '0000-00-00', 'Pending', NULL, 3, NULL, '2020-08-25 13:20:57', '2020-08-25 13:20:57'),
(10, 6, 1, NULL, 4, 2, 2, 3, 3, 2508206, '10.00', '1600.00', '2020-08-25', '0000-00-00', 'Pending', NULL, 3, NULL, '2020-08-25 13:20:57', '2020-08-25 13:20:57'),
(11, 6, 1, 5, 2, 2, 2, 3, 3, 2508206, '13.00', '2080.00', '2020-08-25', '0000-00-00', 'Pending', NULL, 3, NULL, '2020-08-25 13:20:57', '2020-08-25 13:20:57'),
(12, 6, 1, 8, 4, 2, 2, 3, 3, 2508206, '20.00', '3200.00', '2020-08-25', '0000-00-00', 'Pending', NULL, 3, NULL, '2020-08-25 13:20:57', '2020-08-25 13:20:57'),
(13, 6, 1, 12, 2, 2, 2, 2, 3, 2508206, '14.00', '2240.00', '2020-08-25', '0000-00-00', 'Pending', NULL, 3, NULL, '2020-08-25 13:20:57', '2020-08-25 13:20:57');

-- --------------------------------------------------------

--
-- Structure for view `product_stocks`
--
DROP TABLE IF EXISTS `product_stocks`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_stocks`  AS  select `purchase_details`.`product_id` AS `product_id`,`purchase_details`.`category_id` AS `category_id`,`purchase_details`.`brand_id` AS `brand_id`,`purchase_details`.`unit_id` AS `unit_id`,`products`.`re_order_label` AS `re_order_label`,sum(`purchase_details`.`now_stock`) AS `product_stock` from (`purchase_details` join `products`) where ((`purchase_details`.`now_stock` > 0) and (`purchase_details`.`product_id` = `products`.`id`)) group by `purchase_details`.`product_id` ;

-- --------------------------------------------------------

--
-- Structure for view `purchase_stocks`
--
DROP TABLE IF EXISTS `purchase_stocks`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `purchase_stocks`  AS  select `purchase_details`.`id` AS `id`,`purchase_details`.`purchase_id` AS `purchase_id`,`purchase_details`.`warehouse_id` AS `warehouse_id`,`purchase_details`.`product_id` AS `product_id`,`purchase_details`.`supplier_id` AS `supplier_id`,`purchase_details`.`category_id` AS `category_id`,`purchase_details`.`brand_id` AS `brand_id`,`purchase_details`.`type_id` AS `type_id`,`purchase_details`.`caret_id` AS `caret_id`,`purchase_details`.`unit_id` AS `unit_id`,`purchase_details`.`code_no` AS `code_no`,`purchase_details`.`rack_no` AS `rack_no`,`purchase_details`.`weight` AS `weight`,`purchase_details`.`per_gram_price` AS `per_gram_price`,`purchase_details`.`purchase_price` AS `purchase_price`,`purchase_details`.`sale_price` AS `sale_price`,`purchase_details`.`quantity` AS `quantity`,`purchase_details`.`now_stock` AS `now_stock`,`purchase_details`.`purchase_date` AS `purchase_date`,`purchase_details`.`note` AS `note`,`purchase_details`.`created_by` AS `created_by`,`purchase_details`.`updated_by` AS `updated_by`,`purchase_details`.`created_at` AS `created_at`,`purchase_details`.`updated_at` AS `updated_at`,`products`.`product_name` AS `product_name` from (`products` join `purchase_details`) where ((`purchase_details`.`now_stock` > 0) and (`purchase_details`.`product_id` = `products`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_transactions`
--
ALTER TABLE `bank_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_transactions_bank_id_foreign` (`bank_id`),
  ADD KEY `bank_transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carets`
--
ALTER TABLE `carets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_closings`
--
ALTER TABLE `cash_closings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_distric_id_foreign` (`distric_id`),
  ADD KEY `customers_upozila_id_foreign` (`upozila_id`),
  ADD KEY `customers_union_id_foreign` (`union_id`),
  ADD KEY `customers_village_id_foreign` (`village_id`);

--
-- Indexes for table `customer_accounts`
--
ALTER TABLE `customer_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_accounts_customer_id_foreign` (`customer_id`),
  ADD KEY `customer_accounts_sale_id_foreign` (`sale_id`),
  ADD KEY `customer_accounts_order_id_foreign` (`order_id`);

--
-- Indexes for table `districs`
--
ALTER TABLE `districs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_expensetype_id_foreign` (`expensetype_id`),
  ADD KEY `expenses_user_id_foreign` (`user_id`);

--
-- Indexes for table `expensetypes`
--
ALTER TABLE `expensetypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incomes_incometype_id_foreign` (`incometype_id`),
  ADD KEY `incomes_user_id_foreign` (`user_id`);

--
-- Indexes for table `incometypes`
--
ALTER TABLE `incometypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loaners`
--
ALTER TABLE `loaners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loans_loaner_id_foreign` (`loaner_id`),
  ADD KEY `loans_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_no_unique` (`order_no`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_user_id_foreign` (`user_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`),
  ADD KEY `order_details_category_id_foreign` (`category_id`),
  ADD KEY `order_details_type_id_foreign` (`type_id`),
  ADD KEY `order_details_caret_id_foreign` (`caret_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_model_no_unique` (`model_no`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_type_id_foreign` (`type_id`),
  ADD KEY `products_caret_id_foreign` (`caret_id`),
  ADD KEY `products_unit_id_foreign` (`unit_id`),
  ADD KEY `products_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `purchases_chalan_no_unique` (`chalan_no`),
  ADD KEY `purchases_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_details_purchase_id_foreign` (`purchase_id`),
  ADD KEY `purchase_details_warehouse_id_foreign` (`warehouse_id`),
  ADD KEY `purchase_details_supplier_id_foreign` (`supplier_id`),
  ADD KEY `purchase_details_product_id_foreign` (`product_id`),
  ADD KEY `purchase_details_category_id_foreign` (`category_id`),
  ADD KEY `purchase_details_brand_id_foreign` (`brand_id`),
  ADD KEY `purchase_details_type_id_foreign` (`type_id`),
  ADD KEY `purchase_details_caret_id_foreign` (`caret_id`),
  ADD KEY `purchase_details_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_returns_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `purchase_return_details`
--
ALTER TABLE `purchase_return_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_return_details_purchase_return_id_foreign` (`purchase_return_id`),
  ADD KEY `purchase_return_details_purchase_detail_id_foreign` (`purchase_detail_id`),
  ADD KEY `purchase_return_details_warehouse_id_foreign` (`warehouse_id`),
  ADD KEY `purchase_return_details_supplier_id_foreign` (`supplier_id`),
  ADD KEY `purchase_return_details_product_id_foreign` (`product_id`),
  ADD KEY `purchase_return_details_category_id_foreign` (`category_id`),
  ADD KEY `purchase_return_details_brand_id_foreign` (`brand_id`),
  ADD KEY `purchase_return_details_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `raw_purchases`
--
ALTER TABLE `raw_purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `raw_purchases_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `raw_purchase_details`
--
ALTER TABLE `raw_purchase_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `raw_purchase_details_raw_purchase_id_foreign` (`raw_purchase_id`),
  ADD KEY `raw_purchase_details_supplier_id_foreign` (`supplier_id`),
  ADD KEY `raw_purchase_details_product_id_foreign` (`product_id`),
  ADD KEY `raw_purchase_details_category_id_foreign` (`category_id`),
  ADD KEY `raw_purchase_details_caret_id_foreign` (`caret_id`),
  ADD KEY `raw_purchase_details_type_id_foreign` (`type_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sales_invoice_no_unique` (`invoice_no`),
  ADD KEY `sales_customer_id_foreign` (`customer_id`),
  ADD KEY `sales_user_id_foreign` (`user_id`);

--
-- Indexes for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_details_sale_id_foreign` (`sale_id`),
  ADD KEY `sale_details_customer_id_foreign` (`customer_id`),
  ADD KEY `sale_details_purchase_detail_id_foreign` (`purchase_detail_id`),
  ADD KEY `sale_details_order_detail_id_foreign` (`order_detail_id`),
  ADD KEY `sale_details_warehouse_id_foreign` (`warehouse_id`),
  ADD KEY `sale_details_product_id_foreign` (`product_id`),
  ADD KEY `sale_details_category_id_foreign` (`category_id`),
  ADD KEY `sale_details_brand_id_foreign` (`brand_id`),
  ADD KEY `sale_details_type_id_foreign` (`type_id`),
  ADD KEY `sale_details_caret_id_foreign` (`caret_id`),
  ADD KEY `sale_details_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `sale_returns`
--
ALTER TABLE `sale_returns`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sale_returns_invoice_no_unique` (`invoice_no`),
  ADD KEY `sale_returns_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `sale_return_details`
--
ALTER TABLE `sale_return_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_return_details_sale_return_id_foreign` (`sale_return_id`),
  ADD KEY `sale_return_details_customer_id_foreign` (`customer_id`),
  ADD KEY `sale_return_details_sale_detail_id_foreign` (`sale_detail_id`),
  ADD KEY `sale_return_details_warehouse_id_foreign` (`warehouse_id`),
  ADD KEY `sale_return_details_product_id_foreign` (`product_id`),
  ADD KEY `sale_return_details_category_id_foreign` (`category_id`),
  ADD KEY `sale_return_details_brand_id_foreign` (`brand_id`),
  ADD KEY `sale_return_details_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_accounts`
--
ALTER TABLE `supplier_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_accounts_supplier_id_foreign` (`supplier_id`),
  ADD KEY `supplier_accounts_purchase_id_foreign` (`purchase_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unions`
--
ALTER TABLE `unions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unions_upozila_id_foreign` (`upozila_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upozilas`
--
ALTER TABLE `upozilas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `upozilas_distric_id_foreign` (`distric_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `villages`
--
ALTER TABLE `villages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `villages_union_id_foreign` (`union_id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `warehouses_user_id_foreign` (`user_id`);

--
-- Indexes for table `wastage_returns`
--
ALTER TABLE `wastage_returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wastage_returns_purchase_detail_id_foreign` (`purchase_detail_id`),
  ADD KEY `wastage_returns_warehouse_id_foreign` (`warehouse_id`),
  ADD KEY `wastage_returns_supplier_id_foreign` (`supplier_id`),
  ADD KEY `wastage_returns_product_id_foreign` (`product_id`),
  ADD KEY `wastage_returns_category_id_foreign` (`category_id`),
  ADD KEY `wastage_returns_brand_id_foreign` (`brand_id`),
  ADD KEY `wastage_returns_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `worker_accounts`
--
ALTER TABLE `worker_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `worker_accounts_worker_id_foreign` (`worker_id`),
  ADD KEY `worker_accounts_worker_order_id_foreign` (`worker_order_id`);

--
-- Indexes for table `worker_orders`
--
ALTER TABLE `worker_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `worker_orders_worker_id_foreign` (`worker_id`),
  ADD KEY `worker_orders_caret_id_foreign` (`caret_id`),
  ADD KEY `worker_orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `worker_order_details`
--
ALTER TABLE `worker_order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `worker_order_details_worker_id_foreign` (`worker_id`),
  ADD KEY `worker_order_details_order_detail_id_foreign` (`order_detail_id`),
  ADD KEY `worker_order_details_product_id_foreign` (`product_id`),
  ADD KEY `worker_order_details_category_id_foreign` (`category_id`),
  ADD KEY `worker_order_details_type_id_foreign` (`type_id`),
  ADD KEY `worker_order_details_caret_id_foreign` (`caret_id`),
  ADD KEY `worker_order_details_user_id_foreign` (`user_id`),
  ADD KEY `worker_order_details_worker_order_id_foreign` (`worker_order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bank_transactions`
--
ALTER TABLE `bank_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `carets`
--
ALTER TABLE `carets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cash_closings`
--
ALTER TABLE `cash_closings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customer_accounts`
--
ALTER TABLE `customer_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `districs`
--
ALTER TABLE `districs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expensetypes`
--
ALTER TABLE `expensetypes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incometypes`
--
ALTER TABLE `incometypes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loaners`
--
ALTER TABLE `loaners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_return_details`
--
ALTER TABLE `purchase_return_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `raw_purchases`
--
ALTER TABLE `raw_purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `raw_purchase_details`
--
ALTER TABLE `raw_purchase_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sale_returns`
--
ALTER TABLE `sale_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_return_details`
--
ALTER TABLE `sale_return_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier_accounts`
--
ALTER TABLE `supplier_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `unions`
--
ALTER TABLE `unions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `upozilas`
--
ALTER TABLE `upozilas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `villages`
--
ALTER TABLE `villages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wastage_returns`
--
ALTER TABLE `wastage_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `workers`
--
ALTER TABLE `workers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `worker_accounts`
--
ALTER TABLE `worker_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `worker_orders`
--
ALTER TABLE `worker_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `worker_order_details`
--
ALTER TABLE `worker_order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank_transactions`
--
ALTER TABLE `bank_transactions`
  ADD CONSTRAINT `bank_transactions_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bank_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_distric_id_foreign` FOREIGN KEY (`distric_id`) REFERENCES `districs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customers_union_id_foreign` FOREIGN KEY (`union_id`) REFERENCES `unions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customers_upozila_id_foreign` FOREIGN KEY (`upozila_id`) REFERENCES `upozilas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customers_village_id_foreign` FOREIGN KEY (`village_id`) REFERENCES `villages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_accounts`
--
ALTER TABLE `customer_accounts`
  ADD CONSTRAINT `customer_accounts_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_accounts_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_accounts_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_expensetype_id_foreign` FOREIGN KEY (`expensetype_id`) REFERENCES `expensetypes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expenses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `incomes`
--
ALTER TABLE `incomes`
  ADD CONSTRAINT `incomes_incometype_id_foreign` FOREIGN KEY (`incometype_id`) REFERENCES `incometypes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `incomes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_loaner_id_foreign` FOREIGN KEY (`loaner_id`) REFERENCES `loaners` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `loans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_caret_id_foreign` FOREIGN KEY (`caret_id`) REFERENCES `carets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_caret_id_foreign` FOREIGN KEY (`caret_id`) REFERENCES `carets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD CONSTRAINT `purchase_details_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_details_caret_id_foreign` FOREIGN KEY (`caret_id`) REFERENCES `carets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_details_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_details_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_details_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_details_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_details_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_details_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  ADD CONSTRAINT `purchase_returns_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchase_return_details`
--
ALTER TABLE `purchase_return_details`
  ADD CONSTRAINT `purchase_return_details_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_return_details_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_return_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_return_details_purchase_detail_id_foreign` FOREIGN KEY (`purchase_detail_id`) REFERENCES `purchase_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_return_details_purchase_return_id_foreign` FOREIGN KEY (`purchase_return_id`) REFERENCES `purchase_returns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_return_details_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_return_details_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_return_details_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `raw_purchases`
--
ALTER TABLE `raw_purchases`
  ADD CONSTRAINT `raw_purchases_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `raw_purchase_details`
--
ALTER TABLE `raw_purchase_details`
  ADD CONSTRAINT `raw_purchase_details_caret_id_foreign` FOREIGN KEY (`caret_id`) REFERENCES `carets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `raw_purchase_details_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `raw_purchase_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `raw_purchase_details_raw_purchase_id_foreign` FOREIGN KEY (`raw_purchase_id`) REFERENCES `raw_purchases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `raw_purchase_details_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `raw_purchase_details_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD CONSTRAINT `sale_details_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_details_caret_id_foreign` FOREIGN KEY (`caret_id`) REFERENCES `carets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_details_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_details_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_details_order_detail_id_foreign` FOREIGN KEY (`order_detail_id`) REFERENCES `order_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_details_purchase_detail_id_foreign` FOREIGN KEY (`purchase_detail_id`) REFERENCES `purchase_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_details_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_details_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_details_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_details_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sale_returns`
--
ALTER TABLE `sale_returns`
  ADD CONSTRAINT `sale_returns_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sale_return_details`
--
ALTER TABLE `sale_return_details`
  ADD CONSTRAINT `sale_return_details_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_return_details_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_return_details_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_return_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_return_details_sale_detail_id_foreign` FOREIGN KEY (`sale_detail_id`) REFERENCES `sale_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_return_details_sale_return_id_foreign` FOREIGN KEY (`sale_return_id`) REFERENCES `sale_returns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_return_details_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_return_details_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supplier_accounts`
--
ALTER TABLE `supplier_accounts`
  ADD CONSTRAINT `supplier_accounts_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_accounts_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `unions`
--
ALTER TABLE `unions`
  ADD CONSTRAINT `unions_upozila_id_foreign` FOREIGN KEY (`upozila_id`) REFERENCES `upozilas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `upozilas`
--
ALTER TABLE `upozilas`
  ADD CONSTRAINT `upozilas_distric_id_foreign` FOREIGN KEY (`distric_id`) REFERENCES `districs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `villages`
--
ALTER TABLE `villages`
  ADD CONSTRAINT `villages_union_id_foreign` FOREIGN KEY (`union_id`) REFERENCES `unions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD CONSTRAINT `warehouses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wastage_returns`
--
ALTER TABLE `wastage_returns`
  ADD CONSTRAINT `wastage_returns_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wastage_returns_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wastage_returns_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wastage_returns_purchase_detail_id_foreign` FOREIGN KEY (`purchase_detail_id`) REFERENCES `purchase_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wastage_returns_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wastage_returns_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wastage_returns_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `worker_accounts`
--
ALTER TABLE `worker_accounts`
  ADD CONSTRAINT `worker_accounts_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `worker_accounts_worker_order_id_foreign` FOREIGN KEY (`worker_order_id`) REFERENCES `worker_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `worker_orders`
--
ALTER TABLE `worker_orders`
  ADD CONSTRAINT `worker_orders_caret_id_foreign` FOREIGN KEY (`caret_id`) REFERENCES `carets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `worker_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `worker_orders_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `worker_order_details`
--
ALTER TABLE `worker_order_details`
  ADD CONSTRAINT `worker_order_details_caret_id_foreign` FOREIGN KEY (`caret_id`) REFERENCES `carets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `worker_order_details_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `worker_order_details_order_detail_id_foreign` FOREIGN KEY (`order_detail_id`) REFERENCES `order_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `worker_order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `worker_order_details_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `worker_order_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `worker_order_details_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `worker_order_details_worker_order_id_foreign` FOREIGN KEY (`worker_order_id`) REFERENCES `worker_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
