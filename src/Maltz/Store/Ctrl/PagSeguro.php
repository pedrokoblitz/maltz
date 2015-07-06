<?php

namespace Maltz\Store\Ctrl;

class PagSeguro extends Controller {

    /**
     * [pagar description]
     * @return [type]
     */
    public static function pagar() {

        $order_id = params('order_id');
        $order = new Order(option('model'));
        $order->show($order_id);
        $dataorder = $order->all();

        $product = new Product(option('model'));

        $customer = new Cliente(option('model'));
        $customer->show($dataorder['customer_id']);
        $datacustomer = $customer->all();

        $paymentRequest = new PagSeguroPaymentRequest();

        foreach ($products as $product) {

            $paymentRequest->addItemOrder(
                    '0001', //id
                    'Notebook Prata', //description
                    1, //quantidade
                    2430.00, //preco
                    1000, //peso
                    17.35 //preco envio 
            );
        }

        $paymentRequest->setSender(
                'José Comprador', 'comprador@uol.com.br', '11', '56273440'
        );

        $paymentRequest->setShippingAddress(
                '01452002', //'postalCode'
                'Av. Brig. Faria Lima', // 'street'     
                '1384', // 'number'
                'apto. 114', // complement 
                'Jardim Paulistno', // hood/district
                'São Paulo', //city
                'SP', //state
                'BRA' //country
        );

        /*
         * 	1 	Encomenda normal (PAC)
         * 	2 	SEDEX
         * 	3 	Type de frete não especificado
         */
        $paymentRequest->setShippingType(1);
        $paymentRequest->setCurrency("BRL");
        $paymentRequest->setReference("I9635");

        // Informando as credentials  
        $credentials = new PagSeguroAccountCredentials(
                'suporte@lojamodel.com.br', '95112EE828D94278BD394E91C4388F20'
        );

        // fazendo a requisição a API do PagSeguro pra obter a URL de pagamento  
        $url = $paymentRequest->register($credentials);

        return $url;
    }

    /**
     * [retornoPagamento description]
     * @return [type]
     */
    public static function retornoPagamento() {

        /* Informando as credentials  */
        $credentials = new PagSeguroAccountCredentials(
                'suporte@lojamodel.com.br', '95112EE828D94278BD394E91C4388F20'
        );

        /* Type de notificação recebida */
        $type = $_POST['notificationType'];

        /* Código da notificação recebida */
        $code = $_POST['notificationCode'];


        /* Verificando type de notificação recebida */
        if ($type === 'transaction') {

            /* Obtendo o objeto PagSeguroTransaction a partir do código de notificação */
            $transaction = PagSeguroNotificationService::checkTransaction(
                            $credentials, $code // código de notificação  
            );
        }

        /* objeto PagSeguroTransactionStatus */
        $status = $transaction->getStatus();

        return $status;
    }

    /**
     * [retornoPagamento description]
     * @return [type]
     */
    public static function consulta() {

        /* Definindo as credentials  */
        $credentials = new PagSeguroAccountCredentials(
                'suporte@lojamodel.com.br', '95112EE828D94278BD394E91C4388F20'
        );

        /* Código identifier da transação  */
        // params('transaction_id');
        $transaction_id = '59A13D84-52DA-4AB8-B365-1E7D893052B0';

        /*
          Realizando uma consulta de transação a partir do código identifier
          para obter o objeto PagSeguroTransaction
         */
        $transaction = PagSeguroTransactionSearchService::searchByCode(
                        $credentials, $transaction_id
        );

        /* Imprime o código do status da transação */
        return $transaction;
    }

}

?>
