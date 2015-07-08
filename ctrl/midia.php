<?php

/**
 * Ações dos dbs de mídia
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


class Midia
{

	/*
	*
	* listar docs em JSON
	* 
	*
	* @param
	*
	* return void
	*/
	public static function listarDocs()
	{
		if (Porteiro::logado()) {
			$m = new Projeto(option('db'),'projetos','projetoId');
			$docs = $m->listarDocs($num);
			return json($docs);
		}
	}

	/*
	*
	* muda a galeria selecionada para
	* zines, projetos e paginas
	*
	* @param
	*
	* return void
	*/

	public static function atualizarGaleria() {
		if (Porteiro::logado()) {
			
			// resolve qual modelo sera usado
			$nome = params('modelo');
			if ($nome == 'paginas') {
				$m = new Pagina(option('db'));
			} elseif ($nome == 'projetos') {
				$m = new Projeto(option('db'));
			} elseif ($nome == 'zines') {
				$m = new Zine(option('db'));
			} else {
				halt(HTTP_FORBIDDEN, 'Você está fazendo merdinha.');
			}

			$pId = params('pid');
			$gId = params('gid');

			$m->atualizarGaleria($pId,$gId);

		} else {
			UrlHelper::ajax_redirect('index.php/entrar');
		}
	}


	/*
	*
	* muda a capa selecionada para
	* zines, projetos e paginas
	*
	* @param
	*
	* return void
	*/

	public static function atualizarCapa() {
		if (Porteiro::logado()) {
			$nome = params('modelo');
			if ($nome == 'paginas') {
				$m = new Pagina(option('db'));
			} elseif ($nome == 'projetos') {
				$m = new Projeto(option('db'));
			} elseif ($nome == 'zines') {
				$m = new Zine(option('db'));
			} else {
				halt(HTTP_FORBIDDEN, 'Você está fazendo merdinha.');
			}

			$pId = params('pid');
			$fId = params('fid');

			return $m->atualizarCapa($pId,$fId);

		} else {
			UrlHelper::ajax_redirect('index.php/entrar');
		}
	}


	/*
	*
	* apagar a capa selecionada para
	* zines, projetos e paginas
	*
	* @param
	*
	* return void
	*/

	public static function apagarCapa() {
		if (Porteiro::logado()) {
			$nome = params('modelo');
			if ($nome == 'paginas') {
				$m = new Pagina(option('db'));
			} elseif ($nome == 'projetos') {
				$m = new Projeto(option('db'));
			} elseif ($nome == 'zines') {
				$m = new Zine(option('db'));
			} else {
				halt(HTTP_FORBIDDEN, 'Você está fazendo merdinha.');
			}

			$pId = params('pid');

			$m->apagarCapa($pId);

		} else {
			UrlHelper::ajax_redirect('index.php/entrar');
		}
	}

	/*
	*
	* seletor de galerias
	*
	* @param
	*
	* return void
	*/
	public static function seletorCapa() {
		$id = params('id');
		$v = new View('','blocos/capa.galeria.tpl.php');
		$c = new Galeria(option('db'));
		$dados['conteudo'] = $c->fotosGaleria($id);
		$dados['l'] = new UrlHelper(array());
		return $v->render($dados);
		
	}


	/*
	*
	* muda a documento selecionado para
	* projetos
	*
	* @param
	*
	* return void
	*/

	public static function atualizarDoc() {
		if (Porteiro::logado()) {
			$nome = params('modelo');
			if ($nome == 'projetos') {
				$m = new Projeto(option('db'));
			} else {
				halt(HTTP_FORBIDDEN, 'Você está fazendo merdinha.');
			}

			$pId = params('pid');
			$dId = params('did');

			$m->atualizarDoc($pId,$gId);

		} else {
			UrlHelper::ajax_redirect('index.php/entrar');
		}
	}

	/*
	* retorna fotos da galeria em JSON
	*
	*
	* @param
	*
	* return string json
	*/
	public static function fotosGaleria() {
		if (Porteiro::logado()) {
			$m = new Galeria(option('db'));
			return json($m->fotosGaleria(params('id')));
		} else {
			UrlHelper::ajax_redirect('index.php/entrar');
		}
	}
	
	/*
	* insere imagem na galeria
	*
	*
	* @param
	* 
	* return void
	* 
	*/
	public static function assocFotoGaleria() {
		if (Porteiro::logado()) {
			$foto = params('fid');
			$galeria = params('gid');

			$c = new Arquivo(option('db'));
			$c->assocFotoGaleria($foto,$galeria);
		} else {
			UrlHelper::ajax_redirect('index.php/entrar');
		}
	}


	/*
	* apaga foto da galeria
	*
	*
	* @param
	*
	* return string void
	*/
	public static function deleteFotoGaleria() {
		if (Porteiro::logado()) {
			$foto = params('fid');
			$galeria = params('gid');
			$c = new Arquivo(option('db'));
			$c->deleteFotoGaleria($foto,$galeria);
		} else {
			UrlHelper::ajax_redirect('index.php/entrar');
		}
	}
	
	/*
	* muda capa da galeria
	*
	*
	* @param
	*
	* 
	*/
	public static function assocFotoCapa() {
		if (Porteiro::logado()) {
			$cId = params('cid');
			$fId = params('fid');

			$modelo = params('modelo');
			if ($modelo == 'paginas' || $modelo == 'projetos') {
				if ($modelo == 'paginas') $cPk = 'paginaId' ;
				if ($modelo == 'projetos') $cPk = 'projetoId' ;
				$c = new Arquivo(option('db'));
				$c->deleteFotoComp($modelo,$cPk,$cId,$fId);

			}

		} else {
			UrlHelper::ajax_redirect('index.php/entrar');
		}
	}
	
	/*
	* apaga capa da galeria
	*
	*
	* @param
	*
	* return void
	* 
	*/
	public static function deleteFotoCapa() {
		if (Porteiro::logado()) {
			$cId = params('cid');

			$modelo = params('modelo');
			if ($modelo == 'paginas' || $modelo == 'projetos') {
				if ($modelo == 'paginas') $cPk = 'paginaId' ;
				if ($modelo == 'projetos') $cPk = 'projetoId' ;
				$c = new Arquivo(option('db'));
				$c->deleteFotoComp($modelo,$cPk,$cId);

			}

		} else {
			UrlHelper::ajax_redirect('index.php/entrar');
		}
	}



	/*
	*
	* lista de galerias
	*
	* @param
	*
	* return string / void
	*/

	public static function listarGaleria() {
		if (Porteiro::logado()) {
			$m = option('db');
			$c = new Galeria($m);
			$pg = params('pg');
			$pp = option('por_pagina');
			$ordem = array('titulo','ASC');
			if (params('chave') && params('ordem')) $ordem = array(params('chave'),params('ordem'));
			$c->listar($pp,$pg,"",$ordem);
			$v = new View('layouts/lista.layout.tpl.php','listas/galerias.tpl.php');

			if (isset($_SESSION['mensagem'])) {
				$c->setDado('mensagem',$_SESSION['mensagem']);
				unset($_SESSION['mensagem']);
			}			

			$urls = array(
				'nova' => 'index.php/admin/galerias/novo',
				'editar' => 'index.php/admin/galerias/editar',
				'apagar' => 'index.php/api/galerias/apagar',
				'ativar' => 'index.php/api/galerias/ativar',
				'desativar' => 'index.php/api/galerias/desativar',
				'listaController' => '/public/assets/jsCtrl/galeriasListaController.js'

			);

			$gen = new UrlHelper($urls);
			$c->setDado('l',$gen);

			return $v->render($c->getDados());
		}
		flash('proximo','index.php/admin/galerias/listar/1');
		UrlHelper::ajax_redirect('index.php/entrar');
	}


	/*
	* cria nova galeria
	*
	*
	* @param
	*
	* return void
	*/

	public static function novaGaleria() {
		if (Porteiro::logado()) {
				$m = option('db');
				$c = new Galeria($m);
				$post = array('ativo'=>0);
				$c->inserir($post);

				$id = $c->getDados();
				LogHelper::registrar(
					option('db'),
					$_SESSION['usuario']['username'],
					$_SESSION['usuario']['usuarioId'],
					'criou',
					'galerias',
					$id['conteudo']
				);
				UrlHelper::ajax_redirect('index.php/admin/galerias/editar/'.$id['conteudo'],'novo registro criado');
		}
		UrlHelper::ajax_redirect('index.php/entrar');
	}


	/*
	* edita galeria
	*
	*
	* @param
	*
	* return string / void
	*/

	public static function editarGaleria() {
		if (Porteiro::logado()) {
			$m = option('db');
			$c = new Galeria($m);
			$id = params('id');
			$c->mostrar($id);
			$v = new View('layouts/form.layout.tpl.php','backend/galeria.tpl.php');

			if (isset($_SESSION['mensagem'])) {
				$c->setDado('mensagem',$_SESSION['mensagem']);
				unset($_SESSION['mensagem']);
			}

			$urls = array(
				'salvar' => 'index.php/api/galerias/salvar/',
				'salvarOrdem' => 'index.php/api/galerias/ordem/salvar/',
				'novo' => 'index.php/admin/galerias/novo',
				'listar' => 'index.php/admin/galerias/listar/1',
				'apagar' => 'index.php/api/galerias/apagar/',
				'ativar' => 'index.php/api/galerias/ativar',
				'desativar' => 'index.php/api/galerias/desativar',
				'formController' => '/public/assets/jsCtrl/galeriasFormController.js',
			);

			$gen = new UrlHelper($urls);
			$c->setDado('l',$gen);

			return $v->render($c->getDados());
		}
		flash('proximo','index.php/admin/galerias/editar/'.params('id'));
		UrlHelper::ajax_redirect('index.php/entrar');
	}



	/*
	* salva galeria enviada pelo formulario
	*
	*
	* @param
	*
	* return void
	*/

	public static function salvarGaleria() {
		if (Porteiro::logado()) {
			$id = params('id');
			$m = option('db');
			$c = new Galeria($m);
			$post = $_POST;

			$c->modificar($post,$id);
				LogHelper::registrar(
					option('db'),
					$_SESSION['usuario']['username'],
					$_SESSION['usuario']['usuarioId'],
					'salvou',
					'galerias',
					$id['conteudo']
				);

			UrlHelper::ajax_redirect('index.php/admin/galerias/editar/'.$id['conteudo'],'registro modificado');
		}
		UrlHelper::ajax_redirect('index.php/entrar');
	}



	/*
	* cria galeria a partir de fotos inseridas
	* via upload multiplo
	*
	*
	* @param
	*
	* return void
	*/

	public function criarGaleriaFotos() {
		if (isset($_SESSION['arquivos'])) {
			$g = new Galeria(option('db'));
			$g->inserir(array('titulo'=>'galeria sem nome'));
			$gid = $g->getDados();
			$gid = $gid['conteudo'];
			$f = new Arquivo(option('db'));
			foreach (array_keys($_SESSION['arquivos']) as $c) {
				$fid = $_SESSION['arquivos'][$c];
				$f->assocFotoGaleria($fid,$gid);
			}
			unset($_SESSION['arquivos']);
			if (intval($gid)) {
				UrlHelper::ajax_redirect('index.php/admin/galerias/editar/'.$gid);
			}
			halt(HTTP_FORBIDDEN, 'Nenhuma foto subiu, você está fazendo merdinha.');

		}
	}



	public static function salvarOrdemGaleria()
	{
		if (Porteiro::logado()) {
			$post = $_POST;
			//var_dump($post);
			$db = option('db');
			$sql = "UPDATE fotos_galerias SET ordem=:ordem WHERE galeriaId=:galeriaId AND fotoId=:fotoId;";
			
			if (count($_POST['ordem']) == count($_POST['fotoId']) && count($_POST['fotoId']) == count($_POST['galeriaId'])) {
				$c = count($_POST['ordem']);
				$dados = array();
				for ($i = 0; $i < $c; $i++)
				{
					$bind = array(
						'galeriaId' => $post['galeriaId'][$i],
						'fotoId' => $post['fotoId'][$i],
						'ordem' => $post['ordem'][$i],
					);
					
					$dados[] = $db->run($sql,$bind);
				}
				return $dados;
			}

		} else {
			UrlHelper::ajax_redirect('index.php/entrar');
		}
	}

	/*
	* formulario de upload
	*
	*
	* @param
	*
	* return string / void
	*/

	public static function upload_form()
	{
		if (Porteiro::logado()) {
			set('l', new UrlHelper(array()));
			$urls = array(
				'listarFotos' => 'index.php/admin/arquivos/listar/1',
				'criarGaleria' => 'index.php/admin/galerias/fotos/criar',
			);
			set('l', new UrlHelper($urls));
			return html('backend/upload.tpl.php','');
		} else {
			flash('proximo','index.php/admin/upload');
			UrlHelper::ajax_redirect('index.php/entrar');
		}
	}


	/*
	* upload de arquivos
	*
	*
	* @param
	*
	* return void
	*/

	public static function upload() {
		if (Porteiro::logado()) {
			$opts = array(
				'midia_dir' => option('midia_dir'),
				'tamanhos' => array(
					'tn' => '75',
					'p' => '222',
					'm' => '726',
				),
				'tipos' => option('extensoes')
			);
			$u = new UploadHelper($opts);
			$u->exec();
		} else {
			flash('proximo','index.php/ffoupload');
			UrlHelper::ajax_redirect('index.php/entrar');
		}
	}

	/*
	*
	* apaga arquivo(s)
	*
	*
	* return void
	*/

	public static function apagarArquivo() {
		if (Porteiro::logado()) {
		// resolve parametros
			$id = params('id');
			$m = new Arquivo(option('db'));
			$arquivoMorto = $m->apagar($id);
			$arquivosMortos = array();
			$arquivosMortos[] = $arquivoMorto['nome'].'.'.$arquivoMorto['extensao'];
			// se é imagem, inclui as tns na lista
			if (in_array($arquivoMorto['extensao'],array('jpg','JPG','jpeg','JPEG','png','PNG','gif','GIF'))) {
				$arquivosMortos[] = $arquivoMorto['nome'].'_tn.'.$arquivoMorto['extensao'];
				$arquivosMortos[] = $arquivoMorto['nome'].'_m.'.$arquivoMorto['extensao'];
				$arquivosMortos[] = $arquivoMorto['nome'].'_p.'.$arquivoMorto['extensao'];
			}
			foreach ($arquivosMortos as $am) {
				var_dump(option('midia_dir').$am);
				if (is_writable(option('midia_dir').$am))
				{
					unlink(option('midia_dir').$am);
				} else {
					$_SESSION['mensagem'] = 'nao foi possivel apagar os arquivos do servidor';
				}
			}

			// registra operacao no log
			LogHelper::registrar(
				option('db'),
				$_SESSION['usuario']['username'],
				$_SESSION['usuario']['usuarioId'],
				'apagou',
				'arquivos',
				$id['conteudo']
			);

			UrlHelper::ajax_redirect('index.php/admin/arquivos/listar/1','registro apagado');
		}
		UrlHelper::ajax_redirect('index.php/entrar');
	}

}

?>
