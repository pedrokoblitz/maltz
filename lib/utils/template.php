<?php

/**
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

class TplHelper
{


	/*
	* gera carrossel de fotos
	*
	*
	* @param $fotos array
	* @param $pk int
	*
	* return bool
	*/

	public function fotosCarrossel($fotos,$pk){
		return false;
	}
	

	/*
	* insere bloco no template
	*
	*
	* @param $nome string
	*
	* return string
	*/

	public function bloco($nome){
		return partial('blocos/'.$nome.'.tpl.php');
	}


	/*
	* paginacao do admin
	*
	*
	* @param $pgs int
	* @param $componente string
	*
	* return string
	*/
	public function backEndPg($pgs,$componente) {
		if ($pgs < 2) {return false;}

		$html = '';
		$html .= '<div class="pagination"><ul>';
		if (params('pg') > 1) {
			$ant = params('pg') - 1;
			$html .= '<li><a href="'. url_for('index.php/admin/'.$componente.'/listar/'.$ant) . '">anterior</a></li>';
		} 

		for ($i = 1; $i <= $pgs; $i++)
		{
			if ($i < 5 || $i % 5 == 0 || $pgs - $i < 4) {
				if ($i == params('pg')) {$liclasse = 'class="active"';} else {$liclasse = '';}

				$html .= '<li ' .$liclasse. '">';
				$html .= '<a href="'.url_for('index.php/admin/'.$componente.'/listar/'.$i).'">'.$i.'</a>';
				$html .= '</li>';
			}
		}
		if (params('pg') < $pgs) {
			$prox = params('pg') + 1;
			$html .= '<li><a href="'.url_for('index.php/admin/'.$componente.'/listar/'.$prox).'">próxima</a></li>';

		} 
		$html .= '</ul></div>';
		return $html;
	}

	/*
	*
	* paginacao do frontend
	*
	* @param $pgs int
	* @param $componente string
	*
	* return string
	*/
	public function frontEndPg($pgs,$componente) {
		if ($pgs < 2) {return false;}

		$html = '';
		$html .= '<div class="pagination"><ul>';
		if (params('pg') > 1) {
			$ant = params('pg') - 1;
			$html .= '<li><a href="'. url_for('index.php/'.$componente.'/'.$ant); 
			if (params('cat') !== '') { $html .= '/'.params('cat');}
			$html .= '">anterior</a></li>';
		} 

		for ($i = 1; $i <= $pgs; $i++)
		{
			if ($i < 5 || $i % 5 == 0 || $pgs - $i < 4) {
				if ($i == params('pg')) {$liclasse = 'class="active"';} else {$liclasse = '';}

				$html .= '<li ' .$liclasse. '">';
				$html .= '<a href="'.url_for('index.php/'.$componente.'/'.$i);
				if (params('cat') !== '') { $html .= '/'.params('cat');}
				$html .= '">'.$i.'</a>';
				$html .= '</li>';
			}
		}
		if (params('pg') < $pgs) {
			$prox = params('pg') + 1;
			$html .= '<li><a href="'.url_for('index.php/'.$componente.'/'.$prox);
			if (params('cat') !== '') { $html .= '/'.params('cat');}
			$html .= '">próxima</a></li>';

		} 
		$html .= '</ul></div>';
		return $html;
	}

	/*
	* formata a data
	*
	*
	* @param $data array
	* @param $formato string
	*
	* return string
	*/

	public function data($data, $formato=null){
		$d = explode(' ',$data);
		$dd = array('data' => explode('-',$d[0]), 'hora' =>explode(':',$d[1]));
		$data = $dd['data'];
		$hora = $dd['hora'];
		$adata = $data[2] . '/' . $data[1] . '/' . $data[0];
		$ahora = $hora[0] . 'h' . $hora[1];

		switch ($formato)
		{
			case 'data':
				return $adata;
			break;
		
			case 'hora':
				return $ahora;
			break;
		
			case 'juntar':
				return 'às ' . $ahora . ' em ' . $adata;
			break;

			default:
				return $dd;
			break;
		}

		
	}


	/*
	* reduz o bloco de texto para 200 caracteres
	*
	*
	* @param $string string
	* @param $limit int
	* @param $pad int
	*
	* return string
	*/

	public function resumo($string, $limit=200, $pad=null)
	{
		$string = trim($string);		

		if(strlen($string) <= $limit){ 
			return strip_tags($string);
		}

		$string = substr($string, 0, $limit) . $pad;
		return strip_tags($string);
	}
	
}

?>
