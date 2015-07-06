<?php

namespace Maltz\Store\Ctrl;

class Store extends Controller {

    /**
     * [cadastro description]
     * @return [type]
     */
    public function cadastro() {
        $this->view->setTemplates('site/cadastro.form.tpl.php','layouts/site.layout.tpl.php');
        if (isset($_SESSION['message'])) {
            $data = array('message' => $_SESSION['message']);
            unset($_SESSION['message']);
            $this->view->setData($data);
        }
        return $this->view->render();
    }

    /**
     *
     *
     *
     * @param
     *
     * return
     */
    public function formContact() {
        if (isset($_SESSION['message'])) {
            $data = array('message' => $_SESSION['message']);
            set('data', $data);
            unset($_SESSION['message']);
        }
        $this->view->setTemplates('site/contact.form.tpl.php','layouts/site.layout.tpl.php');
        return $this->view->render();
    }

    /**
     *
     *
     *
     * @param
     *
     * return
     */
    public function sendContact() {
        if (!$_POST['email']) {
            $_SESSION['message'] = 'Preencha um email válido.';
            $this->app->redirect('index.php/contact');
        }

        if ($_POST['assunto'] === '' || $_POST['name'] === '' || $_POST['message'] === '') {
            $_SESSION['message'] = 'Preencha todos os campos.';
            $this->app->redirect('index.php/contact');
        }

        // $_POST
        Carteiro::send(
                $assunto = $_POST['assunto'], $body = $_POST['message'] . "\n\n" . $_POST['name'] . "\n\n" . $_POST['email'], $destino = array('atendimento@' . option('dominio') => 'Atendimento')
        );

        $_SESSION['message'] = 'Sua message foi enviada.';
        $this->app->redirect('index.php/');
    }

    /**
     *
     *
     *
     * @param
     *
     * return
     */
    public function login() {

        if (!$app->porteiro->loggedIn()) {
            if (isset($_SESSION['message'])) {
                $data = array('message' => $_SESSION['message']);
                set('data', $data);
                unset($_SESSION['message']);
            }
            $this->view->setTemplates('site/login.form.tpl.php','layouts/site.layout.tpl.php');
        } else {
            $_SESSION['message'] = 'Bem vindo!';
            $this->ap   p->redirect('index.php/');
        }
    }

    /**
     *
     *
     *
     * @param
     *
     * return
     */
    public function login() {

        $app->porteiro->login($_POST['username'], $_POST['password'], 'customer');
    }

    /**
     *
     *
     *
     * @param
     *
     * return
     */
    public function logout() {

        $app->porteiro->sair();
        $this->app->redirect('index.php/');
    }

    /*
     *
     *
     *
     * @param
     *
     * return
     */

    public function capa() {

        $capa = new Cover(option('model'));

        $capa->setDestaques(5);
        $capa->setEspeciais(3);
        $capa->setNovos(3);
        $capa->setContent();

        if (isset($_SESSION['message'])) {
            $capa->setDado('message', $_SESSION['message']);
            unset($_SESSION['message']);
        }


        $this->view->setView('site/cover.tpl.php');
        $this->view->setLayout('layouts/site.layout.tpl.php');
        return $this->view->render($capa->all());
    }

    /**
     *
     *
     *
     * @param
     *
     * return
     */
    public function showPage() {

        $id = params('id');
        $product = new Page(option('model'));
        $product->show($id);
        $this->view->setLayout('layouts/site.layout.tpl.php');
        $this->view->setView('site/page.tpl.php');

        if (isset($_SESSION['message'])) {
            $product->setDado('message', $_SESSION['message']);
            unset($_SESSION['message']);
        }

        return $this->view->render($product->all(true));
    }

    /**
     *
     *
     *
     * @param
     *
     * return
     */
    public function searchDinamica($string) {

        $product = new Product(option('model'));

        $product->search($string);

        if (isset($_SESSION['message'])) {
            $data['message'] = $_SESSION['message'];
            unset($_SESSION['message']);
        }

        $this->view->setView('site/search.tpl.php');
        return $this->view->render(true);
    }

    /**
     *
     *
     *
     * @param
     *
     * return
     */
    public function consulta() {

        $string = $_GET['string'];

        $product = new Product(option('model'));
        $product->search($string);
        $product->setDado('search', $string);

        $product->setLayout('layouts/site.layout.tpl.php');
        $product->setView('site/search.list.tpl.php');

        if (isset($_SESSION['message'])) {
            $product->setDado('message', $_SESSION['message']);
            unset($_SESSION['message']);
        }
        return $product->render(true);
    }

