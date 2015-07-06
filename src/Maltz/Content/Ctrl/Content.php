<?php

namespace Maltz\Content\Ctrl;

use Maltz\Content\Model\Page;
use Maltz\Content\Model\Content;
use Maltz\Content\Model\Book;
use Maltz\Mvc\Controller;
use Maltz\Mvc\View;

/**
 * Ações dos dbs de conteúdo
 *
 * http://ideiasinsolitas.com.br/
 *
 * @copyright  Copyright (c) 2012-2013 Pedro Koblitz
 * @author      Pedro Koblitz pedrokoblitz@gmail.com
 * @license    GPL v2
 *
 * @package    Maltz
 *
 * @version    0.1 alpha
 */

class Content extends Controller
{

    public function route($app)
    {

        $app->container->singleton('view', function () use ($app) {
            return new View($app->container['settings']);
        });

        /*
		 * list contents
		 *
		 *
		 *
		 * return string / void
		 */

        $app->get('/admin/content(/order/:key(/:order(/page/:pg)))', function ($key = 'datepub', $order = 'DESC', $pg = 1) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $model = new Content($app->db);
            $pp = $app->config('per_page');
            $dbOrder = array($key, $order);
            $model->index($pp, $pg, "", $dbOrder);
            $app->view->setTemplates('layouts/list.layout.tpl.php', 'lists/content.tpl.php');
            $data = $model->all();
            $body = $app->view->render($data);
            $app->response->headers->set('Content-Type', 'text/html');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('admin_content_index')->conditions(array('key' => '\w+', 'order' => '\w+', 'pg' => '\d+'));

        /*
		 * cria new content
		 *
		 *
		 * return void
		 */
        $app->get('/api/content/new', function () use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $model = new Content($app->db);
            $post = array('activity' => 0);
            $model->insert($post);
            $id = $model->get('meta.insert');

            $app->activity->write(
                $app->session->get('user.username'),
                $app->session->get('user.id'),
                'criou',
                'contents',
                $id
            );

            $app->flash('message', 'new record created');
            $app->redirect($app->urlFor('admin_content_edit', array('id' => $id)));
        })->name('api_content_new');

        /*
		 * edita content
		 *
		 *
		 *
		 * return string / void
		 */
        $app->get('/admin/content/:id/edit', function ($id) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $model = new Content($app->db);
            $model->showAdmin($id);
            $app->view->setTemplates('layouts/form.layout.tpl.php', 'backend/content.tpl.php');
            $data = $model->all();

            $body = $app->view->render($data);
            $app->response->headers->set('Content-Type', 'text/html');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('admin_content_edit')->conditions(array('id' => '\d+'));

        /*
		 * salva content a partir de envio de formulario
		 *
		 *
		 *
		 * return void
		 */
        $app->post('/api/content/:id/save', function ($id) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $model = new Content($app->db);
            $post = $app->request->post();
            if (!$app->nonce->verify($post['nonce'])) {
                die;
            }

            $model->update($post, $id);
            $app->activity->write(
                $app->session->get('user.username'),
                $app->session->get('user.id'),
                'salvou',
                'contents',
                $id
            );

            $app->flash('message', 'registro modificado');
            $app->redirect($app->urlFor('admin_content_edit', array('id' => $id)));

        })->name('api_content_save')->conditions(array('id' => '\d+'));
        
        return $app;
    }
}
