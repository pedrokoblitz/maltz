<?php

namespace Maltz\Mvc;

class Template
{
    public static function decodeTextarea($string)
    {
        return html_entity_decode($string);
    }

    public static function renderPagination($pagination)
    {

    }

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

    public static function formatDate($date)
    {
        return new \DateTime($date);
    }
}