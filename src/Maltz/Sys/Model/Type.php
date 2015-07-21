<?php

namespace Maltz\Sys\Model;

use Maltz\Mvc\Model;
use Maltz\Mvc\Record;
use Maltz\Service\Pagination;

class Type extends Model
{
    public function __construct(DB $db)
    {
        $rules = array(
            'id' => 'int',
            'item_name' => 'string',
            'name' => 'string',
            'title' => 'string',
            'lang' => 'string',
            );
        parent::__construct($db, 'type', 'types', $rules);
    }

    /*
     * CRUD
     */

    public function display($key = 'name', $order = 'asc', $lang = 'pt-br')
    {
        if (!is_string($key) || !is_string($order) || !is_string($lang)) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $sql = "SELECT t1.id, t1.item_name, t1.name, t2.slug, t2.title
            FROM types t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            WHERE t2.language=:lang
            ORDER BY $key $order";
        $result = $this->db->run($sql, array('item_name' => 'type', 'lang' => $lang));
        return $result;
    }

    public function find($page = 1, $per_page = 12, $key = 'name', $order = 'asc', $lang = 'pt-br')
    {
        if (!(int) $page || !(int) $per_page || !is_string($key) || !is_string($order) || !is_string($lang)) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $pagination = Pagination::paginate($page, $per_page);
        $sql = "SELECT t1.id, t1.item_name, t1.name, t2.slug, t2.title
            FROM types t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            WHERE t2.language=:lang
            ORDER By $key $order
            LIMIT $pagination->offset,$pagination->limit";
        $result = $this->db->run($sql, array('item_name' => 'type', 'lang' => $lang));
        return $result;
    }

    public function show($id, $lang = 'pt-br')
    {
        if (!(int) $id || !is_string($lang)) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $sql = "SELECT t1.id, t1.item_name, t1.name, t2.slug, t2.title
            FROM types t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            WHERE t1.id=:id
            AND t2.language=:lang
            ORDER By $key $order";
        $result = $this->db->run($sql, array('id' => $id, 'lang' => $lang));
        return $result;
    }

    public function insert(Record $record)
    {
        $sql = "INSERT INTO types (name, item_name)
            VALUES (:name, :item_name)";
        $result = $this->db->run($sql, array('item_name' => $record->get('item_name'), 'name' => $record->get('name')));
        $record->remove('item_name');
        $record->remove('name');

        $sql = "INSERT INTO translations (user_id, language, item_name, item_id, slug, title)
            VALUES (:user_id, :language, :item_name, LAST_INSERT_ID(), :slug, :title)";
        $result = $this->db->run($sql, $record->toArray());
        return $result;
    }

    public function update(Record $record)
    {
        $sql = "UPDATE types SET name=:name, item_name=:item_name WHERE id=:id";
        $result = $this->db->run($sql, array('id' => $record->get('id')));
        $sql = "UPDATE translations SET user_id=:user_id, lang=:lang, slug=:slug, title=:title
            WHERE item_id=:id AND item_name=:item_name";
        $result = $this->db->run($sql, $record->toArray());
        return $result;

    }

    public function delete($id)
    {
        if (!(int) $id) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $sql = "DELETE FROM types WHERE id=:id";
        $result = $this->db->run($sql, array('id' => $id));
        return $result;
    }
}
