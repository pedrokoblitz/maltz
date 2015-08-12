-- SYS

DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `value` BLOB NOT NULL,
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
  `group_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `action` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `item_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_id` int(10) unsigned DEFAULT NULL,
  `nonce` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- END SYS

-- BEGIN USERS
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,  -- should be null or not?
  `password` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = inactive, 1 = active
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`username`),
  UNIQUE(`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
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
  `ip` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `token` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `used` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- END USERS

-- PROJECT MANAGEMENT
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL,
  `description` TINYBLOB NOT NULL,
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
  `rate` DECIMAL(10,2) NOT NULL,
  `total` DECIMAL(10,2) NOT NULL,
  `activity` DECIMAL(10,2) NOT NULL DEFAULT 1, -- 0 = deleted, 1 = active, 2 = sent, 3 = contested, 4 = paid
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- END PROJECT MANAGEMENT
