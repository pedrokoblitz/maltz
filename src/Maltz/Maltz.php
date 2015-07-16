<?php

namespace Maltz;

use Maltz\Http\CookieJar;
use Maltz\Http\Session;
use Maltz\Http\Nonce;
use Maltz\Mvc\DB;
use Maltz\Mvc\View;
use Maltz\Sys\Model\Config;
use Maltz\Service\SessionDataStore;
use Maltz\Service\Handler;
use Maltz\Service\Postman;
use Maltz\Service\Doorman;
use Maltz\Service\Correios;
use Maltz\Service\Pagination;
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
        
        /* LOG LEVELS

            \Slim\Log::EMERGENCY
            \Slim\Log::ALERT
            \Slim\Log::CRITICAL
            \Slim\Log::ERROR
            \Slim\Log::WARN
            \Slim\Log::NOTICE
            \Slim\Log::INFO
            \Slim\Log::DEBUG

            USAGE

        */
        $logger = new \Flynsarmy\SlimMonolog\Log\MonologWriter(array(
            'handlers' => array(
                new \Monolog\Handler\StreamHandler('./logs/dev.log'),
            ),
        ));

        $view = new View();

        $app->config(array(
            'log.writer' => $logger,
            'mode' => 'development',
            'debug' => true,
            'view' => $view,
            'templates.path' => './views',
            'base.uri' => '/',
            'capa_blog_quant' => '4',
            'capa_books_quant' => '5',
            'capa_contents_quant' => '6',
            'tumblr_rss_url' => 'http://teste.com',
            'per_page' => '12'
        ));

        $app->session = function () {
            return new Session();
        };

        $app->cookie = function () {
            return new CookieJar();
        };

        $app->sessionDataStore = function () use ($app) {
            return new SessionDataStore($app->session);
        };

        $app->nonce = function () use ($app) {
            return new Nonce($app->session);
        };

        $app->handler = function () use ($app) {
            return new Handler($app);
        };

        $app->doorman = function () use ($app) {
            return new Doorman($app->db, $app->sessionDataStore, $app->cookie);
        };

        $app->hook('slim.before', function () use ($app) {

        });

        $app->hook('slim.after', function () use ($app) {

        });
        
        $app->container->singleton('db', function () use ($app) {
            return new DB($app->config('db.dsn'), $app->config('db.user'), $app->config('db.pass'));
        });

        $app->pagination = function () {
            return new Pagination();
        };

        $app->postman = function () {
            return new Postman();
        };

        $app->correios = function () {
            return new Correios();
        };
        
        $app->lang = function () use ($app) {
            $get = $app->request->get();
            if (isset($get['lang'])) {
                $app->session->set('app.language', $get['lang']);
            }
        };
       
        $app->defaultRoles = function () {
            $roles = array('admin');
        };

        $app->configureMode('production', function () use ($app) {
            $app->config('whoops.editor', 'sublime'); 
            $app->add(new \Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware);
            $app->add(new \Slim\Middleware\DebugBar);

            $app->config('db.dsn', 'mysql:dbname=db169616_teste;host=internal-db.s169616.gridserver.com');
            $app->config('db.user', 'db169616');
            $app->config('db.pass', 'morte666');

            $app->config(array(
                'log.enable' => true,
                'debug' => true,
                'per_page' => 12
            ));
            $app->session->set('user.id', 1);
        });

        $app->configureMode('development', function () use ($app) {
            $app->config('whoops.editor', 'sublime'); 
            $app->add(new \Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware);
            $app->add(new \Slim\Middleware\DebugBar);

            $app->config('db.dsn', 'mysql:dbname=maltz-novo;host=localhost');
            $app->config('db.user', 'root');
            $app->config('db.pass', 'root');

            $app->config(array(
                'log.enable' => true,
                'debug' => true,
                'per_page' => 12
            ));
            $app->session->set('user.id', 1);
        });

        $config = Config::query($app->db, 'display');
        if ($config->has('records')) {
            foreach ($config->getRecords() as $key => $value) {
                $app->config($key, $value);
            }
        }

        $controllers = array(
            'Maltz\Api\Ctrl\Api',
            'Maltz\Api\Ctrl\App',
        );

        foreach ($controllers as $controller) {
            $ctrl = new $controller();
            $app = $ctrl->route($app);
        }

        return $app;
    }
}
