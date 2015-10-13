-- SYS
/*
Everything that has a type id points here
 */
DROP TABLE IF EXISTS `types`;
CREATE TABLE `types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `types` (name, item_name) VALUES
("image", "resource"),
("document", "resource"),
("url", "resource"),
("embed", "resource"),
("work", "content"),
("book", "content"),
("page", "content"),
("article", "content"),
("album", "collection"),
("folder", "collection"),
("menu", "collection"),
("category", "term"),
("tag", "term"),
("vote", "term"),
("pagseguro", "payment"),
("boleto", "payment"),
("credito", "payment"),
("encomenda", "shipment"),
("sedex", "shipment"),
("sedex10", "shipment"),
("residence", "place"),
("public", "place"),
("business", "place"),
("apartment", "estate"),
("house", "estate"),
("office", "estate"),
("client", "project"),
("personal", "project"),
("feature", "ticket"),
("emergency", "ticket"),
("support", "ticket");

/*
Entities metadata
 */
DROP TABLE IF EXISTS `metadata`;
CREATE TABLE `metadata` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `value` BLOB NOT NULL,
  `format` tinyint(1) unsigned NOT NULL DEFAULT 0, -- 0 = string, 1 = serialized, 2 = json, 3 = csv, 4 = xml, 5 = rss, 6 = atom
  `order` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`item_name`, `item_id`, `key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*
Relationships between entities
 */
