-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 30, 2023 at 11:37 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `samudra_kue`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `productID` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `price_subtotal` decimal(8,2) NOT NULL,
  `chosen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `userID`, `productID`, `qty`, `price_subtotal`, `chosen`, `created_at`, `updated_at`) VALUES
(6, 4, 2, 5, '107750.00', 0, '2023-10-14 09:58:12', '2023-10-25 02:09:51'),
(7, 4, 3, 2, '26500.00', 0, '2023-10-19 05:06:21', '2023-10-25 06:22:17');

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
(1, '2014_10_12_0000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_02_143542_create_products_table', 1),
(6, '2023_10_02_144219_create_product_images_table', 1),
(7, '2023_10_02_144800_create_cart_items_table', 1),
(8, '2023_10_02_145510_create_shipping_address_table', 1),
(9, '2023_10_02_145531_create_orders_table', 1),
(10, '2023_10_02_150109_create_order_items_table', 1),
(11, '2023_10_07_062956_create_roles_table', 1),
(12, '2023_10_19_144813_add_user_id_to_shipping_address', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `addressID` bigint(20) UNSIGNED NOT NULL,
  `order_date` datetime NOT NULL,
  `payment_total` decimal(8,2) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_notes` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userID`, `addressID`, `order_date`, `payment_total`, `payment_method`, `payment_status`, `order_status`, `add_notes`, `created_at`, `updated_at`) VALUES
(1, 4, 3, '2023-10-25 00:00:00', '146700.00', 'bank_transfer', '0', '1', NULL, '2023-10-25 02:19:49', '2023-10-28 08:20:02'),
(2, 4, 3, '2023-10-25 00:00:00', '146700.00', 'qris_code', '0', '0', 'hehe', '2023-10-25 06:22:27', '2023-10-25 06:22:27'),
(3, 4, 3, '2023-10-25 00:00:00', '206700.00', 'cash_on_delivery', '0', '0', NULL, '2023-10-25 06:30:29', '2023-10-25 06:30:29');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `orderID` bigint(20) UNSIGNED NOT NULL,
  `productID` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `orderID`, `productID`, `price`, `qty`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '12450.00', 1, '2023-10-25 02:19:49', '2023-10-25 02:19:49'),
(2, 1, 2, '107750.00', 5, '2023-10-25 02:19:49', '2023-10-25 02:19:49'),
(3, 2, 1, '12450.00', 1, '2023-10-25 06:22:27', '2023-10-25 06:22:27'),
(4, 2, 2, '107750.00', 5, '2023-10-25 06:22:27', '2023-10-25 06:22:27'),
(5, 2, 3, '26500.00', 2, '2023-10-25 06:22:27', '2023-10-25 06:22:27'),
(6, 3, 1, '12450.00', 1, '2023-10-25 06:30:29', '2023-10-25 06:30:29'),
(7, 3, 10, '60000.00', 5, '2023-10-25 06:30:29', '2023-10-25 06:30:29');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `phone_number` bigint(20) NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `stocks` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `stocks`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Gery Chocolatos Wafer Roll 24 pcs/box', '12450.00', 20, 'Gery Chocolatos Pack 24 pcs/box adalah camilan wafer yang sangat dicari dan disukai oleh banyak orang di seluruh dunia. Dengan 24 gulungan wafer dalam setiap kotak, produk ini memberikan porsi yang cukup besar untuk dinikmati sendiri, bersama teman, atau sebagai bagian dari makanan penutup dalam berbagai kesempatan.\r\nSetiap gulungan wafer dalam Gery Chocolatos Pack memiliki bentuk silinder yang panjang dan tipis. Kualitas wafernya yang renyah dan rapuh menjadikannya pilihan yang sangat nikmat. Di dalam setiap gulungan, terdapat lapisan cokelat yang lezat. Lapisan cokelat ini dapat bervariasi dalam rasa, dengan beberapa varian mencakup dark chocolate, milk chocolate, atau cokelat putih. Hal ini memberikan kesempatan bagi setiap orang untuk memilih varian yang sesuai dengan preferensi rasa mereka.\r\nGery Chocolatos Pack 24 pcs/box dikemas dengan cermat dalam sebuah kotak yang menarik dan kokoh. Kotak ini adalah wadah yang ideal untuk menjaga kesegaran produk, sehingga Anda selalu bisa menikmati wafer dalam kondisi terbaik. Desain kemasan biasanya mencerminkan merek Gery dengan logo yang mencolok dan gambar produk yang menggoda. Kemasan juga mencantumkan informasi nutrisi dan tanggal kedaluwarsa yang penting.', NULL, NULL),
(2, 'Wafer Coklat Delfi TOP 24 pcs/box ', '21550.00', 20, 'Wafer Coklat Delfi TOP Box [9gr x 24pcs] adalah produk makanan ringan yang terdiri dari 24 gulungan wafer kecil dengan lapisan cokelat. Ini adalah salah satu produk dari merek Delfi yang dikenal karena cokelat dan makanan ringan berkualitas.', NULL, NULL),
(3, 'Superstar Wafer 12 pcs/box ', '13250.00', 20, 'Superstar Wafer Box 12pcs x 18gr adalah produk makanan ringan yang terdiri dari 12 gulungan wafer dengan berat masing-masing sekitar 18 gram per gulungan. Ini adalah produk wafer yang dapat dinikmati sebagai camilan ringan atau sebagai makanan penutup.', NULL, NULL),
(4, 'Roma Slai O\'lai Rasa Strawberry 10 pcs/box', '19400.00', 20, 'Roma Slai O\'lai Rasa Strawberry 320 g, dengan isi 10 pcs per box, adalah salah satu varian dari produk makanan ringan yang populer dari merek Roma.', NULL, NULL),
(5, 'Chitato Rasa Sapi Panggang 60gr', '8000.00', 50, 'Chitato adalah merek keripik kentang yang terkenal di Indonesia. Keripik ini memiliki rasa yang gurih dan renyah. Rasa sapi panggang', '2023-10-12 08:36:33', '2023-10-12 08:36:33'),
(6, 'Tango Wafer Rasa Vanilla', '10000.00', 50, 'Tango adalah wafer renyah dengan rasa vanilla', '2023-10-12 08:36:33', '2023-10-12 08:36:33'),
(7, 'Oreo Wafer Roll 10pcs / box', '15000.00', 20, 'Wafer roll berisi krim vanilla yang manis dan renyah.', '2023-10-12 08:40:50', '2023-10-12 08:40:50'),
(8, 'Oreo Softcake 12pcs/box', '24000.00', 20, 'Bolu oreo dengan krim vanilla ditengah-tengahnya, rasanya manis dan lembut', '2023-10-12 08:40:50', '2023-10-12 08:40:50'),
(9, 'Choki Choki 5 pcs/bungkus', '5000.00', 50, 'Cokelat cair yang dikemas dalam bentuk stik, rasa cokelat yang manis dan lembut.', '2023-10-12 08:40:50', '2023-10-12 08:40:50'),
(10, 'Keripik Kentang Taro rasa Barbeque pcs', '12000.00', 50, 'Keripik kentang berbentuk kotak dengan bumbu rasa barbeque yang enak dan gurih', '2023-10-12 08:40:50', '2023-10-12 08:40:50'),
(14, 'tes', '11111.00', 11, 'yes', '2023-10-29 08:23:20', '2023-10-29 08:23:20');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productID` bigint(20) UNSIGNED NOT NULL,
  `picture_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `productID`, `picture_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'pic-1-1.jpg', NULL, NULL),
