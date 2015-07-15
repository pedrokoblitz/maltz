<?php

namespace Maltz\Content\Model;

use Maltz\Mvc\Model;
use Maltz\Mvc\Record;
use Maltz\Mvc\Activity;
use Maltz\Mvc\Tree;
use Maltz\Mvc\Translatable;
use Maltz\Mvc\ItemRelationships;
use Maltz\Service\Pagination;

/**
 * db de conteúdo dinamico com
 *  - album
 *  - pdf
 *  - categoria/type
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

class Content extends Model
{
    use Activity;
    use Translatable;
    use ItemRelationships;
    use Tree;
    /*
	 * construtor
	 *
	 *
	 * @param objeto DB
	 *
	 * return void
	 */

    public function __construct($db)
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

    public function insert(Record $record) {
        $sql = "INSERT INTO contents (type_id, date_pub, created, modified) 
            VALUES (:type_id, :date_pub, NOW(), NOW())";
        $resultado = $this->db->run($sql, array('type_id' => $record->get('type_id'), 'date_pub' => $record->get('date_pub')));
        $record->remove('type_id');
        $record->remove('date_pub');

        $sql = "INSERT INTO translations (user_id, language, item_name, item_id, slug, name, title, subtitle, excerpt, description, body) 
            VALUES (:user_id, :language, :item_name, LAST_INSERT_ID(), :slug, :name, :title, :subtitle, :excerpt, :description, :body)";
        $resultado = $this->db->run($sql, $record->toArray());
        return $resultado;
    }


    public function update(Record $record) {
        $sql = "UPDATE contents SET modified=NOW() WHERE id=:id";
        $resultado = $this->db->run($sql, array('id' => $record->get('id')));
        $sql = "UPDATE translations 
        SET user_id=:user_id, lang=:lang, slug=:slug, name=:name, title=:title, subtitle=:subtitle, excerpt=:excerpt, description=:description, body=:body
        WHERE item_id=:id 
          AND item_name=:item_name";
        $resultado = $this->db->run($sql, $record->toArray());
        return $resultado;
    }

    public function show($id, $lang='pt-br') 
    {
        $sql = "SELECT t1.id AS id, t1.activity AS activity, t1.date_pub AS date_pub, t1.created AS created, t1.modified AS modified, t2.slug AS slug, t2.title AS title, t2.subtitle AS subtitle, t2.excerpt AS excerpt, t2.description AS description, t2.body AS body, t3.name
            FROM contents t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3
                ON t1.type_id=t3.id
            WHERE t1.id=:id
            AND t2.language=:lang
            AND t1.activity > 0";
        $resultado = $this->db->run($sql, array('id' => $id, 'item_name' => 'content', 'lang' => $lang));
        return $resultado;
    }

    public function find($page=1, $per_page=12, $key='modified', $order='asc', $lang='pt-br') 
    {
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
        $resultado = $this->db->run($sql, array('item_name' => 'content', 'lang' => $lang));
        return $resultado;
    }

    public function findByType($type, $page=1, $per_page=12, $key='modified', $order='asc', $lang='pt-br') 
    {
        $pagination = Pagination::paginate($page, $per_page);

        $sql = "SELECT t1.id AS id, t1.activity AS activity, t1.date_pub AS date_pub, t1.created AS created, t1.modified AS modified, t2.slug AS slug, t2.title AS title, t2.subtitle AS subtitle, t2.excerpt AS excerpt, t2.description AS description, t2.body AS body, t3.name AS type
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
        $resultado = $this->db->run($sql, array('type' => $type, 'item_name' => 'content', 'lang' => $lang));
        return $resultado;
    }
}
