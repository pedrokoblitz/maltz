SELECT id, name, type, date_pub, url, filepath, filename, extension, slug, title, subtitle, excerpt, description, body, activity, created, modified FROM
  (
    (
      SELECT 
        t1.id AS id,
        "content" AS name,
        t3.name AS type,
        t1.date_pub AS date_pub,
        null AS url,
        null AS filepath,
        null AS filename,
        null AS extension,
        t2.slug AS slug,
        t2.title AS title,
        t2.subtitle AS subtitle,
        t2.excerpt AS excerpt,
        t2.description AS description,
        t2.body AS body,
        t1.activity AS activity,
        t1.created AS created,
        t1.modified AS modified
      FROM contents t1
      JOIN translations t2 
        ON t1.id=t2.item_id
        AND t2.item_name="content"
      JOIN types t3 
        ON t1.type_id=t3.id
      LIMIT 0,10
    )
    UNION
    (
      SELECT 
        t1.id AS id, 
        "resource" AS name,
        t3.name AS type,
        null AS date_pub,
        t1.url AS url,
        t1.filepath AS filepath,
        t1.filename AS filename,
        t1.extension AS extension,
        t2.slug AS slug,
        t2.title AS title,
        t2.subtitle AS subtitle,
        t2.excerpt AS excerpt,
        t2.description AS description,
        t2.body AS body,
        t1.activity AS activity,
        t1.created AS created,
        t1.modified AS modified
      FROM resources t1
      JOIN translations t2 
        ON t1.id=t2.item_id
        AND t2.item_name="resource"
      JOIN types t3 
        ON t1.type_id=t3.id
      LIMIT 0,10
    )
    UNION
    (
      SELECT 
        t1.id AS id,
        "collection" AS name,
        t3.name AS type,
        null AS date_pub,
        null AS url,
        null AS filepath,
        null AS filename,
        null AS extension,
        t2.slug AS slug,
        t2.title AS title,
        t2.subtitle AS subtitle,
        t2.excerpt AS excerpt,
        t2.description AS description,
        t2.body AS body,
        t1.activity AS activity,
        t1.created AS created,
        t1.modified AS modified
      FROM collections t1
      JOIN translations t2 
        ON t1.id=t2.item_id
        AND t2.item_name="collection"
      JOIN types t3 
        ON t1.type_id=t3.id
      LIMIT 0,10
    )
    UNION
    (
      SELECT 
        t1.id AS id,
        "term" AS name,
        t3.name AS type,
        null AS date_pub,
        null AS url,
        null AS filepath,
        null AS filename,
        null AS extension,
        t2.slug AS slug,
        t2.title AS title,
        t2.subtitle AS subtitle,
        t2.excerpt AS excerpt,
        t2.description AS description,
        t2.body AS body,
        t1.activity AS activity,
        null AS created,
        null AS modified
      FROM terms t1
      JOIN translations t2 
        ON t1.id=t2.item_id
        AND t2.item_name="term"
      JOIN types t3 
        ON t1.type_id=t3.id
      LIMIT 0,10
    )
  ) master
ORDER BY master.type ASC, master.activity DESC, master.modified DESC;





SELECT id, item_name, name FROM types WHERE item_name="content";
SELECT id, item_name, name FROM types WHERE item_name="resource";
SELECT id, item_name, name FROM types WHERE item_name="term";
SELECT id, item_name, name FROM types WHERE item_name="collection";

--log
SELECT id, user_id, action, item_name, item_id, created FROM log;

INSERT INTO log (user_id, action, item_name, item_id, created)
  VALUES (user_id, "insert", "config", LAST_INSERT_ID(), NOW());


--config
SELECT id, key, value, activity, modified, created FROM config;

INSERT INTO config (key, value, activity, created) 
  VALUES ();

UPDATE config SET key=?, value=?, activity=?, modified=NOW(), created=;

--translations
INSERT INTO translations (user_id, language, item_name, item_id, slug, name, title, subtitle, excerpt, description, body)
	VALUES ():

UPDATE translations SET user_id=?, language=?, item_name=?, item_id=?, slug=?, name=?, title=?, subtitle=?, excerpt=?, description=?, body=;

--users
INSERT INTO users (username, name, email, cpf, cnpj, cellphone, phone, zipcode, address, address2, district, city, province, password, activity, created)
	VALUES ();
UPDATE users SET username=?, name=?, email=?, cpf=?, cnpj=?, cellphone=?, phone=?, zipcode=?, address=?, address2=?, district=?, city=?, province=?, password=?, token=?, activity=?, created=;

--roles
INSERT INTO roles (name, activity)
	VALUES ();
UPDATE roles SET name=?, activity=;

--tokens
INSERT INTO tokens (user_id, ip, token, type, activity, created, used)
	VALUES (?, ?, ?, MD5(NOW()), ?, ?, NOW(), ?);

UPDATE tokens SET user_id=?, ip=?, token=?, type=?, activity=?, used=;

--collections
INSERT INTO collections (type_id, activity, modified, created)
	VALUES ();

UPDATE collections SET activity=?, modified=NOW();

