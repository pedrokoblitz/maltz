<?php

class StorePanel {

    private $db;
    private $data;

    public function __construct($db) {
        $this->db = $db;
    }

    public function carregar() {

        // contagens de cada component
        $orders = new Order($this->db);
        $pages = new Page($this->db);
        $products = new Product($this->db);
        $photos = new Photo($this->db);
        $albums = new Album($this->db);
        $customers = new Cliente($this->db);
        $categorias = new Categoria($this->db);



        // ultimas 5 entradas do Log
        $log = new Log($this->db);
        $log->index(5, 1, "", array('created', 'DESC'));
        $this->data = array(
            'log' => $log->all(),
            'nums' => array(
                'products' => $products->count(),
                'pages' => $pages->count(),
                'orders' => $orders->count(),
                'photos' => $photos->count(),
                'albums' => $albums->count(),
                'customers' => $customers->count(),
                'categorias' => $categorias->count()
            )
        );
    }

    public function render() {
        $this->carregar();
        $this->view->set('data', array('content' => $this->data));
        return html('admin/panel.tpl.php', 'layouts/admin.layout.tpl.php');
    }

}

?>
