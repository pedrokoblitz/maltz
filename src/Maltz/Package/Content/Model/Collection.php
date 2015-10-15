<?php

namespace Maltz\Package\Content\Model;

use Maltz\Mvc\DB;
use Maltz\Mvc\Model;
use Maltz\Mvc\Record;
use Maltz\Mvc\ModelFeature\Activity;
use Maltz\Mvc\ModelFeature\Translatable;
use Maltz\Mvc\ModelFeature\Attachment;
use Maltz\Mvc\ModelFeature\Tree;
use Maltz\Service\Pagination;

/**
 * db de collection pertencente a
 *  - pages
 *  - contents
 *  - books
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

class Collection extends Model
{
    use Tree;
    use Activity;
    use Translatable;
    use Attachment;
        
     /**
      * /
      * @param DB $db [description]
      */
    public function __construct(DB $db)
    {
        $rules = array(
            'id' => 'int',
            'parent_id' => 'int',
            'type_id' => 'int',
            'activity' => 'int',
            'user_id' => 'int',
            'slug' => 'slug',
            'title' => 'string',
            'description' => 'textarea',
            'language' => 'string',
            );
        parent::__construct($db, 'collection', 'collections', $rules);
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
        $sql = "INSERT INTO collections (type_id, parent_id, created, modified)
            VALUES (:type_id, :parent_id, NOW(), NOW())";
        $result = $this->db->run($sql, array('type_id' => $record->get('type_id'), 'parent_id' => $record->get('parent_id')));
        $record->remove('parent_id');
        $record->remove('type_id');
        $record->set('item_name', 'collection');
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
        $sql = "UPDATE collections SET parent_id=:parent_id, modified=NOW() WHERE id=:id";
        $result = $this->db->run($sql, array('id' => $id, 'parent_id' => $record->get('parent_id')));
        $record->remove('parent_id');
        $record->remove('type_id');
        $values = $record->getUpdateValueString();
        $sql = "UPDATE translations SET $values
            WHERE item_id=:id 
                AND language=:language
                AND item_name=:item_name";
        $record->set('language', $language);
        $record->set('item_name', 'collection');
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
    public function display($key = 'type', $order = 'desc', $lang = 'pt-br')
    {
        if (!is_string($key) || !is_string($order) || !is_string($lang)) {
            throw new \Exception("Invalid input type", 1);
        }
        
        $sql = "SELECT t1.id AS id, t1.activity AS activity, t1.created AS created, t1.modified AS modified, t2.slug AS slug, t2.title AS title, t2.description AS description, t3.name AS type
        FROM collections t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3
                ON t1.type_id=t3.id
            WHERE t1.activity > 0
            AND t2.language=:language
            ORDER BY $key $order";
        $result = $this->db->run($sql, array('item_name' => 'collection', 'language' => $lang));
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
    public function find($page = 1, $per_page = 12, $key = 'type', $order = 'desc', $lang = 'pt-br')
    {
        if (!is_int($page) || !is_int($per_page) || !is_string($key) || !is_string($order) || !is_string($lang)) {
            throw new \Exception("Invalid input type", 1);
        }
        
        $pagination = Pagination::paginate($page, $per_page);
        $sql = "SELECT t1.id AS id, t1.activity AS activity, t1.created AS created, t1.modified AS modified, t2.slug AS slug, t2.title AS title, t2.description AS description, t3.name AS type
        FROM collections t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3
                ON t1.type_id=t3.id
            WHERE t1.activity > 0
            AND t2.language=:language
            ORDER BY $key $order
            LIMIT $pagination->offset,$pagination->limit";
        $result = $this->db->run($sql, array('item_name' => 'collection', 'language' => $lang));
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
    public function findByType($type, $page = 1, $per_page = 12, $key = 'type', $order = 'desc', $lang = 'pt-br')
    {
        if (!is_string($type) || !is_int($page) || !is_int($per_page) || !is_string($key) || !is_string($order) || !is_string($lang)) {
            throw new \Exception("Invalid input type", 1);
        }
        
        $pagination = Pagination::paginate($page, $per_page);
        $sql = "SELECT t1.id AS id, t1.activity AS activity, t1.created AS created, t1.modified AS modified, t2.slug AS slug, t2.title AS title, t2.description AS description, t3.name AS type
        FROM collections t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3
                ON t1.type_id=t3.id
            WHERE t3.name=:type
            AND t1.activity > 0
            AND t2.language=:language
            ORDER BY $key $order
            LIMIT $pagination->offset,$pagination->limit";
        $result = $this->db->run($sql, array('item_name' => 'collection', 'type' => $type, 'language' => $lang));
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

        $sql = "SELECT t1.id AS id, t1.activity AS activity, t1.created AS created, t1.modified AS modified, t2.slug AS slug, t2.title AS title, t2.description AS description, t3.name AS type
        FROM collections t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3
                ON t1.type_id=t3.id
            WHERE t1.id=:id
            AND t2.language=:language
            AND t1.activity > 0";
        $result = $this->db->run($sql, array('item_name' => 'collection', 'id' => $id, 'language' => $lang));
        return $result;
    }
}