    /**
     *
     *
     *
     * @param
     *
     * return
     */
    public function listProductsCategoria() {
        $pg = params('pg');
        $cat = params('cat');
        $pp = option('perpage');
        $product = new Product(option('model'));

        $product->listCategoria($pp, $pg, $cat);

        if (isset($_SESSION['message'])) {
            $product->setDado('message', $_SESSION['message']);
            unset($_SESSION['message']);
        }

        $product->setLayout('layouts/site.layout.tpl.php');
        $product->setView('site/products.tpl.php');
        return $product->render(true);
    }

    /**
     *
     *
     *
     * @param
     *
     * return
     */
    public function listProducts() {
        $pg = params('pg');
        $pp = option('perpage');
        $product = new Product(option('model'));
        $product->listComPhotos($pp, $pg);
        $product->setLayout('layouts/site.layout.tpl.php');
        $product->setView('site/products.tpl.php');

        if (isset($_SESSION['message'])) {
            $product->setDado('message', $_SESSION['message']);
            unset($_SESSION['message']);
        }

        return $product->render(true);
    }

    /**
     *
     *
     *
     * @param
     *
     * return
     */
    public function showProduct() {

        $id = params('id');

        $product = new Product(option('model'));
        $product->show($id);
        $product->setLayout('layouts/site.layout.tpl.php');
        $product->setView('site/product.tpl.php');

        if (isset($_SESSION['message'])) {
            $product->setDado('message', $_SESSION['message']);
            unset($_SESSION['message']);
        }

        return $product->render(true);
    }

    /**
     *
     *
     *
     * @param
     *
     * return
     */
    public function cadastrar() {
        $_SESSION['message'] = '';

        $post = $_POST;
        if (
                !empty($post['cpf']) &&
                !empty($post['cnpj'])
        ) {
            $_SESSION['message'] = 'Preencha apenas CPF ou CNPJ.';
            $this->app->redirect('index.php/cadastro');
        }

        $c = new Cliente(option('model'));
        /* CERTIFICAR-SE DE QUE O EMAIL É ÚNICO
         */
        $c->search('email', $post['email']);
        $data = $c->all();
        if ($data) {
            $_SESSION['message'] = 'Você já está cadastrado';
            $this->app->redirect('index.php/cadastro');
        }

        /* validar username aqui */
        if (!preg_match('/^[A-Za-z0-9_]+$/', $post['username'])) {

            $_SESSION['message'] = 'O username pode conter apenas caracteres alfanuméricos e underline.';
            $this->app->redirect('index.php/cadastro');
        }

        /* CERTIFICAR-SE DE QUE O USERNAME É ÚNICO */
        $c->search('username', $post['username']);
        $data = $c->all();

        if ($data) {

            $_SESSION['message'] = 'O name de usuário "' . $post['username'] . '" não estã disponĩvel. Tente newmente.';
            $this->app->redirect('index.php/cadastro');
        }


        if (
                !empty($post['confirma']) &&
                !empty($post['password']) &&
                !empty($post['name']) &&
                !empty($post['username']) &&
                !empty($post['email'])
        ) {

            /* CERTIFICAR-SE DE QUE CPF ou CNPJ SAO VALIDOS */
            if (Val::validar_cpf($post['cpf']) || Val::validar_cnpj($post['cnpj'])) {

                $confirma = $post['confirma'];
                $password = $post['password'];
                $post['token'] = md5(time());
                unset($post['confirma']);

                if ($password === $confirma) {

                    $post['password'] = md5($password);
                    $post['activity'] = 0;

                    $customer = new Cliente(option('model'));
                    $customer->insert($post);
                    $id = $customer->all();

                    $body = "Seu email foi cadastrado em nossa loja\n";
                    $body .= "Clique no link abaixo para confirmar: \n";
                    $body .= 'http://supplymedrio.com.br/index.php/api/validar/' . $id . '/' . $post['token'] . "\n";
                    Carteiro::send('Confirmação de Cadastro', $body, array($post['email'] => $post['name']));

                    $_SESSION['message'] = 'Você recebeu um email de confirmação.';

                    Carteiro::send(
                            'Novo usuário cadastrado', 
                            'O usuário ' . $post['name'] . ' acabou de se cadastrar', 
                            $destino = array('atendimento@' . option('dominio') => 'Atendimento'),
                            $remetente = array($post['email'] => $post['name'])
                    );

                    $this->app->redirect('index.php');
                }

                $_SESSION['message'] = 'As passwords não são iguais.';
                $this->app->redirect('index.php/cadastro');
            }

            $_SESSION['message'] = 'CPF ou CNPJ inválidos';
            $this->app->redirect('index.php/cadastro');
        }

        $msg = "As seguintes informações precisam ser preenchidas:<br/>\n";
        $msg .= "<strong>name, username, email, password e confirmação</strong>.";
        $_SESSION["message"] = $msg;

        $this->app->redirect('index.php/cadastro');
    }

