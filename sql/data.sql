DELETE FROM `config`;
INSERT INTO `config` (`key`, `value`, `activity`, `created`, `modified`) VALUES 
("system_email", "pedrokoblitz@gmail.com", 2, NOW(), NOW()),
("per_page", "12", 2, NOW(), NOW()),
("upload_dir", "/public/media", 2, NOW(), NOW()),
("app_web_root", "/", 2, NOW(), NOW()),
("app_abs_path", "/var/www/html/", 2, NOW(), NOW()),
("panel_log_quantity", "15", 2, NOW(), NOW()),
("panel_content_quantity", "10", 2, NOW(), NOW()),
("panel_collection_quantity", "5", 2, NOW(), NOW()),
("panel_resource_quantity", "5", 2, NOW(), NOW()),
("panel_term_quantity", "5", 2, NOW(), NOW()),
("facebook_app_id", "", 2, NOW(), NOW()),
("facebook_auth_key", "", 2, NOW(), NOW()),
("facebook_auth_secret", "", 2, NOW(), NOW()),
("twitter_app_id", "", 2, NOW(), NOW()),
("twitter_app_key", "", 2, NOW(), NOW()),
("twitter_app_secret", "", 2, NOW(), NOW()),
("flickr_profile_url", "http://flickr.com.br/photos/pedrokoblitz", 2, NOW(), NOW()),
("tumblr_profile_url", "http://pedrokoblitz.tumblr.com", 2, NOW(), NOW()),
("facebook_profile_url", "https://facebook.com/pedrokoblitz", 2, NOW(), NOW()),
("twitter_profile_url", "http://twitter.com/pedrokoblitz", 2, NOW(), NOW()),
("linkedin_profile_url", "http://br.linkedin.com/pedrokoblitz", 2, NOW(), NOW()),
("pinterest_profile_url", "http://pinterest.com/pedrokoblitz", 2, NOW(), NOW());

-- MySQL dump 10.13  Distrib 5.5.43, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: maltz-novo
-- ------------------------------------------------------
-- Server version	5.5.43-0ubuntu0.14.10.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `blocks`
--

LOCK TABLES `blocks` WRITE;
/*!40000 ALTER TABLE `blocks` DISABLE KEYS */;
/*!40000 ALTER TABLE `blocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `collections`
--

LOCK TABLES `collections` WRITE;
/*!40000 ALTER TABLE `collections` DISABLE KEYS */;
INSERT INTO `collections` VALUES (1,NULL,0,5,1,'2015-07-13 23:43:29','2015-07-13 23:43:29'),(2,NULL,0,5,1,'2015-07-13 23:43:38','2015-07-13 23:43:38');
/*!40000 ALTER TABLE `collections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `contents`
--

LOCK TABLES `contents` WRITE;
/*!40000 ALTER TABLE `contents` DISABLE KEYS */;
INSERT INTO `contents` VALUES (1,0,1,1,'2015-07-13 23:27:04','2015-07-13 23:27:04','2015-07-13 23:27:04'),(2,0,1,1,'2015-07-13 23:27:50','2015-07-13 23:27:50','2015-07-13 23:27:50'),(3,0,1,1,'2015-07-13 23:28:10','2015-07-13 23:28:10','2015-07-13 23:28:10'),(4,0,4,1,'2015-07-13 23:29:14','2015-07-13 23:29:14','2015-07-13 23:29:14'),(5,0,4,1,'2015-07-13 23:29:30','2015-07-13 23:29:30','2015-07-13 23:29:30'),(6,0,2,1,'2015-07-13 23:29:55','2015-07-13 23:29:55','2015-07-13 23:29:55'),(7,0,2,1,'2015-07-13 23:30:04','2015-07-13 23:30:04','2015-07-13 23:30:04'),(8,0,3,1,'2015-07-13 23:30:20','2015-07-13 23:30:20','2015-07-13 23:30:20');
/*!40000 ALTER TABLE `contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `folksonomy`
--

LOCK TABLES `folksonomy` WRITE;
/*!40000 ALTER TABLE `folksonomy` DISABLE KEYS */;
/*!40000 ALTER TABLE `folksonomy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `items_groups_relationships`
--

LOCK TABLES `items_groups_relationships` WRITE;
/*!40000 ALTER TABLE `items_groups_relationships` DISABLE KEYS */;
/*!40000 ALTER TABLE `items_groups_relationships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `metadata`
--

LOCK TABLES `metadata` WRITE;
/*!40000 ALTER TABLE `metadata` DISABLE KEYS */;
/*!40000 ALTER TABLE `metadata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `resources`
--

LOCK TABLES `resources` WRITE;
/*!40000 ALTER TABLE `resources` DISABLE KEYS */;
/*!40000 ALTER TABLE `resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `terms`
--

LOCK TABLES `terms` WRITE;
/*!40000 ALTER TABLE `terms` DISABLE KEYS */;
/*!40000 ALTER TABLE `terms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `tokens`
--

LOCK TABLES `tokens` WRITE;
/*!40000 ALTER TABLE `tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `translations`
--

LOCK TABLES `translations` WRITE;
/*!40000 ALTER TABLE `translations` DISABLE KEYS */;
INSERT INTO `translations` VALUES (1,1,'pt-br','content',1,'teste','teste','testando','testando 123 ','testando 123 ','testando 123 '),(2,1,'pt-br','content',2,'teste-2','teste','testando','testando 123 ','testando 123 ','testando 123 '),(3,1,'pt-br','content',3,'teste-3','teste','testando','testando 123 ','testando 123 ','testando 123 '),(4,1,'pt-br','content',4,'teste-4','teste','testando','testando 123 ','testando 123 ','testando 123 '),(5,1,'pt-br','content',5,'teste-5','teste','testando','testando 123 ','testando 123 ','testando 123 '),(6,1,'pt-br','content',6,'teste-6','teste','testando','testando 123 ','testando 123 ','testando 123 '),(7,1,'pt-br','content',7,'teste-7','teste','testando','testando 123 ','testando 123 ','testando 123 '),(8,1,'pt-br','content',8,'teste-8','teste','testando','testando 123 ','testando 123 ','testando 123 '),(9,1,'pt-br','content',9,'teste-9','teste','testando','testando 123 ','testando 123 ','testando 123 '),(10,1,'pt-br','content',10,'teste-10','teste','testando','testando 123 ','testando 123 ','testando 123 '),(11,1,'pt-br','collection',1,'teste-9-1','teste','testando','testando 123 ','testando 123 ','testando 123 '),(12,1,'pt-br','collection',2,'teste-10-1','teste','testando','testando 123 ','testando 123 ','testando 123 ');
/*!40000 ALTER TABLE `translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `types`
--

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` VALUES (1,'content','page'),(2,'content','book'),(3,'content','post'),(4,'content','project'),(5,'collection','album'),(6,'collection','folder'),(7,'resource','embed'),(8,'resource','link'),(9,'resource','file'),(10,'term','section'),(11,'term','tag');
/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users_roles`
--

LOCK TABLES `users_roles` WRITE;
/*!40000 ALTER TABLE `users_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_roles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-07-14  0:57:55
