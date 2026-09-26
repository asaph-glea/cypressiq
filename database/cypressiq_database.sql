-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: cypressiq
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `user_name` varchar(120) DEFAULT NULL,
  `user_email` varchar(150) DEFAULT NULL,
  `role` varchar(32) DEFAULT NULL,
  `action` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `entity_type` varchar(120) DEFAULT NULL,
  `entity_id` bigint(20) unsigned DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `activity_logs_user_id_foreign` (`user_id`),
  KEY `activity_logs_entity_type_entity_id_index` (`entity_type`,`entity_id`),
  KEY `activity_logs_action_index` (`action`),
  KEY `activity_logs_created_at_index` (`created_at`),
  CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_logs`
--

LOCK TABLES `activity_logs` WRITE;
/*!40000 ALTER TABLE `activity_logs` DISABLE KEYS */;
INSERT INTO `activity_logs` VALUES (1,1,'Executive Admin','admin@cypressiq.agency','super_admin','auth.login','User \'Executive Admin\' (Super Admin) successfully logged into the cockpit.','App\\Models\\User',1,'{\"ip\":\"127.0.0.1\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36','2026-09-25 14:06:56'),(2,1,'Executive Admin','admin@cypressiq.agency','super_admin','auth.logout','User \'Executive Admin\' (Super Admin) logged out.','App\\Models\\User',1,'{\"ip\":\"127.0.0.1\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36','2026-09-25 14:10:26'),(3,2,'Growth & Sales Team','growth@cypressiq.agency','growth','auth.login','User \'Growth & Sales Team\' (Growth & Marketing) successfully logged into the cockpit.','App\\Models\\User',2,'{\"ip\":\"127.0.0.1\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36','2026-09-25 14:11:14'),(4,2,'Growth & Sales Team','growth@cypressiq.agency','growth','auth.logout','User \'Growth & Sales Team\' (Growth & Marketing) logged out.','App\\Models\\User',2,'{\"ip\":\"127.0.0.1\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36','2026-09-25 14:12:18'),(5,3,'Product & Engineering Lead','engineer@cypressiq.agency','product_engineer','auth.login','User \'Product & Engineering Lead\' (Product & Engineering) successfully logged into the cockpit.','App\\Models\\User',3,'{\"ip\":\"127.0.0.1\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36','2026-09-25 14:13:35'),(6,3,'Product & Engineering Lead','engineer@cypressiq.agency','product_engineer','auth.logout','User \'Product & Engineering Lead\' (Product & Engineering) logged out.','App\\Models\\User',3,'{\"ip\":\"127.0.0.1\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36','2026-09-25 14:21:58'),(7,1,'Executive Admin','admin@cypressiq.agency','super_admin','auth.login','User \'Executive Admin\' (Super Admin) successfully logged into the cockpit.','App\\Models\\User',1,'{\"ip\":\"127.0.0.1\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36','2026-09-25 14:22:46'),(8,1,'Executive Admin','admin@cypressiq.agency','super_admin','auth.logout','User \'Executive Admin\' (Super Admin) logged out.','App\\Models\\User',1,'{\"ip\":\"127.0.0.1\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36','2026-09-25 14:34:02'),(9,1,'Executive Admin','admin@cypressiq.agency','super_admin','auth.login','User \'Executive Admin\' (Super Admin) successfully logged into the cockpit.','App\\Models\\User',1,'{\"ip\":\"127.0.0.1\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36','2026-09-25 14:35:27');
/*!40000 ALTER TABLE `activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `preferred_time_slot` varchar(255) NOT NULL,
  `status` enum('pending','confirmed','completed') NOT NULL DEFAULT 'pending',
  `assigned_to` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookings_assigned_to_foreign` (`assigned_to`),
  CONSTRAINT `bookings_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (1,'Sheldon','Sheldon@gmail.com','0743222222','Mon 9:00 AM','pending',NULL,'2026-04-10 09:26:14','2026-04-10 09:26:14');
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
INSERT INTO `cache` VALUES ('cypressiq-cache-356a192b7913b04c54574d18c28d46e6395428ab','i:1;',1790166514),('cypressiq-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer','i:1790166514;',1790166514),('cypressiq-cache-5c785c036466adea360111aa28563bfd556b5fba','i:1;',1790357786),('cypressiq-cache-5c785c036466adea360111aa28563bfd556b5fba:timer','i:1790357786;',1790357786),('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab','i:1;',1775824604),('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer','i:1775824604;',1775824604),('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba','i:2;',1780730473),('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba:timer','i:1780730473;',1780730473);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Digital Marketing','digital-marketing',NULL,'2026-04-01 12:01:23','2026-04-01 12:01:23'),(2,'Web Development','web-development',NULL,'2026-04-01 12:01:23','2026-04-01 12:01:23'),(3,'SEO','seo',NULL,'2026-04-01 12:01:23','2026-04-01 12:01:23'),(4,'Business Automation','business-automation',NULL,'2026-04-01 12:01:23','2026-04-01 12:01:23'),(5,'E-Commerce','e-commerce',NULL,'2026-04-01 12:01:23','2026-04-01 12:01:23');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `service_interest` varchar(255) DEFAULT NULL,
  `budget_range` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `source` varchar(255) NOT NULL DEFAULT 'contact_page',
  `status` enum('new','read','replied') NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_messages`
--

LOCK TABLES `contact_messages` WRITE;
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
INSERT INTO `contact_messages` VALUES (1,'Sheldon','Cooper','sheldon@gmail.com','7482908765432','Website Development','Under $250/month','Digital optimization','contact_page','new','2026-04-10 09:34:53','2026-04-10 09:35:07'),(2,'Sheldon','Cooper','sheldon@caltech.edu','+254799111222','Business Operations (Opero ERP)',NULL,'[Operational Scale: Multi-Branch (2-10 Outlets)]\r\n\r\nWe need an ITIKIA engagement hub for 50,000+ public campaign volunteers and content dispatching.','project_discovery_engine','new','2026-09-23 06:54:56','2026-09-23 06:54:56');
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_settings`
--