--terms
INSERT INTO terms (parent_id, type_id, activity)
	VALUES ();

UPDATE terms SET parent_id=?, type_id=?, activity=;

--areas
INSERT INTO areas (name, activity)
	VALUES ();

UPDATE areas SET name=?, activity=;

--blocks
INSERT INTO blocks (area_id, activity)
	VALUES ();

UPDATE blocks SET area_id=?, activity=;

--contents
INSERT INTO contents (type_id, activity, date_pub, created)
	VALUES ();

UPDATE contents SET type_id=?, activity=?, date_pub=?, modified=NOW();

--resources
INSERT INTO resources (type_id, url, filepath, filename, extension, activity, created)
	VALUES ();

UPDATE resources SET type_id=?, url=?, filepath=?, filename=?, extension=?, activity=?, modified=NOW();

--types
INSERT INTO types (item_name, name)
	VALUES (?,?);

UPDATE types SET item_name=?, name=?;




--avaiable translations
SELECT item_id, language, slug, name, title FROM translations WHERE item_name=? AND item_id=?;

--update activity
UPDATE $table SET activity=:activity;
UPDATE $table SET modified=NOW();

SELECT * FROM translations
  WHERE item_id IN (
    SELECT id FROM contents ORDER BY modified DESC LIMIT ?,?;
  )
  AND item_name="content";





--select by slug
SELECT FROM translations t1
  LEFT JOIN contents t2
    ON t1.item_id=t2.id
  WHERE slug=? 
    --OR WHERE t1.item_id=? 
    AND t1.item_name = 'content'
    AND t1.language=?
    AND t2.activity > 0;

SELECT FROM translations t1
  LEFT JOIN resources t2
    ON t1.item_id=t2.id
    AND t1.item_name = 'resource'
  WHERE t1.slug=?
    AND t1.language=?
    AND t2.activity > 0;

SELECT FROM translations t1
  LEFT JOIN collections t2
    ON t1.item_id=t2.id
  WHERE t1.slug=?
    AND t1.item_name = 'collection'
    AND t1.language=?
    AND t2.activity > 0;




--select by id
SELECT FROM translations t1
  LEFT JOIN terms t2
    ON t1.item_id=t2.id
  WHERE t1.item_id=?
    AND t1.item_name = 'term'
    AND t1.language=?
    AND t2.activity > 0;




--select many
SELECT FROM translations t1
  LEFT JOIN contents t2
    ON t1.item_id=t2.id
    AND t1.item_name = 'content'
  LEFT JOIN content_types t3
    ON t2.content_type_id=t3.id
  WHERE t1.language=?
    AND t3.name=?
    AND t2.activity > 0
  ORDER BY t2.modified
  LIMIT :offset,:num;

SELECT t1.name AS area_name, t3.user_id, t3.language, t3.item_name, t3.item_id, t3.slug, t3.name, t3.title, t3.subtitle, t3.excerpt, t3.description, t3.body FROM areas t1, blocks t2
  LEFT JOIN translations t3
    ON t2.id=t3.item_id
    AND t3.item_name="block"
  WHERE t1.id=?
    AND t2.area_id=?;



SELECT * FROM items_groups WHERE item_name= AND item_id= AND group_name= AND group_id=;

INSERT INTO items_groups (item_name, item_id, collection_id)
	VALUES ('term', 1, 'content', 1, 1);
INSERT INTO items_groups (item_name, item_id, collection_id)
	VALUES ('term', 2, 'content', 1, 2);
INSERT INTO items_groups (item_name, item_id, collection_id)
	VALUES ('resource', 1, 'collection', 2, 1);
INSERT INTO items_groups (item_name, item_id, collection_id)
	VALUES ('resource', 2, 'collection', 2, 2);






--validar cadastro
SELECT user_id FROM tokens WHERE token=token AND user_id=user_id AND activity=1;
UPDATE users SET activity=1 WHERE id=user_id;
UPDATE tokens SET activity=0, used=NOW() WHERE token=token AND user_id=user_id;

--permission
--:username users.username
--:name roles.name

--add role
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

--delete role
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

--has permission?
SELECT t1.id FROM users t1
  LEFT JOIN users_roles t2
  ON t1.id=t2.user_id
  LEFT JOIN roles t3
  ON t2.role_id=t3.id
  WHERE t3.name=:name 
  AND t1.id=?;











--projects

INSERT INTO projects (title, description) VALUES (:title, :description);

SELECT title, description FROM projects WHERE id=:id;

-- get users in project
SELECT t1.name, t1.email, t3.title FROM users t1
  JOIN users_projects t2
    ON t1.id=t2.user_id
  JOIN projects t3
    ON t2.project_id=t3.id
  WHERE t3.id=:id

-- count devs on project
SELECT COUNT(t1.dev_id) as count, t2.name, t2.email, t3.title  FROM tickets t1
  JOIN users t2
    ON t1.dev_id=t2.id
  JOIN projects t3
    ON t1.project_id=t3.id
  GROUP BY t1.project_id;

--tickets

