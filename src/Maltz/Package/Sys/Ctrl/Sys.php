<?php

namespace Maltz\Package\Sys\Ctrl;

use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Package\Sys\Model\Type;
use Maltz\Package\Sys\Model\Config;
use Maltz\Package\Sys\Model\User;
use Maltz\Package\Sys\Model\Log;

class Sys
{
    public function route($app)
    {
        /*
         * USERS
         */        
        $app->get('/api/user(/:pg(/:key(/:order)))', function ($pg = 1, $key = 'modified', $order = 'desc') use ($app) {

                $result = User::query($app->db, 'find', $pg, $app->config('per_page'), $key, $order);
                $app->handler->handleApiResponse($result);
            }
        )->name('api_user_list')->conditions(array('pg' => '\d+', 'key' => '\w+', 'order' => 'asc|desc'));

        $app->get('/api/user/:id/show', function ($id) use ($app) {

                $result = User::query($app->db, 'show', $id);
                $app->handler->handleApiResponse($result);
            }
        )->name('api_user_show')->conditions(array());

        $app->get('/api/user/profile', function ($id) use ($app) {

                $result = User::query($app->db, 'show', $app->sessionDataStore->getUserId());
                $app->handler->handleApiResponse($result);
            }
        )->name('api_user_profile');

        $app->post('/api/user/delete', function () use ($app) {

                $record = $app->handler->handlePostRequest();
                $id = $record->get('id');
                $result = User::query($app->db, 'delete', $id);
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), 'user', $id, 'delete', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);

            }
        )->via('POST','DELETE')->name('api_user_delete');

        $app->map('/api/user/save', function () use ($app) {

                $record = $app->handler->handlePostRequest();
                $result = User::query($app->db, 'save', $record);
                $id = $record->has('id') ? $record->get('id') : $result->getLastInsertId();
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), $model, $id, 'save', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);
            }
        )->via('POST','PUT')->name('api_user_save');

        /*
         * TYPES
         */
        $app->get('/api/type(/:pg(/:key(/:order)))', function ($pg = 1, $key = 'name', $order = 'asc') use ($app) {

                $result = Type::query($app->db, 'display');
                $app->handler->handleApiResponse($result);
            }
        )->name('api_type_list')->conditions(array('pg' => '\d+', 'key' => '\w+', 'order' => 'asc|desc'));

        $app->post('/api/type/delete', function () use ($app) {

                $record = $app->handler->handlePostRequest();
                $id = $record->get('id');
                $result = Type::query($app->db, 'delete', $id);
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), 'type', $id, 'delete', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);
            }
        )->name('api_type_delete');

        $app->post('/api/type/save', function () use ($app) {

                $record = $app->handler->handlePostRequest();
                $result = Type::query($app->db, 'save', $record);
                $id = $record->has('id') ? $record->get('id') : $result->get('last.insert.id');
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), $model, $id, 'save', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);
            }
        )->name('api_type_save');

        /*
         * SYSTEM
         */
        $app->get('/api/config', function () use ($app) {

                $result = Config::query($app->db, 'display');
                $app->handler->handleApiResponse($result);
            }
        )->name('api_config_list')->conditions(array());

        $app->map('/api/config', function () use ($app) {

                $record = $app->handler->handlePostRequest();
                $result = Config::query($app->db, 'save', $record);
                $id = $record->has('id') ? $record->get('id') : $result->getLastInsertId();
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), 'config', $id, 'save', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);
            }
        )->via('POST','PUT')->name('api_config_save');


        $app->get('/api/log(/:pg)', function ($pg = 1) use ($app) {

                $result = Log::query($app->db, 'find', $pg, $app->config('per_page'));
                $app->handler->handleApiResponse($result);
            }
        )->name('api_log_list')->conditions(array('pg' => '\d+'));


        /*
         * LANG
         */
        $app->get('/api/lang/:lang', function ($lang) use ($app) {
            
                $app->session->set('language', $lang);
            }
        )->name('api_set_lang')->conditions(array('lang' => '\w+'));

        /*
         * NONCE
         */
        $app->get('/api/nonce', function () use ($app) {

                $app->nonce->generate();
                $result = new Result(array('success' => true, 'message' => 'Nonce has been generated.', 'nonce' => $app->nonce->get()));
                $app->handler->handleApiResponse($result);
            }
        );

        return $app;
    }
}
