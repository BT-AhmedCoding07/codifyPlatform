-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: codify_db
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `chambres`
--

DROP TABLE IF EXISTS `chambres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chambres` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_chambre` enum('Individuelle','Partagée') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombres_lits` int NOT NULL,
  `echeances` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1 ans',
  `nombres_limites` int NOT NULL,
  `pavillons_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `chambres_libelle_unique` (`libelle`),
  KEY `chambres_pavillons_id_foreign` (`pavillons_id`),
  CONSTRAINT `chambres_pavillons_id_foreign` FOREIGN KEY (`pavillons_id`) REFERENCES `pavillons` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chambres`
--

LOCK TABLES `chambres` WRITE;
/*!40000 ALTER TABLE `chambres` DISABLE KEYS */;
INSERT INTO `chambres` VALUES (1,'A Chambre 1','Partagée',2,'1 ans',5,1,'2024-02-23 12:42:55','2024-02-23 12:42:55'),(2,'A Chambre 2','Partagée',2,'1 ans',4,1,'2024-02-23 12:43:10','2024-02-23 12:43:10'),(3,'A Chambre 3','Partagée',6,'1 ans',0,1,'2024-02-23 12:57:59','2024-02-23 12:57:59'),(4,'A Chambre 4','Partagée',3,'1 ans',6,1,'2024-02-23 13:04:39','2024-02-23 13:04:39'),(5,'A Chambre 5','Partagée',2,'1 ans',2,1,'2024-02-23 13:05:17','2024-02-23 15:10:32'),(6,'B Chambre 1','Partagée',3,'1 ans',6,2,'2024-02-23 13:05:48','2024-02-23 13:05:48'),(7,'B Chambre 2','Partagée',2,'1 ans',4,2,'2024-02-23 13:06:00','2024-02-23 13:06:00'),(9,'E Chambre 1','Partagée',3,'1 ans',12,5,'2024-02-23 13:10:35','2024-02-23 13:10:35'),(10,'E Chambre 2','Partagée',3,'1 ans',10,5,'2024-02-23 13:12:23','2024-02-23 13:12:23'),(11,'F Chambre 1','Partagée',3,'1 ans',10,6,'2024-02-23 13:13:17','2024-02-23 13:13:17'),(14,'F Chambre 2','Partagée',3,'1 ans',12,6,'2024-02-23 13:22:36','2024-02-23 13:22:36');
/*!40000 ALTER TABLE `chambres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etudiants`
--

DROP TABLE IF EXISTS `etudiants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `etudiants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `INE` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` enum('Homme','Femme') COLLATE utf8mb4_unicode_ci NOT NULL,
  `performances` enum('gris','jaune','vert','orange','rouge') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'gris',
  `date_naissance` date NOT NULL,
  `lieu_naissance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau_etudes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filiere` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `moyennes` double(8,2) DEFAULT NULL,
  `estAttribue` tinyint(1) NOT NULL DEFAULT '0',
  `users_id` bigint unsigned NOT NULL,
  `statuts_id` bigint unsigned NOT NULL,
  `chambres_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `etudiants_ine_unique` (`INE`),
  KEY `etudiants_chambres_id_foreign` (`chambres_id`),
  CONSTRAINT `etudiants_chambres_id_foreign` FOREIGN KEY (`chambres_id`) REFERENCES `chambres` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etudiants`
--

LOCK TABLES `etudiants` WRITE;
/*!40000 ALTER TABLE `etudiants` DISABLE KEYS */;
INSERT INTO `etudiants` VALUES (1,'N01662320221','Homme','gris','1999-01-31','Saint Louis','Mamelles','Licence 1','MPI',NULL,1,11,2,14,'2024-02-23 09:58:13','2024-02-23 15:28:04'),(2,'N01662320222','Homme','gris','1997-04-19','Pikine','Ouakam','Licence 1','MPI',NULL,1,12,2,14,'2024-02-23 10:01:17','2024-02-23 15:28:17'),(3,'N01662320223','Homme','gris','1996-04-19','Yoff','Yoff','Licence 1','MPI',NULL,1,13,2,14,'2024-02-23 10:02:35','2024-02-23 15:28:39'),(4,'N01662320224','Homme','gris','2000-04-19','Guediaway','Guediaway','Licence 1','MPI',NULL,0,14,2,NULL,'2024-02-23 10:03:38','2024-02-23 10:03:38'),(5,'N01662320225','Homme','gris','2001-04-19','Thies','Thies','Licence 1','MPI',NULL,0,15,2,NULL,'2024-02-23 10:04:29','2024-02-23 10:04:29'),(6,'N01662320226','Femme','gris','2000-01-01','Saint Louis','Keur Mbaye Fall','Licence 1','Lettres Modernes',NULL,0,16,2,NULL,'2024-02-23 10:06:09','2024-02-23 10:06:09'),(7,'N01662320227','Femme','gris','2000-02-01','Touba','Touba','Licence 1','Lettres Modernes',NULL,0,17,2,NULL,'2024-02-23 10:07:10','2024-02-23 10:07:10'),(8,'N01662320228','Femme','gris','2000-02-01','Kaolack','Sebikhotane','Licence 2','philosophie',NULL,0,18,2,NULL,'2024-02-23 10:08:19','2024-02-23 10:08:19'),(9,'N01662320229','Femme','gris','2004-02-01','Kaolack','Kaolack','Licence 1','philosophie',16.00,1,19,1,6,'2024-02-23 11:34:34','2024-02-23 15:29:18'),(10,'N01662320210','Femme','gris','2003-12-31','Fatick','Fatick','Licence 1','droit',16.50,1,20,1,6,'2024-02-23 11:36:10','2024-02-23 15:29:28'),(11,'N01662320211','Femme','gris','2002-05-29','Fouta','Fouta','Licence 1','droit',15.50,1,21,1,6,'2024-02-23 11:37:35','2024-02-23 15:29:38'),(12,'N01662320212','Femme','gris','1999-05-29','Saint Louis','Saint Louis','Licence 1','droit',18.50,1,22,1,6,'2024-02-23 11:38:49','2024-02-23 15:29:48'),(13,'N01662320213','Femme','gris','2004-05-29','Bambey','Bambey','Licence 2','droit',17.50,1,23,1,6,'2024-02-23 11:40:11','2024-02-23 15:29:56'),(14,'N01662320214','Femme','gris','2005-05-29','Keur Massar','Keur Massar','Licence 2','droit',13.50,1,24,1,6,'2024-02-23 11:41:37','2024-02-23 15:30:05'),(15,'N016623202021','Femme','gris','2000-01-10','Kedougou','Kedougou','Licence 1','droit',14.20,1,25,1,6,'2024-02-23 11:47:32','2024-02-23 15:30:20'),(16,'N01662321202','Femme','gris','2001-02-15','Thiès','Thiès','Licence 2','droit',13.80,0,26,1,NULL,'2024-02-23 11:49:10','2024-02-23 11:49:10'),(17,'N01662320204','Femme','gris','2000-04-25','Louga','Thiaroye','Licence 1','droit',14.50,0,27,1,NULL,'2024-02-23 11:50:09','2024-02-23 11:50:09'),(18,'N01662320203','Homme','gris','2000-03-20','Ziguinchor','Grand Yoff','Licence 2','droit',13.00,1,28,1,2,'2024-02-23 11:51:09','2024-02-23 15:35:38'),(19,'N01662320205','Homme','gris','2001-05-05','Tambacounda','Thiès','Licence 2','droit',12.80,1,29,1,2,'2024-02-23 11:53:27','2024-02-23 15:35:50'),(20,'N01662320215','Homme','gris','2002-05-05','Tambacounda','Tambacounda','Licence 2','droit',14.80,1,30,1,2,'2024-02-23 11:54:51','2024-02-23 15:36:01'),(21,'N01662320216','Homme','gris','1999-05-05','Thies','Thies','Licence 2','droit',17.80,1,31,1,2,'2024-02-23 11:57:59','2024-02-23 15:36:13');
/*!40000 ALTER TABLE `etudiants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2013_01_20_085031_create_roles_table',1),(2,'2014_10_12_000000_create_users_table',1),(3,'2014_10_12_100000_create_password_reset_tokens_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2022_01_20_085233_create_pavillons_table',1),(7,'2023_01_20_085201_create_chambres_table',1),(8,'2024_01_20_085102_create_etudiants_table',1),(9,'2024_01_20_085309_create_reclamations_table',1),(10,'2024_01_22_174252_create_statuts_table',1),(11,'2024_02_10_212541_create_payments_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `pavillons`
--

DROP TABLE IF EXISTS `pavillons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pavillons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_pavillon` enum('Mixte','Homme','Femme') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombres_etages` int NOT NULL,
  `nombres_chambres` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pavillons_libelle_unique` (`libelle`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pavillons`
--

LOCK TABLES `pavillons` WRITE;
/*!40000 ALTER TABLE `pavillons` DISABLE KEYS */;
INSERT INTO `pavillons` VALUES (1,'Pavillon A','Homme',4,500,'2024-02-23 12:14:00','2024-02-23 12:14:00'),(2,'Pavillon B','Femme',4,400,'2024-02-23 12:24:24','2024-02-23 12:24:24'),(3,'Pavillon C','Femme',4,400,'2024-02-23 12:24:36','2024-02-23 12:24:36'),(4,'Pavillon D','Homme',3,250,'2024-02-23 12:25:13','2024-02-23 12:25:13'),(5,'Pavillon E','Femme',4,350,'2024-02-23 12:25:37','2024-02-23 12:32:35'),(6,'Pavillon F','Homme',4,450,'2024-02-23 12:25:52','2024-02-23 12:25:52'),(7,'Pavillon G','Mixte',4,350,'2024-02-23 12:26:16','2024-02-23 12:26:16');
/*!40000 ALTER TABLE `pavillons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` int NOT NULL,
  `mois` int NOT NULL,
  `etudiants_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payments_token_unique` (`token`),
  KEY `payments_etudiants_id_foreign` (`etudiants_id`),
  CONSTRAINT `payments_etudiants_id_foreign` FOREIGN KEY (`etudiants_id`) REFERENCES `etudiants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
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
-- Table structure for table `reclamations`
--

DROP TABLE IF EXISTS `reclamations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reclamations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `objet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Ouvert','Traité') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Ouvert',
  `etudiants_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reclamations_etudiants_id_foreign` (`etudiants_id`),
  CONSTRAINT `reclamations_etudiants_id_foreign` FOREIGN KEY (`etudiants_id`) REFERENCES `etudiants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reclamations`
--

LOCK TABLES `reclamations` WRITE;
/*!40000 ALTER TABLE `reclamations` DISABLE KEYS */;
INSERT INTO `reclamations` VALUES (1,'Electricité chambre A2','Merci de bien nous aider à réparer la lampe de la chambre A2, nous notons que l\'électricité ne fonctionne pas depuis la nuit d\'hierf','Ouvert',18,'2024-02-23 15:52:00','2024-02-23 15:52:00'),(2,'Robinet chambre B2','Merci de bien nous aider à réparer le robinet de la chambre B2, nous notons que l\'eau  coule  ne fonctionne pas depuis deux jours','Traité',9,'2024-02-23 15:55:14','2024-02-23 20:47:17');
/*!40000 ALTER TABLE `reclamations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nomRole` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','2024-02-22 16:34:40','2024-02-22 16:34:41'),(2,'chefPavillon','2024-02-22 16:35:01','2024-02-22 16:35:02'),(3,'chefPedagogique','2024-02-22 16:35:43','2024-02-22 16:35:46'),(4,'etudiants','2024-02-22 16:36:56','2024-02-22 16:36:58'),(5,'delegue','2024-02-22 16:37:23','2024-02-22 16:37:25'),(6,'Gestionnaire de compte','2024-02-23 16:22:54','2024-02-23 16:22:54');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statuts`
--

DROP TABLE IF EXISTS `statuts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `statuts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statuts`
--

LOCK TABLES `statuts` WRITE;
/*!40000 ALTER TABLE `statuts` DISABLE KEYS */;
INSERT INTO `statuts` VALUES (1,'merites','2024-02-22 16:37:45','2024-02-22 16:37:46'),(2,'sociales','2024-02-22 16:37:58','2024-02-22 16:37:59');
/*!40000 ALTER TABLE `statuts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Inactif','Actif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Actif',
  `photo_profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roles_id` bigint unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_roles_id_foreign` (`roles_id`),
  CONSTRAINT `users_roles_id_foreign` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin','admin@gmail.com',NULL,'$2y$12$naC03v9ioZe4v3h7dKPCRuV6hTPdQtoz.5w20PVBxOKXE.cyHoFcK','770000000','Actif',NULL,1,NULL,'2024-02-22 17:26:55','2024-02-22 17:26:55'),(2,'Chef de pavillon A','UCAD A','chefpavillon@gmil.com',NULL,'$2y$12$dfWDpYyG4xMY.p9DDAUW6uT251NihvAOOdM70ahCgDZuDvNaBdJeq','770000001','Actif',NULL,2,NULL,'2024-02-22 18:27:18','2024-02-22 18:27:18'),(3,'Chef de Service Pédagogique','UCAD','chefpedagogique@gmail.com',NULL,'$2y$12$q5ssj/l9iFKxOa5LVC00Qup4OsIngsZ97YCupsUG4E7BeXLQlMbTG','770000002','Actif',NULL,3,NULL,'2024-02-22 22:54:14','2024-02-22 22:54:14'),(4,'Chef de pavillon B','UCAD B','chefpavillonB@gmil.com',NULL,'$2y$12$NR7K0TjOQMLlmePzGiPrDeqVfOHQt4C0kcd5GLOGR.HJZjvyLL8cC','770000003','Actif',NULL,2,NULL,'2024-02-22 23:05:32','2024-02-22 23:05:32'),(5,'Chef de pavillon C','UCAD C','chefpavillonC@gmil.com',NULL,'$2y$12$CJ/BKF04xJ9iptwt8dE/IeBW0xIocbuQ4DqlUJHFuGVXyCo.ycIG2','770000004','Actif',NULL,2,NULL,'2024-02-22 23:05:54','2024-02-22 23:05:54'),(6,'Chef de pavillon D','UCAD D','chefpavillonD@gmil.com',NULL,'$2y$12$MbyF5xBrIKt3KUmRtoYdJuDL8RtsxBDwKdOz6ZEXQqA5trZTGuPBm','770000005','Actif',NULL,2,NULL,'2024-02-22 23:06:17','2024-02-22 23:06:17'),(7,'Chef de pavillon E','UCAD E','chefpavillonE@gmil.com',NULL,'$2y$12$ZkVbkVrajSd6nmSrVt/hKOt28osam0kkLXwvLXGGhvavQ2zIzNhkW','770000006','Actif',NULL,2,NULL,'2024-02-22 23:06:48','2024-02-22 23:06:48'),(8,'Chef de pavillon F','UCAD F','chefpavillonF@gmail.com',NULL,'$2y$12$yiWDTQUUNwn8N8xdmzZUXOISCIfrXe95nrGhtz2Lv6.QRLeFShmVO','770000007','Actif',NULL,2,NULL,'2024-02-22 23:08:24','2024-02-22 23:08:24'),(9,'Chef de pavillon G','UCAD G','chefpavillonG@gmail.com',NULL,'$2y$12$ibt7REMa/TVy3SBV.b6wJeNccM4GCouTzD0US9cO1S0OojqYWMxrq','770000007','Inactif',NULL,2,NULL,'2024-02-22 23:08:39','2024-02-23 16:29:21'),(10,'Delegue','Departement MPI','delegue@gmail.com',NULL,'$2y$12$8SEAuJpUEebc3m/tsqEPjexusfGPN3Gqr3vuK4uTRO36BZi95a7LG','770000008','Actif',NULL,5,NULL,'2024-02-22 23:37:15','2024-02-22 23:37:15'),(11,'Assane','Diop','diopassane@gmail.com',NULL,'$2y$12$Ib38rz3eiKKNpB3H8S0sKeOK7iAg9IU2BQ.uR5gOCndHwBRG9eK0q','771234567','Actif',NULL,4,NULL,'2024-02-23 09:58:13','2024-02-23 09:58:13'),(12,'Makhou','Ndong','makhoundon@gmail.com',NULL,'$2y$12$9ZAEliFfQk/6rWSh568K2.SeydQDFoPKtOj/1Yd2CB3hq8wSqr99.','771234500','Actif',NULL,4,NULL,'2024-02-23 10:01:17','2024-02-23 10:01:17'),(13,'Moustapha','Sarr','sarrmoustapha@gmail.com',NULL,'$2y$12$deyhlS8DyO1Yp.IC4HGaSOw0305QFpPdrY8r0T2LxLWtuH.rl.Rwu','771234501','Actif',NULL,4,NULL,'2024-02-23 10:02:35','2024-02-23 10:02:35'),(14,'Moussa','Basse','bassemoussa221@gmail.com',NULL,'$2y$12$Xk.oEBsEmqLayuh4kFBoi.MXff3V5C77rUfHe/T7Z9v0SpLviQWJK','771234502','Actif',NULL,4,NULL,'2024-02-23 10:03:38','2024-02-23 10:03:38'),(15,'Mountaga','Ba','bamountaga@gmail.com',NULL,'$2y$12$pxrpswuWI2MVLi9/cP/hO.qbk4OqnDRQzY2bZGIRHjA6uUyqayAf.','771234503','Actif',NULL,4,NULL,'2024-02-23 10:04:29','2024-02-23 10:04:29'),(16,'Rokhaya','Toure','rokhaya2000@gmail.com',NULL,'$2y$12$ZMunej/fItf3binbVCfcNOFGOHcRmDGBctvwsUeuIX2ncMHYKtHby','771234504','Actif',NULL,4,NULL,'2024-02-23 10:06:09','2024-02-23 10:06:09'),(17,'Adama','Gueye','adamagueye@gmail.com',NULL,'$2y$12$sEa.cprb6mb/7YjH4i/BquZKSlhsLYsgz4skH1I.NGToVzNs2z2am','771234505','Actif',NULL,4,NULL,'2024-02-23 10:07:10','2024-02-23 10:07:10'),(18,'Fatou','Diop','fatoudiop@gmail.com',NULL,'$2y$12$2oYkskeEvm.v/IsAFn0Wb.hojsAcsp6uC6ChHN/bbPOaxIlAeY7Le','771234506','Actif',NULL,4,NULL,'2024-02-23 10:08:19','2024-02-23 10:08:19'),(19,'Astou','Ndiaye','astoundiaye@gmail.com',NULL,'$2y$12$74o.k3vPGSGt.TWOV2IOTOX8.lpG.lc0IetkpbrOMZtjqDJMldSIC','771234507','Actif',NULL,4,NULL,'2024-02-23 11:34:34','2024-02-23 11:34:34'),(20,'Jeanne','Mendy','jeannemendy@gmail.com',NULL,'$2y$12$YBO6YqBdXfAY8Av6WGJlNO9sSCyRc/pBgHt2JED.FzgpP1OzLRe9.','771234508','Actif',NULL,4,NULL,'2024-02-23 11:36:10','2024-02-23 11:36:10'),(21,'Marieme','Diallo','diallomarieme@gmail.com',NULL,'$2y$12$3w.TYD7AqcxupbXUqvVkQ.D3qT/t4s0uFBjS53hXcB5S.YInfbPe.','771234509','Actif',NULL,4,NULL,'2024-02-23 11:37:35','2024-02-23 11:37:35'),(22,'Aicha','Ndiaye','ndiayeaicha@gmail.com',NULL,'$2y$12$6EE6f3w9tFfareX0oAXHu.bm7iPrWLFowin3LhW1aHP9tyWUS7e3q','771234510','Actif',NULL,4,NULL,'2024-02-23 11:38:49','2024-02-23 11:38:49'),(23,'Doreh','THIOUB','doreh@gmail.com',NULL,'$2y$12$Ik0tJnMSkgFEOpC1Y25i5.baHN/qflC2rqBk71wiY7NxAiE8.cxgW','771234511','Actif',NULL,4,NULL,'2024-02-23 11:40:11','2024-02-23 11:40:11'),(24,'Mariama','Sambou','samboumariama@gmail.com',NULL,'$2y$12$WABxnXlGmnlyOuCf4ieW4uI9UuxI4Jovk4JWvRRBRD6SuZX.Ey41e','771234512','Actif',NULL,4,NULL,'2024-02-23 11:41:37','2024-02-23 11:41:37'),(25,'Aminata','Diop','diopaminata@gmail.com',NULL,'$2y$12$8dhO89yecv2/MyNty4Ttq.9PZzPZoe2rCtijViA.K5a4NvHMQnTzK','771234569','Actif',NULL,4,NULL,'2024-02-23 11:47:32','2024-02-23 11:47:32'),(26,'Fatou','Sow','fatousow@gmail.com',NULL,'$2y$12$YdVXXEX5MaGXbJQtK8jJluOTpVTiOh/KWsaFKYBoLNQk3Ms0T18lm','772345678','Actif',NULL,4,NULL,'2024-02-23 11:49:10','2024-02-23 11:49:10'),(27,'Khadidiatou','Diagne','khadidiatoudiagne@gmail.com',NULL,'$2y$12$Bx1bM18i/PxtZ9xEvKU4yOJe9ag5l1FZ6rbaN2UfQHOdrcQvJ30ja','774567890','Actif',NULL,4,NULL,'2024-02-23 11:50:09','2024-02-23 11:50:09'),(28,'Mamadou','Sylla','mamadousylla@gmail.com',NULL,'$2y$12$pWkcgT8xmDBnedR.VsCf.u448ks0YYJ3AOegEGtWKPVagsw8gl69G','773456789','Actif',NULL,4,NULL,'2024-02-23 11:51:09','2024-02-23 11:51:09'),(29,'Papa','Diouf','papadiouf@gmail.com',NULL,'$2y$12$DP2Eq/4RsEbxKEFlHYkWWuEAurYH3FCIIMaGPzp9d0ymsTT9fh0q.','775678901','Actif',NULL,4,NULL,'2024-02-23 11:53:27','2024-02-23 11:53:27'),(30,'Mbaye','Sarr','mbayesarr@gmail.com',NULL,'$2y$12$znWLbu24TO.Z9Pz1x3/GhOe4wq.9mw6nlLdc2ADebjQVPpCJ4aHOq','775678912','Actif',NULL,4,NULL,'2024-02-23 11:54:51','2024-02-23 11:54:51'),(31,'Babacar','Coly','colybabacar@gmail.com',NULL,'$2y$12$38ZzyYogxKtFv0gganNlnOtSL8zQQauyqxm7SXfteW5daCJRrWLnm','775678913','Actif',NULL,4,NULL,'2024-02-23 11:57:59','2024-02-23 11:57:59');
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

-- Dump completed on 2024-02-24 19:19:06
