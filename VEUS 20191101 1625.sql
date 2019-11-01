-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.7.27-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema veus
--

CREATE DATABASE IF NOT EXISTS veus;
USE veus;

--
-- Definition of table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`,`migration`,`batch`) VALUES 
 (1,'2014_10_12_000000_create_users_table',1),
 (2,'2014_10_12_100000_create_password_resets_table',1),
 (3,'2019_10_31_222152_create_product_table',1),
 (4,'2019_11_01_142701_adds_api_token_to_users_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


--
-- Definition of table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;


--
-- Definition of table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`id`,`created_at`,`updated_at`,`name`,`brand`,`price`,`stock`,`deleted_at`) VALUES 
 (1,'2019-11-01 14:12:29','2019-11-01 14:12:29','Ceasar Ferry','Sauer Group','100.00',737,NULL),
 (2,'2019-11-01 14:12:29','2019-11-01 14:12:29','Mr. Kareem Schmeler','Abbott, Mueller and Roberts','101.00',769,NULL),
 (3,'2019-11-01 14:12:29','2019-11-01 14:12:29','Luther Turner','Feest, Prosacco and Bartell','102.00',135,NULL),
 (4,'2019-11-01 14:12:29','2019-11-01 14:12:29','Isabel Morar DDS','Greenholt Group','103.00',195,NULL),
 (5,'2019-11-01 14:12:29','2019-11-01 14:12:29','Prof. Perry Kiehn MD','Fay-Boyer','104.00',912,NULL),
 (6,'2019-11-01 14:12:29','2019-11-01 14:12:29','Cathy Haag','Macejkovic Group','105.00',776,NULL),
 (7,'2019-11-01 14:12:29','2019-11-01 14:12:29','Prof. Brenna Nolan','Hartmann, Morar and Sanford','106.00',102,NULL),
 (8,'2019-11-01 14:12:29','2019-11-01 14:12:29','Mr. Paxton Greenfelder V','Jerde-Marks','107.00',855,NULL),
 (9,'2019-11-01 14:12:30','2019-11-01 14:12:30','Jeanne Will','Crona, Morissette and Toy','108.00',344,NULL),
 (10,'2019-11-01 14:12:30','2019-11-01 14:12:30','Ryley Hahn','Crona, Koch and McLaughlin','109.00',706,NULL),
 (11,'2019-11-01 14:12:30','2019-11-01 14:12:30','Rosella Bergnaum','Grant PLC','110.00',792,NULL),
 (12,'2019-11-01 14:12:30','2019-11-01 14:12:30','Constantin Little','Cummings, Hyatt and Bauch','111.00',412,NULL),
 (13,'2019-11-01 14:12:30','2019-11-01 14:12:30','Dewitt Smith','Berge-VonRueden','112.00',104,NULL),
 (14,'2019-11-01 14:12:30','2019-11-01 14:12:30','Ms. Dariana Stracke Jr.','Block, Reynolds and Gleichner','113.00',829,NULL),
 (15,'2019-11-01 14:12:30','2019-11-01 14:12:30','Filomena Barton','Gerlach-Kuhic','114.00',604,NULL),
 (16,'2019-11-01 14:12:30','2019-11-01 14:12:30','Wilfredo D\'Amore','Will-Kub','115.00',922,NULL),
 (17,'2019-11-01 14:12:30','2019-11-01 14:12:30','Karl Beier V','Bernier-Boehm','116.00',121,NULL),
 (18,'2019-11-01 14:12:30','2019-11-01 14:12:30','Terence Leannon','Hoeger-Emmerich','117.00',18,NULL),
 (19,'2019-11-01 14:12:30','2019-11-01 14:12:30','Prof. Jessy Kuvalis','Ullrich-Pollich','118.00',736,NULL),
 (20,'2019-11-01 14:12:30','2019-11-01 14:12:30','Evie McDermott','Sipes, Murray and Haag','119.00',922,NULL),
 (21,'2019-11-01 14:12:30','2019-11-01 14:12:30','Hilda Langosh','Sauer Inc','120.00',355,NULL),
 (22,'2019-11-01 14:12:30','2019-11-01 14:12:30','Geo Batz','Gutmann, Gaylord and O\'Kon','121.00',388,NULL),
 (23,'2019-11-01 14:12:30','2019-11-01 14:12:30','Ms. Maude Hyatt DDS','Carroll, Larson and Lebsack','122.00',248,NULL),
 (24,'2019-11-01 14:12:30','2019-11-01 14:12:30','Tyler Crist','Herzog-Armstrong','123.00',655,NULL),
 (25,'2019-11-01 14:12:30','2019-11-01 14:12:30','Bianka Waters IV','Cruickshank and Sons','124.00',378,NULL),
 (26,'2019-11-01 14:12:30','2019-11-01 14:12:30','Cary Windler','Schulist Group','125.00',267,NULL),
 (27,'2019-11-01 14:12:30','2019-11-01 14:12:30','Filomena Tremblay','Balistreri, Morar and Hartmann','126.00',268,NULL),
 (28,'2019-11-01 14:12:30','2019-11-01 14:12:30','Prof. Demarcus Mayer V','Walsh and Sons','127.00',542,NULL),
 (29,'2019-11-01 14:12:30','2019-11-01 14:12:30','Darron Considine','Auer-Kutch','128.00',568,NULL),
 (30,'2019-11-01 14:12:30','2019-11-01 14:12:30','Prof. Frieda Wyman','Tillman-Balistreri','129.00',877,NULL),
 (31,'2019-11-01 14:12:30','2019-11-01 14:12:30','Dalton Bauch','Howe Group','130.00',97,NULL),
 (32,'2019-11-01 14:12:30','2019-11-01 14:12:30','Gabrielle O\'Reilly','Cole, Hoeger and Feil','131.00',778,NULL),
 (33,'2019-11-01 14:12:30','2019-11-01 14:12:30','Joan Keebler','Corwin PLC','132.00',776,NULL),
 (34,'2019-11-01 14:12:30','2019-11-01 14:12:30','Mrs. Abbey Murazik V','Yundt, Gutkowski and Schiller','133.00',494,NULL),
 (35,'2019-11-01 14:12:30','2019-11-01 14:12:30','Donald O\'Reilly Sr.','Hegmann, Huels and McClure','134.00',860,NULL),
 (36,'2019-11-01 14:12:31','2019-11-01 14:12:31','Shyann Runte','Rodriguez-Prosacco','135.00',150,NULL),
 (37,'2019-11-01 14:12:31','2019-11-01 14:12:31','Dominique Kerluke PhD','Hamill PLC','136.00',277,NULL),
 (38,'2019-11-01 14:12:31','2019-11-01 14:12:31','Jeremie Tillman PhD','Runte, Price and Smith','137.00',307,NULL),
 (39,'2019-11-01 14:12:31','2019-11-01 14:12:31','Dejuan Mills PhD','Kuvalis and Sons','138.00',33,NULL),
 (40,'2019-11-01 14:12:31','2019-11-01 14:12:31','Alexandrea Kuhic','Buckridge, Dickens and Kuhic','139.00',192,NULL),
 (41,'2019-11-01 14:12:31','2019-11-01 14:12:31','Eldora Mertz I','Schoen Ltd','140.00',120,NULL),
 (42,'2019-11-01 14:12:31','2019-11-01 14:12:31','Mr. Robb Raynor DVM','Marquardt, Krajcik and Ullrich','141.00',274,NULL),
 (43,'2019-11-01 14:12:31','2019-11-01 14:12:31','Kristian Schoen','Cruickshank, Goyette and Dickinson','142.00',466,NULL),
 (44,'2019-11-01 14:12:31','2019-11-01 14:12:31','Gabriella Aufderhar','Dickens, Cummings and Lehner','143.00',727,NULL),
 (45,'2019-11-01 14:12:31','2019-11-01 14:12:31','Cleta Erdman','DuBuque-Kuhlman','144.00',263,NULL),
 (46,'2019-11-01 14:12:31','2019-11-01 14:12:31','Justus Gislason','Tremblay, O\'Hara and White','145.00',95,NULL),
 (47,'2019-11-01 14:12:31','2019-11-01 14:12:31','Della Kirlin DVM','Lynch, O\'Reilly and Walter','146.00',532,NULL),
 (48,'2019-11-01 14:12:31','2019-11-01 14:12:31','Mr. Olaf Schuster III','Kuphal-Dickinson','147.00',712,NULL),
 (49,'2019-11-01 14:12:31','2019-11-01 14:12:31','Dr. Finn Lebsack IV','King, Terry and Hickle','148.00',1,NULL),
 (50,'2019-11-01 14:12:31','2019-11-01 14:12:31','Tara Gorczany','Bode, Hackett and Leffler','149.00',520,NULL),
 (51,'2019-11-01 15:20:02','2019-11-01 15:20:02','Seringa','BUNDZ','100.23',100,NULL);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;


--
-- Definition of table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `api_token` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_api_token_unique` (`api_token`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`api_token`) VALUES 
 (2,'John','john.doe@toptal.com',NULL,'$2y$10$ajrW5erADhWZGT7SiyVnwO/a1Zxrxr9l3DbbhkxvhFDs0zsrykkra',NULL,'2019-11-01 14:41:34','2019-11-01 14:41:34','O2NLtry47wT6JWuut3RC89L0O9UJKPXUyyDak1WaGvPDKE65DrVwqUXFVhCy'),
 (3,'Thiago','thiago_spdvr@hotmail.com',NULL,'$2y$10$wcwl5Ux/.Nxtxi5hIEaD/OdNmFkkoBCq85UCasXXXPdHv9rAjV6Ru',NULL,'2019-11-01 14:44:58','2019-11-01 14:58:48','tSr5IxMJ6jzVZygDFrssYVqSVtPmBgLt6uoZqzXNJCiLxIBaAYdhORsQH99u');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
