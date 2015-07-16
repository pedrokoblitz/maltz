<?php

namespace Maltz\Mvc;


class View extends \Slim\View
{
    public function setLayout($layout = NULL, $data = array())
    {
        $this->_layout = $layout;
        $this->_data = $data;
    }

    public function setData($data = NULL)
    {
        $this->_data = $data;
    }

    /**
     * Overwrite the render method of Slim_View in order to include it in a layout
     */
    public function render($template)
    {
        $templatePath = $this->getTemplatesDirectory() . '/' . ltrim($template, '/');
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
        $templatePath = $this->getTemplatesDirectory() . '/partials/' . ltrim($template, '/');
        if (!file_exists($templatePath))
        {
            throw new RuntimeException('View cannot render template `' . $templatePath . '`. Template does not exist.');
        }

        extract($data);
        ob_start();
        require $templatePath;
        $html = ob_get_clean();
        // echo $html?
        return $html;
    }

    private function _renderLayout($content)
    {
        if(isset($this->_layout) && $this->_layout !== NULL)
        {
            $layoutPath = $this->getTemplatesDirectory() . '/' . ltrim($this->_layout, '/');
            if (!file_exists($layoutPath))
            {
                throw new RuntimeException('View cannot render layout `' . $layoutPath . '`. Layout does not exist.');
            }
            // Base layout variables
            extract($this->_data);
            ob_start();
            require $layoutPath;
            $view = ob_get_clean();
            return $view;
        }
        return $content;
    }
}
