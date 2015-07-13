<?php

namespace Maltz\Api\Ctrl;

use Maltz\Mvc\Record;
use Maltz\Content\Model\Content;
use Maltz\Content\Model\Collection;
use Maltz\Content\Model\Resource;
use Maltz\Content\Model\Term;

class Api {

    public static function route($app) {
      

        /*
         *
         */
        $app->get('/api/:model/:type/:key/:order/:pg', function ($model, $type, $key = 'created', $order = 'ASC', $page = 1) use ($app) {

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
            $result = $entity->listByType($type, $key, $order, $page, $per_page);

            if ($result->get('success')) {
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();

        })->name('list')->conditions(array('model' => '\w+', 'type' => '\w+', 'key' => '\w+', 'order' => 'asc|desc', 'pg' => '\d+'));

        /*
         *
         */
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

        /*
         *
         */
        $app->post('/api/:model/save', function ($model) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

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

            if ($app->request->isAjax()) {
                $body = $app->request->getBody();
                $record = new Record(json_decode($body, true));
            } else {
                $post = $app->request->post();
                $record = new Record($post);
            }

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

        /*
         *
         */
        $app->get('/api/:model/:id/delete', function ($model) use ($app) {
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
         *
         */
        $app->post('/api/:model/:id/:item/:item_id/:order/add', function ($model, $id, $item, $item_id, $order) use ($app) {

            switch ($model) {
                case 'content':
                    $entity = new Content($app->db);
                    break;
                case 'collection':
                    $entity = new Collection($app->db);
                    break;
            }

            $app->response->headers->set('Content-Type', 'application/json');
            $result = $entity->add($id, $item, $item_id, $order);

            if ($result->get('success')) {
                Log::query('log', $app->session->get('user.id'), $model, 'add_item', $id);
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();

        })->name('add_item')->conditions(array('model' => '\w+', 'id' => '\d+'));


        /*
         *
         */
        $app->post('/api/:model/:id/:item/:item_id/remove', function ($model, $id, $item, $item_id) use ($app) {

            switch ($model) {
                case 'content':
                    $entity = new Content($app->db);
                    break;
                case 'collection':
                    $entity = new Collection($app->db);
                    break;
            }

            $app->response->headers->set('Content-Type', 'application/json');
            $result = $entity->remove($id, $item, $item_id);

            if ($result->get('success')) {
                Log::query('log', $app->session->get('user.id'), $model, 'remove_item', $id);
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
