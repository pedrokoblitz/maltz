<?php

namespace Maltz\Sys\Model;

use Maltz\Mvc\Model;
use SimplePie;

/**
 * ESSE COMPONENTE NAO ACESSA DIRETAMENTE O BANCO DE DADOS
 * NAO DEVE ESTENDER O CTRL
 *
 * Utiliza feed RSS como base de data
 * depende de SimplePie http://simplepie.org
 *
 * http://ideiasinsolitas.com.br/
 *
 * @copyright  Copyright (c) 2012-2013 Pedro Koblitz
 * @author      Pedro Koblitz pedrokoblitz@gmail.com
 * @license    GPL v2
 *
 * @package    Meu CMS ainda nÃ£o tem name
 *
 * @version    0.1 alpha
 */

class Rss extends Model
{

    // url do feed
    private $url;

    /*
	 * construtor
	 *
	 *
	 * @param objeto DB
	 *
	 * return void
	 */

    public function __construct($url)
    {
        $this->url = $url;
    }

    /*
	 *
	 * @param $n int
	 *
	 * return array
	 */

    public function getFeed($n = null)
    {
        $feed = new SimplePie();
        $feed->set_cache_location('./.cache');

        $feed->set_feed_url($this->url);
        $success = $feed->init();
        $feed->handle_content_type();
        $items = array();

        $feedItems = $feed->get_items();
        foreach ($feedItems as $item) {
            $items[]['link'] = $item->get_permalink();
            $items[]['title'] = $item->get_title();
            $items[]['body'] = $item->get_content();
            $items[]['tag'] = $item->get_category();
        }

        $filteredItems = array();
        foreach ($items as $i) {
            if (isset($i['body'])) {
                $filteredItems[] = $i;
            }
        }

        $c = count($filteredItems);
        if ($n && $n < $c) {
            $filteredItems = array_slice($filteredItems, 0, $n);
        }

        return $filteredItems;
    }
}
