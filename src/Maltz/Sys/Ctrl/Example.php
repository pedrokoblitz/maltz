 <?php
        /*
         *
         */
        $app->post('', function ($id) use ($app) {

            $app->httpHandler->authorized();
            
            $app->httpHandler->redirect('', '', $params);
            Log::query($app->db, 'log', $user_id, 'action', 'name', $id);

        })->name('')->conditions(array('model' => '\w+', 'id' => '\d+'));

        /*
         *
         */
        $app->get('', function ($type, $key = 'created', $order = 'ASC', $pg = 1) use ($app) {

            $app->httpHandler->authorized();
            $pp = $app->config('per_page');
            $pagination = $app->paginate($pp, $pg);

            $content = Content::query($app->db, 'list', $pagination->offset, $pagination->limit, $key, $order);

            $app->httpHandler->serve($data);

        })->name('admin_model_index')->conditions(array('model' => '\w+', 'order' => '\w+', 'pp' => '\d+', 'pg' => '\d+'));
?>