<?php

namespace Maltz\Mvc;

 use Maltz\Utils\UrlHelper;

/**
 * CONVENCOES DO View
 * as funcoes set(), js(), json() e css() sao parte da biblioteca limonade-php
 * http://limonade-php.net (ver pÃ¡gina do README para detalhes)
 *
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

// getcwd();
// dirname(__FILE__);
// basename(__DIR__)
// turn relative paths into absolute paths
// $abs_path = realpath('../path/to/binary');

/*
 *
 *
 *
 * @param objeto DB
 *
 *
 */

class View
{
    // PROPRIEDADES
    protected $path;
    protected $layout;
    protected $view;
    protected $styleSheets = array();
    protected $conditionalStyleSheets = array();
    protected $javaScripts = array();
    protected $data = array();
    protected $filters = array();


    public function __construct(Result $result)
    {
        $this->path = $this->result->get('templates.path');
        $this->layout = $this->result->get('layout');
        $this->view = $this->result->get('view');
        $this->data = $this->result->get('records');

        $styleSheets = array(
            'bootstrap' => '',
        );

        $javaScripts = array(
            'bootstrap' => '',
        );
    }

    public function addStyleSheet($name, $external = false)
    {
        $path = $name;
        if ($external === false) {
            $path = '/public/assets/css/' . $name;
        }
        $this->styleSheets[] = $path;
    }

    public function addConditionalStyleSheet($name, $ie, $external = false)
    {
        $path = $name;
        if ($external === false) {
            $path = '/public/assets/css/' . $name;
        }
        $this->conditionalStyleSheets[] = $path;
    }

    public function addJavaScript($name, $external = false)
    {
        $path = $name;
        if ($external === false) {
            $path = '/public/assets/js/' . $name;
        }
        $this->javaScripts[] = $path;
    }

    public function renderStyleSheets()
    {
        $string = "";
        foreach ($this->styleSheets as $sheet) {
            $string .= "<link rel=\"stylesheet\" href=\"$sheet\">";
        }

        foreach ($this->conditionalStyleSheets as $sheet) {
            $string .= "<link rel=\"stylesheet\" href=\"$sheet\">";
        }

        return $string;
    }

    public function renderJavaScripts()
    {
        $string = "";
        foreach ($this->javaScripts as $script) {
            $string .= "<script type=\"text/javascript\" src=\"$script\"></script>\n";
        }

        return $string;
    }

    /*
    * passa os data template html usando metodos do limonade-php
    * junta data com template e layout
    * devolve HTML
    *
    * @param
    *
    * return string
    */
    public function render()
    {
        $styles = $this->renderStyleSheets();
        $scripts = $this->renderJavaScripts();

        if ($layout != '') {
            $this->layout = $layout;
        }

        if ($view != '') {
            $this->view = $view;
        }

        // condicao de teste
        if (!is_array($this->data)) {
            $this->data = array($this->data);
        }

        $path = $this->path;

        if (is_array($this->data) && is_array($data)) {
            $data = array_merge($data, $this->data);
        } elseif (is_array($this->data)) {
            $data = $this->data;
        } else {
            $data = array();
        }

        if (!isset($this->layout) || empty($this->layout)) {
            ob_start();
            include $this->path . '/' . $this->view;
            $body = ob_get_clean();

        } else {
            ob_start();
            include $this->path . '/' . $this->view;
            $content = ob_get_clean();

            ob_start();
            include $this->path . '/' . $this->layout;
            $body = ob_get_clean();
        }
        
        return $body;
    }

    /*
    *
    * transforma data em JSON
    *
    * @param
    *
    * return string
    */
    public function renderJSON($data)
    {
        $this->e(json_encode($data));
    }


    /*
    * insere block no template
    *
    *
    * @param $name string
    *
    * return string
    */
    public function partial($name, $data = null)
    {
        ob_start();
        if (is_array($data)) {
            extract($data);
        }
        $l = new UrlHelper(array());
        include $this->path['templates.path'] . '/' . $name;
        $partial = ob_get_clean();
        $this->e($partial);
    }

    public function e($string)
    {
        echo $string;
    }
}
