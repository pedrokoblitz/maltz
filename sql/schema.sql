-- SYS
DROP TABLE IF EXISTS `types`;
CREATE TABLE `types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `metadata`;
CREATE TABLE `metadata` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_name` enum('content', 'resource') COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `key` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` BLOB DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`item_name`, `item_id`, `key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `attachments`;
CREATE TABLE `attachments` (
  `group_name` enum('content', 'collection') COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `item_name` enum('content', 'collection', 'resource', 'term') COLLATE utf8_unicode_ci NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `order` int(10) unsigned NOT NULL,
  UNIQUE(`group_name`, `group_id`, `item_name`, `item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` BLOB,
  `format` tinyint(1) unsigned NOT NULL DEFAULT 1,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = active, 1 = autoload, 2 = package specific, 3 = ...
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `group_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_id` int(10) unsigned DEFAULT NULL,
  `action` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_id` int(10) unsigned DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- END SYS

-- BEGIN USERS
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,  -- should be null or not?
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
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
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = inactive, 1 = active
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`username`),
  UNIQUE(`email`),
  UNIQUE(`cpf`),
  UNIQUE(`cnpj`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20),
  PRIMARY KEY (`id`),
  UNIQUE(`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `users_roles`;
CREATE TABLE `users_roles` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `tokens`;
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
-- END USERS

-- BEGIN CONTENT
DROP TABLE IF EXISTS `translations`;
CREATE TABLE `translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `language` varchar(5) COLLATE utf8_unicode_ci DEFAULT "pt-br",
  `item_name` enum('content', 'resource', 'collection', 'term', 'block','type') COLLATE utf8_unicode_ci NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `slug` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `excerpt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` BLOB,
  `body` MEDIUMBLOB,
  PRIMARY KEY (`id`),
  UNIQUE(`language`,`item_name`,`item_id`),
  UNIQUE(`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `contents`;
CREATE TABLE `contents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = trash, 1 = ...
  `date_pub` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `resources`;
CREATE TABLE `resources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL,
  `url` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `filepath` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `filename` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extension` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `embed` BLOB DEFAULT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = trash, 1 = ...
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- END CONTENT

-- BEGIN ATTRIBUTES
DROP TABLE IF EXISTS `collections`;
CREATE TABLE `collections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(10) unsigned NOT NULL DEFAULT 0,
  `type_id` int(10) unsigned NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = trash, 1 = ...
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `terms`;
CREATE TABLE `terms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(10) unsigned NOT NULL DEFAULT 0,
  `type_id` int(10) unsigned NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = trash, 1 = ...
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- END ATTRIBUTES

-- BEGIN SITE BUILDING
DROP TABLE IF EXISTS `areas`;
CREATE TABLE `areas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = off, 1 = on
  PRIMARY KEY (`id`),
  UNIQUE(`name`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `blocks`;
CREATE TABLE `blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `area_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- END SITE BUILDING

-- USER INTERACTION
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` BLOB NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `commenting`;
CREATE TABLE `commenting` (
  `comment_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `item_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_id` int(10) unsigned DEFAULT NULL,
  UNIQUE(`term_id`,`user_id`,`item_name`,`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `folksonomy`;
CREATE TABLE `folksonomy` (
  `term_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `item_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_id` int(10) unsigned DEFAULT NULL,
  UNIQUE(`term_id`,`user_id`,`item_name`,`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- END USER INTERACTION

-- PROJECT MANAGEMENT
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL,
  `description` BLOB NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = trash, 1 = ...
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE `tickets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dev_id` int(10) unsigned DEFAULT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `problem_url` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` BLOB NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 2, /* 0 = deleted, 1 = unassigned, 2 = open, 3 = active, 4 = closed, 5 = charged */
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `ticket_time_tracking`;
CREATE TABLE `ticket_time_tracking` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` int(10) unsigned NOT NULL,
  `start` datetime NOT NULL,
  `stop` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE `invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL,
  `hours` DECIMAL(10,2) unsigned NOT NULL,
  `rate` DECIMAL(10,2) DEFAULT NULL,
  `total` DECIMAL(10,2) DEFAULT NULL,
  `activity` DECIMAL(10,2) DEFAULT NULL, -- 0 = deleted, 1 = active, 2 = sent, 3 = contested, 4 = paid
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- END PROJECT MANAGEMENT

-- CALENDAR
DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- END CALENDAR


-- GEO
DROP TABLE IF EXISTS `places`;
CREATE TABLE `places` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `address_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `district_id` int(10) unsigned DEFAULT NULL,
  `city_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `districts`;
CREATE TABLE `districts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(10) unsigned DEFAULT NULL,
  `province_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `provinces`;
CREATE TABLE `provinces` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `coordinates`;
CREATE TABLE `coordinates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- END


-- REAL ESTATE
DROP TABLE IF EXISTS `real_estate_places`;
CREATE TABLE `real_estate_places` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `place_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- END