DROP TABLE IF EXISTS `attachments`;
CREATE TABLE `attachments` (
  `group_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL, -- ex: content
  `group_id` int(10) unsigned NOT NULL,
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL, -- ex: resource
  `item_id` int(10) unsigned NOT NULL,
  `order` int(10) unsigned NOT NULL,
  UNIQUE(`group_name`, `group_id`, `item_name`, `item_id`),
  UNIQUE(`group_name`, `group_id`, `order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `attachments` (`group_name`, `group_id`, `item_name`, `item_id`, `order`) VALUES 
(),
(),
(),
(),
(),
(),
(),
(),
(),
(),
(),
(),
(),
(),
(),
();


/*
App config with default values
 */
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `value` BLOB NOT NULL,
  `format` tinyint(1) unsigned NOT NULL DEFAULT 0, -- 0 = string, 1 = serialized, 2 = json, 3 = csv, 4 = xml, 5 = rss, 6 = atom
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = active, 1 = autoload, 2 = package specific, 3 = ...
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `config` (`key`, `value`, `activity`, `created`, `modified`) VALUES 
("site.title", "bla bla bla", 2, NOW(), NOW()),
("site.tagline", "bla bla bla bla bla", 2, NOW(), NOW()),
("system.email", "pedrokoblitz@gmail.com", 2, NOW(), NOW()),
("per.page", "12", 2, NOW(), NOW()),
("upload.dir", "/public/media", 2, NOW(), NOW()),
("app.web.root", "/", 2, NOW(), NOW()),
("app.abs.path", "/var/www/html/", 2, NOW(), NOW()),
("panel.log.quantity", "15", 2, NOW(), NOW()),
("panel.content.quantity", "10", 2, NOW(), NOW()),
("panel.collection.quantity", "5", 2, NOW(), NOW()),
("panel.resource.quantity", "5", 2, NOW(), NOW()),
("panel.term.quantity", "5", 2, NOW(), NOW()),
("facebook.app.id", "", 2, NOW(), NOW()),
("facebook.app.key", "", 2, NOW(), NOW()),
("facebook.app.secret", "", 2, NOW(), NOW()),
("twitter.app.id", "", 2, NOW(), NOW()),
("twitter.app.key", "", 2, NOW(), NOW()),
("twitter.app.secret", "", 2, NOW(), NOW()),
("flickr.profile.url", "http://flickr.com.br/photos/pedrokoblitz", 2, NOW(), NOW()),
("tumblr.profile.url", "http://pedrokoblitz.tumblr.com", 2, NOW(), NOW()),
("facebook.profile.url", "https://facebook.com/pedrokoblitz", 2, NOW(), NOW()),
("facebook.page.url", "https://facebook.com/ideiasinsolitas", 2, NOW(), NOW()),
("twitter.profile.url", "http://twitter.com/pedrokoblitz", 2, NOW(), NOW()),
("linkedin.profile.url", "http://br.linkedin.com/pedrokoblitz", 2, NOW(), NOW()),
("pinterest.profile.url", "http://pinterest.com/pedrokoblitz", 2, NOW(), NOW());

/*
system activity log
 */
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

INSERT INTO `` (``, ) VALUES ;

-- END SYS

-- BEGIN USERS
/*
user management
 */
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = inactive, 1 = active
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`username`),
  UNIQUE(`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`id`,`username`,`email`,`first_name`,`last_name`,`display_name`,`password`,`activity`,`created`,`modified`) VALUES
(1, 'pedrokoblitz', 'pedrokoblitz@gmail.com', 'Pedro', 'Koblitz', 'Pedro Koblitz', '', 1, NOW(), NOW());

/*
user owns entity
 */
DROP TABLE IF EXISTS `ownership`;
CREATE TABLE `ownership` (
  `user_id` int(10) unsigned NOT NULL,
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  UNIQUE(`item_name`, `item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `ownership` (`user_id`, `item_name`, `item_id`) VALUES
(1, '', 1),
(1, '', 1),
(1, '', 1),
(1, '', 1);


/*
user collaborates in entity
 */
DROP TABLE IF EXISTS `collaborations`;
CREATE TABLE `collaborations` (
  `user_id` int(10) unsigned NOT NULL,
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  UNIQUE(`user_id`, `item_name`, `item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `collaborations` (`user_id`, `item_name`, `item_id`) VALUES
(1, '', 1),
(1, '', 1),
(1, '', 1),
(1, '', 1),
(1, '', 1);

/*
user contact information
possible types: email, phone1, phone2, fax, cell
 */
DROP TABLE IF EXISTS `user_contacts`;
CREATE TABLE `user_contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `user_contacts` (`ud`, `user_id`, `name`, `value`) VALUES
();

/*
facebook info log
 */
DROP TABLE IF EXISTS `user_facebook_info`;
CREATE TABLE `user_facebook_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `user_facebook_info` (`id`, `user_id`) VALUES
(1, 1);

/*
user legally issued identification
rg, dnh, cpf, cnpj, inscricao estadual
 */
DROP TABLE IF EXISTS `user_identifications`;
CREATE TABLE `user_identifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `user_identifications` (`id`, `user_id`, `name`, `value`) VALUES
(),
(),
();

/*
user roles
 */
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'superadmin'),
(2, 'admin'),
(3, 'editor'),
(4, 'buyer'),
(5, 'shopowner'),
(6, 'author'),
(7, 'developer'),
(8, 'registered'),
(9, 'contributor');

/*
many2many relationship between user and roles
 */
DROP TABLE IF EXISTS `users_roles`;
CREATE TABLE `users_roles` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users_roles` (`user_id`, `role_id`) VALUES
(1, 1),
(1, 8);

/*
authentication tokens
 */
DROP TABLE IF EXISTS `tokens`;
CREATE TABLE `tokens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `ip` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `token` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `used` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- END USERS

-- USER INTERACTION
/*
user comments
 */
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT 0,
  `user_id` int(10) unsigned DEFAULT NULL,
  `comment` BLOB NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `comments` (`id`, `parent_id`, `user_id`, `comment`, `created`) VALUES 
(1, 0, 1, "bla bla 1", NOW()),
(2, 1, 1, "bla bla 2", NOW()),
(3, 2, 1, "bla bla 3", NOW()),
(4, 1, 1, "bla bla 4", NOW()),
(5, 0, 1, "bla bla 5", NOW()),
(6, 0, 1, "bla bla 6", NOW());

/*
one2many relationship between comments and entities
enforced by unique key
 */
DROP TABLE IF EXISTS `commenting`;
CREATE TABLE `commenting` (
  `comment_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `item_id` int(10) unsigned DEFAULT NULL,
  UNIQUE(`comment_id`,`user_id`,`item_name`,`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `commenting` (`comment_id`, `user_id`, `item_name`, `item_id`) VALUES
(1, 1, '', 1),
(2, 1, '', 1);


/*
many2many relationships between user, term and other entities 
 */
DROP TABLE IF EXISTS `folksonomy`;
CREATE TABLE `folksonomy` (
  `term_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `item_id` int(10) unsigned DEFAULT NULL,
  UNIQUE(`term_id`,`user_id`,`item_name`,`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `folksonomy` (`term_id`, `user_id`, `item_name`, `item_id`) VALUES
(1, 1, '', 1);

-- END USER INTERACTION

-- BEGIN CONTENT
/*
store text based content for all entities and group by language
 */
DROP TABLE IF EXISTS `translations`;
CREATE TABLE `translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language` varchar(5) COLLATE utf8_unicode_ci DEFAULT "pt-br",
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `slug` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `excerpt` TINYBLOB DEFAULT NULL,
  `description` BLOB DEFAULT NULL,
  `body` BLOB DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`language`,`item_name`,`item_id`),
  UNIQUE(`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `translations` (`id`, `language`, `item_name`, `item_id`, `slug`, `title`, `subtitle`, `excerpt`, `description`, `body`) VALUES
(),
(),
(),
(),
(),
(),
(),
(),
(),
(),
(),
();

/*
content nodes
(articles,pages)
 */
DROP TABLE IF EXISTS `contents`;
CREATE TABLE `contents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = trash, 1 = ...
  `date_pub` datetime DEFAULT NULL,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `contents` (`id`, `parent_id`, `type_id`, `activity`, `date_pub`, `created`, `modified`) VALUES
(),
(),
(),
();

/*
resource nodes
(file, link, embed)
 */
DROP TABLE IF EXISTS `resources`;
CREATE TABLE `resources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL,
  `url` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `filepath` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `filename` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mimetype` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extension` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `embed` BLOB DEFAULT NULL,
  `width` int(10) unsigned DEFAULT NULL,
  `height` int(10) unsigned DEFAULT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = trash, 1 = ...
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- END CONTENT

INSERT INTO `resources` (`id`, `type_id`, `url`, `filepath`, `filename`, `mimetype`, `extension`, `embed`, `width`, `height`, `activity`, `created`, `modified`) VALUES
(),
(),
(),
(),
(),
(),
();

-- BEGIN ATTRIBUTES
/*
collection nodes
(album, folder)
 */
DROP TABLE IF EXISTS `collections`;
CREATE TABLE `collections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT 0,
  `type_id` int(10) unsigned NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = trash, 1 = ...
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `collections` (`id`, `parent_id`, `type_id`, `activity`, `created`, `modified`) VALUES
(),
(),
(),
();

/*
term nodes
(tag, section, menu)
 */
DROP TABLE IF EXISTS `terms`;
CREATE TABLE `terms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT 0,
  `type_id` int(10) unsigned NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = trash, 1 = ...
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- END ATTRIBUTES

INSERT INTO `terms` (`id`, `parent_id`, `type_id`, `activity`) VALUES
(),
(),
(),
(),
(),
(),
(),
();

-- BEGIN SITE BUILDING
/*
areas contain and ordered list of blocks
 */
DROP TABLE IF EXISTS `areas`;
CREATE TABLE `areas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = off, 1 = on
  PRIMARY KEY (`id`),
  UNIQUE(`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `areas` (`id`, `name`, `activity`) VALUES ;

/*
blocks contain a dropdown with widgets?
 */
DROP TABLE IF EXISTS `blocks`;
CREATE TABLE `blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `blocks` (`id`, `name`, `area_id`) VALUES ;


-- END SITE BUILDING

-- PROJECT MANAGEMENT
/*
project can be a site issue or a client
 */
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL,
  `description` TINYBLOB NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = trash, 1 = ...
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `projects` (`id`, `title`, `description`, `activity`) VALUES ;


/*
each task of the project
 */
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

INSERT INTO `tickets` (`id`, `dev_id`, `project_id`, `problem_url`, `description`, `activity`, `created`, `modified`) VALUES ;

/*
tracks worked hours
 */
DROP TABLE IF EXISTS `ticket_time_tracking`;
CREATE TABLE `ticket_time_tracking` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` int(10) unsigned NOT NULL,
  `start` datetime NOT NULL,
  `stop` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `ticket_time_tracking` (`id`, `ticket_id`, `start`, `stop`) VALUES ;

/*
how much the work is worth
 */
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

INSERT INTO `invoices` (`id`, `project_id`, `hours`, `rate`, `total`, `activity`, `created`) VALUES ;

-- END PROJECT MANAGEMENT


-- CALENDAR
/*
each event
 */
DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `place_id` int(10) unsigned NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `events` (`id`, `place_id`, `start`, `end`) VALUES ;

-- END CALENDAR



-- E-COMMERCE
/*

 */
DROP TABLE IF EXISTS `stores`;
CREATE TABLE `stores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `seller_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `stores` (`id`, `seller_id`) VALUES ;

/*
stock and properties
product specific properties are stored in metadata or in product_info table as needed
 */
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` int(10) unsigned NOT NULL,
  `in_stock` int(10) unsigned NOT NULL DEFAULT 0,
  `price` decimal(10,2) unsigned NOT NULL,
  `weigth` decimal(10,2) unsigned DEFAULT NULL,
  `height` decimal(10,2) unsigned DEFAULT NULL,
  `width` decimal(10,2) unsigned DEFAULT NULL,
  `depth` decimal(10,2) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `` (`id`, `store_id`, `in_stock`, `price`, `weigth`, `height`, `width`, `depth`) VALUES ;

/*
save cart if user is logged in
 */
DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `cart` (`id`, `customer_id`, `product_id`, `quantity`) VALUES ;

/*
track orders
 */
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `payment_method_id` int(10) unsigned NOT NULL,
  `shipping_method_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `orders` (`id`, `customer_id`, `payment_method_id`, `shipping_method_id`) VALUES ;

/*
relationship orders, stores and product
 */
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `order_items` (`id`, `store_id`, `order_id`, `product_id`, `quantity`) VALUES ;

/*
track payments
 */
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `amount` decimal(10,2) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `payments` (`id`, `order_id`, `type_id`, `amount`) VALUES ;

/*

 */
DROP TABLE IF EXISTS `shipments`;
CREATE TABLE `shipments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `tracking_ref` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `shipments` (`id`, `order_id`, `type_id`, `tracking_ref`) VALUES ;

-- END E-COMMERCE

-- GEOLOCATION
/*
places can have same address
 */
DROP TABLE IF EXISTS `places`;
CREATE TABLE `places` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL,
  `address_line` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `address_id` int(10) unsigned DEFAULT NULL,
  `description` BLOB NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `places` (`id`, `type_id`, `address_line`, `description`) VALUES ;

/*
adresses have coordinates
 */
DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `district_id` int(10) unsigned DEFAULT NULL,
  `city_id` int(10) unsigned DEFAULT NULL,
  `coordinate_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `addresses` (`id`, `name`, `street`, `number`, `district_id`, `city_id`, `coordinate_id`) VALUES ;

/*

 */
DROP TABLE IF EXISTS `districts`;
CREATE TABLE `districts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `city_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `districts` (`id`, `name`, `city_id`) VALUES ;

/*

 */
DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(10) unsigned DEFAULT NULL,
  `province_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `cities` (`id`, `name`, `country_id`, `province_id`) VALUES ;

/*

 */
DROP TABLE IF EXISTS `provinces`;
CREATE TABLE `provinces` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `region` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `provinces` (`id`, `code`, `name`, `region`, `country_id`) VALUES ;

/*

 */
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `countries` (`id`, `code`, `name`) VALUES ;

/*

 */
DROP TABLE IF EXISTS `coordinates`;
CREATE TABLE `coordinates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lat` decimal(10,2) unsigned NOT NULL DEFAULT 0.00,
  `lon` decimal(10,2) unsigned NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `coordinates` (`id`, `lat`, `lon`) VALUES ;

-- END GEOLOCATION

-- APPLICATION SPECIFIC

-- REAL ESTATE
-- RADAR DO ALUGUEL
/*
apartamentos, casas, salas
 */
DROP TABLE IF EXISTS `estates`;
CREATE TABLE `estates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `place_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `area` int(10) unsigned NOT NULL DEFAULT 0,
  `rooms` int(10) unsigned NOT NULL DEFAULT 0,
  `suites` int(10) unsigned NOT NULL DEFAULT 0,
  `parking_spots` int(10) unsigned NOT NULL DEFAULT 0,
  `price` decimal(10,2) unsigned NOT NULL DEFAULT 0.00,
  `charges` decimal(10,2) unsigned NOT NULL DEFAULT 0.00,
  `taxes` decimal(10,2) unsigned NOT NULL DEFAULT 0.00,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `` (`id`, `place_id`, `type_id`, `area`, `rooms`, `suites`, `parking_spots`, `price`, `charges`, `taxes`, `create`, `modified`) VALUES ;

-- END REAL ESTATE RADAR DO ALUGUEL


DROP TABLE IF EXISTS `institucional_translations`;
CREATE TABLE `institucional_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `description` BLOB,
  `body` BLOB,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `` (``, ) VALUES ;

/*
equipe ordenada
 */
DROP TABLE IF EXISTS `institucional_equipe`;
CREATE TABLE `institucional_equipe` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `` (``, ) VALUES ;


/*
download de logos com manuais
one2many resources
 */
DROP TABLE IF EXISTS `institucional_aplicacao_logos`;
CREATE TABLE `institucional_aplicacao_logos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resource_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `` (``, ) VALUES ;

/*
log de mensagens da ouvidoria
 */
DROP TABLE IF EXISTS `institucional_ouvidoria`;
CREATE TABLE `institucional_ouvidoria` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `place_id` int(10) unsigned NOT NULL,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `` (``, ) VALUES ;

/*
cadastro de leis de incentivo
 */
DROP TABLE IF EXISTS `institucional_leis_de_incentivo`;
CREATE TABLE `institucional_leis_de_incentivo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `` (``, ) VALUES ;

/*
institucional_leis_de_incentivo many2many institucional_editais
 */
DROP TABLE IF EXISTS `institucional_leis_editais`;
CREATE TABLE `institucional_leis_editais` (
  `lei_id` int(10) unsigned NOT NULL,
  `edital_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `` (``, ) VALUES ;

/*
editais
 */
DROP TABLE IF EXISTS `institucional_editais`;
CREATE TABLE `institucional_editais` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `` (``, ) VALUES ;

/*
consultas publicas devem ter itens ordenados
 */
DROP TABLE IF EXISTS `institucional_consultas_publicas_itens`;
CREATE TABLE `institucional_consultas_publicas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `consulta_id` int(10) unsigned NOT NULL,
  `tipo` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `` (``, ) VALUES ;


/*
consultas publicas
 */
DROP TABLE IF EXISTS `institucional_consultas_publicas`;
CREATE TABLE `institucional_consultas_publicas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `` (``, ) VALUES ;


/*
SEM TRADUCAO
 */
DROP TABLE IF EXISTS `institucional_parcerias`;
CREATE TABLE `institucional_parcerias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `place_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `title` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `` (``, ) VALUES ;

/*
SEM TRADUCAO
 */
DROP TABLE IF EXISTS `institucional_clipping`;
CREATE TABLE `institucional_clipping` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `source` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `` (``, ) VALUES ;

/*
banners do site
one2many resources
SEM TRADUCAO
 */
DROP TABLE IF EXISTS `institucional_ad_banners`;
CREATE TABLE `institucional_ad_banners` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `spot_id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  `title` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `` (``, ) VALUES ;


DROP TABLE IF EXISTS `institucional_ad_banner_spots`;
CREATE TABLE `institucional_ad_banner_spots` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO institucional_ad_banner_spots (name) VALUES
("destaque_home_01"),
("destaque_home_02"),
("destaque_home_03"),
("destaque_home_04"),
("destaque_cabecalho_01"),
("destaque_cabecalho_02"),
("destaque_lateral_01"),
("destaque_lateral_02"),
("destaque_lateral_03"),
("destaque_lateral_04"),
("destaque_rodape_01"),
("destaque_rodape_02");
--END INSTITUCIONAL CULTURA.RJ
