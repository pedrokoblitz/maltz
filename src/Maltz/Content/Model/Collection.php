<?php

namespace Maltz\Content\Model;

use Maltz\Mvc\Model;
use Maltz\Mvc\Record;
use Maltz\Mvc\Activity;
use Maltz\Mvc\Translatable;
use Maltz\Mvc\ItemRelationships;
use Maltz\Mvc\Hierarchy;
use Maltz\Service\Pagination;

/**
 * db de collection pertencente a
 *  - pages
 *  - contents
 *  - books
 *
 * http://ideiasinsolitas.com.br/
 *
 * @copyright  Copyright (c) 2012-2013 Pedro Koblitz
 * @author      Pedro Koblitz pedrokoblitz@gmail.com
 * @license    GPL v2
 *
 * @package    Maltz
 *
 * @version    0.1 alpha
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
    use Activity;
    use Translatable;
    use ItemRelationships;
    //use Hierarchy;
        
    /*
     * construtor
     *
     *
     * @param db objeto DB
     *
     * return void
     */

    public function __construct($db)
    {
        parent::__construct($db, 'collection', 'collections', 'collection_id');
    }

    /*
     * CRUD
     */

    public function insert(Record $record) 
    {
        $sql = "INSERT INTO collections (type_id, created, modified)
            VALUES (:type_id, NOW(), NOW())";
        $resultado = $this->db->run($sql, array('type_id' => $record->get('type_id')));
        $record->remove('type_id');

        $sql = "INSERT INTO translations (user_id, language, item_name, item_id, slug, name, title, description)
            VALUES (:user_id, :language, :item_name, LAST_INSERT_ID(), :slug, :name, :title, :description)";
        $resultado = $this->db->run($sql, $record->toArray());
        return $resultado;
    }

    public function update(Record $record) 
    {
        $sql = "UPDATE collections SET modified=NOW() WHERE id=:id";
        $resultado = $this->db->run($sql, array('id' => $record->get('id')));
        $sql = "UPDATE translations SET user_id=:user_id, lang=:lang, slug=:slug, name=:name, title=:title, description=:description
            WHERE item_id=:id AND item_name=:item_name";
        $resultado = $this->db->run($sql, $record->toArray());
        return $resultado;
    }

    public function display($key='title', $order='asc') 
    {
        $sql = "SELECT t1.id AS id, t1.activity AS activity, t1.created AS created, t1.modified AS modified, t2.slug AS slug, t2.title AS title, t2.description AS description, t3.name AS type
        FROM collections t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3
                ON t1.type_id=t3.id
            ORDER BY $key $order";
        $resultado = $this->db->run($sql, array('item_name' => 'collection'));
        return $resultado;
    }

    public function find($page=1, $per_page=12, $key='modified', $order='desc') 
    {
        $pagination = Pagination::paginate($page, $per_page);

        $sql = "SELECT t1.id AS id, t1.activity AS activity, t1.created AS created, t1.modified AS modified, t2.slug AS slug, t2.title AS title, t2.description AS description, t3.name AS type
        FROM collections t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3
                ON t1.type_id=t3.id
            ORDER BY $key $order
            LIMIT $pagination->offset,$pagination->limit";
        $resultado = $this->db->run($sql, array('item_name' => 'collection', ));
        return $resultado;
    }

    public function findByType($type, $page=1, $per_page=12, $key='modified', $order='desc') 
    {
        $pagination = Pagination::paginate($page, $per_page);

        $sql = "SELECT t1.id AS id, t1.activity AS activity, t1.created AS created, t1.modified AS modified, t2.slug AS slug, t2.title AS title, t2.description AS description, t3.name AS type
        FROM collections t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3
                ON t1.type_id=t3.id
            WHERE t3.name=:type
            ORDER BY $key $order
            LIMIT $pagination->offset,$pagination->limit";
        $resultado = $this->db->run($sql, array('item_name' => 'collection', 'type' => $type));
        return $resultado;
    }

    public function show($id) 
    {
        $sql = "SELECT t1.id AS id, t1.activity AS activity, t1.created AS created, t1.modified AS modified, t2.slug AS slug, t2.title AS title, t2.description AS description, t3.name AS type
        FROM collections t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3
                ON t1.type_id=t3.id
            WHERE t1.id=:id";
        $resultado = $this->db->run($sql, array('item_name' => 'collection', 'id' => $id));
        return $resultado;
    }
}
