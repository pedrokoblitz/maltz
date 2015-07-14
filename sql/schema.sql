-- MySQL dump 10.13  Distrib 5.5.43, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: maltz
-- ------------------------------------------------------
-- Server version 5.5.43-0ubuntu0.14.10.1

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



-- id, name, item_name
-- t.id, t.name

DROP TABLE IF EXISTS `types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

DROP TABLE IF EXISTS `metadata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `metadata` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_name` enum('content', 'resource') COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `key` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` BLOB DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`item_name`, `item_id`, `key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


-- item_name, item_id, group_name, group_id, order
DROP TABLE IF EXISTS `items_groups_relationships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items_groups_relationships` (
  `group_name` enum('content', 'collection') COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `item_name` enum('content', 'collection', 'resource', 'term') COLLATE utf8_unicode_ci NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `order` int(10) unsigned NOT NULL,
  UNIQUE(`group_name`, `group_id`, `item_name`, `item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `config`
--

-- id, key, value, activity, modified, created
-- t.id, t.key, t.value, t.activity, t.modified, t.created

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` BLOB,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `log`
--

-- id, user, user_id, action, item_name, item_id, created
-- t.id, t.user, t.user_id, t.action, t.item_name, t.item_id, t.created

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `action` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_id` int(10) unsigned DEFAULT NULL,
  `item_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_id` int(10) unsigned DEFAULT NULL,
  `created` datetime NOT NULL,
  `used` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `translations`
--

-- id, user_id, language, item_name, item_id, slug, name, title, subtitle, excerpt, description, body
-- t.id, t.user_id, t.language, t.item_name, t.item_id, t.slug, t.name, t.title, t.subtitle, t.excerpt, t.description, t.body

DROP TABLE IF EXISTS `translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `language` varchar(5) COLLATE utf8_unicode_ci DEFAULT "pt-br",
  `item_name` enum('content', 'resource', 'collection', 'term', 'block') COLLATE utf8_unicode_ci NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `slug` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `excerpt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` BLOB,
  `body` BLOB,
  PRIMARY KEY (`id`),
  UNIQUE(`language`,`item_name`,`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


-- BEGIN USERS

--
-- Table structure for table `users`
--

-- id, username, name, email, cpf, cnpj, cellphone, phone, zipcode, address, address2, district, city, province, password, activity, created
-- t.id, t.username, t.name, t.email, t.cpf, t.cnpj, t.cellphone, t.phone, t.zipcode, t.address, t.address2, t.district, t.city, t.province, t.password, t.activity, t.created

-- activity

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cpf` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cnpj` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cellphone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zipcode` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `district` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `province` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`email`),
  UNIQUE(`cpf`),
  UNIQUE(`cnpj`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `roles`
--

-- id, name, activity
-- t.id, t.name, t.activity

-- activity

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20),
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE(`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `roles`
--

-- user_id, role_id

DROP TABLE IF EXISTS `users_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_roles` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `tokens`
--

-- id, user_id, ip, token, type, activity, created, used
-- t.id, t.user_id, t.ip, t.token, t.type, t.activity, t.created, t.used

DROP TABLE IF EXISTS `tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tokens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `ip` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `used` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

-- END USERS


-- BEGIN CONTENT

--
-- Table structure for table `contents`
--

-- id, content_type_id, activity, date_pub, modified, created
-- t.id, t.content_type_id, t.activity, t.date_pub, t.modified, t.created

-- activity, translatable

DROP TABLE IF EXISTS `contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1,
  `date_pub` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `resources`
--

-- id, resource_type_id, url, path, filename, extension, activity, modified, created
-- t.id, t.resource_type_id, t.url, t.path, t.filename, t.extension, t.activity, t.modified, t.created

-- activity, translatable

DROP TABLE IF EXISTS `resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL,
  `url` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `filepath` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `filename` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extension` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `embed` tinyblob DEFAULT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

-- END CONTENT

-- BEGIN ATTRIBUTES

--
-- Table structure for table `collections`
--

-- id, activity, modified, created
-- t.id, t.activity, t.modified, t.created

-- activity, translatable

DROP TABLE IF EXISTS `collections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `collections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(10) unsigned NOT NULL DEFAULT 0,
  `type_id` int(10) unsigned NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;



--
-- Table structure for table `term`
--

-- id, parent_id, term_type_id, activity
-- t.id, t.parent_id, t.term_type_id, t.activity

-- activity, translatable

DROP TABLE IF EXISTS `terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `terms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(10) unsigned NOT NULL DEFAULT 0,
  `type_id` int(10) unsigned NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


-- END ATTRIBUTES
-- BEGIN SITE BUILDING

--
-- Table structure for table `areas`
--

-- id, name, activity
-- t.id, t.name, t.activity

-- activity, translatable

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `areas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE(`name`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `blocks`
--

-- id, area_id, activity
-- t.id, t.area_id

-- activity, translatable

DROP TABLE IF EXISTS `blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `area_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


-- END SITE BUILDING




DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` tinyblob NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `folksonomy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `folksonomy` (
  `term_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `item_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_id` int(10) unsigned DEFAULT NULL,
  UNIQUE(`term_id`,`user_id`,`item_name`,`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-05-12  8:03:38