(2, 1, 'pic-1-2.jpg', NULL, NULL),
(3, 1, 'pic-1-3.jpg', NULL, NULL),
(4, 2, 'pic-2-1.jpg', NULL, NULL),
(6, 14, 'product_images/nDYNzQiItqs5AArYViV6OlzQnzGBxr0t0jA2Jj4G.jpg', '2023-10-29 08:23:20', '2023-10-29 08:23:20');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_addresses`
--

CREATE TABLE `shipping_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelurahan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_addresses`
--

INSERT INTO `shipping_addresses` (`id`, `province`, `city`, `kecamatan`, `kelurahan`, `address`, `postal_code`, `created_at`, `updated_at`, `userID`) VALUES
(3, 'Jawa Barat', 'Banjar', 'Banjar', 'kelurahan', 'jl sekian no 00', '12345', '2023-10-19 10:54:37', '2023-10-19 10:54:37', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `number_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `full_name`, `phone_number`, `number_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'pelanggan1', 'pelanggan1', 811223344556, '2023-10-12 09:24:30', '$2y$10$QUSPr1lqu2gWYQKp8FD2MewgJB.SIFqJ8XBuNxb4SruxKeNmEgOlu', 0, NULL, '2023-10-12 02:19:42', '2023-10-12 02:19:42'),
(4, 'pelanggan2', 'pelanggan2', 811223344557, NULL, '$2y$10$nUAnDl1WPuHOXqpeS7blxuYHmKgg0EB86QaxVUXKotM0UaBYnabxK', 0, NULL, '2023-10-14 08:40:26', '2023-10-14 08:40:26'),
(5, 'admin1', 'admin1', 88877665544, NULL, '$2y$10$KfEepYL0uurwbiZjRjEFcu7EswHIfGcNrfqmOV3N2bDOSuzlimfSK', 1, NULL, '2023-10-27 06:09:32', '2023-10-27 06:09:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_userid_foreign` (`userID`),
  ADD KEY `cart_items_productid_foreign` (`productID`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_userid_foreign` (`userID`),
  ADD KEY `orders_addressid_foreign` (`addressID`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_orderid_foreign` (`orderID`),
  ADD KEY `order_items_productid_foreign` (`productID`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_phone_number_index` (`phone_number`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_productid_foreign` (`productID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipping_addresses_userid_foreign` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_phone_number_unique` (`phone_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_productid_foreign` FOREIGN KEY (`productID`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_items_userid_foreign` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_addressid_foreign` FOREIGN KEY (`addressID`) REFERENCES `shipping_addresses` (`id`),
  ADD CONSTRAINT `orders_userid_foreign` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_orderid_foreign` FOREIGN KEY (`orderID`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_productid_foreign` FOREIGN KEY (`productID`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_productid_foreign` FOREIGN KEY (`productID`) REFERENCES `products` (`id`);

--
-- Constraints for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  ADD CONSTRAINT `shipping_addresses_userid_foreign` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
