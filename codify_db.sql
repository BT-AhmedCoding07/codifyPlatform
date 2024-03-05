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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chambres`
--

LOCK TABLES `chambres` WRITE;
/*!40000 ALTER TABLE `chambres` DISABLE KEYS */;
INSERT INTO `chambres` VALUES (1,'A Chambre 1','Partagée',2,'1 ans',4,1,'2024-03-05 00:48:11','2024-03-05 00:48:11'),(2,'A Chambre 2','Partagée',2,'1 ans',4,1,'2024-03-05 00:48:20','2024-03-05 00:48:20'),(3,'A Chambre 3','Partagée',2,'1 ans',4,1,'2024-03-05 00:48:25','2024-03-05 00:48:25'),(4,'A Chambre 4','Partagée',2,'1 ans',4,1,'2024-03-05 00:48:32','2024-03-05 00:48:32'),(5,'A Chambre 5','Partagée',2,'1 ans',4,1,'2024-03-05 00:48:38','2024-03-05 00:48:38'),(6,'A Chambre 6','Individuelle',1,'1 ans',1,1,'2024-03-05 00:49:00','2024-03-05 00:49:00'),(7,'A Chambre 7','Individuelle',1,'1 ans',1,1,'2024-03-05 00:49:07','2024-03-05 00:49:07'),(8,'A Chambre 8','Individuelle',1,'1 ans',1,1,'2024-03-05 00:49:19','2024-03-05 00:49:19'),(9,'A Chambre 9','Individuelle',1,'1 ans',1,1,'2024-03-05 00:49:25','2024-03-05 00:49:25'),(10,'B Chambre 1','Partagée',2,'1 ans',4,2,'2024-03-05 00:49:53','2024-03-05 00:49:53'),(11,'B Chambre 2','Partagée',2,'1 ans',4,2,'2024-03-05 00:50:12','2024-03-05 00:50:12'),(12,'B Chambre 3','Individuelle',1,'1 ans',1,2,'2024-03-05 00:50:41','2024-03-05 00:50:41'),(13,'B Chambre 4','Individuelle',1,'1 ans',1,2,'2024-03-05 00:50:49','2024-03-05 00:50:49'),(14,'B Chambre 5','Partagée',2,'1 ans',4,2,'2024-03-05 00:51:08','2024-03-05 00:51:08'),(15,'C Chambre 1','Individuelle',1,'1 ans',2,3,'2024-03-05 00:51:37','2024-03-05 00:51:37'),(16,'C Chambre 2','Individuelle',2,'1 ans',2,3,'2024-03-05 00:51:53','2024-03-05 00:51:53'),(17,'C Chambre 3','Partagée',1,'1 ans',1,3,'2024-03-05 00:53:25','2024-03-05 00:53:25'),(19,'D Chambre 1','Partagée',2,'1 ans',4,4,'2024-03-05 00:56:22','2024-03-05 00:56:22'),(20,'D Chambre 21','Partagée',2,'1 ans',4,4,'2024-03-05 00:56:57','2024-03-05 00:56:57'),(21,'E Chambre 1','Partagée',6,'1 ans',12,5,'2024-03-05 00:57:41','2024-03-05 00:57:41'),(22,'E Chambre 2','Partagée',6,'1 ans',12,5,'2024-03-05 00:58:09','2024-03-05 00:58:09'),(23,'E Chambre 3','Partagée',5,'1 ans',10,5,'2024-03-05 00:58:29','2024-03-05 00:58:29');
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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etudiants`
--

