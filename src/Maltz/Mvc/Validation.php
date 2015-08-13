<?php

namespace Maltz\Mvc;

/**
 * http://ideiasinsolitas.com.br/
 *
 * @copyright Copyright (c) 2012-2013 Pedro Koblitz
 * @author    Pedro Koblitz pedrokoblitz@gmail.com
 * @license   GPL v2
 *
 * @package Maltz
 *
 * @version 0.1 alpha
 */

/**
 * Adaptado por Pedro Koblitz
 * Classe Para validação da Dados
 * @author David CHC
 * @version 0.1
 */
class Validation
{

    /**
     * Método que executa a regexp
     *
     * @param $expressao string
     * @param $data mixed
     *
     * @return bool
     */
    private function validate($expression, $data)
    {
        if (preg_match($expression, $data, $match)) {
            return $match;
        }
        return false;
    }

    /**
     * Método que verifica se é numero
     *
     * @param $data mixed
     *
     * @return bool
     */
    public function int($data)
    {
        return $this->validate("/^[0-9]$/", $data);
    }

    /**
     * Método que verifica se é numero real
     *
     * @param $data mixed
     *
     * @return bool
     */
    public function float($data)
    {
        return $this->validate("/^[0-9]+?(.|,[0-9]+)$/", $data);
    }

    /**
     * Método que verifica se é numero e/ou letras
     *
     * @param $data mixed
     *
     * @return bool
     */
    public function alphanum($data)
    {
        return $this->validate("/^[a-zA-Z0-9]$/", $data);
    }

    /**
     * Método que verifica se o email é válido
     *
     * @param $data mixed
     *
     * @return bool
     */
    public function email($data)
    {
        return filter_var($data, FILTER_VALIDATE_EMAIL);
    }

    public function datetime($data)
    {
        return new \DateTime($data);
    }

    public function slug($text)
    {
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        $text = trim($text, '-');
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = strtolower($text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        if (empty($text))
        {
            return 'n-a';
        }
        return $text;
    }

    public function string($data)
    {
        return filter_var($data, FILTER_SANITIZE_STRING);
    }

    public function textarea($html)
    {
        $html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);
        $html = preg_replace("/<img[^>]+\>/i", "", $html);
        return htmlentities($html);
    }

    /**
     * Método que verifica se url é valida
     *
     * @param $data mixed
     *
     * @return bool
     */
    public function url($data)
    {
        return $this->validate("/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/", $data);
    }

    /**
     * Método que verifica se o telefone está no formato (99) 9999-9999
     *
     * @param $data mixed
     *
     * @return bool
     */
    public function phone($data)
    {
        return $this->validate("/^\([0-9]{2}\)-[0-9]{4}-[0-9]{4}$/", $data);
    }

    /**
     * Método que verifica se o telefone está no formato (99) 99999-9999 ou (99) 9999-9999
     *
     * @param $data mixed
     *
     * @return bool
     */
    public function cellphone($data)
    {
        //(99)9999-9999
        return $this->validate("/^\([0-9]{2}\) [0-9]{4-5}-[0-9]{4}$/", $data);
    }

    /**
     * Método que verifica
     *
     * @param $data mixed
     *
     * @return bool
     */
    public function cnpj($data)
    {
        return $this->validate("/^\d{3}.?\d{3}.?\d{3}/?\d{3}-?\d{2}$/", $data);
    }

    /**
     * Método que verifica
     *
     * @param $data mixed
     *
     * @return bool
     */
    public function cpf($data)
    {
        return $this->validate("/^\d{3}\.?\d{3}\.?\d{3}\-?\d{2}$/", $data);
    }

    /**
     * Método que verifica
     *
     * @param $data mixed
     *
     * @return bool
     */
    public function cep($data)
    {
        return $this->validate("^\d{5}\-?\d{3}$", $data);
    }
}