    /*
     *
     *
     *
     * @param
     *
     * return
     */

    public function validarUser() {
        $id = params('id');
        $token = params('token');

        $customer = new Cliente(option('model'));
        $customer->show($id);
        $data = $customer->all();

        if (isset($data['password']))
            unset($data['password']);

        if ((int) $data['token'] == (int) $token) {

            $customer->update(array('activity' => 1, 'token' => ''), $id);

            $_SESSION['autenticado'] = true;
            $_SESSION['customer'] = $data;
            $_SESSION['message'] = 'Usuário validado com sucesso.';
            $this->app->redirect('index.php');
        } elseif (empty($data['token'])) {

            $_SESSION['message'] = 'Sua key já foi validada';
            $this->app->redirect('index.php');
        } else {

            $_SESSION['message'] = 'Sua key é invalida. Cadastre-se newmente.';
            $this->app->redirect('index.php');
        }
    }

    /*
     *
     *
     *
     * @param
     *
     * return
     */

    public function adicionarProduct() {
        if (!isset($_SESSION['customer']))
            $this->app->redirect('index.php/login');

        $cart = new Carrinho(option('model'));
        $cart->adicionarProduct($_POST['product_id'], $_POST['quantidade']);

        $_SESSION['message'] = 'ItemOrder adicionado.';
        $this->app->redirect('index.php/cart');
    }

    /*
     *
     *
     *
     * @param
     *
     * return
     */

    public function removerProduct() {
        if (!isset($_SESSION['customer'])) {
            $this->app->redirect('index.php/login');
        }

        $id = params('id');
        $cart = new Carrinho(option('model'));
        $cart->removerProduct($id);

        $_SESSION['message'] = 'ItemOrder removido.';
        $this->app->redirect('index.php/cart');
    }

    /*
     *
     * 	
     *
     * @param
     *
     * return
     */

    public function verCarrinho() {
        if (!isset($_SESSION['customer'])) {
            $this->app->redirect('index.php/login');
        }

        if (isset($_SESSION['cart'])) {
            $cart = new Carrinho(option('model'));
            $product = new Product(option('model'));

            $products = array();
            $total = 0;
            foreach ($_SESSION['cart'] as $prod) {
                $product->show($prod['product_id']);
                $dataProduct = $product->all();
                $products[] = array($dataProduct[0], $prod['quantidade']);
                $total += $dataProduct[0]['preco'] * $prod['quantidade'];
            }
            $data = array('cart' => $products, 'total' => $total);
        } else {
            $_SESSION['message'] = 'Seu cart está vazio';
        }

        if (isset($_SESSION['message'])) {
            $data['message'] = $_SESSION['message'];
            unset($_SESSION['message']);
        }

        set('data', $data);
        $this->view->setTemplates('site/cart.tpl.php','layouts/site.layout.tpl.php');
    }

    /*
     *
     *
     *
     * @param
     *
     * return
     */

