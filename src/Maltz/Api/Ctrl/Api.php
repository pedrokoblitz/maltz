<?php

namespace Maltz\Api\Ctrl;

class Api {

    public static function route($app) {
      

        /*
         *
         */
        $app->get('/api/:model/:type/:key/:order/:pg', function ($model, $type, $key = 'created', $order = 'ASC', $pg = 1) use ($app) {

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

            $pp = $app->config('per_page');
            $pagination = $app->paginate($pp, $pg);
            $data = $entity->listByType($type, $key, $order, $pagination->offset, $pagination->limit);
            $app->response->headers->set('Content-Type', 'application/json');
            $app->response->setStatus(200);
            $app->response->setBody($data->toJson());
            $app->stop();
        })->name('list')->conditions(array('id' => '\d+'));

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

            $data = $entity->show($id);

            $app->response->headers->set('Content-Type', 'application/json');
            $app->response->setStatus(200);
            $app->response->setBody($data->toJson());
            $app->stop();

        })->name('show')->conditions(array('id' => '\d+'));

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

            $record = new Record($app->request->post());
            $result = $entity->save($record);

            $id = $record->has('id') ? $record->get('id') : $result->get('last_insert_id');
            Log::query('log', $app->session->get('user.id'), $model, 'save', $id);

            $app->stop();
        })->name('show')->conditions(array('id' => '\d+'));

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

            $entity->delete($id);
            Log::query('log', $app->session->get('user.id'), $model, 'delete', $id);
            $app->stop();

        })->name('delete')->conditions(array('id' => '\d+'));

        /*
         *
         */
        $app->get('/api/:model/items/list', function ($model) use ($app) {

            switch ($model) {
                case 'content':
                    $group = new Content($app->db);
                    break;
                case 'collection':
                    $group = new Collection($app->db);
                    break;
                case 'resource':
                    $group = new Resource($app->db);
                    break;
                case 'term':
                    $group = new Term($app->db);
                    break;
            }

        })->name('groups_items')->conditions(array('id' => '\d+'));

        /*
         *
         */
        $app->post('/api/:model/:id/:item/:item_id/add', function ($model, $id, $item, $item_id) use ($app) {

            Log::query('log', $app->session->get('user.id'), $model, 'add_item', $id);

        })->name('add_item')->conditions(array('id' => '\d+'));


        /*
         *
         */
        $app->post('/api/:model/:id/:item/:item_id/add', function ($model, $id, $item, $item_id) use ($app) {

            Log::query('log', $app->session->get('user.id'), $model, 'remove_item', $id);

        })->name('remove_item')->conditions(array('id' => '\d+'));

        return $app;
    }
}
