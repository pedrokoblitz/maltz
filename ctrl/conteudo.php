<?php

/**
 * Ações dos dbs de conteúdo
 * 
 * http://ideiasinsolitas.com.br/
 *
 * @copyright  Copyright (c) 2012-2013 Pedro Koblitz
 * @author      Pedro Koblitz pedrokoblitz@gmail.com
 * @license    GPL v2
 *
 * @package    Meu CMS ainda não tem nome
 *
 * @version    0.1 alpha
 */

class Conteudo
{

	/*
	* lista zines
	*
	*
	* @param
	*
	* return string / void
	*/

	public static function listarZine() {
		if (Porteiro::logado()) {
			$m = option('db');
			$c = new Zine($m);
			$pg = params('pg');
			$pp = option('por_pagina');
			$ordem = array('data','DESC');
			if (params('chave') && params('ordem')) $ordem = array(params('chave'),params('ordem'));
			$c->listar($pp,$pg,"",$ordem);
			$v = new View('layouts/lista.layout.tpl.php','listas/zines.tpl.php');
			
			if (isset($_SESSION['mensagem'])) {
				$c->setDado('mensagem',$_SESSION['mensagem']);
				unset($_SESSION['mensagem']);
			}

			$urls = array(
				'novo' => 'index.php/admin/zines/novo',
				'editar' => 'index.php/admin/zines/editar',
				'apagar' => 'index.php/api/zines/apagar',
				'ativar' => 'index.php/api/zines/ativar',
				'desativar' => 'index.php/api/zines/desativar',
				'listaController' => '/public/assets/jsCtrl/zinesListaController.js'
			);

			$gen = new UrlHelper($urls);
			$c->setDado('l',$gen);
			$dados = $c->getDados();
			return $v->render($dados);
		}
		flash('proximo','/index.php/admin/zines/listar/'.params('pg'));
		UrlHelper::ajax_redirect('index.php/entrar');
	}


	/*
	* cria novo zine
	*
	*
	* @param
	*
	* return void
	*/

	public static function novoZine() {
		if (Porteiro::logado()) {
				$m = option('db');
				$c = new Zine($m);
				$post = array('ativo'=>0);
				$c->inserir($post);

				$id = $c->getDados();
				LogHelper::registrar(
					option('db'),
					$_SESSION['usuario']['username'],
					$_SESSION['usuario']['usuarioId'],
					'criou',
					'zines',
					$id['conteudo']
				);
				UrlHelper::ajax_redirect('index.php/admin/zines/editar/'.$id['conteudo'],'novo registro criado');
		}
		UrlHelper::ajax_redirect('index.php/entrar');
	}


	/*
	* edita zine
	*
	*
	*
	* return string / void
	*/

	public static function editarZine() {
		if (Porteiro::logado()) {
			$m = option('db');
			$c = new Zine($m);
			$id = params('id');
			$c->mostrarAdmin($id);
			$v = new View('layouts/form.layout.tpl.php','backend/zine.tpl.php');

			if (isset($_SESSION['mensagem'])) {
				$c->setDado('mensagem',$_SESSION['mensagem']);
				unset($_SESSION['mensagem']);
			}

			$urls = array(
				'seletorCapa' => 'index.php/api/capa/seletor/',
				'selecGal' => 'index.php/api/zines/galeria/nova/',
				'apagaCapa' => 'index.php/api/zines/capa/apagar/',
				'selecCapa' => 'index.php/api/zines/capa/nova/',
				'salvar' => 'index.php/api/zines/salvar/',
				'novo' => 'index.php/admin/zines/novo',
				'listar' => 'index.php/admin/zines/listar/1',
				'apagar' => 'index.php/api/zines/apagar/',
				'ativar' => 'index.php/api/zines/ativar',
				'desativar' => 'index.php/api/zines/desativar',
				'formController' => '/public/assets/jsCtrl/zinesFormController.js'

			);

			$gen = new UrlHelper($urls);
			$c->setDado('l',$gen);
			$dados = $c->getDados();
			return $v->render($dados);
		}
		flash('proximo','/index.php/admin/zines/editar/'.params('id'));
		UrlHelper::ajax_redirect('index.php/entrar');
	}



	/*
	* salva zine a partir de envio de formulário
	*
	*
	*
	* return void
	*/

	public static function salvarZine() {
		if (Porteiro::logado()) {
			$id = params('id');
			$m = option('db');
			$c = new Zine($m);
			
			$post = $_POST;

			$c->modificar($post,$id);
				LogHelper::registrar(
					option('db'),
					$_SESSION['usuario']['username'],
					$_SESSION['usuario']['usuarioId'],
					'salvou',
					'zines',
					$id['conteudo']
				);

			UrlHelper::ajax_redirect('index.php/admin/zines/editar/'.$id['conteudo'],'registro modificado');
		}
		UrlHelper::ajax_redirect('index.php/entrar');
	}



