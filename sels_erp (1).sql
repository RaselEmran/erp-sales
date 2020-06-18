-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2019 at 10:19 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sels_erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `acc_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `root_acc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `acc_name`, `root_acc`, `created_at`, `updated_at`) VALUES
(1, 'dammy', 'supplier', '2019-03-11 03:23:49', '2019-03-11 05:02:11'),
(2, 'Holly', 'supplier', '2019-03-11 03:24:14', '2019-03-11 03:24:14');

-- --------------------------------------------------------

--
-- Table structure for table `ac_credit_transfers`
--

CREATE TABLE `ac_credit_transfers` (
  `id` int(10) UNSIGNED NOT NULL,
  `ac_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transfer_form` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ac_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `ac_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ac_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `ac_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ac_credit_transfers`
--

INSERT INTO `ac_credit_transfers` (`id`, `ac_name`, `transfer_form`, `ac_number`, `ac_description`, `ac_amount`, `ac_date`, `created_at`, `updated_at`) VALUES
(1, 'A987456D', 'AC01478H', 'NULL', 'Test Mode', '1500', '03/11/2019', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ac_debit_transfers`
--

CREATE TABLE `ac_debit_transfers` (
  `id` int(10) UNSIGNED NOT NULL,
  `ac_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transfer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transfer_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ac_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `ac_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ac_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `ac_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ac_debit_transfers`
--

INSERT INTO `ac_debit_transfers` (`id`, `ac_name`, `transfer_id`, `transfer_to`, `ac_number`, `ac_description`, `ac_amount`, `ac_date`, `created_at`, `updated_at`) VALUES
(1, 'AC01478H', '1', 'A987456D', 'NULL', 'Test Mode', '1500', '03/11/2019', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Admin',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(10) UNSIGNED NOT NULL,
  `b_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ac_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ac_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bc_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `b_name`, `ac_name`, `ac_number`, `bc_name`, `created_at`, `updated_at`) VALUES
(1, 'DDBL', 'AC01478H', '97568423', 'Rajshahi', '2019-03-05 04:45:57', '2019-03-05 04:59:54'),
(2, 'Sonali', 'A987456D', '97568222', 'Rajshahi', '2019-03-11 00:27:28', '2019-03-11 00:27:43');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Electronics', 'electronics', 'Electronics test mode', '2019-02-19 08:27:42', '2019-02-20 04:15:35'),
(3, 'Mobile', 'mobile', 'Mobile test Mode', '2019-02-20 04:28:29', '2019-02-20 04:28:29');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'backend/client/default.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `address`, `phone`, `image`, `created_at`, `updated_at`) VALUES
(2, 'haron', 'no@gmail.com', 'test', '01740390336', 'backend/client/zTnx0X76gO4i7Oo54xZW.jpg', '2019-02-23 07:30:02', '2019-02-23 07:30:02'),
(3, 'Iqbal', 'iqbal@gmail.com', 'Katakali Rajshahi', '0159876324', 'backend/client/fXfE98JrakAfIwA46Jgi.jpg', '2019-03-02 06:58:52', '2019-03-02 06:58:52');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(10) UNSIGNED NOT NULL,
  `purpose` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expense_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vouchar_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `purpose`, `expense_to`, `date`, `vouchar_no`, `amount`, `paid`, `note`, `created_at`, `updated_at`) VALUES
(1, 'Travelling', 'Joot', '03/02/2019', '10015', '500', '500', 'abc', '2019-03-01 23:16:33', '2019-03-01 23:38:01');

-- --------------------------------------------------------

--
-- Table structure for table `lenders`
--

CREATE TABLE `lenders` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lenders`
--

INSERT INTO `lenders` (`id`, `name`, `note`, `created_at`, `updated_at`) VALUES
(1, 'CBANK', 'DFREFH', '2019-03-03 02:52:22', '2019-03-03 03:05:53');

-- --------------------------------------------------------

--
-- Table structure for table `loanees`
--

CREATE TABLE `loanees` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loanees`
--

INSERT INTO `loanees` (`id`, `name`, `note`, `created_at`, `updated_at`) VALUES
(3, 'ASADFGHJK', 'ERTYUIL', '2019-03-03 01:10:50', '2019-03-03 02:37:47');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(10) UNSIGNED NOT NULL,
  `loanee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lendar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `loanee`, `lendar`, `date`, `amount`, `paid`, `note`, `created_at`, `updated_at`) VALUES
(1, '3', '1', '03/03/2019', '2500', '2500', 'Test mode', '2019-03-03 03:08:19', '2019-03-03 03:08:19');

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
(1, '2019_02_19_120401_create_admins_table', 1),
(2, '2019_02_19_125311_create_categories_table', 2),
(3, '2019_02_20_110507_create_products_table', 3),
(4, '2019_02_23_102234_create_suppliers_table', 4),
(5, '2019_02_23_122004_create_clients_table', 5),
(6, '2019_02_24_093048_create_pos_table', 6),
(7, '2019_02_24_114419_create_pos_details_table', 7),
(8, '2019_02_26_103811_create_purchases_table', 8),
(9, '2019_02_26_110010_create_purchase_details_table', 8),
(10, '2019_03_02_044950_create_expenses_table', 9),
(11, '2019_03_03_050843_create_loans_table', 10),
(12, '2019_03_03_054346_create_loans_table', 11),
(13, '2019_03_03_060424_create_loanees_table', 12),
(14, '2019_03_03_060618_create_lenders_table', 12),
(15, '2019_03_05_100824_create_banks_table', 13),
(16, '2019_03_05_120049_create_accounts_table', 14),
(17, '2019_03_11_051303_create_tranfers_table', 15),
(18, '2019_03_11_061536_create_transfers_table', 16),
(19, '2019_03_11_061930_create_transfers_table', 17),
(20, '2019_03_11_063915_create_ac_credit_transfers_table', 18),
(21, '2019_03_11_063957_create_ac_debit_transfers_table', 18),
(22, '2019_03_12_043953_create_payments_table', 19),
(23, '2019_03_13_073350_create_systems_table', 20);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `ac_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `root_acc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loan_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `ac_date`, `description`, `root_acc`, `customer`, `supplier`, `office`, `loan_name`, `mode`, `amount`, `check_num`, `check_date`, `bank_name`, `payment_type`, `created_at`, `updated_at`) VALUES
(1, '03/12/2019', 'test mode', 'customer', 'Hasan', NULL, NULL, NULL, 'check', '2500', '258963', '03/12/2019', 'Sonali', 'payment', '2019-03-11 23:15:00', '2019-03-12 00:04:44'),
(2, '03/12/2019', 'Receipt Mode', 'supplier', NULL, 'haron', NULL, NULL, 'cash', '2000', NULL, NULL, NULL, 'receipt', '2019-03-12 00:40:39', '2019-03-12 00:40:39'),
(3, '03/12/2019', 'Receipt Mode', 'supplier', NULL, 'haron', NULL, NULL, 'cash', '2000', NULL, NULL, NULL, 'receipt', '2019-03-12 00:56:23', '2019-03-12 00:56:23');

-- --------------------------------------------------------

--
-- Table structure for table `pos`
--

CREATE TABLE `pos` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pos_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `net_total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `due` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pos`
--

INSERT INTO `pos` (`id`, `customer_name`, `pos_date`, `sub_total`, `discount`, `net_total`, `paid`, `due`, `status`, `created_at`, `updated_at`) VALUES
(2, '2', '02/11/2019', '700', '0', '700', '700', '0', 'Delivered', NULL, NULL),
(3, '3', '03/02/2019', '75000', '0', '75000', '29500', '75000', 'Order', NULL, NULL),
(4, '3', '03/02/2019', '15350', '300', '15050', '15000', '50', 'Order', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos_details`
--

CREATE TABLE `pos_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `pos_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pos_details`
--

INSERT INTO `pos_details` (`id`, `pos_id`, `product_id`, `product_name`, `qty`, `price`, `created_at`, `updated_at`) VALUES
(2, '2', '1 ', 'Doctor', '2', '350', NULL, NULL),
(4, '4', '2', 'TV', '1', '15000', NULL, NULL),
(5, '4', '1', 'Doctor', '1', '350', NULL, NULL),
(6, '3', '2', 'TV', '2', '15000', NULL, NULL),
(7, '3', '2', 'TV', '3', '15000', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bar_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `category`, `cost`, `price`, `description`, `image`, `bar_code`, `created_at`, `updated_at`) VALUES
(1, '123456', 'Doctor', '3', '250', '350', 'test product', 'backend/product/YZuUncdrpDMd03PjZeEG.jpg', NULL, '2019-02-20 07:18:40', '2019-02-22 10:17:21'),
(2, '123456', 'TV', '1', '10000', '15000', 'Electronic Tv', 'backend/product/kONN8qQhiPc1tDxUeYfz.jpg', NULL, '2019-02-26 04:35:37', '2019-02-26 04:35:37');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(10) UNSIGNED NOT NULL,
  `supplier_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supp_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `supplier_name`, `supp_date`, `total`, `status`, `created_at`, `updated_at`) VALUES
(3, '1', '02/28/2019', '50000', 'Order', NULL, NULL),
(5, '2', '03/02/2019', '24000', 'Order', NULL, NULL),
(6, '1', '03/02/2019', '15000', 'Order', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `invo_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`id`, `invo_id`, `product_id`, `product_name`, `qty`, `price`, `created_at`, `updated_at`) VALUES
(4, '3', '2', 'TV', '5', '10000', NULL, NULL),
(6, '5', '2', 'TV', '3', '8000', NULL, NULL),
(7, '6', '1', 'Doctor', '5', '3000', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `email`, `phone`, `address`, `image`, `created_at`, `updated_at`) VALUES
(1, 'haron', 'no@gmail.com', '01554239714', 'Rajshahi', 'backend/supplier/2IXMsQBpIJUcgRGqy7ZN.jpg', '2019-02-26 02:20:03', '2019-02-26 02:20:03'),
(2, 'Abdulla Al Amran', 'alamranice47ru@gmail.com', '01554239714', 'Naogaon', 'backend/supplier/kkaTYno4kSEeb8NuysIv.png', '2019-03-02 03:21:31', '2019-03-02 03:21:31');

-- --------------------------------------------------------

--
-- Table structure for table `systems`
--

CREATE TABLE `systems` (
  `id` int(10) UNSIGNED NOT NULL,
  `system_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fotter_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `systems`
--

INSERT INTO `systems` (`id`, `system_name`, `title`, `fotter_text`, `login_title`, `image`, `created_at`, `updated_at`) VALUES
(1, 'SELLS::ERP', 'CodeNet Inventory Manager', '2019 © stock manager by SATT IT.', 'Admin Login', 'backend/setting/myUYo0YFN9XZM0UhdrIn.png', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ac_credit_transfers`
--
ALTER TABLE `ac_credit_transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ac_debit_transfers`
--
ALTER TABLE `ac_debit_transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lenders`
--
ALTER TABLE `lenders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loanees`
--
ALTER TABLE `loanees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos`
--
ALTER TABLE `pos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_details`
--
ALTER TABLE `pos_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `systems`
--
ALTER TABLE `systems`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ac_credit_transfers`
--
ALTER TABLE `ac_credit_transfers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ac_debit_transfers`
--
ALTER TABLE `ac_debit_transfers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lenders`
--
ALTER TABLE `lenders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loanees`
--
ALTER TABLE `loanees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pos`
--
ALTER TABLE `pos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pos_details`
--
ALTER TABLE `pos_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `systems`
--
ALTER TABLE `systems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
