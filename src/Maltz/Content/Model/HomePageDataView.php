<?php

namespace Maltz\Content\Model;

use Maltz\Mvc\DataView;

class HomePageDataView extends Dataview
{
    public function display()
    {
        $blocks = Area::query($this->db, 'show', 'name');
        $menus = Collection::query($this->db, 'displayTreeByType', 'menu', 'main');
        $pages = Content::query($this->db, 'findByType', 'page');
        $works = Content::query($this->db, 'findByType', 'work');

        return array(
            'blocks' => $blocks->isSuccessful() ? $blocks->toArray() : null,
            'menu' => $menu->isSuccessful() ? $menu->toArray() : null,
            'pages' => $pages->isSuccessful() ? $pages->toArray() : null,
            'works' => $works->isSuccessful() ? $works->toArray() : null
            );
    }
}
