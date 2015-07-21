<?php

namespace Maltz\Content\Model;

use Maltz\Mvc\DB;
use Maltz\Mvc\Model;
use Maltz\Mvc\Record;
use Maltz\Mvc\Activity;
use Maltz\Mvc\Translatable;
use Maltz\Service\Pagination;
use Maltz\Mvc\Tree;

class Term extends Model
{
    use Activity;
    use Translatable;
    use Tree;

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
            'language' => 'string',
            );
        parent::__construct($db, 'term', 'terms', $rules);
    }

    /*
     * CRUD
     */

    public function insert(Record $record)
    {
        $sql = "INSERT INTO terms (type_id, parent_id)
            VALUES (:type_id, :parent_id)";
        $result = $this->db->run($sql, array('type_id' => $record->get('type_id'), 'parent_id' => $record->get('parent_id')));
        $record->remove('type_id');
        $record->remove('parent_id');
        $record->set('item_name', 'term');
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
        $sql = "UPDATE terms SET parent_id=:parent_id WHERE id=:id";
        $result = $this->db->run($sql, array('id' => $id, 'parent_id' => $record->get('parent_id')));
        $record->remove('type_id');
        $record->remove('parent_id');
        $values = $record->getUpdateValueString();
        $sql = "UPDATE translations SET $values
            WHERE item_id=:id 
                AND language=:language
                AND item_name=:item_name";
        $record->set('language', $language);
        $record->set('item_name', 'term');
        $record->set('id', $id);
        $result = $this->db->run($sql, $record->toArray());
        return $result;
    }

    public function display($key = 'type', $order = 'asc', $lang = 'pt-br')
    {
        if (!is_string($key) || !is_string($order) || !is_string($lang)) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $sql = "SELECT t1.id AS id, t1.parent_id AS parent_id, t1.name AS name, t1.value AS value, t3.name AS type 
        FROM terms t1 
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3 
                ON t1.type_id=t3.id 
            WHERE t1.activity > 0
            AND t2.language=:lang
            ORDER BY $key $order";
        $result = $this->db->run($sql, array('item_name' => $item_name, 'lang' => $lang));
        return $result;
    }

    public function find($page = 1, $per_page = 12, $key = 'type', $order = 'desc', $lang = 'pt-br')
    {
        if (!(int) $page || !(int) $per_page || !is_string($key) || !is_string($order) || !is_string($lang)) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $pagination = Pagination::paginate($page, $per_page);
        $sql = "SELECT t1.id AS id, t1.parent_id AS parent_id, t1.name AS name, t1.value AS value, t3.name AS type 
        FROM terms t1 
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3 
                ON t1.type_id=t3.id 
            WHERE t1.activity > 0
            AND t2.language=:language
            ORDER BY $key $order
            LIMIT $pagination->offset,$pagination->limit";
        $result = $this->db->run($sql, array('item_name' => $item_name, 'language' => $lang));
        return $result;
    }

    public function findByType($type, $page = 1, $per_page = 12, $key = 'name', $order = 'asc', $lang = 'pt-br')
    {
        if (!is_string($type) || !(int) $page || !(int) $per_page || !is_string($key) || !is_string($order) || !is_string($lang)) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $pagination = Pagination::paginate($page, $per_page);
        $sql = "SELECT t1.id AS id, t1.parent_id AS parent_id, t1.name AS name, t1.value AS value, t3.name AS type 
        FROM terms t1 
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3 
                ON t1.type_id=t3.id 
            WHERE t3.name=:type
            AND t1.activity > 0
            AND t2.language=:lang
            ORDER BY $key $order
            LIMIT $pagination->offset,$pagination->limit";
        $result = $this->db->run($sql, array('type' => $type, 'lang' => $lang));
        return $result;
    }

    public function show($id, $lang = 'pt-br')
    {
        if (!(int) $id || !is_string($lang)) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $sql = "SELECT t1.id AS id, t1.parent_id AS parent_id, t1.name AS name, t1.value AS value, t2.name AS type 
        FROM terms t1 
            JOIN translations t2 
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3 
                ON t1.type_id=t3.id
            WHERE t1.id=:id
        AND t2.language=:lang
        AND t1.activity > 0";
        $result = $this->db->run($sql, array('id' => $id, 'item_name' => 'term', 'lang' => $lang));
        return $result;
    }
}
