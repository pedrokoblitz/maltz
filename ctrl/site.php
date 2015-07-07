<?php

/**
 * Ações do frontend
 * 
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

class Site
{

	/*
	*
	* carrega modelos para capa do site
	*
	* @param
	*
	* return string
	*/
	public static function capa()
	{
		$capa = new Capa(option('db'));
		
		$capa->setProjetos(option('capa_projetos_quant'));
		$capa->setBlog(option('capa_blog_quant'));
		$capa->setZines(option('capa_zine_quant'));
		$v = new View('layouts/site.layout.tpl.php','frontend/capa.tpl.php');
		$capa->setDado('l',new UrlHelper(array()));

		return $v->render($capa->getDados());
	}

	/*
	* mostra pagina
	*
	*
	* @param
	*
	* return string
	*/
	public static function mostrarPagina()
	{
		$pagina = new Pagina(option('db'));
		$id = params('id');
		$pagina->mostrar($id,true,false,true);
		$v = new View('layouts/site.layout.tpl.php','frontend/pagina.tpl.php');
		$pagina->setDado('l', new UrlHelper(array()));
		return $v->render($pagina->getDados());
	}

	/*
	* carrega rss do tumblr e monta no layout
	*
	* @param
	*
	* return string
	*/
	public static function blog()
	{
		$rss = new Rss(option('tumblr_rss_url'));
		$rss->getFeed();
		
		$bloco = new Bloco(option('db'));
		$bloco->mostrarArea('blog');
		$lateral = $bloco->getDados();

		$url = new UrlHelper(array());
		
		$rss->setDado('lateral',$lateral['conteudo']);
		$rss->setDado('l',$url);

		$v = new View('layouts/site.layout.tpl.php','frontend/blog.tpl.php');

		$items = $v->render($rss->getDados());
		return $items;
	}


	/*
	* lista projetos
	*
	*
	* @param
	*
	* return string
	*/

	public static function listarProjetos() {
		$m = option('db');
		$c = new Projeto($m);
		$pg = 1;
		
		// CEM PROJETOS SEM PAGINACAO
		$pp = 100;
		$ordem = array('data','DESC');
		$c->listar($pp,$pg,"",$ordem,true);
		$v = new View('layouts/site.layout.tpl.php','frontend/projetos.tpl.php');
		if (isset($_SESSION['mensagem'])) {
			$c->setDado('mensagem',$_SESSION['mensagem']);
			unset($_SESSION['mensagem']);
		}

		$bloco = new Bloco(option('db'));
		$bloco->mostrarArea('projeto');
		$lateral = $bloco->getDados();

		$gen = new UrlHelper(array());
		$c->setDado('l',$gen);
		$c->setDado('lateral',$lateral['conteudo']);

		return $v->render($c->getDados());
	}

	/*
	*
	* mostra um projeto
	*
	* @param
	*
	* return string
	*/
	public static function mostrarProjeto()
	{
		$projeto = new Projeto(option('db'));
		$id = params('id');
		$projeto->mostrar($id,true,false,true);
		$v = new View('layouts/site.layout.tpl.php','frontend/projeto.tpl.php');
		$projeto->setDado('l',new UrlHelper(array()));

		return $v->render($projeto->getDados());
	}


	/*
	* lista zines
	*
	*
	* @param
	*
	* return string
	*/
	public static function listarZines() {
		$m = option('db');
		$c = new Zine($m);
		$pg = 1;
		$pp = 100;
		$ordem = array('data','DESC');
		$c->listar($pp,$pg,"",$ordem,true);
		$v = new View('layouts/site.layout.tpl.php','frontend/zines.tpl.php');
		if (isset($_SESSION['mensagem'])) {
			$c->setDado('mensagem',$_SESSION['mensagem']);
			unset($_SESSION['mensagem']);
		}
		
		$bloco = new Bloco(option('db'));
		$bloco->mostrarArea('zine');
		$lateral = $bloco->getDados();

		$gen = new UrlHelper(array());
		
		$c->setDado('l',$gen);
		$c->setDado('lateral',$lateral['conteudo']);

		return $v->render($c->getDados());
	}

	/*
	* mostra um zine
	*
	*
	* @param
	*
	* return string
	*/
	public static function mostrarZine()
	{
		$zine = new Zine(option('db'));
		$id = params('id');
		$zine->mostrar($id,true,false,true);
		$v = new View('layouts/site.layout.tpl.php','frontend/zine.tpl.php');
		$zine->setDado('l',new UrlHelper(array()));
		return $v->render($zine->getDados());
	}

	/*
	*
	* formulário de contato
	*
	* @param
	*
	* return string
	*/
	public function contatoForm() {
		set('l',new UrlHelper(array()));

		$bloco = new Bloco(option('db'));
		$bloco->mostrarArea('contato');
		$lateral = $bloco->getDados();
		set('lateral',$lateral['conteudo']);
		return html('frontend/contato.tpl.php','layouts/site.layout.tpl.php');
	}

	/*
	*
	* enviar formulário de contato
	*
	* @param
	*
	* return void
	*/
	public function enviarContato() {
		Carteiro::enviar( 
			'meu',
			$corpo = $_POST['mensagem']." \n ".$_POST['nome']." \n ".$_POST['email']
		);
		$_SESSION['mensagem'] = 'Sua mensagem foi enviada.';
		redirect_to('index.php/contato');
	}

} /* fin */

?>