	/*
	* lista projetos
	*
	*
	* 
	* return string / void
	*/

	public static function listarProjeto() {
		if (Porteiro::logado()) {
			$m = option('db');
			$c = new Projeto($m);
			$pg = params('pg');
			$pp = option('por_pagina');
			$ordem = array('data','DESC');
			if (params('chave') && params('ordem')) $ordem = array(params('chave'),params('ordem'));
			$c->listar($pp,$pg,"",$ordem);
			$v = new View('layouts/lista.layout.tpl.php','listas/projeto.tpl.php');
			if (isset($_SESSION['mensagem'])) {
				$c->setDado('mensagem',$_SESSION['mensagem']);
				unset($_SESSION['mensagem']);
			}

			$urls = array(
				'novo' => 'index.php/admin/projetos/novo',
				'editar' => 'index.php/admin/projetos/editar',
				'apagar' => 'index.php/api/projetos/apagar',
				'ativar' => 'index.php/api/projetos/ativar',
				'desativar' => 'index.php/api/projetos/desativar',
				'listaController' => '/public/assets/jsCtrl/projetosListaController.js'
			);

			$gen = new UrlHelper($urls);
			$c->setDado('l',$gen);

			$dados = $c->getDados();
			return $v->render($dados);
		}
		flash('proximo','/index.php/admin/projetos/listar/'.params('pg'));
		UrlHelper::ajax_redirect('index.php/entrar');
	}


	/*
	* cria novo projeto
	*
	*
	* return void
	*/

	public static function novoProjeto() {
		if (Porteiro::logado()) {
				$m = option('db');
				$c = new Projeto($m);
				$post = array('ativo'=>0);
				$c->inserir($post);

				$id = $c->getDados();
				LogHelper::registrar(
					option('db'),
					$_SESSION['usuario']['username'],
					$_SESSION['usuario']['usuarioId'],
					'criou',
					'projetos',
					$id['conteudo']
				);
				UrlHelper::ajax_redirect('index.php/admin/projetos/editar/'.$id['conteudo'],'novo registro criado');
		}
		UrlHelper::ajax_redirect('index.php/entrar');
	}


	/*
	* edita projeto
	*
	*
	*
	* return string / void
	*/

	public static function editarProjeto() {
		if (Porteiro::logado()) {
			$m = option('db');
			$c = new Projeto($m);
			$id = params('id');
			$c->mostrarAdmin($id);
			$v = new View('layouts/form.layout.tpl.php','backend/projeto.tpl.php');
			if (isset($_SESSION['mensagem'])) {
				$c->setDado('mensagem',$_SESSION['mensagem']);
				unset($_SESSION['mensagem']);
			}

			$urls = array(
				'seletorCapa' => 'index.php/api/capa/seletor/',
				'apagaCapa' => 'index.php/api/projetos/capa/apagar/',
				'selecCapa' => 'index.php/api/projetos/capa/nova/',
				'selecGal' => 'index.php/api/projetos/galeria/nova/',
				'salvar' => 'index.php/api/projetos/salvar/',
				'novo' => 'index.php/admin/projetos/novo',
				'listar' => 'index.php/admin/projetos/listar/1',
				'apagar' => 'index.php/api/projetos/apagar/',
				'ativar' => 'index.php/api/projetos/ativar',
				'desativar' => 'index.php/api/projetos/desativar',
				'formController' => '/public/assets/jsCtrl/projetosFormController.js'
			);

			$gen = new UrlHelper($urls);
			$c->setDado('l',$gen);
			$dados = $c->getDados();
			return $v->render($dados);
		}
		flash('proximo','/index.php/admin/projetos/editar/'.params('id'));
		UrlHelper::ajax_redirect('index.php/entrar');
	}



	/*
	* salva projeto a partir de envio de formulario
	*
	*
	*
	* return void
	*/

	public static function salvarProjeto() {
		if (Porteiro::logado()) {
			$id = params('id');
			$m = option('db');
			$c = new Projeto($m);
			
			$post = $_POST;
			
			$c->modificar($post,$id);
				LogHelper::registrar(
					option('db'),
					$_SESSION['usuario']['username'],
					$_SESSION['usuario']['usuarioId'],
					'salvou',
					'projetos',
					$id['conteudo']
				);

			UrlHelper::ajax_redirect('index.php/admin/projetos/editar/'.$id['conteudo'],'registro modificado');

		}
		UrlHelper::ajax_redirect('index.php/entrar');
	}



