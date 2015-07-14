<?php

namespace Maltz\Content\Model;

use Maltz\Mvc\Model;
use Maltz\Mvc\Record;
use Maltz\Mvc\Activity;
use Maltz\Mvc\Translatable;
use Maltz\Service\Pagination;
use Maltz\Mvc\HierarchyTree;

class Term extends Model
{
    use Activity;
    use Translatable;
    use HierarchyTree;

    public function __construct($db)
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
        $sql = "INSERT INTO terms (type_id, name, created, modified)
            VALUES (:type_id, :name, NOW(), NOW())";
        $resultado = $this->db->run($sql, array('type_id' => $record->get('type_id'), 'name' => $record->get('name')));
        $record->remove('type_id');
        $record->remove('name');

        $sql = "INSERT INTO translations (user_id, language, item_name, item_id, slug, title)
            VALUES (:user_id, :language, :item_name, LAST_INSERT_ID(), :slug, :title)";
        $resultado = $this->db->run($sql, $record->toArray());
        return $resultado;
    }

    public function update(Record $record)
    {
        $sql = "UPDATE terms SET modified=NOW() WHERE id=:id";
        $resultado = $this->db->run($sql, array('id' => $record->get('id')));
        $sql = "UPDATE translations SET user_id=:user_id, lang=:lang, slug=:slug, title=:title
            WHERE item_id=:id AND item_name=:item_name";
        $resultado = $this->db->run($sql, $record->toArray());
        return $resultado;
    }

    public function display($key='type', $order='asc') 
    {
        $sql = "SELECT t1.id AS id, t1.parent_id AS parent_id, t1.name AS name, t1.value AS value, t3.name AS type 
        FROM terms t1 
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3 
                ON t1.type_id=t3.id 
            ORDER BY $key $order";
        $resultado = $this->db->run($sql, array('item_name' => $item_name));
        return $resultado;
    }

    public function find($page=1, $per_page=12, $key='type', $order='desc') 
    {
        $pagination = Pagination::paginate($page, $per_page);

        $sql = "SELECT t1.id AS id, t1.parent_id AS parent_id, t1.name AS name, t1.value AS value, t3.name AS type 
        FROM terms t1 
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3 
                ON t1.type_id=t3.id 
            ORDER BY $key $order
            LIMIT $pagination->offset,$pagination->limit";
        $resultado = $this->db->run($sql, array('item_name' => $item_name, ));
        return $resultado;
    }

    public function findByType(type, $page=1, $per_page=12, $key='name', $order='asc') 
    {
        $pagination = Pagination::paginate($page, $per_page);

        $sql = "SELECT t1.id AS id, t1.parent_id AS parent_id, t1.name AS name, t1.value AS value, t3.name AS type 
        FROM terms t1 
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3 
                ON t1.type_id=t3.id 
            WHERE t3.name=:type
            ORDER BY $key $order
            LIMIT $pagination->offset,$pagination->limit";
        $resultado = $this->db->run($sql, array('type' => $type, ));
        return $resultado;
    }

    public function show($id)
    {
        $sql = "SELECT t1.id AS id, t1.parent_id AS parent_id, t1.name AS name, t1.value AS value, t2.name AS type 
        FROM terms t1 
            JOIN translations t2 
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3 
                ON t1.type_id=t3.id
            WHERE t1.id=:id";
        $resultado = $this->db->run($sql, array('id' => $id, 'item_name' => 'term'));
        return $resultado;
    }

    /*
     * RELATIONSHIPS
     */

    public function loadTypes()
    {
        $sql = "SELECT id, name FROM types WHERE item_name=:item_name;";
        $resultado = $this->db->run($sql, array('item_name' => 'term'));
        return $resultado;
    }

    public function getByType($type)
    {
        $sql = "SELECT t1.id AS id, t1.parent_id AS parent_id, t1.name AS name, t1.value AS value, t2.name AS type 
        FROM terms t1 
            JOIN types t2 
                ON t1.type_id=t2.id 
            WHERE type=:type";
        $resultado = $this->db->run($sql, array($type));
        return $resultado;
    }

    public function getByName($name)
    {
        $sql = "SELECT t1.id AS id, t1.parent_id AS parent_id, t1.name AS name, t1.value AS value, t2.name AS type 
        FROM terms t1 
            JOIN types t2 
                ON t1.type_id=t2.id 
            WHERE name=:name";
        $resultado = $this->db->run($sql, array($name));
        return $resultado;
    }

    public function getByValue($value)
    {
        $sql = "SELECT t1.id AS id, t1.parent_id AS parent_id, t1.name AS name, t1.value AS value, t2.name AS type 
        FROM terms t1 
            JOIN types t2 
                ON t1.type_id=t2.id 
            WHERE value=:value";
        $resultado = $this->db->run($sql, array($value));
        return $resultado;
    }
}
