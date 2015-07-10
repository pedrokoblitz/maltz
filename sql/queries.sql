-- config
SELECT id, key, value, activity, modified, created FROM config;
INSERT INTO config (key, value, activity, created) VALUES ();
UPDATE config SET key=, value=, activity=, modified=NOW(), created=;

-- log
SELECT id, user_id, action, item_name, item_id, created FROM log;
INSERT INTO log (user_id, action, item_name, item_id, created) VALUES ();

-- translations
INSERT INTO translations (user_id, language, item_name, item_id, slug, name, title, subtitle, excerpt, description, body) VALUES ():
UPDATE translations SET user_id=, language=, item_name=, item_id=, slug=, name=, title=, subtitle=, excerpt=, description=, body=;

--users
INSERT INTO users (username, name, email, cpf, cnpj, cellphone, phone, zipcode, address, address2, district, city, province, password, activity, created) VALUES ();
UPDATE users SET username=, name=, email=, cpf=, cnpj=, cellphone=, phone=, zipcode=, address=, address2=, district=, city=, province=, password=, token=, activity=, created=;

--roles
INSERT INTO roles (name, activity) VALUES ();
UPDATE roles SET name=, activity=;

--tokens
INSERT INTO tokens (user_id, ip, token, type, activity, created, used) VALUES (0, 0, "", MD5(NOW()), "", 1, NOW(), "");
UPDATE tokens SET user_id=, ip=, token=, type=, activity=, used=;

--collections
INSERT INTO collections (type_id, activity, modified, created) VALUES ();
UPDATE collections SET activity=, modified=NOW();

--terms
INSERT INTO terms (parent_id, type_id, activity) VALUES ();
UPDATE terms SET parent_id=, type_id=, activity=;

--areas
INSERT INTO areas (name, activity) VALUES ();
UPDATE areas SET name=, activity=;

--blocks
INSERT INTO blocks (area_id, activity) VALUES ();
UPDATE blocks SET area_id=, activity=;

--contents
INSERT INTO contents (type_id, activity, date_pub, created) VALUES ();
UPDATE contents SET type_id=, activity=, date_pub=, modified=NOW();

--resources
INSERT INTO resources (type_id, url, filepath, filename, extension, activity, created) VALUES ();
UPDATE resources SET type_id=, url=, filepath=, filename=, extension=, activity=, modified=NOW();

--types
INSERT INTO types (item_name, name) VALUES ();
UPDATE types SET item_name=, name=;




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
SELECT FROM translations t1
  LEFT JOIN contents t2
    ON t1.item_id=t2.id
  WHERE slug=:slug 
    -- OR WHERE t1.item_id=:id 
    AND t1.item_name = 'content'
    AND t1.language=:lang
    AND t2.activity > 0;

SELECT FROM translations t1
  LEFT JOIN resources t2
    ON t1.item_id=t2.id
    AND t1.item_name = 'resource'
  WHERE t1.slug=:slug 
    AND t1.language=:lang
    AND t2.activity > 0;

SELECT FROM translations t1
  LEFT JOIN collections t2
    ON t1.item_id=t2.id
  WHERE t1.slug=:slug 
    AND t1.item_name = 'collection'
    AND t1.language=:lang
    AND t2.activity > 0;




-- select by id
SELECT FROM translations t1
  LEFT JOIN terms t2
    ON t1.item_id=t2.id
  WHERE t1.item_id=:id 
    AND t1.item_name = 'term'
    AND t1.language=:lang
    AND t2.activity > 0;




-- select many
SELECT FROM translations t1
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

SELECT t1.name AS area_name, t3.user_id, t3.language, t3.item_name, t3.item_id, t3.slug, t3.name, t3.title, t3.subtitle, t3.excerpt, t3.description, t3.body FROM areas t1, blocks t2
  LEFT JOIN translations t3
    ON t2.id=t3.item_id
    AND t3.item_name="block"
  WHERE t1.id=:id
    AND t2.area_id=:id;



SELECT * FROM items_groups WHERE item_name= AND item_id= AND group_name= AND group_id=;

INSERT INTO items_groups (item_name, item_id, collection_id) VALUES ('term', 1, 'content', 1, 1);
INSERT INTO items_groups (item_name, item_id, collection_id) VALUES ('term', 2, 'content', 1, 2);
INSERT INTO items_groups (item_name, item_id, collection_id) VALUES ('resource', 1, 'collection', 2, 1);
INSERT INTO items_groups (item_name, item_id, collection_id) VALUES ('resource', 2, 'collection', 2, 2);






-- validar cadastro
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

