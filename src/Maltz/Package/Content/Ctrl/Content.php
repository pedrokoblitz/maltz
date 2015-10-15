 <?php

namespace Maltz\Package\Api\Ctrl;

use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Package\Sys\Model\Config;
use Maltz\Package\Sys\Model\User;
use Maltz\Package\Sys\Model\Log;
use Maltz\Package\Content\Model\Area;
use Maltz\Package\Content\Model\Block;

class Content
{
    /**
     * /
     * @param  [type] $app [description]
     * @return [type]      [description]
     */
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
            $id = $record->has('id') ? $record->get('id') : $result->getLastInsertId();
            Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), $model, $id, 'save', '', '', $app->nonce->get());
            $app->handler->handleApiResponse($result);
        })->name('api_save')->conditions(array('model' => 'content|collection|resource|term'));

        $app->post('/api/:model/delete', function ($model) use ($app) {

                $entity = $app->handler->setEntity($model);
                $record = $app->handler->handlePostRequest();
                $id = $record->get('id');
                $result = $entity->delete($id);
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), $model, $record->get('id'), 'delete', '', '', $app->nonce->get());
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
        $app->get('/api/attachment/:group_name/:group_id/show(/:item_name)', function ($group_name, $group_id, $item_name = null) use ($app) {

                $entity = $app->handler->setEntity($group_name);
                $result = $entity->getAllAttachments($group_id, $item_name);
                $app->handler->handleApiResponse($result);
        })->name('api_show_items')->conditions(array('group_name' => 'content|collection', 'group_id' => '\d+', 'item_name' => 'content|collection|resource|term'));
        
        $app->post(
            '/api/attachment/add',
            function () use ($app) {
                $record = $app->handler->handlePostRequest();
                $entity = $app->handler->setEntity($record->get('group_name'));
                $result = $entity->addAttachment($record);
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), $record->get(''), $record->get(''), 'add_attachment', $record->get(''), $record->get(''), $app->nonce->get());
                $app->handler->handleApiResponse($result);
            }
        )->name('api_add_item');

        $app->post('/api/attachment/remove', function () use ($app) {

                $entity = $app->handler->setEntity($record->get('group_name'));
                $record = $app->handler->handlePostRequest();
                $result = $entity->removeAttachment($record);
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), '', '', '', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);
        })->name('api_remove_item');

        /*
         * METADATA
         */
        $app->post('/api/metadata/add', function () use ($app) {

                $entity = $app->handler->setEntity($record->get('item_name'));
                $record = $app->handler->handlePostRequest();
                $result = $entity->addMeta($record);
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), '', '', '', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);
        })->name('api_add_meta');

        $app->post('/api/metadata/remove', function () use ($app) {

                $entity = $app->handler->setEntity($record->get('item_name'));
                $record = $app->handler->handlePostRequest();
                $result = $entity->removeMeta($record);
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), '', '', '', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);
        })->name('api_remove_meta');

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

        $app->post('/api/area/block/add', function () use ($app) {

                $record = $app->handler->handlePostRequest();
                $result = Area::query($app->db, 'show', $id);
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), '', '', '', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);
        })->name('api_area_block_add');

        $app->post('/api/area/block/remove', function () use ($app) {

                $record = $app->handler->handlePostRequest();
                $result = Area::query($app->db, 'removeBlock', $id);
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), '', '', '', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);
        })->name('api_area_block_remove');

        $app->post('/api/area/delete', function () use ($app) {

                $record = $app->handler->handlePostRequest();
                $result = Area::query($app->db, 'delete', $id);
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), 'area', $id, 'delete', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);
        })->name('api_area_delete');

        $app->post('/api/area/save', function () use ($app) {

                $record = $app->handler->handlePostRequest();
                $result = Area::query($app->db, 'save', $record);
                $id = $record->has('id') ? $record->get('id') : $result->get('last.insert.id');
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), $model, $id, 'save', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);
        })->name('api_area_save');

        $app->get('/api/block(/:pg(/:key(/:order)))', function ($pg = 1, $key = 'modified', $order = 'desc') use ($app) {

                $result = Block::query($app->db, 'find', $pg, $app->config('per_page'), $key, $order);
                $app->handler->handleApiResponse($result);
        })->name('api_block_list')->conditions(array('pg' => '\d+', 'key' => '\w+', 'order' => 'asc|desc'));

        $app->post('/api/block/delete', function () use ($app) {

                $record = $app->handler->handlePostRequest();
                $result = Block::query($app->db, 'delete', $id);
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), 'block', $id, 'delete', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);
        })->name('api_block_delete');

        $app->post('/api/block/save', function () use ($app) {

                $record = $app->handler->handlePostRequest();
                $result = Block::query($app->db, 'save', $record);
                $id = $record->has('id') ? $record->get('id') : $result->get('last.insert.id');
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), 'block', $id, 'save', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);
        })->name('api_block_save');

        return $app;
    }
}
