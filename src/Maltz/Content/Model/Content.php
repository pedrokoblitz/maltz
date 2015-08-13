<?php

namespace Maltz\Content\Model;

use Maltz\Mvc\DB;
use Maltz\Mvc\Model;
use Maltz\Mvc\Record;
use Maltz\Mvc\Activity;
use Maltz\Mvc\Attachment;
use Maltz\Mvc\Display;
use Maltz\Mvc\Translatable;
use Maltz\Mvc\Tree;
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

    /*
    * construtor
    *
    *
    * @param objeto DB
    *
    * return void
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

    public function insert(Record $record)
    {
        $sql = "INSERT INTO contents (type_id, parent_id, date_pub, created, modified) 
            VALUES (:type_id, :parent_id, :date_pub, NOW(), NOW())";
        $result = $this->db->run($sql, 
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

    public function show($id, $lang = 'pt-br')
    {
        if (!(int) $id || !is_string($lang)) {
            throw new \Exception("Error Processing Request", 1);
        }

        $sql = "SELECT t1.id AS id, t1.activity AS activity, t1.date_pub AS date_pub, t1.created AS created, t1.modified AS modified, t2.slug AS slug, t2.title AS title, t2.subtitle AS subtitle, t2.excerpt AS excerpt, t2.description AS description, t2.body AS body, t3.name
            FROM contents t1
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

    public function find($page = 1, $per_page = 12, $key = 'modified', $order = 'asc', $lang = 'pt-br')
    {
        if (!(int) $page || !(int) $per_page || !is_string($key) || !is_string($order) || !is_string($lang)) {
            throw new \Exception("Error Processing Request", 1);
        }

        $pagination = Pagination::paginate($page, $per_page);
        $sql = "SELECT t1.id AS id, t1.activity AS activity, t1.date_pub AS date_pub, t1.created AS created, t1.modified AS modified, t2.slug AS slug, t2.title AS title, t2.subtitle AS subtitle, t2.excerpt AS excerpt, t2.description AS description, t2.body AS body, t3.name AS type
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

    public function findByType($type, $page = 1, $per_page = 12, $key = 'modified', $order = 'asc', $lang = 'pt-br')
    {
        if (!is_string($type) || !(int) $page || !(int) $per_page || !is_string($key) || !is_string($order) || !is_string($lang)) {
            throw new \Exception("Error Processing Request", 1);
        }

        $pagination = Pagination::paginate($page, $per_page);
        $sql = "SELECT t1.id, t1.activity, t1.date_pub, t1.created, t1.modified, t2.slug, t2.title, t2.subtitle, t2.excerpt, t2.description, t2.body, t3.name
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

    public function setAsDraft($id)
    {
        if (!(int) $id) {
            throw new \Exception("Error Processing Request", 1);
        }
        return $this->setActivity($id, 3);
    }

    public function setAsPending($id)
    {
        if (!(int) $id) {
            throw new \Exception("Error Processing Request", 1);
        }
        return $this->setActivity($id, 4);
    }

    public function publish($id)
    {
        if (!(int) $id) {
            throw new \Exception("Error Processing Request", 1);
        }
        return $this->setActivity($id, 5);
    }
}
