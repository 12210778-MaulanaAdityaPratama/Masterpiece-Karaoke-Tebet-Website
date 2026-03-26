/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.8.3-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: masterpiece_karaoke
-- ------------------------------------------------------
-- Server version	11.8.3-MariaDB-0+deb13u1 from Debian

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `fnb_categories`
--

DROP TABLE IF EXISTS `fnb_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `fnb_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fnb_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fnb_categories`
--

LOCK TABLES `fnb_categories` WRITE;
/*!40000 ALTER TABLE `fnb_categories` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `fnb_categories` VALUES
(1,'Minuman','minuman','🥤',1,1,'2026-03-04 11:05:24','2026-03-04 11:05:24'),
(2,'Makanan Berat','makanan-berat','🍱',1,2,'2026-03-04 11:05:24','2026-03-04 11:05:24'),
(3,'Snack & Cemilan','snack-cemilan','🍟',1,3,'2026-03-04 11:05:24','2026-03-04 11:05:24'),
(4,'Dessert','dessert','🍰',1,4,'2026-03-04 11:05:24','2026-03-04 11:05:24');
/*!40000 ALTER TABLE `fnb_categories` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `fnb_items`
--

DROP TABLE IF EXISTS `fnb_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `fnb_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fnb_category_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `badge` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fnb_items_fnb_category_id_foreign` (`fnb_category_id`),
  CONSTRAINT `fnb_items_fnb_category_id_foreign` FOREIGN KEY (`fnb_category_id`) REFERENCES `fnb_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fnb_items`
--