LOCK TABLES `etudiants` WRITE;
/*!40000 ALTER TABLE `etudiants` DISABLE KEYS */;
INSERT INTO `etudiants` VALUES (1,'N01112024001','Homme','jaune','1999-02-01','Touba','Touba','Licence 3','MPI',NULL,1,15,2,9,'2024-03-04 18:21:16','2024-03-04 18:21:16'),(2,'N01112024002','Homme','gris','1999-02-01','Saint Louis','Saint Lious','Licence 1','MPI',NULL,0,16,2,NULL,'2024-03-04 18:37:28','2024-03-04 18:37:28'),(3,'N01112024003','Homme','jaune','1999-12-31','Mbour','Keur Massar','Licence 2','MPC',NULL,1,17,2,9,'2024-03-04 18:38:58','2024-03-04 18:38:58'),(4,'N01112024004','Femme','gris','2001-09-25','Nguaye','Yeumbeul','Licence 2','MPI',NULL,0,18,2,NULL,'2024-03-04 18:40:33','2024-03-04 18:40:33'),(5,'N01112024008','Femme','gris','2004-02-14','Fatick','Sangalkam','Licence 1','MPI',NULL,0,19,2,NULL,'2024-03-04 18:46:45','2024-03-04 18:46:45'),(6,'N01112024006','Femme','jaune','2005-11-03','Ziguninchor','Grand yoff','Licence 1','PC',NULL,1,20,2,8,'2024-03-04 18:53:17','2024-03-04 18:53:17'),(7,'N01112024007','Femme','gris','2006-07-03','Thies','Mbao','Licence 2','PC',NULL,0,21,2,NULL,'2024-03-04 18:57:36','2024-03-04 18:57:36'),(8,'N01112024009','Femme','gris','2003-05-21','Sédhiou','Sébikotane','Licence 1','Anglais',NULL,0,22,2,NULL,'2024-03-04 22:22:13','2024-03-04 22:22:13'),(9,'N01112024010','Homme','jaune','2002-05-21','Kaolack','Keur Mbaye Fall','Licence 2','Anglais',NULL,1,23,2,7,'2024-03-04 22:23:54','2024-03-04 22:23:54'),(10,'N01112024011','Homme','gris','2004-07-28','Kedougou','Sangalkam','Licence 1','Anglais',NULL,0,24,2,NULL,'2024-03-04 22:25:15','2024-03-04 22:25:15'),(11,'N01112024012','Femme','jaune','2006-07-28','Kaffrine','Keur Massar','Licence 1','Anglais',NULL,1,25,2,NULL,'2024-03-04 22:27:06','2024-03-05 01:26:06'),(12,'N01112024013','Femme','gris','2006-07-28','Kaffrine','Keur Massar','Licence 1','Anglais',NULL,1,26,2,NULL,'2024-03-04 22:27:44','2024-03-04 22:27:44'),(13,'N01112024014','Femme','gris','2006-10-20','Fouta','Tivaoune Peul','Licence 1','Anglais',NULL,1,27,2,NULL,'2024-03-04 22:30:49','2024-03-04 22:30:49'),(14,'N01112024015','Femme','gris','1999-05-01','Diourbel','Sangalkam','Licence 2','Anglais',NULL,0,28,2,NULL,'2024-03-04 22:32:29','2024-03-04 22:32:29'),(15,'N01112024016','Femme','gris','2003-05-01','Ziguinchor','Grand yoff','Licence 2','Anglais',NULL,0,29,2,NULL,'2024-03-04 22:35:22','2024-03-04 22:35:22'),(16,'N01112022017','Homme','gris','2004-11-04','Velingara','Keur Mbaye Fall','Licence 3','Anglais',NULL,0,30,2,NULL,'2024-03-04 22:37:01','2024-03-04 22:37:01'),(17,'N01662024001','Homme','jaune','2006-05-05','Thies','Thies','Licence 1','PHILO',17.80,1,31,1,1,'2024-03-04 22:42:49','2024-03-04 22:42:49'),(18,'N0166202401','Homme','jaune','2006-05-05','Fatick','Fatick','Licence 1','Philo',16.80,1,32,1,1,'2024-03-04 23:02:25','2024-03-04 23:02:25'),(19,'N01662024112','Homme','jaune','2007-05-05','Louga','Louga','Licence 1','Philo',16.80,1,33,1,1,'2024-03-04 23:04:05','2024-03-04 23:04:05'),(20,'N01662024102','Homme','jaune','2005-08-19','Thies','Thies','Licence 1','Philo',16.80,1,34,1,1,'2024-03-04 23:07:05','2024-03-04 23:07:05'),(21,'N01662024103','Homme','gris','2003-10-11','Kaolack','Kaolack','Licence 1','Lettre Moderne',15.80,0,35,1,NULL,'2024-03-04 23:12:24','2024-03-04 23:12:24'),(22,'N01662024104','Femme','gris','2004-10-11','Kaolack','Kaolack','Licence 2','Lettre Moderne',14.80,0,36,1,NULL,'2024-03-04 23:13:22','2024-03-04 23:13:22'),(23,'N01662024105','Homme','gris','2005-10-11','Ndar','Ndar','Licence 3','Lettre Moderne',16.80,1,37,1,NULL,'2024-03-04 23:14:53','2024-03-04 23:14:53'),(24,'N01662024106','Femme','jaune','2005-09-21','Nioro Rip','Kaolack','Licence 2','Lettre Moderne',18.80,1,38,1,2,'2024-03-04 23:16:35','2024-03-04 23:16:35'),(25,'N01662024107','Femme','jaune','2002-10-31','Nioro Rip','Kaolack','Licence 3','Lettre Moderne',14.80,1,39,1,2,'2024-03-04 23:17:41','2024-03-04 23:17:41'),(26,'N01662024109','Homme','jaune','2000-04-28','Bayakh','Bayakh','Licence 2','Lettre Moderne',16.80,1,40,1,2,'2024-03-04 23:23:10','2024-03-04 23:23:10'),(27,'N01662024110','Homme','jaune','2001-05-08','Thies','Thies','Licence 3','Lettre Moderne',16.80,1,41,1,2,'2024-03-04 23:24:18','2024-03-04 23:24:18'),(28,'N01662024111','Femme','jaune','2002-05-08','Louga','Louga','Licence 3','Droit',14.80,1,42,1,10,'2024-03-04 23:25:41','2024-03-04 23:25:41'),(29,'N01662024114','Femme','gris','2003-05-08','Diourbel','Diourbel','Licence 2','Droit',14.80,1,43,1,10,'2024-03-04 23:27:10','2024-03-04 23:27:10'),(30,'N01662022112','Femme','jaune','2002-01-19','Kouguel','Kouguel','Licence 3','Droit',17.00,1,44,1,10,'2024-03-04 23:28:24','2024-03-04 23:28:24'),(31,'N01662022110','Femme','gris','2003-01-19','Podor','Podor','Licence 3','Droit',17.00,1,45,1,NULL,'2024-03-04 23:30:06','2024-03-04 23:30:06'),(32,'N01662020112','Femme','gris','2001-01-19','Kolda','koldaa','Licence 3','Droit',16.00,0,46,1,NULL,'2024-03-04 23:59:56','2024-03-04 23:59:56'),(33,'N01662020114','Femme','jaune','1998-01-19','Tamba','Tamba','Licence 3','Droit',16.00,1,47,1,11,'2024-03-05 00:01:50','2024-03-05 00:01:50'),(34,'N01662020115','Homme','gris','2002-02-28','Saint Louis','Saint Louis','Licence 2','MPI',16.00,0,48,1,NULL,'2024-03-05 00:04:39','2024-03-05 00:04:39'),(35,'N01662020116','Homme','gris','1994-02-28','Mboro','Mboro','Licence 2','MPI',17.00,0,49,1,NULL,'2024-03-05 00:13:12','2024-03-05 00:13:12'),(36,'N01662020118','Femme','jaune','1999-02-28','Kouguel','Kouguel','Licence 1','Biologie',16.00,1,50,1,15,'2024-03-05 00:41:14','2024-03-05 00:41:14');
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
  `expired_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
INSERT INTO `password_reset_tokens` VALUES ('dioufastou702@gmail.com','JVbrOgb77xQbcHDrbw0xoP5pRbFJedv1Gstjf9XSjn4FQZK9G83d5J9HriYAiogW','2024-03-05 03:50:02','2024-03-05 03:45:02'),('gaindedigit@gmail.com','ZRKogXJBOfWDK1Zb59mjqAlBHhJyekaN2bvPn8mR59dFayrTGVyzCImFdNQk01xD','2024-03-05 04:27:09','2024-03-05 04:22:09'),('kheuchy1022@gmail.com','nnXcLIM1fCqDf0uXblUHaW2q2HJ0fOlxNC6SWRZclx1zOxG1BvA6LsYvgRexBfTC','2024-03-05 04:35:02','2024-03-05 04:30:02'),('kheuchy1033@gmail.com','KZG87uCd1rh89UU0w5Eg0ybwl2pPsiLpWronROYz16aXTjbBOxtqZ3pcHNgMNTTl','2024-03-05 04:47:47','2024-03-05 04:42:47'),('kheuchy1123@gmail.com','fRjA2b7OEHvByIGG2HuNzmeMGKDaQ0Gm1n1rFXUqiTjoelyI18FhgX53uesi6iQ0','2024-03-05 04:53:57','2024-03-05 04:48:57'),('kidi1brahima@gmail.com','MHz3OYsEZ1LpKT5SVvfMZChBQaqI3yqsHEHNtSzUkXgLMstKBxu6T0I29CRL8JP3','2024-03-05 04:01:45','2024-03-05 03:56:45'),('kidi2brahima@gmail.com','1QZpaoSYQFcgbgBriZf3hXaYVdoGHA1WBmcDyzwSfjVaaya5iT0GHWOi2I5TGsyK','2024-03-05 04:03:47','2024-03-05 03:58:47'),('kidi3brahima@gmail.com','HOBRMXyKyXUJo2ASYyiwvJDWYTEjpvvxfgLiptNhgOGxubIla51y6vM1CHVNgv5o','2024-03-05 04:23:10','2024-03-05 04:18:10'),('kidibrahima@gmail.com','xQ5UmJHm7vOs478gHt4FShfyfMSvNCKGirv8pGqT3mAVeYI6pHVRKC3aCHhAelND','2024-03-05 04:33:47','2024-03-05 04:28:47'),('tidiane004@gmail.com','axJsy7p0aY8BeM1VoUsff9UpB5MaTUoq8bdYAHA1dPDznyMv7IOkX2niYwjZBjvV','2024-03-05 09:15:03','2024-03-05 09:10:03');
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
INSERT INTO `pavillons` VALUES (1,'Pavillon A','Homme',4,600,'2024-03-05 00:44:20','2024-03-05 00:44:20'),(2,'Pavillon B','Femme',4,400,'2024-03-05 00:44:36','2024-03-05 00:44:36'),(3,'Pavillon C','Homme',4,450,'2024-03-05 00:44:54','2024-03-05 00:44:54'),(4,'Pavillon D','Mixte',4,450,'2024-03-05 00:45:43','2024-03-05 00:45:43'),(5,'Pavillon E','Homme',4,400,'2024-03-05 00:46:20','2024-03-05 00:46:20'),(6,'Pavillon F','Femme',4,400,'2024-03-05 00:46:32','2024-03-05 00:46:32'),(7,'Pavillon G','Femme',4,400,'2024-03-05 00:46:41','2024-03-05 00:46:41'),(8,'Pavillon PM','Mixte',4,400,'2024-03-05 00:47:02','2024-03-05 00:47:02');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reclamations`
--

