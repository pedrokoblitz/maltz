<?php

namespace Maltz\Mvc;


class View extends \Slim\View
{
    protected $layout;
    protected $layoutData;
    protected $scripts;
    protected $styles;
    protected $meta;

    public function setLayout($layout = NULL, array $data = array())
    {
        $this->layout = $layout;
        $this->layoutData = $data;
        $this->scripts = array();
        $this->styles = array();
        $this->meta = array();
    }

    public function setLayoutData(array $data = array())
    {
        $this->layoutData = $data;
    }

    public function setMetaProperty($name, $content)
    {
        $this->meta[$name] = $content;
    }

    public function enqueueStyle($name, $style)
    {
        $this->styles[$name] = $style;
    }

    public function enqueueScript($name, $script)
    {
        $this->scripts[$name] = $script;
    }

    public function renderPageMeta()
    {
        $string = '';
        foreach ($this->meta as $name => $content) {
            $string .= '';
        }
        return $string;
    }

    public function renderPageTitle()
    {
        $pageTitle = $this->app->config('site_title') . ' - ' . $this->app->config('site_tagline');
    }

    public function renderStyles()
    {
        $string = '';
        foreach ($this->meta as $name => $content) {
            $string .= '';
        }
        return $string;
    }

    public function renderScripts()
    {
        $string = '';
        foreach ($this->meta as $name => $content) {
            $string .= '';
        }
        return $string;
    }

    public function renderPageHeader()
    {
        $data = array(
            'title' => $this->renderPageTitle(),
            'css' => $this->renderStyles(),
            'meta' => $this->renderPageMeta()
            );
        $this->partial('html.header.tpl.php');
    }

    public function renderPageFooter()
    {
        $data = array(
            'js' => $this->renderScripts()
            );
        $this->partial('html.footer.tpl.php');
    }

    /**
     * Overwrite the render method of Slim_View in order to include it in a layout
     */
    public function render($template)
    {
        $separator = isset($this->layout) ? '/' . $this->layout . '/' : '/';
        $templatePath = $this->getTemplatesDirectory() . $separator . ltrim($template, '/') . 'tpl.php';
        if (!file_exists($templatePath))
        {
            throw new RuntimeException('View cannot render template `' . $templatePath . '`. Template does not exist.');
        }

        extract($this->data->all());
        ob_start();
        require $templatePath;
        $html = ob_get_clean();
        return $this->_renderLayout($html);
    }

    public function partial($template, $data = array())
    {
        $templatePath = $this->getTemplatesDirectory() . '/partials/' . ltrim($template, '/') . 'tpl.php';
        if (!file_exists($templatePath))
        {
            throw new RuntimeException('View cannot render template `' . $templatePath . '`. Template does not exist.');
        }

        $data !== array() ? extract($data) : null;
        ob_start();
        require $templatePath;
        $html = ob_get_clean();
        // echo $html?
        return $html;
    }

    private function _renderLayout($content)
    {
        if(isset($this->layout) && $this->layout !== NULL)
        {
            $layoutPath = $this->getTemplatesDirectory() . '/layouts/' . ltrim($this->layout, '/') . 'tpl.php';
            if (!file_exists($layoutPath))
            {
                throw new RuntimeException('View cannot render layout `' . $layoutPath . '`. Layout does not exist.');
            }

            extract($this->layoutData);
            ob_start();
            require $layoutPath;
            $view = ob_get_clean();
            return $view;
        }
        return $content;
    }
}
