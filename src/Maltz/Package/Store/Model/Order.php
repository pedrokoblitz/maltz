<?php

namespace Maltz\Package\Store\Model;

/*
 *
 *
 *
 * @param objeto Model
 *
 * return void
 */

class Order extends Model
{

    public function __construct($db, $cep) 
    {
        parent::__construct($db, 'order', 'orders', 'order_id');
        $this->cepLocal = $cep;
    }

    /*
     *
     *
     *
     * @param array
     *
     * return void
     */

    public function insert($post) 
    {
        $data = $this->db->insert($this->table, $post);
        return $data;
    }

    /*
     *
     *
     *
     * 
     *
     * 
     */

    public function orderDetail($order_id) 
    {
        $sql = "SELECT * FROM itens INNER JOIN products ON products.product_id=itens.product_id WHERE itens.order_id=:order_id";
        $itens = $this->db->run($sql, array('order_id' => $order_id));
        $this->setDado('itens', $itens);

        $sql = "SELECT * FROM orders WHERE order_id=:order_id";
        $order = $this->db->run($sql, array('order_id' => $order_id));

        $sql = "SELECT * FROM customers WHERE customer_id=:customer_id";
        $customer = $this->db->run($sql, array('customer_id' => $order[0]['customer_id']));

        $data = array('customer' => $customer[0], 'order' => $order[0]);
        return $data;
    }

    public function getProducts($order_id) 
    {
        $sql = "SELECT product_id FROM itens WHERE order_id=:order_id";

        $itens = $this->db->run($sql, array('order_id' => $order_id));

        $list = implode(',', $itens);
        $sql = "SELECT * FROM products WHERE product_id IN ($list)";
        $products = $this->db->run($sql);

        return $products;
    }

}

?>
