<?php

namespace Maltz\Package\Content\Model;

use Maltz\Mvc\DB;
use Maltz\Mvc\Model;
use Maltz\Mvc\Record;
use Maltz\Mvc\ModelFeature\Activity;
use Maltz\Mvc\ModelFeature\Attachment;
use Maltz\Mvc\ModelFeature\Display;
use Maltz\Mvc\ModelFeature\Translatable;
use Maltz\Mvc\ModelFeature\Tree;
use Maltz\Service\Pagination;

/**
 * db de conteúdo dinamico com
 *  - album
 *  - pdf
 *  - categoria/type
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

class Content extends Model
{
    use Activity;
    use Attachment;
    use Display;
    use Translatable;
    use Tree;

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
            'date_pub' => 'datetime',
            'user_id' => 'int',
            'slug' => 'slug',
            'title' => 'string',
            'subtitle' => 'string',
            'excerpt' => 'textarea',
            'description' => 'textarea',
            'body' => 'textarea',
            'language' => 'string',
            );
        parent::__construct($db, 'content', 'contents', $rules);
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
        $sql = "INSERT INTO contents (type_id, parent_id, date_pub, created, modified) 
            VALUES (:type_id, :parent_id, :date_pub, NOW(), NOW())";
        $result = $this->db->run(
            $sql,
            array(
                'type_id' => $record->get('type_id'),
                'parent_id' => $record->get('parent_id'),
                'date_pub' => $record->get('date_pub')
                )
        );
        $record->remove('type_id');
        $record->remove('parent_id');
        $record->remove('date_pub');
        $record->set('item_name', 'content');
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
        $sql = "UPDATE contents SET date_pub=:date_pub, parent_id=:parent_id, modified=NOW() WHERE id=:id";
        $result = $this->db->run($sql, array('id' => $id, 'parent_id' => $record->get('parent_id')));
        $record->remove('date_pub');
        $record->remove('parent_id');
        $values = $record->getUpdateValueString();
        $sql = "UPDATE translations 
        SET $values
        WHERE item_id=:id 
          AND language=:language
          AND item_name=:item_name";
        $record->set('language', $language);
        $record->set('id', $id);
        $record->set('item_name', 'content');
        $result = $this->db->run($sql, $record->toArray());
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

        $sql = "SELECT t1.id, t1.activity, t1.date_pub, t1.created, t1.modified, t2.slug, t2.title, t2.subtitle, t2.excerpt, t2., t2.body, t3.name AS type FROM contents t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3
                ON t1.type_id=t3.id
            WHERE t1.id=:id
            AND t2.language=:lang";
        $result = $this->db->run($sql, array('id' => $id, 'item_name' => 'content', 'lang' => $lang));
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
    public function find($page = 1, $per_page = 12, $key = 'modified', $order = 'asc', $lang = 'pt-br')
    {
        if (!is_int($page) || !is_int($per_page) || !is_string($key) || !is_string($order) || !is_string($lang)) {
            throw new \Exception("Invalid input type", 1);
        }

        $pagination = Pagination::paginate($page, $per_page);
        $sql = "SELECT t1.id, t1.activity, t1.date_pub, t1.created, t1.modified, t2.slug, t2.title, t2.subtitle, t2.excerpt, t2.description, t2.body, t3.name AS type
            FROM contents t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3
                ON t1.type_id=t3.id
            WHERE t1.activity > 0
            AND t2.language=:lang
            ORDER BY $key $order
            LIMIT $pagination->offset,$pagination->limit";
        $result = $this->db->run($sql, array('item_name' => 'content', 'lang' => $lang));
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
    public function findByType($type, $page = 1, $per_page = 12, $key = 'modified', $order = 'asc', $lang = 'pt-br')
    {
        if (!is_string($type) || !is_int($page) || !is_int($per_page) || !is_string($key) || !is_string($order) || !is_string($lang)) {
            throw new \Exception("Invalid input type", 1);
        }

        $pagination = Pagination::paginate($page, $per_page);
        $sql = "SELECT t1.id, t1.activity, t1.date_pub, t1.created, t1.modified, t2.slug, t2.title, t2.subtitle, t2.excerpt, t2.description, t2.body, t3.name AS type
            FROM contents t1
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
        $result = $this->db->run($sql, array('type' => $type, 'item_name' => 'content', 'lang' => $lang));
        return $result;
    }

    /**
     * /
     * @param [type] $id [description]
     */
    public function setAsDraft($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Invalid input type", 1);
        }
        return $this->setActivity($id, 3);
    }

    /**
     * /
     * @param [type] $id [description]
     */
    public function setAsPending($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Invalid input type", 1);
        }
        return $this->setActivity($id, 4);
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function publish($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Invalid input type", 1);
        }
        return $this->setActivity($id, 5);
    }
}
