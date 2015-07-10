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

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` BLOB,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `action` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_id` int(10) unsigned DEFAULT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `language` varchar(5) COLLATE utf8_unicode_ci DEFAULT "pt-br",
  `item_name` enum('content', 'resource', 'collection', 'term', 'block', 'content_type', 'resource_type', 'collection_type', 'term_type') COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `slug` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `excerpt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` BLOB,
  `body` BLOB,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


-- BEGIN USERS

--
-- Table structure for table `users`
--

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
  `token` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `users_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_roles` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

-- trigger para insert user
INSERT INTO tokens (type, token, ip, user_id, created) VALUES ('register', token, ip, LAST_INSERT_ID(), NOW());

SELECT user_id FROM tokens WHERE token=token AND user_id=user_id AND activity=1;
UPDATE users SET activity=1 WHERE id=user_id;
UPDATE tokens SET activity=0, used=NOW() WHERE token=token AND user_id=user_id;

-- permission
-- :username users.username
-- :name roles.name

-- add role
INSERT INTO users_roles (user_id, role_id) 
  VALUES (
    (
      SELECT id FROM users 
        WHERE username=:username
    ), 
    (
      SELECT id FROM roles 
        WHERE name=:name
    )
  );

-- delete role
DELETE FROM users_roles 
  WHERE user_id=
    (
      SELECT id FROM users 
        WHERE username=:username
    )
  AND role_id=
    (
      SELECT id FROM roles 
        WHERE name=:name
    );

-- has permission?
SELECT t1.id FROM users t1
  LEFT JOIN users_roles t2
  ON t1.id=t2.user_id
  LEFT JOIN roles t3
  ON t2.role_id=t3.id
  WHERE t3.name=:name 
  AND t1.id=:id;



--
-- Table structure for table `tokens`
--

DROP TABLE IF EXISTS `tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tokens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `ip` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1,
  `created` datetime NOT NULL,
  `used` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;



-- END USERS

-- BEGIN ATTRIBUTES

--
-- Table structure for table `collections`
--

DROP TABLE IF EXISTS `collections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `collections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `collection_types`
--

DROP TABLE IF EXISTS `collection_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `collection_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;



DROP TABLE IF EXISTS `items_collections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items_collections` (
  `item_name` enum('content', 'resource', 'term') COLLATE utf8_unicode_ci NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `collection_id` int(10) unsigned NOT NULL,
  `order` int(10) unsigned NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

INSERT INTO items_collections (item_name, item_id, collection_id) VALUES ('term', 1, 1, 1);
INSERT INTO items_collections (item_name, item_id, collection_id) VALUES ('term', 2, 1, 2);

INSERT INTO items_collections (item_name, item_id, collection_id) VALUES ('resource', 1, 2, 1);
INSERT INTO items_collections (item_name, item_id, collection_id) VALUES ('resource', 2, 2, 2);



--
-- Table structure for table `term`
--

DROP TABLE IF EXISTS `terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `terms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT 0,
  `term_type_id` int(10) unsigned NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `term_types`
--

DROP TABLE IF EXISTS `term_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `term_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

-- END ATTRIBUTES
-- BEGIN SITE BUILDING

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `areas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `blocks`
--

DROP TABLE IF EXISTS `blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `area_id` int(10) unsigned NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

-- END SITE BUILDING

-- BEGIN CONTENT

--
-- Table structure for table `contents`
--

DROP TABLE IF EXISTS `contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content_type_id` int(10) unsigned NOT NULL,
  `date_pub` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contents`
--

DROP TABLE IF EXISTS `content_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `resources`
--

DROP TABLE IF EXISTS `resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `filename` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extension` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `resource_types`
--

DROP TABLE IF EXISTS `resource_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resource_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

-- END CONTENT

-- avaiable translations
SELECT item_id, language, slug, name, title FROM translations WHERE item_name=:type AND item_id=:id;

-- update activity
UPDATE $table SET activity=:activity;
UPDATE $table SET modified=NOW();

SELECT * FROM translations
  WHERE item_id IN (
    SELECT id FROM contents ORDER BY modified DESC LIMIT :offset, :num;
  )
  AND item_name="content";


