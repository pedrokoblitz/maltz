<?php

namespace Maltz\Store\Model;

use Maltz\Mvc\Model;

/*
 *
 *
 *
 * @param objeto Model
 *
 * return void
 */

class Product extends Model
{

    protected $userId;

    public function __construct($db)
    {
        
        if (isset($app->session->get('user.id'))) {
            $this->userId = $app->session->get('user.id');
        }
        
        parent::__construct($db, 'product', 'products', 'product_id');
    }

    /*
     *
     *
     *
     * @param array
     *
     * return void
     */

    public function insert($estrutura)
    {
        
        $data = $this->db->insert($this->table, $this->estrutura);
        return $data;
    }

    /*
     * modifica o registro na table albums,
     * reconstroi as relactions da table photos_albums
     * e insere news relactions.
     *
     * @param array
     * @param int
     *
     * return void
     */

    public function update($post, $id)
    {
        
        $photos = $post['urls'];
        unset($post['urls']);
        $where = "id=" . $id;

        if ($post['destaque'] == 1 && $post['especial'] == 1) {
            $post['especial'] = 0;
        }

        $this->db->update('products', $post, $where);
        
        foreach ($photos as $item) {
            $photo = array();
            $photo['url'] = $item;
            $photo['product_id'] = $id;
            $this->db->insert('photos', $photo);
        }
    }

    /*
     *
     * seleciona albums 
     * consulta table de relacionamento photos_albums
     * e chama todas as photos da table photos
     *
     * @param int
     *
     * return void ou bool
     */

    public function findWithPhotos($pp, $page)
    {
        
        $registros = $this->count();
        $pagination = Pagination::pager($registros, $pp, $page);
        $sql = "SELECT * FROM products ORDER BY created DESC LIMIT " . $pagination->offset . ", " . $pagination->limit;
        $data = $this->db->run($sql);
        $products = array();
        
        foreach ($data as $data) {
            $sql = "SELECT * FROM photos WHERE product_id = " . $data['product_id'];
            $photos = $this->db->run($sql);
            $data['photos'] = $photos;
            $products[] = $data;
        }
        
        $pages = $pagination->num_pages;
        return $products;
    }

    /*
     *
     * seleciona albums 
     * consulta table de relacionamento photos_albums
     * e chama todas as photos da table photos
     *
     * @param int
     *
     * return void ou bool
     */

    public function show($id)
    {
        
        $data = $this->db->select('products', $this->pk . "=" . $id);
        $this->setData($data);

        $sql = "SELECT * FROM photos WHERE product_id = :id";
        $bind = array('id' => $id);
        $data = $this->db->run($sql, $bind);
        return $data;
    }

    /*
     * 
     * apaga a album e todos os registros
     * na table de relacionamento photos_albums
     *
     * @param int
     *
     * return bool
     */

    public function delete($id)
    {
        
        $this->db->delete('products', $this->pk . "=" . $id);
        $model = $this->db;

        $data = $model->run("DELETE FROM photos WHERE product_id = :id", array(':id', $id));
        return $data;
    }

    /*
     * search AJAX
     * search o product na base de data e retorna diretamente os resultadoados em JSON
     *
     *
     *
     */

    public function search($string)
    {

        $sql = "SELECT id, title, description, preco, substring(descricao, case when locate('$string', lower(descricao)) <= 20 then 1 else locate('$string', lower(descricao)) - 20 end, case when locate('$string', lower(descricao)) + 20 > length(descricao) then length(descricao) else locate('$string', lower(descricao)) + 20 end) FROM products WHERE lower(descricao) LIKE '%$string%' OR title LIKE '%$string%' AND activity=1 LIMIT 0,5;";

        $data = $this->db->run($sql);

        $resultadoados = array();
        
        foreach ($data as $data) {
            $sql = "SELECT * FROM photos WHERE product_id = :id";
            $bind = array('id' => $data['product_id']);
            $photos = $this->db->run($sql, $bind);
            $data['photos'] = $photos;
            $resultadoados[] = $data;
        }
        
        return $resultadoados;
    }
}
