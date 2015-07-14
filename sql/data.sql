INSERT INTO types (item_name, name) VALUES 
("content", "page"), 
("content", "book"), 
("content", "post"), 
("content", "project"), 
("collection", "album"), 
("collection", "folder"), 
("resource", "embed"), 
("resource", "link"), 
("resource", "file"), 
("term", "section"), 
("term", "vote"), 
("term", "tag");

INSERT INTO config (key, value, activity, created, modified) VALUES 
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

SET @type_id = (SELECT id FROM types WHERE name="album" AND item_name="content");
INSERT INTO contents (type_id, date_pub, created, modified) 
VALUES (@type_id, NOW(), NOW(), NOW());
SET @last_content_id = LAST_INSERT_ID();
INSERT INTO translations (user_id, language, item_name, item_id, slug, title, subtitle, excerpt, description, body) 
VALUES (1, 'pt-br', "content", @last_content_id, 'teste-9', 'teste', 'testando', 'testando 123 ', 'testando 123 ', 'testando 123 ');
INSERT INTO log (user_id, action, item_name, item_id, created)
VALUES (1, "insert", "content", @last_content_id, NOW());

SET @type_id = (SELECT id FROM types WHERE name="album" AND item_name="collection");
INSERT INTO collections (type_id, created, modified) 
VALUES (@type_id, NOW(), NOW());
SET @last_content_id = LAST_INSERT_ID();
INSERT INTO translations (user_id, language, item_name, item_id, slug, title, subtitle, excerpt, description, body) 
VALUES (1, 'pt-br', "collection", @last_content_id, 'teste-9', 'teste', 'testando', 'testando 123 ', 'testando 123 ', 'testando 123 ');
INSERT INTO log (user_id, action, item_name, item_id, created)
VALUES (1, "insert", "collection", @last_content_id, NOW());
