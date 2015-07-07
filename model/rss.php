<?php

/**
 * ESSE COMPONENTE NAO ACESSA DIRETAMENTE O BANCO DE DADOS
 * NAO DEVE ESTENDER O CTRL
 * 
 * Utiliza feed RSS como base de dados
 * depende de SimplePie http://simplepie.org
 * 
 * http://ideiasinsolitas.com.br/
 *
 * @copyright  Copyright (c) 2012-2013 Pedro Koblitz
 * @author      Pedro Koblitz pedrokoblitz@gmail.com
 * @license    GPL v2
 *
 * @package    Meu CMS ainda nÃ£o tem nome
 *
 * @version    0.1 alpha
 */


class Rss extends Modelo
{

	// url do feed
	private $url;

	/*
	* construtor
	*
	*
	* @param objeto DB
	*
	* return void
	*/

	public function __construct($url) 
	{
		$this->url = $url;
	}


	/*
	* 
	* @param $n int
	* 
	* return array
	*/
	
	public function getFeed($n=null) 
	{
		$feed = new SimplePie();
		$feed->set_feed_url($this->url);
		$success = $feed->init();
		$feed->handle_content_type();
		$items = array();
		
		$feedItems = $feed->get_items();
		//var_dump($feedItems);
		foreach($feedItems as $item) {
			$items[]['link'] = $item->get_permalink();
			$items[]['titulo'] = $item->get_title();
			$items[]['corpo'] = $item->get_content();
			$items[]['tag'] = $item->get_category();
		}
		
		$itemsFiltrado = array();
		foreach ($items as $i) {
			if (isset($i['corpo'])) {
				$itemsFiltrado[] = $i;
			}	
		}
		
		$c = count($itemsFiltrado);
		if ($n && $n < $c) {
			$itemsFiltrado = array_slice($itemsFiltrado,0,$n);
		}
		
		$this->dados['conteudo'] = $itemsFiltrado;
	}

	/*
	* 
	* corta feed para x items
	* 
	* @param $n int
	*
	* return array
	*/
	
	public function chunk($n=5) 
	{
		$tudo = $this->getDado('conteudo');
		$separados = array_chunk($tudo,$n);
		$this->setDado('conteudo',$separados);
	}
}


?>
