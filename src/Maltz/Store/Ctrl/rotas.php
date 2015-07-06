<?php

// Servico CRUD
// show detalhe Order
dispatch('admin/orders/show/:id', array('Servico', 'detalheOrder'));



// cep!
dispatch('api/cep/:cep', array('Servico', 'api_cep'));

//calcula value do frete
dispatch_post('api/frete', array('Servico', 'api_frete'));

// clean imagens
dispatch('api/photos/clean', array('Servico', 'cleanImagens'));

//searchDinamica
dispatch('api/search/:string', array('Loja', 'searchDinamica'));




// form de login
dispatch('login', array('Loja', 'login'));

// fazer login
dispatch_post('login', array('Loja', 'login'));

// sair
dispatch('logout', array('Loja', 'logout'));


//capa
dispatch('/', array('Loja', 'capa'));


//search
dispatch('consulta/', array('Loja', 'consulta'));


//
dispatch('page/:id', array('Loja', 'showPage'));

//		
dispatch('products/:pg', array('Loja', 'listProducts'));

//		
dispatch('products/categoria/:cat/:pg', array('Loja', 'listProductsCategoria'));

//
dispatch('product/:id', array('Loja', 'showProduct'));

//
dispatch('cart', array('Loja', 'verCarrinho'));

//
dispatch_post('cart/adicionar', array('Loja', 'adicionarProduct'));

//
dispatch('cart/remover/:id', array('Loja', 'removerProduct'));

/**
 * 
 */
dispatch_post('cart/pedir', array('Loja', 'efetuarOrder'));






/**
 * 
 */
dispatch('cadastro', array('Loja', 'cadastro'));

/**
 * 
 */
dispatch_post('api/cadastrar', array('Loja', 'cadastrar'));

/**
 * 
 */
dispatch('api/validar/:id/:token', array('Loja', 'validarUser'));




/**
 * 
 */
dispatch('orders/:pg', array('Loja', 'verOrders'));

/**
 * 
 */
dispatch('order/:id', array('Loja', 'detalheOrder'));

/**
 * 
 */
dispatch('profile/edit', array('Loja', 'profileForm'));

/**
 * 
 */
dispatch_post('profile/save', array('Loja', 'editProfile'));

/**
 * 
 */
dispatch('profile', array('Loja', 'verProfile'));


/**
 * 
 */
dispatch('contact', array('Loja', 'formContact'));

/**
 * 
 */
dispatch_post('contact/send', array('Loja', 'sendContact'));

/**
 * 
 */
dispatch('boleto/:order_id', array('Boleto', 'gerar'));
?>
