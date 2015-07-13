<?php

namespace Maltz;

use Maltz\Http\CookieJar;
use Maltz\Http\Session;
use Maltz\Http\Nonce;
use Maltz\Mvc\DB;
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

            $log = $app->getLog();
            $log->write('message', \Slim\Log::DEBUG);
        */
        $logger = new \Flynsarmy\SlimMonolog\Log\MonologWriter(array(
            'handlers' => array(
                new \Monolog\Handler\StreamHandler('./logs/dev.log'),
            ),
        ));

        $app->config(array(
            'log.writer' => $logger,
            'mode' => 'development',
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

        $config = Config::query($app->db, 'display');
        foreach ($config->getRecords() as $key => $value) {
            $app->config($key, $value);
        }

        $controllers = array(
            'Maltz\Api\Ctrl\Api',
            'Maltz\Content\Ctrl\Site',
            'Maltz\Content\Ctrl\Content',
            'Maltz\Sys\Ctrl\Asset',
            'Maltz\Sys\Ctrl\Sys',
        );

        foreach ($controllers as $controller) {
            $ctrl = new $controller();
            $app = $ctrl->route($app);
        }

        return $app;
    }
}
