 <?php
        /*
         *
         */
        $app->get('', function ($id) use ($app) {

            $app->httpHandler->authorized();
            
            $query = $app->query;
            $query->action = 'update';
            $query->params = array('type' => $type, 'id' => $id);
            
            $data = Content::query($query);
            
            $app->httpHandler->redirect('', '', $query->params);

        })->name('')->conditions(array('model' => '\w+', 'id' => '\d+'));

        /*
         *
         */
        $app->get('/admin/:type(/order/:key(/:order(/page/:pg)))', function ($type, $key = 'created', $order = 'ASC', $pg = 1) use ($app) {

            $app->httpHandler->authorized();
            $pp = $app->config('per_page');
            
            $query = $app->query;
            $query->action = 'list';
            $query->params = array('type' => $type, 'id' => $id, 'pp' => $pp);
            
            $data = Content::query($query);
            $data->set('layout', '');
            $data->set('view', '');
            
            $app->httpHandler->serveView($data);

        })->name('admin_model_index')->conditions(array('model' => '\w+', 'order' => '\w+', 'pp' => '\d+', 'pg' => '\d+'));
?>