<?php
namespace Maltz\Store\Model;


/*
 *
 *
 *
 * 
 *
 * 
 */

class Cart {

    private $item;
    private $session;
    private $order;
    private $product;
    private $shipping;
    private $cepLocal = "22281030";
    private $weight = 0.0;
    private $products = array();

    public function __construct($db, $session) {
        $this->session = $session;
        $this->product = new Product($db);
        $this->item = new ItemOrder($db);
        $this->order = new Order($db);
    }

    /*
     *
     *
     *
     * 
     *
     * 
     */

    public function productExists($pid) {
        $pid = intval($pid);
        $max = count($cart);
        $flag = 0;
        for ($i = 0; $i < $max; $i++) {
            if ($pid == $cart[$i]['id']) {
                $flag = 1;
                break;
            }
        }
        return $flag;
    }

    /*
     *
     *
     *
     * 
     *
     * 
     */

    public function addProduct($id, $quant) {

        if ($this->session->has('cart')) {
            $cart = $this->session->get('cart');
            if ($this->productExiste($id))
                return false;
            $max = count($cart);
            $cart[$max]['id'] = $id;
            $cart[$max]['quantity'] = $quant;
        } else {
            $cart = array();
            $cart[0]['id'] = $id;
            $cart[0]['quantity'] = $quant;
        }
        $this->session->set('cart', $cart);
    }

    /*
     *
     *
     *
     * 
     *
     * 
     */

    public function removeProduct($id) {
        $cart = $this->session->get('cart');
        $max = count($cart);
        for ($i = 0; $i < $max; $i++) {
            if ($id == $cart[$i]['id']) {
                unset($cart['cart'][$i]);
                break;
            }
        }
        $this->session->set('cart', $cart);
    }

    /*
     *
     *
     *
     * 
     *
     * 
     */

    public function getProductPrice($id) {
        $this->product->show($id);
        $product = $this->product->all();
        return $product['price'];
    }

    /*
     *
     *
     *
     * 
     *
     * 
     */

    public function makeOrder($service_code) {

        $customer = $this->session->get('customer');

        $this->order->insert(array('customer_id' => $customer['customer_id'], 'activity' => 1));
        $order_id = $this->order->all();
        $cart = $this->session->get('cart');
        $max = count($cart);
        for ($i = 0; $i < $max; $i++) {
            $product_id = $cart[$i]['product_id'];
            $q = $cart[$i]['quantity'];
            $this->product->show($product_id);
            $productData = $this->product->all();
            $this->products[] = $productData;
            $this->item->insert(array('order_id' => $order_id, 'quantity' => $q, 'product_id' => $product_id, 'activity' => 1));

            $in_stock = $productData['in_stock'] - $q;
			$this->product->update(array('in_stock' => $in_stock), $product_id);
        }


        if (!empty($this->products)) {
            $weight = 0.0;
            $total = 0.0;
            foreach ($this->products as $product) {
                $weight += $product[0]['weight'] * $q;
                $total += $product[0]['price'] * $q;
            }
            $weight = $weight / 1000;
            $shipping = Correios::calculaFrete(
                $service_code, 20231030, $_SESSION['customer']['cep'], $weight
            );
            $this->order->update(array('price' => $total, 'shipping' => $shipping), $order_id);
        }
    }

    /*
     *
     *
     *
     * 
     *
     * 
     */
    public function numItemOrders() {
        if (!isset($this->session->has('cart')))
            return 0;
        return count($this->session->get('cart'));
    }
}

?>
