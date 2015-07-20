<?php

namespace Maltz\Mvc;

class View extends \Slim\View
{
    const VIEW_FILE_EXTENSION = '.tpl.php';

    protected $layout;
    protected $layoutData;
    protected $scripts = array();
    protected $styles = array();
    protected $meta = array();

    public function setLayout($layout = null, array $data = array())
    {
        if (!is_string($layout)) {
            throw new \Exception("Error Processing Request", 001);
        }
        $this->layout = $layout;
        $this->layoutData = $data;
    }

    public function setLayoutData(array $data = array())
    {
        $this->layoutData = $data;
    }

    public function setMetaProperty($name, $content)
    {
        if (!is_string($name) || !is_string($content)) {
            throw new \Exception("Error Processing Request", 002);
        }
        $this->meta[$name] = $content;
    }

    public function setCharset($charset)
    {
        if (!is_string($charset)) {
            throw new \Exception("Error Processing Request", 003);
        }
        $this->charset = $charset;
    }

    public function setHttpEquivMeta(bool $meta)
    {
        $this->httpEquivMeta = $meta;
    }

    public function enqueueStyle($name, $style)
    {
        if (!is_string($name) || !is_string($style)) {
            throw new \Exception("Error Processing Request", 004);
        }
        $this->styles[$name] = $style;
    }

    public function enqueueScript($name, $script)
    {
        if (!is_string($name) || !is_string($script)) {
            throw new \Exception("Error Processing Request", 005);
        }
        $this->scripts[$name] = $script;
    }

    public function renderPageMeta()
    {
        $string = '';
        foreach ($this->meta as $name => $content) {
            $string .= "<meta name=\"$name\" content=\"$content\">\n";
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
        foreach ($this->styles as $style) {
            $string .= "<link href=\"/public/assets/css/$style\" rel=\"stylesheet\">\n";
        }
        return $string;
    }

    public function renderScripts()
    {
        $string = '';
        foreach ($this->scripts as $script) {
            $string .= "<script src=\"/public/assets/js/$script\"></script>\n";
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
        return $this->partial('html.header', $data);
    }

    public function renderPageFooter()
    {
        $data = array(
            'js' => $this->renderScripts()
            );
        $this->partial('html.footer');
    }

    public function partial($template, $data = array())
    {
        $templatePath = $this->getTemplatesDirectory() . '/partials/' . ltrim($template, '/') . self::VIEW_FILE_EXTENSION;
        if (!file_exists($templatePath)) {
            throw new \RuntimeException('View cannot render template `' . $templatePath . '`. Template does not exist.');
        }

        $data !== array() ? extract($data) : null;
        ob_start();
        include $templatePath;
        $html = ob_get_clean();
        return $html;
    }

    private function renderLayout($content)
    {
        if (isset($this->layout) && $this->layout !== null) {
            $layoutPath = $this->getTemplatesDirectory() . '/layouts/' . ltrim($this->layout, '/') . self::VIEW_FILE_EXTENSION;
            if (!file_exists($layoutPath)) {
                throw new \RuntimeException('View cannot render layout `' . $layoutPath . '`. Layout does not exist.');
            }

            extract($this->layoutData);
            ob_start();
            include $layoutPath;
            $view = ob_get_clean();
            return $view;
        }
        return $content;
    }

    public function render($template)
    {
        $separator = isset($this->layout) ? '/' . $this->layout . '/' : '/';
        $templatePath = $this->getTemplatesDirectory() . $separator . ltrim($template, '/') . self::VIEW_FILE_EXTENSION;
        if (!file_exists($templatePath)) {
            throw new \RuntimeException('View cannot render template `' . $templatePath . '`. Template does not exist.');
        }

        extract($this->data->all());
        // reserved variables
        $title = $this->renderPageTitle();
        $meta = $this->renderPageMeta();
        $styles = $this->renderStyles();
        $header = $this->renderPageHeader();
        $scripts = $this->renderScripts();
        $footer = $this->renderPageFooter();
        ob_start();
        include $templatePath;
        $html = ob_get_clean();
        return $this->renderLayout($html);
    }
}
