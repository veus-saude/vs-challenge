-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Out-2020 às 22:19
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `veus_project`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `brands`
--

INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'BUNZL', 1, '2020-10-26 11:44:34', '2020-10-26 11:44:38'),
(2, 'DESCARPACK 14', 1, '2020-10-26 11:44:35', '2020-10-26 11:44:39'),
(3, 'BD21', 1, '2020-10-26 11:44:37', '2020-10-26 11:44:39'),
(5, 'MEDINJECT', 1, '2020-10-27 03:12:29', '2020-10-27 03:15:28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `carts`
--

CREATE TABLE `carts` (
  `id` int(10) UNSIGNED NOT NULL,
  `product` int(10) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Luiz Felipe', 'luizfelipe31@gmail.com', 'Modos de pagamento', 'Quais são as formas de pagamento disponíveis?', '2020-10-26 01:06:04', '2020-10-26 01:06:04');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2020_10_25_190553_create_contact_table', 2),
(4, '2020_10_25_195851_create_contacts_table', 3),
(6, '2014_10_12_000000_create_users_table', 4),
(7, '2014_10_12_100000_create_password_resets_table', 4),
(8, '2020_10_25_210014_create_contacts_table', 5),
(9, '2020_10_25_220155_create_contacts_table', 6),
(10, '2020_10_26_083810_create_brands_table', 7),
(11, '2020_10_26_085530_create_products_table', 8),
(12, '2020_10_26_103058_create_products_table', 9),
(13, '2020_10_27_042050_create_carts_table', 10),
(14, '2020_10_27_055202_create_sales_table', 11),
(15, '2020_10_27_062706_create_sales_table', 12),
(16, '2020_10_27_063118_create_sales_table', 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` int(10) UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `name`, `brand`, `price`, `stock`, `photo`, `status`, `created_at`, `updated_at`) VALUES
(13, 'Seringa', 1, '2.80', 23, 'products/ZQTfR9aM4GcWczFFEGayTYW6VkPtAqITdnmA4byZ.jpeg', 1, '2020-10-27 12:43:58', '2020-10-28 21:17:51');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `product` int(10) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `payment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `document`, `status`, `admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Veus', 'veus@domain.com', '$2y$10$m40aZRixEG8dprLQ5.a0Pe.aVd.CN4jjUAr38l2V70dWVQ6gKPvcS', '00000000000', 1, 1, 'B7vUv6EsosVENIk3p8K1XIOLIP93PcfEE3KcXeX2yT7sUwMPJTcngsGbnmRz', '2020-10-25 23:25:36', '2020-10-27 12:34:47'),
(2, 'Luiz Felipe', 'luizfelipe31@gmail.com', '$2y$10$78ge326zDs7i.Fn.LYVvPOB6PLiG17mewfW1BbQi7O/NqCwHJC86q', '11111111111', 1, 0, 'l8iBXxjHjjSLWO9m99WXUlXain4yH5gDKv0P6zrS4MreZlvEZ8yavLOXD8Hk', '2020-10-25 23:27:39', '2020-10-25 23:27:39');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_document_unique` (`document`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