	/*
	*
	* lista paginas
	*
	*
	* return string / void
	*/

	public static function listarPagina() {
		if (Porteiro::logado()) {
			$m = option('db');
			$c = new Pagina($m);
			$pg = params('pg');
			$pp = option('por_pagina');
			$ordem = array('data','DESC');
			if (params('chave') && params('ordem')) $ordem = array(params('chave'),params('ordem'));
			$c->listarAdmin($pp,$pg,"",$ordem);
			$v = new View('layouts/lista.layout.tpl.php','listas/pagina.tpl.php');

			if (isset($_SESSION['mensagem'])) {
				$c->setDado('mensagem',$_SESSION['mensagem']);
				unset($_SESSION['mensagem']);
			}

			$urls = array(
				'novo' => 'index.php/admin/paginas/novo',
				'editar' => 'index.php/admin/paginas/editar',
				'apagar' => 'index.php/api/paginas/apagar',
				'ativar' => 'index.php/api/paginas/ativar/',
				'desativar' => 'index.php/api/paginas/desativar/',
				'listaController' => '/public/assets/jsCtrl/paginasListaController.js'
			);

			$gen = new UrlHelper($urls);
			$c->setDado('l',$gen);
			
			$dados = $c->getDados();
			return $v->render($dados);
		}
		flash('proximo','/index.php/admin/paginas/listar/'.params('pg'));
		UrlHelper::ajax_redirect('index.php/entrar');
	}





	/*
	*
	* cria nova pagina
	*
	*
	* return void
	*/

	public static function novaPagina() {
		if (Porteiro::logado()) {
			$m = option('db');
			$c = new Pagina($m);
			$post = array('ativo'=>0);
			$c->inserir($post);
			$id = $c->getDados();
				LogHelper::registrar(
					option('db'),
					$_SESSION['usuario']['username'],
					$_SESSION['usuario']['usuarioId'],
					'criou',
					'paginas',
					$id['conteudo']
				);

			UrlHelper::ajax_redirect('index.php/admin/paginas/editar/'.$id['conteudo'],'novo registro criado');
		}
		UrlHelper::ajax_redirect('index.php/entrar');
	}


	/*
	* edita pagina
	*
	*
	*
	* return void
	*/

	public static function editarPagina() {
		if (Porteiro::logado()) {
			$m = option('db');
			$c = new Pagina($m);
			$id = params('id');
			$c->mostrarAdmin($id);
			$v = new View('layouts/form.layout.tpl.php','backend/pagina.tpl.php');

			if (isset($_SESSION['mensagem'])) {
				$c->setDado('mensagem',$_SESSION['mensagem']);
				unset($_SESSION['mensagem']);
			}

			$urls = array(
				'seletorCapa' => 'index.php/api/capa/seletor/',
				'selecGal' => 'index.php/api/paginas/galeria/nova/',
				'apagaCapa' => 'index.php/api/paginas/capa/apagar/',
				'selecCapa' => 'index.php/api/paginas/capa/nova/',
				'salvar' => 'index.php/api/paginas/salvar/',
				'novo' => 'index.php/admin/paginas/novo',
				'listar' => 'index.php/admin/paginas/listar/1',
				'apagar' => 'index.php/api/paginas/apagar/',
				'ativar' => 'index.php/api/paginas/ativar',
				'desativar' => 'index.php/api/paginas/desativar',
				'formController' => '/public/assets/jsCtrl/paginasFormController.js'
			);

			$gen = new UrlHelper($urls);
			$c->setDado('l',$gen);

			$dados = $c->getDados();
			return $v->render($dados);
		}
		flash('proximo','/index.php/admin/paginas/editar/'.params('id'));
		UrlHelper::ajax_redirect('index.php/entrar');
	}


	/*
	* salva pagina enviada de formulario
	*
	*
	*
	* return void
	*/

	public static function salvarPagina() {
		if (Porteiro::logado()) {
			$id = params('id');
			$m = option('db');
			$c = new Pagina($m);
			
			$post = $_POST;

			$c->modificar($post,$id);

				LogHelper::registrar(
					option('db'),
					$_SESSION['usuario']['username'],
					$_SESSION['usuario']['usuarioId'],
					'salvou',
					'paginas',
					$id['conteudo']
				);

			UrlHelper::ajax_redirect('index.php/admin/paginas/editar/'.$id['conteudo'],'registro modificado');
		}
		UrlHelper::ajax_redirect('index.php/entrar');
	}


}

?>
