<?php

namespace Maltz\Api\Ctrl;

use Maltz\Mvc\Record;
use Maltz\Sys\Model\Type;
use Maltz\Sys\Model\Config;
use Maltz\Sys\Model\User;
use Maltz\Sys\Model\Log;
use Maltz\Content\Model\Area;
use Maltz\Content\Model\Block;

class Api
{
    public function route($app)
    {

        /*
         * CONTENT
         */
        
        $app->get('/api/:model/:type(/:pg(/:key(/:order)))', function ($model, $type, $pg = 1, $key = 'created', $order = 'asc') use ($app) {
                
            $entity = $app->handler->setEntity($model);
            $result = $entity->findByType($type, $pg, $app->config('per_page'), $key, $order);
            $app->handler->handleApiResponse($result);

        })->name('api_list')->conditions(array('model' => 'content|collection|resource|term', 'type' => '\w+', 'pg' => '\d+', 'key' => '\w+', 'order' => 'asc|desc'));

        $app->get('/api/:model/:id/show', function ($model, $id) use ($app) {

            $entity = $app->handler->setEntity($model);
            $result = $entity->show($id);
            $app->handler->handleApiResponse($result);

        })->name('api_show')->conditions(array('model' => 'content|collection|resource|term', 'id' => '\d+'));

        $app->post('/api/:model/save', function ($model) use ($app) {

            $entity = $app->handler->setEntity($model);
            $record = $app->handler->handlePostRequest();
            $result = $entity->save($record);
            $id = $record->has('id') ? $record->get('id') : $result->get('last.insert.id');
            //Log::query('log', $app->sessionDataStore->getUserId(), $model, $id, 'save', '', '', $app->nonce->get());
            $app->handler->handleApiResponse($result);

        })->name('api_save')->conditions(array('model' => 'content|collection|resource|term'));

        $app->post('/api/:model/delete', function ($model) use ($app) {

            $entity = $app->handler->setEntity($model);
            $record = $app->handler->handlePostRequest();
            $id = $record->get('id');
            $result = $entity->delete($id);
            Log::query('log', $app->sessionDataStore->getUserId(), $model, $record->get('id'), 'delete', '', '', $app->nonce->get());
            $app->handler->handleApiResponse($result);

        })->name('api_delete')->conditions(array('model' => 'content|collection|resource|term'));

        /*
         * TREES
         */
        $app->get('/api/tree/:model(/:type)', function ($model, $type = null) use ($app) {

            $entity = $app->handler->setEntity($model);
            if ($type) {
                $result = $entity->displayTreeByType($type);
            } else {
                $result = $entity->displayTree();
            }
            $app->handler->handleApiResponse($result);

        })->name('api_tree')->conditions(array('model' => 'content|collection|term'));

        /*
         * ATTACHMENTS
         */
        $app->get('/api/:group_name/:group_id/:item_name/show', function ($group_name, $group_id, $item_name) use ($app) {

            $entity = $app->handler->setEntity($model);
            $result = $entity->getAllAttachments($group_id, $item_name);
            //Log::query('log', $app->sessionDataStore->getUserId(), '', '', '', '', '', $app->nonce->get());
            $app->handler->handleApiResponse($result);

        })->name('api_show_items')->conditions(array('group_name' => 'content|collection', 'group_id' => '\d+', 'item_name' => 'content|collection|resource|term'));
        
        $app->post('/api/attachment/add', function () use ($app) {

            $record = $app->handler->handlePostRequest();
            $result = $entity->addAttachment($record);
            $entity = $app->handler->setEntity($model);
            //Log::query('log', $app->sessionDataStore->getUserId(), '', '', '', '', '', $app->nonce->get());
            $app->handler->handleApiResponse($result);

        })->name('api_add_item');

        $app->post('/api/attachment/remove', function () use ($app) {

            $entity = $app->handler->setEntity($model);
            $record = $app->handler->handlePostRequest();
            $result = $entity->removeAttachment($record);
            //Log::query('log', $app->sessionDataStore->getUserId(), '', '', '', '', '', $app->nonce->get());
            $app->handler->handleApiResponse($result);

        })->name('api_remove_item');

        /*
         * METADATA
         */
        $app->post('/api/metadata/add', function () use ($app) {

            $entity = $app->handler->setEntity($model);
            $record = $app->handler->handlePostRequest();
            $result = $entity->addMeta($record);
            //Log::query('log', $app->sessionDataStore->getUserId(), '', '', '', '', '', $app->nonce->get());
            $app->handler->handleApiResponse($result);

        })->name('api_add_meta');

        $app->post('/api/metadata/remove', function () use ($app) {

            $entity = $app->handler->setEntity($model);
            $record = $app->handler->handlePostRequest();
            $result = $entity->removeMeta($record);
            //Log::query('log', $app->sessionDataStore->getUserId(), '', '', '', '', '', $app->nonce->get());
            $app->handler->handleApiResponse($result);

        })->name('api_remove_meta');

        /*
         * TYPES
         */
        
        $app->get('/api/type(/:pg(/:key(/:order)))', function ($pg = 1, $key = 'name', $order = 'asc') use ($app) {

            $result = Type::query($app->db, 'display');
            $app->handler->handleApiResponse($result);

        })->name('api_type_list')->conditions(array('pg' => '\d+', 'key' => '\w+', 'order' => 'asc|desc'));


        $app->post('/api/type/delete', function () use ($app) {

            $record = $app->handler->handlePostRequest();
            $id = $record->get('id');
            $result = Type::query($app->db, 'delete', $id);
            //Log::query('log', $app->sessionDataStore->getUserId(), '', '', '', '', '', $app->nonce->get());
            $app->handler->handleApiResponse($result);

        })->name('api_type_delete');

        $app->post('/api/type/save', function () use ($app) {

            $record = $app->handler->handlePostRequest();
            $result = Type::query($app->db, 'save', $record);
            $id = $record->has('id') ? $record->get('id') : $result->get('last.insert.id');
            //Log::query('log', $app->sessionDataStore->getUserId(), $model, $id, 'save', '', '', $app->nonce->get());
            $app->handler->handleApiResponse($result);

        })->name('api_type_save');


        /*
         * SITE BUILDING
         */

        $app->get('/api/area(/:pg(/:key(/:order)))', function ($pg = 1, $key = 'name', $order = 'asc') use ($app) {

            $result = Area::query($app->db, 'find', $pg, $app->config('per_page'), $key, $order);
            $app->handler->handleApiResponse($result);

        })->name('api_area_list')->conditions(array('pg' => '\d+', 'key' => '\w+', 'order' => 'asc|desc'));

        $app->get('/api/area/:id/show', function ($id) use ($app) {

            $result = Area::query($app->db, 'getBlocks', $id);
            $app->handler->handleApiResponse($result);

        })->name('api_area_show')->conditions(array('pg' => '\d+', 'key' => '\w+', 'order' => 'asc|desc'));

        $app->post('/api/area/add/block', function () use ($app) {

            $record = $app->handler->handlePostRequest();
            $result = Area::query($app->db, 'show', $id);
            //Log::query('log', $app->sessionDataStore->getUserId(), '', '', '', '', '', $app->nonce->get());
            $app->handler->handleApiResponse($result);

        })->name('api_area_block_add');

        $app->post('/api/area/remove/block', function () use ($app) {

            $record = $app->handler->handlePostRequest();
            $result = Area::query($app->db, 'removeBlock', $id);
            //Log::query('log', $app->sessionDataStore->getUserId(), '', '', '', '', '', $app->nonce->get());
            $app->handler->handleApiResponse($result);

        })->name('api_area_block_remove');

        $app->post('/api/area/delete', function () use ($app) {

            $record = $app->handler->handlePostRequest();
            $result = Area::query($app->db, 'delete', $id);
            //Log::query('log', $app->sessionDataStore->getUserId(), 'area', $id, 'delete', '', '', $app->nonce->get());
            $app->handler->handleApiResponse($result);

        })->name('api_area_delete');

        $app->post('/api/area/save', function () use ($app) {

            $record = $app->handler->handlePostRequest();
            $result = Area::query($app->db, 'save', $record);
            $id = $record->has('id') ? $record->get('id') : $result->get('last.insert.id');
            //Log::query('log', $app->sessionDataStore->getUserId(), $model, $id, 'save', '', '', $app->nonce->get());
            $app->handler->handleApiResponse($result);

        })->name('api_area_save');


        $app->get('/api/block(/:pg(/:key(/:order)))', function ($pg = 1, $key = 'modified', $order = 'desc') use ($app) {

            $result = Block::query($app->db, 'find', $pg, $app->config('per_page'), $key, $order);
            $app->handler->handleApiResponse($result);

        })->name('api_block_list')->conditions(array('pg' => '\d+', 'key' => '\w+', 'order' => 'asc|desc'));

        $app->post('/api/block/delete', function () use ($app) {

            $record = $app->handler->handlePostRequest();
            $result = Block::query($app->db, 'delete', $id);
            //Log::query('log', $app->sessionDataStore->getUserId(), 'block', $id, 'delete', '', '', $app->nonce->get());
            $app->handler->handleApiResponse($result);

        })->name('api_block_delete');

        $app->post('/api/block/save', function () use ($app) {

            $record = $app->handler->handlePostRequest();
            $result = Block::query($app->db, 'save', $record);
            $id = $record->has('id') ? $record->get('id') : $result->get('last.insert.id');
            //Log::query('log', $app->sessionDataStore->getUserId(), 'block', $id, 'save', '', '', $app->nonce->get());
            $app->handler->handleApiResponse($result);

        })->name('api_block_save');


        /*
         * USERS
         */
        
        $app->get('/api/user(/:pg(/:key(/:order)))', function ($pg = 1, $key = 'modified', $order = 'desc') use ($app) {

            $result = User::query($app->db, 'find', $pg, $app->config('per_page'), $key, $order);
            $app->handler->handleApiResponse($result);

        })->name('api_user_list')->conditions(array('pg' => '\d+', 'key' => '\w+', 'order' => 'asc|desc'));

        $app->get('/api/user/:id/show', function ($id) use ($app) {

            $result = User::query($app->db, 'show', $id);
            $app->handler->handleApiResponse($result);

        })->name('api_user_show')->conditions(array());

        $app->get('/api/user/profile', function ($id) use ($app) {

            $result = User::query($app->db, 'show', $app->sessionDataStore->getUserId());
            $app->handler->handleApiResponse($result);

        })->name('api_user_profile');

        $app->get('/api/user/delete', function () use ($app) {

            $record = $app->handler->handlePostRequest();
            $id = $record->get('id');
            $result = User::query($app->db, 'delete', $id);
            //Log::query('log', $app->sessionDataStore->getUserId(), 'user', $id, 'delete', '', '', $app->nonce->get());
            $app->handler->handleApiResponse($result);

        })->name('api_user_delete');

        $app->post('/api/user/save', function () use ($app) {

            $record = $app->handler->handlePostRequest();
            $result = User::query($app->db, 'save', $record);
            $id = $record->has('id') ? $record->get('id') : $result->get('last.insert.id');
            //Log::query('log', $app->sessionDataStore->getUserId(), $model, $id, 'save', '', '', $app->nonce->get());
            $app->handler->handleApiResponse($result);

        })->name('api_user_save');



        /*
         * LANG
         */
        $app->get('/api/lang/:lang', function ($lang) use ($app) {
            
            $app->session->set('language', $lang);

        })->name('api_set_lang')->conditions(array('lang' => '\w+'));


        /*
         * SYSTEM
         */
        
        $app->get('/api/config', function () use ($app) {

            $result = Config::query($app->db, 'display');
            $app->handler->handleApiResponse($result);

        })->name('api_config_list')->conditions(array());

        $app->post('/api/config', function () use ($app) {

            $record = $app->handler->handlePostRequest();
            $result = Config::query($app->db, 'save', $record);
            $id = $record->has('id') ? $record->get('id') : $result->get('last.insert.id');
            //Log::query('log', $app->sessionDataStore->getUserId(), 'config', $id, 'save', '', '', $app->nonce->get());
            $app->handler->handleApiResponse($result);

        })->name('api_config_save');


        $app->get('/api/log(/:pg)', function ($pg = 1) use ($app) {

            $result = Log::query($app->db, 'find', $pg, $app->config('per_page'));
            $app->handler->handleApiResponse($result);

        })->name('api_log_list')->conditions(array('pg' => '\d+'));

        /*
         * NONCE
         */
        $app->get('/api/nonce', function () use ($app) {
            $app->nonce->generate();
            $result = new Result(array('success' => true, 'message' => 'Nonce has been generated.', 'nonce' => $app->nonce->get()));
            $app->handler->handleApiResponse($result);
        });

        /*
         * UPLOAD
         */
        
        $app->get('/upload', function () use ($app) {
            $app->render('upload.tpl.php');
        });

        $app->post('/upload', function () use ($app) {

            $validator = new FileUpload\Validator\Simple(1024 * 1024 * 2, $app->allowedFileTypes);
            $pathresolver = new FileUpload\PathResolver\Simple('/var/www/html/files/');
            $filesystem = new FileUpload\FileSystem\Simple();
            $fileupload = new FileUpload\FileUpload($_FILES['files'], $_SERVER);

            $fileupload->setPathResolver($pathresolver);
            $fileupload->setFileSystem($filesystem);
            $fileupload->addValidator($validator);

            list($files, $headers) = $fileupload->processAll();

            foreach ($headers as $header => $value) {
                $app->response->headers->set($header . ': ' . $value);
            }

            $body = json_encode(array('files' => $files));
            $app->response->setBody($body);
            $app->stop();
        });

        return $app;
    }
}