    public function efetuarOrder() {
        if (!isset($_SESSION['customer'])) {
            $this->app->redirect('index.php/login');
        }

        if (isset($_SESSION['customer']['cpf']) || isset($_SESSION['customer']['cnpj'])) {
            if (
                    isset($_SESSION['customer']['endereco']) &&
                    isset($_SESSION['customer']['complemento']) &&
                    isset($_SESSION['customer']['cidade']) &&
                    isset($_SESSION['customer']['estado']) &&
                    isset($_SESSION['customer']['cep'])
            ) {

                $cart = new Carrinho(option('model'));
                $cart->efetuarOrder($_POST['cod_servico']);

                $body = 'O customer ' . $_SESSION['customer']['username'] . " efetuou um order.\n\n\n";

                $product = new Product(option('model'));
                foreach ($_SESSION['cart'] as $item) {
                    $product->show($item['product_id']);
                    $products = $product->all();
                    $body .= "\n";

                    foreach ($products as $p) {
                        foreach ($p as $key => $value) {
                            if (in_array($key, array('title', 'categoria', 'peso', 'preco'))) {
                                $body .= $key . " : " . $value . "\n";
                            }
                        }
                        $body .= "\n QUANTIDADE: " . $item['quantidade'] . "\n";
                    }
                    $body .= "\n";
                }


                Carteiro::send('order efetuado', $body);

                self::cleanCarrinho();

                $msg = 'Order efetuado';
                $_SESSION['message'] = $msg;

                $this->app->redirect('index.php/orders/1');
            } else {

                $msg = "Termine de preencher seu profile.";
                $_SESSION['message'] = $msg;

                $this->app->redirect('index.php/profile/edit');
            }
        }
    }

    /*
     *
     *
     *
     * @param
     *
     * return
     */

    public function verProfile() {

        if (!isset($_SESSION['customer'])) {
            $this->app->redirect('index.php/login');
        }

        $id = $_SESSION['customer']['customer_id'];
        $customer = new Cliente(option('model'));
        $customer->show($id);
        $customer->setLayout('layouts/site.layout.tpl.php');
        $customer->setView('site/profile.tpl.php');

        if (isset($_SESSION['message'])) {
            $customer->setDado('message', $_SESSION['message']);
            unset($_SESSION['message']);
        }

        return $customer->render(true);
    }

    /**
     *
     *
     *
     * @param
     *
     * return
     */
    public function profileForm() {
        if (!isset($_SESSION['customer'])) {
            $this->app->redirect('index.php/login');
        }

        $id = $_SESSION['customer']['customer_id'];
        $customer = new Cliente(option('model'));
        $customer->show($id);

        if (isset($_SESSION['message'])) {
            $customer->setDado('message', $_SESSION['message']);
            unset($_SESSION['message']);
        }

        $customer->setLayout('layouts/site.layout.tpl.php');
        $customer->setView('site/profile.form.tpl.php');
        return $customer->render(true);
    }

    /**
     *
     *
     *
     * @param
     *
     * return
     */
    public function editProfile() {
        if (!isset($_SESSION['customer'])) {
            $this->app->redirect('index.php/login');
        }

        $id = $_SESSION['customer']['customer_id'];
        $profile = new Cliente(option('model'));
        $profile->update($_POST, $id);

        $body = 'O customer ' . $_SESSION['customer']['username'] . 'editou seu profile.';
        Carteiro::send('profile editado', $body);

        $_SESSION["message"] = 'Seu profile foi editado.';
        $this->app->redirect('index.php/profile');
    }

    /**
     *
     *
     *
     * @param
     *
     * return
     */
    public function verOrders() {
        if (!isset($_SESSION['customer'])) {
            $this->app->redirect('index.php/login');
        }

        $pg = params('pg');
        $pp = option('perpage');

        $order = new Order(option('model'));

        if (isset($_SESSION['message'])) {
            $order->setDado('message', $_SESSION['message']);
            unset($_SESSION['message']);
        }

        $registros = $order->count();
        $pagination = Pagination::pager($registros, $pp, $pg);

        $uid = $_SESSION['customer']['customer_id'];
        $sql = "SELECT * FROM orders WHERE customer_id = " . $uid . " ORDER BY created DESC";
        $data = $order->getDb()->run($sql);
        $order->setData($data);
        $order->setDado('pgs', $pagination->num_pages);
        $order->setLayout('layouts/site.layout.tpl.php');
        $order->setView('site/orders.tpl.php');

        return $order->render(true);
    }

    /**
     *
     * @param
     *
     * return
     */
    public function detalheOrder() {
        if (!isset($_SESSION['customer'])) {
            $this->app->redirect('index.php/login');
        }

        $id = params('id');

        $order = new Order(option('model'));

        if (isset($_SESSION['message'])) {
            $order->setDado('message', $_SESSION['message']);
            unset($_SESSION['message']);
        }

        $order->setLayout('layouts/site.layout.tpl.php');
        $order->setView('site/order.tpl.php');

        $order->detalheOrder($id);
        return $order->render(true);
    }

    /**
     *
     * 
     */
    public function cleanCarrinho() {
        unset($_SESSION['cart']);
    }

}

/* fin */
?>
