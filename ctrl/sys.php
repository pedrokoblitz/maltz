<?php
/**
 * Ações da administracao do sistema
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

class Sys
{

	/*
	* modifica permissao do usuario
	*
	* return string json / void
	*/
	public static function modificarPermissao() {
		if (Porteiro::logado()) {
			LogHelper::registrar(
				option('db'),
				$_SESSION['usuario']['username'],
				$_SESSION['usuario']['usuarioId'],
				'modificou a permissão',
				'usuarios',
				$id=params('id')
			);

			$c = new Usuario(option('db'));
			$c->modificarPermissao(params('id'),params('tipo'));
			$v = new View();
			return $v->renderJSON($c->getDados());
		} else {
			UrlHelper::ajax_redirect('index.php/entrar');
		}		
	}
	


	/*
	* form de login
	*
	* return string / void
	*/
	public static function entrar() {
		if (!Porteiro::logado()) {
			set('l',new UrlHelper(array()));
			return html('backend/login.form.tpl.php','');
		} else {
			UrlHelper::ajax_redirect('index.php/admin/');
		}
	}



	/*
	* autenticar
	*
	* return void
	*/
	public static function login() {
		Porteiro::entrar($_POST['username'],$_POST['senha']);
		$redir = 'index.php/admin/';
		$flash = flash('proximo');
		if (isset($flash)) {
			$redir = $flash;
		}
		UrlHelper::ajax_redirect($redir);
	}



	/*
	* sair
	*
	*
	* return void
	*/
	public static function logout() {
		Porteiro::sair();
		UrlHelper::ajax_redirect('index.php/entrar','você está desconectado');
	}


	/*
	* painel inicial
	*
	*
	* return string / void
	*/
	public static function painel() {
		if (Porteiro::logado()) {
			$c = new Painel(option('db'));
			$c->setProjetos(option('painel_lista_quant'));
			$c->setPaginas(option('painel_lista_quant'));
			$c->setZines(option('painel_lista_quant'));
			$c->setLog(option('painel_log_quant'));
			$c->setGalerias(option('painel_lista_quant'));

			$urls = array(
				'novaPagina' => 'index.php/admin/paginas/novo',
				'editarPagina' => 'index.php/admin/paginas/editar',
				'apagarPagina' => 'index.php/admin/paginas/apagar',
				'listarPagina' => 'index.php/admin/paginas/listar/1',
				'novoProjeto' => 'index.php/admin/projetos/novo',
				'editarProjeto' => 'index.php/admin/projetos/editar',
				'apagarProjeto' => 'index.php/admin/projetos/apagar',
				'listarProjeto' => 'index.php/admin/projetos/listar/1',
				'novoPost' => 'index.php/admin/blog/novo',
				'editarPost' => 'index.php/admin/blog/editar',
				'apagarPost' => 'index.php/admin/blog/apagar',
				'listarPost' => 'index.php/admin/blog/listar/1',
				'novaGaleria' => 'index.php/admin/galerias/novo',
				'editarGaleria' => 'index.php/admin/galerias/editar',
				'apagarGaleria' => 'index.php/admin/galerias/apagar',
				'listarGaleria' => 'index.php/admin/galerias/listar/1',
				'novoZine' => 'index.php/admin/zines/novo',
				'editarZine' => 'index.php/admin/zines/editar',
				'apagarZine' => 'index.php/admin/zines/apagar',
				'listarZine' => 'index.php/admin/zines/listar/1',
			);

			$gen = new UrlHelper($urls);
			$c->setDado('l',$gen);

			$v = new View('layouts/admin.layout.tpl.php','backend/painel.tpl.php');
			return $v->render($c->getDados());
			
		} else {
			UrlHelper::ajax_redirect('index.php/entrar');
		}
	}

}

?>
