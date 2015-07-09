<?php

namespace Maltz\Media\Model;

use Maltz\Mvc\Model;
use Maltz\Utils\Pagination;

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
     *
     * mostra photos da album
     *
     * @param $id int id da album
     *
     * return void
     */

    public function itemsCollection($id)
    {
        if (!intval($id)) {
            throw new \Exception("Error Processing Request", 1);
        }

        $sql = "SELECT a.id, a.title, a.name, a.extension, fg.order FROM files a INNER JOIN photos_albums fg ON a.id = fg.file_id INNER JOIN albums g ON fg.album_id = g.id where g.id = " . $id;
        $r = $this->db->run($sql);
        if ($r) {
            $ordenada = $this->sort($r, 'order');
            return $ordenada;
        }
    }

    /*
     * list collections
     *
     *
     * @param perpage int
     * @param page int
     * @param onte string
     * @param order array
     * @param activity bool
     *
     * return void
     */
    public function index($perpage = 12, $page = 1, $where = "", $order = array('created', 'DESC'), $activity = false)
    {
        $registros = $this->count();
        $pagination = Pagination::pager($registros, $perpage, $page);
        $data = $this->db->select(
            $this->table,
            $where,
            array($pagination->offset, $pagination->limit),
            $order,
            '',
            '*',
            $activity
        );

        $gals = array();

        if (!$data) {
            return false;
        }

        foreach ($data as $collection) {
            $items = $this->itemsCollection($collection['id']);
            $collection['items'] = $items;
            $gals[] = $collection;
        }

        $this->set('data.list', $gals);
        $this->set('pagination.pages', $pagination->num_pages);
        return true;
    }

    /*
     * modifica o registro na table collections,
     * reconstroi as relactions da table items_collections
     * e insere news relactions.
     *
     * @param array
     * @param int
     *
     * return void
     */
    public function updateCollection($post, $id)
    {
        $items = $post['collection.items'];
        unset($post['collection.items']);

        $this->db->delete('items_collections', 'collection_id=' . $id);
        $this->db->update('collections', $post, $this->getFk() . "=" . $id);

        foreach ($items as $photo) {
            $this->db->insert('items_collections', array('photo_id' => $photo, 'collection_id' => $id));
        }

        $this->set('data.update', $id);
    }

    /*
     *
     * seleciona collections
     * consulta table de relacionamento items_collections
     * e chama todas as items da table items
     *
     * @param int
     *
     * return void ou bool
     */

    public function show($id, $activity = false, $admin = true)
    {
        $data = $this->db->select(
            $this->table,
            "id=" . $id,
            '',
            '',
            '',
            '*',
            $activity
        );

        $data = $data[0];

        $items = $this->items();
        $itemsCollection = $this->itemsCollection($id);

        if ($admin) {
            $data['items'] = $items;
        }

        $data['collection.items'] = $itemsCollection;
        $this->set('data.record', $data);
    }
}
