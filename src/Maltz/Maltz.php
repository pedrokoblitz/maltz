<?php

namespace Maltz;

use Maltz\Http\CookieJar;
use Maltz\Http\Session;
use Maltz\Http\Nonce;
use Maltz\Mvc\DB;
use Maltz\Mvc\Query;
use Maltz\Mvc\HttpHandler;
use Maltz\Sys\Model\Config;
use Maltz\Sys\Model\Term;
use Maltz\Service\Postman;
use Maltz\Service\Correios;
use Maltz\Service\Pagination;
use Maltz\Service\Dorman;
use Maltz\Service\LogHelper;
use Slim\Slim;

class Maltz
{

    /*
	 *
	 * app config
	 *
	 */
    public static function initialize()
    {
        $app = new Slim();

        $app->config(array(
            'debug' => true,
            'templates.path' => './views',
            'base.uri' => '/',
            'capa_blog_quant' => '4',
            'capa_books_quant' => '5',
            'capa_contents_quant' => '6',
            'tumblr_rss_url' => 'http://teste.com',
            'per_page' => '12'
        ));

        //db
        $app->container->singleton('db', function () {
            //return new DB('mysql:dbname=db169616_cms;host=internal-db.s169616.gridserver.com', 'db169616', 'morte666');
            return new DB('mysql:dbname=maltz;host=localhost', 'root', 'root');
        });

        $app->session = function () {
            return new Session();
        };

        $app->cookie = function () {
            return new CookieJar();
        };

        $app->nonce = function () {
            return new Nonce($app->session);
        };

        $app->httpHandler = function () {
            return new HttpHandler($app);
        }

        $app->query = function () {
            return new Query($app->db);
        }

        $app->activity = function () use ($app) {
            return new LogHelper($app->db);
        };

        $app->porteiro = function () use ($app) {
            return new Doorman($app->db, $app->session, $app->cookie);
        };

        $app->container->singleton('view', function () {
            return new View($app->container['settings']);
        });

        $app->hook('slim.before', function () use ($app) {

        });

        $app->hook('slim.after', function () use ($app) {

        });
        
        $app->auth = function () use ($app) {

            $keys = array(
                'user.authenticated',
                'user.level',
                'user.username',
                'user.email',
                'user.name',
                'token.auth',
                'token.remember',
                'token.forgot',
                'token.signup',
            );
            return new SessionCookieAuthHandler($app->session, $app->cookie, $keys);
        };

        $app->pagination = function () {
            return new Pagination();
        };

        $app->carteiro = function () {
            return new Postman();
        };

        $app->correios = function () {
            return new Correios();
        };

        // config
        $configModel = new Config($app->db);
        $configModel->index(999, 1);
        $configRows = $configModel->all();
        if ($configRows['data.list']) {
            foreach ($configRows['data.list'] as $rec) {
                $app->config($rec['key'], $rec['value']);
            }
        }
/*
        $terms = array();
        $termModel = new Term($app->db);
        $termModel->getAllLinks();
        $termRows = $termModel->all();
        if (isset($termRows['data.list'])) {
            foreach ($termRows['data.list'] as $rec) {
                $terms[] = $rec;
            }
        }
        $app->config('menu', $terms);
*/

        // types/categorias dos contents
        $avaiable_types = array(
            array("foto", array("photografia", "photography")),
            array("texto", array("texto", "text")),
            array("video", array("vídeo", "video")),
            array("multimidia", array("multimídia", "multimedia")),
            array("instalacao", array("instalação", "installation")),
            array("exposicao", array("exposição", "exhibition")),
            array("livro", array("livro", "book")),
            array("reportagem", array("reportagem", "reportage")),
            array("publicacao", array("publicação", "publication")),
            array("semcategoria", array("sem categoria", "uncategorized")),
        );

        // seleciona types já utilizados
        $t = $configModel->types();

        // filtra disponiveis, baseado nos utilizado
        $types = array();
        foreach ($avaiable_types as $type) {
            if (in_array($type[0], $t)) {
                $types[] = $type;
            }
        }

        $app->config('types', $types);

        $extensions = array(
            'pdf', 'PDF',
            'jpg', 'JPG',
            'gif', 'GIF',
            'jpeg', 'JPEG',
            'png', 'PNG',
            'doc', 'DOC',
            'ppt', 'PPT',
            'pps', 'PPS',
        );

        $app->config('extensions', $extensions);

        $controllers = array(
            'Maltz\Content\Ctrl\Site',
            'Maltz\Content\Ctrl\Content',
            'Maltz\Media\Ctrl\Media',
            //'Maltz\Sys\Ctrl\Asset',
            'Maltz\Sys\Ctrl\Sys',
            'Maltz\Sys\Ctrl\Api',
        );

        foreach ($controllers as $controller) {
            $ctrl = new $controller();
            $app = $ctrl->route($app);
        }
/*
        if ($app->config('routing.refresh') === "1") {
            $result = array();
            $routes = $app->router()->getNamedRoutes();
            foreach ($routes as $route) {
                $pattern = $route->getPattern();
                $name = $route->getName();
                $term = array('name' => $name, 'type' => 'route', 'url' => $pattern);
                $termModel->insert($menu);
            }
            $configModel->update('config', array('value' => "false"), "key=\"routing.refresh\"");
        }
*/
        return $app;
    }
}
