<?php

namespace Maltz;

use Maltz\Http\CookieJar;
use Maltz\Http\Session;
use Maltz\Http\SessionDataStore;
use Maltz\Http\Nonce;
use Maltz\Mvc\DB;
use Maltz\Mvc\View;
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

        $app->config(array(
            'log.writer' => $logger,
            'mode' => 'production',
            'debug' => true,
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

        $app->nonce = function () {
            return new Nonce($app->session);
        };

        $app->httpHandler = function () {
            return new HttpHandler($app);
        };

        $app->porteiro = function () use ($app) {
            return new Doorman($app->db, $app->session, $app->cookie);
        };

        $app->container->singleton('view', function () use ($app) {
            return new View($app->container['settings']['templates.path']);
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

        $app->container->singleton('db', function () use ($app) {
            return new DB($app->config('db.dsn'), $app->config('db.user'), $app->config('db.pass'));
        });

        $app->pagination = function () {
            return new Pagination();
        };

        $app->carteiro = function () {
            return new Postman();
        };

        $app->correios = function () {
            return new Correios();
        };
        
        $config = Config::query($app->db, 'display');
        if ($config->has('records')) {
            foreach ($config->getRecords() as $key => $value) {
                $app->config($key, $value);
            }
        }

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
