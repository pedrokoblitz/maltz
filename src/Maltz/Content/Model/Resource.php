<?php

namespace Maltz\Content\Model;

use Maltz\Mvc\Model;
use Maltz\Mvc\Record;
use Maltz\Mvc\Activity;
use Maltz\Mvc\Translatable;
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
            );
        parent::__construct($db, 'resource', 'resources', $rules);
    }

    /*
     * CRUD
     */

    public function insert(Record $record)
    {
        $sql = "INSERT INTO resources (type_id, url, filepath, filename, extension, embed, created, modified) 
            VALUES (:type_id, :url, :filepath, :filename, :extension, :embed, NOW(), NOW())";
        $resultado = $this->db->run($sql, $bind);

        $sql = "INSERT INTO translations (user_id, language, item_name, item_id, slug, name, title, description) 
            VALUES (:user_id, :language, :item_name, LAST_INSERT_ID(), :slug, :name, :title, :description)";
        $resultado = $this->db->run($sql, $bind);
        return $resultado;
    }

    public function update(Record $record)
    {
        $sql = "UPDATE resources SET modified=NOW() WHERE id=:id";
        $resultado = $this->db->run($sql, array('id' => $record->get('id')));

        $sql = "UPDATE translations 
            SET user_id=:user_id, lang=:lang, slug=:slug, url=:url, extension=:extension, filename=:filename, name=:name, title=:title, description=:description
            WHERE item_id=:id 
                AND t2.language=:lang
                AND item_name=:item_name";
        $resultado = $this->db->run($sql, $bind);
        return $resultado;
    }

    public function display($key = 'title', $order = 'asc', $lang = 'pt-br')
    {
        if (!is_string($key) || !is_string($order) || !is_string($lang)) {
            throw new \Exception("Error Processing Request", 1);
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
        $resultado = $this->db->run($sql, array('item_name' => 'resource', 'lang' => $lang));
        return $resultado;
    }

    public function find($page = 1, $per_page = 12, $key = 'modified', $order = 'desc', $lang = 'pt-br')
    {
        if (!is_int($pg) || !is_int($per_page) || !is_string($key) || !is_string($order) || !is_string($lang)) {
            throw new \Exception("Error Processing Request", 1);
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
        $resultado = $this->db->run($sql, array('item_name' => 'resource', 'lang' => $lang));
        return $resultado;
    }

    public function findByType($type, $page = 1, $per_page = 12, $key = 'title', $order = 'asc', $lang = 'pt-br')
    {
        if (!is_string($type) || !is_int($pg) || !is_int($per_page) || !is_string($key) || !is_string($order) || !is_string($lang)) {
            throw new \Exception("Error Processing Request", 1);
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
        $resultado = $this->db->run($sql, array('type' => $type, 'item_name' => 'resource', 'lang' => $lang));
        return $resultado;
    }

    public function show($id, $lang = 'pt-br')
    {
        if (!is_int($id) || !is_string($lang)) {
            throw new \Exception("Error Processing Request", 1);
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
        $resultado = $this->db->run($sql, array('item_id' => $id, 'item_name' => 'resource', 'lang' => $lang));
        return $resultado;
    }
}
