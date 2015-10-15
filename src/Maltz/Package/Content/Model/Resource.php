<?php

namespace Maltz\Package\Content\Model;

use Maltz\Mvc\DB;
use Maltz\Mvc\Model;
use Maltz\Mvc\Record;
use Maltz\Mvc\ModelFeature\Activity;
use Maltz\Mvc\ModelFeature\Translatable;
use Maltz\Service\Pagination;

/**
 * db de files pertencentes a albums
 *
 * http://ideiasinsolitas.com.br/
 *
 * @copyright Copyright (c) 2012-2013 Pedro Koblitz
 * @author    Pedro Koblitz pedrokoblitz@gmail.com
 * @license   GPL v2
 *
 * @package Maltz
 *
 * @version 0.1 alpha
 */

/*
 *
 *
 *
 * @param objeto DB
 *
 * return void
 */

class Resource extends Model
{
    use Activity;
    use Translatable;

    /*
    * construtor
    *
    * @param db objeto DB
    *
    *
    */
    public function __construct(DB $db)
    {
        $rules = array(
            'id' => 'int',
            'type_id' => 'int',
            'activity' => 'int',
            'url' => 'string',
            'filepath' => 'string',
            'filename' => 'string',
            'extension' => 'string',
            'embed' => 'string',
            'user_id' => 'int',
            'slug' => 'slug',
            'title' => 'string',
            'description' => 'textarea',
            'language' => 'string',
            'mimetype' => 'string',
            );
        parent::__construct($db, 'resource', 'resources', $rules);
    }

    /*
     * CRUD
     */
    /**
     * /
     * @param  Record $record [description]
     * @return [type]         [description]
     */
    public function insert(Record $record)
    {
        $sql = "INSERT INTO resources (type_id, url, filepath, filename, extension, embed, mimetype, created, modified) 
            VALUES (:type_id, :url, :filepath, :filename, :extension, :embed, :mimetype, NOW(), NOW())";
        $result = $this->db->run($sql, array(
            'type_id' => $record->get('type_id'),
            'url' => $record->get('url'),
            'filepath' => $record->get('filepath'),
            'filename' => $record->get('filename'),
            'extension' => $record->get('extension'),
            'embed' => $record->get('embed'),
            'mimetype' => $record->get('mimetype')
            )
        );
        $record->remove('type_id');
        $record->remove('url');
        $record->remove('filepath');
        $record->remove('filename');
        $record->remove('extension');
        $record->remove('embed');
        $record->remove('mimetype');
        $record->set('item_name', 'resource');
        $record->set('item_id', $result->getLastInsertId());
        $slug = $this->generateSlug($record->get('title'));
        $record->set('slug', $slug);
        $fields = $record->getFieldsList();
        $values = $record->getInsertValueString();

        $sql = "INSERT INTO translations $fields 
            VALUES $values";
        $result = $this->db->run($sql, $record->toArray());
        return $result;
    }

    /**
     * /
     * @param  Record $record [description]
     * @return [type]         [description]
     */
    public function update(Record $record)
    {
        $id = $record->get('id');
        $record->remove('id');
        $language = $record->get('language');
        $record->remove('language');
        $sql = "UPDATE resources SET modified=NOW() WHERE id=:id";
        $result = $this->db->run($sql, array('id' => $id));
        $record->remove('type_id');
        $record->remove('url');
        $record->remove('filepath');
        $record->remove('filename');
        $record->remove('extension');
        $record->remove('embed');
        $record->remove('mimetype');
        $values = $record->getUpdateValueString();
        $sql = "UPDATE translations 
            SET $values 
            WHERE item_id=:id 
                AND language=:language
                AND item_name=:item_name";
        $record->set('language', $language);
        $record->set('item_name', 'term');
        $record->set('id', $id);
        $result = $this->db->run($sql, $record->toArray());
        return $result;
    }

