<?php

namespace Maltz;

use Maltz\Http\CookieJar;
use Maltz\Http\Session;
use Maltz\Mvc\DB;
use Maltz\Mvc\View;
use Maltz\Service\Nonce;
use Maltz\Service\SessionDataStore;
use Maltz\Service\Handler;
use Maltz\Service\Pagination;
use Maltz\Sys\Model\Config;
use Maltz\Sys\Service\Postman;
use Maltz\Sys\Service\Doorman;

class Application implements Config
{

    /*
    *
    * app config
    *
    */
    public static function initialize()
    {
        $app = new \Slim\Slim();
        
        $logger = new \Flynsarmy\SlimMonolog\Log\MonologWriter(
            array(
            'handlers' => array(
                new \Monolog\Handler\StreamHandler('./logs/dev.log'),
            ),
            )
        );

        $app->config(
            array(
            'log.writer' => $logger,
            'view' => new View(),
            'mode' => 'development',
            'templates.path' => './views',
            'base.uri' => '/'
            )
        );

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
        
        $app->container->singleton(
            'db', function () use ($app) {
                return new DB($app->config('db.dsn'), $app->config('db.user'), $app->config('db.password'));
            }
        );

        $app->postman = function () {
            return new Postman();
        };
        
        $app->lang = function () use ($app) {
            $get = $app->request->get();
            if (isset($get['lang'])) {
                $app->session->set('app.language', $get['lang']);
            }
        };
       
        $app->allowedFileTypes = function () {
            return array(
                'image/png',
                'image/gif',
                'image/jpg'
            );
        };

        $app->defaultViewInfo = function () {
            return array(
                'meta.properties' => array(
                    '' => '',
                    '' => '',
                    '' => '',
                    ),
                'styles' => array(
                    '' => '',
                    '' => '',
                    '' => '',
                    ),
                'scripts' => array(
                    '' => '',
                    '' => '',
                    '' => '',
                    ),
                'layout.data' => array(
                    '' => '',
                    '' => '',
                    '' => '',
                    ),
                );
        };

        $app->defaultRoles = function () {
            $roles = array('admin');
        };

        $app->configureMode(
            'production', function () use ($app) {

                $credentials = json_decode(file_get_contents('db.json'), true);
                $app->config('db.dsn', $credentials['dsn']);
                $app->config('db.user', $credentials['user']);
                $app->config('db.password', $credentials['password']);
            }
        );

        $app->configureMode(
            'development', function () use ($app) {
                $app->add(new \Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware);
                $app->add(new \Slim\Middleware\DebugBar);

                $app->config('db.dsn', 'mysql:dbname=maltz-novo;host=localhost');
                $app->config('db.user', 'root');
                $app->config('db.password', 'root');

                $app->config(
                    array(
                    'log.enable' => true,
                    'log.level' => \Slim\Log::DEBUG,
                    'debug' => true,
                    'per_page' => 12
                        )
                    );
                $app->session->set('user.id', 1);
            }
        );

        $controllers = array(
            'Maltz\Packages\Sys\Ctrl\Sys',
            'Maltz\Packages\Calendar\Ctrl\Upload',
            'Maltz\Packages\Content\Ctrl\Content',
            'Maltz\Packages\Calendar\Ctrl\Calendar',
            'Maltz\Packages\GeoLocation\Ctrl\GeoLocation',
            'Maltz\Packages\Store\Ctrl\Store',
            'Maltz\Packages\Project\Ctrl\Project',
            'Maltz\Packages\SiteBuilding\Ctrl\SiteBuilding',
            'Maltz\Packages\Radar\Ctrl\Radar',
            'Maltz\Packages\Secult\Ctrl\Secult',
            'Maltz\Packages\Portfolio\Ctrl\Portfolio',
        );

        foreach ($controllers as $controller) {
            $ctrl = new $controller();
            $app = $ctrl->route($app);
        }

        return $app;
    }
}
