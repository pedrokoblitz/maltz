-- MySQL dump 10.13  Distrib 5.1.63, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: maltz
-- ------------------------------------------------------
-- Server version	5.1.63-0ubuntu0.11.04.1

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
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config` (
  `configId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `chave` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ativo` tinyint(1) unsigned DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`configId`),
  UNIQUE KEY `chave` (`chave`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` VALUES (1,'por_pagina','12',1,'2012-01-18 15:50:19'),(3,'midia_dir','/var/www/maltz/public/media/',1,'2012-01-18 15:50:19'),(9,'capa_blog_quant','3',1,'2012-12-24 16:41:47'),(10,'capa_projetos_quant','9',1,'2012-12-24 16:42:15'),(11,'painel_log_quant','15',1,'2012-12-24 18:02:05'),(12,'painel_lista_quant','5',1,'2012-12-24 18:02:56'),(13,'tumblr_rss_url','http://ronymaltz.tumblr.com/rss',1,'2013-05-09 15:29:54'),(14,'email_contato','r_maltz@yahoo.com',1,'2013-05-20 15:52:46');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fotos`
--

DROP TABLE IF EXISTS `fotos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fotos` (
  `fotoId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulo_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extensao` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ativo` tinyint(1) unsigned DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fotoId`)
) ENGINE=InnoDB AUTO_INCREMENT=227 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fotos`
--

