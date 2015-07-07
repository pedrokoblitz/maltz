<?php

/**
 * Servico genérico que toma conta de gerar CRUD
 * implicitamente 
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


class Api
{

	// objeto DB
	private static $db;
	// objeto filho da class Modelo
	private static $modelo;
	// string
	private static $nomeModelo;

	/*
	* descobre o modelo e cria uma instancia
	* 
	* return void
	*/
	public static function setModelo()
	{
		self::$nomeModelo = params('modelo');
		self::$db = option('db');

		switch (self::$nomeModelo) {
			case 'blog':
				self::$modelo = new Post(self::$db);
				break;
			
			case 'paginas':
				self::$modelo = new Pagina(self::$db);
				break;

			case 'arquivos':
				self::$modelo = new Arquivo(self::$db);
				break;
			
			case 'galerias':
				self::$modelo = new Galeria(self::$db);
				break;
			
			case 'projetos':
				self::$modelo = new Projeto(self::$db);
				break;
	
			case 'zines':
				self::$modelo = new Zine(self::$db);
				break;
			
			case 'config':
				self::$modelo = new Config(self::$db);
				break;
			
			case 'blocos':
				self::$modelo = new Bloco(self::$db);
				break;
			
			case 'log':
				self::$modelo = new Log(self::$db);
				break;
			
			case 'usuarios':
				self::$modelo = new Usuario(self::$db);
				break;
			
			default :
				halt(HTTP_NOT_FOUND,'Modelo de dados não encontrado');
				break;
		}
	}

	/*
	*
	* muda campo ativo do modelo selecionado para 1
	*
	* return void
	*/

	public static function ativar() {
		// se id foi fornecido
		if (params('id')) {
			$id = params('id');
			// se esta logado
			if (Porteiro::logado()) {
				// carrega modelo
				self::setModelo();
				
				// executa ativacao
				self::$modelo->ativar($id);	

				// registra operacao no log
				LogHelper::registrar(
					option('db'),
					$_SESSION['usuario']['username'],
					$_SESSION['usuario']['usuarioId'],
					'ativou',
					self::$nomeModelo,
					$id
				);

			} else {
				UrlHelper::ajax_redirect('index.php/entrar');
			}
		} else {
			UrlHelper::ajax_redirect('index.php/admin/', 'nenhum id fornecido');
		}
	}


	/*
	* muda campo ativo do modelo selecionado para 0
	*
	*
	*
	* return void
	*/

	public static function desativar() {

		if (Porteiro::logado()) {
			self::setModelo();
			if (params('id')) {
		// resolve parametros

				$id = params('id');
				self::$modelo->desativar($id);	

				// registra operacao no log
				LogHelper::registrar(
					option('db'),
					$_SESSION['usuario']['username'],
					$_SESSION['usuario']['usuarioId'],
					'desativou',
					self::$nomeModelo,
					$id
				);
			}
			UrlHelper::ajax_redirect('index.php/admin/'.self::$nomeModelo.'/listar/1','desativado');
		}
	}



	/*
	*
	* lista modelo selecionado
	*
	*
	* return string / void
	*/

	public static function listar() {
		if (Porteiro::logado()) {
			self::setModelo();
		// resolve parametros
			$pg = params('pg');
			$pp = option('por_pagina');
			$ordem = array('criado','DESC');
			
			if (params('chave') && params('ordem')) $ordem = array(params('chave'),params('ordem'));
			
			self::$modelo->listar($pp,$pg,"",$ordem);
			$v = new View('layouts/lista.layout.tpl.php','listas/'.self::$nomeModelo.'.tpl.php');

			$urls = array(
				'novo' => 'index.php/admin/'.self::$nomeModelo.'/novo',
				'editar' => 'index.php/admin/'.self::$nomeModelo.'/editar',
				'apagar' => 'index.php/api/'.self::$nomeModelo.'/apagar',
				'ativar' => 'index.php/api/'.self::$nomeModelo.'/ativar/',
				'desativar' => 'index.php/api/'.self::$nomeModelo.'/desativar/',
				'listaController'=>'/public/assets/jsCtrl/'.self::$nomeModelo.'ListaController.js',
			);
			$gen = new UrlHelper($urls);
			self::$modelo->setDado('l',$gen);

			if (isset($_SESSION['mensagem'])) {
				self::$modelo->setDado('mensagem',$_SESSION['mensagem']);
				unset($_SESSION['mensagem']);
			}
			$dados = self::$modelo->getDados();
			return $v->render($dados);
		}
		flash('proximo','/index.php/admin/'.self::$nomeModelo.'/listar/'.params('pg'));
		UrlHelper::ajax_redirect('index.php/entrar');
	}




	/*
	*
	* mostra item do modelo selecionado
	*
	*
	* return string / void
	*/

	public static function mostrar() {
		if (Porteiro::logado()) {
			self::setModelo();
		// resolve parametros
			$db = option('db');
			$id = params('id');
			$tabela = self::$modelo->getTabela();
			self::$modelo->mostrar($id);

			if (isset($_SESSION['mensagem'])) {
				self::$modelo->setDado('mensagem',$_SESSION['mensagem']);
				unset($_SESSION['mensagem']);
			}

			$urls = array(
				'listar' => 'index.php/'.self::$nomeModelo.'/1',
				'viewController' => '/public/assets/jsCtrl/'.self::$nomeModelo.'ViewController.js'

			);

			$v = new View('layouts/frontend.layout.tpl.php','frontend/'.self::$nomeModelo.'.view.tpl.php');
			$gen = new UrlHelper($urls);
			self::$modelo->setDado('l',$gen);
			$dados = self::$modelo->getDados();
			return $v->render($dados);
		}
		UrlHelper::ajax_redirect('index.php/entrar');
	}

	/*
	*
	* cria novo registro
	*
	*
	* return void
	*/

	public static function novo() {
		if (Porteiro::logado()) {
			self::setModelo();
			$post = array('ativo'=>0);
			self::$modelo->inserir($post);
			$id = self::$modelo->getDados();
				// registra operacao no log
				LogHelper::registrar(
					option('db'),
					$_SESSION['usuario']['username'],
					$_SESSION['usuario']['usuarioId'],
					'criou',
					self::$nomeModelo,
					$id['conteudo']
				);
			UrlHelper::ajax_redirect('index.php/admin/'.self::$nomeModelo.'/editar/'.$id['conteudo'],'novo resgistro criado');
		}
		UrlHelper::ajax_redirect('index.php/entrar');
	}


	/*
	* 
	* edita registro existente
	*
	*
	* return string / void
	*/

	public static function editar() {
		if (Porteiro::logado()) {
			self::setModelo();
		// resolve parametros
			$id = params('id');
			self::$modelo->mostrar($id);
			
			// novo view
			$v = new View('layouts/form.layout.tpl.php','backend/'.self::$nomeModelo.'.tpl.php');
			
			// urls das acoes da pagina
			$urls = array(
				'salvar' => 'index.php/api/'.self::$nomeModelo.'/salvar/',
				'novo' => 'index.php/admin/'.self::$nomeModelo.'/novo',
				'listar' => 'index.php/admin/'.self::$nomeModelo.'/listar/1',
				'apagar' => 'index.php/api/'.self::$nomeModelo.'/apagar/',
				'ativar' => 'index.php/api/'.self::$nomeModelo.'/ativar',
				'desativar' => 'index.php/api/'.self::$nomeModelo.'/desativar',
				'formController'=>'/public/assets/jsCtrl/'.self::$nomeModelo.'FormController.js',
			);

			$gen = new UrlHelper($urls);
			
			self::$modelo->setDado('l',$gen);

			if (isset($_SESSION['mensagem'])) {
				self::$modelo->setDado('mensagem',$_SESSION['mensagem']);
				unset($_SESSION['mensagem']);
			}

			$dados = self::$modelo->getDados();
			return $v->render($dados);
		}
		UrlHelper::ajax_redirect('index.php/entrar');
	}



	/*
	*
	* salva registro enviado pelo formulário
	*
	*
	* return void
	*/

	public static function salvar() {
		if (Porteiro::logado()) {
		// resolve parametros
			$id = params('id');
			self::setModelo();
			$post = $_POST;

			self::$modelo->modificar($post,$id);
				// registra operacao no log
				LogHelper::registrar(
					option('db'),
					$_SESSION['usuario']['username'],
					$_SESSION['usuario']['usuarioId'],
					'salvou',
					self::$nomeModelo,
					$id['conteudo']
				);
			UrlHelper::ajax_redirect('index.php/admin/'.self::$nomeModelo.'/editar/'.$id,'registro modificado');
		}		
		UrlHelper::ajax_redirect('index.php/entrar');
	}




	/*
	*
	* apaga registro selecionado
	*
	*
	* return void
	*/

	public static function apagar() {
		if (Porteiro::logado()) {
		// resolve parametros
			$id = params('id');
			self::setModelo();
			self::$modelo->apagar($id);
				// registra operacao no log
				LogHelper::registrar(
					option('db'),
					$_SESSION['usuario']['username'],
					$_SESSION['usuario']['usuarioId'],
					'apagou',
					self::$nomeModelo,
					$id['conteudo']
				);

			UrlHelper::ajax_redirect('index.php/admin/'.self::$nomeModelo.'/listar/1','registro apagado');
		}
		UrlHelper::ajax_redirect('index.php/entrar');
	}





	/*
	*
	* lista registros do modelo em JSON
	*
	*
	* return string JSON
	*/

	public static function listarJson() {
		// resolve parametros
		if (params('modelo') == 'usuarios') {return false;}
		$pg = params('pg');
		if (params('pp')) {
			$pp = params('pp');
		} else {
			$pp = option('por_pagina');
		}
		self::setModelo();
		$ordem = array('criado','DESC');
		if (params('chave') && params('ordem')) $ordem = array(params('chave'),params('ordem'));
		self::$modelo->listar($pp,$pg,"",$ordem);
		$v = new View();
		$dados = self::$modelo->getDados();
		return $v->renderJSON($dados);
	}



	
	/*
	*
	* mostra registro selecionado em JSON
	*
	*
	* return string json
	*/

	public static function mostrarJson() {
		if (params('modelo') == 'usuarios') {return false;}

		$id = params('id');
		self::setModelo();
		self::$modelo->mostrar($id);
		$v = new View();
		return $v->renderJSON(true);
	}


	/*
	*
	* realiza o backup
	*
	*
	* return void
	*/

	public static function backup() {
		if (params('segredo') == '1234') {
			Backup::salvar();
			UrlHelper::ajax_redirect('index.php/admin/');
		}
	}

}

?>
