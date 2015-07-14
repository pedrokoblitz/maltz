<?php

namespace Maltz\Api\Ctrl;

use Maltz\Mvc\Record;
use Maltz\Content\Model\Content;
use Maltz\Content\Model\Collection;
use Maltz\Content\Model\Resource;
use Maltz\Content\Model\Term;
use Maltz\Content\Model\Type;
use Maltz\Content\Model\Area;
use Maltz\Content\Model\Block;
use Maltz\Sys\Model\Config;
use Maltz\Sys\Model\User;
use Maltz\Sys\Model\Log;

class Api {

    public static function route($app) {

        /*
         * CONTENT
         */
        
        $app->get('/api/:model/:type/:key/:order/:pg', function ($model, $type, $key = 'created', $order = 'ASC', $page = 1) use ($app) {

            //$app->getLog()->write('', \Slim\Log::DEBUG);

            switch ($model) {
                case 'content':
                    $entity = new Content($app->db);
                    break;
                case 'collection':
                    $entity = new Collection($app->db);
                    break;
                case 'resource':
                    $entity = new Resource($app->db);
                    break;
                case 'term':
                    $entity = new Term($app->db);
                    break;
            }

            $app->response->headers->set('Content-Type', 'application/json');
            $per_page = $app->config('per_page');
            $result = $entity->findByType($type, $page, $per_page, $key, $order);

            if ($result->get('success')) {
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();

        })->name('list')->conditions(array('model' => '\w+', 'type' => '\w+', 'key' => '\w+', 'order' => 'asc|desc', 'pg' => '\d+'));

        $app->get('/api/:model/:id/show', function ($model, $id) use ($app) {
            switch ($model) {
                case 'content':
                    $entity = new Content($app->db);
                    break;
                case 'collection':
                    $entity = new Collection($app->db);
                    break;
                case 'resource':
                    $entity = new Resource($app->db);
                    break;
                case 'term':
                    $entity = new Term($app->db);
                    break;
            }

            $app->response->headers->set('Content-Type', 'application/json');
            $result = $entity->show($id);

            if ($result->get('success')) {
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();

        })->name('show')->conditions(array('model' => '\w+', 'id' => '\d+'));

        $app->post('/api/:model/save', function ($model) use ($app) {

            switch ($model) {
                case 'content':
                    $entity = new Content($app->db);
                    break;
                case 'collection':
                    $entity = new Collection($app->db);
                    break;
                case 'resource':
                    $entity = new Resource($app->db);
                    break;
                case 'term':
                    $entity = new Term($app->db);
                    break;
            }

            $app->response->headers->set('Content-Type', 'application/json');

            $body = $app->request->getBody();
            $record = new Record(json_decode($body, true));

            $app->response->headers->set('Content-Type', 'application/json');
            $result = $entity->save($record);

            if ($result->get('success')) {
                $id = $record->has('id') ? $record->get('id') : $result->get('last_insert_id');
                Log::query('log', $app->session->get('user.id'), $model, 'save', $id);
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();

        })->name('show')->conditions(array('model' => '\w+'));

        $app->get('/api/:model/:id/delete', function ($model, $id) use ($app) {
            switch ($model) {
                case 'content':
                    $entity = new Content($app->db);
                    break;
                case 'collection':
                    $entity = new Collection($app->db);
                    break;
                case 'resource':
                    $entity = new Resource($app->db);
                    break;
                case 'term':
                    $entity = new Term($app->db);
                    break;
                default:
                    throw new \Exception("Error Processing Request", 1);
                    break;
            }

            $app->response->headers->set('Content-Type', 'application/json');
            $result = $entity->delete($id);

            if ($result->get('success')) {
                Log::query('log', $app->session->get('user.id'), $model, 'delete', $id);
                $app->response->setStatus(200);
                $app->response->setBody($result->toJson());
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();

        })->name('delete')->conditions(array('model' => '\w+', 'id' => '\d+'));

        /*
         * RELATIONSHIPS
         */
        
        $app->get('/api/:group_name/:group_id/:item_name/:item_id/:order/add', function ($group_name, $group_id, $item_name, $item_id, $order) use ($app) {

            switch ($group_name) {
                case 'content':
                    $entity = new Content($app->db);
                    break;
                case 'collection':
                    $entity = new Collection($app->db);
                    break;
                default:
                    throw new \Exception("Error Processing Request", 1);
                    break;
            }

            $app->response->headers->set('Content-Type', 'application/json');
            $result = $entity->add($group_id, $item_name, $item_id, $order);

            if ($result->get('success')) {
                Log::query('log', $app->session->get('user.id'), $group_name, 'add_item', $group_id);
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();

        })->name('add_item')->conditions(array('model' => '\w+', 'id' => '\d+'));

        $app->get('/api/:group_name/:group_id/:item_name/:item_id/remove', function ($group_name, $group_id, $item_name, $item_id) use ($app) {

            switch ($group_name) {
                case 'content':
                    $entity = new Content($app->db);
                    break;
                case 'collection':
                    $entity = new Collection($app->db);
                    break;
            }

            $app->response->headers->set('Content-Type', 'application/json');
            $result = $entity->remove($group_id, $item_name, $item_id);

            if ($result->get('success')) {
                Log::query('log', $app->session->get('user.id'), $group_name, 'remove_item', $group_id);
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();

        })->name('remove_item')->conditions(array('model' => '\w+', 'id' => '\d+'));
        return $app;
    }
}