-- select by slug
SELECT t1.* FROM translations t1
  LEFT JOIN contents t2
    ON t1.item_id=t2.id
  WHERE slug=:slug 
    -- OR WHERE t1.item_id=:id 
    AND t1.item_name = 'content'
    AND t1.language=:lang
    AND t2.activity > 0;

SELECT t1.* FROM translations t1
  LEFT JOIN resources t2
    ON t1.item_id=t2.id
    AND t1.item_name = 'resource'
  WHERE t1.slug=:slug 
    AND t1.language=:lang
    AND t2.activity > 0;

SELECT t1.* FROM translations t1
  LEFT JOIN collections t2
    ON t1.item_id=t2.id
  WHERE t1.slug=:slug 
    AND t1.item_name = 'collection'
    AND t1.language=:lang
    AND t2.activity > 0;


-- select by id
SELECT t1.title, t1.slug FROM translations t1
  LEFT JOIN terms t2
    ON t1.item_id=t2.id
  WHERE t1.item_id=:id 
    AND t1.item_name = 'term'
    AND t1.language=:lang
    AND t2.activity > 0;

-- select many
SELECT t1.* FROM translations t1
  LEFT JOIN contents t2
    ON t1.item_id=t2.id
    AND t1.item_name = 'content'
  LEFT JOIN content_types t3
    ON t2.content_type_id=t3.id
  WHERE t1.language=:lang
    AND t3.name=:type
    AND t2.activity > 0
  ORDER BY t2.modified
  LIMIT :offset,:num;

CREATE PROCEDURE `insert_content`(
  IN user_id INT,
  IN lang VARCHAR
)
BEGIN
  INSERT INTO log ()
    VALUES ();
END$$

CREATE PROCEDURE `update_content`(
  IN id INT,
  IN user_id INT,
  IN lang VARCHAR,
  IN slug VARCHAR,
  IN name VARCHAR,
  IN title VARCHAR,
  IN subtitle VARCHAR,
  IN excerpt VARCHAR,
  IN description TEXT,
  IN body TEXT,
  IN album_id INT,
  IN document_id INT,
  IN cover_id INT
)
BEGIN
  UPDATE contents SET 
    modified=NOW() 
    album_id=album_id, 
    document_id=document_id, 
    cover_id=cover_id
    WHERE id=id;
  UPDATE translations SET 
    user_id=user_id, 
    lang=lang, 
    slug=slug, 
    name=name, 
    title=title, 
    subtitle=subtitle,
    excerpt=excerpt,
    description=description,
    body=body
    WHERE item_id=id AND item_name="content";
  INSERT INTO log ()
    VALUES ();
END$$

CREATE PROCEDURE `insert_collection`(
  IN user_id INT,
  IN lang VARCHAR
)
BEGIN
  INSERT INTO log ()
    VALUES ();
END$$

CREATE PROCEDURE `update_collection`(
  IN id INT,
  IN user_id INT,
  IN lang VARCHAR,
  IN slug VARCHAR,
  IN name VARCHAR,
  IN title VARCHAR,
  IN description TEXT,
)
BEGIN
  UPDATE collections SET 
    modified=NOW()
    WHERE id=:id;
  UPDATE translations SET 
    user_id=user_id, 
    lang=lang, 
    slug=slug, 
    name=name, 
    title=title, 
    description=description,
    WHERE item_id=id AND item_name="collection";
  INSERT INTO log ()
    VALUES ();
END$$

CREATE PROCEDURE `insert_resource`(
  IN user_id INT,
  IN lang VARCHAR
)
BEGIN
  INSERT INTO log ()
    VALUES ();
END$$

CREATE PROCEDURE `update_resource`(
  IN id INT,
  IN user_id INT,
  IN lang VARCHAR,
  IN url VARCHAR,
  IN slug VARCHAR,
  IN filename VARCHAR,
  IN extension VARCHAR,
  IN name VARCHAR,
  IN title VARCHAR,
  IN description TEXT,
)
BEGIN
  UPDATE resources SET 
    modified=NOW() 
    WHERE id=:id;
  UPDATE translations SET 
    user_id=user_id, 
    lang=lang, 
    slug=slug, 
    url=url, 
    extension=extension, 
    filename=filename, 
    name=name, 
    title=title, 
    description=description,
    WHERE item_id=id AND item_name="resource";
  INSERT INTO log ()
    VALUES ();
END$$

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-05-12  8:03:38
