<?php

namespace Maltz\Mvc;

/**
 * http://ideiasinsolitas.com.br/
 *
 * @copyright  Copyright (c) 2012-2013 Pedro Koblitz
 * @author      Pedro Koblitz pedrokoblitz@gmail.com
 * @license    GPL v2
 *
 * @package    Maltz
 *
 * @version    0.1 alpha
 */

/**
 * Adaptado por Pedro Koblitz
 * Classe Para validação da Dados
 * @author David CHC
 * @version 0.1
 *
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
    public static function int($data)
    {
        return self::validate("/^[0-9]$/", $data);
    }

    /**
     * Método que verifica se é numero real
     *
     * @param $data mixed
     *
     * @return bool
     */
    public static function float($data)
    {
        return self::validate("/^[0-9]+?(.|,[0-9]+)$/", $data);
    }

    /**
     * Método que verifica se é numero e/ou letras
     *
     * @param $data mixed
     *
     * @return bool
     */
    public static function alphanum($data)
    {
        return self::validate("/^[a-zA-Z0-9]$/", $data);
    }

    /**
     * Método que verifica se o email é válido
     *
     * @param $data mixed
     *
     * @return bool
     */
    public static function email($data)
    {
        if (filter_var($data, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /**
     * Método que verifica se a data esta no formato dd-mm-YYYY
     *
     * @param $data mixed
     *
     * @return bool
     */
    public static function date($data)
    {
        return self::validate("/^[0-9]{2}\-[0-9]{2}\-[0-9]{4}$/", $data);
    }

    /**
     * Método que verifica se url é valida
     *
     * @param $data mixed
     *
     * @return bool
     */
    public static function url($data)
    {
        return self::validate("/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/", $data);
    }

    /**
     * Método que verifica se o telefone está no formato 99-9999-9999
     *
     * @param $data mixed
     *
     * @return bool
     */
    public static function phone($data)
    {
        //(99)9999-9999
        return self::validate("/^[0-9]{2}-[0-9]{4}-[0-9]{4}$/", $data);
    }

    /**
     * Método que verifica
     *
     * @param $data mixed
     *
     * @return bool
     */
    public static function cnpj($data)
    {
        return self::validate("/^\d{3}.?\d{3}.?\d{3}/?\d{3}-?\d{2}$/", $data);
    }

    /**
     * Método que verifica
     *
     * @param $data mixed
     *
     * @return bool
     */
    public static function cpf($data)
    {
        return self::validate("/^\d{3}\.?\d{3}\.?\d{3}\-?\d{2}$/", $data);
    }

    /**
     * Método que verifica
     *
     * @param $data mixed
     *
     * @return bool
     */
    public static function cep($data)
    {
        return self::validate("^\d{5}\-?\d{3}$", $data);
    }
}
