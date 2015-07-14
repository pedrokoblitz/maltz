<?php

namespace Maltz\Mvc;

use Slim\View as SlimView;

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

class View extends SlimView
{
    // PROPRIEDADES
    protected $path;
    protected $styleSheets = array();
    protected $conditionalStyleSheets = array();
    protected $javaScripts = array();
    protected $filters = array();

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
    public function _render($view, $layout = '', $data = array())
    {
        $styles = $this->renderStyleSheets();
        $scripts = $this->renderJavaScripts();

        if ($layout === '') {
            ob_start();
            if (is_array($data)) {
                extract($data);
            }
            include $this->path . '/' . $view;
            $body = ob_get_clean();

        } else {
            ob_start();
            if (is_array($data)) {
                extract($data);
            }
            include $this->path . '/' . $view;
            $content = ob_get_clean();

            ob_start();
            include $this->path . '/' . $layout;
            $body = ob_get_clean();
        }
        
        return $body;
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
