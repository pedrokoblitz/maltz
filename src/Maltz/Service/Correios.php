<?php

namespace Maltz\Service;

/**
 * http://ideiasinsolitas.com.br/
 *
 * @copyright Copyright (c) 2012-2013 Pedro Koblitz
 * @author    Pedro Koblitz pedrokoblitz@gmail.com
 * @license   GPL v2
 *
 * @package Maltz
 * @subpackage Service
 *
 * @version 0.1 alpha
 */

class Correios
{
    /**
     * /
     * @param  [type] $cod_servico     [description]
     * @param  [type] $cep_origem      [description]
     * @param  [type] $cep_destino     [description]
     * @param  [type] $peso            [description]
     * @param  string $altura          [description]
     * @param  string $largura         [description]
     * @param  string $comprimento     [description]
     * @param  string $value_declarado [description]
     * @return [type]                  [description]
     */
    public function getShippingCost(
        $cod_servico,
        $cep_origem,
        $cep_destino,
        $peso,
        $altura = '5',
        $largura = '10',
        $comprimento = '15',
        $value_declarado = '0.50'
    ) {
        // Código dos Serviços dos Correios
        // 41106 PAC sem contrato
        // 40010 SEDEX sem contrato
        // 40045 SEDEX a Cobrar, sem contrato
        // 40215 SEDEX 10, sem contrato

        $correios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=" . $cep_origem . "&sCepDestino=" . $cep_destino . "&nVlPeso=" . $peso . "&nCdFormato=1&nVlComprimento=" . $comprimento . "&nVlAltura=" . $altura . "&nVlLargura=" . $largura . "&sCdMaoPropria=n&nVlValorDeclarado=" . $value_declarado . "&sCdAvisoRecebimento=n&nCdServico=" . $cod_servico . "&nVlDiametro=0&StrRetorno=xml";
        $xml = simplexml_load_file($correios);
        if ($xml->cServico->Erro == '0') {
            return $xml->cServico->Valor;
        } else {
            return false;
        }

    }

    /**
     * /
     * @param  [type] $cep [description]
     * @return [type]      [description]
     */
    public function searchCep($cep)
    {
        $curl = new Curl();
        $resposta = $curl->get('http://republicavirtual.com.br/web_cep.php', array('cep' => urlencode($cep), 'formato' => 'json'));
        return $resposta->body;
    }
}
