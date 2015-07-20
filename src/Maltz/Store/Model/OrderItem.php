<?php

namespace Maltz\Store\Model;

use Maltz\Mvc\Model;

/*
 *
 *
 *
 * @param
 *
 * return
 */

class OrderItemOrder extends Model {

    public function __construct(DB $db) {
        parent::__construct($db, 'order_item', 'order_items', 'order_items_id');
    }

    /*
     *
     *
     *
     * @param array
     *
     * return void
     */
    public function index($perpage = 12, $page = 1) {
        $registros = $this->count();
        $pagination = Pagination::pager($registros, $perpage, $page);
        $sql = "SELECT * FROM customers WHERE id IN (SELECT customer_id FROM orders LIMIT " . $pagination->offset . "," . $pagination->limit . ")";
        $data = $this->db->run($sql);
        return $data;
    }
}

?>
