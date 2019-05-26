CREATE DATABASE IF NOT EXISTS `backend_test`;
CREATE DATABASE IF NOT EXISTS `backend`;

USE `backend`;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `amount` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_name_brand_unique` (`name`,`brand`),
  KEY `products_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_api_token_unique` (`api_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `migrations` (`id`,`migration`,`batch`) VALUES (1,'2019_05_25_160442_create_products_table',1);
INSERT INTO `migrations` (`id`,`migration`,`batch`) VALUES (2,'2019_05_25_212110_create_users_table',2);

INSERT INTO `users` (`id`,`name`,`email`,`password`,`api_token`,`created_at`,`updated_at`) VALUES (1,'Daniel Satiro','daniel@satiro.me','$2y$10$IGcZSkr.xFKok.K9oSid6uZoxN9jtdIl5qVlaiCG3aWNOCGA3hkja','e4f0c0894b950863beb72842d5408292a143ce07ed7b5362ac9197a009afb29e','2019-05-25 23:45:05','2019-05-26 00:06:40');

INSERT INTO `products` (`id`,`name`,`brand`,`price`,`amount`,`created_at`,`updated_at`) VALUES (1,'Seringa','BUNZL',10.00,50,'2019-05-25 18:28:38','2019-05-25 18:28:38');
INSERT INTO `products` (`id`,`name`,`brand`,`price`,`amount`,`created_at`,`updated_at`) VALUES (2,'Trimedal','NOVARTIS',30.00,50,'2019-05-25 20:04:29','2019-05-25 20:04:29');
INSERT INTO `products` (`id`,`name`,`brand`,`price`,`amount`,`created_at`,`updated_at`) VALUES (3,'Targus','BAGÓ',100.00,50,'2019-05-25 20:05:16','2019-05-25 20:05:50');


USE `backend_test`;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `amount` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_name_brand_unique` (`name`,`brand`),
  KEY `products_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_api_token_unique` (`api_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `migrations` (`id`,`migration`,`batch`) VALUES (1,'2019_05_25_160442_create_products_table',1);
INSERT INTO `migrations` (`id`,`migration`,`batch`) VALUES (2,'2019_05_25_212110_create_users_table',2);

INSERT INTO `users` (`id`,`name`,`email`,`password`,`api_token`,`created_at`,`updated_at`) VALUES (1,'Daniel Satiro','daniel@satiro.me','$2y$10$IGcZSkr.xFKok.K9oSid6uZoxN9jtdIl5qVlaiCG3aWNOCGA3hkja','e4f0c0894b950863beb72842d5408292a143ce07ed7b5362ac9197a009afb29e','2019-05-25 23:45:05','2019-05-26 00:06:40');

INSERT INTO `products` (`id`,`name`,`brand`,`price`,`amount`,`created_at`,`updated_at`) VALUES (1,'Seringa','BUNZL',10.00,50,'2019-05-25 18:28:38','2019-05-25 18:28:38');
INSERT INTO `products` (`id`,`name`,`brand`,`price`,`amount`,`created_at`,`updated_at`) VALUES (2,'Trimedal','NOVARTIS',30.00,50,'2019-05-25 20:04:29','2019-05-25 20:04:29');
INSERT INTO `products` (`id`,`name`,`brand`,`price`,`amount`,`created_at`,`updated_at`) VALUES (3,'Targus','BAGÓ',100.00,50,'2019-05-25 20:05:16','2019-05-25 20:05:50');
