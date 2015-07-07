<?php
/**
 * db de configuração
 * guarda chaves e valores que são carregados a cada requisição
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

/*
*
*
*
* @param objeto DB
*
* return void
*/

class Config extends Modelo
{
	/*
	* construtor
	*
	* @param $db DB
	* 
	* return void
	* 
	*/
	public function __construct($db) 
	{
		parent::__construct($db,'config','configId');
	}

	/*
	* descobre quais categorias estao sendo utilizadas
	*
	* return array
	*
	*
	*/
	public function tipos() {
		$sql = "SELECT DISTINCT tipo FROM projetos;";
		$resultado = $this->db->run($sql);
		$tipos = array();
		foreach ($resultado as $r) {
			$tipos[] = $r['tipo'];
		}
		return $tipos;
	}
	
}
?>
