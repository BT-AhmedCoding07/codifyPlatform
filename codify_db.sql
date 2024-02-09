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
  UNIQUE KEY `chambres_libelle_unique` (`libelle`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chambres`
--

LOCK TABLES `chambres` WRITE;
/*!40000 ALTER TABLE `chambres` DISABLE KEYS */;
INSERT INTO `chambres` VALUES (1,'Chambre A1','Partagée',2,'1 ans',4,1,'2024-02-08 18:45:39','2024-02-08 18:45:39'),(2,'Chambre A2','Partagée',2,'1 ans',4,1,'2024-02-08 18:47:02','2024-02-08 18:47:02'),(3,'Chambre A3','Partagée',2,'1 ans',4,1,'2024-02-08 18:47:09','2024-02-08 18:47:09'),(4,'Chambre A4','Partagée',2,'1 ans',4,1,'2024-02-08 18:47:16','2024-02-08 18:47:16'),(5,'Chambre A5','Partagée',2,'1 ans',4,1,'2024-02-08 18:47:22','2024-02-08 18:47:22'),(6,'Chambre A6','Partagée',2,'1 ans',4,1,'2024-02-08 18:47:30','2024-02-08 18:47:30'),(7,'Chambre A7','Partagée',2,'1 ans',4,1,'2024-02-08 18:47:37','2024-02-08 18:47:37'),(8,'Chambre A8','Partagée',2,'1 ans',4,1,'2024-02-08 18:47:43','2024-02-08 18:47:43'),(9,'Chambre A9','Partagée',2,'1 ans',4,1,'2024-02-08 18:47:50','2024-02-08 18:47:50'),(10,'Chambre A10','Partagée',2,'1 ans',4,1,'2024-02-08 18:47:57','2024-02-08 18:47:57'),(11,'Chambre A11','Partagée',2,'1 ans',4,1,'2024-02-08 18:48:11','2024-02-08 18:48:11'),(12,'Chambre B1','Partagée',2,'1 ans',4,1,'2024-02-08 18:48:46','2024-02-08 18:48:46'),(13,'Chambre B2','Partagée',2,'1 ans',4,1,'2024-02-08 18:48:52','2024-02-08 18:48:52'),(14,'Chambre B3','Partagée',2,'1 ans',4,1,'2024-02-08 18:49:02','2024-02-08 18:49:02'),(15,'Chambre B4','Partagée',2,'1 ans',4,1,'2024-02-08 18:49:12','2024-02-08 18:49:12'),(16,'Chambre B5','Partagée',2,'1 ans',4,1,'2024-02-08 18:49:19','2024-02-08 18:49:19'),(17,'Chambre PM1','Individuelle',1,'1 ans',2,2,'2024-02-08 18:50:04','2024-02-08 18:50:04');
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
  `date_naissance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lieu_naissance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau_etudes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filiere` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `moyennes` double(8,2) DEFAULT NULL,
  `estAttribue` tinyint(1) NOT NULL DEFAULT '0',
  `users_id` bigint unsigned NOT NULL,
  `statuts_id` bigint unsigned NOT NULL,
  `chambres_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `etudiants_ine_unique` (`INE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etudiants`
--

LOCK TABLES `etudiants` WRITE;
/*!40000 ALTER TABLE `etudiants` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2013_01_20_085031_create_roles_table',1),(2,'2014_10_12_000000_create_users_table',1),(3,'2014_10_12_100000_create_password_reset_tokens_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2024_01_20_085102_create_etudiants_table',1),(7,'2024_01_20_085201_create_chambres_table',1),(8,'2024_01_20_085233_create_pavillons_table',1),(9,'2024_01_20_085309_create_reclamations_table',1),(10,'2024_01_22_174252_create_statuts_table',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pavillons`
--

LOCK TABLES `pavillons` WRITE;
/*!40000 ALTER TABLE `pavillons` DISABLE KEYS */;
INSERT INTO `pavillons` VALUES (1,'Pavillon A','Homme',4,600,'2024-02-08 18:40:18','2024-02-08 18:40:18'),(2,'Pavillon B','Femme',4,500,'2024-02-08 18:40:45','2024-02-08 18:40:45'),(3,'Pavillon C','Homme',4,400,'2024-02-08 18:41:01','2024-02-08 18:41:01'),(4,'Pavillon D','Femme',4,400,'2024-02-08 18:41:17','2024-02-08 18:41:17'),(5,'Pavillon PM','Mixte',4,250,'2024-02-08 18:41:35','2024-02-08 18:41:35');
/*!40000 ALTER TABLE `pavillons` ENABLE KEYS */;
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
  `status` enum('En cours','Traité') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'En cours',
  `chambres_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reclamations`
--

LOCK TABLES `reclamations` WRITE;
/*!40000 ALTER TABLE `reclamations` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','2024-02-08 18:33:47','2024-02-08 18:33:48'),(2,'ChefPavillon','2024-02-08 18:35:07','2024-02-08 18:35:08'),(3,'ChefServicePedagogique','2024-02-08 18:35:24','2024-02-08 18:35:26'),(4,'Etudiant','2024-02-08 18:35:47','2024-02-08 18:35:48'),(5,'Gestionnaire de compte','2024-02-08 18:55:42','2024-02-08 18:55:42');
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
INSERT INTO `statuts` VALUES (1,'Merite','2024-02-08 18:36:09','2024-02-08 18:36:11'),(2,'Social','2024-02-08 18:36:21','2024-02-08 18:36:23');
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
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin','admin@gmail.com',NULL,'$2y$12$AN6CiYyezxbjMgXlLh/OluYtZ/QR6FOtoSucWDTinY68kaG94iDXm','770000000','Actif',NULL,1,NULL,'2024-02-08 18:33:20','2024-02-08 18:33:20'),(2,'ChefPedaogique 1','UCAD','ChefPedaogique1@gmail.com',NULL,'$2y$12$3KspNDdxvhHzl.1C7OSAAuxp2ZWiDr8GXD7Dk71z/5ekewvIiQoFu','770000000','Actif',NULL,3,NULL,'2024-02-08 18:58:09','2024-02-08 18:58:09'),(3,'chef de Pavillon A','UCAD','chefPavillonA@gmail.com',NULL,'$2y$12$c9UnJP0khDVRM6nTfnFltOrbVs311C9uzY8mnYB282NVS8o4xUfsK','770000001','Actif',NULL,2,NULL,'2024-02-08 19:00:35','2024-02-08 19:00:35');
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

-- Dump completed on 2024-02-08 20:20:22
