<?php

namespace Maltz\Store\Model;

use Maltz\Mvc\Model;

class Store extends Model
{

    private $product;
    private $content;
    private $db;

    /**
     * [__construct description]
     * @param [type] $db
     */
    public function __construct(DB $db) 
    {
        $this->db = $db;
    }

    /**
     * [setDestaques description]
     * @param [type] $num
     */
    public function setDestaques($num) 
    {
        $sql = "SELECT * FROM products WHERE activity = 1 ORDER BY created DESC LIMIT 0,{$num}";
        $products = $this->db->run($sql);
        $data = array();
        foreach ($products as $product) {
            $sql = "SELECT * FROM photos WHERE product_id = " . $product['id'] . " ORDER BY created DESC";
            $photos = $this->db->run($sql);
            $product['photos'] = $photos;
            $data[] = $product;
        }
        return $data;
    }

    /**
     * [setEspeciais description]
     * @param [type] $num
     */
    public function setEspeciais($num) 
    {
        $sql = "SELECT * FROM products WHERE activity = 1 ORDER BY created DESC LIMIT 0,{$num}";
        $products = $this->db->run($sql);
        $data = array();
        foreach ($products as $product) {
            $sql = "SELECT * FROM photos WHERE id = " . $product['product_id'];
            $photos = $this->db->run($sql);
            $product['photos'] = $photos;
            $data[] = $product;
        }
        return $data;
    }

    /**
     * [setNovos description]
     * @param [type] $num
     */
    public function setNovos($num) 
    {
        $sql = "SELECT * FROM products WHERE activity = 1 ORDER BY created DESC LIMIT 0,$num";
        $products = $this->db->run($sql);
        $data = array();
        foreach ($products as $product) {
            $sql = "SELECT * FROM photos WHERE product_id = " . $product['product_id'];
            $photos = $this->db->run($sql);
            $product['photos'] = $photos;
            $data[] = $product;
        }
        return $data;
    }
}

?>