LOCK TABLES `reclamations` WRITE;
/*!40000 ALTER TABLE `reclamations` DISABLE KEYS */;
INSERT INTO `reclamations` VALUES (1,'Lampe défectueuse','Merci de bien nous aider à réparer la lampe de la chambre 1 A de la chambre , nous notons que la lampe   ne fonctionne pas depuis la nuit d\'hier','Traité',17,'2024-03-05 01:17:32','2024-03-05 01:17:32'),(2,'Robinet coupé','Merci de bien nous aider à réparer le robinet de la chambre  1 A  , nous notons que le robinet ne fonctionne pas depuis la deux jours','Ouvert',17,'2024-03-05 01:19:25','2024-03-05 01:19:25'),(3,'Porte défectueuse','Merci de bien nous aider à réparer la porte de la chambre  1 B , nous notons que les cellures de la porte sont gatés','Ouvert',24,'2024-03-05 01:24:34','2024-03-05 01:24:34');
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
INSERT INTO `roles` VALUES (1,'admin','2024-03-04 16:41:16','2024-03-04 16:41:17'),(2,'chefPavillon','2024-03-04 16:41:32','2024-03-04 16:41:33'),(3,'chefPedagogique','2024-03-04 16:42:17','2024-03-04 16:42:18'),(4,'etudiants','2024-03-04 16:42:28','2024-03-04 16:42:29'),(5,'delegues','2024-03-04 16:42:41','2024-03-04 16:42:43');
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
INSERT INTO `statuts` VALUES (1,'merites','2024-03-04 16:43:00','2024-03-04 16:43:02'),(2,'socials','2024-03-04 16:43:22','2024-03-04 16:43:24');
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
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin','admin@gmail.com',NULL,'$2y$12$oaQL.xhh6a6hLNEJRaAgneKEALBidsAtl1ATBeOCevNOmAKd7Qc/.','770000000','Actif',NULL,1,NULL,'2024-03-04 16:44:22','2024-03-04 16:44:22'),(2,'Chef de pavillon','A','kheuchy1423@gmail.com',NULL,'$2y$12$XUytFGrC94T/BW3myrLejOd2MbfxrcIAaGKj/2zzkQ0dtqiZcNLJK','770000001','Actif',NULL,2,NULL,'2024-03-04 17:47:05','2024-03-04 17:47:05'),(3,'Chef de pavillon','B','kheuchy1123@gmail.com',NULL,'$2y$12$h./wKGFiVYcILktEHBswJun3zy3kBJFqf3Zh9bRnGKt3Va3DQFwee','770000002','Actif',NULL,2,NULL,'2024-03-04 17:47:29','2024-03-04 17:47:29'),(4,'Chef de pavillon','C','kheuchy1033@gmail.com',NULL,'$2y$12$NQqxyFPjNf7.WkP7baMPZ.4TeYuJE3sa5HzzPNtQHUfGGbs12Pa72','770000003','Actif',NULL,2,NULL,'2024-03-04 17:47:44','2024-03-04 17:47:44'),(5,'Chef de pavillon','D','kheuchy1022@gmail.com',NULL,'$2y$12$XUnldqrdqXGJ0sKoeVIqyegKM5568dWW7qjEa0F6Lil7JVcv9mEVW','770000004','Actif',NULL,2,NULL,'2024-03-04 17:48:02','2024-03-04 17:48:02'),(6,'Chef de pavillon','E','kidi0ibrahima@gmail.com',NULL,'$2y$12$1Ee9KjS1Y0Rk99T7PYTlSe8DrBwo3C7uu4FEA8rnvDGMzXBII2NPC','770000005','Actif',NULL,2,NULL,'2024-03-04 17:48:21','2024-03-04 17:48:21'),(7,'Chef de pavillon','G','kheuchy1023@gmail.com',NULL,'$2y$12$mDPi2Q3G/92bnr0EMP/gM.CaV.922FRn6oS9Brb40lbCR7OIcYNGy','770000006','Actif',NULL,2,NULL,'2024-03-04 17:49:20','2024-03-04 17:49:20'),(8,'Chef de Service Pédagogique','MPI UCAD','kidi3brahima@gmail.com',NULL,'$2y$12$cV2Rc68qV67NINxuCghuM.rd4Nd5fPwzqkqUM9vDxdNGOodEygdK.','770000010','Actif',NULL,3,NULL,'2024-03-04 17:50:17','2024-03-04 17:50:17'),(9,'Chef de Service Pédagogique','Philo UCAD','kidibrahima@gmail.com',NULL,'$2y$12$XllGGtbuVmV0.U73sx1ARexEU69pKLE9ZRwkC7fJ6UH7x1s3Oy1wG','770000011','Actif',NULL,3,NULL,'2024-03-04 17:51:38','2024-03-04 17:51:38'),(10,'Chef de Service Pédagogique','Anglais UCAD','kidi2brahima@gmail.com',NULL,'$2y$12$CDGcAn5PcV/gIsxxC310/uWb7mkYHsm/507kgfN8Yvzv.2VbuAGSe','770000012','Actif',NULL,3,NULL,'2024-03-04 17:52:06','2024-03-04 17:52:06'),(11,'Chef de Service Pédagogique','Lettre Moderne UCAD','kidi1brahima@gmail.com',NULL,'$2y$12$U3B3PTdO3/bMXzSVeR22WeTay8k7UC3Vk1FsCkIh4.X3SZ4XBBnrG','770000013','Actif',NULL,3,NULL,'2024-03-04 17:53:14','2024-03-04 17:53:14'),(12,'Delegue','Departement MPI','deleguempi@gmail.com',NULL,'$2y$12$k4LlJWsjbsDKh24bbDFsS.bD.jr1iiYVdarUxgrZehMB54OVyDFOe','770000101','Actif',NULL,5,NULL,'2024-03-04 17:58:20','2024-03-04 17:58:20'),(13,'Delegue','Departement Anglais','delegueanglais@gmail.com',NULL,'$2y$12$yc0r3UTMlLYtFYkrP2e64u2E0lKXWbHRUpx6hfEVL3Z1iIVrKmE7C','770000202','Actif',NULL,5,NULL,'2024-03-04 17:59:01','2024-03-04 17:59:01'),(14,'Delegue','Departement PHILO','deleguephilo@gmail.com',NULL,'$2y$12$vdbftTXLbchLuM9P9JquM.FXKvcskw5bdAudaKCROD7UPv68pzO2y','770000303','Actif',NULL,5,NULL,'2024-03-04 18:01:11','2024-03-04 18:01:11'),(15,'Babacar','Mbaye','mbayebabacar@gmail.com',NULL,'$2y$12$6LNVTlem1Sc/1IN74LbiI.oTUaSvMw3jCKEUlqceUBNEIDgSwGDNG','771234567','Actif',NULL,4,NULL,'2024-03-04 18:21:16','2024-03-04 18:21:16'),(16,'Mohamed','Mar','tidiane004@gmail.com',NULL,'$2y$12$aE.tzSRD9seNwbR9nhBUBOMTBG2FYxOJiLVGjoO5/BCIuE2r.x1i.','771234576','Actif',NULL,4,NULL,'2024-03-04 18:37:28','2024-03-04 18:37:28'),(17,'Babacar','Leye','gaindedigit@gmail.com',NULL,'$2y$12$K21ktxOhmkbQ3lJQ8UKeL.lt5zQObgx.6EUxZUr2ZfGdSUyIFgb4i','771235476','Actif',NULL,4,NULL,'2024-03-04 18:38:58','2024-03-04 18:38:58'),(18,'Fatou','Diagne','diagnefatou@gmail.com',NULL,'$2y$12$HEUKnsgUZCEkfInkyNL2/uj2izM0mFDQNNHR83hU22ZC9/n5EPS9K','771325476','Actif',NULL,4,NULL,'2024-03-04 18:40:33','2024-03-04 18:40:33'),(19,'Astou','Fall','fallastou012@gmail.com',NULL,'$2y$12$bwSJK6JDmPFeYHDuLzvx/OKVYIUKmyqizVq0aJLZ2ab6A30cweT/K','771325478','Actif',NULL,4,NULL,'2024-03-04 18:46:45','2024-03-04 18:46:45'),(20,'Jeanne','Coly','jeannecoly@gmail.com',NULL,'$2y$12$U6yrGKpCwpBW42xFPyk/9uPA2g.wozAF8eTdpr/YH3hZqH7vQk1jq','771325748','Actif',NULL,4,NULL,'2024-03-04 18:53:17','2024-03-04 18:53:17'),(21,'Patrice','Gomis','patrice.gomis@gmail.com',NULL,'$2y$12$loCBDfTypBCS4RP9tVepmu5gLkK4zvuW8IIbTd3zHJ828fzeyeDW6','771325784','Actif',NULL,4,NULL,'2024-03-04 18:57:36','2024-03-04 18:57:36'),(22,'Kiné','Diop','kinediop01@gmail.com',NULL,'$2y$12$qjlIR9z2L.t6mdkJFKv3xevy8.TPG8wcYvBKpEoy/P3DBtt6X5mv6','771325785','Actif',NULL,4,NULL,'2024-03-04 22:22:13','2024-03-04 22:22:13'),(23,'Daouda','Tall','daoudatall@gmail.com',NULL,'$2y$12$RhT27Ln02a8si1ReTuPS2umCUQLyQpc6wM/51IsPUq38CcHev0tem','771325786','Actif',NULL,4,NULL,'2024-03-04 22:23:54','2024-03-04 22:23:54'),(24,'Serigne','Gueye','gueyeserigne@gmail.com',NULL,'$2y$12$jjH/9wKUX1.CyBUTRIP96.yBnkHqb0WQIoj5u3.gRTDJvrahw8SIO','771325787','Actif',NULL,4,NULL,'2024-03-04 22:25:15','2024-03-04 22:25:15'),(25,'Coumba','Faye','fayecoumba@gmail.com',NULL,'$2y$12$fM/95qpObLeSJemfTpANXOQUpapTP7At6lZMl9gX4dASzAl3WtZ7a','771325789','Actif',NULL,4,NULL,'2024-03-04 22:27:06','2024-03-04 22:27:06'),(26,'Coumba','Faye','fayecoumba0728@gmail.com',NULL,'$2y$12$IxUi8Unw2ID68Ai6QnDzweBg.fZNj6NYLda.2ctC6PHclcwXd0kr.','771325789','Actif',NULL,4,NULL,'2024-03-04 22:27:44','2024-03-04 22:27:44'),(27,'Aicha','Ndir','ndiraicha2010@gmail.com',NULL,'$2y$12$BPNkllqzzsh4D/Jf5StbnuAA9z2xRlVwiF2i0/dJr.fJY2/9.Tgb2','771325780','Actif',NULL,4,NULL,'2024-03-04 22:30:49','2024-03-04 22:30:49'),(28,'Bintou','Ngom','ngombintou1999@gmail.com',NULL,'$2y$12$i2cFRP7Qv8oKYgdnmcXpKubyswoidaLLKMqhbLUZQEIvdN9HcuOCG','771325781','Actif',NULL,4,NULL,'2024-03-04 22:32:29','2024-03-04 22:32:29'),(29,'Jean','Gomis','jeangomis@gmail.com',NULL,'$2y$12$NMRrBh5FpkuIRRsRlfWaKORFdfgK40J.qJEIacb7jyVH/Lmb7Gx8O','771325782','Actif',NULL,4,NULL,'2024-03-04 22:35:22','2024-03-04 22:35:22'),(30,'Antoine','Ndecky','ndeckyantoine@gmail.com',NULL,'$2y$12$KeOGWXr3jK3UAXzKYLXKdelj72qgxoCXpeSoWy0an0V6q/g6wyFEe','771325783','Actif',NULL,4,NULL,'2024-03-04 22:37:01','2024-03-04 22:37:01'),(31,'Babacar','Coly','colybabacar@gmail.com',NULL,'$2y$12$o1QOjkEGh6EfXXWUWBH7iu485N1BX6qhws.PU8ExiKbCQTY6EMwLm','705678010','Actif',NULL,4,NULL,'2024-03-04 22:42:49','2024-03-04 22:42:49'),(32,'Fallou','Gueye','gueyefallou@gmail.com',NULL,'$2y$12$0lr35lSaKt1tu/psXGOuV.xTn52i5vOqfRDR6zg8BQo6aLxamZlky','705678021','Actif',NULL,4,NULL,'2024-03-04 23:02:25','2024-03-04 23:02:25'),(33,'Souleymane','Diouf','diouf@gmail.com',NULL,'$2y$12$ogHj/Q9IqiOP92udmH32m.lMq.7hguj/MlUMU4JSOWhWTTRiz.6fm','765678021','Actif',NULL,4,NULL,'2024-03-04 23:04:05','2024-03-04 23:04:05'),(34,'Atoumane','Diagne','diagneatoumane2023@gmail.com',NULL,'$2y$12$4tE78TesgXyX1/UVBSz5P.Q1LaVHaN/q72Q6P0bU/M3JmUK.P209S','755678021','Actif',NULL,4,NULL,'2024-03-04 23:07:05','2024-03-04 23:07:05'),(35,'Aboubacar','Diop','baboudiop1011@gmail.com',NULL,'$2y$12$hSgS7vu3h38aIWT1Qzv9b.yVMsLhc9mvf19rU3BxlgBONM88q1JVu','755678002','Actif',NULL,4,NULL,'2024-03-04 23:12:24','2024-03-04 23:12:24'),(36,'Fanta','Faye','fanta.faye@gmail.com',NULL,'$2y$12$BPRbmTgZSCSQlpponhWsXu7JkV8jeNc8/wrweVGkz/kGNT1aN2.Gi','755678003','Actif',NULL,4,NULL,'2024-03-04 23:13:22','2024-03-04 23:13:22'),(37,'Mohamed Moustapha','Diaw','moustaphadiaw@gmail.com',NULL,'$2y$12$un6LSKB5Ztsb64O9g28IFOG1s4aBStGLQ1BFh0Qaccd8yZWCLn2/m','755678004','Actif',NULL,4,NULL,'2024-03-04 23:14:53','2024-03-04 23:14:53'),(38,'Aida','Mbengue','mbengueaida@gmail.com',NULL,'$2y$12$dfrYMAPb.nNgG/QI10FBc.3gwHDNvMFMIIPQCUJPHhFNHyVkeWYHG','755678005','Actif',NULL,4,NULL,'2024-03-04 23:16:35','2024-03-04 23:16:35'),(39,'Jeannette','Bassène','bassenejeanne@gmail.com',NULL,'$2y$12$3zikigtBUu3G5/y4kWO8temt./a.bUhaEyVHIvDHP0XSBB9PEMUhe','755678006','Actif',NULL,4,NULL,'2024-03-04 23:17:41','2024-03-04 23:17:41'),(40,'Dominique','Koupaky','koupakydo@gmail.com',NULL,'$2y$12$qQPhT65b9Kl06LR.34ml0.i.iS3MB8wWC6XK2xUZuHrdQ5aB9HV2q','765678006','Actif',NULL,4,NULL,'2024-03-04 23:23:10','2024-03-04 23:23:10'),(41,'Khalil','Wone','wonekhaliloulah@gmail.com',NULL,'$2y$12$P6Nr/PqjVBaxprB0CFwZE.SQIBaVVocjhhfy0fhfAck6hITPzw1I.','775678006','Actif',NULL,4,NULL,'2024-03-04 23:24:18','2024-03-04 23:24:18'),(42,'Seynabou','Diagne','seynaboudiagne@gmail.com',NULL,'$2y$12$zTY7cZoMRv.hGP7RHQmGd.mTV5TD7HTyFp2RuLkCA6wUHS5gHlzRa','775678000','Actif',NULL,4,NULL,'2024-03-04 23:25:41','2024-03-04 23:25:41'),(43,'Fatou','Niass','niassfatou01@gmail.com',NULL,'$2y$12$/3Y2dGXrJxc5dAqo/roWFuDk57hoRW30VXy.bQUupnosHooeRpHJ6','775678001','Actif',NULL,4,NULL,'2024-03-04 23:27:10','2024-03-04 23:27:10'),(44,'Mignonne','Mendy','mendymignonne@gmail.com',NULL,'$2y$12$7tPzDLCdFUyjuF1QiYqxBe3S.7nJvVFnBOqg7JFpC9Es5sCLsPOmi','775678002','Actif',NULL,4,NULL,'2024-03-04 23:28:24','2024-03-04 23:28:24'),(45,'Nogaye','Diop','diopnogaye@gmail.com',NULL,'$2y$12$g1HP1TrjNf9BVNqrlt/s9OnxK2vNBXozz4w4A3YH/waSsserEkylG','765678000','Actif',NULL,4,NULL,'2024-03-04 23:30:06','2024-03-04 23:30:06'),(46,'Koura','Ndiaye','koura@gmail.com',NULL,'$2y$12$cwPdUQwDkf.O4TQRPEkOtupD45T1kbyYu14EfqHS5FvKCUZg5CdJC','765678010','Actif',NULL,4,NULL,'2024-03-04 23:59:56','2024-03-04 23:59:56'),(47,'Cedric','DIOUF','diouf.cedric@gmail.com',NULL,'$2y$12$7LxAr9cxzuZI45zkxNuKXuY9zA5WhgToZTcxqlWzUreHcOSnoDnZe','765678011','Actif',NULL,4,NULL,'2024-03-05 00:01:50','2024-03-05 00:01:50'),(48,'Assane','Diop','diopassane@gmail.com',NULL,'$2y$12$Hwy0XI/pOIdzz43uQk8YcO4zefLJmpn9g7TkrVjpMYbLOZLsIw2Zu','755678011','Actif',NULL,4,NULL,'2024-03-05 00:04:39','2024-03-05 00:04:39'),(49,'Ousseynou','Sene','seneousseynou@gmail.com',NULL,'$2y$12$Uf4g12ARHa0fBaNsE6Tn/u8HlckBIf4G1Z4c7ABCtf5aGA6N0v2Ne','705678011','Actif',NULL,4,NULL,'2024-03-05 00:13:12','2024-03-05 00:13:12'),(50,'Astou','Diouf','dioufastou702@gmail.com',NULL,'$2y$12$28Jv2HILVTGfjNEpQk1.beMo4kuX9OAl9zn4SQwIxdClE3PereLnC','765678015','Actif',NULL,4,NULL,'2024-03-05 00:41:14','2024-03-05 00:41:14');
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

-- Dump completed on 2024-03-05  9:11:56
