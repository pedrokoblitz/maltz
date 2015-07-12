<?php

class Api {

    public static function route($app) {
        /*
         *
         */
        $app->post('', function ($id) use ($app) {

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

            $app->flash('message', '');
            $app->request->isAjax() ? $app->redirect($app->urlFor('', array('id' => $id))) : false;
        })->name('')->conditions(array('id' => '\d+'));

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
    }

        /*
         *
         */
        $app->get('/api/:model/:id/show', function ($model, $id) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $data = $entity->show($id);

            $app->response->headers->set('Content-Type', 'application/json');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('show')->conditions(array('id' => '\d+'));
    }

    return $app;
}
