DROP PROCEDURE IF EXISTS `insert_content`;
DROP PROCEDURE IF EXISTS `update_content`;
DROP PROCEDURE IF EXISTS `insert_collection`;
DROP PROCEDURE IF EXISTS `update_collection`;
DROP PROCEDURE IF EXISTS `insert_resource`;
DROP PROCEDURE IF EXISTS `update_resource`;

DELIMITER $$

CREATE PROCEDURE `insert_content`(
  IN content_type VARCHAR(255),
  IN user_id INT,
  IN date_pub VARCHAR(255),
  IN lang VARCHAR(255),
  IN slug VARCHAR(255),
  IN name VARCHAR(255),
  IN title VARCHAR(255),
  IN subtitle VARCHAR(255),
  IN excerpt VARCHAR(255),
  IN description BLOB,
  IN body BLOB
)
BEGIN
  SET @type_id = (SELECT id FROM types WHERE name=content_type AND item_name="content");
  INSERT INTO contents (
    type_id, 
    date_pub
  ) 
    VALUES (
      @type_id, 
      date_pub, 
      NOW()
    );
  SET @last_content_id = LAST_INSERT_ID();
  INSERT INTO translations (
    user_id, 
    language, 
    item_name, 
    item_id, 
    slug, 
    name, 
    title, 
    subtitle, 
    excerpt, 
    description, 
    body
  ) 
    VALUES (
      user_id, 
      language, 
      "content", 
      @last_content_id, 
      slug, 
      name, 
      title, 
      subtitle, 
      excerpt, 
      description, 
      body
    );
  INSERT INTO log (
    user_id, 
    action, 
    item_name, 
    item_id, 
    created
  )
    VALUES (
      user_id, 
      "insert", 
      "content", 
      @last_content_id, 
      NOW()
    );
END$$

CREATE PROCEDURE `update_content`(
  IN id INT,
  IN user_id INT,
  IN lang VARCHAR(255),
  IN slug VARCHAR(255),
  IN name VARCHAR(255),
  IN title VARCHAR(255),
  IN subtitle VARCHAR(255),
  IN excerpt VARCHAR(255),
  IN description BLOB,
  IN body BLOB,
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
  INSERT INTO log (user_id, action, item_name, item_id, created)
    VALUES (user_id, "update", "content", id, NOW());
END$$


CREATE PROCEDURE `insert_collection`(
  IN user_id INT,
  IN collection_type VARCHAR(255),
  IN lang VARCHAR(255),
  IN name VARCHAR(255),
  IN title VARCHAR(255),
  IN description BLOB
)
BEGIN
  SET @type_id = (SELECT id FROM types WHERE name=collection_type AND item_name="collection");
  INSERT INTO collections (
    type_id, 
    created, 
    modified
  )
    VALUES (
      @type_id, 
      NOW(), 
      NOW()
    );
  INSERT INTO translations (
    user_id, 
    language, 
    item_name, 
    item_id, 
    slug, 
    name, 
    title, 
    description
  )
    VALUES (
      user_id, 
      language, 
      "collection", 
      @last_content_id, 
      slug, 
      name, 
      title, 
      description
    );
  INSERT INTO log (
    user_id, 
    action, 
    item_name, 
    item_id, 
    created
  )
    VALUES (
      user_id, 
      "insert", 
      "collection", 
      LAST_INSERT_ID(), 
      NOW()
    );
END$$

CREATE PROCEDURE `update_collection`(
  IN id INT,
  IN user_id INT,
  IN lang VARCHAR(255),
  IN slug VARCHAR(255),
  IN name VARCHAR(255),
  IN title VARCHAR(255),
  IN description BLOB
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
  INSERT INTO log (user_id, action, item_name, item_id, created)
    VALUES (user_id, "update", "collection", id, NOW());
END$$

CREATE PROCEDURE `insert_resource`(
  IN resource_type VARCHAR(255),
  IN user_id INT,
  IN lang VARCHAR(255),
  IN url VARCHAR(255),
  IN slug VARCHAR(255),
  IN filepath VARCHAR(255),
  IN filename VARCHAR(255),
  IN extension VARCHAR(255),
  IN name VARCHAR(255),
  IN title VARCHAR(255),
  IN description BLOB
)
BEGIN
  SET @type_id = (SELECT id FROM types WHERE name=resource_type AND item_name="resource");
  INSERT INTO resources (
    type_id, 
    url, 
    filepath, 
    filename, 
    extension, 
    created, 
    modified
  ) 
    VALUES (
      @type_id, 
      url, 
      filepath, 
      filename, 
      extension, 
      NOW(), 
      NOW()
    );
  INSERT INTO translations (
    user_id, 
    language, 
    item_name, 
    item_id, 
    slug, 
    name, 
    title, 
    description
  ) 
    VALUES (
      user_id, 
      language, 
      "resource", 
      @last_content_id, 
      slug, 
      name, 
      title, 
      description
    );
  INSERT INTO log (
    user_id, 
    action, 
    item_name, 
    item_id, 
    created
  )
    VALUES (
      user_id, 
      "insert", 
      "resource", 
      LAST_INSERT_ID(), 
      NOW()
    );
END$$

CREATE PROCEDURE `update_resource`(
  IN id INT,
  IN url VARCHAR(255),
  IN filepath VARCHAR(255),
  IN filename VARCHAR(255),
  IN extension VARCHAR(255),
  IN user_id INT,
  IN lang VARCHAR(255),
  IN slug VARCHAR(255),
  IN name VARCHAR(255),
  IN title VARCHAR(255),
  IN description BLOB
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
  INSERT INTO log (
    user_id, 
    action, 
    item_name, 
    item_id, 
    created
  )
    VALUES (
      user_id, 
      "update", 
      "resource", 
      id, 
      NOW()
    );
END$$

DELIMITER ;