DROP TABLE IF EXISTS `contact_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `whatsapp_number` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `google_map_embed` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_settings`
--

LOCK TABLES `contact_settings` WRITE;
/*!40000 ALTER TABLE `contact_settings` DISABLE KEYS */;
INSERT INTO `contact_settings` VALUES (1,'hello@cypressiqagency.com','+254 745 763 093','+254 745 763 093','Pinkam House Nakuru, Kenya','','2026-04-10 08:16:40','2026-04-10 08:31:06');
/*!40000 ALTER TABLE `contact_settings` ENABLE KEYS */;
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
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leads`
--

DROP TABLE IF EXISTS `leads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leads` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `project_type` varchar(255) DEFAULT NULL,
  `project_scale` varchar(255) DEFAULT NULL,
  `bottleneck` text DEFAULT NULL,
  `timeline` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `product_interest` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'new',
  `priority` varchar(255) NOT NULL DEFAULT 'medium',
  `notes` text DEFAULT NULL,
  `assigned_to` varchar(255) DEFAULT NULL,
  `last_contacted_at` timestamp NULL DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leads`
--

LOCK TABLES `leads` WRITE;
/*!40000 ALTER TABLE `leads` DISABLE KEYS */;
INSERT INTO `leads` VALUES (1,'amy.fowler@caltech.edu','Dr. Amy Fowler','+254712345678',NULL,NULL,NULL,NULL,NULL,'Multi-warehouse ERP setup for lab inventory & double-entry accounting.','itikia','new','medium',NULL,NULL,NULL,'admin_cockpit_manual',NULL,'2026-09-23 06:46:12','2026-09-23 06:46:12'),(2,'sheldon@caltech.edu','Sheldon Cooper','+254799111222',NULL,'Business Operations (Opero ERP)','Multi-Branch (2-10 Outlets)',NULL,NULL,'[Operational Scale: Multi-Branch (2-10 Outlets)]\r\n\r\nWe need an ITIKIA engagement hub for 50,000+ public campaign volunteers and content dispatching.','opero','new','high',NULL,NULL,NULL,'project_discovery_engine','Business Operations (Opero ERP)','2026-09-23 06:54:56','2026-09-23 06:54:56');
/*!40000 ALTER TABLE `leads` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_03_28_072730_create_posts_table',1),(5,'2026_03_28_072731_create_categories_table',1),(6,'2026_03_28_072731_create_leads_table',1),(7,'2026_03_28_072732_create_tags_table',1),(8,'2026_03_31_000001_add_is_admin_to_users_table',2),(9,'2026_04_01_145754_add_seo_and_relations_to_posts_table',2),(10,'2026_04_10_111023_create_contact_settings_table',3),(11,'2026_04_10_111024_create_bookings_table',3),(12,'2026_04_10_111024_create_contact_messages_table',3),(13,'2026_09_23_130000_add_lead_intelligence_fields_to_leads_table',4),(14,'2026_09_23_150000_add_video_url_to_posts_table',5),(15,'2026_09_24_100000_create_product_videos_table',6),(16,'2026_09_25_080700_create_partnerships_table',7),(17,'2026_09_25_080700_create_testimonials_table',7),(18,'2026_09_25_080701_create_portfolio_projects_table',7),(19,'2026_09_25_195500_add_role_and_security_fields_to_users_table',8),(20,'2026_09_25_195501_create_activity_logs_table',8);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partnerships`
--

DROP TABLE IF EXISTS `partnerships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partnerships` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `partner_name` varchar(255) NOT NULL,
  `partner_logo` varchar(255) DEFAULT NULL,
  `partner_website` varchar(255) DEFAULT NULL,
  `partnership_type` varchar(255) NOT NULL DEFAULT 'technology',
  `description` text DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partnerships`
--

LOCK TABLES `partnerships` WRITE;
/*!40000 ALTER TABLE `partnerships` DISABLE KEYS */;
INSERT INTO `partnerships` VALUES (1,'Amazon Web Services (AWS)',NULL,'https://aws.amazon.com/','technology','Cloud Infrastructure Partner — Utilizing high-availability RDS PostgreSQL clusters, S3 encrypted object storage, and CloudFront edge CDN distribution for CypressIQ deployments.',1,1,1,'2026-09-25 05:24:50','2026-09-25 05:24:50'),(2,'Safaricom Telecommunications & M-Pesa',NULL,'https://www.safaricom.co.ke/','strategic','Certified Daraja Enterprise Integration Partner — Powering real-time mobile money payments, automated C2B/B2C disbursements, and STK-push reconciliation across our platforms.',1,1,2,'2026-09-25 05:24:50','2026-09-25 05:24:50'),(3,'Stripe Global Financial Infrastructure',NULL,'https://stripe.com/','technology','Global Payments Partner — Providing PCI-DSS compliant credit card processing, multi-currency invoicing, and SaaS subscription billing for international clients.',1,1,3,'2026-09-25 05:24:50','2026-09-25 05:24:50'),(4,'Twilio & Africa\'s Talking Communications',NULL,'https://africastalking.com/','technology','Telecom Connectivity Partner — Providing high-throughput SMS gateways, two-way USSD codes, voice IVR, and WhatsApp Business API pipelines for our civic and enterprise software.',1,1,4,'2026-09-25 05:24:50','2026-09-25 05:24:50');
/*!40000 ALTER TABLE `partnerships` ENABLE KEYS */;
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
-- Table structure for table `portfolio_projects`
--