    /**
     * /
     * @param  string $key   [description]
     * @param  string $order [description]
     * @param  string $lang  [description]
     * @return [type]        [description]
     */
    public function display($key = 'title', $order = 'asc', $lang = 'pt-br')
    {
        if (!is_string($key) || !is_string($order) || !is_string($lang)) {
            throw new \Exception("Invalid input type", 1);
        }

        $sql = "SELECT t1.id AS id, t1.url AS url, t1.filepath AS filepath, t1.filename AS filename, t1.extension AS extension, t1.embed AS embed, t1.activity AS activity, t1.created AS created, t1.modified AS modified, t2.title AS title, t2.description AS description, t3.name AS type
        FROM resources t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3
                ON t1.type_id=t3.id
        WHERE t2.language=:lang
        AND t1.activity > 0
        ORDER BY $key $order";
        $result = $this->db->run($sql, array('item_name' => 'resource', 'lang' => $lang));
        return $result;
    }

    /**
     * /
     * @param  integer $page     [description]
     * @param  integer $per_page [description]
     * @param  string  $key      [description]
     * @param  string  $order    [description]
     * @param  string  $lang     [description]
     * @return [type]            [description]
     */
    public function find($page = 1, $per_page = 12, $key = 'modified', $order = 'desc', $lang = 'pt-br')
    {
        if (!is_int($pg) || !is_int($per_page) || !is_string($key) || !is_string($order) || !is_string($lang)) {
            throw new \Exception("Invalid input type", 1);
        }

        $pagination = Pagination::paginate($page, $per_page);
        $sql = "SELECT t1.id AS id, t1.url AS url, t1.filepath AS filepath, t1.filename AS filename, t1.extension AS extension, t1.embed AS embed, t1.activity AS activity, t1.created AS created, t1.modified AS modified, t2.title AS title, t2.description AS description, t3.name AS type
        FROM resources t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3
                ON t1.type_id=t3.id
        WHERE t2.language=:lang
        AND t1.activity > 0
        ORDER BY $key $order
        LIMIT $pagination->offset,$pagination->limit";
        $result = $this->db->run($sql, array('item_name' => 'resource', 'lang' => $lang));
        return $result;
    }

    /**
     * /
     * @param  [type]  $type     [description]
     * @param  integer $page     [description]
     * @param  integer $per_page [description]
     * @param  string  $key      [description]
     * @param  string  $order    [description]
     * @param  string  $lang     [description]
     * @return [type]            [description]
     */
    public function findByType($type, $page = 1, $per_page = 12, $key = 'title', $order = 'asc', $lang = 'pt-br')
    {
        if (!is_string($type) || !is_int($pg) || !is_int($per_page) || !is_string($key) || !is_string($order) || !is_string($lang)) {
            throw new \Exception("Invalid input type", 1);
        }

        $pagination = Pagination::paginate($page, $per_page);
        $sql = "SELECT t1.id AS id, t1.url AS url, t1.filepath AS filepath, t1.filename AS filename, t1.extension AS extension, t1.embed AS embed, t1.activity AS activity, t1.created AS created, t1.modified AS modified, t2.title AS title, t2.description AS description, t3.name AS type
        FROM resources t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3
                ON t1.type_id=t3.id
            WHERE t3.name=:type
            AND t2.language=:lang
            AND t1.activity > 0
        ORDER BY $key $order
        LIMIT $pagination->offset,$pagination->limit";
        $result = $this->db->run($sql, array('type' => $type, 'item_name' => 'resource', 'lang' => $lang));
        return $result;
    }

    /**
     * /
     * @param  [type] $id   [description]
     * @param  string $lang [description]
     * @return [type]       [description]
     */
    public function show($id, $lang = 'pt-br')
    {
        if (!is_int($id) || !is_string($lang)) {
            throw new \Exception("Invalid input type", 1);
        }

        $sql = "SELECT t1.id AS id, t1.url AS url, t1.filepath AS filepath, t1.filename AS filename, t1.extension AS extension, t1.embed AS embed, t1.activity AS activity, t1.created AS created, t1.modified AS modified, t2.title AS title, t2.description AS description, t3.name AS type
        FROM resources t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3
                ON t1.type_id=t3.id
        WHERE t1.id=:id
        AND t2.language=:lang
        AND t1.activity > 0";
        $result = $this->db->run($sql, array('item_id' => $id, 'item_name' => 'resource', 'lang' => $lang));
        return $result;
    }
}
