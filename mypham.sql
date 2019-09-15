-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2019 at 10:57 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mypham`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_parent` int(11) NOT NULL DEFAULT '0',
  `id_parent` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `is_parent`, `id_parent`, `created_at`, `updated_at`) VALUES
(1, 'Chăm sóc mặt', 1, NULL, NULL, NULL),
(2, 'Chăm sóc tóc', 1, NULL, NULL, NULL),
(3, 'Sữa rửa mặt', 0, 1, NULL, NULL),
(4, 'Nước tẩy trang', 0, 1, NULL, NULL),
(5, 'test', 1, 2, '2019-09-08 10:00:45', '2019-09-08 10:00:45');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_product` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, '2019_08_25_034825_create_contacts_table', 1),
(4, '2019_08_25_034852_create_comments_table', 1),
(5, '2019_08_25_034957_create_orders_table', 1),
(6, '2019_08_25_035322_create_order_details_table', 1),
(7, '2019_08_25_035432_create_products_table', 1),
(8, '2019_08_25_035520_create_categories_table', 1),
(9, '2019_09_15_054437_create_users_table', 2),
(10, '2019_09_15_054744_create_roles_table', 2),
(11, '2019_09_15_063146_create_permissions_table', 2),
(12, '2019_09_15_063228_create_role_permissions_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `status` int(11) NOT NULL,
  `id_payment` bigint(20) NOT NULL,
  `status_payment` int(11) NOT NULL,
  `amount` double NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `id_user`, `status`, `id_payment`, `status_payment`, `amount`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 1, 0, 12322, NULL, '2019-09-14 17:00:00', '2019-09-15 01:36:02'),
(2, 1, 1, 1, 0, 1235000, NULL, '2019-09-14 17:00:00', '2019-09-14 17:00:00'),
(3, 1, 2, 1, 0, 333200, NULL, '2019-09-14 17:00:00', '2019-09-14 17:00:00'),
(4, 1, 0, 1, 0, 1235000, NULL, '2019-09-14 17:00:00', '2019-09-14 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_order` bigint(20) NOT NULL,
  `id_product` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `id_order`, `id_product`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 111000, '2019-09-14 17:00:00', '2019-09-14 17:00:00'),
(2, 1, 3, 1, 111000, '2019-09-14 17:00:00', '2019-09-14 17:00:00');

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_category` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `shipping_quantity` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `id_category`, `name`, `description`, `detail`, `image`, `price`, `quantity`, `shipping_quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', '', 1100.00, 10, 2, '2019-09-13 17:00:00', '2019-09-13 17:00:00'),
(2, 2, 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', '', 1100.00, 10, 2, '2019-09-13 17:00:00', '2019-09-13 17:00:00'),
(3, 1, 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', '', 1100.00, 10, 2, '2019-09-13 17:00:00', '2019-09-13 17:00:00'),
(4, 2, 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', '', 1100.00, 10, 2, '2019-09-13 17:00:00', '2019-09-13 17:00:00'),
(5, 3, 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', '', 1100.00, 10, 2, '2019-09-13 17:00:00', '2019-09-13 17:00:00'),
(6, 2, 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', '', 1100.00, 10, 2, '2019-09-13 17:00:00', '2019-09-13 17:00:00'),
(7, 1, 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', '', 1100.00, 10, 2, '2019-09-13 17:00:00', '2019-09-13 17:00:00'),
(8, 2, 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', '', 1100.00, 10, 2, '2019-09-13 17:00:00', '2019-09-13 17:00:00'),
(9, 1, 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', '', 1100.00, 10, 2, '2019-09-13 17:00:00', '2019-09-13 17:00:00'),
(10, 2, 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', '', 1100.00, 10, 2, '2019-09-13 17:00:00', '2019-09-13 17:00:00'),
(11, 1, 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', '', 1100.00, 10, 2, '2019-09-13 17:00:00', '2019-09-13 17:00:00'),
(12, 2, 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', '', 1100.00, 10, 2, '2019-09-13 17:00:00', '2019-09-13 17:00:00'),
(13, 3, 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', '', 1100.00, 10, 2, '2019-09-13 17:00:00', '2019-09-13 17:00:00'),
(14, 2, 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', '', 1100.00, 10, 2, '2019-09-13 17:00:00', '2019-09-13 17:00:00'),
(15, 1, 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', 'Bộ chăm sóc da chiết xuất đậu xanh Coreana Senite', '', 1100.00, 10, 2, '2019-09-13 17:00:00', '2019-09-13 17:00:00'),
(21, 2, 'sản phẩm test', 'mô tả sản phẩm', '<p>demo</p>', '1568523321_65878552_357254594961413_844028135283359744_n.jpg', 320000.00, 23, 0, '2019-09-14 21:30:29', '2019-09-14 21:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `decreption` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_role` int(10) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `token`, `name`, `phone`, `address`, `avatar`, `id_role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'superadmin@gmail.com', '$2y$10$Be1cRxJn/G6vTynU69cxsekJ3rAXAQTaVtv6ZbqIybmv1c9.83xGC', NULL, 'Super Admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
