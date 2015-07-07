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

class Correios 
{
	/* 
	 *  calcula preco do frete
	 * 
	 *	@param $cod_servico string
	 *	@param $cep_origem string
	 *	@param $cep_destino string
	 *	@param $peso string
	 *	@param $altura string
	 *	@param $largura string
	 *	@param $comprimento string
	 *	@param $valor_declarado string
	 * 
	 * return string
	 *  
	 *  
	 */  
	public static function calculaFrete
	(
		$cod_servico, 
		$cep_origem, 
		$cep_destino, 
		$peso, 
		$altura='5', 
		$largura='10', 
		$comprimento='15', 
		$valor_declarado='0.50'
	)
	{
		# Código dos Serviços dos Correios
		# 41106 PAC sem contrato
		# 40010 SEDEX sem contrato
		# 40045 SEDEX a Cobrar, sem contrato
		# 40215 SEDEX 10, sem contrato

		$correios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=".$cep_origem."&sCepDestino=".$cep_destino."&nVlPeso=".$peso."&nCdFormato=1&nVlComprimento=".$comprimento."&nVlAltura=".$altura."&nVlLargura=".$largura."&sCdMaoPropria=n&nVlValorDeclarado=".$valor_declarado."&sCdAvisoRecebimento=n&nCdServico=".$cod_servico."&nVlDiametro=0&StrRetorno=xml";
		$xml = simplexml_load_file($correios);
		if($xml->cServico->Erro == '0')
			return $xml->cServico->Valor;
		else
			return false;
	}


	/* 
	 *  Função de busca de Endereço pelo CEP 
	 * @param $cep string
	 * 
	 * return string
	 * 
	 */  
	public static function buscaCep($cep){  
		  $curl = new Curl();
		  $resposta = $curl->get('http://republicavirtual.com.br/web_cep.php',array('cep'=>urlencode($cep), 'formato'=>'json'));  
		  return $resposta->body;  
	}  
}


?>
