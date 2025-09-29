/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.10-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: ecommerce
-- ------------------------------------------------------
-- Server version	10.11.10-MariaDB-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `account_categories`
--

DROP TABLE IF EXISTS `account_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_categories`
--

LOCK TABLES `account_categories` WRITE;
/*!40000 ALTER TABLE `account_categories` DISABLE KEYS */;
INSERT INTO `account_categories` VALUES
(1,'adwdawdadw','adwdawdadw',NULL,NULL,1,0,0,'2025-04-15 16:15:51','2025-04-15 16:15:51');
/*!40000 ALTER TABLE `account_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `game_id` bigint(20) unsigned NOT NULL,
  `account_category_id` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` bigint(20) NOT NULL,
  `original_price` bigint(20) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `attributes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`attributes`)),
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `status` enum('available','pending','sold') NOT NULL DEFAULT 'available',
  `reserved_until` timestamp NULL DEFAULT NULL COMMENT 'Thời gian tài khoản được giữ chỗ đến khi nào',
  `sold_at` timestamp NULL DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `accounts_game_id_foreign` (`game_id`),
  KEY `accounts_account_category_id_foreign` (`account_category_id`),
  CONSTRAINT `accounts_account_category_id_foreign` FOREIGN KEY (`account_category_id`) REFERENCES `account_categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `accounts_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES
(1,1,NULL,'CẦN CÂU CƠ KHÍ','🎣 TÀI KHOẢN SỞ HỮU CẦN CÂU CÁ MẬP CƠ KHÍ – CHẤT NHƯ NƯỚC CẤT!\r\n🔥 Trang bị cần câu siêu hiếm, hiệu ứng ngầu lòi, chuyên trị cá bóng to – đặc biệt là cá quái vật!\r\n⚙️ Thiết kế cơ khí độc đáo, mỗi cú quăng cần là một lần khiến người khác trầm trồ!\r\n✅ Phù hợp cho các bạn đam mê săn cá hiếm, câu cá bóng 6 hay show hàng cực mạnh tại bến cảng!',150000,NULL,'tancaca9rCB','ATRU6TCOxPH','[]','[\"accounts\\/1744648187_e227bbc6-4e7e-4cc8-ab16-0dd80675cd0c.jpg\"]','available',NULL,NULL,0,0,'2025-04-14 16:29:47','2025-04-14 16:29:47'),
(2,1,NULL,'CẦN CÂU CÁ MẬP CƠ KHÍ','🎣 TÀI KHOẢN SỞ HỮU CẦN CÂU CÁ MẬP CƠ KHÍ – CHẤT NHƯ NƯỚC CẤT! 🔥 Trang bị cần câu siêu hiếm, hiệu ứng ngầu lòi, chuyên trị cá bóng to – đặc biệt là cá quái vật! ⚙️ Thiết kế cơ khí độc đáo, mỗi cú quăng cần là một lần khiến người khác trầm trồ! ✅ Phù hợp cho các bạn đam mê săn cá hiếm, câu cá bóng 6 hay show hàng cực mạnh tại bến cảng!\r\nCÒN 200K TIỀN SAO',150000,NULL,'namhaTV0lE','ApRm9k02Pi8','[]','[\"accounts\\/1744648453_e227bbc6-4e7e-4cc8-ab16-0dd80675cd0c.jpg\"]','available',NULL,NULL,0,0,'2025-04-14 16:34:13','2025-04-14 19:10:02');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `boosting_orders`
--

DROP TABLE IF EXISTS `boosting_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `boosting_orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_number` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `service_id` bigint(20) unsigned NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `original_amount` decimal(10,0) DEFAULT NULL,
  `discount` decimal(10,0) DEFAULT NULL,
  `status` enum('pending','paid','processing','completed','cancelled') NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) DEFAULT NULL COMMENT 'Phương thức thanh toán (bank, wallet, etc.)',
  `paid_at` timestamp NULL DEFAULT NULL COMMENT 'Thời gian thanh toán',
  `game_username` varchar(255) DEFAULT NULL,
  `game_password` varchar(255) DEFAULT NULL,
  `additional_info` text DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `assigned_to` bigint(20) unsigned DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `boosting_orders_order_number_unique` (`order_number`),
  KEY `boosting_orders_user_id_foreign` (`user_id`),
  KEY `boosting_orders_service_id_foreign` (`service_id`),
  KEY `boosting_orders_assigned_to_foreign` (`assigned_to`),
  CONSTRAINT `boosting_orders_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `boosting_orders_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `boosting_services` (`id`) ON DELETE CASCADE,
  CONSTRAINT `boosting_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boosting_orders`
--

LOCK TABLES `boosting_orders` WRITE;
/*!40000 ALTER TABLE `boosting_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `boosting_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `boosting_services`
--

DROP TABLE IF EXISTS `boosting_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `boosting_services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `game_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `short_description` text DEFAULT NULL,
  `price` decimal(10,0) NOT NULL,
  `sale_price` decimal(10,0) DEFAULT NULL,
  `estimated_days` int(11) NOT NULL,
  `requirements` text DEFAULT NULL,
  `includes` text DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `boosting_services_slug_unique` (`slug`),
  KEY `boosting_services_game_id_foreign` (`game_id`),
  CONSTRAINT `boosting_services_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boosting_services`
--

LOCK TABLES `boosting_services` WRITE;
/*!40000 ALTER TABLE `boosting_services` DISABLE KEYS */;
/*!40000 ALTER TABLE `boosting_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `card_deposits`
--

DROP TABLE IF EXISTS `card_deposits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `card_deposits` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `wallet_id` bigint(20) unsigned NOT NULL,
  `telco` varchar(255) NOT NULL COMMENT 'Nhà mạng (VIETTEL, MOBIFONE, VINAPHONE, ...)',
  `amount` decimal(12,0) NOT NULL COMMENT 'Mệnh giá thẻ',
  `serial` varchar(255) NOT NULL COMMENT 'Số serial thẻ cào',
  `code` varchar(255) NOT NULL COMMENT 'Mã thẻ cào',
  `request_id` varchar(255) NOT NULL COMMENT 'Mã yêu cầu gửi đến API',
  `trans_id` varchar(255) DEFAULT NULL COMMENT 'Mã giao dịch từ nhà cung cấp',
  `status` varchar(255) NOT NULL DEFAULT 'pending' COMMENT 'Trạng thái: pending, completed, failed',
  `actual_amount` decimal(12,0) NOT NULL DEFAULT 0 COMMENT 'Số tiền thực tế được cộng vào ví',
  `response` text DEFAULT NULL COMMENT 'Phản hồi từ API',
  `metadata` text DEFAULT NULL COMMENT 'Dữ liệu bổ sung',
  `transaction_id` bigint(20) unsigned DEFAULT NULL COMMENT 'ID giao dịch ví khi nạp thành công',
  `completed_at` timestamp NULL DEFAULT NULL COMMENT 'Thời gian hoàn thành',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `card_deposits_request_id_unique` (`request_id`),
  KEY `card_deposits_user_id_foreign` (`user_id`),
  KEY `card_deposits_wallet_id_foreign` (`wallet_id`),
  KEY `card_deposits_status_index` (`status`),
  KEY `card_deposits_telco_index` (`telco`),
  KEY `card_deposits_request_id_index` (`request_id`),
  CONSTRAINT `card_deposits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `card_deposits_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `card_deposits`
--

LOCK TABLES `card_deposits` WRITE;
/*!40000 ALTER TABLE `card_deposits` DISABLE KEYS */;
/*!40000 ALTER TABLE `card_deposits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_service_orders`
--

DROP TABLE IF EXISTS `game_service_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game_service_orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `game_service_id` bigint(20) unsigned NOT NULL,
  `game_service_package_id` bigint(20) unsigned DEFAULT NULL,
  `order_number` varchar(255) NOT NULL,
  `amount` decimal(12,0) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL COMMENT 'Thời gian thanh toán',
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `assigned_to` bigint(20) unsigned DEFAULT NULL,
  `game_username` varchar(255) DEFAULT NULL,
  `game_password` varchar(255) DEFAULT NULL,
  `game_id` varchar(255) DEFAULT NULL,
  `game_server` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `account_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`account_details`)),
  `completed_at` timestamp NULL DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `game_service_orders_order_number_unique` (`order_number`),
  KEY `game_service_orders_user_id_foreign` (`user_id`),
  KEY `game_service_orders_game_service_id_foreign` (`game_service_id`),
  KEY `game_service_orders_game_service_package_id_foreign` (`game_service_package_id`),
  KEY `game_service_orders_assigned_to_foreign` (`assigned_to`),
  CONSTRAINT `game_service_orders_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`),
  CONSTRAINT `game_service_orders_game_service_id_foreign` FOREIGN KEY (`game_service_id`) REFERENCES `game_services` (`id`),
  CONSTRAINT `game_service_orders_game_service_package_id_foreign` FOREIGN KEY (`game_service_package_id`) REFERENCES `game_service_packages` (`id`),
  CONSTRAINT `game_service_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_service_orders`
--

LOCK TABLES `game_service_orders` WRITE;
/*!40000 ALTER TABLE `game_service_orders` DISABLE KEYS */;
INSERT INTO `game_service_orders` VALUES
(1,1,4,15,'SRV-17446575666260',15000,'paid','wallet','2025-04-14 19:06:08','pending',NULL,NULL,NULL,'á','ấd','â',NULL,NULL,NULL,NULL,'2025-04-14 19:06:06','2025-04-14 19:06:08'),
(2,1,8,32,'SRV-17447198095524',20000,'paid','wallet','2025-04-15 12:23:31','pending',NULL,NULL,NULL,'yeukoexit','vng',NULL,NULL,NULL,NULL,NULL,'2025-04-15 12:23:29','2025-04-15 12:23:31'),
(3,3,9,34,'SRV-17447208148282',50000,'paid','wallet','2025-04-15 12:40:16','pending',NULL,NULL,NULL,'Test','test',NULL,NULL,NULL,NULL,NULL,'2025-04-15 12:40:14','2025-04-15 12:40:16'),
(4,3,8,32,'SRV-17447221445216',20000,'paid','wallet','2025-04-15 13:02:26','pending',NULL,NULL,NULL,'Test','test',NULL,NULL,NULL,NULL,NULL,'2025-04-15 13:02:24','2025-04-15 13:02:26'),
(5,3,9,34,'SRV-17447228693320',50000,'paid','wallet','2025-04-15 13:15:02','pending',NULL,NULL,NULL,'Test','test',NULL,NULL,NULL,NULL,NULL,'2025-04-15 13:14:29','2025-04-15 13:15:02'),
(6,1,8,32,'SRV-17447300513310',20000,'pending',NULL,NULL,'pending',NULL,NULL,NULL,'yeukoexit','VNG','aaa',NULL,NULL,NULL,NULL,'2025-04-15 15:14:11','2025-04-15 15:14:11'),
(7,3,8,32,'SRV-17447345083797',20000,'pending',NULL,NULL,'pending',NULL,NULL,NULL,'Test','test',NULL,NULL,NULL,NULL,NULL,'2025-04-15 16:28:28','2025-04-15 16:28:28');
/*!40000 ALTER TABLE `game_service_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_service_packages`
--

DROP TABLE IF EXISTS `game_service_packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game_service_packages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `game_service_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(12,0) NOT NULL,
  `sale_price` decimal(12,0) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `display_order` int(11) NOT NULL DEFAULT 0,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `game_service_packages_game_service_id_foreign` (`game_service_id`),
  CONSTRAINT `game_service_packages_game_service_id_foreign` FOREIGN KEY (`game_service_id`) REFERENCES `game_services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_service_packages`
--

LOCK TABLES `game_service_packages` WRITE;
/*!40000 ALTER TABLE `game_service_packages` DISABLE KEYS */;
INSERT INTO `game_service_packages` VALUES
(1,1,'CÂU NGẪU NHIÊN 5 CON CÁ BÓNG 6','/storage/service_packages/LdJGXv5mlEPs0anSledZ9qmq4muRlTtsVoUGlVna.jpg',NULL,60000,0,'active',0,NULL,'2025-04-14 11:17:03','2025-04-15 17:19:32'),
(2,1,'CÂU NGẪU NHIÊN 10 CON CÁ BÓNG 6','/storage/service_packages/X5YYIBLqOTxOqjH26geQHc0SQIMsvmrEe74AXHpn.jpg',NULL,100000,0,'active',0,NULL,'2025-04-14 11:17:59','2025-04-15 17:19:42'),
(3,1,'CÂU NGẪU NHIÊN 20 CON CÁ BÓNG 6','/storage/service_packages/qspDB2xceBKBpZIwnkxDNHCozogkY23o8HstNyxU.jpg',NULL,150000,0,'active',0,NULL,'2025-04-14 11:18:54','2025-04-15 17:19:52'),
(4,1,'CÂU THEO YÊU CẦU : CÁ MẬP ĐỎ','/storage/service_packages/OQKes9ldoIE5aHiwluyF9jClEpYgxEGzb3TXLrm2.jpg',NULL,220000,0,'active',0,NULL,'2025-04-14 11:22:32','2025-04-14 11:36:30'),
(5,1,'CÂU THEO YÊU CẦU : LIVYATAN','/storage/service_packages/Lu0ZBnmzxJmdZzff6zUQiqEcx6bmf3GXoMJHveY0.png',NULL,220000,0,'active',0,NULL,'2025-04-14 11:22:56','2025-04-14 11:37:04'),
(6,1,'CÂU RÙA ARCHELON VƯƠNG MIỆN','/storage/service_packages/xdsXJWI8U2zlWFoIDcE1j9cxbV2kVmVlTeOzGDJO.jpg',NULL,200000,0,'active',0,NULL,'2025-04-14 11:23:28','2025-04-14 11:37:19'),
(7,2,'500k TIỀN SAO  💰','/storage/service_packages/mLDPl3dZNfNifzpUyD9WDwxR0P9z4qCRgN8Vpk1F.png','<p>TỈ LỆ BAN ACC CHỈ 1%</p>',60000,0,'active',0,NULL,'2025-04-14 11:27:40','2025-04-14 16:12:18'),
(8,2,'1 TRIỆU TIỀN SAO  💰','/storage/service_packages/SwDVT8pTOPdizhOXrzbUyISmaZh0kddcEjXMQYTs.png','<p>TỈ LỆ BAN ACC CHỈ 1%</p>',120000,0,'active',0,NULL,'2025-04-14 11:28:06','2025-04-14 16:12:23'),
(9,2,'2 TRIỆU TIỀN SAO  💰','/storage/service_packages/HInAzpkeC4kijOKKdL6TyzvPuH5IHtHAXH2deZso.png','<p>TỈ LỆ BAN ACC CHỈ 1%</p>',180000,0,'active',0,NULL,'2025-04-14 11:28:43','2025-04-14 16:12:30'),
(10,2,'4 TRIỆU TIỀN SAO  💰','/storage/service_packages/y4xeknGozHwJzQsRM2Jj7VhmCkYsOk0gBxaqDcko.png','<p>TỈ LỆ BAN ACC CHỈ 1%</p>',320000,0,'active',0,NULL,'2025-04-14 11:29:18','2025-04-14 16:12:34'),
(11,3,'100K SAO ⭐','/storage/service_packages/GiWIkQ3rFjRs1TTTc5gpwudxMOLiDN14les7mEaE.jpg',NULL,150000,0,'active',2,NULL,'2025-04-14 11:39:07','2025-04-14 11:42:07'),
(12,3,'10K SAO ⭐','/storage/service_packages/rZQ7aSbiBoxVCuI0wJWNCJBnyhC5Pr1HPateF9UG.jpg',NULL,40000,0,'active',1,NULL,'2025-04-14 11:39:42','2025-04-14 11:42:03'),
(13,3,'500K SAO ⭐','/storage/service_packages/DJ1xy5Zr40FqvX5ytrBxEjljSxL1zlIYqjVKLxgv.jpg',NULL,240000,0,'active',3,NULL,'2025-04-14 11:40:48','2025-04-14 11:42:11'),
(14,3,'1 TRIỆU SAO ( LẤY NÚT PHA LÊ ) ⭐','/storage/service_packages/2bD8ihv7DPPKqvaDoqDQh1nHLzL77KDNmIEBTj2w.jpg',NULL,500000,0,'active',4,NULL,'2025-04-14 11:41:19','2025-04-14 11:42:16'),
(15,4,'10K TIM ❤️','/storage/service_packages/oBMPIs2hZ6PaF8btd9mkYbZrNgrB7Wkmtdi77Z9S.jpg',NULL,15000,NULL,'active',0,NULL,'2025-04-14 11:46:55','2025-04-14 11:46:55'),
(16,4,'50k TIM ❤️','/storage/service_packages/GqmmBfgQyhtpQFTQIqXLE44UotICBN9VavkMvuDS.jpg',NULL,70000,0,'active',0,NULL,'2025-04-14 11:47:19','2025-04-14 11:49:18'),
(17,4,'100K TIM ❤️','/storage/service_packages/eqQdhLYp199En1woj8Yz1gE3ibQWeSpP1L4v6cxc.jpg',NULL,100000,NULL,'active',0,NULL,'2025-04-14 11:48:09','2025-04-14 11:48:09'),
(18,4,'500K TIM ❤️','/storage/service_packages/hpuWQd9iPFt0x4fLlc1tRuV44Z21oEziFiytoYAY.jpg',NULL,180000,NULL,'active',0,NULL,'2025-04-14 11:48:36','2025-04-14 11:48:36'),
(19,4,'1 TRIỆU TIM ❤️','/storage/service_packages/dDdQMr0o4Vv9ipLGz15ofcu8MFNCI4OLAsvQnN2l.jpg',NULL,220000,NULL,'active',0,NULL,'2025-04-14 11:48:57','2025-04-14 11:48:57'),
(20,5,'TREO BẮT BỌ 1 NGÀY','/storage/service_packages/Oz5bCrxKA2AI4KJn8qcZhD2sRUro8Jd3vRBgwIEh.png',NULL,60000,NULL,'active',0,NULL,'2025-04-14 12:00:17','2025-04-14 12:00:17'),
(21,5,'TREO BẮT BỌ 7 NGÀY','/storage/service_packages/AgCIEPzDJEmI9JiYx6RHAwuXMGRBrObNfTEiYH4r.png',NULL,200000,0,'active',0,NULL,'2025-04-14 12:00:51','2025-04-14 12:01:46'),
(22,5,'TREO CÂU CÁ 1 NGÀY','/storage/service_packages/kZdLCjNDgq5dpoukNnMd51iuB4mUYumqMM90kzxw.png',NULL,60000,NULL,'active',0,NULL,'2025-04-14 12:02:17','2025-04-14 12:02:17'),
(23,5,'TREO CÂU CÁ 7 NGÀY','/storage/service_packages/LoK47rV5suMGPp33OHrYuoT74RlZ49sjuLmc6YFH.png',NULL,200000,NULL,'active',0,NULL,'2025-04-14 12:02:33','2025-04-14 12:02:33'),
(24,6,'CÀY HÒM 250 SAO 🃏','/storage/service_packages/pIUC3RGaKFESSABm8eWEWRj6nonv76360JLe8VBl.jpg',NULL,40000,0,'active',0,NULL,'2025-04-14 12:06:02','2025-04-15 16:45:12'),
(25,6,'CÀY HÒM 500 SAO 🃏','/storage/service_packages/Ad3Kvzrckw55eY3LEQuTP0uHPA6gH9yeyfIzZu4h.jpg',NULL,60000,0,'active',0,NULL,'2025-04-14 12:06:22','2025-04-15 16:45:20'),
(26,6,'CÀY HÒM 1000 SAO 🃏','/storage/service_packages/cjVbHEI8jU5KlLEMzSZ6mmTzbw4OMbkqui4ncgUm.jpg',NULL,100000,0,'active',0,NULL,'2025-04-14 12:06:57','2025-04-15 16:45:27'),
(27,6,'CÀY FULL THẺ 120/120','/storage/service_packages/ukQSLQasVCtYjJPjKGQHrOJ5IA2Tci9VV6ycpBzv.jpg',NULL,200000,0,'active',0,NULL,'2025-04-14 12:07:33','2025-04-15 16:46:18'),
(28,7,'KIM CƯƠNG XANH','/storage/service_packages/GqzAXqj5aFtLXiirlP8valnnxH2qub5e1xOVKAwy.jpg',NULL,120000,NULL,'active',0,NULL,'2025-04-14 12:15:00','2025-04-14 12:15:00'),
(29,7,'KIM CƯƠNG ĐỎ','/storage/service_packages/ziB9CyIN8vRJcfCAmT3EkGu8AcLZl5qCGw0RTFKq.jpg',NULL,120000,NULL,'active',0,NULL,'2025-04-14 12:15:30','2025-04-14 12:15:30'),
(30,7,'GÓI 12 TIẾNG CÀY ĐẬP ĐÁ LIÊN TỤC','/storage/service_packages/aiTVmX5iX8JZw9T4XQfXrghnzS26MXwDMGOh1Yku.png',NULL,50000,0,'active',0,NULL,'2025-04-14 12:25:54','2025-04-14 12:32:19'),
(31,7,'GÓI TREO CÀY ĐẬP ĐÁ 7 NGÀY','/storage/service_packages/V3BIs3RY8RoiK0i7UH3PbfPFHGaU6Hfs9obxbBiz.png',NULL,200000,NULL,'active',0,NULL,'2025-04-14 14:32:39','2025-04-14 14:32:39'),
(32,8,'CAMPING','/storage/service_packages/1J4RHKO2MbbEXWqMFGLiHJb1v71B4GbYFW6gUAPK.jpg',NULL,20000,NULL,'active',0,NULL,'2025-04-14 15:55:52','2025-04-14 15:55:52'),
(33,8,'PLAZA','/storage/service_packages/BtFh3HnetckNgHLHafY8ECGfcJSGEV42LAWhxX2W.jpg',NULL,20000,NULL,'active',0,NULL,'2025-04-14 15:56:04','2025-04-14 15:56:04'),
(34,9,'KÍ TƯỜNG 1K TIN','/storage/service_packages/eAkgdqcgnkyUKfW9vGxWpNvP6rktBWH55i0IIO07.jpg','<p>📝 Sau khi đặt, bạn hãy nhập ID của người cần ký vào phần ID GAME nhé!</p><p>💬 Văn bản cần ký vui lòng ghi vào trong phần ghi chú giúp shop!</p>',50000,0,'active',0,NULL,'2025-04-14 17:48:44','2025-04-15 17:09:47'),
(35,9,'KÍ TƯỜNG 50K TIN ( KÉO DÀI KHÔNG HẾT )','/storage/service_packages/pZhiqkHP2Y5UoQsyrRZxXOX8ofqKbOLT66A9lYv3.jpg','<p>📝 Sau khi đặt, bạn hãy nhập ID của người cần ký vào phần ID GAME nhé!</p><p>💬 Văn bản cần ký vui lòng ghi vào trong phần ghi chú giúp shop!</p>',300000,0,'active',3,NULL,'2025-04-14 17:51:41','2025-04-15 17:10:01'),
(36,9,'KÍ TƯỜNG 10K TIN','/storage/service_packages/oaMtA2hh2a4zIGKUu0wMjDmZK6OvF5VpVkcJNh9Q.jpg','<p>📝 Sau khi đặt, bạn hãy nhập ID của người cần ký vào phần ID GAME nhé!</p><p>💬 Văn bản cần ký vui lòng ghi vào trong phần ghi chú giúp shop!</p>',100000,0,'active',0,NULL,'2025-04-14 17:52:18','2025-04-15 17:09:54'),
(37,9,'XOÁ TƯỜNG','/storage/service_packages/HAK7FDOWfO6Zzeyb70bw4wd3Pp5skOKsMXVMECjV.jpg','<p>🧹 <strong>XÓA TƯỜNG CẦN ĐĂNG NHẬP ACC ĐỂ THỰC HIỆN</strong><br>📩 Sau khi đặt đơn, <strong>vui lòng inbox Zalo hoặc Facebook ngay</strong> để mình xử lý nhanh nhất cho bạn nhé!<br>✅ Càng liên hệ sớm – đơn càng được xử lý gọn lẹ, không để bạn chờ lâu!</p>',50000,0,'active',0,NULL,'2025-04-14 17:53:15','2025-04-15 17:01:11'),
(38,10,'SPAM 1 MAP','/storage/service_packages/EpVXPplw8E7ANuougVKtkawdcl0EV1oREJypP67M.jpg',NULL,100000,0,'active',0,NULL,'2025-04-15 16:56:15','2025-04-15 16:57:33'),
(39,10,'SPAM KHẮP ĐẢO KAIA','/storage/service_packages/iKf8zsVpHavsbmkfPgUItQEfhyJXvHRKaejDGnmk.jpg',NULL,400000,0,'active',0,NULL,'2025-04-15 16:59:18','2025-04-15 17:11:50');
/*!40000 ALTER TABLE `game_service_packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_services`
--

DROP TABLE IF EXISTS `game_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game_services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `game_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `login_type` enum('username_password','game_id','both') NOT NULL DEFAULT 'username_password' COMMENT 'Kiểu thông tin đăng nhập yêu cầu',
  `completed_count` int(11) NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `game_services_slug_unique` (`slug`),
  KEY `game_services_game_id_foreign` (`game_id`),
  CONSTRAINT `game_services_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_services`
--

LOCK TABLES `game_services` WRITE;
/*!40000 ALTER TABLE `game_services` DISABLE KEYS */;
INSERT INTO `game_services` VALUES
(1,1,'THUÊ CÂU CÁ BÓNG 6','thue-cau-ca-bong-6','<figure class=\"table\"><table><tbody><tr><td><p>🎣 <strong>CÂU CÁ BẰNG TOOL TỰ ĐỘNG – NHẬN CÁ KHỦNG!</strong></p><p>✨ Bạn sẽ nhận <strong>tất cả cá bóng 5, 6</strong> cho đến khi câu được cá mong muốn.<br>⏳ Nếu sau <strong>2 tuần</strong> vẫn chưa ra cá chỉ định, bạn sẽ được <strong>hoàn 50K</strong> và nhận luôn toàn bộ cá đã câu!</p></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure>',NULL,'/storage/services/kJJRiVBmGvFQ8VJLF6dn029iHDWaW76M0jp2AwtZ.jpg','fishing','username_password',0,0,'active',NULL,'2025-04-14 11:12:45','2025-04-15 16:23:52'),
(2,1,'CÀY TIỀN SAO  💰','cay-tien-sao','<figure class=\"table\"><table><tbody><tr><td><p>🪙 <strong>CÀY TIỀN SAO BẰNG TOOL&nbsp;</strong><br>💎 Mình sẽ <strong>tặng thêm nhiều bọ tím hiếm</strong> nha</p><p>⚠️ <strong>Cảnh báo:</strong> Việc treo nick luôn có nguy cơ bị <strong>khóa tài khoản</strong>&nbsp;</p></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure>',NULL,'/storage/services/S9HKVMGQ4JaRCfJwHKX5j404p4WGxZXzLRzyZGYc.png','fishing','username_password',0,0,'active',NULL,'2025-04-14 11:26:15','2025-04-15 15:16:42'),
(3,1,'BUFF SAO PLAYTOGERTHER ⭐','buff-sao-playtogerther','<figure class=\"table\"><table><tbody><tr><td>⚠️ <strong>LƯU Ý KHI ĐẶT ĐƠN BUFF SAO</strong> ⚠️<br>1️⃣ Đặt xong nhớ liên hệ Zalo/FB nếu chưa được buff<br>2️⃣ Đơn lớn cần nhà 36K, 54K, 400KC, 700KC (chứa 60 người càng nhanh)<br>&nbsp;Gửi <strong>tên game + ảnh nhà</strong> cho shop sau khi đặt</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure>',NULL,'/storage/services/CTx7GHOxrV0eSFesRynnHMw9TmDeERDPLSV6qCfY.png','fishing','game_id',0,1,'active',NULL,'2025-04-14 11:38:07','2025-04-15 15:20:18'),
(4,1,'BUFF TIM PLAYTOGERTHER ❤️','buff-tim-playtogerther','<figure class=\"table\"><table><tbody><tr><td><p>⚠️ <strong>LƯU Ý:</strong><br>1️⃣ <strong>Buff tim</strong> có thể làm <strong>không cần vào game</strong><br>2️⃣ Ghi <strong>đúng tên game</strong> khi đặt đơn</p><p>💡 <strong>MẸO LẤY TÊN GAME:</strong><br>Vào <strong>avatar → chỉnh sửa profile → copy tên</strong> cho chính xác nhé!</p></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure>',NULL,'/storage/services/s2zXrNThDjeY2Rr17G2woQrHIZTk1pNMiK5B3Bjp.png','fishing','game_id',0,1,'active',NULL,'2025-04-14 11:45:58','2025-04-14 17:33:25'),
(5,1,'TREO THEO NGÀY','treo-theo-ngay','<figure class=\"table\"><table><tbody><tr><td><p>🎣 <strong>TREO CÂU CÁ – &nbsp;BẮT BỌ BẰNG TOOL TỰ ĐỘNG</strong><br>💬 Muốn treo ở đâu? Ghi rõ vào <strong>phần ghi chú</strong> giúp mình nhé!</p><p>🚫 <strong>Tuyệt đối không được vào nick khi đang treo!</strong></p><p>⚠️ <strong>Quan trọng:</strong> Việc treo nick luôn có rủi ro bị <strong>khóa tài khoản</strong>&nbsp;</p></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure>',NULL,'/storage/services/JnYQJa7uKvXBUvxyjGfHOm3YozJT2c7pjNU7Dcno.jpg','fishing','username_password',0,0,'active',NULL,'2025-04-14 11:53:43','2025-04-15 15:57:04'),
(6,1,'CÀY THẺ','cay-the','<figure class=\"table\"><table><tbody><tr><td><strong>CÀY THẺ BẰNG TOOL BẮT BỌ</strong></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td><strong>mình sẽ tặng nhiều bọ tím hiếm!</strong></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>🚫 Không được vào nick khi đang cày thẻ (vi phạm sẽ bị phạt)</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>❗Lưu ý: Treo nick có thể bị khóa – nếu bị band mình không chịu trách nhiệm!</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure>',NULL,'/storage/services/1kKoBXamVFVHBoA1E0iphkKNIuAsK7lJ7sxd154t.jpg','fishing','username_password',0,0,'active',NULL,'2025-04-14 12:04:18','2025-04-15 16:20:39'),
(7,1,'CHẾ TẠO - KHOÁNG THẠCH','che-tao-khoang-thach','<figure class=\"table\"><table><tbody><tr><td><p>🔧 Chế tạo thả ga tại Trung tâm Plaza – biến nguyên liệu thành báu vật!</p><p>🔥 Trung tâm Plaza – thiên đường của dân mê chế tạo và khám phá!<strong>chế tạo và khám phá!</strong></p></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure>',NULL,'/storage/services/KWbAv3GHPmZNVjNoKUf4RPOPn9QPKf1VjvviMnA3.jpg','fishing','username_password',0,0,'active',NULL,'2025-04-14 12:08:58','2025-04-15 16:47:23'),
(8,1,'MAP TRỐNG','map-trong','<figure class=\"table\"><table><tbody><tr><td>🛡️ <strong>BẢO HÀNH MAP 4 TIẾNG – BỂ ĐỔI NGAY CÁI MỚI!</strong><br>💬 Sau khi đặt xong các bạn đợi 10p chưa thấy clone kết bạn thì hãy liên hệ mình nha</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure>',NULL,'/storage/services/J3KANLwRnToTHNmutxw4OsfxxXaLwPm9JRFup2Ej.jpg','fishing','game_id',0,1,'active',NULL,'2025-04-14 14:35:25','2025-04-15 14:54:34'),
(9,1,'XOÁ TƯỜNG / KÍ TƯỜNG','xoa-tuong-ki-tuong','<figure class=\"table\"><table><tbody><tr><td><p>🧱 DỊCH VỤ KÝ TƯỜNG / XOÁ TƯỜNG – DẤU ẤN RIÊNG CHO NGÔI NHÀ CỦA BẠN!</p><p>🧹 XOÁ TƯỜNG – Dọn sạch toàn bộ chữ cũ, làm mới không gian</p></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure>','123','/storage/services/1blHUsJ9sbZtJHbF2bODA8cAWdAJieTamCbL6inh.jpg','fishing','game_id',0,1,'active',NULL,'2025-04-14 17:45:15','2025-04-15 17:10:18'),
(10,1,'SPAM GIẢI TRÍ CỰC VUI','spam-giai-tri-cuc-vui','<p>📢 Tag tên người yêu cũ? Ok!<br>📢 Réo crush trước mặt cả server? Chuyện nhỏ!<br>📢 Spam drama ảo nhưng cười thiệt 100%? Quá được luôn!</p>','GỬI LỜI YÊU THƯƠNG ĐẾN NGƯỜI THÂN VÀ KẺ THÙ CỦA BẠN','/storage/services/h1zoSgA2vQn7iTJHFgjXlVjwaoH3demmf00s4Wl4.jpg','fishing','username_password',0,0,'active',NULL,'2025-04-15 16:52:16','2025-04-15 17:16:11');
/*!40000 ALTER TABLE `game_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `games_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` VALUES
(1,'PLAYTOGERTHER ⭐','playtogerther',NULL,NULL,NULL,1,0,'2025-04-14 11:11:05','2025-04-14 11:42:42',NULL);
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_reset_tokens_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2025_04_06_031459_create_games_table',1),
(6,'2025_04_06_031504_create_accounts_table',1),
(7,'2025_04_06_031509_create_orders_table',1),
(8,'2025_04_06_031518_create_transactions_table',1),
(9,'2025_04_06_031615_create_roles_table',1),
(10,'2025_04_06_031620_add_role_id_to_users_table',1),
(11,'2025_04_06_055705_add_sold_at_to_accounts_table',1),
(12,'2025_04_06_060204_add_account_details_to_orders_table',1),
(13,'2025_04_06_062044_create_boosting_services_table',1),
(14,'2025_04_06_062108_create_boosting_orders_table',1),
(15,'2025_04_06_111439_add_boosting_order_id_to_transactions_table',1),
(16,'2025_04_06_115628_add_notes_to_transactions_table',1),
(17,'2025_04_07_075504_create_wallets_table',1),
(18,'2025_04_07_075510_create_wallet_transactions_table',1),
(19,'2025_04_09_095811_create_card_deposits_table',1),
(20,'2025_04_10_022534_create_wallet_deposits_table',1),
(21,'2025_04_10_023754_update_card_deposits_table',1),
(22,'2025_04_10_070833_add_payment_fields_to_boosting_orders_table',1),
(23,'2025_04_10_071056_add_payment_fields_to_orders_table',1),
(24,'2025_04_10_074038_add_reserved_until_to_accounts_table',1),
(25,'2025_04_10_162034_add_image_to_games_table',1),
(26,'2025_04_11_014755_create_top_up_services_table',1),
(27,'2025_04_11_015106_create_top_up_orders_table',1),
(28,'2025_04_11_015735_add_top_up_order_id_to_transactions_table',1),
(29,'2025_04_11_015814_add_top_up_order_id_to_transactions_table',1),
(30,'2025_04_11_171618_create_game_services_table',1),
(31,'2025_04_11_171630_create_service_packages_table',1),
(32,'2025_04_11_171639_create_service_orders_table',1),
(33,'2025_04_11_171652_add_service_order_id_to_transactions_table',1),
(34,'2025_04_12_024430_add_paid_at_to_game_service_orders_table',1),
(35,'2025_04_12_030552_add_image_to_service_packages_table',1),
(36,'2025_04_12_030555_create_account_categories_table',1),
(37,'2025_04_13_030552_add_category_id_to_accounts_table',1),
(38,'2025_04_13_152738_modify_price_columns_in_accounts_table',1),
(39,'2025_04_13_213124_add_login_type_to_services',1),
(40,'2025_04_13_213310_add_game_credentials_to_top_up_orders',1),
(41,'2025_04_13_213410_add_game_id_to_game_service_orders',1),
(42,'2025_05_01_000000_create_top_up_categories_table',1),
(43,'2025_05_01_000001_add_category_id_to_top_up_services_table',1),
(44,'2025_04_15_000000_add_payment_fields_to_top_up_orders_table',2),
(45,'2024_03_19_000000_add_short_description_to_game_services',3),
(46,'2024_03_21_add_short_description_to_boosting_services',4),
(47,'2024_03_21_add_short_description_to_top_up_services',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `account_id` bigint(20) unsigned NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','completed','cancelled','failed') NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) DEFAULT NULL COMMENT 'Phương thức thanh toán (bank, wallet, etc.)',
  `paid_at` timestamp NULL DEFAULT NULL COMMENT 'Thời gian thanh toán',
  `customer_note` text DEFAULT NULL,
  `account_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`account_details`)),
  `completed_at` timestamp NULL DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_number_unique` (`order_number`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_account_id_foreign` (`account_id`),
  CONSTRAINT `orders_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES
(1,1,2,'ORD-4CE822DB69',150000.00,'completed','wallet','2025-04-14 19:05:21',NULL,NULL,'2025-04-14 19:05:21',NULL,'2025-04-14 19:04:45','2025-04-14 19:05:21');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `permissions` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES
(1,'Quản trị viên','admin',NULL,'2025-04-14 07:09:50','2025-04-14 07:09:50'),
(2,'Người dùng','user',NULL,'2025-04-14 07:09:50','2025-04-14 07:09:50');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `top_up_categories`
--

DROP TABLE IF EXISTS `top_up_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `top_up_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `top_up_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `top_up_categories`
--

LOCK TABLES `top_up_categories` WRITE;
/*!40000 ALTER TABLE `top_up_categories` DISABLE KEYS */;
INSERT INTO `top_up_categories` VALUES
(4,'GÓI CHỦ ĐỀ','goi-chu-de','<figure class=\"table\"><table><tbody><tr><td>🎮 <strong>Chỉ cần vào Cài đặt → Lấy ID game → Điền vào là nạp được liền tay nha bạn!</strong><br>Nhanh – Gọn – Chính xác, không cần hỏi ai cũng làm được!</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure>','topup_categories/1744641682_ChatGPT Image 21_35_42 14 thg 4, 2025.png',1,0,NULL,NULL,NULL,'2025-04-14 14:40:10','2025-04-14 17:12:32'),
(5,'CUNG HOÀNG ĐẠO','cung-hoang-dao','<figure class=\"table\"><table><tbody><tr><td>🎮 <strong>Chỉ cần vào Cài đặt → Lấy ID game → Điền vào là nạp được liền tay nha bạn!</strong><br>Nhanh – Gọn – Chính xác, không cần hỏi ai cũng làm được!</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure>','topup_categories/1744643352_z6505457139649_54600abe97c600b7839bc1aa44ca4fa8.jpg',1,0,NULL,NULL,NULL,'2025-04-14 15:09:12','2025-04-14 17:12:20'),
(7,'GÓI ĐẶC BIỆT','goi-dac-biet','<figure class=\"table\"><table><tbody><tr><td>🎮 <strong>Chỉ cần vào Cài đặt → Lấy ID game → Điền vào là nạp được liền tay nha bạn!</strong><br>Nhanh – Gọn – Chính xác, không cần hỏi ai cũng làm được!</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure>','topup_categories/1744643554_z6505467344424_3ee929985c6b6b8be822156300034c9e.jpg',1,0,NULL,NULL,NULL,'2025-04-14 15:11:54','2025-04-14 17:12:39'),
(8,'SANRIO CHARACTERS','sanrio-characters','<figure class=\"table\"><table><tbody><tr><td>🎮 <strong>Chỉ cần vào Cài đặt → Lấy ID game → Điền vào là nạp được liền tay nha bạn!</strong><br>Nhanh – Gọn – Chính xác, không cần hỏi ai cũng làm được!</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure>','topup_categories/1744644021_z6505490493159_f2539f81afafabe092c28c3c9f0cc3ed.jpg',1,0,NULL,NULL,NULL,'2025-04-14 15:20:21','2025-04-14 17:13:21'),
(9,'GÓI TIỀN TỆ','goi-tien-te','<figure class=\"table\"><table><tbody><tr><td>🎮 <strong>Chỉ cần vào Cài đặt → Lấy ID game → Điền vào là nạp được liền tay nha bạn!</strong><br>Nhanh – Gọn – Chính xác, không cần hỏi ai cũng làm được!</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure>','topup_categories/1744644412_z6505508907461_a879398d474ab5151e3391810de8cf29.jpg',1,0,NULL,NULL,NULL,'2025-04-14 15:26:52','2025-04-14 17:13:05'),
(10,'GÓI KHUYẾN MÃI','goi-khuyen-mai','<figure class=\"table\"><table><tbody><tr><td>🎮 <strong>Chỉ cần vào Cài đặt → Lấy ID game → Điền vào là nạp được liền tay nha bạn!</strong><br>Nhanh – Gọn – Chính xác, không cần hỏi ai cũng làm được!</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure>','topup_categories/1744645515_z6505555497896_4afd673d6dc1d45e2b6a18142dcd3915.jpg',1,0,NULL,NULL,NULL,'2025-04-14 15:44:50','2025-04-14 17:12:46'),
(11,'GÓI LINE FRIENDS','goi-line-friends','<figure class=\"table\"><table><tbody><tr><td>🎮 <strong>Chỉ cần vào Cài đặt → Lấy ID game → Điền vào là nạp được liền tay nha bạn!</strong><br>Nhanh – Gọn – Chính xác, không cần hỏi ai cũng làm được!</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure>','topup_categories/1744651465_z6505696116761_8d89cdf5fb4e6a237864f3c842f072b2.jpg',1,0,NULL,NULL,NULL,'2025-04-14 17:24:25','2025-04-14 17:24:49');
/*!40000 ALTER TABLE `top_up_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `top_up_orders`
--

DROP TABLE IF EXISTS `top_up_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `top_up_orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_number` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `service_id` bigint(20) unsigned NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `original_amount` decimal(10,0) NOT NULL,
  `discount` decimal(10,0) NOT NULL DEFAULT 0,
  `status` enum('pending','paid','processing','completed','cancelled') NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `game_id` varchar(255) DEFAULT NULL COMMENT 'ID trong game của người dùng',
  `game_username` varchar(255) DEFAULT NULL,
  `game_password` varchar(255) DEFAULT NULL,
  `server_id` varchar(255) DEFAULT NULL COMMENT 'Server ID trong game nếu có',
  `additional_info` text DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `assigned_to` bigint(20) unsigned DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `top_up_orders_order_number_unique` (`order_number`),
  KEY `top_up_orders_user_id_foreign` (`user_id`),
  KEY `top_up_orders_service_id_foreign` (`service_id`),
  KEY `top_up_orders_assigned_to_foreign` (`assigned_to`),
  CONSTRAINT `top_up_orders_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`),
  CONSTRAINT `top_up_orders_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `top_up_services` (`id`),
  CONSTRAINT `top_up_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `top_up_orders`
--

LOCK TABLES `top_up_orders` WRITE;
/*!40000 ALTER TABLE `top_up_orders` DISABLE KEYS */;
INSERT INTO `top_up_orders` VALUES
(1,'TOPUP1744657740204',1,28,138000,138000,0,'pending',NULL,NULL,'á',NULL,NULL,'âd',NULL,NULL,NULL,NULL,'2025-04-14 19:09:00','2025-04-14 19:09:00'),
(2,'TOPUP1744657759904',1,29,315000,315000,0,'pending',NULL,NULL,'yeukoexit',NULL,NULL,'sea','adaddaadad',NULL,NULL,NULL,'2025-04-14 19:09:19','2025-04-14 19:09:19'),
(3,'TOPUP1744657775664',1,29,315000,315000,0,'pending',NULL,NULL,'yeukoexit',NULL,NULL,'sea',NULL,NULL,NULL,NULL,'2025-04-14 19:09:35','2025-04-14 19:09:35'),
(4,'TOPUP1744657790278',1,30,125000,125000,0,'pending',NULL,NULL,'yeukoexit',NULL,NULL,'sea',NULL,NULL,NULL,NULL,'2025-04-14 19:09:50','2025-04-14 19:09:50'),
(5,'TOPUP1744718631313',1,19,100000,100000,0,'pending',NULL,NULL,'yeukoexit',NULL,NULL,'aa','aaa',NULL,NULL,NULL,'2025-04-15 12:03:51','2025-04-15 12:03:51'),
(6,'TOPUP1744719214115',1,28,138000,138000,0,'pending',NULL,NULL,'yeukoexit',NULL,NULL,'âd','aaa',NULL,NULL,NULL,'2025-04-15 12:13:34','2025-04-15 12:13:34'),
(7,'TOPUP1744719572242',3,27,100000,100000,0,'pending',NULL,NULL,'Test',NULL,NULL,'test',NULL,NULL,NULL,NULL,'2025-04-15 12:19:32','2025-04-15 12:19:32'),
(8,'TOPUP1744719768334',1,67,126000,126000,0,'pending',NULL,NULL,'yeukoexit',NULL,NULL,'VNG',NULL,NULL,NULL,NULL,'2025-04-15 12:22:48','2025-04-15 12:22:48'),
(9,'TOPUP1744720480655',3,27,100000,100000,0,'pending',NULL,NULL,'Test',NULL,NULL,'test',NULL,NULL,NULL,NULL,'2025-04-15 12:34:40','2025-04-15 12:34:40'),
(10,'TOPUP1744720524744',3,27,100000,100000,0,'pending',NULL,NULL,'Test',NULL,NULL,'test',NULL,NULL,NULL,NULL,'2025-04-15 12:35:24','2025-04-15 12:35:24'),
(11,'TOPUP1744720693750',3,25,50000,50000,0,'pending',NULL,NULL,'Test',NULL,NULL,'test',NULL,NULL,NULL,NULL,'2025-04-15 12:38:13','2025-04-15 12:38:13'),
(12,'TOPUP1744721405266',3,27,100000,100000,0,'pending',NULL,NULL,'Test',NULL,NULL,'test',NULL,NULL,NULL,NULL,'2025-04-15 12:50:05','2025-04-15 12:50:05'),
(13,'TOPUP1744722119699',3,27,100000,100000,0,'pending',NULL,NULL,'Test',NULL,NULL,'test',NULL,NULL,NULL,NULL,'2025-04-15 13:01:59','2025-04-15 13:01:59'),
(14,'TOPUP1744722773880',3,27,100000,100000,0,'pending',NULL,NULL,'Test',NULL,NULL,'test',NULL,NULL,NULL,NULL,'2025-04-15 13:12:53','2025-04-15 13:12:53'),
(15,'TOPUP1744722914228',3,27,100000,100000,0,'paid','wallet','2025-04-15 13:19:38','Test',NULL,NULL,'test',NULL,NULL,NULL,NULL,'2025-04-15 13:15:14','2025-04-15 13:19:38'),
(16,'TOPUP1744723260786',3,73,188000,188000,0,'paid','wallet','2025-04-15 13:21:05','Test',NULL,NULL,'test',NULL,NULL,NULL,NULL,'2025-04-15 13:21:00','2025-04-15 13:21:05'),
(17,'TOPUP1744723287218',3,73,188000,188000,0,'paid','wallet','2025-04-15 13:21:48','Test',NULL,NULL,'test',NULL,NULL,NULL,NULL,'2025-04-15 13:21:27','2025-04-15 13:21:48'),
(18,'TOPUP1744723316451',3,73,188000,188000,0,'paid','wallet','2025-04-15 13:21:58','Test',NULL,NULL,'test',NULL,NULL,NULL,NULL,'2025-04-15 13:21:56','2025-04-15 13:21:58'),
(19,'TOPUP1744723451959',1,67,126000,126000,0,'paid','wallet','2025-04-15 13:24:13','yeukoexit',NULL,NULL,'vng',NULL,NULL,NULL,NULL,'2025-04-15 13:24:11','2025-04-15 13:24:13'),
(20,'TOPUP1744728512153',1,32,252000,252000,0,'paid','wallet','2025-04-15 14:48:34','yeukoexit',NULL,NULL,'VNG','a',NULL,NULL,NULL,'2025-04-15 14:48:32','2025-04-15 14:48:34'),
(21,'TOPUP1744728600571',1,64,126000,126000,0,'completed','wallet','2025-04-15 14:50:02','yeukoexit',NULL,NULL,'VNG',NULL,NULL,NULL,'2025-04-15 15:00:15','2025-04-15 14:50:00','2025-04-15 15:00:15'),
(22,'TOPUP1744729340326',3,27,100000,100000,0,'paid','wallet','2025-04-15 15:02:28','aaaa',NULL,NULL,'123',NULL,NULL,NULL,NULL,'2025-04-15 15:02:20','2025-04-15 15:02:28'),
(23,'TOPUP1744729505537',3,27,100000,100000,0,'paid','wallet','2025-04-15 15:05:07','ádasd1',NULL,NULL,'ádasd2','áddd123123',NULL,NULL,NULL,'2025-04-15 15:05:05','2025-04-15 15:05:07'),
(24,'TOPUP1744730039152',1,31,276000,276000,0,'paid','wallet','2025-04-15 15:14:00','yeukoexit',NULL,NULL,'a','a',NULL,NULL,NULL,'2025-04-15 15:13:59','2025-04-15 15:14:00');
/*!40000 ALTER TABLE `top_up_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `top_up_services`
--

DROP TABLE IF EXISTS `top_up_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `top_up_services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `game_id` bigint(20) unsigned NOT NULL,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `price` decimal(10,0) NOT NULL,
  `sale_price` decimal(10,0) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `login_type` enum('username_password','game_id','both') NOT NULL DEFAULT 'game_id' COMMENT 'Kiểu thông tin đăng nhập yêu cầu',
  `estimated_minutes` int(11) NOT NULL DEFAULT 30,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `top_up_services_slug_unique` (`slug`),
  KEY `top_up_services_game_id_foreign` (`game_id`),
  KEY `top_up_services_category_id_foreign` (`category_id`),
  CONSTRAINT `top_up_services_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `top_up_categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `top_up_services_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `top_up_services`
--

LOCK TABLES `top_up_services` WRITE;
/*!40000 ALTER TABLE `top_up_services` DISABLE KEYS */;
INSERT INTO `top_up_services` VALUES
(3,1,4,'VÉ BỐC THĂM KỶ NIỆM 4 NĂM #1',NULL,NULL,25000,NULL,'topup_services/thumbnails/FDGSZbzImiYwXk6FTug4RpyZsLiU856lVsL5efiu.jpg',NULL,'ve-boc-tham-ky-niem-4-nam-1-1744641660',1,'game_id',1,'2025-04-14 14:41:00','2025-04-14 14:42:04'),
(4,1,4,'Vé bốc thăm Kỷ niệm 4 năm #2',NULL,NULL,75000,NULL,'topup_services/thumbnails/D8gHWiO9Cw2vnJJFz7KK2h1Kek4MMrqBmJMPX0xn.jpg',NULL,'ve-boc-tham-ky-niem-4-nam-2-1744641797',1,'game_id',1,'2025-04-14 14:43:17','2025-04-14 14:43:17'),
(5,1,4,'GÓI BỐC THĂM THEO CHỦ ĐỀ',NULL,NULL,75000,NULL,'topup_services/thumbnails/5hCkm2k3xfOQHqZpTQJhx9R0HCvTMzk23tcA5pSr.jpg',NULL,'goi-boc-tham-theo-chu-de-1744641850',1,'game_id',1,'2025-04-14 14:44:10','2025-04-14 14:44:10'),
(6,1,4,'VÉ BỐC THĂM KỶ NIỆM 4 NĂM #3',NULL,NULL,760000,NULL,'topup_services/thumbnails/3LvdKsgxUSdnEAmR6WkshKpjy2SEyPLBD3X0XLW4.png',NULL,'ve-boc-tham-ky-niem-4-nam-3-1744642040',1,'game_id',1,'2025-04-14 14:47:20','2025-04-14 14:47:20'),
(7,1,4,'VÉ BỐC THĂM KỶ NIỆM 4 NĂM #4',NULL,NULL,2520000,NULL,'topup_services/thumbnails/8FVBBCPWOr264UPkGf5egWhmf6mnrSSf8MQ0Qz3C.jpg',NULL,'ve-boc-tham-ky-niem-4-nam-4-1744642105',1,'game_id',1,'2025-04-14 14:48:25','2025-04-14 14:48:25'),
(8,1,4,'Gói Xu yêu tinh #2',NULL,NULL,50000,NULL,'topup_services/thumbnails/B3EBQMro4QQee20slHJchS1wgXZM8cP7azAItx65.jpg',NULL,'goi-xu-yeu-tinh-2-1744642274',1,'game_id',1,'2025-04-14 14:51:14','2025-04-14 14:51:14'),
(9,1,4,'Gói Xu yêu tinh #3',NULL,NULL,162000,NULL,'topup_services/thumbnails/odDo09nBmlZEuOjl4mCisbtpRQVHreX558RGdtOp.jpg',NULL,'goi-xu-yeu-tinh-3-1744642337',1,'game_id',1,'2025-04-14 14:52:17','2025-04-14 14:52:17'),
(10,1,4,'GÓI XU YÊU TINH #4',NULL,NULL,252000,NULL,'topup_services/thumbnails/l1faydINMAHYdg9lHKECSPXlOZSYrmzIQTrprlvt.jpg',NULL,'goi-xu-yeu-tinh-4-1744642421',1,'game_id',1,'2025-04-14 14:53:41','2025-04-14 14:53:41'),
(11,1,4,'GÓI XU YÊU TINH #5',NULL,NULL,505000,NULL,'topup_services/thumbnails/UPKSoEpAG0Ymq94NIOdj5gMbCWHwfIEYbOL6HJWA.jpg',NULL,'goi-xu-yeu-tinh-5-1744642464',1,'game_id',1,'2025-04-14 14:54:24','2025-04-14 14:54:24'),
(12,1,4,'STREET STYLE NÂU QUẾ',NULL,NULL,125000,NULL,'topup_services/thumbnails/WTDYAJC6WIReDAQbPE0bGEPWptJjWsQBEaYqHOjS.jpg',NULL,'street-style-nau-que-1744642595',1,'game_id',1,'2025-04-14 14:56:35','2025-04-14 14:56:35'),
(13,1,4,'CÔ GÁI ĐẦU ÓC QUAY CUỒNG',NULL,NULL,125000,NULL,'topup_services/thumbnails/uexizIqb8JihPqap657QgqljvG7BbXgC4tWbF6GG.jpg',NULL,'co-gai-dau-oc-quay-cuong-1744642640',1,'game_id',1,'2025-04-14 14:57:20','2025-04-14 14:57:20'),
(15,1,4,'BIỂU TƯỢNG GIRL CRUSH',NULL,NULL,138000,NULL,'topup_services/thumbnails/cEk90i9RlsIOaGvT07IK9qq1UHiHTrPyuz8unssk.jpg',NULL,'bieu-tuong-girl-crush-1744642766',1,'game_id',1,'2025-04-14 14:59:26','2025-04-14 14:59:26'),
(16,1,4,'VỢT ÁNH SAO MƠ MÀNG',NULL,NULL,315000,NULL,'topup_services/thumbnails/InrMM70AOVi9YjBCbOJJrloKUaDSF3IBNmExWSn3.jpg',NULL,'vot-anh-sao-mo-mang-1744642807',1,'game_id',1,'2025-04-14 15:00:07','2025-04-14 15:00:07'),
(17,1,4,'GÓI CHUỘT QUÝ ÔNG',NULL,NULL,100000,NULL,'topup_services/thumbnails/1zrN2KSzD1BFA1LLiJtlef80mUXWbE8abgiZWN8J.jpg',NULL,'goi-chuot-quy-ong-1744642877',1,'game_id',1,'2025-04-14 15:01:17','2025-04-14 15:01:17'),
(18,1,4,'GÓI CHUỘT NƠ',NULL,NULL,100000,NULL,'topup_services/thumbnails/bNSBFuKxNT5IRWTINtN4KaQjHhINE2ZYgNRTDTQe.jpg',NULL,'goi-chuot-no-1744642941',1,'game_id',1,'2025-04-14 15:02:21','2025-04-14 15:02:21'),
(19,1,4,'GÓI CHUỘT HOA',NULL,NULL,100000,NULL,'topup_services/thumbnails/AgcRiATFRgs2rOIxz3hyGU9WkUdUCyM7Ly73Mir7.jpg',NULL,'goi-chuot-hoa-1744642960',1,'game_id',1,'2025-04-14 15:02:40','2025-04-14 15:02:40'),
(20,1,4,'GÓI CHUỘT HẦU GÁI',NULL,NULL,100000,NULL,'topup_services/thumbnails/Mu68HMWRUdUqu8aTmck4Eb9qi6e2abFV42UNpXT8.jpg',NULL,'goi-chuot-hau-gai-1744643016',1,'game_id',1,'2025-04-14 15:03:36','2025-04-14 15:03:36'),
(21,1,4,'GÓI NGƯỜI BẠN BẠC MÁ ĐUÔI DÀI',NULL,NULL,75000,NULL,'topup_services/thumbnails/bgPo31U6oMx258Tg1HoZvBjDrpkPeCoGSBd6twN2.jpg',NULL,'goi-nguoi-ban-bac-ma-duoi-dai-1744643080',1,'game_id',1,'2025-04-14 15:04:40','2025-04-14 15:04:40'),
(22,1,4,'GÓI GIA ĐÌNH BẠC MÁ ĐUÔI DÀI',NULL,NULL,251000,NULL,'topup_services/thumbnails/mtg6uareNNs06OUyFeCPkOtDGAZRmfQTzofyDtwp.jpg',NULL,'goi-gia-dinh-bac-ma-duoi-dai-1744643120',1,'game_id',1,'2025-04-14 15:05:20','2025-04-14 15:05:20'),
(23,1,4,'GÓI ÁO DÀI HOA SEN NỮ',NULL,NULL,125000,NULL,'topup_services/thumbnails/OI4lfn8hmCVhfddmA5ttZZPv6970c0PLmsLUH8ry.jpg',NULL,'goi-ao-dai-hoa-sen-nu-1744643183',1,'game_id',1,'2025-04-14 15:06:23','2025-04-14 15:06:23'),
(24,1,4,'GÓI ÁO DÀI HOA SEN NAM',NULL,NULL,125000,NULL,'topup_services/thumbnails/VrTjI28a1McDH2MwsCAkCjisp2uSZEj40myFjD9e.jpg',NULL,'goi-ao-dai-hoa-sen-nam-1744643208',1,'game_id',1,'2025-04-14 15:06:48','2025-04-14 15:06:48'),
(25,1,4,'Gói Đồ thể thao ORBIT','<p>FULL MÀU CÁC BẠN IB MÌNH ĐỂ XÁC NHẬN MÀU NHÉ</p>',NULL,50000,NULL,'topup_services/thumbnails/i0Q6vyW2d1xnbtEvrtUpp3z0r5ktVoMQty3uYGPY.jpg',NULL,'goi-do-the-thao-orbit-1744643276',1,'game_id',1,'2025-04-14 15:07:56','2025-04-14 15:07:56'),
(26,1,5,'GÓI CUNG HOÀNG ĐẠO NAM',NULL,NULL,100000,NULL,'topup_services/thumbnails/9VXbiRHfwNqzcWqOIXJvy4NwATS5H2SWbjYfZboE.jpg',NULL,'goi-cung-hoang-dao-nam-1744643380',1,'game_id',1,'2025-04-14 15:09:40','2025-04-14 15:09:40'),
(27,1,5,'GÓI CUNG HOÀNG ĐẠO NỮ',NULL,NULL,100000,NULL,'topup_services/thumbnails/t4Wd2W1eXtRRhFb9kTvS55pHGh56BSywL5ZREchJ.jpg',NULL,'goi-cung-hoang-dao-nu-1744643412',1,'game_id',1,'2025-04-14 15:10:12','2025-04-14 15:10:45'),
(28,1,7,'MÙA GIẤC MƠ VƯƠNG QUỐC MÂY',NULL,NULL,138000,NULL,'topup_services/thumbnails/yAObySYSHhEgdvkp9cbkm4DnzaCeWOLWF2zIeeUW.jpg',NULL,'mua-giac-mo-vuong-quoc-may-1744643599',1,'game_id',1,'2025-04-14 15:13:19','2025-04-14 15:13:19'),
(29,1,7,'MÙA GIẤC MƠ VƯƠNG QUỐC MÂY VIP',NULL,NULL,315000,NULL,'topup_services/thumbnails/uvjcBNzOfVziNrEVGWgNZXXoMExuZRVOEHAlppIb.jpg',NULL,'mua-giac-mo-vuong-quoc-may-vip-1744643641',1,'game_id',1,'2025-04-14 15:14:01','2025-04-14 15:14:01'),
(30,1,7,'PHÍ THÀNH VIÊN HÀNG THÁNG',NULL,NULL,125000,NULL,'topup_services/thumbnails/UcnVLTXXZr2HKAigeER0GpUrRuSNTl8CRACbvGKN.jpg',NULL,'phi-thanh-vien-hang-thang-1744643671',1,'game_id',1,'2025-04-14 15:14:31','2025-04-14 15:14:40'),
(31,1,7,'BẢNG ĐIỂM DANH GÓI THẺ 30 NGÀY',NULL,NULL,276000,NULL,'topup_services/thumbnails/wsu1ASMm0oPDtmVZDB4ojVNG0NrN2IrB79SF7zJw.jpg',NULL,'bang-diem-danh-goi-the-30-ngay-1744643746',1,'game_id',1,'2025-04-14 15:15:46','2025-04-14 15:15:56'),
(32,1,7,'BẢNG ĐIỂM DANH GÓI THẺ 30 NGÀY',NULL,NULL,252000,NULL,'topup_services/thumbnails/7KHiEOspxFGHh78LdOAOS1lVpmcuyeqBeqojmehM.jpg',NULL,'bang-diem-danh-goi-the-30-ngay-1744643773',1,'game_id',1,'2025-04-14 15:16:13','2025-04-14 15:16:13'),
(33,1,7,'BẢNG ĐIỂM DANH GÓI THẺ 7 NGÀY SIÊU CAO CẤP',NULL,NULL,505000,NULL,'topup_services/thumbnails/4WJmD8nKmmfUTb2VZtEjAbV8jplG3WwO6ZuZMsao.jpg',NULL,'bang-diem-danh-goi-the-7-ngay-sieu-cao-cap-1744643813',1,'game_id',1,'2025-04-14 15:16:53','2025-04-14 15:16:53'),
(34,1,8,'Vé bốc My Melody & Kuromi 1',NULL,NULL,162000,NULL,'topup_services/thumbnails/G9GQmXUEDoK3QHIH8EsixzVhtKzjqXvXa7EISu3r.jpg',NULL,'ve-boc-my-melody-kuromi-1-1744644086',1,'game_id',1,'2025-04-14 15:21:26','2025-04-14 15:21:26'),
(35,1,8,'GÓI Trang phục Hello Kitty KM',NULL,NULL,162000,NULL,'topup_services/thumbnails/JJXKUPA1KxW0o1Z71QUZRTpO6dZCckgZsQeS9bFL.jpg',NULL,'goi-trang-phuc-hello-kitty-km-1744644180',1,'game_id',1,'2025-04-14 15:23:00','2025-04-14 15:23:00'),
(36,1,8,'Trang phục Cinnamoroll KM',NULL,NULL,162000,NULL,'topup_services/thumbnails/fZkbSyw2jbMeUDX6bBhOKjtiEoBoSms265P8hWnr.jpg',NULL,'trang-phuc-cinnamoroll-km-1744644220',1,'game_id',1,'2025-04-14 15:23:40','2025-04-14 15:23:40'),
(37,1,8,'XE MUI TRẦN CINNAMOROLL',NULL,NULL,225000,NULL,'topup_services/thumbnails/nL7GrjwTwRZ5Gk4iQ4vmSMsLDT8Vg0HJSdewFpJA.jpg',NULL,'xe-mui-tran-cinnamoroll-1744644256',1,'game_id',1,'2025-04-14 15:24:16','2025-04-14 15:24:16'),
(38,1,8,'CẦN CÂU HELLO KITTY KM',NULL,NULL,375000,NULL,'topup_services/thumbnails/v8Y0T8PjLbvjA9FCd5xwOGIM8S4oXo4Ane4lfS8d.jpg',NULL,'can-cau-hello-kitty-km-1744644300',1,'game_id',1,'2025-04-14 15:25:00','2025-04-14 15:25:00'),
(39,1,8,'CẦN CÂU CINNAMOROLL',NULL,NULL,375000,NULL,'topup_services/thumbnails/nUFEbpJtpWE7QEd9hVFnz6LVI647mdF3Bs22niJh.jpg',NULL,'can-cau-cinnamoroll-1744644338',1,'game_id',1,'2025-04-14 15:25:38','2025-04-14 15:25:38'),
(40,1,9,'MỘT ÍT ĐÁ QUÝ',NULL,NULL,50000,NULL,'topup_services/thumbnails/1k1bLk81Daw0xplENDAUHzlQ3RhTH7pLE6jfrNwz.jpg',NULL,'mot-it-da-quy-1744644453',1,'game_id',1,'2025-04-14 15:27:33','2025-04-14 15:27:33'),
(41,1,9,'CHỒNG ĐÁ QUÝ',NULL,NULL,125000,NULL,'topup_services/thumbnails/Qa02TbLNaeVzEiHvYkaTpHO2hv3MBpBzGSy9cYzx.jpg',NULL,'chong-da-quy-1744644493',1,'game_id',1,'2025-04-14 15:28:13','2025-04-14 15:28:13'),
(42,1,9,'BẮP RANG ĐÁ QUÝ',NULL,NULL,252000,NULL,'topup_services/thumbnails/2HvvL9zjeWk4xSk81wNfbiDFvAjy0cLnzV2YWDKA.jpg',NULL,'bap-rang-da-quy-1744644522',1,'game_id',1,'2025-04-14 15:28:42','2025-04-14 15:28:42'),
(44,1,9,'RỔ ĐÁ QUÝ',NULL,NULL,505000,NULL,'topup_services/thumbnails/CIpNTslYU1VkyCitAAtZJ8V8iJScYXoJqIdYXpt1.jpg',NULL,'ro-da-quy-1744644614',1,'game_id',1,'2025-04-14 15:30:14','2025-04-14 15:30:14'),
(45,1,9,'VALI ĐÁ QUÝ',NULL,NULL,1250000,NULL,'topup_services/thumbnails/H9tIR2vf77bKEAWy1Bw6cvAiIkzsiNBBkw9SocK0.jpg',NULL,'vali-da-quy-1744644650',1,'game_id',1,'2025-04-14 15:30:50','2025-04-14 15:30:50'),
(46,1,9,'THÙNG ĐÁ QUÝ',NULL,NULL,2520000,NULL,'topup_services/thumbnails/9uD2oruiJaTvQvpfdlfwAkdB2oQ07O3L311PmFJ5.jpg',NULL,'thung-da-quy-1744644685',1,'game_id',1,'2025-04-14 15:31:25','2025-04-14 15:31:25'),
(47,1,9,'THỎI VÀNG',NULL,NULL,61000,NULL,'topup_services/thumbnails/JliEK1QYqo730N6aPc5nPzp7YrG2ylLLt8WnmmhL.jpg',NULL,'thoi-vang-1744644726',1,'game_id',1,'2025-04-14 15:32:06','2025-04-14 15:32:06'),
(48,1,9,'VÀI THỎI VÀNG',NULL,NULL,162000,NULL,'topup_services/thumbnails/6xMoYjqE7USw673rWBZghvgJv90tMthToBFO3biM.jpg',NULL,'vai-thoi-vang-1744644752',1,'game_id',1,'2025-04-14 15:32:32','2025-04-14 15:32:32'),
(49,1,9,'CHỒNG THỎI VÀNG',NULL,NULL,310000,NULL,'topup_services/thumbnails/27AWG2P1ZuiBzg7rUNoJ8MypmPj4lWLup602LbOW.jpg',NULL,'chong-thoi-vang-1744644778',1,'game_id',1,'2025-04-14 15:32:58','2025-04-14 15:32:58'),
(50,1,9,'HỘP VÀNG',NULL,NULL,630000,NULL,'topup_services/thumbnails/wK7uh2oa46YfI13S95mvB9Ur7fge4mdCdevL1tWW.jpg',NULL,'hop-vang-1744644818',1,'game_id',1,'2025-04-14 15:33:38','2025-04-14 15:33:38'),
(51,1,9,'VALI VÀNG',NULL,NULL,1640000,NULL,'topup_services/thumbnails/9ugVbR4tQXlXSiLU0HRDzsTCakaV2c3A1OZeYZHm.jpg',NULL,'vali-vang-1744644882',1,'game_id',1,'2025-04-14 15:34:42','2025-04-14 15:34:42'),
(52,1,9,'KÉT VÀNG',NULL,NULL,3170000,NULL,'topup_services/thumbnails/TDwyrFvZg17bxOItYYDl3UTdj6zgphS1IZ8mgPSi.jpg',NULL,'ket-vang-1744644908',1,'game_id',1,'2025-04-14 15:35:08','2025-04-14 15:35:08'),
(53,1,9,'GÓI ĐÁ QUÝ 1+1 1',NULL,NULL,252000,NULL,'topup_services/thumbnails/ay1gbsZ0LSQfeAxZ8P8OGUJdgmc3S6iUM2ID620h.jpg',NULL,'goi-da-quy-11-1-1744644948',1,'game_id',1,'2025-04-14 15:35:48','2025-04-14 15:35:48'),
(54,1,9,'GÓI ĐÁ QUÝ 1+1 2',NULL,NULL,501000,NULL,'topup_services/thumbnails/IQsOHN0ZTPL0ggE2dt4NeI054FBUGasSjtxQgYQ6.jpg',NULL,'goi-da-quy-11-2-1744644976',1,'game_id',1,'2025-04-14 15:36:16','2025-04-14 15:36:16'),
(55,1,9,'GÓI ĐÁ QUÝ 1+1 3',NULL,NULL,1268000,NULL,'topup_services/thumbnails/I2Kdgw0HNxDFEQ8tfZ9DboslmM8gQEFEUpXrNBv3.jpg',NULL,'goi-da-quy-11-3-1744645005',1,'game_id',1,'2025-04-14 15:36:45','2025-04-14 17:32:41'),
(56,1,9,'Gói đá quý 1+1 4',NULL,NULL,2530000,NULL,'topup_services/thumbnails/3RI3mWaOXrBJSwfwlHlG0NeuN7Kv3PC4dDYZv0BV.jpg',NULL,'goi-da-quy-11-4-1744645059',1,'game_id',1,'2025-04-14 15:37:39','2025-04-14 15:37:39'),
(57,1,10,'TRỨNG SAMOYED',NULL,NULL,75000,NULL,'topup_services/thumbnails/gylLvVomNpqdMZv9aLkly2tPXIjnwveGl1q6tPIQ.jpg',NULL,'trung-samoyed-1744651000',1,'game_id',1,'2025-04-14 17:16:40','2025-04-14 17:16:40'),
(58,1,10,'Hươu ánh trăng KM',NULL,NULL,165000,NULL,'topup_services/thumbnails/Li2DX0y98hEtv5rku7rX754br1b18rbY6LIcn3Uk.jpg',NULL,'huou-anh-trang-km-1744651046',1,'game_id',1,'2025-04-14 17:17:26','2025-04-14 17:17:26'),
(59,1,10,'BEAT BOY SÀNH ĐIỆU KM',NULL,NULL,75000,NULL,'topup_services/thumbnails/DA1e8A7anh4NXtdlRSh8OKebfDqcVxFVwXhdpJ23.jpg',NULL,'beat-boy-sanh-dieu-km-1744651089',1,'game_id',1,'2025-04-14 17:18:09','2025-04-14 17:18:09'),
(60,1,10,'MIÊU NỮ BẠC HÀ',NULL,NULL,75000,NULL,'topup_services/thumbnails/5b9WymCIhjRbAzSW1noLCRgNWWFcUl1vFwOo14Th.jpg',NULL,'mieu-nu-bac-ha-1744651139',1,'game_id',1,'2025-04-14 17:18:59','2025-04-14 17:18:59'),
(61,1,10,'CÔ GÁI MA KM',NULL,NULL,126000,NULL,'topup_services/thumbnails/vILn5ofcNehDwg1VRpYsMh1rCuklrkEd3m5kYPh4.jpg',NULL,'co-gai-ma-km-1744651187',1,'game_id',1,'2025-04-14 17:19:47','2025-04-14 17:19:47'),
(62,1,10,'CHÀNG TRAI SOFT CREAM KM',NULL,NULL,100000,NULL,'topup_services/thumbnails/LAdHac6Aorj2e9NjivH17wdLBndwVrywNSYl7dQp.jpg',NULL,'chang-trai-soft-cream-km-1744651220',1,'game_id',1,'2025-04-14 17:20:20','2025-04-14 17:20:20'),
(63,1,10,'GÓI MAGIC GIRL ÁNH SAO KM',NULL,NULL,126000,NULL,'topup_services/thumbnails/5qjCst4ejXBl9fEjYhUNcA91GOlgGCGByydPQZpW.jpg',NULL,'goi-magic-girl-anh-sao-km-1744651269',1,'game_id',1,'2025-04-14 17:21:09','2025-04-14 17:21:09'),
(64,1,10,'GÓI MAGIC GIRL NƯỚC KM',NULL,NULL,126000,NULL,'topup_services/thumbnails/0FxNJYZD5AKaJbXmOOdmUjYmOrbMZFdi3xW8A8xY.jpg',NULL,'goi-magic-girl-nuoc-km-1744651297',1,'game_id',1,'2025-04-14 17:21:37','2025-04-14 17:21:37'),
(65,1,10,'GÓI MAGIC GIRL TÌNH YÊU KM',NULL,NULL,126000,NULL,'topup_services/thumbnails/zeHHYhBkuGTapm3p3phoEFXsosU1ap1zXf7eXn0c.jpg',NULL,'goi-magic-girl-tinh-yeu-km-1744651313',1,'game_id',1,'2025-04-14 17:21:53','2025-04-14 17:21:53'),
(66,1,10,'GÓI MÈO HUẤN LUYỆN',NULL,NULL,126000,NULL,'topup_services/thumbnails/aCkgGGokebBqQ9yaWYbyBdR1phRPPPWDOTnQWjMC.jpg',NULL,'goi-meo-huan-luyen-1744651357',1,'game_id',1,'2025-04-14 17:22:37','2025-04-14 17:22:37'),
(67,1,10,'DARK BLOOD KM',NULL,NULL,126000,NULL,'topup_services/thumbnails/yKno4nYIyKBJYYS4XKoEpFF4jG8jZve71hVwo3g6.jpg',NULL,'dark-blood-km-1744651386',1,'game_id',1,'2025-04-14 17:23:06','2025-04-14 17:23:16'),
(68,1,11,'CẦN CÂU SỒI TÍM',NULL,NULL,100000,NULL,'topup_services/thumbnails/ElLuk4g9DlfIQReP3P05pAu4oMC0LE9f6ILgXBp9.jpg',NULL,'can-cau-soi-tim-1744651560',1,'game_id',1,'2025-04-14 17:26:00','2025-04-14 17:26:00'),
(69,1,11,'Gói Lớp Học Brown',NULL,NULL,160000,NULL,'topup_services/thumbnails/29Z3gwnnYJgsetOLVKqmN4qnhTxWBCVVASPbrfi0.jpg',NULL,'goi-lop-hoc-brown-1744651652',1,'game_id',1,'2025-04-14 17:27:33','2025-04-14 17:27:33'),
(70,1,11,'Gói Lớp Học Sally',NULL,NULL,160000,NULL,'topup_services/thumbnails/DdJ6c5qKiYrIjNvh0z5nZWeuYejflqrSUhd1Ejm9.jpg',NULL,'goi-lop-hoc-sally-1744651674',1,'game_id',1,'2025-04-14 17:27:54','2025-04-14 17:27:54'),
(71,1,11,'Gói LINE FRIENDS',NULL,NULL,310000,NULL,'topup_services/thumbnails/jAQfkVjjeFvHAjiQZqUDhvBR8CeNQo1E1WsefKBE.jpg',NULL,'goi-line-friends-1744651733',1,'game_id',1,'2025-04-14 17:28:53','2025-04-14 17:28:53'),
(72,1,11,'Gói Trang phục CHOCO',NULL,NULL,188000,NULL,'topup_services/thumbnails/Al2PsPZwx1qJuINLXakiGmbVcG2EtuWU8zKWYIRP.jpg',NULL,'goi-trang-phuc-choco-1744651821',1,'game_id',1,'2025-04-14 17:30:21','2025-04-14 17:30:21'),
(73,1,11,'GÓI TRANG PHỤC CONY',NULL,'123123222',188000,NULL,'topup_services/thumbnails/51PbEOVvBCXYj6KjRVQktJof4imkS3868U71725Z.jpg',NULL,'goi-trang-phuc-cony-1744651871',1,'game_id',1,'2025-04-14 17:31:11','2025-04-15 17:28:38');
/*!40000 ALTER TABLE `top_up_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned DEFAULT NULL,
  `boosting_order_id` bigint(20) unsigned DEFAULT NULL,
  `top_up_order_id` bigint(20) unsigned DEFAULT NULL,
  `game_service_order_id` bigint(20) unsigned DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','completed','failed','refunded') NOT NULL DEFAULT 'pending',
  `payment_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payment_details`)),
  `notes` text DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_order_id_foreign` (`order_id`),
  KEY `transactions_boosting_order_id_foreign` (`boosting_order_id`),
  KEY `transactions_top_up_order_id_foreign` (`top_up_order_id`),
  CONSTRAINT `transactions_boosting_order_id_foreign` FOREIGN KEY (`boosting_order_id`) REFERENCES `boosting_orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transactions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transactions_top_up_order_id_foreign` FOREIGN KEY (`top_up_order_id`) REFERENCES `top_up_orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL DEFAULT 2,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `phone` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,1,'Admin','admin@shopbuffsao.com',NULL,'$2y$10$AZseUEh24g4Th0CC4s4yRea/YF3YhJAGcMFyyDBDI6XyvGaF3bYNi',NULL,'2025-04-14 07:09:51','2025-04-14 07:09:51',0.00,NULL,1),
(2,2,'ADFADWADAWD','test@gmail.com',NULL,'$2y$10$opKry/xxQG5fEZt3n9wDN.JtKaBXoIfFV6/oVnCq6uVv4rPDE96ym',NULL,'2025-04-14 15:17:42','2025-04-14 15:17:42',0.00,NULL,1),
(3,2,'test','test111@gmail.com',NULL,'$2y$10$o/u8I7p0Y7GzH479s4ytz.PdXpadCO6FhoPfP7J2n6C7vbs8HDrfu',NULL,'2025-04-15 12:19:07','2025-04-15 12:19:07',0.00,NULL,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wallet_deposits`
--

DROP TABLE IF EXISTS `wallet_deposits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wallet_deposits` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `wallet_id` bigint(20) unsigned DEFAULT NULL,
  `deposit_code` varchar(255) NOT NULL COMMENT 'Mã nạp tiền duy nhất (WALLET-xxxx)',
  `amount` decimal(12,0) NOT NULL DEFAULT 0 COMMENT 'Số tiền nạp',
  `payment_method` varchar(255) NOT NULL DEFAULT 'bank_transfer' COMMENT 'Phương thức thanh toán',
  `status` varchar(255) NOT NULL DEFAULT 'pending' COMMENT 'Trạng thái: pending, completed, failed',
  `payment_content` text DEFAULT NULL COMMENT 'Nội dung chuyển khoản',
  `transaction_id` varchar(255) DEFAULT NULL COMMENT 'ID giao dịch từ cổng thanh toán',
  `metadata` text DEFAULT NULL COMMENT 'Dữ liệu bổ sung',
  `completed_at` timestamp NULL DEFAULT NULL COMMENT 'Thời gian hoàn thành',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wallet_deposits_deposit_code_unique` (`deposit_code`),
  KEY `wallet_deposits_wallet_id_foreign` (`wallet_id`),
  KEY `wallet_deposits_deposit_code_index` (`deposit_code`),
  KEY `wallet_deposits_status_index` (`status`),
  KEY `wallet_deposits_user_id_index` (`user_id`),
  CONSTRAINT `wallet_deposits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wallet_deposits_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallet_deposits`
--

LOCK TABLES `wallet_deposits` WRITE;
/*!40000 ALTER TABLE `wallet_deposits` DISABLE KEYS */;
INSERT INTO `wallet_deposits` VALUES
(1,1,1,'WALLET-17446505549234',0,'bank_transfer','pending',NULL,NULL,NULL,NULL,'2025-04-14 17:09:14','2025-04-14 17:09:14'),
(2,2,2,'WALLET-17446579328090',0,'bank_transfer','pending',NULL,NULL,NULL,NULL,'2025-04-14 19:12:12','2025-04-14 19:12:12'),
(3,3,3,'WALLET-17447196359667',50000,'bank_transfer','pending','SEVQR ORDWALLET17447196359667',NULL,NULL,NULL,'2025-04-15 12:20:35','2025-04-15 12:24:49'),
(4,3,3,'WALLET-17447201139555',1000000,'bank_transfer','pending','SEVQR ORDWALLET17447201139555',NULL,NULL,NULL,'2025-04-15 12:28:33','2025-04-15 12:28:36');
/*!40000 ALTER TABLE `wallet_deposits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wallet_transactions`
--

DROP TABLE IF EXISTS `wallet_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wallet_transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `wallet_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `type` varchar(255) NOT NULL COMMENT 'deposit, withdraw, payment, refund',
  `amount` decimal(12,0) NOT NULL,
  `balance_before` decimal(12,0) NOT NULL,
  `balance_after` decimal(12,0) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `reference_id` varchar(255) DEFAULT NULL COMMENT 'ID của đơn hàng, giao dịch nạp tiền, v.v.',
  `reference_type` varchar(255) DEFAULT NULL COMMENT 'Order, BoostingOrder, Deposit',
  `status` varchar(255) NOT NULL DEFAULT 'completed',
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wallet_transactions_wallet_id_foreign` (`wallet_id`),
  KEY `wallet_transactions_user_id_foreign` (`user_id`),
  CONSTRAINT `wallet_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wallet_transactions_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallet_transactions`
--

LOCK TABLES `wallet_transactions` WRITE;
/*!40000 ALTER TABLE `wallet_transactions` DISABLE KEYS */;
INSERT INTO `wallet_transactions` VALUES
(1,1,1,'deposit',100000,0,100000,'11 (Điều chỉnh bởi Admin)','1','admin_adjustment','completed',NULL,'2025-04-14 19:05:03','2025-04-14 19:05:03'),
(2,1,1,'deposit',1000000000,100000,1000100000,'s (Điều chỉnh bởi Admin)','1','admin_adjustment','completed',NULL,'2025-04-14 19:05:18','2025-04-14 19:05:18'),
(3,1,1,'payment',-150000,1000100000,999950000,'Thanh toán mua tài khoản #ORD-4CE822DB69','1','Order','completed',NULL,'2025-04-14 19:05:21','2025-04-14 19:05:21'),
(4,1,1,'payment',-15000,999950000,999935000,'Thanh toán dịch vụ game #SRV-17446575666260','1','ServiceOrder','completed',NULL,'2025-04-14 19:06:08','2025-04-14 19:06:08'),
(5,1,1,'payment',-20000,999935000,999915000,'Thanh toán dịch vụ game #SRV-17447198095524','2','ServiceOrder','completed',NULL,'2025-04-15 12:23:31','2025-04-15 12:23:31'),
(6,3,3,'deposit',10000,0,10000,'a (Điều chỉnh bởi Admin)','1','admin_adjustment','completed',NULL,'2025-04-15 12:30:07','2025-04-15 12:30:07'),
(7,3,3,'deposit',100000000,10000,100010000,'aaa (Điều chỉnh bởi Admin)','1','admin_adjustment','completed',NULL,'2025-04-15 12:31:04','2025-04-15 12:31:04'),
(8,3,3,'payment',-50000,100010000,99960000,'Thanh toán dịch vụ game #SRV-17447208148282','3','ServiceOrder','completed',NULL,'2025-04-15 12:40:16','2025-04-15 12:40:16'),
(9,3,3,'payment',-20000,99960000,99940000,'Thanh toán dịch vụ game #SRV-17447221445216','4','ServiceOrder','completed',NULL,'2025-04-15 13:02:26','2025-04-15 13:02:26'),
(11,3,3,'payment',-50000,99940000,99890000,'Thanh toán dịch vụ game #SRV-17447228693320','5','ServiceOrder','completed',NULL,'2025-04-15 13:15:02','2025-04-15 13:15:02'),
(13,3,3,'payment',-100000,99890000,99790000,'Thanh toán dịch vụ nạp hộ #TOPUP1744722914228','15','TopUpOrder','completed',NULL,'2025-04-15 13:19:38','2025-04-15 13:19:38'),
(14,3,3,'payment',-188000,99790000,99602000,'Thanh toán dịch vụ nạp hộ #TOPUP1744723260786','16','TopUpOrder','completed',NULL,'2025-04-15 13:21:05','2025-04-15 13:21:05'),
(15,3,3,'payment',-188000,99602000,99414000,'Thanh toán dịch vụ nạp hộ #TOPUP1744723287218','17','TopUpOrder','completed',NULL,'2025-04-15 13:21:48','2025-04-15 13:21:48'),
(16,3,3,'payment',-188000,99414000,99226000,'Thanh toán dịch vụ nạp hộ #TOPUP1744723316451','18','TopUpOrder','completed',NULL,'2025-04-15 13:21:58','2025-04-15 13:21:58'),
(17,1,1,'payment',-126000,999915000,999789000,'Thanh toán dịch vụ nạp hộ #TOPUP1744723451959','19','TopUpOrder','completed',NULL,'2025-04-15 13:24:13','2025-04-15 13:24:13'),
(18,1,1,'payment',-252000,999789000,999537000,'Thanh toán dịch vụ nạp hộ #TOPUP1744728512153','20','TopUpOrder','completed',NULL,'2025-04-15 14:48:34','2025-04-15 14:48:34'),
(19,1,1,'payment',-126000,999537000,999411000,'Thanh toán dịch vụ nạp hộ #TOPUP1744728600571','21','TopUpOrder','completed',NULL,'2025-04-15 14:50:02','2025-04-15 14:50:02'),
(20,3,3,'payment',-100000,99226000,99126000,'Thanh toán dịch vụ nạp hộ #TOPUP1744729340326','22','TopUpOrder','completed',NULL,'2025-04-15 15:02:28','2025-04-15 15:02:28'),
(21,3,3,'payment',-100000,99126000,99026000,'Thanh toán dịch vụ nạp hộ #TOPUP1744729505537','23','TopUpOrder','completed',NULL,'2025-04-15 15:05:07','2025-04-15 15:05:07'),
(22,1,1,'payment',-276000,999411000,999135000,'Thanh toán dịch vụ nạp hộ #TOPUP1744730039152','24','TopUpOrder','completed',NULL,'2025-04-15 15:14:00','2025-04-15 15:14:00');
/*!40000 ALTER TABLE `wallet_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wallets`
--

DROP TABLE IF EXISTS `wallets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wallets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `balance` decimal(12,0) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wallets_user_id_foreign` (`user_id`),
  CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallets`
--

LOCK TABLES `wallets` WRITE;
/*!40000 ALTER TABLE `wallets` DISABLE KEYS */;
INSERT INTO `wallets` VALUES
(1,1,999135000,1,'2025-04-14 08:16:48','2025-04-15 15:14:00'),
(2,2,0,1,'2025-04-14 19:12:12','2025-04-14 19:12:12'),
(3,3,99026000,1,'2025-04-15 12:20:35','2025-04-15 15:05:07');
/*!40000 ALTER TABLE `wallets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-16  0:36:18
