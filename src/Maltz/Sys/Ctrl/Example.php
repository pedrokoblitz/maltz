 <?php
        /*
         *
         * muda campo activity do model selecionado para 1
         *
         * return void
         */
        $app->get('', function ($id) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $app->activity->write(
                $app->db,
                $app->session->get('user.username'),
                $app->session->get('user.id'),
                'activity',
                $model,
                $id
            );

            $app->flash('message', 'desativado');
            $app->request->isAjax() ? $app->redirect($app->urlFor('admin_model_edit', array('model' => $model, 'id' => $id))) : false;
        })->name('api_model_activate')->conditions(array('model' => '\w+', 'id' => '\d+'));
 /*
         *
         * list model selecionado
         *
         *
         * return string / void
         */

        $app->get('/admin/:model(/order/:key(/:order(/page/:pg)))', function ($model, $key = 'created', $order = 'ASC', $pg = 1) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $pp = $app->config('per_page');

            $body = $app->view->render($data);
            $app->response->headers->set('Content-Type', 'text/html');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('admin_model_index')->conditions(array('model' => '\w+', 'order' => '\w+', 'pp' => '\d+', 'pg' => '\d+'));
?>