--new (dev unassigned)
INSERT INTO tickets (project_id, hash, priority, description, activity, created, modified) VALUES
(:project_id, MD5(NOW()), :priority, :description, :activity, NOW(), NOW());
--list unassigned
SELECT (id, project_id, hash, priority, description, activity, created, modified) FROM tickets
WHERE project_id=:project_id AND activity = 1 -- 1 = unassigned
--assign dev
UPDATE tickets SET dev_id=:dev_id WHERE ticket_id=:ticket_id;

-- select ticket if is open
SELECT id FROM tickets WHERE id=:id AND activity=2 -- 2 = open

--list
SELECT (id, dev_id, project_id, hash, priority, description, activity, created, modified) FROM tickets
WHERE activity=:activity
ORDER BY modified DESC, project_id ASC, priority DESC, activity DESC

-- count tickets by project
SELECT COUNT(t1.id) as count, t2.title FROM tickets t1
  JOIN projects t2
    ON t1.project_id=t2.id
  GROUP BY t1.project_id; 

-- count tickets by dev
SELECT COUNT(t1.id) as count, t2.name, t3.email, t3.title FROM tickets t1
  JOIN users t2
    ON t1.dev_id=t2.id
  JOIN projects t3
    ON t1.project_id=t3.id
  GROUP BY t1.dev_id; 

--show tickets
SELECT t1.id, t1.dev_id, t1.project_id, t1.hash, t1.priority, t1.description, t1.activity, t1.created, t1.modified FROM tickets t1
WHERE id=:id
--show contactinfo for users
SELECT name, email FROM users
  WHERE id=:id;
--change activity
UPDATE tickets SET activity=:activity, modified=NOW() WHERE id=:id;
--change priority
UPDATE tickets SET priority=:priority, modified=NOW() WHERE id=:id;

-- get all project tickets
SELECT t2.title, t1.hash, t1.priority, t1.activity, t1.created, t1.modified
  FROM tickets t1
  JOIN projects t2
    ON t1.project_id=t2.id
  WHERE t2.id=:project_id
-- get project tickets assigned to dev
SELECT t2.title, t1.hash, t1.priority, t1.activity, t1.created, t1.modified
  FROM tickets t1
  JOIN projects t2
    ON t1.project_id=t2.id
  WHERE t1.project_id=:project_id
  AND t1.dev_id=:dev_id
-- get all tickets assigned to dev
SELECT t2.title, t1.hash, t1.priority, t1.activity, t1.created, t1.modified
  FROM tickets t1
  JOIN projects t2
    ON t1.project_id=t2.id
  WHERE t1.dev_id=:dev_id

--time tracking

--open
INSERT INTO ticket_time_tracking ticket_id, (start) VALUES (:ticket_id, NOW())
--is anything open?
SELECT ticket_id FROM ticket_time_tracking WHERE stop=NULL;
--close
UPDATE ticket_time_tracking SET stop=NOW() WHERE id=:id


--generate report and/or invoice
--billable hours by project (to see all hours remove "WHERE activity")
SET @totalhours = (
SELECT
    SEC_TO_TIME(SUM(TIME_TO_SEC(timediff(t1.start, t1.stop)))) AS totalhours,
    totalhours * t4.rate AS total,
    t3.title AS title -- add activity for proj report and proj.title for full report
  FROM ticket_time_tracking t1 
  JOIN tickets t2
    ON t1.ticket_id=t2.id
  JOIN projects t3
    ON t2.project_id=t3.id
  JOIN users t4
    ON t1.dev_id=t4.id
  WHERE t2.project_id=:project_id -- (remove for total report)
    AND t2.activity = 4 -- for generating invoice, closed tickets only (remove for project report)
);

--billable hours by dev
SET @totalhours = (
  SELECT
      SEC_TO_TIME(SUM(TIME_TO_SEC(timediff(t1.start, t1.stop)))) AS totalhours,
      totalhours * t4.rate AS total,
      t3.title AS title
    FROM ticket_time_tracking t1 
    JOIN tickets t2
      ON t1.ticket_id=t2.id
    JOIN projects t3
      ON t2.project_id=t3.id
    JOIN users t4
      ON t1.dev_id=t4.id
    WHERE t2.dev_id=:dev_id
      AND t2.activity = 4
);

--billable hours by dev in project
SET @totalhours = (
  SELECT
      SEC_TO_TIME(SUM(TIME_TO_SEC(timediff(t1.start, t1.stop)))) AS totalhours,
      totalhours * t4.rate AS total,
      t3.title AS title
    FROM ticket_time_tracking t1 
    JOIN tickets t2
      ON t1.ticket_id=t2.id
    JOIN projects t3
      ON t2.project_id=t3.id
    JOIN users t4
      ON t1.dev_id=t4.id
    WHERE t2.dev_id=:dev_id
      AND t2.project_id=:project_id
      AND t2.activity = 4
);

INSERT INTO invoices (project_id, hours, rate, total, activity, created) 
  VALUES (:project_id, :totalhours, :rate, :total, 1, NOW());

SELECT t1.id, t2.title AS project, t1.hours, t1.rate, t1.total, t1.activity, t1.created FROM invoices
  JOIN projects t2
    ON t1.project_id=t2.id
  WHERE t1.id=:id
