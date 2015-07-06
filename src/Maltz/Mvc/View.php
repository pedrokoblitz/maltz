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
    protected $config;
    protected $layout;
    protected $view;
    protected $styleSheets = array();
    protected $conditionalStyleSheets = array();
    protected $javaScripts = array();
    protected $data = array();
    protected $filters = array();


    public function __construct($config, $layout = '', $view = '')
    {
        $this->config = $config;
        $this->layout = $layout;
        $this->view = $view;
        $this->data = array();
        $styleSheets = array();
        $javaScripts = array();
        $data = array();
        $filters = array();
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

    public function setTemplates($layout, $view)
    {
        $this->layout = $layout;
        $this->view = $view;
    }

    /*
    *
    *  diz qual layout serÃ¡ usado para render
    *
    * @param string
    *
    * return void
    */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    /*
    *
    * pega name do layout sendo utilizado
    *
    * @param
    *
    * return string
    */
    public function getLayout()
    {
        return $this->layout;
    }

    /*
    *
    * passa o template a ser utilizado no render
    *
    * @param string
    *
    * return void
    */
    public function setView($view)
    {
        $this->view = $view;
    }

    /*
    *
    * pega name do template sendo utilizado
    *
    * @param
    *
    * return string
    */
    public function getView()
    {
        return $this->view;
    }

    public function addFilter($callable)
    {
        if (is_callable($callable)) {
            $this->filters[] = $callable;
        }
    }

    /*
    *
    */
    public function set($key, $data)
    {
        $this->data[$key] = $data;
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

    public function setData($arg1, $arg2 = null)
    {
        if (is_string($arg1)) {
            $this->set($arg1, $arg2);
        }

        if (is_array($arg1) && !$arg2) {
            $this->data = is_array($this->data) && !empty($this->data) ? array_merge($arg1, $this->data) : $arg1;
        }

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
    public function render($data = array(), $layout = '', $view = '')
    {
        $l = new UrlHelper(array());

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

        $config = $this->config;

        if (is_array($this->data) && is_array($data)) {
            $data = array_merge($data, $this->data);
        } elseif (is_array($this->data)) {
            $data = $this->data;
        } else {
            $data = array();
        }

        if (!isset($this->layout) || empty($this->layout)) {
            ob_start();
            include $this->config['templates.path'] . '/' . $this->view;
            $body = ob_get_clean();

        } else {
            ob_start();
            include $this->config['templates.path'] . '/' . $this->view;
            $content = ob_get_clean();

            ob_start();
            include $this->config['templates.path'] . '/' . $this->layout;
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
        include $this->config['templates.path'] . '/' . $name;
        $partial = ob_get_clean();
        $this->e($partial);
    }

    public function e($string)
    {
        echo $string;
    }


    /*
    * pagination do admin
    *
    *
    * @param $pgs int
    * @param $component string
    *
    * return string
    */
    public function backEndPg($pgs, $component, $pg)
    {
        if ($pgs < 2) {
            return false;
        }

        $html = '';
        $html .= '<div class="pagination"><ul>';

        if ($pg > 1) {
            $ant = $pg - 1;
            $html .= '<li><a href="' . '/admin/' . $component . '/list/' . $ant . '">anterior</a></li>';
        }

        for ($i = 1; $i <= $pgs; $i++) {
            if ($i < 5 || $i % 5 == 0 || $pgs - $i < 4) {
                if ($i == $pg) {
                    $liclasse = 'class="active"';
                } else {
                    $liclasse = '';
                }

                $html .= '<li ' . $liclasse . '">';
                $html .= '<a href="' . '/admin/' . $component . '/list/' . $i . '">' . $i . '</a>';
                $html .= '</li>';
            }
        }

        if ($pg < $pgs) {
            $prox = $pg + 1;
            $html .= '<li><a href="/admin/' . $component . '/list/' . $prox . '">próxima</a></li>';
        }

        $html .= '</ul></div>';
        $this->e($html);
    }

    /*
    *
    * pagination do frontend
    *
    * @param $pgs int
    * @param $component string
    *
    * return string
    */
    public function frontEndPg($pgs, $component, $pg = 1, $cat = null)
    {
        if ($pgs < 2) {
            return false;
        }

        $html = '';
        $html .= '<div class="pagination"><ul>';
        if ($pg > 1) {
            $ant = $pg - 1;
            $html .= '<li><a href="' . '/' . $component . '/' . $ant;
            if ($cat !== '') {
                $html .= '/' . $cat;
            }
            $html .= '">anterior</a></li>';
        }

        for ($i = 1; $i <= $pgs; $i++) {
            if ($i < 5 || $i % 5 == 0 || $pgs - $i < 4) {
                if ($i == $pg) {
                    $liclasse = 'class="active"';

                } else {
                    $liclasse = '';
                }

                $html .= '<li ' . $liclasse . '">';
                $html .= '<a href="' . '/' . $component . '/' . $i;
                if ($cat !== '') {
                    $html .= '/' . $cat;
                }
                $html .= '">' . $i . '</a>';
                $html .= '</li>';
            }
        }
        if ($pg < $pgs) {
            $prox = $pg + 1;
            $html .= '<li><a href="' . '/' . $component . '/' . $prox;
            if ($cat) {
                $html .= '/' . $cat;
            }
            $html .= '">próxima</a></li>';

        }
        $html .= '</ul></div>';
        $this->e($html);
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
    public function date($data, $formato = null)
    {
        $d = explode(' ', $data);
        $dd = array('data' => explode('-', $d[0]), 'hora' => explode(':', $d[1]));
        $data = $dd['data'];
        $hora = $dd['hora'];
        $adata = $data[2] . '/' . $data[1] . '/' . $data[0];
        $ahora = $hora[0] . 'h' . $hora[1];

        switch ($formato) {
            case 'data':
                return $adata;
            break;

            case 'hora':
                return $ahora;
            break;

            case 'extenso':
                return 'às ' . $ahora . ' em ' . $adata;
            break;

            default:
                return $dd;
            break;
        }
    }

    /*
    * reduz o block de texto para 200 caracteres
    *
    *
    * @param $string string
    * @param $limit int
    * @param $pad int
    *
    * return string
    */
    public function excerpt($string, $limit = 200, $pad = 0)
    {
        $string = trim($string);

        if (strlen($string) <= $limit) {
            return strip_tags($string);
        }

        $string = substr($string, $pad, $limit);
        return strip_tags($string);
    }
}
