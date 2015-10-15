<?php

namespace Maltz\Mvc;

class Template
{
    /**
     * /
     * @param  [type] $string [description]
     * @return [type]         [description]
     */
    public static function decodeTextarea($string)
    {
        return html_entity_decode($string);
    }

    /**
     * /
     * @param  [type] $pagination [description]
     * @return [type]             [description]
     */
    public static function renderPagination($pagination)
    {

    }

    /**
     * /
     * @param  [type]  $menu  [description]
     * @param  integer $level [description]
     * @return [type]         [description]
     */
    public static function renderMenu($menu, $level = 0)
    {
        $html = '';
        foreach ($menu as $key => $value) {
            if (is_array($value)) {
                $level++;
                $this->renderMenu($value, $level);
            }
            $html .= $value;
        }
        return $html;
    }

    /**
     * /
     * @param  [type] $date [description]
     * @return [type]       [description]
     */
    public static function formatDate($date)
    {
        return new \DateTime($date);
    }
}