LOCK TABLES `fotos` WRITE;
/*!40000 ALTER TABLE `fotos` DISABLE KEYS */;
INSERT INTO `fotos` VALUES (7,'p17pdrtv9udssp2gsoh17d7tuk4',NULL,NULL,'p17pdrtv9udssp2gsoh17d7tuk4',NULL,NULL,'jpg',NULL,'2013-04-30 16:20:55'),(8,'p17pdrtva01d1paq17vn15ue7h25',NULL,NULL,'p17pdrtva01d1paq17vn15ue7h25',NULL,NULL,'jpg',NULL,'2013-04-30 16:20:56'),(9,'p17pdrtva26pq109r5t9v971sc96',NULL,NULL,'p17pdrtva26pq109r5t9v971sc96',NULL,NULL,'jpg',NULL,'2013-04-30 16:20:58'),(10,'p17pdrtva3hhl1gdd447mr5loa7',NULL,NULL,'p17pdrtva3hhl1gdd447mr5loa7',NULL,NULL,'jpg',NULL,'2013-04-30 16:21:00'),(11,'p17pdrtva41udcnog1ve515j5i8s8',NULL,NULL,'p17pdrtva41udcnog1ve515j5i8s8',NULL,NULL,'jpg',NULL,'2013-04-30 16:21:03'),(12,'p17pdrtva5ocbcquikn1skbedl9',NULL,NULL,'p17pdrtva5ocbcquikn1skbedl9',NULL,NULL,'jpg',NULL,'2013-04-30 16:21:04'),(13,'p17pdrtva57leoq31ufg17sv15d6a',NULL,NULL,'p17pdrtva57leoq31ufg17sv15d6a',NULL,NULL,'jpg',NULL,'2013-04-30 16:21:06'),(14,'p17pdrtva61mt6gkfjtcnc12oob',NULL,NULL,'p17pdrtva61mt6gkfjtcnc12oob',NULL,NULL,'jpg',NULL,'2013-04-30 16:21:08'),(15,'p17pdrtva71g542m91pph1bq71r9lc',NULL,NULL,'p17pdrtva71g542m91pph1bq71r9lc',NULL,NULL,'jpg',NULL,'2013-04-30 16:21:10'),(16,'p17pdrtva81fcle171jtpgfae7qd',NULL,NULL,'p17pdrtva81fcle171jtpgfae7qd',NULL,NULL,'jpg',NULL,'2013-04-30 16:21:12'),(17,'p17pdrtva98mdufna0k1tcp449e',NULL,NULL,'p17pdrtva98mdufna0k1tcp449e',NULL,NULL,'jpg',NULL,'2013-04-30 16:21:14'),(18,'p17pdrtvaaqf01s531bjh191718kif',NULL,NULL,'p17pdrtvaaqf01s531bjh191718kif',NULL,NULL,'jpg',NULL,'2013-04-30 16:21:16'),(19,'p17pdrtvab13sgoi9tkaqoq1le5g',NULL,NULL,'p17pdrtvab13sgoi9tkaqoq1le5g',NULL,NULL,'jpg',NULL,'2013-04-30 16:21:18'),(20,'p17pdrtvac10sql915t91mvflj7h',NULL,NULL,'p17pdrtvac10sql915t91mvflj7h',NULL,NULL,'jpg',NULL,'2013-04-30 16:21:20'),(21,'p17pdrtvad1f4o1n3lrva9riueti',NULL,NULL,'p17pdrtvad1f4o1n3lrva9riueti',NULL,NULL,'jpg',NULL,'2013-04-30 16:21:22'),(22,'p17pdrtvaepjg1i4nb7e1u5slkbj',NULL,NULL,'p17pdrtvaepjg1i4nb7e1u5slkbj',NULL,NULL,'jpg',NULL,'2013-04-30 16:21:24'),(23,'p17pdrtvae1f3b11fsud1t0vhvlk',NULL,NULL,'p17pdrtvae1f3b11fsud1t0vhvlk',NULL,NULL,'jpg',NULL,'2013-04-30 16:21:26'),(24,'p17pdrtvafa8fo5e17cb1sd3tohl',NULL,NULL,'p17pdrtvafa8fo5e17cb1sd3tohl',NULL,NULL,'jpg',NULL,'2013-04-30 16:21:28'),(25,'p17pjnkgud5dd97ep71cf1pk64',NULL,NULL,'p17pjnkgud5dd97ep71cf1pk64',NULL,NULL,'jpg',NULL,'2013-05-02 23:01:11'),(26,'p17pjnkguf13mb1aq8fln143b8765',NULL,NULL,'p17pjnkguf13mb1aq8fln143b8765',NULL,NULL,'jpg',NULL,'2013-05-02 23:01:13'),(27,'p17pjnkgug1ml915p414k9g781s676',NULL,NULL,'p17pjnkgug1ml915p414k9g781s676',NULL,NULL,'jpg',NULL,'2013-05-02 23:01:15'),(28,'p17pjnkgug5tp91bsiv12nc1i987',NULL,NULL,'p17pjnkgug5tp91bsiv12nc1i987',NULL,NULL,'jpg',NULL,'2013-05-02 23:01:17'),(29,'p17pjnkguh14pl18r9187ums61n5d8',NULL,NULL,'p17pjnkguh14pl18r9187ums61n5d8',NULL,NULL,'jpg',NULL,'2013-05-02 23:01:18'),(30,'p17pjnkguhv9d131coh18ghl3m9',NULL,NULL,'p17pjnkguhv9d131coh18ghl3m9',NULL,NULL,'jpg',NULL,'2013-05-02 23:01:20'),(31,'p17pjnkgui1qe1eegthb1ba81cjpa',NULL,NULL,'p17pjnkgui1qe1eegthb1ba81cjpa',NULL,NULL,'jpg',NULL,'2013-05-02 23:01:22'),(32,'p17pjnkguiohv14m82j9fv3b7ab',NULL,NULL,'p17pjnkguiohv14m82j9fv3b7ab',NULL,NULL,'jpg',NULL,'2013-05-02 23:01:24'),(33,'p17pjnkguj1d8p6g1vdt1cpe15obc',NULL,NULL,'p17pjnkguj1d8p6g1vdt1cpe15obc',NULL,NULL,'jpg',NULL,'2013-05-02 23:01:25'),(34,'p17pjnkguk1876v8r1fpv194rnkud',NULL,NULL,'p17pjnkguk1876v8r1fpv194rnkud',NULL,NULL,'jpg',NULL,'2013-05-02 23:01:27'),(35,'p17pjnkguk1gt21dii1q86ri7un1e',NULL,NULL,'p17pjnkguk1gt21dii1q86ri7un1e',NULL,NULL,'jpg',NULL,'2013-05-02 23:01:29'),(36,'p17pjnkguld36hn95iu8jq1i65f',NULL,NULL,'p17pjnkguld36hn95iu8jq1i65f',NULL,NULL,'jpg',NULL,'2013-05-02 23:01:31'),(37,'p17pjnkgul8nkrvsbgl18v21fkeg',NULL,NULL,'p17pjnkgul8nkrvsbgl18v21fkeg',NULL,NULL,'jpg',NULL,'2013-05-02 23:01:32'),(38,'p17pjoc00g1rsa18et1ku6eve1f5h4',NULL,NULL,'p17pjoc00g1rsa18et1ku6eve1f5h4',NULL,NULL,'jpg',NULL,'2013-05-02 23:14:02'),(39,'p17pjoc00i9m81jt52748eng395',NULL,NULL,'p17pjoc00i9m81jt52748eng395',NULL,NULL,'jpg',NULL,'2013-05-02 23:14:06'),(40,'p17pjognhk112l1bfd1dvh1jlvcv65',NULL,NULL,'p17pjognhk112l1bfd1dvh1jlvcv65',NULL,NULL,'jpg',NULL,'2013-05-02 23:16:36'),(41,'p17pjognhm12gsahd1m241tf3g36',NULL,NULL,'p17pjognhm12gsahd1m241tf3g36',NULL,NULL,'jpg',NULL,'2013-05-02 23:16:38'),(42,'p17pjognhn1epoide1dgi1e9r1ghm7',NULL,NULL,'p17pjognhn1epoide1dgi1e9r1ghm7',NULL,NULL,'jpg',NULL,'2013-05-02 23:16:41'),(43,'p17pm8v5291le1stvapa89f1edf4',NULL,NULL,'p17pm8v5291le1stvapa89f1edf4',NULL,NULL,'jpg',NULL,'2013-05-03 22:42:37'),(44,'p17pm8v52b1hmajrah9rimees45',NULL,NULL,'p17pm8v52b1hmajrah9rimees45',NULL,NULL,'jpg',NULL,'2013-05-03 22:42:39'),(45,'p17pm8v52c1tju1ehg1n4v998hfs6',NULL,NULL,'p17pm8v52c1tju1ehg1n4v998hfs6',NULL,NULL,'jpg',NULL,'2013-05-03 22:42:41'),(46,'p17pm8v52d1vafiaabfu1q0217v57',NULL,NULL,'p17pm8v52d1vafiaabfu1q0217v57',NULL,NULL,'jpg',NULL,'2013-05-03 22:42:43'),(47,'p17pm8v52e9o6151g19un1k7h1t1k8',NULL,NULL,'p17pm8v52e9o6151g19un1k7h1t1k8',NULL,NULL,'jpg',NULL,'2013-05-03 22:42:45'),(48,'p17pm8v52f55v7t3g4qreuim9',NULL,NULL,'p17pm8v52f55v7t3g4qreuim9',NULL,NULL,'jpg',NULL,'2013-05-03 22:42:47'),(49,'p17pm8v52gjhu1nab18o43rmqfja',NULL,NULL,'p17pm8v52gjhu1nab18o43rmqfja',NULL,NULL,'jpg',NULL,'2013-05-03 22:42:49'),(50,'p17pm8v52h12gpoorfib1t2bu9vb',NULL,NULL,'p17pm8v52h12gpoorfib1t2bu9vb',NULL,NULL,'jpg',NULL,'2013-05-03 22:42:51'),(51,'p17pm8v52ivul7951baurjh9ilc',NULL,NULL,'p17pm8v52ivul7951baurjh9ilc',NULL,NULL,'jpg',NULL,'2013-05-03 22:42:53'),(52,'p17pm8v52j1s4tmj7m1m1c792iod',NULL,NULL,'p17pm8v52j1s4tmj7m1m1c792iod',NULL,NULL,'jpg',NULL,'2013-05-03 22:42:55'),(53,'p17pm92rgjj9k17rlsusmf7dr04',NULL,NULL,'p17pm92rgjj9k17rlsusmf7dr04',NULL,NULL,'jpg',NULL,'2013-05-03 22:44:42'),(54,'p17pm92rgk1niffmmcc91lbe1bju5',NULL,NULL,'p17pm92rgk1niffmmcc91lbe1bju5',NULL,NULL,'jpg',NULL,'2013-05-03 22:44:45'),(55,'p17pm92rgm10v2rqeveav5s1esf6',NULL,NULL,'p17pm92rgm10v2rqeveav5s1esf6',NULL,NULL,'jpg',NULL,'2013-05-03 22:44:47'),(56,'p17pm92rgn165b1lj51aelj1c4f17',NULL,NULL,'p17pm92rgn165b1lj51aelj1c4f17',NULL,NULL,'jpg',NULL,'2013-05-03 22:44:49'),(57,'p17pm92rgo18f462v1gh3pr03oh8',NULL,NULL,'p17pm92rgo18f462v1gh3pr03oh8',NULL,NULL,'jpg',NULL,'2013-05-03 22:44:51'),(58,'p17pm92rgp1h7n1ker151p19riam49',NULL,NULL,'p17pm92rgp1h7n1ker151p19riam49',NULL,NULL,'jpg',NULL,'2013-05-03 22:44:53'),(59,'p17pm92rgqkv3gkhs9knnqvuna',NULL,NULL,'p17pm92rgqkv3gkhs9knnqvuna',NULL,NULL,'jpg',NULL,'2013-05-03 22:44:55'),(60,'p17pm92rgr1mgp1tgt1ml61m6418g4b',NULL,NULL,'p17pm92rgr1mgp1tgt1ml61m6418g4b',NULL,NULL,'jpg',NULL,'2013-05-03 22:44:57'),(61,'p17pm92rgsgh21r935ptr3r196sc',NULL,NULL,'p17pm92rgsgh21r935ptr3r196sc',NULL,NULL,'jpg',NULL,'2013-05-03 22:44:59'),(62,'p17pm92rgs1u51r3o13lml8k1r0kd',NULL,NULL,'p17pm92rgs1u51r3o13lml8k1r0kd',NULL,NULL,'jpg',NULL,'2013-05-03 22:45:01'),(63,'p17pm92rgt1vgi1h53sp3a381ikpe',NULL,NULL,'p17pm92rgt1vgi1h53sp3a381ikpe',NULL,NULL,'jpg',NULL,'2013-05-03 22:45:03'),(64,'p17pm92rgumkf1tupevj7vpjnaf',NULL,NULL,'p17pm92rgumkf1tupevj7vpjnaf',NULL,NULL,'jpg',NULL,'2013-05-03 22:45:05'),(65,'p17pm92rgv1kac1ss0ocak88vupg',NULL,NULL,'p17pm92rgv1kac1ss0ocak88vupg',NULL,NULL,'jpg',NULL,'2013-05-03 22:45:07'),(66,'p17pm92rh0125b9o0j40m9q1tg5h',NULL,NULL,'p17pm92rh0125b9o0j40m9q1tg5h',NULL,NULL,'jpg',NULL,'2013-05-03 22:45:09'),(67,'p17pm92rh1125m8smgh21e0dmssi',NULL,NULL,'p17pm92rh1125m8smgh21e0dmssi',NULL,NULL,'jpg',NULL,'2013-05-03 22:45:11'),(68,'p17pm92rh2s421fiok4lksv1vgvj',NULL,NULL,'p17pm92rh2s421fiok4lksv1vgvj',NULL,NULL,'jpg',NULL,'2013-05-03 22:45:13'),(69,'p17pm92rh3ove8e0jrp11or1hrqk',NULL,NULL,'p17pm92rh3ove8e0jrp11or1hrqk',NULL,NULL,'jpg',NULL,'2013-05-03 22:45:15'),(70,'p17pm92rh31b9k1h2hvs41tcs1oc8l',NULL,NULL,'p17pm92rh31b9k1h2hvs41tcs1oc8l',NULL,NULL,'jpg',NULL,'2013-05-03 22:45:17'),(71,'p17pm92rh4d0s18vt1t391jq81k75m',NULL,NULL,'p17pm92rh4d0s18vt1t391jq81k75m',NULL,NULL,'jpg',NULL,'2013-05-03 22:45:19'),(72,'p17pm92rh51n1h1npn17ua1kmslfan',NULL,NULL,'p17pm92rh51n1h1npn17ua1kmslfan',NULL,NULL,'jpg',NULL,'2013-05-03 22:45:21'),(73,'p17pm92rh6r61pqg1skjv612rqo',NULL,NULL,'p17pm92rh6r61pqg1skjv612rqo',NULL,NULL,'jpg',NULL,'2013-05-03 22:45:23'),(74,'p17pm92rh71gq042d1uij8o01cl9p',NULL,NULL,'p17pm92rh71gq042d1uij8o01cl9p',NULL,NULL,'jpg',NULL,'2013-05-03 22:45:25'),(75,'p17pm92rh727j18dd1uu38le1h14q',NULL,NULL,'p17pm92rh727j18dd1uu38le1h14q',NULL,NULL,'jpg',NULL,'2013-05-03 22:45:27'),(76,'p17pm92rh91env9l21eesmk9m62r',NULL,NULL,'p17pm92rh91env9l21eesmk9m62r',NULL,NULL,'jpg',NULL,'2013-05-03 22:45:29'),(77,'p17pm92rha113l6351hcr19kutbfs',NULL,NULL,'p17pm92rha113l6351hcr19kutbfs',NULL,NULL,'jpg',NULL,'2013-05-03 22:45:31'),(78,'p17pm92rhb19u31msedou1t5c1e4bt',NULL,NULL,'p17pm92rhb19u31msedou1t5c1e4bt',NULL,NULL,'jpg',NULL,'2013-05-03 22:45:33'),(79,'p17pm92rhc1bp390s1dabpv21qqnu',NULL,NULL,'p17pm92rhc1bp390s1dabpv21qqnu',NULL,NULL,'jpg',NULL,'2013-05-03 22:45:35'),(80,'p17pm92rhdb84i3i1a1on4417omv',NULL,NULL,'p17pm92rhdb84i3i1a1on4417omv',NULL,NULL,'jpg',NULL,'2013-05-03 22:45:37'),(81,'p17pm92rhegk51u0n4tb23j31p10',NULL,NULL,'p17pm92rhegk51u0n4tb23j31p10',NULL,NULL,'jpg',NULL,'2013-05-03 22:45:39'),(82,'p17pm92rhf12nra7a1r6h105i1lug11',NULL,NULL,'p17pm92rhf12nra7a1r6h105i1lug11',NULL,NULL,'jpg',NULL,'2013-05-03 22:45:41'),(83,'p17pm92rhgsh1kqa184113k01ov112',NULL,NULL,'p17pm92rhgsh1kqa184113k01ov112',NULL,NULL,'jpg',NULL,'2013-05-03 22:45:43'),(84,'p17pm92rhht4c9jifepocg1e6g13',NULL,NULL,'p17pm92rhht4c9jifepocg1e6g13',NULL,NULL,'jpg',NULL,'2013-05-03 22:45:46'),(85,'p17pm9e6bdl51lo9baj1a8u1at14',NULL,NULL,'p17pm9e6bdl51lo9baj1a8u1at14',NULL,NULL,'jpg',NULL,'2013-05-03 22:50:49'),(86,'p17pm9e6bf1jr6aujf23p631ejm5',NULL,NULL,'p17pm9e6bf1jr6aujf23p631ejm5',NULL,NULL,'jpg',NULL,'2013-05-03 22:50:51'),(87,'p17pm9e6bgcio84kjjd15tjikv6',NULL,NULL,'p17pm9e6bgcio84kjjd15tjikv6',NULL,NULL,'jpg',NULL,'2013-05-03 22:50:53'),(88,'p17pm9e6bhdtl17or18qi16fu18l47',NULL,NULL,'p17pm9e6bhdtl17or18qi16fu18l47',NULL,NULL,'jpg',NULL,'2013-05-03 22:50:55'),(89,'p17pm9e6bi18r31grqu3p1ovo1g0p8',NULL,NULL,'p17pm9e6bi18r31grqu3p1ovo1g0p8',NULL,NULL,'jpg',NULL,'2013-05-03 22:50:57'),(90,'p17pm9e6bj1aa9u50kb0lo29nc9',NULL,NULL,'p17pm9e6bj1aa9u50kb0lo29nc9',NULL,NULL,'jpg',NULL,'2013-05-03 22:50:59'),(91,'p17pm9e6bk169rb5ttrv5og66pa',NULL,NULL,'p17pm9e6bk169rb5ttrv5og66pa',NULL,NULL,'jpg',NULL,'2013-05-03 22:51:01'),(92,'p17pm9e6bluvp76j1dpjj7711o3b',NULL,NULL,'p17pm9e6bluvp76j1dpjj7711o3b',NULL,NULL,'jpg',NULL,'2013-05-03 22:51:03'),(93,'p17pm9e6bm5danave5aadi1fakc',NULL,NULL,'p17pm9e6bm5danave5aadi1fakc',NULL,NULL,'jpg',NULL,'2013-05-03 22:51:05'),(94,'p17pm9e6bn19ic15gf4jk1ln11cfd',NULL,NULL,'p17pm9e6bn19ic15gf4jk1ln11cfd',NULL,NULL,'jpg',NULL,'2013-05-03 22:51:07'),(95,'p17pm9e6bons11fr1m0a6801ja3e',NULL,NULL,'p17pm9e6bons11fr1m0a6801ja3e',NULL,NULL,'jpg',NULL,'2013-05-03 22:51:09'),(96,'p17pm9k7s6tfhd3f19231g391kvs4',NULL,NULL,'p17pm9k7s6tfhd3f19231g391kvs4',NULL,NULL,'jpg',NULL,'2013-05-03 22:54:07'),(97,'p17pm9k7s8bpqnvid061mjb1bd5',NULL,NULL,'p17pm9k7s8bpqnvid061mjb1bd5',NULL,NULL,'jpg',NULL,'2013-05-03 22:54:09'),(98,'p17pm9k7s9fmlgkv1jscag8gb16',NULL,NULL,'p17pm9k7s9fmlgkv1jscag8gb16',NULL,NULL,'jpg',NULL,'2013-05-03 22:54:11'),(99,'p17pm9k7s91bg01de6193aqo415is7',NULL,NULL,'p17pm9k7s91bg01de6193aqo415is7',NULL,NULL,'jpg',NULL,'2013-05-03 22:54:13'),(100,'p17pm9k7sa1bt21iomb7qdbmmu8',NULL,NULL,'p17pm9k7sa1bt21iomb7qdbmmu8',NULL,NULL,'jpg',NULL,'2013-05-03 22:54:15'),(101,'p17pm9k7sba519d4u10v1f1vjo9',NULL,NULL,'p17pm9k7sba519d4u10v1f1vjo9',NULL,NULL,'jpg',NULL,'2013-05-03 22:54:17'),(102,'p17pm9k7sbit11hpk1okjg0sr9ha',NULL,NULL,'p17pm9k7sbit11hpk1okjg0sr9ha',NULL,NULL,'jpg',NULL,'2013-05-03 22:54:20'),(103,'p17pm9msqbqnipie1d4t1a6rhl64',NULL,NULL,'p17pm9msqbqnipie1d4t1a6rhl64',NULL,NULL,'jpg',NULL,'2013-05-03 22:56:42'),(104,'p17pm9msqc1ffq29018gv333i0e5',NULL,NULL,'p17pm9msqc1ffq29018gv333i0e5',NULL,NULL,'jpg',NULL,'2013-05-03 22:56:44'),(105,'p17pm9msqe2m7a4me5po216576',NULL,NULL,'p17pm9msqe2m7a4me5po216576',NULL,NULL,'jpg',NULL,'2013-05-03 22:56:46'),(106,'p17pm9msqf13rn174mjrmlif1p2n7',NULL,NULL,'p17pm9msqf13rn174mjrmlif1p2n7',NULL,NULL,'jpg',NULL,'2013-05-03 22:56:48'),(107,'p17pm9msqgedu81l287c0rf6o8',NULL,NULL,'p17pm9msqgedu81l287c0rf6o8',NULL,NULL,'jpg',NULL,'2013-05-03 22:56:52'),(108,'p17pm9msqhfnme04u7c1613dti9',NULL,NULL,'p17pm9msqhfnme04u7c1613dti9',NULL,NULL,'jpg',NULL,'2013-05-03 22:56:55'),(109,'p17pm9msqh1a8b6ni1b5f1qf41o3ra',NULL,NULL,'p17pm9msqh1a8b6ni1b5f1qf41o3ra',NULL,NULL,'jpg',NULL,'2013-05-03 22:56:57'),(110,'p17pm9msqi1lle1lfkqq125b1nn0b',NULL,NULL,'p17pm9msqi1lle1lfkqq125b1nn0b',NULL,NULL,'jpg',NULL,'2013-05-03 22:56:59'),(111,'p17pm9msqj1laa1l9g1sgd1s8f11i5c',NULL,NULL,'p17pm9msqj1laa1l9g1sgd1s8f11i5c',NULL,NULL,'jpg',NULL,'2013-05-03 22:57:02'),(112,'p17pm9u884mtialjefj1hb119tg4',NULL,NULL,'p17pm9u884mtialjefj1hb119tg4',NULL,NULL,'jpg',NULL,'2013-05-03 22:59:34'),(113,'p17pm9u8861druipgu7r15kv1ep25',NULL,NULL,'p17pm9u8861druipgu7r15kv1ep25',NULL,NULL,'jpg',NULL,'2013-05-03 22:59:37'),(114,'p17pm9u8871e401u7v1bng194c1kh56',NULL,NULL,'p17pm9u8871e401u7v1bng194c1kh56',NULL,NULL,'jpg',NULL,'2013-05-03 22:59:39'),(115,'p17pm9u88811jf1tlvjgq81kvvk7',NULL,NULL,'p17pm9u88811jf1tlvjgq81kvvk7',NULL,NULL,'jpg',NULL,'2013-05-03 22:59:41'),(116,'p17pm9u888ffto3n157aj7m1aq8',NULL,NULL,'p17pm9u888ffto3n157aj7m1aq8',NULL,NULL,'jpg',NULL,'2013-05-03 22:59:43'),(117,'p17pm9u8891rmv12p4pb7u629389',NULL,NULL,'p17pm9u8891rmv12p4pb7u629389',NULL,NULL,'jpg',NULL,'2013-05-03 22:59:45'),(118,'p17pm9u88ai1c1930m6g190b1635a',NULL,NULL,'p17pm9u88ai1c1930m6g190b1635a',NULL,NULL,'jpg',NULL,'2013-05-03 22:59:47'),(119,'p17pm9u88biqh1qphlouh0ps8kb',NULL,NULL,'p17pm9u88biqh1qphlouh0ps8kb',NULL,NULL,'jpg',NULL,'2013-05-03 22:59:50'),(120,'p17pm9u88c1nip1fru29j1llo10kpc',NULL,NULL,'p17pm9u88c1nip1fru29j1llo10kpc',NULL,NULL,'jpg',NULL,'2013-05-03 22:59:53'),(121,'p17pm9u88deu8vn71par1pq2rfod',NULL,NULL,'p17pm9u88deu8vn71par1pq2rfod',NULL,NULL,'jpg',NULL,'2013-05-03 22:59:55'),(122,'p17pm9u88eh0p1q5h1t3l1fgl1d91e',NULL,NULL,'p17pm9u88eh0p1q5h1t3l1fgl1d91e',NULL,NULL,'jpg',NULL,'2013-05-03 22:59:57'),(123,'p17pm9u88e189h5dhm2i1up01k7vf',NULL,NULL,'p17pm9u88e189h5dhm2i1up01k7vf',NULL,NULL,'jpg',NULL,'2013-05-03 23:00:00'),(124,'p17pma30t51ugp1rkv1bu21ffp11ek4',NULL,NULL,'p17pma30t51ugp1rkv1bu21ffp11ek4',NULL,NULL,'jpg',NULL,'2013-05-03 23:02:11'),(125,'p17pma30t7jii1kro1b3l11iejdb5',NULL,NULL,'p17pma30t7jii1kro1b3l11iejdb5',NULL,NULL,'jpg',NULL,'2013-05-03 23:02:14'),(126,'p17pma30t91uvj1m423m21ef7kpk6',NULL,NULL,'p17pma30t91uvj1m423m21ef7kpk6',NULL,NULL,'jpg',NULL,'2013-05-03 23:02:16'),(127,'p17pma30ta1r5lem910mu1e43l2v7',NULL,NULL,'p17pma30ta1r5lem910mu1e43l2v7',NULL,NULL,'jpg',NULL,'2013-05-03 23:02:17'),(128,'p17pma30tb1mb23c82br1ohs1pm28',NULL,NULL,'p17pma30tb1mb23c82br1ohs1pm28',NULL,NULL,'jpg',NULL,'2013-05-03 23:02:19'),(129,'p17pma30tcbellukt8b1ksn5539',NULL,NULL,'p17pma30tcbellukt8b1ksn5539',NULL,NULL,'jpg',NULL,'2013-05-03 23:02:21'),(130,'p17pma30td91u1ob61qf8pfb1kjha',NULL,NULL,'p17pma30td91u1ob61qf8pfb1kjha',NULL,NULL,'jpg',NULL,'2013-05-03 23:02:23'),(131,'p17pma30te1sqg1vtfaes1o24lnpb',NULL,NULL,'p17pma30te1sqg1vtfaes1o24lnpb',NULL,NULL,'jpg',NULL,'2013-05-03 23:02:25'),(132,'p17pma30tf1a581t1n9o7ejmn6oc',NULL,NULL,'p17pma30tf1a581t1n9o7ejmn6oc',NULL,NULL,'jpg',NULL,'2013-05-03 23:02:27'),(133,'p17pma30tg401sa6ldh103t5fld',NULL,NULL,'p17pma30tg401sa6ldh103t5fld',NULL,NULL,'jpg',NULL,'2013-05-03 23:02:29'),(134,'p17pmad21u13lrucnj231aeqvn34',NULL,NULL,'p17pmad21u13lrucnj231aeqvn34',NULL,NULL,'jpg',NULL,'2013-05-03 23:07:38'),(135,'p17pmad21vqct1ud14v6liln2g5',NULL,NULL,'p17pmad21vqct1ud14v6liln2g5',NULL,NULL,'jpg',NULL,'2013-05-03 23:07:40'),(136,'p17pmad22015qf39m15n53u45276',NULL,NULL,'p17pmad22015qf39m15n53u45276',NULL,NULL,'jpg',NULL,'2013-05-03 23:07:41'),(137,'p17pmad2211lc9t7i1mjr1r7vb377',NULL,NULL,'p17pmad2211lc9t7i1mjr1r7vb377',NULL,NULL,'jpg',NULL,'2013-05-03 23:07:42'),(138,'p17pmad222j75u2kjhkjl81b5m8',NULL,NULL,'p17pmad222j75u2kjhkjl81b5m8',NULL,NULL,'jpg',NULL,'2013-05-03 23:07:43'),(139,'p17pmad2221f4qsbg1e54dbn1lfp9',NULL,NULL,'p17pmad2221f4qsbg1e54dbn1lfp9',NULL,NULL,'jpg',NULL,'2013-05-03 23:07:44'),(140,'p17pmad223etp1bmn1e3v12k01urua',NULL,NULL,'p17pmad223etp1bmn1e3v12k01urua',NULL,NULL,'jpg',NULL,'2013-05-03 23:07:45'),(141,'p17pmad22418qt1h791elgmsu1ijob',NULL,NULL,'p17pmad22418qt1h791elgmsu1ijob',NULL,NULL,'jpg',NULL,'2013-05-03 23:07:46'),(142,'p17pmad224m83kge1kgu17rqiqvc',NULL,NULL,'p17pmad224m83kge1kgu17rqiqvc',NULL,NULL,'jpg',NULL,'2013-05-03 23:07:48'),(143,'p17pmag91s14k21nf74bn10ts1dmc4',NULL,NULL,'p17pmag91s14k21nf74bn10ts1dmc4',NULL,NULL,'jpg',NULL,'2013-05-03 23:09:29'),(144,'p17pmag91u47o14md1mtohkn1hqm5',NULL,NULL,'p17pmag91u47o14md1mtohkn1hqm5',NULL,NULL,'jpg',NULL,'2013-05-03 23:09:33'),(145,'p17pmag91v1qmfn4pk21ssv4j36',NULL,NULL,'p17pmag91v1qmfn4pk21ssv4j36',NULL,NULL,'jpg',NULL,'2013-05-03 23:09:35'),(146,'p17pmag9201i3n12651gjoa0l2ek7',NULL,NULL,'p17pmag9201i3n12651gjoa0l2ek7',NULL,NULL,'jpg',NULL,'2013-05-03 23:09:38'),(147,'p17pmag9211nge92q1lij15jg1va8',NULL,NULL,'p17pmag9211nge92q1lij15jg1va8',NULL,NULL,'jpg',NULL,'2013-05-03 23:09:41'),(148,'p17pmag922ebrd2t13kjdcs161b9',NULL,NULL,'p17pmag922ebrd2t13kjdcs161b9',NULL,NULL,'jpg',NULL,'2013-05-03 23:09:44'),(149,'p17pmag923qt110qbjgttm19j2a',NULL,NULL,'p17pmag923qt110qbjgttm19j2a',NULL,NULL,'jpg',NULL,'2013-05-03 23:09:46'),(150,'p17pmag9249uc1897mg71q5u1cib',NULL,NULL,'p17pmag9249uc1897mg71q5u1cib',NULL,NULL,'jpg',NULL,'2013-05-03 23:09:48'),(151,'p17pmag9251ob5bn89poafd6fqc',NULL,NULL,'p17pmag9251ob5bn89poafd6fqc',NULL,NULL,'jpg',NULL,'2013-05-03 23:09:50'),(152,'p17pmag926ebabj8vb91e0p16mhd',NULL,NULL,'p17pmag926ebabj8vb91e0p16mhd',NULL,NULL,'jpg',NULL,'2013-05-03 23:09:52'),(153,'p17pmag927pb1kvjj0d1m251ie0e',NULL,NULL,'p17pmag927pb1kvjj0d1m251ie0e',NULL,NULL,'jpg',NULL,'2013-05-03 23:09:54'),(154,'p17pmag92817qc11rju7e1oug1u3kf',NULL,NULL,'p17pmag92817qc11rju7e1oug1u3kf',NULL,NULL,'jpg',NULL,'2013-05-03 23:09:56'),(155,'p17pmag929184jfq1nmk18fb14lrg',NULL,NULL,'p17pmag929184jfq1nmk18fb14lrg',NULL,NULL,'jpg',NULL,'2013-05-03 23:09:58'),(156,'p17pmag92a19gm17rarue4i811sch',NULL,NULL,'p17pmag92a19gm17rarue4i811sch',NULL,NULL,'jpg',NULL,'2013-05-03 23:10:00'),(157,'p17pmag92bigm62e196k1m7k1kc1i',NULL,NULL,'p17pmag92bigm62e196k1m7k1kc1i',NULL,NULL,'jpg',NULL,'2013-05-03 23:10:02'),(158,'p17pmag92c167g7t17g8130k62j',NULL,NULL,'p17pmag92c167g7t17g8130k62j',NULL,NULL,'jpg',NULL,'2013-05-03 23:10:04'),(159,'p17pmag92c16fo1dbu17b4ac61fuk',NULL,NULL,'p17pmag92c16fo1dbu17b4ac61fuk',NULL,NULL,'jpg',NULL,'2013-05-03 23:10:06'),(160,'p17pmag92d8hn9tc98s1j6kmbml',NULL,NULL,'p17pmag92d8hn9tc98s1j6kmbml',NULL,NULL,'jpg',NULL,'2013-05-03 23:10:08'),(161,'p17pmag92e1c6p5tq1n6d1n92vvam',NULL,NULL,'p17pmag92e1c6p5tq1n6d1n92vvam',NULL,NULL,'jpg',NULL,'2013-05-03 23:10:10'),(162,'p17pmag92f4vitp617ml36b1la9n',NULL,NULL,'p17pmag92f4vitp617ml36b1la9n',NULL,NULL,'jpg',NULL,'2013-05-03 23:10:12'),(163,'p17pmag92g1264i921pij17momp8o',NULL,NULL,'p17pmag92g1264i921pij17momp8o',NULL,NULL,'jpg',NULL,'2013-05-03 23:10:14'),(164,'p17pmag92h1vtg1pragpu1cpj1me7p',NULL,NULL,'p17pmag92h1vtg1pragpu1cpj1me7p',NULL,NULL,'jpg',NULL,'2013-05-03 23:10:16'),(165,'p17pmag92itfl76n7kon978iq',NULL,NULL,'p17pmag92itfl76n7kon978iq',NULL,NULL,'jpg',NULL,'2013-05-03 23:10:18'),(166,'p17pmag92j183r15r8c5l12jd12bgr',NULL,NULL,'p17pmag92j183r15r8c5l12jd12bgr',NULL,NULL,'jpg',NULL,'2013-05-03 23:10:20'),(167,'p17pmag92knnn6sa7ak1jv93eus',NULL,NULL,'p17pmag92knnn6sa7ak1jv93eus',NULL,NULL,'jpg',NULL,'2013-05-03 23:10:22'),(168,'p17pmalm08903ocakn41j951d494',NULL,NULL,'p17pmalm08903ocakn41j951d494',NULL,NULL,'jpg',NULL,'2013-05-03 23:12:26'),(169,'p17pmalm0aifq1bro156e1if8gj65',NULL,NULL,'p17pmalm0aifq1bro156e1if8gj65',NULL,NULL,'jpg',NULL,'2013-05-03 23:12:28'),(170,'p17pmalm0b1vv0u1r1jo5s9314p76',NULL,NULL,'p17pmalm0b1vv0u1r1jo5s9314p76',NULL,NULL,'jpg',NULL,'2013-05-03 23:12:30'),(171,'p17pmalm0ch1afq24d21fuv15417',NULL,NULL,'p17pmalm0ch1afq24d21fuv15417',NULL,NULL,'jpg',NULL,'2013-05-03 23:12:32'),(172,'p17pmalm0dh3p10i590ne1lk468',NULL,NULL,'p17pmalm0dh3p10i590ne1lk468',NULL,NULL,'jpg',NULL,'2013-05-03 23:12:34'),(173,'p17pmalm0ed8i1q761moa10bfie19',NULL,NULL,'p17pmalm0ed8i1q761moa10bfie19',NULL,NULL,'jpg',NULL,'2013-05-03 23:12:36'),(174,'p17pmalm0fvv6t91a5kf1q1avka',NULL,NULL,'p17pmalm0fvv6t91a5kf1q1avka',NULL,NULL,'jpg',NULL,'2013-05-03 23:12:38'),(175,'p17pmalm0g1lbt1dvgt614s21a6gb',NULL,NULL,'p17pmalm0g1lbt1dvgt614s21a6gb',NULL,NULL,'jpg',NULL,'2013-05-03 23:12:40'),(176,'p17pmalm0h1bqn2k0khd175h140hc',NULL,NULL,'p17pmalm0h1bqn2k0khd175h140hc',NULL,NULL,'jpg',NULL,'2013-05-03 23:12:42'),(177,'p17pmalm0i13gi196ts45squ1tcbd',NULL,NULL,'p17pmalm0i13gi196ts45squ1tcbd',NULL,NULL,'jpg',NULL,'2013-05-03 23:12:45'),(178,'p17pmalm0j1p7tavk1slk1gr21nbue',NULL,NULL,'p17pmalm0j1p7tavk1slk1gr21nbue',NULL,NULL,'jpg',NULL,'2013-05-03 23:12:48'),(179,'p17pmalm0k7ti1i0h1f3g13d02tqf',NULL,NULL,'p17pmalm0k7ti1i0h1f3g13d02tqf',NULL,NULL,'jpg',NULL,'2013-05-03 23:12:52'),(180,'p17pmalm0lm6k4vb1lvu1rhg1ukjg',NULL,NULL,'p17pmalm0lm6k4vb1lvu1rhg1ukjg',NULL,NULL,'jpg',NULL,'2013-05-03 23:12:55'),(181,'p17pmalm0mfqbifv1c5e7515j6h',NULL,NULL,'p17pmalm0mfqbifv1c5e7515j6h',NULL,NULL,'jpg',NULL,'2013-05-03 23:12:58'),(182,'p17pmalm0nmcp5j11mh1mp11l9gi',NULL,NULL,'p17pmalm0nmcp5j11mh1mp11l9gi',NULL,NULL,'jpg',NULL,'2013-05-03 23:13:02'),(183,'p17pmalm0onm01mmg1ob449719t4j',NULL,NULL,'p17pmalm0onm01mmg1ob449719t4j',NULL,NULL,'jpg',NULL,'2013-05-03 23:13:05'),(184,'p17pmalm0pohro3bemd1g571rhpk',NULL,NULL,'p17pmalm0pohro3bemd1g571rhpk',NULL,NULL,'jpg',NULL,'2013-05-03 23:13:10'),(185,'p17pmarb01rohid10o3v6sidu4',NULL,NULL,'p17pmarb01rohid10o3v6sidu4',NULL,NULL,'jpg',NULL,'2013-05-03 23:15:27'),(186,'p17pmarb0317ej1pk216trhfala25',NULL,NULL,'p17pmarb0317ej1pk216trhfala25',NULL,NULL,'jpg',NULL,'2013-05-03 23:15:29'),(187,'p17pmarb04rs1odtbo31bkdf696',NULL,NULL,'p17pmarb04rs1odtbo31bkdf696',NULL,NULL,'jpg',NULL,'2013-05-03 23:15:31'),(188,'p17pmarb058dh1i2i4h71hfibhp7',NULL,NULL,'p17pmarb058dh1i2i4h71hfibhp7',NULL,NULL,'jpg',NULL,'2013-05-03 23:15:33'),(189,'p17pmarb06l231g431pc3h39d578',NULL,NULL,'p17pmarb06l231g431pc3h39d578',NULL,NULL,'jpg',NULL,'2013-05-03 23:15:35'),(190,'p17pmarb07rqv4qferq1ptggs09',NULL,NULL,'p17pmarb07rqv4qferq1ptggs09',NULL,NULL,'jpg',NULL,'2013-05-03 23:15:37'),(191,'p17pmarb08juhua016aphuo1cj0a',NULL,NULL,'p17pmarb08juhua016aphuo1cj0a',NULL,NULL,'jpg',NULL,'2013-05-03 23:15:40'),(192,'p17pvd8ah61i895ll1vlbdc719fs4',NULL,NULL,'p17pvd8ah61i895ll1vlbdc719fs4',NULL,NULL,'png',NULL,'2013-05-07 11:51:14'),(193,'p17pvd8ah6tmk1gd813un72j1gv25',NULL,NULL,'p17pvd8ah6tmk1gd813un72j1gv25',NULL,NULL,'png',NULL,'2013-05-07 11:51:16'),(204,'p17qfafjs71l9m1qqj17ur1q1e1bo48',NULL,NULL,'p17qfafjs71l9m1qqj17ur1q1e1bo48',NULL,NULL,'jpg',NULL,'2013-05-13 16:11:36'),(205,'p17qfafjs71mgiftj5pp1hi3s5g9',NULL,NULL,'p17qfafjs71mgiftj5pp1hi3s5g9',NULL,NULL,'jpg',NULL,'2013-05-13 16:11:51'),(206,'p17qfafjs7p1iut31v7c1ptq12t5a',NULL,NULL,'p17qfafjs7p1iut31v7c1ptq12t5a',NULL,NULL,'jpg',NULL,'2013-05-13 16:12:09'),(207,'p17qfafjs81bf21078gf4v2d1q92d',NULL,NULL,'p17qfafjs81bf21078gf4v2d1q92d',NULL,NULL,'jpg',NULL,'2013-05-13 16:13:00'),(208,'p17qfafjs8lt414u0cqapvu1gdge',NULL,NULL,'p17qfafjs8lt414u0cqapvu1gdge',NULL,NULL,'jpg',NULL,'2013-05-13 16:13:18'),(209,'p17qfafjs8d6l1aj31f9a17mb8icf',NULL,NULL,'p17qfafjs8d6l1aj31f9a17mb8icf',NULL,NULL,'jpg',NULL,'2013-05-13 16:13:38'),(210,'p17qfbnjqn701ii6q1omkjo95',NULL,NULL,'p17qfbnjqn701ii6q1omkjo95',NULL,NULL,'jpg',NULL,'2013-05-13 16:32:20'),(211,'p17qfbnjqnl4l10piqvane2iet6',NULL,NULL,'p17qfbnjqnl4l10piqvane2iet6',NULL,NULL,'jpg',NULL,'2013-05-13 16:32:32'),(212,'p17qfbnjqnira1tt0h5v7tl8uo7',NULL,NULL,'p17qfbnjqnira1tt0h5v7tl8uo7',NULL,NULL,'jpg',NULL,'2013-05-13 16:32:39'),(213,'p17qfc9ojmg4lroct7sok01m4r4',NULL,NULL,'p17qfc9ojmg4lroct7sok01m4r4',NULL,NULL,'jpg',NULL,'2013-05-13 16:41:50'),(214,'p17qfc9ojm16gicce17f01m1u1n955',NULL,NULL,'p17qfc9ojm16gicce17f01m1u1n955',NULL,NULL,'jpg',NULL,'2013-05-13 16:41:57'),(215,'p17qfc9ojm19102t63c6en0ums6',NULL,NULL,'p17qfc9ojm19102t63c6en0ums6',NULL,NULL,'jpg',NULL,'2013-05-13 16:42:03'),(216,'p17qfc9ojmhnl1bbg182mfuj1f2d7',NULL,NULL,'p17qfc9ojmhnl1bbg182mfuj1f2d7',NULL,NULL,'jpg',NULL,'2013-05-13 16:42:09'),(217,'p17qfc9ojn14oo1lpbogudhkjsa8',NULL,NULL,'p17qfc9ojn14oo1lpbogudhkjsa8',NULL,NULL,'jpg',NULL,'2013-05-13 16:42:15'),(218,'p17qfc9ojn1d523g6id9tpr1v1c9',NULL,NULL,'p17qfc9ojn1d523g6id9tpr1v1c9',NULL,NULL,'jpg',NULL,'2013-05-13 16:42:21'),(219,'p17qfc9ojn1llp1dtbvr01sqkbbua',NULL,NULL,'p17qfc9ojn1llp1dtbvr01sqkbbua',NULL,NULL,'jpg',NULL,'2013-05-13 16:42:28'),(220,'p17qfc9ojn15101ikq1kvk10rd1pelb',NULL,NULL,'p17qfc9ojn15101ikq1kvk10rd1pelb',NULL,NULL,'jpg',NULL,'2013-05-13 16:42:34'),(221,'p17qfc9ojnedo88o1f0lvk01ck3c',NULL,NULL,'p17qfc9ojnedo88o1f0lvk01ck3c',NULL,NULL,'jpg',NULL,'2013-05-13 16:42:40'),(222,'p17qfc9ojnog5i521v7514uj1ri1d',NULL,NULL,'p17qfc9ojnog5i521v7514uj1ri1d',NULL,NULL,'jpg',NULL,'2013-05-13 16:42:46'),(223,'p17qkfjicc13ehiljn751h5c5ea4',NULL,NULL,'p17qkfjicc13ehiljn751h5c5ea4',NULL,NULL,'png',NULL,'2013-05-15 16:15:47'),(224,'p17r18b6vfc5046e1oug4l1g1h4',NULL,NULL,'p17r18b6vfc5046e1oug4l1g1h4',NULL,NULL,'jpg',NULL,'2013-05-20 15:19:32'),(225,'p17r18b6vg6l41pfq1g6ggf71qvl5',NULL,NULL,'p17r18b6vg6l41pfq1g6ggf71qvl5',NULL,NULL,'jpg',NULL,'2013-05-20 15:19:35'),(226,'p17r18b6vg1np8gj55s2126f1ggn6',NULL,NULL,'p17r18b6vg1np8gj55s2126f1ggn6',NULL,NULL,'jpg',NULL,'2013-05-20 15:19:36');
/*!40000 ALTER TABLE `fotos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fotos_galerias`
--

DROP TABLE IF EXISTS `fotos_galerias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fotos_galerias` (
  `fotoId` int(10) unsigned NOT NULL,
  `galeriaId` int(10) unsigned NOT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `fotoId` (`fotoId`),
  KEY `galeriaId` (`galeriaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fotos_galerias`
--

LOCK TABLES `fotos_galerias` WRITE;
/*!40000 ALTER TABLE `fotos_galerias` DISABLE KEYS */;
INSERT INTO `fotos_galerias` VALUES (7,2,'2013-04-30 16:21:32'),(8,2,'2013-04-30 16:21:32'),(9,2,'2013-04-30 16:21:32'),(10,2,'2013-04-30 16:21:32'),(11,2,'2013-04-30 16:21:32'),(12,2,'2013-04-30 16:21:32'),(13,2,'2013-04-30 16:21:32'),(14,2,'2013-04-30 16:21:32'),(15,2,'2013-04-30 16:21:32'),(16,2,'2013-04-30 16:21:32'),(17,2,'2013-04-30 16:21:32'),(18,2,'2013-04-30 16:21:32'),(19,2,'2013-04-30 16:21:32'),(20,2,'2013-04-30 16:21:33'),(21,2,'2013-04-30 16:21:33'),(22,2,'2013-04-30 16:21:33'),(23,2,'2013-04-30 16:21:33'),(24,2,'2013-04-30 16:21:33'),(25,3,'2013-05-02 23:01:56'),(26,3,'2013-05-02 23:01:56'),(27,3,'2013-05-02 23:01:56'),(28,3,'2013-05-02 23:01:56'),(29,3,'2013-05-02 23:01:56'),(30,3,'2013-05-02 23:01:56'),(31,3,'2013-05-02 23:01:56'),(32,3,'2013-05-02 23:01:57'),(33,3,'2013-05-02 23:01:57'),(34,3,'2013-05-02 23:01:57'),(35,3,'2013-05-02 23:01:57'),(36,3,'2013-05-02 23:01:57'),(37,3,'2013-05-02 23:01:57'),(38,4,'2013-05-02 23:14:08'),(39,4,'2013-05-02 23:14:08'),(40,5,'2013-05-02 23:16:42'),(41,5,'2013-05-02 23:16:42'),(42,5,'2013-05-02 23:16:42'),(43,6,'2013-05-03 22:42:59'),(44,6,'2013-05-03 22:42:59'),(45,6,'2013-05-03 22:42:59'),(46,6,'2013-05-03 22:42:59'),(47,6,'2013-05-03 22:42:59'),(48,6,'2013-05-03 22:42:59'),(49,6,'2013-05-03 22:42:59'),(50,6,'2013-05-03 22:42:59'),(51,6,'2013-05-03 22:42:59'),(52,6,'2013-05-03 22:42:59'),(53,7,'2013-05-03 22:49:50'),(54,7,'2013-05-03 22:49:50'),(55,7,'2013-05-03 22:49:50'),(56,7,'2013-05-03 22:49:50'),(57,7,'2013-05-03 22:49:50'),(58,7,'2013-05-03 22:49:50'),(59,7,'2013-05-03 22:49:50'),(60,7,'2013-05-03 22:49:50'),(61,7,'2013-05-03 22:49:50'),(62,7,'2013-05-03 22:49:50'),(63,7,'2013-05-03 22:49:50'),(64,7,'2013-05-03 22:49:50'),(65,7,'2013-05-03 22:49:51'),(66,7,'2013-05-03 22:49:51'),(67,7,'2013-05-03 22:49:51'),(68,7,'2013-05-03 22:49:51'),(69,7,'2013-05-03 22:49:51'),(70,7,'2013-05-03 22:49:51'),(71,7,'2013-05-03 22:49:51'),(72,7,'2013-05-03 22:49:51'),(73,7,'2013-05-03 22:49:51'),(74,7,'2013-05-03 22:49:51'),(75,7,'2013-05-03 22:49:51'),(76,7,'2013-05-03 22:49:51'),(77,7,'2013-05-03 22:49:51'),(78,7,'2013-05-03 22:49:51'),(79,7,'2013-05-03 22:49:51'),(80,7,'2013-05-03 22:49:51'),(81,7,'2013-05-03 22:49:51'),(82,7,'2013-05-03 22:49:51'),(83,7,'2013-05-03 22:49:51'),(84,7,'2013-05-03 22:49:51'),(85,8,'2013-05-03 22:52:57'),(86,8,'2013-05-03 22:52:57'),(87,8,'2013-05-03 22:52:57'),(88,8,'2013-05-03 22:52:58'),(89,8,'2013-05-03 22:52:58'),(90,8,'2013-05-03 22:52:58'),(91,8,'2013-05-03 22:52:58'),(92,8,'2013-05-03 22:52:58'),(93,8,'2013-05-03 22:52:58'),(94,8,'2013-05-03 22:52:58'),(95,8,'2013-05-03 22:52:58'),(96,9,'2013-05-03 22:54:22'),(97,9,'2013-05-03 22:54:22'),(98,9,'2013-05-03 22:54:22'),(99,9,'2013-05-03 22:54:22'),(100,9,'2013-05-03 22:54:22'),(101,9,'2013-05-03 22:54:22'),(102,9,'2013-05-03 22:54:22'),(112,11,'2013-05-03 23:00:38'),(113,11,'2013-05-03 23:00:38'),(114,11,'2013-05-03 23:00:38'),(115,11,'2013-05-03 23:00:38'),(116,11,'2013-05-03 23:00:38'),(117,11,'2013-05-03 23:00:38'),(118,11,'2013-05-03 23:00:38'),(119,11,'2013-05-03 23:00:38'),(120,11,'2013-05-03 23:00:38'),(121,11,'2013-05-03 23:00:38'),(122,11,'2013-05-03 23:00:38'),(123,11,'2013-05-03 23:00:38'),(124,12,'2013-05-03 23:05:47'),(125,12,'2013-05-03 23:05:47'),(126,12,'2013-05-03 23:05:47'),(127,12,'2013-05-03 23:05:47'),(128,12,'2013-05-03 23:05:47'),(129,12,'2013-05-03 23:05:47'),(130,12,'2013-05-03 23:05:47'),(131,12,'2013-05-03 23:05:47'),(132,12,'2013-05-03 23:05:47'),(133,12,'2013-05-03 23:05:47'),(134,13,'2013-05-03 23:07:50'),(135,13,'2013-05-03 23:07:50'),(136,13,'2013-05-03 23:07:50'),(137,13,'2013-05-03 23:07:50'),(138,13,'2013-05-03 23:07:50'),(139,13,'2013-05-03 23:07:50'),(140,13,'2013-05-03 23:07:50'),(141,13,'2013-05-03 23:07:50'),(142,13,'2013-05-03 23:07:50'),(143,14,'2013-05-03 23:10:57'),(144,14,'2013-05-03 23:10:57'),(145,14,'2013-05-03 23:10:57'),(146,14,'2013-05-03 23:10:57'),(147,14,'2013-05-03 23:10:58'),(148,14,'2013-05-03 23:10:58'),(149,14,'2013-05-03 23:10:58'),(150,14,'2013-05-03 23:10:58'),(151,14,'2013-05-03 23:10:58'),(152,14,'2013-05-03 23:10:58'),(153,14,'2013-05-03 23:10:58'),(154,14,'2013-05-03 23:10:58'),(155,14,'2013-05-03 23:10:58'),(156,14,'2013-05-03 23:10:58'),(157,14,'2013-05-03 23:10:58'),(158,14,'2013-05-03 23:10:58'),(159,14,'2013-05-03 23:10:58'),(160,14,'2013-05-03 23:10:58'),(161,14,'2013-05-03 23:10:58'),(162,14,'2013-05-03 23:10:58'),(163,14,'2013-05-03 23:10:58'),(164,14,'2013-05-03 23:10:58'),(165,14,'2013-05-03 23:10:58'),(166,14,'2013-05-03 23:10:58'),(167,14,'2013-05-03 23:10:58'),(168,15,'2013-05-03 23:14:24'),(169,15,'2013-05-03 23:14:24'),(170,15,'2013-05-03 23:14:24'),(171,15,'2013-05-03 23:14:24'),(172,15,'2013-05-03 23:14:24'),(173,15,'2013-05-03 23:14:24'),(174,15,'2013-05-03 23:14:24'),(175,15,'2013-05-03 23:14:24'),(176,15,'2013-05-03 23:14:24'),(177,15,'2013-05-03 23:14:24'),(178,15,'2013-05-03 23:14:24'),(179,15,'2013-05-03 23:14:24'),(180,15,'2013-05-03 23:14:25'),(181,15,'2013-05-03 23:14:25'),(182,15,'2013-05-03 23:14:25'),(183,15,'2013-05-03 23:14:25'),(184,15,'2013-05-03 23:14:25'),(185,16,'2013-05-03 23:17:49'),(186,16,'2013-05-03 23:17:49'),(187,16,'2013-05-03 23:17:49'),(188,16,'2013-05-03 23:17:49'),(189,16,'2013-05-03 23:17:49'),(190,16,'2013-05-03 23:17:49'),(191,16,'2013-05-03 23:17:49'),(111,1,'2013-05-06 13:22:42'),(110,1,'2013-05-06 13:22:48'),(109,1,'2013-05-06 13:22:49'),(108,1,'2013-05-06 13:22:50'),(107,1,'2013-05-06 13:22:54'),(106,1,'2013-05-06 13:22:57'),(105,1,'2013-05-06 13:22:58'),(104,1,'2013-05-06 13:22:58'),(103,1,'2013-05-06 13:22:59'),(95,1,'2013-05-06 13:26:54'),(101,1,'2013-05-06 13:26:56'),(176,1,'2013-05-06 13:27:12'),(192,20,'2013-05-07 11:51:23'),(193,20,'2013-05-07 11:51:23'),(208,22,'2013-05-13 16:28:41'),(209,22,'2013-05-13 16:28:42'),(207,22,'2013-05-13 16:28:45'),(206,22,'2013-05-13 16:28:47'),(204,22,'2013-05-13 16:28:49'),(205,22,'2013-05-13 16:28:50'),(210,25,'2013-05-13 16:35:43'),(211,25,'2013-05-13 16:35:43'),(212,25,'2013-05-13 16:35:43'),(213,26,'2013-05-13 17:03:18'),(214,26,'2013-05-13 17:03:18'),(215,26,'2013-05-13 17:03:18'),(216,26,'2013-05-13 17:03:18'),(217,26,'2013-05-13 17:03:18'),(218,26,'2013-05-13 17:03:18'),(219,26,'2013-05-13 17:03:18'),(220,26,'2013-05-13 17:03:18'),(221,26,'2013-05-13 17:03:18'),(222,26,'2013-05-13 17:03:18'),(223,28,'2013-05-15 16:16:05'),(224,29,'2013-05-20 15:19:38'),(225,29,'2013-05-20 15:19:38'),(226,29,'2013-05-20 15:19:38');
/*!40000 ALTER TABLE `fotos_galerias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galerias`
--

DROP TABLE IF EXISTS `galerias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galerias` (
  `galeriaId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulo_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ativo` tinyint(1) unsigned DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`galeriaId`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galerias`
--

LOCK TABLES `galerias` WRITE;
/*!40000 ALTER TABLE `galerias` DISABLE KEYS */;
INSERT INTO `galerias` VALUES (1,'Cold Blood',NULL,NULL,NULL,NULL,1,'2013-04-30 15:09:40'),(2,'Itinerantes',NULL,NULL,NULL,NULL,1,'2013-04-30 16:21:32'),(3,'haiti',NULL,NULL,NULL,NULL,NULL,'2013-05-02 23:01:56'),(4,'matÃ©ria al weiwei',NULL,NULL,NULL,NULL,1,'2013-05-02 23:14:08'),(6,'zine atafona',NULL,NULL,NULL,NULL,1,'2013-05-03 22:42:59'),(7,'zine cartas',NULL,NULL,NULL,NULL,1,'2013-05-03 22:49:50'),(8,'zine chelsea',NULL,NULL,NULL,NULL,1,'2013-05-03 22:52:57'),(9,'zine choking victim',NULL,NULL,NULL,NULL,1,'2013-05-03 22:54:22'),(11,'zine cones',NULL,NULL,NULL,NULL,1,'2013-05-03 23:00:38'),(12,'zine extremeloudincrediblyclose',NULL,NULL,NULL,NULL,1,'2013-05-03 23:05:46'),(13,'zine found object lost girl',NULL,NULL,NULL,NULL,1,'2013-05-03 23:07:50'),(14,'zine frederick douglass',NULL,NULL,NULL,NULL,1,'2013-05-03 23:10:57'),(15,'zine labirinto',NULL,NULL,NULL,NULL,1,'2013-05-03 23:14:24'),(16,'zine Library Hoffer',NULL,NULL,NULL,NULL,1,'2013-05-03 23:17:49'),(22,'Atafona',NULL,NULL,NULL,NULL,1,'2013-05-10 01:13:37'),(25,'Grand Central Terminal',NULL,NULL,NULL,NULL,1,'2013-05-13 16:35:43'),(26,'Silvester',NULL,NULL,NULL,NULL,1,'2013-05-13 17:03:18'),(27,NULL,NULL,NULL,NULL,NULL,0,'2013-05-15 16:14:59'),(28,'Borges: The Complete Works/Obras Completas',NULL,NULL,NULL,NULL,1,'2013-05-15 16:16:05'),(29,'marinha',NULL,NULL,NULL,NULL,1,'2013-05-20 15:19:38');
/*!40000 ALTER TABLE `galerias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `logId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usuarioId` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `acao` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `componente` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `objetoId` int(10) unsigned DEFAULT NULL,
  `ativo` tinyint(1) unsigned DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`logId`)
) ENGINE=InnoDB AUTO_INCREMENT=853 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES (597,'admin','1','apagou','fotos',7,0,'2013-04-25 01:31:12'),(598,'admin','1','apagou','fotos',7,0,'2013-04-25 01:31:13'),(599,'admin','1','apagou','fotos',7,0,'2013-04-25 01:31:15'),(600,'admin','1','apagou','fotos',7,0,'2013-04-25 01:31:16'),(601,'admin','1','apagou','fotos',7,0,'2013-04-25 01:31:17'),(602,'admin','1','apagou','fotos',7,0,'2013-04-25 01:31:18'),(603,'admin','1','apagou','fotos',7,0,'2013-04-25 01:31:19'),(604,'admin','1','apagou','fotos',7,0,'2013-04-25 01:31:21'),(605,'admin','1','apagou','fotos',7,0,'2013-04-25 01:31:21'),(606,'admin','1','apagou','fotos',6,0,'2013-04-25 02:25:10'),(607,'admin','1','apagou','fotos',5,0,'2013-04-25 02:25:12'),(608,'admin','1','apagou','fotos',3,0,'2013-04-25 02:25:13'),(609,'admin','1','apagou','fotos',4,0,'2013-04-25 02:25:15'),(610,'admin','1','apagou','fotos',2,0,'2013-04-25 02:25:16'),(611,'admin','1','apagou','fotos',1,0,'2013-04-25 02:25:17'),(612,'admin','1','apagou','fotos',9,0,'2013-04-25 02:39:02'),(613,'admin','1','apagou','fotos',8,0,'2013-04-25 02:39:03'),(614,'admin','1','apagou','fotos',7,0,'2013-04-25 02:39:04'),(615,'admin','1','apagou','fotos',1,0,'2013-04-25 02:45:09'),(616,'admin','1','apagou','fotos',1,0,'2013-04-25 02:45:11'),(617,'admin','1','apagou','fotos',1,0,'2013-04-25 02:45:12'),(618,'admin','1','apagou','fotos',1,0,'2013-04-25 02:45:14'),(619,'admin','1','apagou','fotos',1,0,'2013-04-25 02:45:15'),(620,'admin','1','apagou','fotos',1,0,'2013-04-25 02:45:16'),(621,'admin','1','apagou','fotos',1,0,'2013-04-25 22:39:30'),(622,'admin','1','apagou','fotos',8,0,'2013-04-25 22:39:31'),(623,'admin','1','apagou','fotos',9,0,'2013-04-25 22:39:33'),(624,'admin','1','apagou','fotos',1,0,'2013-04-25 22:39:34'),(625,'admin','1','apagou','fotos',6,0,'2013-04-25 22:39:35'),(626,'admin','1','apagou','fotos',7,0,'2013-04-25 22:39:36'),(627,'admin','1','apagou','fotos',5,0,'2013-04-25 22:39:37'),(628,'admin','1','apagou','fotos',3,0,'2013-04-25 22:39:38'),(629,'admin','1','apagou','fotos',4,0,'2013-04-25 22:39:39'),(630,'admin','1','apagou','fotos',2,0,'2013-04-25 22:39:41'),(631,'admin','1','apagou','fotos',1,0,'2013-04-25 22:39:42'),(632,'admin','1','apagou','fotos',2,0,'2013-04-25 22:42:11'),(633,'admin','1','apagou','fotos',1,0,'2013-04-25 22:42:12'),(634,'admin','1','apagou','fotos',1,0,'2013-04-25 22:42:13'),(635,'admin','1','apagou','fotos',1,0,'2013-04-25 22:42:14'),(636,'admin','1','apagou','fotos',1,0,'2013-04-25 22:42:15'),(637,'admin','1','apagou','fotos',1,0,'2013-04-25 22:42:16'),(638,'admin','1','apagou','fotos',1,0,'2013-04-25 22:42:17'),(639,'admin','1','apagou','fotos',1,0,'2013-04-25 22:42:18'),(640,'admin','1','apagou','fotos',1,0,'2013-04-25 22:42:19'),(641,'admin','1','apagou','galerias',1,0,'2013-04-26 01:36:57'),(642,'admin','1','criou','projeto',NULL,0,'2013-04-30 15:06:06'),(643,'admin','1','salvou','galerias',1,0,'2013-04-30 15:09:54'),(644,'admin','1','ativou','galerias',1,0,'2013-04-30 15:09:57'),(645,'admin','1','criou','projeto',NULL,0,'2013-04-30 15:10:06'),(646,'admin','1','ativou','projetos',2,0,'2013-04-30 15:10:42'),(647,'admin','1','salvou','projetos',2,0,'2013-04-30 15:10:43'),(648,'admin','1','salvou','projetos',2,0,'2013-04-30 15:10:46'),(649,'admin','1','salvou','projetos',2,0,'2013-04-30 15:10:52'),(650,'admin','1','apagou','projetos',1,0,'2013-04-30 15:11:12'),(651,'admin','1','salvou','galerias',2,0,'2013-04-30 16:21:43'),(652,'admin','1','ativou','galerias',2,0,'2013-04-30 16:21:45'),(653,'admin','1','criou','projeto',NULL,0,'2013-04-30 16:21:49'),(654,'admin','1','ativou','projetos',3,0,'2013-04-30 16:22:19'),(655,'admin','1','salvou','projetos',3,0,'2013-04-30 16:22:20'),(656,'admin','1','salvou','galerias',3,0,'2013-05-02 23:03:24'),(657,'admin','1','criou','projeto',NULL,0,'2013-05-02 23:12:16'),(658,'admin','1','salvou','projetos',4,0,'2013-05-02 23:12:49'),(659,'admin','1','ativou','projetos',4,0,'2013-05-02 23:13:21'),(660,'admin','1','salvou','galerias',4,0,'2013-05-02 23:14:30'),(661,'admin','1','ativou','galerias',4,0,'2013-05-02 23:14:31'),(662,'admin','1','criou','projeto',NULL,0,'2013-05-02 23:14:48'),(663,'admin','1','ativou','projetos',5,0,'2013-05-02 23:15:24'),(664,'admin','1','salvou','projetos',5,0,'2013-05-02 23:15:25'),(665,'admin','1','salvou','galerias',5,0,'2013-05-02 23:17:12'),(666,'admin','1','criou','projeto',NULL,0,'2013-05-02 23:17:31'),(667,'admin','1','ativou','projetos',6,0,'2013-05-03 13:33:08'),(668,'admin','1','salvou','projetos',6,0,'2013-05-03 13:33:09'),(669,'admin','1','desativou','projetos',6,0,'2013-05-03 13:34:21'),(670,'admin','1','salvou','projetos',6,0,'2013-05-03 13:34:22'),(671,'admin','1','ativou','projetos',6,0,'2013-05-03 13:34:23'),(672,'admin','1','ativou','galerias',5,0,'2013-05-03 13:38:54'),(673,'admin','1','salvou','galerias',5,0,'2013-05-03 13:39:06'),(674,'admin','1','criou','zine',NULL,0,'2013-05-03 20:18:29'),(675,'admin','1','criou','zine',NULL,0,'2013-05-03 20:44:52'),(676,'admin','1','criou','zine',NULL,0,'2013-05-03 20:45:54'),(677,'admin','1','salvou','zines',4,0,'2013-05-03 22:27:02'),(678,'admin','1','salvou','projetos',6,0,'2013-05-03 22:28:55'),(679,'admin','1','ativou','galerias',6,0,'2013-05-03 22:43:03'),(680,'admin','1','salvou','galerias',6,0,'2013-05-03 22:43:27'),(681,'admin','1','salvou','galerias',6,0,'2013-05-03 22:43:34'),(682,'admin','1','ativou','zines',4,0,'2013-05-03 22:43:40'),(683,'admin','1','salvou','zines',4,0,'2013-05-03 22:44:07'),(684,'admin','1','ativou','galerias',7,0,'2013-05-03 22:50:01'),(685,'admin','1','salvou','galerias',7,0,'2013-05-03 22:50:02'),(686,'admin','1','criou','zine',NULL,0,'2013-05-03 22:50:09'),(687,'admin','1','salvou','zines',5,0,'2013-05-03 22:50:20'),(688,'admin','1','ativou','zines',5,0,'2013-05-03 22:50:21'),(689,'admin','1','salvou','zines',5,0,'2013-05-03 22:50:27'),(690,'admin','1','salvou','galerias',8,0,'2013-05-03 22:53:08'),(691,'admin','1','criou','zine',NULL,0,'2013-05-03 22:53:18'),(692,'admin','1','salvou','zines',6,0,'2013-05-03 22:53:45'),(693,'admin','1','salvou','galerias',9,0,'2013-05-03 22:54:32'),(694,'admin','1','ativou','zines',6,0,'2013-05-03 22:54:41'),(695,'admin','1','criou','zine',NULL,0,'2013-05-03 22:54:42'),(696,'admin','1','ativou','zines',7,0,'2013-05-03 22:54:59'),(697,'admin','1','salvou','zines',7,0,'2013-05-03 22:55:15'),(698,'admin','1','ativou','galerias',10,0,'2013-05-03 22:57:13'),(699,'admin','1','salvou','galerias',1,0,'2013-05-03 22:57:24'),(700,'admin','1','salvou','galerias',1,0,'2013-05-03 23:00:44'),(701,'admin','1','ativou','galerias',11,0,'2013-05-03 23:00:45'),(702,'admin','1','criou','zine',NULL,0,'2013-05-03 23:00:50'),(703,'admin','1','ativou','zines',8,0,'2013-05-03 23:00:57'),(704,'admin','1','salvou','zines',8,0,'2013-05-03 23:00:58'),(705,'admin','1','criou','zine',NULL,0,'2013-05-03 23:01:13'),(706,'admin','1','ativou','zines',9,0,'2013-05-03 23:01:25'),(707,'admin','1','salvou','zines',9,0,'2013-05-03 23:01:26'),(708,'admin','1','salvou','galerias',1,0,'2013-05-03 23:06:15'),(709,'admin','1','ativou','galerias',12,0,'2013-05-03 23:06:15'),(710,'admin','1','criou','zine',NULL,0,'2013-05-03 23:06:22'),(711,'admin','1','ativou','zines',10,0,'2013-05-03 23:06:29'),(712,'admin','1','salvou','zines',1,0,'2013-05-03 23:06:30'),(713,'admin','1','ativou','galerias',13,0,'2013-05-03 23:08:19'),(714,'admin','1','salvou','galerias',1,0,'2013-05-03 23:08:20'),(715,'admin','1','criou','zine',NULL,0,'2013-05-03 23:08:28'),(716,'admin','1','ativou','zines',11,0,'2013-05-03 23:08:49'),(717,'admin','1','salvou','zines',1,0,'2013-05-03 23:08:50'),(718,'admin','1','ativou','galerias',14,0,'2013-05-03 23:11:19'),(719,'admin','1','salvou','galerias',1,0,'2013-05-03 23:11:20'),(720,'admin','1','criou','zine',NULL,0,'2013-05-03 23:11:36'),(721,'admin','1','salvou','zines',1,0,'2013-05-03 23:11:48'),(722,'admin','1','ativou','zines',12,0,'2013-05-03 23:11:49'),(723,'admin','1','salvou','galerias',1,0,'2013-05-03 23:14:33'),(724,'admin','1','ativou','galerias',15,0,'2013-05-03 23:14:34'),(725,'admin','1','criou','zine',NULL,0,'2013-05-03 23:14:39'),(726,'admin','1','ativou','zines',13,0,'2013-05-03 23:14:53'),(727,'admin','1','salvou','zines',1,0,'2013-05-03 23:14:55'),(728,'admin','1','criou','zine',NULL,0,'2013-05-03 23:15:06'),(729,'admin','1','apagou','zines',1,0,'2013-05-03 23:15:10'),(730,'admin','1','ativou','galerias',16,0,'2013-05-03 23:17:59'),(731,'admin','1','salvou','galerias',1,0,'2013-05-03 23:18:00'),(732,'admin','1','salvou','galerias',1,0,'2013-05-03 23:18:34'),(733,'admin','1','criou','zine',NULL,0,'2013-05-03 23:18:39'),(734,'admin','1','salvou','zines',1,0,'2013-05-03 23:18:53'),(735,'admin','1','ativou','zines',15,0,'2013-05-03 23:18:54'),(736,'admin','1','salvou','zines',1,0,'2013-05-03 23:23:17'),(737,'admin','1','salvou','projetos',6,0,'2013-05-06 13:02:34'),(738,'admin','1','salvou','projetos',6,0,'2013-05-06 13:02:54'),(739,'admin','1','salvou','projetos',6,0,'2013-05-06 13:03:16'),(740,'admin','1','salvou','projetos',3,0,'2013-05-06 13:14:27'),(741,'admin','1','salvou','projetos',3,0,'2013-05-06 13:14:38'),(742,'admin','1','salvou','projetos',3,0,'2013-05-06 13:14:57'),(743,'admin','1','criou','blog',NULL,0,'2013-05-06 13:15:11'),(744,'admin','1','salvou','blog',1,0,'2013-05-06 13:16:31'),(745,'admin','1','salvou','galerias',1,0,'2013-05-06 13:18:54'),(746,'admin','1','salvou','galerias',1,0,'2013-05-06 13:19:57'),(747,'admin','1','salvou','galerias',1,0,'2013-05-06 13:20:52'),(748,'admin','1','salvou','galerias',1,0,'2013-05-06 13:21:04'),(749,'admin','1','salvou','galerias',1,0,'2013-05-06 13:21:32'),(750,'admin','1','salvou','galerias',1,0,'2013-05-06 13:21:44'),(751,'admin','1','apagou','galerias',1,0,'2013-05-06 13:22:06'),(752,'admin','1','criou','galerias',17,0,'2013-05-06 13:22:14'),(753,'admin','1','salvou','galerias',1,0,'2013-05-06 13:23:10'),(754,'admin','1','salvou','zines',9,0,'2013-05-06 13:23:47'),(755,'admin','1','salvou','zines',9,0,'2013-05-06 13:23:57'),(756,'admin','1','salvou','zines',9,0,'2013-05-06 13:24:00'),(757,'admin','1','criou','galerias',18,0,'2013-05-06 13:26:36'),(758,'admin','1','criou','galerias',19,0,'2013-05-06 13:26:49'),(759,'admin','1','apagou','projetos',2,0,'2013-05-06 13:27:46'),(760,'admin','1','criou','projeto',NULL,0,'2013-05-06 13:30:43'),(761,'admin','1','apagou','galerias',1,0,'2013-05-06 13:30:58'),(762,'admin','1','apagou','galerias',1,0,'2013-05-06 13:30:59'),(763,'admin','1','salvou','blog',1,0,'2013-05-06 13:49:44'),(764,'admin','1','apagou','galerias',2,0,'2013-05-07 11:51:33'),(765,'admin','1','apagou','galerias',1,0,'2013-05-07 11:51:47'),(766,'admin','1','apagou','projetos',7,0,'2013-05-07 12:00:45'),(767,'admin','1','apagou','galerias',5,0,'2013-05-08 22:37:24'),(768,'admin','1','ativou','galerias',8,0,'2013-05-08 22:37:55'),(769,'admin','1','ativou','galerias',9,0,'2013-05-08 22:37:57'),(770,'admin','1','ativou','galerias',21,0,'2013-05-08 22:42:21'),(771,'admin','1','salvou','galerias',2,0,'2013-05-08 22:42:22'),(772,'admin','1','salvou','projetos',6,0,'2013-05-08 22:43:00'),(773,'admin','1','salvou','projetos',6,0,'2013-05-08 22:44:08'),(774,'admin','1','criou','config',NULL,0,'2013-05-09 15:29:54'),(775,'admin','1','salvou','config',1,0,'2013-05-09 15:30:16'),(776,'admin','1','ativou','config',13,0,'2013-05-09 15:30:17'),(777,'admin','1','salvou','galerias',2,0,'2013-05-10 01:14:48'),(778,'admin','1','ativou','galerias',22,0,'2013-05-10 01:15:08'),(779,'admin','1','criou','projeto',NULL,0,'2013-05-10 01:15:16'),(780,'admin','1','salvou','projetos',8,0,'2013-05-10 01:15:49'),(781,'admin','1','salvou','projetos',8,0,'2013-05-10 01:16:23'),(782,'admin','1','apagou','fotos',2,0,'2013-05-13 15:38:50'),(783,'admin','1','apagou','fotos',6,0,'2013-05-13 15:39:28'),(784,'admin','1','apagou','fotos',5,0,'2013-05-13 15:39:30'),(785,'admin','1','apagou','fotos',4,0,'2013-05-13 15:39:31'),(786,'admin','1','apagou','fotos',3,0,'2013-05-13 15:39:32'),(787,'admin','1','apagou','fotos',2,0,'2013-05-13 15:39:33'),(788,'admin','1','apagou','fotos',1,0,'2013-05-13 15:39:34'),(789,'admin','1','apagou','fotos',2,0,'2013-05-13 16:09:40'),(790,'admin','1','apagou','fotos',2,0,'2013-05-13 16:09:41'),(791,'admin','1','apagou','fotos',2,0,'2013-05-13 16:09:42'),(792,'admin','1','apagou','fotos',1,0,'2013-05-13 16:09:43'),(793,'admin','1','apagou','fotos',1,0,'2013-05-13 16:09:43'),(794,'admin','1','apagou','fotos',1,0,'2013-05-13 16:09:44'),(795,'admin','1','salvou','galerias',2,0,'2013-05-13 16:22:08'),(796,'admin','1','salvou','projetos',8,0,'2013-05-13 16:22:40'),(797,'admin','1','apagou','galerias',2,0,'2013-05-13 16:23:46'),(798,'admin','1','ativou','galerias',24,0,'2013-05-13 16:23:51'),(799,'admin','1','salvou','projetos',8,0,'2013-05-13 16:24:01'),(800,'admin','1','salvou','galerias',2,0,'2013-05-13 16:27:40'),(801,'admin','1','salvou','galerias',2,0,'2013-05-13 16:27:54'),(802,'admin','1','salvou','galerias',2,0,'2013-05-13 16:28:01'),(803,'admin','1','salvou','galerias',2,0,'2013-05-13 16:28:17'),(804,'admin','1','salvou','galerias',2,0,'2013-05-13 16:28:30'),(805,'admin','1','salvou','galerias',2,0,'2013-05-13 16:28:51'),(806,'admin','1','apagou','galerias',2,0,'2013-05-13 16:28:58'),(807,'admin','1','criou','projeto',NULL,0,'2013-05-13 16:29:10'),(808,'admin','1','apagou','projetos',9,0,'2013-05-13 16:29:33'),(809,'admin','1','ativou','projetos',8,0,'2013-05-13 16:29:34'),(810,'admin','1','salvou','projetos',8,0,'2013-05-13 16:29:41'),(811,'admin','1','salvou','galerias',2,0,'2013-05-13 16:36:11'),(812,'admin','1','apagou','galerias',2,0,'2013-05-13 16:36:23'),(813,'admin','1','apagou','fotos',1,0,'2013-05-13 16:36:38'),(814,'admin','1','apagou','fotos',1,0,'2013-05-13 16:36:40'),(815,'admin','1','apagou','fotos',1,0,'2013-05-13 16:36:41'),(816,'admin','1','ativou','galerias',25,0,'2013-05-13 16:37:03'),(817,'admin','1','salvou','galerias',2,0,'2013-05-13 16:37:16'),(818,'admin','1','salvou','galerias',2,0,'2013-05-13 16:37:19'),(819,'admin','1','salvou','projetos',6,0,'2013-05-13 16:37:32'),(820,'admin','1','salvou','galerias',2,0,'2013-05-13 17:04:42'),(821,'admin','1','ativou','galerias',26,0,'2013-05-13 17:04:44'),(822,'admin','1','salvou','galerias',2,0,'2013-05-13 17:04:44'),(823,'admin','1','salvou','galerias',2,0,'2013-05-13 17:04:51'),(824,'admin','1','criou','projeto',NULL,0,'2013-05-13 17:04:58'),(825,'admin','1','ativou','projetos',10,0,'2013-05-13 17:05:12'),(826,'admin','1','salvou','projetos',1,0,'2013-05-13 17:05:13'),(827,'admin','1','salvou','projetos',1,0,'2013-05-13 17:05:23'),(828,'admin','1','salvou','projetos',5,0,'2013-05-14 14:16:28'),(829,'admin','1','salvou','projetos',5,0,'2013-05-14 14:16:34'),(830,'admin','1','criou','projeto',NULL,0,'2013-05-15 16:10:51'),(831,'admin','1','salvou','projetos',1,0,'2013-05-15 16:11:19'),(832,'admin','1','ativou','projetos',11,0,'2013-05-15 16:11:39'),(833,'admin','1','salvou','projetos',1,0,'2013-05-15 16:13:36'),(834,'admin','1','salvou','projetos',1,0,'2013-05-15 16:14:27'),(835,'admin','1','salvou','projetos',1,0,'2013-05-15 16:14:34'),(836,'admin','1','criou','galerias',27,0,'2013-05-15 16:14:59'),(837,'admin','1','ativou','galerias',28,0,'2013-05-15 16:16:28'),(838,'admin','1','salvou','galerias',2,0,'2013-05-15 16:16:28'),(839,'admin','1','salvou','projetos',1,0,'2013-05-15 16:17:20'),(840,'admin','1','salvou','projetos',1,0,'2013-05-15 16:18:46'),(841,'admin','1','salvou','projetos',1,0,'2013-05-15 16:19:02'),(842,'admin','1','salvou','projetos',1,0,'2013-05-15 16:19:23'),(843,'admin','1','ativou','galerias',29,0,'2013-05-20 15:19:48'),(844,'admin','1','salvou','galerias',2,0,'2013-05-20 15:19:49'),(845,'admin','1','criou','projeto',NULL,0,'2013-05-20 15:19:56'),(846,'admin','1','salvou','projetos',1,0,'2013-05-20 15:20:47'),(847,'admin','1','salvou','projetos',1,0,'2013-05-20 15:20:50'),(848,'admin','1','ativou','projetos',12,0,'2013-05-20 15:20:54'),(849,'admin','1','criou','config',NULL,0,'2013-05-20 15:52:46'),(850,'admin','1','salvou','config',1,0,'2013-05-20 15:53:29'),(851,'admin','1','ativou','config',14,0,'2013-05-20 15:53:40'),(852,'admin','1','salvou','config',1,0,'2013-05-20 15:54:04');
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paginas`
--

DROP TABLE IF EXISTS `paginas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paginas` (
  `paginaId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulo_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitulo_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `corpo` text COLLATE utf8_unicode_ci,
  `corpo_en` text COLLATE utf8_unicode_ci,
  `fotoId` int(10) unsigned DEFAULT NULL,
  `galeriaId` int(10) unsigned DEFAULT NULL,
  `ativo` tinyint(1) unsigned DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`paginaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paginas`
--

LOCK TABLES `paginas` WRITE;
/*!40000 ALTER TABLE `paginas` DISABLE KEYS */;
/*!40000 ALTER TABLE `paginas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `postId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `corpo` text COLLATE utf8_unicode_ci,
  `destaque` tinyint(1) unsigned DEFAULT NULL,
  `ativo` tinyint(1) unsigned DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`postId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'site em obras ',NULL,'!@#$%^&amp;*()<br><br><br><br>work in progress<br><br><br>',NULL,0,'2013-05-06 13:15:11');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projetos`
--

DROP TABLE IF EXISTS `projetos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projetos` (
  `projetoId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulo_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `corpo` text COLLATE utf8_unicode_ci,
  `corpo_en` text COLLATE utf8_unicode_ci,
  `fotoId` int(10) unsigned DEFAULT NULL,
  `galeriaId` int(10) unsigned DEFAULT NULL,
  `pdfUrl` int(10) unsigned DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ativo` tinyint(1) unsigned DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`projetoId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projetos`
--

LOCK TABLES `projetos` WRITE;
/*!40000 ALTER TABLE `projetos` DISABLE KEYS */;
INSERT INTO `projetos` VALUES (3,'Itinerantes','Itinerants',NULL,'','','site os obras','text in english<br>testing...',NULL,2,NULL,'fotografia',1,'2013-04-30 16:21:49'),(4,'Haiti','Haiti',NULL,NULL,NULL,'texto pt','text en',NULL,3,NULL,'reportagem',1,'2013-05-02 23:12:15'),(5,'Ai Wei Wei','Ai Wei Wei',NULL,'','','text pt','text en<br>',NULL,4,NULL,'reportagem',1,'2013-05-02 23:14:48'),(6,'GCT','GCT',NULL,'teste (em construÃ§Ã£o)','testing new site','teste<br>texto<br>text<br>test','text<br>test',NULL,25,NULL,'instalacao',1,'2013-05-02 23:17:31'),(8,'Atafona','',NULL,'teste','','Teste kjzs udvnso psv psvj doivoias <br>.<br>.<br>.<br>','',NULL,22,NULL,'foto',1,'2013-05-10 01:15:16'),(10,'Silvestre','Silvester',NULL,'','','','',NULL,26,NULL,'foto',1,'2013-05-13 17:04:58'),(11,'Borges: Obras Completas','Borges: The Complete Works',NULL,'borgeslibrary.com','borgeslibrary.com','<a rel=\"nofollow\" target=\"_blank\" href=\"http://borgeslibrary.com\">borgeslibrary.com</a><br>','<a rel=\"nofollow\" target=\"_blank\" href=\"http://borgeslibrary.com\">borgeslibrary.com</a><br>',NULL,28,NULL,'multimidia',1,'2013-05-15 16:10:51'),(12,'marinha','',NULL,'teste','','','',NULL,29,NULL,'video',1,'2013-05-20 15:19:56');
/*!40000 ALTER TABLE `projetos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `usuarioId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `senha` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` int(10) unsigned NOT NULL,
  `ativo` tinyint(1) unsigned DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`usuarioId`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'admin','Pedro Koblitz','pedrokoblitz@gmail.com','81dc9bdb52d04dc20036dbd8313ed055',3,1,'2012-01-18 15:50:19'),(2,'rony','Rony Maltz','r_maltz@yahoo.com','81dc9bdb52d04dc20036dbd8313ed055',3,1,'2012-01-12 13:50:19');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;



--
-- Table structure for table `blocos`
--

DROP TABLE IF EXISTS `blocos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blocos` (
  `blocoId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulo_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `corpo` text COLLATE utf8_unicode_ci,
  `corpo_en` text COLLATE utf8_unicode_ci,
  `area` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ativo` tinyint(1) unsigned DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`blocoId`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blocos`
--

LOCK TABLES `blocos` WRITE;
/*!40000 ALTER TABLE `blocos` DISABLE KEYS */;
/*!40000 ALTER TABLE `blocos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;


--
-- Table structure for table `zines`
--

DROP TABLE IF EXISTS `zines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zines` (
  `zineId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulo_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `corpo` text COLLATE utf8_unicode_ci,
  `corpo_en` text COLLATE utf8_unicode_ci,
  `fotoId` int(10) unsigned DEFAULT NULL,
  `galeriaId` int(10) unsigned DEFAULT NULL,
  `pdfUrl` int(10) unsigned DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ativo` tinyint(1) unsigned DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`zineId`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zines`
--

LOCK TABLES `zines` WRITE;
/*!40000 ALTER TABLE `zines` DISABLE KEYS */;
INSERT INTO `zines` VALUES (4,'Atafona','Atafona','','',NULL,'texto pt','texto en',NULL,6,NULL,NULL,1,'2013-05-03 20:45:53'),(5,'Cartas','Letters','','',NULL,'','',NULL,7,NULL,NULL,1,'2013-05-03 22:50:08'),(6,'Chelsea','Chelsea','','',NULL,'texto pt','text en',NULL,8,NULL,NULL,1,'2013-05-03 22:53:17'),(7,'Choking Victim','Choking Victim','','',NULL,'text pt','text en',NULL,9,NULL,NULL,1,'2013-05-03 22:54:42'),(8,'Cones','','','',NULL,'','',NULL,11,NULL,NULL,1,'2013-05-03 23:00:50'),(9,'Sangue Frio','Cold Blood','','',NULL,'','',NULL,1,NULL,NULL,1,'2013-05-03 23:01:13'),(10,'extremeloudincrediblyclose','extremeloudincrediblyclose','','',NULL,'','',NULL,12,NULL,NULL,1,'2013-05-03 23:06:22'),(11,'found object lost girl','found object lost girl','','',NULL,'','',NULL,13,NULL,NULL,1,'2013-05-03 23:08:28'),(12,'frederick douglass','frederick douglass','','',NULL,'','',NULL,14,NULL,NULL,1,'2013-05-03 23:11:36'),(13,'Labirinto','Labirynth','','',NULL,'','',NULL,15,NULL,NULL,1,'2013-05-03 23:14:39'),(15,'Library Hoffer','Library Hoffer','','',NULL,'','',NULL,16,NULL,NULL,1,'2013-05-03 23:18:39');
/*!40000 ALTER TABLE `zines` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-05-21  5:12:48
