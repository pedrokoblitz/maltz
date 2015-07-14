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
        
        $app->get('/api/:model/:type(/:pg(/:key(/:order)))', function ($model, $type, $pg = 1, $key = 'created', $order = 'asc') use ($app) {
            
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
            $result = $entity->findByType($type, $pg, $per_page, $key, $order);

            if ($result->get('success')) {
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();

        })->name('api_list')->conditions(array('model' => 'content|collection|resource|term', 'type' => '\w+', 'pg' => '\d+', 'key' => '\w+', 'order' => 'asc|desc'));

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

        })->name('api_show')->conditions(array('model' => 'content|collection|resource|term', 'id' => '\d+'));

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
                $id = $record->has('id') ? $record->get('id') : $result->get('last.insert.id');
                Log::query('log', $app->session->get('user.id'), $model, $id, 'save');
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();

        })->name('api_save')->conditions(array('model' => 'content|collection|resource|term'));

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
                Log::query('log', $app->session->get('user.id'), $model, $id, 'delete');
                $app->response->setStatus(200);
                $app->response->setBody($result->toJson());
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();

        })->name('api_delete')->conditions(array('model' => 'content|collection|resource|term', 'id' => '\d+'));

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
            }

            $app->response->headers->set('Content-Type', 'application/json');
            $result = $entity->add($group_id, $item_name, $item_id, $order);

            if ($result->get('success')) {
                Log::query('log', $app->session->get('user.id'), $group_name, $group_id, 'add_item', $item_name, $item_id);
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();

        })->name('api_add_item')->conditions(array('group_name' => 'content|collection', 'group_id' => '\d+', 'item_name' => 'content|collection|resource|term', 'item_id' => '\d+', 'order' => '\d+'));

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
                Log::query('log', $app->session->get('user.id'), $group_name, $group_id, 'add_item', $item_name, $item_id);
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();

        })->name('api_remove_item')->conditions(array('group_name' => 'content|collection', 'group_id' => '\d+', 'item_name' => 'content|collection|resource|term', 'item_id' => '\d+'));

        /*
         * TYPES
         */
        
        $app->get('/api/type(/:pg(/:key(/:order)))', function($pg = 1, $key = 'name', $order = 'asc') use ($app) {
            $app->response->headers->set('Content-Type', 'application/json');
            $result = Type::query($app->db, 'find', $pg, $app->config('per_page'), $key, $order);

            if ($result->get('success')) {
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();
        })->name('api_type_list')->conditions(array('pg' => '\d+', 'key' => '\w+', 'order' => 'asc|desc'));


        $app->get('/api/type/:id/delete', function($id) use ($app) {
            $app->response->headers->set('Content-Type', 'application/json');
            $result = Type::query($app->db, 'delete', $id);

            if ($result->get('success')) {
                Log::query('log', $app->session->get('user.id'), $model, $id, 'delete');
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();
        })->name('api_type_delete')->conditions(array('id' => '\d+'));

        $app->post('/api/type/save', function() use ($app) {
            $app->response->headers->set('Content-Type', 'application/json');
            $body = $app->request->getBody();
            $record = new Record(json_decode($body, true));

            $app->response->headers->set('Content-Type', 'application/json');
            $result = Type::query($app->db, 'save', $record);

            if ($result->get('success')) {
                $id = $record->has('id') ? $record->get('id') : $result->get('last.insert.id');
                Log::query('log', $app->session->get('user.id'), $model, $id, 'save');
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();
        })->name('api_type_save');


        /*
         * SITE BUILDING
         */

        $app->get('/api/area(/:pg(/:key(/:order)))', function($pg = 1, $key = 'name', $order = 'asc') use ($app) {
            $app->response->headers->set('Content-Type', 'application/json');
            $result = Area::query($app->db, 'find', $pg, $app->config('per_page'), $key, $order);

            if ($result->get('success')) {
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();
        })->name('api_area_list')->conditions(array('pg' => '\d+', 'key' => '\w+', 'order' => 'asc|desc'));

        $app->get('/api/area/:id/delete', function($id) use ($app) {
            $app->response->headers->set('Content-Type', 'application/json');
            $result = Area::query($app->db, 'delete', $id);

            if ($result->get('success')) {
                Log::query('log', $app->session->get('user.id'), 'area', $id, 'delete');
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();
        })->name('api_area_delete')->conditions(array());

        $app->post('/api/area/save', function() use ($app) {
            $app->response->headers->set('Content-Type', 'application/json');
            $body = $app->request->getBody();
            $record = new Record(json_decode($body, true));

            $app->response->headers->set('Content-Type', 'application/json');
            $result = Area::query($app->db, 'save', $record);

            if ($result->get('success')) {
                $id = $record->has('id') ? $record->get('id') : $result->get('last.insert.id');
                Log::query('log', $app->session->get('user.id'), $model, $id, 'save');
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();
        })->name('api_area_save');


        $app->get('/api/block(/:pg(/:key(/:order)))', function($pg = 1, $key = 'modified', $order = 'desc') use ($app) {
            $app->response->headers->set('Content-Type', 'application/json');
            $result = Block::query($app->db, 'find', $pg, $app->config('per_page'), $key, $order);

            if ($result->get('success')) {
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();
        })->name('api_block_list')->conditions(array('pg' => '\d+', 'key' => '\w+', 'order' => 'asc|desc'));

        $app->get('/api/block/:id/delete', function($id) use ($app) {
            $app->response->headers->set('Content-Type', 'application/json');
            $result = Block::query($app->db, 'delete', $id);

            if ($result->get('success')) {
                Log::query('log', $app->session->get('user.id'), 'block', $id, 'delete');
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();
        })->name('api_block_delete')->conditions(array());

        $app->post('/api/block/save', function() use ($app) {
            $app->response->headers->set('Content-Type', 'application/json');
            $body = $app->request->getBody();
            $record = new Record(json_decode($body, true));

            $app->response->headers->set('Content-Type', 'application/json');
            $result = Block::query($app->db, 'save', $record);

            if ($result->get('success')) {
                $id = $record->has('id') ? $record->get('id') : $result->get('last.insert.id');
                Log::query('log', $app->session->get('user.id'), 'block', $id, 'save');
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();
        })->name('api_block_save')->conditions(array());


        /*
         * USERS
         */
        
        $app->get('/api/user(/:pg(/:key(/:order)))', function($pg = 1, $key = 'modified', $order = 'desc') use ($app) {
            $app->response->headers->set('Content-Type', 'application/json');
            $result = User::query($app->db, 'find', $pg, $app->config('per_page'), $key, $order);

            if ($result->get('success')) {
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();
        })->name('api_user_list')->conditions(array('pg' => '\d+', 'key' => '\w+', 'order' => 'asc|desc'));

        $app->get('/api/user/:id/show', function($id) use ($app) {
            $app->response->headers->set('Content-Type', 'application/json');
            $result = User::query($app->db, 'show', $id);

            if ($result->get('success')) {
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();
        })->name('api_user_show')->conditions(array());

        $app->get('/api/user/profile', function($id) use ($app) {
            $app->response->headers->set('Content-Type', 'application/json');
            $result = User::query($app->db, 'show', $app->session->get('user.id'));

            if ($result->get('success')) {
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();
        })->name('api_user_profile');

        $app->get('/api/user/:id/delete', function($id) use ($app) {
            $app->response->headers->set('Content-Type', 'application/json');
            $result = User::query($app->db, 'delete', $id);

            if ($result->get('success')) {
                Log::query('log', $app->session->get('user.id'), 'user', $id, 'delete');
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();
        })->name('api_user_delete')->conditions(array());

        $app->post('/api/user/save', function() use ($app) {
            $body = $app->request->getBody();
            $record = new Record(json_decode($body, true));
            $app->response->headers->set('Content-Type', 'application/json');
            $result = User::query($app->db, 'save', $record);

            if ($result->get('success')) {
                $id = $record->has('id') ? $record->get('id') : $result->get('last.insert.id');
                Log::query('log', $app->session->get('user.id'), $model, $id, 'save');
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();
        })->name('api_user_save');



        /*
         * LANG
         */
        $app->get('/api/lang/:lang', function($lang) use ($app) {
            $app->session->set('language', $lang);
        })->name('api_set_lang')->conditions(array());


        /*
         * SYSTEM
         */
        
        $app->get('/api/config', function() use ($app) {
            $app->response->headers->set('Content-Type', 'application/json');
            $result = Config::query($app->db, 'display');

            if ($result->get('success')) {
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();
        })->name('api_config_list')->conditions(array());

        $app->post('/api/config', function() use ($app) {
            $body = $app->request->getBody();
            $record = new Record(json_decode($body, true));
            $app->response->headers->set('Content-Type', 'application/json');
            $result = Config::query($app->db, 'save', $record);

            if ($result->get('success')) {
                $id = $record->has('id') ? $record->get('id') : $result->get('last.insert.id');
                Log::query('log', $app->session->get('user.id'), 'config', $id, 'save');
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();
        })->name('api_config_save');


        $app->get('/api/log(/:pg)', function($pg = 1) use ($app) {
            $app->response->headers->set('Content-Type', 'application/json');
            $result = Log::query($app->db, 'find', $pg, $app->config('per_page'));

            if ($result->get('success')) {
                $app->response->setStatus(200);
            } else {
                $app->response->setStatus(404);
            }

            $app->response->setBody($result->toJson());
            $app->stop();
        })->name('api_log_list')->conditions(array('pg' => '\d+'));


        /*
         * UPLOAD
         */
        
        $app->get('/upload', function() use ($app) {
            $app->render('upload.tpl.php');
        });

        $app->post('/upload', function() use ($app) {

            $validator = new FileUpload\Validator\Simple(1024 * 1024 * 2, ['image/png', 'image/jpg']);
            $pathresolver = new FileUpload\PathResolver\Simple('/var/www/html/files/');
            $filesystem = new FileUpload\FileSystem\Simple();
            $fileupload = new FileUpload\FileUpload($_FILES['files'], $_SERVER);

            $fileupload->setPathResolver($pathresolver);
            $fileupload->setFileSystem($filesystem);
            $fileupload->addValidator($validator);

            list($files, $headers) = $fileupload->processAll();

            foreach($headers as $header => $value) {
              header($header . ': ' . $value);
            }

            $body = json_encode(array('files' => $files));
            $app->response->setBody($body);
            $app->stop();
        });


        return $app;
    }
}
