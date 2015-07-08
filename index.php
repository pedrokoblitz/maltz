<?php

/**
 * http://ideiasinsolitas.com.br/
 *
 * @copyright  Copyright (c) 2012-2013 Pedro Koblitz
 * @author     Pedro Koblitz pedrokoblitz@gmail.com
 * @license    GPL v2
 *
 * @package    Meu CMS ainda não tem nome
 *
 * @version    0.1 alpha
 */

/* 
* limonade php
* http://www.limonade-php.net/README.htm
*/

require dirname(__FILE__).'/lib/limonade.php';

/*
*
* app config
*
*/
function configure()
{
	// url base
	//option('base_uri', '/maltz/');
	option('base_uri', '/');
	
	require_once_dir(dirname(__FILE__).'/lib/');

	// includes
	option('error_views_dir', option('views_dir').'/erros');
	option('controllers_dir', dirname(__FILE__).'/model');
	require_once_dir(dirname(__FILE__).'/ctrl/');
	
	// sessao
	option('session',true);
}

/*
*
* antes ...
*
*/
function before() {

	//db
	$db = new DB('mysql:dbname=db169616_ronymaltz;host=internal-db.s169616.gridserver.com','db169616','morte666');
	//$db = new DB('mysql:dbname=maltz;host=localhost','root','root');
	option('db', $db);

	// config
	$config = new Config($db);
	$config->listar(999,1);
	$c = $config->getDados();
	foreach ($c['conteudo'] as $rec) {
		option($rec['chave'],$rec['valor']);
	}

	// tipos/categorias dos projetos
	$tipos_disponiveis = array(
		array("foto",array("fotografia","photography")),
		array("texto",array("texto","text")),
		array("video",array("vídeo","video")),
		array("multimidia",array("multimídia","multimedia")),
		array("instalacao",array("instalação","installation")),
		array("exposicao",array("exposição","exhibition")),
		array("livro",array("livro","book")),
		array("reportagem",array("reportagem","reportage")),
		array("publicacao",array("publicação","publication")),
		array("semcategoria",array("sem categoria","uncategorized")),
	);
	// seleciona tipos já utilizados
	$t = $config->tipos();
	
	// filtra disponiveis, baseado nos utilizado
	$tipos = array();
	foreach ($tipos_disponiveis as $tipo) {
		if (in_array($tipo[0], $t)) {
				$tipos[] = $tipo;
		}
	}
	
	option('tipos',$tipos);
	
	$extensoes = array(
		'pdf','PDF',
		'jpg','JPG',
		'gif','GIF',
		'jpeg','JPEG',
		'png','PNG',
		'doc','DOC',
		'ppt','PPT',
		'pps','PPS',
	);
	
	option('extensoes',$extensoes);
}

/*
*
* depois ...
*
*/
function after($output){
	//$output = str_replace('index.php/','',$output);
	return $output;
}

/*
 * 
 * executar as rotas
 * 
 */ 
run();

?>