LOCK TABLES `fnb_items` WRITE;
/*!40000 ALTER TABLE `fnb_items` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `fnb_items` VALUES
(1,1,'Es Teh Manis',NULL,12000.00,NULL,1,NULL,1,'2026-03-04 11:05:24','2026-03-04 11:05:24'),
(2,1,'Es Jeruk',NULL,15000.00,NULL,1,NULL,2,'2026-03-04 11:05:24','2026-03-04 11:05:24'),
(3,1,'Jus Alpukat',NULL,22000.00,NULL,1,'Recommended',3,'2026-03-04 11:05:24','2026-03-04 11:05:24'),
(4,1,'Jus Mangga',NULL,20000.00,NULL,1,NULL,4,'2026-03-04 11:05:24','2026-03-04 11:05:24'),
(5,1,'Pitcher Juice Mix',NULL,65000.00,NULL,1,'Best Seller',5,'2026-03-04 11:05:24','2026-03-04 11:05:24'),
(6,1,'Air Mineral',NULL,8000.00,NULL,1,NULL,6,'2026-03-04 11:05:24','2026-03-04 11:05:24'),
(7,1,'Soft Drink (Kaleng)',NULL,15000.00,NULL,1,NULL,7,'2026-03-04 11:05:24','2026-03-04 11:05:24'),
(8,1,'Ice Lemon Tea',NULL,18000.00,NULL,1,'Favorit',8,'2026-03-04 11:05:24','2026-03-04 11:05:24'),
(9,1,'Orange Juice',NULL,20000.00,NULL,1,NULL,9,'2026-03-04 11:05:24','2026-03-04 11:05:24'),
(10,2,'Nasi Goreng Spesial',NULL,35000.00,NULL,1,'Best Seller',1,'2026-03-04 11:05:24','2026-03-04 11:05:24'),
(11,2,'Mie Goreng Spesial',NULL,30000.00,NULL,1,NULL,2,'2026-03-04 11:05:24','2026-03-04 11:05:24'),
(12,2,'Nasi Ayam Geprek',NULL,32000.00,NULL,1,'Spicy 🌶',3,'2026-03-04 11:05:24','2026-03-04 11:05:24'),
(13,2,'Indomie Goreng Telur',NULL,18000.00,NULL,1,NULL,4,'2026-03-04 11:05:24','2026-03-04 11:05:24'),
(14,2,'Paket Nasi + Lauk',NULL,40000.00,NULL,1,'Recommended',5,'2026-03-04 11:05:24','2026-03-04 11:05:24'),
(15,3,'French Fries',NULL,22000.00,NULL,1,'Favorit',1,'2026-03-04 11:05:24','2026-03-04 11:05:24'),
(16,3,'Chicken Pop',NULL,25000.00,NULL,1,NULL,2,'2026-03-04 11:05:24','2026-03-04 11:05:24'),
(17,3,'Pisang Goreng Crispy',NULL,18000.00,NULL,1,'Recommended',3,'2026-03-04 11:05:24','2026-03-04 11:05:24'),
(18,3,'Tahu Lada Garam',NULL,20000.00,NULL,1,'Favorit',4,'2026-03-04 11:05:24','2026-03-04 11:05:24'),
(19,3,'Dimsum (6 pcs)',NULL,28000.00,NULL,1,NULL,5,'2026-03-04 11:05:24','2026-03-04 11:05:24'),
(20,4,'Es Krim (2 scoop)',NULL,20000.00,NULL,1,NULL,1,'2026-03-04 11:05:24','2026-03-04 11:05:24'),
(21,4,'Brownies Hangat',NULL,22000.00,NULL,1,'Recommended',2,'2026-03-04 11:05:24','2026-03-04 11:05:24'),
(22,4,'Waffle + Topping',NULL,28000.00,NULL,1,NULL,3,'2026-03-04 11:05:24','2026-03-04 11:05:24');
/*!40000 ALTER TABLE `fnb_items` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2024_01_01_000001_create_packages_with_tiers',1),
(5,'2024_01_01_000001_create_rooms_table',1),
(6,'2024_01_01_000003_create_fnb_tables',1),
(7,'2026_03_05_155219_add_image_to_packages',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `package_tiers`
--

DROP TABLE IF EXISTS `package_tiers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `package_tiers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `package_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL DEFAULT '#CD7F32',
  `price` decimal(10,2) NOT NULL,
  `badge` varchar(255) DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `package_tiers_package_id_foreign` (`package_id`),
  CONSTRAINT `package_tiers_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package_tiers`
--

LOCK TABLES `package_tiers` WRITE;
/*!40000 ALTER TABLE `package_tiers` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `package_tiers` VALUES
(12,1,'Bronze','#b5835a',300000.00,'Best Seller',1,1,'2026-03-26 12:14:25','2026-03-26 12:14:25'),
(13,1,'Silver','#c0bfbc',350000.00,'Recommended',1,2,'2026-03-26 12:16:03','2026-03-26 12:16:03'),
(14,1,'Gold','#f5c211',450000.00,NULL,1,3,'2026-03-26 12:17:01','2026-03-26 12:17:01'),
(15,5,'Bronze','#b5835a',400000.00,NULL,1,1,'2026-03-26 12:22:17','2026-03-26 12:23:01'),
(16,5,'Silver','#f6f5f4',500000.00,'Best Seller',1,2,'2026-03-26 12:24:22','2026-03-26 12:24:22'),
(17,5,'Gold','#f9f06b',600000.00,'Recommended',1,3,'2026-03-26 12:25:31','2026-03-26 12:25:31'),
(18,6,'Regular','#62a0ea',1350000.00,'Recommended',1,3,'2026-03-26 12:47:02','2026-03-26 12:47:02'),
(19,7,'Wiskey','#1c71d8',2999000.00,'Pilih Salah Satu',1,0,'2026-03-26 13:15:21','2026-03-26 13:22:23'),
(20,7,'Tequilla','#77767b',2999000.00,'Pilih Salah Satu',1,2,'2026-03-26 13:20:18','2026-03-26 13:22:10'),
(21,7,'Gin','#613583',3399000.00,'Pilih Salah Satu',1,3,'2026-03-26 13:21:22','2026-03-26 13:21:22'),
(22,7,'Cognac','#33d17a',4199000.00,'Pilih Salah Satu',1,4,'2026-03-26 13:24:17','2026-03-26 13:24:17'),
(23,8,'T¹','#99c1f1',2149000.00,'Bronze, Silver, Gold, Platium',1,0,'2026-03-26 13:34:58','2026-03-26 13:51:32'),
(24,8,'E¹','#8ff0a4',1799000.00,'Bronze, Silver, Gold, Platium',1,2,'2026-03-26 13:41:12','2026-03-26 13:51:50'),
(25,8,'B¹','#f9f06b',2449000.00,'Bronze, Silver, Gold, Platium',1,3,'2026-03-26 13:42:41','2026-03-26 13:52:01'),
(26,8,'E²','#ffbe6f',1999000.00,'Bronze, Silver, Gold, Platium',1,4,'2026-03-26 13:44:30','2026-03-26 13:52:06'),
(27,8,'T²','#f66151',2699000.00,'Bronze, Silver, Gold, Platium',1,5,'2026-03-26 13:46:41','2026-03-26 13:52:11'),
(28,9,'Pupus Package','#33d17a',110000.00,NULL,1,0,'2026-03-26 13:56:30','2026-03-26 13:56:30'),
(29,9,'Elang Package','#e01b24',130000.00,NULL,1,2,'2026-03-26 13:57:30','2026-03-26 13:57:30'),
(30,9,'Arjuna Package','#613583',140000.00,NULL,1,3,'2026-03-26 13:57:57','2026-03-26 13:57:57'),
(31,9,'Kirana Package','#deddda',150000.00,NULL,1,4,'2026-03-26 13:58:25','2026-03-26 13:58:25');
/*!40000 ALTER TABLE `package_tiers` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `packages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `duration_hours` int(11) NOT NULL DEFAULT 2,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packages`
--

LOCK TABLES `packages` WRITE;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `packages` VALUES
(1,'Paket Hemat','Free Room 2 Jam','packages/sKoMm8jCR2E7D6N9ZOhQaA2qJgOcw6ByynlzcWGb.jpg',2,1,1,'2026-03-04 11:05:23','2026-03-26 12:44:19'),
(5,'Paket Beer','Free Room 2 Jam','packages/5WRGHRgYNf76wO858bpP5r2CBkX9lGdN5YyEhZUX.jpg',2,1,2,'2026-03-26 12:19:46','2026-03-26 12:19:46'),
(6,'Paket Wine','Free Room 2 Jam','packages/joWGmokiEGDJaOkoX6yKxQ8Svvox2zAe4ZKmX2F3.jpg',2,1,3,'2026-03-26 12:45:53','2026-03-26 12:45:53'),
(7,'Paket Twin Bottle','Free Room 2 Jam','packages/JretCVEjd4d0AnTGWNtaU8jyRDaZINRSmm1ORZKe.jpg',2,1,4,'2026-03-26 12:48:34','2026-03-26 12:48:34'),
(8,'Paket TEBET','Free Room 2 Jam','packages/BVXP2TXtQrf6qzqsalJBIpgZTn5YzFfqMjZmsoiP.jpg',2,1,5,'2026-03-26 13:26:43','2026-03-26 13:52:37'),
(9,'Paket Buffe','Free Room 2 Jam','packages/wngoCt6nmUzb9m9OsFqolKmClHUXcoejNEjjRIeQ.jpg',2,1,6,'2026-03-26 13:55:08','2026-03-26 13:55:08');
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `password_reset_tokens` VALUES
('aditya.neo5@gmail.com','$2y$12$y1WLcO0ms0ywEFKsrfBsMOUCbmsGxOPFmCUsci7nyPjDAu1Fd7ufG','2026-03-08 08:17:21'),
('admin@masterpiece.com','$2y$12$ukJOT1Lzo9EESFr8CTmE9O/APtydNg.NCVDsGdh1ELVo9YEk1vcmO','2026-03-08 07:50:17');
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `rooms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` enum('small','medium','large','vip') NOT NULL DEFAULT 'medium',
  `capacity_min` int(11) NOT NULL DEFAULT 2,
  `capacity_max` int(11) NOT NULL DEFAULT 6,
  `price_weekday` decimal(10,2) NOT NULL,
  `price_weekend` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `facilities` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`facilities`)),
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rooms`
--

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `rooms` VALUES
(5,'Room Bronze','small',2,4,89000.00,89000.00,'Room nyaman untuk bernyanyi berdua atau bersama sahabat dekat. Dilengkapi sistem audio berkualitas tinggi.','rooms/sXpDcDtiysn3bDA3I1gnD5jRW8RxQUInNgjKXjBY.jpg','[\"LED TV 43\\\"\",\"Sistem Audio Premium\",\"AC\",\"Sofa\",\"Mic 2 buah\"]',1,1,'2026-03-02 09:07:03','2026-03-02 09:52:56'),
(6,'Room Silver','medium',4,6,119000.00,119000.00,'Pilihan terbaik untuk grup kecil. Ruangan luas dengan pencahayaan mood lighting yang bisa disesuaikan.','rooms/wczloC2Jp2w92M9buxdPQaW05yjK4WNGurv9qjKJ.jpg','[\"LED TV 42\\\"\",\"Sistem Audio Surround\",\"AC\",\"Sofa Panjang\",\"Mic 2 buah\",\"Mood Lighting\"]',1,2,'2026-03-02 09:07:03','2026-03-02 09:55:20'),
(7,'Room Gold','large',6,8,159000.00,159000.00,'Room besar untuk pesta dan gathering keluarga. Space lega dengan panggung mini dan sistem audio terbaik.','rooms/Yg6ANvw4GTXVHmQBOemXqvMEG1l6F8oEgeNQCAIl.jpg','[\"LED TV 42\\\"\",\"Sistem Audio Theater\",\"AC\",\"Sofa + Kursi Extra\",\"Mic 2 buah\",\"Mood Lighting\",\"Disco Ball\"]',1,3,'2026-03-02 09:07:04','2026-03-02 10:02:09'),
(8,'Room Platinum','large',8,10,199000.00,199000.00,'Pengalaman karaoke premium dengan dekorasi eksklusif, sofa mewah, dan layanan prioritas. Cocok untuk acara spesial.','rooms/Wc0rtyWoLhohHB9vSMlueA5HLO0zMUUC9X1d4Sfk.jpg','[\"Smart TV 42\\\"\",\"Sistem Audio JBL Pro\",\"AC Inverter\",\"Sofa Kulit Mewah\",\"Mic Wireless 2 buah\",\"Mood Lighting RGB\",\"Disco Ball\"]',1,4,'2026-03-02 09:07:04','2026-03-26 13:54:08'),
(9,'Room Diamond','large',13,15,299000.00,299000.00,'Room Diamond','rooms/4zpR2K2smCnUVOG83Xxj4sLhl8lks6YAQJqvB9D5.jpg','[\"2 LED TV 42\\\"\",\"Monitor TV 32\\\"\",\"Sistem Audio Surround\",\"AC\",\"Sofa Panjang\",\"Mic 2 buah\",\"Mood Lighting\"]',1,5,'2026-03-02 09:59:59','2026-03-26 13:54:17'),
(10,'Room VIP','vip',18,20,399000.00,399000.00,'Room Vip','rooms/X4Godvych4zONTtL4WMkgym90e6Iu24upnEesCRu.jpg','[\"2 LED TV 42\\\"\",\"Monitor TV 32\\\"\",\"Sistem Audio Theater\",\"AC\",\"Sofa + Kursi Extra\",\"Mic 3 buah\",\"Mood Lighting\",\"Disco Ball\",\"Private Toilet\"]',1,6,'2026-03-02 10:01:45','2026-03-02 10:01:45'),
(11,'Room VIP Signature','vip',18,20,499000.00,499000.00,'Room Vip Signature','rooms/b0THijirhYjTHFlxhmTjJi9BqZ8nvRT4HxW9T9IN.jpg','[\"Smart TV 75\\\"\",\"Sistem Audio TurboSound Pro\",\"AC Inverter\",\"Sofa Kulit Mewah\",\"Mic Wireless 3 buah\",\"Mood Lighting RGB\",\"Disco Ball\"]',1,7,'2026-03-02 10:04:20','2026-03-02 10:07:14'),
(12,'Room VVIP','vip',23,25,599000.00,599000.00,'Room VVIP','rooms/Pt9E3jiux6iyMdLu2H6upYMXDEi3L4GG448gOvio.jpg','[\"2 LED TV 42\\\"\",\"Monitor TV 32\\\"\",\"Sistem Audio Theater\",\"AC\",\"Sofa + Kursi Extra\",\"Mic 3 buah\",\"Mood Lighting\",\"Disco Ball\",\"Private Toilet\"]',1,8,'2026-03-02 10:05:34','2026-03-02 10:07:24'),
(13,'Room Solitare','vip',28,30,699000.00,699000.00,'Room Solitare','rooms/vUwGKD6jEdobwCFAdQIkWD31sTGjhkeAL7P1GDvY.jpg','[\"2 LED TV 42\\\"\",\"Monitor TV 32\\\"\",\"Sistem Audio Theater\",\"AC\",\"Sofa + Kursi Extra\",\"Mic 3 buah\",\"Mood Lighting\",\"Disco Ball\",\"Private Toilet\"]',1,9,'2026-03-02 10:06:33','2026-03-02 10:07:29');
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `sessions` VALUES
('DH4ePYeITKA3AKUv4kl1XQxSEyBKwrVXGPvdgUmI',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWVdXNGJ4VkNsUmI5dmtiOThER3k3S29ZODZGamZpMXQ1OVpuWFNDSyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1774559713),
('q2uDRQCoZ3XXAnu3Vpkpcplly1qQRfqyfYDhRSXT',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVDVJVFNJYWZnVWlYcko0OHViS1U4MHFSTVY1RWxEb0dTTlpYYlcwWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE4OiJsYXN0X2FjdGl2aXR5X3RpbWUiO2k6MTc3NDU1ODczNTt9',1774558739);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `tier_includes`
--

DROP TABLE IF EXISTS `tier_includes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tier_includes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `package_tier_id` bigint(20) unsigned NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `tier_includes_package_tier_id_foreign` (`package_tier_id`),
  CONSTRAINT `tier_includes_package_tier_id_foreign` FOREIGN KEY (`package_tier_id`) REFERENCES `package_tiers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=185 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tier_includes`
--

LOCK TABLES `tier_includes` WRITE;
/*!40000 ALTER TABLE `tier_includes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `tier_includes` VALUES
(57,15,'Balihai/Draft Pin','2 Botol',0),
(58,15,'Guinness Pin','1 Botol',1),
(59,15,'Chicken Skin','1 Porsi',2),
(60,15,'Cigarrete','1 Bungkus',3),
(61,16,'Balihai/Draft Pin','3 Botol',0),
(62,16,'Guinness Pin','2 Botol',1),
(63,16,'Chicken Skin','1 Porsi',2),
(64,16,'Cigarrete','1 Bungkus',3),
(65,17,'Balihai/Draft Pin','3 Botol',0),
(66,17,'Guinness Pin','3 Botol',1),
(67,17,'Chicken Skin','1 Porsi',2),
(68,17,'Cigarrete','1 Bungkus',3),
(69,12,'Ice Lemon Tea','1 Pitcher',0),
(70,12,'Pisang Goreng','1 Porsi',1),
(71,12,'Cireng Isi Mix','1 Porsi',2),
(72,13,'Ice Lemon Tea','1 Pitcher',0),
(73,13,'Orange Juice','1 Glass',1),
(74,13,'Pisang Goreng','1 Porsi',2),
(75,13,'Cireng Isi Mix','1 Porsi',3),
(76,14,'Ice Lemon Tea','2 Pitcher',0),
(77,14,'Pisang Goreng','1 Porsi',1),
(78,14,'Cireng Isi Mix','1 Porsi',2),
(79,18,'Wine Sababay','2 Botol',0),
(100,21,'Hendrick\'s','2 Botol',0),
(101,20,'Jose Cuervo','2 Botol',0),
(102,20,'Greygouse','2 Botol',1),
(103,19,'Chivas Regal 12','2 Botol',0),
(104,19,'Black Label','2 Botol',1),
(105,19,'Jack Daniels','2 Botol',2),
(106,19,'Red Label','2 Botol',3),
(107,19,'Jameson','2 Botol',4),
(108,19,'Singleton 12','2 Botol',5),
(109,19,'Glenfiddich 12','2 Botol',6),
(110,19,'Glenlivet 12','2 Botol',7),
(111,19,'Macallan 12','2 Botol',8),
(112,22,'Camus Martel','2 Botol',0),
(113,22,'Martel 750','2 Botol',1),
(114,22,'Hennessy Vsop 750','2 Botol',2),
(115,22,'Hennessy Vsop 1000','2 Botol',3),
(159,23,'Chivas/Black Label/Greygouse','1 Botol',0),
(160,23,'Cigarrete','1 Bungkus',1),
(161,23,'Kacang','1 Porsi',2),
(162,23,'Fresh Fruit','1 Porsi',3),
(163,23,'Mixer','2 Can',4),
(164,24,'Red Label/Tequilla','1 Botol',0),
(165,24,'Cigarrete','1 Bungkus',1),
(166,24,'Kacang','1 Porsi',2),
(167,24,'Fresh Fruit','1 Porsi',3),
(168,24,'Sliced Lime','1 Porsi',4),
(169,24,'Mixer','2 Can',5),
(170,25,'Singleton 12/Gleenfiddich 12/Glenlivet12','1 Botol',0),
(171,25,'Cigarrete','1 Bungkus',1),
(172,25,'Kacang','1 Porsi',2),
(173,25,'Fresh Fruit','1 Porsi',3),
(174,25,'Mixer','2 Can',4),
(175,26,'Jameson/Jack Daniel\'s','1 Botol',0),
(176,26,'Cigarrete','1 Bungkus',1),
(177,26,'Kacang','1 Porsi',2),
(178,26,'Fresh Fruit','1 Porsi',3),
(179,26,'Mixer','2 Can',4),
(180,27,'Martel Vsop','1 Botol',0),
(181,27,'Cigarrete','1 Bungkus',1),
(182,27,'Mixer','2 Can',2),
(183,27,'Kacang','1 Porsi',3),
(184,27,'Fresh Fruit','1 Porsi',4);
/*!40000 ALTER TABLE `tier_includes` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `users` VALUES
(1,'Administrator','admin@masterpiece.com',NULL,'$2y$12$qmaDiL5czk3ynR0kUZdrc.JLnIIN3KTjZpFONn10N2LhLEr2XSaM.',NULL,'2026-03-04 11:05:23','2026-03-04 11:05:23'),
(4,'adit','aditya.neo5@gmail.com',NULL,'$2y$12$Pr5KeMP4XZ01QiKFovn82OaKcUevAPzsg6GEjhZuytwK3HgElz9/m',NULL,NULL,NULL),
(5,'noriani','noriani296@gmail.com',NULL,'$2y$12$1FUd3NglviSnHc9Hxodzw.oG4OyROQEIWZdQNX6J3uXylgUIgHqi.','3h1v4oCAmPivtmgt083uFTnW5u0vNuTRUT4BXotWX7yRmBaUmsKfijuogZeT',NULL,'2026-03-08 08:27:33');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
commit;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-03-27  4:16:04
