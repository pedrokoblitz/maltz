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

            $app->activity->write(
                $app->db,
                $app->session->get('user.username'),
                $app->session->get('user.id'),
                '',
                $model,
                $id
            );

            $app->flash('message', '');
            $app->request->isAjax() ? $app->redirect($app->urlFor('', array('id' => $id))) : false;
        })->name('')->conditions(array('id' => '\d+'));

        /*
         *
         */
        $app->post('', function ($id) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $app->activity->write(
                $app->db,
                $app->session->get('user.username'),
                $app->session->get('user.id'),
                '',
                $model,
                $id
            );

            $app->flash('message', '');
            $app->request->isAjax() ? $app->redirect($app->urlFor('', array('id' => $id))) : false;
        })->name('')->conditions(array('id' => '\d+'));

        /*
         *
         */
        $app->get('', function ($model, $key = 'created', $order = 'ASC', $pg = 1) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $pp = $app->config('per_page');

            $body = $app->view->render($data);
            $app->response->headers->set('Content-Type', 'text/html');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('')->conditions(array('id' => '\d+'));

        
        /*
         *
         */
        $app->get('', function ($model, $key = 'created', $order = 'ASC', $pg = 1) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $pp = $app->config('per_page');

            $body = $app->view->render($data);
            $app->response->headers->set('Content-Type', 'text/html');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('')->conditions(array('id' => '\d+'));

        
        /*
         *
         */
        $app->get('', function ($model, $key = 'created', $order = 'ASC', $pg = 1) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $pp = $app->config('per_page');

            $body = $app->view->render($data);
            $app->response->headers->set('Content-Type', 'text/html');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('')->conditions(array('id' => '\d+'));

        
        /*
         *
         */
        $app->get('', function ($model, $key = 'created', $order = 'ASC', $pg = 1) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $pp = $app->config('per_page');

            $body = $app->view->render($data);
            $app->response->headers->set('Content-Type', 'text/html');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('')->conditions(array('id' => '\d+'));

        
        /*
         *
         */
        $app->get('', function ($model, $key = 'created', $order = 'ASC', $pg = 1) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $pp = $app->config('per_page');

            $body = $app->view->render($data);
            $app->response->headers->set('Content-Type', 'text/html');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('')->conditions(array('id' => '\d+'));

        
        /*
         *
         */
        $app->get('', function ($model, $key = 'created', $order = 'ASC', $pg = 1) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $pp = $app->config('per_page');

            $body = $app->view->render($data);
            $app->response->headers->set('Content-Type', 'text/html');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('')->conditions(array('id' => '\d+'));

        
        /*
         *
         */
        $app->get('', function ($model, $key = 'created', $order = 'ASC', $pg = 1) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $pp = $app->config('per_page');

            $body = $app->view->render($data);
            $app->response->headers->set('Content-Type', 'text/html');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('')->conditions(array('id' => '\d+'));

        
        /*
         *
         */
        $app->get('', function ($model, $key = 'created', $order = 'ASC', $pg = 1) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $pp = $app->config('per_page');

            $body = $app->view->render($data);
            $app->response->headers->set('Content-Type', 'text/html');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('')->conditions(array('id' => '\d+'));

        
        /*
         *
         */
        $app->get('', function ($model, $key = 'created', $order = 'ASC', $pg = 1) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $pp = $app->config('per_page');

            $body = $app->view->render($data);
            $app->response->headers->set('Content-Type', 'text/html');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('')->conditions(array('id' => '\d+'));

        
        /*
         *
         */
        $app->get('', function ($model, $key = 'created', $order = 'ASC', $pg = 1) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $pp = $app->config('per_page');

            $body = $app->view->render($data);
            $app->response->headers->set('Content-Type', 'text/html');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('')->conditions(array('id' => '\d+'));
    }

    return $app;
}