DROP TABLE IF EXISTS `portfolio_projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `portfolio_projects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `industry` varchar(255) DEFAULT NULL,
  `category` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `description` longtext DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `gallery_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery_images`)),
  `technologies` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`technologies`)),
  `outcomes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`outcomes`)),
  `project_url` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `completed_at` date DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `portfolio_projects_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolio_projects`
--

LOCK TABLES `portfolio_projects` WRITE;
/*!40000 ALTER TABLE `portfolio_projects` DISABLE KEYS */;
INSERT INTO `portfolio_projects` VALUES (1,'ITIKIA Campaign — Digital Engagement & Public Mobilization Platform','itikia-campaign','CypressIQ Technologies','Civic Tech & Public Communication','Digital Products','A specialized digital engagement and communication platform engineered for public campaigns, grassroots advocacy, and voter mobilization with integrated SMS, USSD, and turnout analytics.','ITIKIA Campaign is CypressIQ\'s proprietary engagement platform built to replace fragmented outreach with a unified command center. Designed for public-facing campaigns, civic advocacy groups, and member organizations, ITIKIA delivers sub-second message throughput, geo-segmented member polling, automated USSD workflows, and encrypted supporter databases.','/images/mockups/itikia-poster.webp','[\"\\/images\\/mockups\\/itikia-poster.webp\"]','[\"Laravel 12\",\"PostgreSQL\",\"Redis Queues\",\"Twilio \\/ Africa\'s Talking\",\"Alpine.js\",\"WebSockets\"]','[\"250,000+ constituent messages processed\",\"99.98% delivery rate on high-velocity broadcasts\",\"3.4x higher supporter engagement vs manual outreach\"]','/itikia','Flagship Product','2025-11-15',1,1,1,'2026-09-25 05:24:50','2026-09-25 05:24:50'),(2,'OPERO — Enterprise Business Operations & ERP Platform','opero-erp','CypressIQ Technologies','Retail, Wholesale & Multi-Branch Trade','Business Systems','A synchronized operational enterprise platform unifying offline-tolerant POS, multi-location warehouse inventory rebalancing, biometric attendance, double-entry payroll, and real-time telemetry.','Opero is CypressIQ\'s flagship business operating system engineered for growing multi-branch enterprises, wholesalers, and retail chains. It replaces fragmented spreadsheets with a synchronized operational engine covering POS, multi-location stock, biometric HR, payroll, and double-entry accounting ledgers.','/images/mockups/opero-poster.webp','[\"\\/images\\/mockups\\/opero-poster.webp\"]','[\"Laravel Core\",\"PostgreSQL\",\"IndexedDB Offline Sync\",\"Redis Cache\",\"Chart.js Telemetry\",\"ESC\\/POS Thermal Drivers\"]','[\"14+ live enterprise branch deployments\",\"42% reduction in stock reconciliation discrepancies\",\"Zero transactional downtime during ISP connectivity loss\"]','/opero','Continuous Enterprise Release','2026-01-20',1,1,2,'2026-09-25 05:24:50','2026-09-25 05:24:50'),(3,'PCEA Neema Church Nakuru — Digital Ministry & Member Portal','pcea-neema-nakuru','PCEA Neema Church Nakuru','Faith-Based & Community Organizations','Web Development','An enterprise digital ministry portal with live HD sermon streaming, automated M-Pesa tithes & offerings, interactive event calendars, and archival resource library.','Engineered and deployed for PCEA Neema Church in Nakuru to connect their active congregation locally and across the diaspora. Features mobile-first responsive architecture, seamless M-Pesa Daraja API payment reconciliation for contributions, high-definition YouTube/Vimeo sermon broadcasting, department calendars, and community announcements.','/images/projects/pcea-poster.svg','[\"\\/images\\/projects\\/pcea-poster.svg\"]','[\"Modern Web Architecture\",\"Laravel\",\"M-Pesa Daraja API\",\"YouTube Live API\",\"Cloudflare CDN\",\"Tailwind CSS\"]','[\"10,000+ monthly online sermon viewers\",\"Zero payment drop-offs for digital contributions\",\"65% increase in youth & fellowship event registrations\"]','https://pceaneemanakuru.com/','6 Weeks','2025-08-10',1,1,3,'2026-09-25 05:24:50','2026-09-25 05:24:50'),(4,'Amos Karoki — Executive Advisory & Thought Leadership Platform','amos-karoki-consulting','Amos Karoki','Executive Consulting & Professional Services','Web Development','A premier personal brand and executive consulting platform with automated client intake, keynote portfolio showcase, book sales funnel, and international payment gateways.','Designed and engineered for business strategist and executive speaker Amos Karoki. The platform combines high-converting typography and minimal cyber-glass aesthetic with automated calendar bookings, structured thought leadership blog engine, book distribution gateway, and corporate advisory inquiry qualification pipelines.','/images/projects/amos-poster.svg','[\"\\/images\\/projects\\/amos-poster.svg\"]','[\"Custom Frontend Engineering\",\"Laravel API\",\"Cal.com Scheduler\",\"Stripe \\/ International Billing\",\"Technical SEO\"]','[\"300% surge in qualified corporate advisory inquiries\",\"Sub-600ms load time worldwide via edge caching\",\"Top 3 search engine ranking for leadership consulting\"]','https://amoskaroki.com/','4 Weeks','2025-10-05',1,1,4,'2026-09-25 05:24:50','2026-09-25 05:24:50'),(5,'ApexLogix — Cold-Chain IoT Telemetry & Logistics ERP','apexlogix-cold-chain-telemetry','ApexLogix Global Logistics','Supply Chain & Cold Logistics','Automation & Integrations','IoT-enabled pharmaceutical fleet tracking with automated temperature excursion warnings, dynamic route optimization, and digital customs manifests.','An end-to-end telemetry and logistics platform built for cross-border pharmaceutical cold-chain transport. Integrates vehicle OBD-II and temperature sensors with real-time MQTT message queues, sending instant alerts to drivers and dispatchers upon 0.5°C threshold shifts, while calculating optimal transit routes.','/images/projects/apexlogix-poster.svg','[\"\\/images\\/projects\\/apexlogix-poster.svg\"]','[\"IoT MQTT Broker\",\"Laravel Microservices\",\"TimescaleDB\",\"Redis Cluster\",\"Mapbox GL\",\"Africa\'s Talking SMS\"]','[\"Zero cargo spoilage across 1.2M kilometers\",\"28% reduction in fuel consumption via route optimization\",\"100% compliance with international pharmaceutical logistics audits\"]','/automation-integrations','5 Months','2025-12-18',1,1,5,'2026-09-25 05:24:50','2026-09-25 05:24:50'),(6,'MedPulse — Multi-Clinic Health Portal & Teleconsultation Core','medpulse-health-portal','MedPulse Healthcare Network','Healthcare & Life Sciences','Digital Platforms','HIPAA-aligned multi-specialty clinical operations suite featuring encrypted electronic medical records (EMR), WebRTC video teleconsultations, and automated pharmacy orders.','Engineered for a growing network of outpatient clinics. MedPulse centralizes patient appointment booking, doctor schedules, diagnostic lab test results, and video consultations within a fortified, end-to-end encrypted architecture with complete audit logging and mobile patient access.','/images/projects/medpulse-poster.svg','[\"\\/images\\/projects\\/medpulse-poster.svg\"]','[\"Laravel REST API\",\"WebRTC Video Engine\",\"Vue.js\",\"MySQL Encrypted Storage\",\"AWS KMS\",\"Twilio Voice & Video\"]','[\"45,000+ encrypted patient records managed seamlessly\",\"50% reduction in patient clinic waiting times\",\"12,000+ completed virtual doctor consultations with zero data breaches\"]','/digital-platforms','7 Months','2026-02-14',1,1,6,'2026-09-25 05:24:50','2026-09-25 05:24:50');
/*!40000 ALTER TABLE `portfolio_projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `video_url` varchar(500) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(500) DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `author_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `posts_category_id_foreign` (`category_id`),
  KEY `posts_author_id_foreign` (`author_id`),
  CONSTRAINT `posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'The Ultimate Guide to Scaling Your SME with Digital Marketing in 2026','the-ultimate-guide-to-scaling-your-sme-with-digital-marketing-in-2026','Feeling overwhelmed by digital marketing? Learn the proven framework to scale your small-to-medium enterprise predictably in 2026.','# The Ultimate Guide to Scaling Your SME with Digital Marketing in 2026\n\nIf you run a small or medium-sized enterprise (SME), the digital landscape can feel like a labyrinth. Algorithms change, new platforms emerge weekly, and competitors seem to have limitless advertising budgets.\n\nHowever, scaling your business doesn\'t require a Fortune 500 budget. It requires a **calculated digital marketing strategy**.\n\n## Why Your Business Strategy Needs a Digital Foundation\n\nGone are the days when digital marketing was just \"posting on social media.\" Today, it\'s about building a digital ecosystem that captures intent, nurtures trust, and drives conversions on autopilot. Businesses in emerging and global markets must shift from reactive advertising to proactive growth frameworks.\n\n### The Power of Search Engine Optimization (SEO)\nSEO is the cornerstone of sustainable growth. When potential clients search for solutions you provide, you need to be on page one. It\'s the most cost-effective way to generate high-intent leads over the long term.\n\n*   **Focus on Long-Tail Keywords:** Don\'t compete for broad terms. Instead of \"shoes,\" target \"durable work boots for contractors.\"\n*   **Technical Foundations:** Ensure your site loads under three seconds and is fully responsive on mobile devices.\n\n### Content That Converts\nYour content should act as your best salesperson, working 24/7. Create case studies, detailed guides, and video content that address your specific buyer personas\' pain points. Value-driven content shortens the sales cycle.\n\n## Tracking Your Return on Investment (ROI)\n\nThe biggest mistake SMEs make is spending without tracking. If you aren\'t measuring your Cost Per Acquisition (CPA) and Customer Lifetime Value (CLTV), you are flying blind. \n\nSet up proper conversion tracking using Google Analytics 4 (GA4) and track every form submission, phone call, and cart checkout.\n\n> **Ready to stop guessing and start growing?**\n> [**Get a Free Marketing Audit from CypressIq Today!**](/contact)',NULL,NULL,'published','Ultimate Guide to Digital Marketing for SMEs | Scale Your Business','Discover the top digital marketing strategies for SMEs in 2026. Learn how to leverage SEO, content, and ROI tracking to scale your business predictably.',423,'2026-04-01 12:01:23','2026-09-25 14:04:32',1,1),(2,'Why Custom Website Development Outperforms Templates for Lead Generation','why-custom-website-development-outperforms-templates-for-lead-generation','Templates might save you money upfront, but custom website development is the secret weapon for dominating search results and multiplying leads.','# Why Custom Website Development Outperforms Templates for Lead Generation\n\nWhen building a new website, business owners often face a dilemma: use a pre-made $50 template from a marketplace to save costs, or invest in custom website development tailored to their specific brand?\n\nIf your website is merely a digital business card, a template might suffice. But if you rely on your website as a primary engine for **lead generation**, a template is actively costing you revenue.\n\n## The Hidden Cost of \"Cheap\" Templates\n\nPre-built templates are designed to appeal to everyone—which means they are optimized for no one. They come bloated with hundreds of unused scripts, sliders, and CSS files required to support all their varying layout options.\n\n*   **Slow Load Times:** Bloated code drastically slows down page speed, immediately killing your conversion rate.\n*   **Poor User Experience (UX):** You are often forced to fit your unique business proposition into rigid, pre-defined boxes.\n*   **Security Vulnerabilities:** Popular templates are notorious targets for hackers because exploiting one vulnerability grants access to thousands of sites.\n\n## The Unmatched SEO Benefits of Custom Code\n\nCustom website development allows developers to write hyper-optimized, lightweight code. Search engines like Google prioritize fast-loading, accessible, and structured websites. A custom-built site ensures absolute control over your Core Web Vitals, JSON-LD Schema markup, and mobile responsiveness.\n\n## Designed for Conversion Optimization\n\nA custom site isn\'t just about aesthetics; it\'s engineered around your customer\'s journey. By analyzing user behavior, an agency can strategically place calls-to-action (CTAs), optimize checkout flows, and build dynamic forms that naturally guide visitors down your sales funnel.\n\n> **Is your current website turning visitors away?** Let\'s build a digital experience that converts.\n> [**Book a Web Development Consultation with CypressIq**](/contact)',NULL,NULL,'published','Custom Website Development vs Templates: Which Generates More Leads?','Are website templates hurting your conversion rate? Learn why custom website development outperforms templates for SEO, speed, and B2B lead generation.',205,'2026-04-01 12:01:23','2026-09-25 14:04:32',2,1),(3,'Local SEO Best Practices: How to Dominate Search Results in Your Region','local-seo-best-practices-how-to-dominate-search-results-in-your-region','Learn the exact strategies and local SEO best practices needed to put your local business on the digital map and drive foot traffic.','# Local SEO Best Practices: How to Dominate Search Results in Your Region\n\nWhether you run a brick-and-mortar retail store or a localized service agency, dominating your regional search results is non-negotiable. When someone types \"service near me,\" the businesses that appear in that top cluster are the ones winning the market.\n\nLocal SEO requires a distinct strategy from global search engine optimization. Here is how you can command local dominance.\n\n## Claiming Your Google Business Profile\n\nYour Google Business Profile (formerly Google My Business) is arguably more important than your actual website for local search visibility.\n\n1.  **Claim and Verify:** Ensure your profile provides exact matching Name, Address, and Phone number (NAP) data.\n2.  **Optimize the Profile:** Add high-quality photos of your premises and products. Fill out your services, business hours, and operational details completely.\n3.  **Generate Reviews:** Actively solicit 5-star reviews from satisfied customers. Respond to *every* review, positive or negative, to signal to Google that you run an active, customer-centric business.\n\n## The Importance of Local Citations\n\nLocal citations are any online mentions of your business\'s NAP details. Ensuring consistency across directories like Yelp, regional business hubs, and industry-specific registries solidifies your legitimacy in Google\'s algorithm. Inconsistent addresses confuse search engines and drastically harm your rankings.\n\n### On-Page Optimization for Local Intent\n\nYour website itself must signal localization. \n\n*   Embed a Google Map on your contact page.\n*   Mention your city, state, and region naturally within your title tags, H1 headers, and footer text.\n*   Create distinct landing pages for explicitly localized services (e.g., \"Plumber in Accra\" vs \"Plumber in Lagos\").\n\n> **Ready to dominate your local market?** \n> [**Request Our Expert Local SEO Services**](/services)',NULL,NULL,'published','Local SEO Best Practices | Dominate Regional Search Results','Struggling to attract local clients? Discover proven local SEO services and best practices to rank higher on Google Maps and regional search results.',130,'2026-04-01 12:01:23','2026-09-25 14:04:32',3,1),(4,'Introduction to Opero ERP: Automating Your Business for Peak Efficiency','introduction-to-opero-erp-automating-your-business-for-peak-efficiency','Still running your business on spreadsheets? Meet Opero ERP: the all-in-one automation platform streamlining inventory, HR, sales, and accounting.','# Introduction to Opero ERP: Automating Your Business for Peak Efficiency\n\nAre critical details falling through the cracks as your business grows? If your teams are relying on fragmented Excel spreadsheets, emails, and disconnected SaaS apps, you are bleeding efficiency. \n\nEnter the modern **Opero ERP system**.\n\n## Why Spreadsheets are Failing Your Growing Business\n\nSpreadsheets are phenomenal tools for early-stage startups. However, as operations scale, they become massive liabilities. Manual data entry inherently leads to human error. There\'s no real-time synchronization across departments, creating information silos where sales doesn\'t know what inventory has in stock, and accounting is always weeks behind.\n\n## The Core Advantages of Opero ERP\n\nOpero is an Enterprise Resource Planning software designed specifically to unify every aspect of a growing SME into a single, intuitive cloud dashboard.\n\n### 1. Unified Inventory and Point of Sale (POS)\nMonitor your stock in real-time across multiple warehouses and physical storefronts. When a sale occurs on the POS counter, the inventory drops instantly—and accounting records the transaction. \n\n### 2. Comprehensive CRM & Sales\nTrack every lead, schedule automated follow-up emails, and generate professional quotes and invoices with a single click. You maintain complete visibility over your sales reps\' performance metrics.\n\n### 3. Financial Visibility and Automation\nInstantly generate profit and loss statements. Automate payroll calculations, vendor payments, and expense tracking without needing a full-time auditing team.\n\n## A Seamless Implementation Process\n\nMigrating to an ERP doesn\'t have to be a nightmare of downtime. The transition to Opero ERP involves a dedicated onboarding team that ports your existing data safely and trains your staff effectively.\n\n> **Stop letting operational bottlenecks stifle your growth.** \n> [**Schedule an Opero Demo Today and Automate Your Success**](/opero-erp)',NULL,NULL,'published','Introduction to Opero ERP | Business Automation Software','Discover how Opero ERP revolutionizes SME operations. Learn how cloud ERP and business automation software eliminates spreadsheets and scales your business.',495,'2026-04-01 12:01:23','2026-09-25 14:04:32',4,1),(5,'The Hidden Costs of Poor Inventory Management (And How Software Fixes It)','the-hidden-costs-of-poor-inventory-management-and-how-software-fixes-it','Are stockouts or dead inventory eating your profit margins? Find out how switching to an automated inventory management solution secures your cash flow.','# The Hidden Costs of Poor Inventory Management (And How Software Fixes It)\n\nFor any product-based business, inventory is the literal lifeblood of profitability. Yet, an alarming number of businesses rely on periodic manual counts and assumptions. \n\nPoor inventory management is a silent killer of cash flow. Here\'s exactly what it\'s costing you—and how implementing dedicated **inventory management software** solves the crisis.\n\n## The Catastrophic Impact of Stockouts vs. Overstock\n\nWhen you lack visibility into your supply chain, you bounce between two extremes:\n\n1.  **Stockouts (Running Out of Stock):** You run a promotional campaign, demand spikes, and you run out of products. You don\'t just lose immediate revenue; you frustrate customers who immediately purchase from your competitors, permanently burning your brand capital.\n2.  **Overstock (Dead Capital):** Terrified of stockouts, you over-order. Now massive amounts of cash are tied up in unsold boxes sitting in a warehouse, depreciating and accumulating storage fees. \n\n## The Error of Manual Tracking Methods\n\nA human writing down numbers on a clipboard or into an Excel file at 5 PM on a Friday will make mistakes. Transposing a \"100\" as a \"10\" fundamentally skews procurement data, leading to disastrous ordering cycles weeks down the line.\n\n## How ERPs Solve Inventory Chaos\n\nModern inventory management embedded inside an ERP solves these issues through aggressive automation:\n\n*   **Low Stock Alerts:** Automatically triggers purchase orders to suppliers when stock hits predefined minimum thresholds.\n*   **Multi-Location Sync:** Instantly syncs quantities across your online store, physical POS, and backend warehouse.\n*   **Predictive Analytics:** Analyzes past sales trends to intelligently forecast how much stock you\'ll need for upcoming seasonal swings.\n\n> **Take total control of your products and cash flow.**\n> [**See How Opero Handles Inventory Seamlessly**](/opero-erp)',NULL,NULL,'published','The Cost of Poor Inventory Management | Software Solutions','Poor inventory control costs businesses thousands. Discover the hidden costs of stockouts and overstock, and how modern inventory management software fixes it.',461,'2026-04-01 12:01:23','2026-09-25 14:04:32',4,1),(6,'E-Commerce Success 101: 5 Proven Strategies to Skyrocket Online Sales','e-commerce-success-101-5-proven-strategies-to-skyrocket-online-sales','Getting traffic but no sales? Learn the top 5 e-commerce conversion rate optimization strategies to turn casual browsers into loyal, paying customers.','# E-Commerce Success 101: 5 Proven Strategies to Skyrocket Online Sales\n\nLaunching an e-commerce website is easier than ever. Creating a highly profitable e-commerce empire, however, requires precision, data-driven methodology, and relentless optimization.\n\nIf you generate traffic but struggle with high cart abandonment rates, these five **e-commerce success strategies** will reshape your revenue trajectory.\n\n## 1. Frictionless, One-Page Checkout\n\nEvery additional form field you ask a customer to fill out drops your conversion rate. Simplify your checkout process. Allow guest checkouts (don\'t force account creation), clearly display shipping costs upfront, and integrate fast digital wallets like Apple Pay and Google Pay.\n\n## 2. Ultra-Fast Performance\n\nAmazon calculated that a single second of page delay costs them $1.6 billion in sales annually. Shoppers have zero patience. Ensure your product pages—even those loaded with high-resolution imagery—load within 2 seconds through optimized caching and content delivery networks (CDNs).\n\n## 3. Establish Absolute Trust Signals\n\nBefore handing over credit card information, a customer must trust you.\n*   Embed genuine customer photo reviews globally.\n*   Feature trusted payment gateway badges visibly.\n*   Provide a rock-solid, incredibly clear return and refund policy in your footer.\n\n## 4. Aggressive Retargeting Campaigns\n\nNinety percent of visitors will not purchase on their first visit. Implement a multi-channel retargeting strategy. Drop tracking pixels to follow visitors across Facebook and Instagram with dynamic ads displaying the exact products they viewed. \n\n## 5. Automated Abandoned Cart Emails\n\nSet up an automated email sequence that triggers 1 hour, 24 hours, and 48 hours after a user leaves items in their cart. Offer a subtle 10% discount in the second email to push hesitant buyers over the finish line.\n\n> **Ready to upgrade your digital storefront and crush your revenue goals?**\n> [**Partner with CypressIq to Build Your E-Commerce Store**](/services)',NULL,NULL,'published','E-Commerce Success Strategies | Skyrocket Online Sales','Ready to scale your online store? Implement these 5 proven e-commerce success strategies to optimize conversion rates, reduce cart abandonment, and drive sales.',383,'2026-04-01 12:01:23','2026-09-25 14:04:32',5,1),(7,'How Implementing a Cloud POS System Transforms Modern Retail Businesses','how-implementing-a-cloud-pos-system-transforms-modern-retail-businesses','Discover why legacy, hardware-bound cash registers are suffocating retail growth, and how Cloud POS integrations unify your digital and physical storefronts.','# How Implementing a Cloud POS System Transforms Modern Retail Businesses\n\nThe days of the bulky, isolated cash register acting as a glorified calculator are officially over. In the modern retail landscape, consumers demand omnichannel experiences—they want to buy online and return in-store, or browse locally and have items shipped to their homes.\n\nTo survive, retailers must adopt a comprehensive **Cloud POS (Point of Sale) system**. \n\n## What is a Cloud POS?\n\nUnlike legacy, on-premise systems where data is stored on a back-office computer server, a Cloud POS stores all data securely on internet servers. It allows you to run point-of-sale software on sleek iPads and modern lightweight terminals from anywhere in the world.\n\n## The Transformational Benefits\n\n### Real-Time Omnichannel Syncing\nIf you sell the last red sweater in your physical boutique, a cloud POS instantly updates your connected e-commerce store, marking it as \"Sold Out.\" This eliminates the terrifying scenario of selling items online that you cannot manually fulfill, saving the brand reputation.\n\n### Advanced Customer Insights\nA great POS doubles as a CRM. Cashiers can instantly pull up customer profiles, purchase history, and loyalty points. It allows clerks to offer profoundly personalized recommendations, immediately driving up the average order value (AOV).\n\n### Mobility and Line Busting\nDuring busy holiday seasons, clerks can detach a tablet POS and walk the floor to check out customers while they browse, accelerating revenue collection and entirely eliminating the frustration of long queue lines.\n\n### Unparalleled Security\nBecause data isn\'t stored locally on vulnerable hardware, a store flood, fire, or hardware theft doesn\'t mean you lose your financial records.\n\n> **Are you ready to unify your retail experience?**\n> [**Explore Opero POS Integration Today**](/opero-erp)',NULL,NULL,'published','Cloud POS Systems | Transforming Retail Business Operations','Still relying on legacy cash registers? Discover how migrating to a comprehensive Cloud POS system streamlines retail operations and unifies your sales channels.',156,'2026-04-01 12:01:23','2026-09-25 14:04:32',4,1),(8,'B2B Lead Generation Automation: Building Predictable Revenue Pipelines','b2b-lead-generation-automation-building-predictable-revenue-pipelines','Manual prospecting is slow and unpredictable. Learn how to construct an automated B2B lead generation machine that fills your CRM with high-value prospects.','# B2B Lead Generation Automation: Building Predictable Revenue Pipelines\n\nThe biggest cause of stress for B2B executives is the \"feast or famine\" sales cycle. One month is historic; the next month, the sales pipeline resembles a dry desert.\n\nThe solution to ending revenue anxiety is implementing sophisticated **B2B lead generation automation**. This ensures a mathematically predictable flow of qualified prospects booking calendar meetings.\n\n## The Pillars of Lead Generation Automation\n\nAutomation doesn\'t mean blasting 10,000 generic emails to purchased lists. It\'s about delivering personalized value at an incredible scale.\n\n### 1. Robust Lead Magnets & Landing Pages\nYou must offer something inherently valuable—like a deeply researched industry whitepaper, a ROI calculator, or an exclusive webinar. These assets sit on high-converting landing pages that capture verified email addresses and company details.\n\n### 2. CRM Integration\nOnce captured, the prospect\'s data must instantly flow into your CRM. Relying on manual spreadsheet exports guarantees that hot leads will fall through the cracks and go cold.\n\n### 3. Automated Email Drip Campaigns\nThe moment an email enters the CRM, they should enter an automated narrative sequence. Over 14 days, the prospect automatically receives targeted case studies, common pain point solutions, and soft pitches that gently educate them towards booking a sales call.\n\n## The Power of Lead Scoring\n\nAdvanced automation platforms monitor a prospect\'s behavior. Did they open exactly three emails? Did they visit the pricing page twice? The software automatically assigns a \"Lead Score.\" When a prospect crosses a certain point threshold, your sales team gets an automated ping: *Call this prospect immediately, they are red-hot.*\n\nBy automating the tedious nurturing process, your human sales team spends 100% of their time closing, rather than hunting.\n\n> **Need a predictable sales pipeline installed in your business?**\n> [**Contact Our Agency for Custom Lead Gen Automation**](/contact)',NULL,NULL,'published','B2B Lead Generation Automation | Build Predictable Revenue','Tired of inconsistent sales months? Harness B2B lead generation automation to fill your CRM with high-quality prospects and build predictable revenue pipelines.',157,'2026-04-01 12:01:23','2026-09-25 14:04:32',1,1);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_videos`
--

DROP TABLE IF EXISTS `product_videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_videos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_key` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `video_url` text NOT NULL,
  `poster_url` text DEFAULT NULL,
  `autoplay` tinyint(1) NOT NULL DEFAULT 1,
  `loop` tinyint(1) NOT NULL DEFAULT 1,
  `muted` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_videos_product_key_unique` (`product_key`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_videos`
--

LOCK TABLES `product_videos` WRITE;
/*!40000 ALTER TABLE `product_videos` DISABLE KEYS */;
INSERT INTO `product_videos` VALUES (1,'opero','OPERO — Business Operations & Management ERP','Enterprise POS, Multi-Location Inventory, Biometric HR & Real-Time Financials','/videos/opero-loop.mp4','/images/mockups/opero-poster.webp',1,1,1,'2026-09-24 04:38:34','2026-09-24 04:38:34'),(2,'itikia','ITIKIA — Digital Engagement & Public Communication Platform','Civic Campaign Infrastructure, Manifesto Management & Grassroots Mobilization','/videos/itikia-loop.mp4','/images/mockups/itikia-poster.webp',1,1,1,'2026-09-24 04:38:34','2026-09-24 04:38:34'),(3,'solutions','CypressIQ — Bespoke Enterprise Software & Systems Architecture','High-Concurrency APIs, Cloud Native Infrastructure & Distributed System Telemetry','/videos/solutions-loop.mp4','/images/mockups/solutions-poster.webp',1,1,1,'2026-09-24 04:38:34','2026-09-24 04:38:34');
/*!40000 ALTER TABLE `product_videos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
INSERT INTO `sessions` VALUES ('NVMMMRVcaA31KZUnFU2ueeWvzYvs78J4uTWWXhGT',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRHppVXlud2R3NWhad1F1d01yZFdpVmN3Q3FUMklBMVp3RDY0UndEciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9hcGkvcmFkYXIiO3M6NToicm91dGUiO3M6MTU6ImFkbWluLmFwaS5yYWRhciI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1790358583);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testimonials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) NOT NULL,
  `client_role` varchar(255) DEFAULT NULL,
  `client_company` varchar(255) DEFAULT NULL,
  `client_avatar` varchar(255) DEFAULT NULL,
  `quote` text NOT NULL,
  `rating` tinyint(4) NOT NULL DEFAULT 5,
  `product_or_solution` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,'Rev. Dr. Patrick M. Gichuki','Parish Minister & Secretariat Head','PCEA Neema Church Nakuru',NULL,'CypressIQ transformed our church\'s entire digital presence. Our congregation across Nakuru and in the diaspora can now follow live sermons in HD, access ministry resources, and contribute through M-Pesa with absolute ease. The engineering speed, security, and attentiveness to our needs made them an indispensable partner.',5,'Web Development & Digital Ministry Platform',1,1,1,'2026-09-25 05:24:50','2026-09-25 05:24:50'),(2,'Amos Karoki','Founder & Principal Consultant','Amos Karoki Leadership Consulting',NULL,'Partnering with CypressIQ was one of the highest-yield decisions I have made for my advisory firm. They don\'t just build websites; they engineer conversion architecture and brand authority. Inquiries from enterprise executives surged by over 300% within the first ninety days of launching our new platform.',5,'Executive Web Platform & Consulting Architecture',1,1,2,'2026-09-25 05:24:50','2026-09-25 05:24:50'),(3,'David Kipkorir','Head of Fleet Operations & Telemetry','ApexLogix Global Logistics',NULL,'The cold-chain tracking and dispatch system engineered by CypressIQ has completely modernized our transit operations. Instant temperature alerts and automated customs manifests have prevented millions in potential pharmaceutical cargo losses. Their software simply does not fail.',5,'IoT Fleet Telemetry & Custom Logistics ERP',1,1,3,'2026-09-25 05:24:50','2026-09-25 05:24:50'),(4,'Dr. Sharon Mwangi','Chief Medical Director','MedPulse Healthcare Network',NULL,'In healthcare, software failure or data leakage is unacceptable. CypressIQ designed a secure, HIPAA-compliant patient management and telehealth portal that our medical staff and patients genuinely love. Our clinic wait times dropped by 50%, and telehealth adoption exceeded all projections.',5,'MedPulse Health Portal & Clinic EHR Core',1,1,4,'2026-09-25 05:24:50','2026-09-25 05:24:50');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `role` varchar(32) NOT NULL DEFAULT 'super_admin',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(45) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Executive Admin','admin@cypressiq.agency',1,'super_admin',1,'2026-09-25 14:35:27','127.0.0.1',NULL,'$2y$12$4FYBBvRnCfAecnpL2pkQyeAE8KQxy1qE2E4cboX0HpQJ1BfJ1lesq',NULL,'2026-03-28 04:54:00','2026-09-25 14:35:27'),(2,'Growth & Sales Team','growth@cypressiq.agency',1,'growth',1,'2026-09-25 14:11:14','127.0.0.1',NULL,'$2y$12$z15EIA2ZUODl1SZBgv55weuJcB6LmjkzSvFP3MK5t2awSf8Dqo53u',NULL,'2026-09-25 13:54:22','2026-09-25 14:11:14'),(3,'Product & Engineering Lead','engineer@cypressiq.agency',1,'product_engineer',1,'2026-09-25 14:13:35','127.0.0.1',NULL,'$2y$12$AjEIt/gnUMPqJ9UiNXg5MOyVI.c2Stxw040T4VjcgJUXQbmSt.p5K',NULL,'2026-09-25 13:54:23','2026-09-25 14:13:35');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-25 20:49:50
