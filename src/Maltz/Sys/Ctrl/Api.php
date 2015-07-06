<?php

namespace Maltz\Sys\Ctrl;

use Maltz\Media\Model\File;
use Maltz\Content\Model\Block;
use Maltz\Sys\Model\Config;
use Maltz\Media\Model\Album;
use Maltz\Sys\Model\Log;
use Maltz\Content\Model\Page;
use Maltz\Content\Model\Content;
use Maltz\Sys\Model\User;
use Maltz\Content\Model\Book;
use Maltz\Mvc\Controller;
use Maltz\Mvc\View;

/**
 * Servico genérico que toma conta de gerar CRUD
 * implicitamente
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

class Api extends Controller
{

    public function route($app)
    {

        $app->container->singleton('view', function () use ($app) {
            return new View($app->container['settings']);
        });

        $app->model = function () use ($app) {
            switch ($app->config('model')) {

                case 'file':
                    return new File($app->db);

                case 'album':
                    return new Album($app->db);

                case 'content':
                    return new Content($app->db);

                case 'type':
                    return new ContentType($app->db);

                case 'taxonomy':
                    return new TermType($app->db);

                case 'term':
                    return new Term($app->db);

                case 'config':
                    return new Config($app->db);

                case 'block':
                    return new Block($app->db);

                case 'log':
                    return new Log($app->db);

                case 'user':
                    return new User($app->db);

                default:
                    $app->halt(404, 'Modelo de dados não encontrado');
                    break;
            }
        };

        /*
		 *
		 * muda campo activity do model selecionado para 1
		 *
		 * return void
		 */
        $app->get('/api/:model/:id/activate', function ($model, $id) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $app->config('model', $model);
            $app->model->activate($id);

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
		 * muda campo activity do model selecionado para 0
		 *
		 * return void
		 */
        $app->get('/api/:model/:id/deactivate', function ($model, $id) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $app->nameModel = $model;
            $app->model->deactivate($id);

            $app->activity->write(
                $app->session->get('user.username'),
                $app->session->get('user.id'),
                'inactive',
                $model,
                $id
            );

            $app->flash('message', 'desativado');
            $app->request->isAjax() ? $app->redirect($app->urlFor('admin_model_edit', array('model' => $model, 'id' => $id))) : false;
        })->name('api_model_deactivate')->conditions(array('model' => '\w+', 'id' => '\d+'));

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
            $dbOrder = array($key, $order);
            $app->config('model', $model);
            $app->model->index($pp, $pg, "", $dbOrder);
            $app->view->setTemplates('layouts/list.layout.tpl.php', 'lists/' . $model . '.tpl.php');
            $data = $app->model->all();
            $body = $app->view->render($data);
            $app->response->headers->set('Content-Type', 'text/html');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('admin_model_index')->conditions(array('model' => '\w+', 'order' => '\w+', 'pp' => '\d+', 'pg' => '\d+'));

        /*
		 *
		 * mostra item do model selecionado
		 *
		 *
		 * return string / void
		 */

        $app->get('/admin/:model/:id/show', function ($model, $id) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $app->nameModel = $model;
            $app->model->show($id);
            $app->view->render($app->model->all(), 'layouts/frontend.layout.tpl.php', 'frontend/' . $model . '.view.tpl.php');
            $app->response->headers->set('Content-Type', 'text/html');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('admin_model_show')->conditions(array('model' => '\w+', 'id' => '\d+'));

        /*
		 *
		 * cria new registro
		 *
		 *
		 * return void
		 */

        $app->get('/api/:model/new', function ($model) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $post = array('activity' => 0);
            $app->nameModel = $model;
            $app->model->insert($post);
            $id = $app->model->get('meta.insert');

            $app->activity->write(
                $app->session->get('user.username'),
                $app->session->get('user.id'),
                'criou',
                $model,
                $id
            );

            $app->flash('message', 'new resgistro created');
            $app->redirect($app->urlFor('admin_model_edit', array('model' => $model, 'id' => $id)));
            $app->request->isAjax() ? $app->redirect($app->urlFor('admin_model_edit', array('model' => $model, 'id' => $id))) : false;
        })->name('api_model_new')->conditions(array('model' => '\w+'));

        /*
		 *
		 * edita registro existente
		 *
		 *
		 * return string / void
		 */

        $app->get('/admin/:model/:id/edit', function ($model, $id) use ($app) {

            $nonce = $app->nonce->generate();

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $app->nameModel = $model;
            $app->model->show($id);
            $data = $app->model->all();
            $data['nonce'] = $nonce;
            $data = $app->view->render($app->model->all(), 'layouts/form.layout.tpl.php', 'backend/' . $model . '.tpl.php');
            $body = json_encode($data);
            $app->response->headers->set('Content-Type', 'text/html');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('admin_model_edit')->conditions(array('model' => '\w+', 'id' => '\d+'));

        /*
		 *
		 * salva registro enviado pelo formulário
		 *
		 *
		 * return void
		 */

        $app->post('/api/:model/:id/save', function ($model, $id) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $post = $app->request->post();
            $app->nameModel = $model;
            $app->model->update($post, $id);

            $app->activity->write(
                $app->session->get('user.username'),
                $app->session->get('user.id'),
                'salvou',
                $model,
                $id
            );

            $app->flash('message', 'registro modificado');
            $app->request->isAjax() ? $app->redirect($app->urlFor('admin_model_edit', array('model' => $model, 'id' => $id))) : false;
        })->name('api_model_save')->conditions(array('model' => '\w+', 'id' => '\d+'));

            /*
    		 *
    		 * apaga registro selecionado
    		 *
    		 *
    		 * return void
    		 */
            $app->get('/api/:model/:id/delete', function ($model, $id) use ($app) {

                if (!$app->porteiro->loggedIn()) {
                    $app->redirect($app->urlFor('admin_login'));
                }

                $app->nameModel = $model;
                $app->model->delete($id);

                $app->activity->write(
                    $app->session->get('user.username'),
                    $app->session->get('user.id'),
                    'apagou',
                    $model,
                    $id
                );

                $app->flash('message', 'registro apagado');
                $app->request->isAjax() ? $app->redirect($app->urlFor('admin_model_edit', array('id' => $id))) : false;
            })->name('api_model_delete')->conditions(array('model' => '\w+', 'id' => '\d+'));

            /*
    		 *
    		 * list registros do model em JSON
    		 *
    		 *
    		 * return string JSON
    		 */
            $app->get('/api/:model(/:pg(/:key(/:order)))', function ($model, $pg = 1, $key = 'created', $order = 'DESC') use ($app) {

                if (!$app->porteiro->loggedIn()) {
                    $app->redirect($app->urlFor('admin_login'));
                }

                if ($model == 'users') {
                    return false;
                }

                $pp = $app->config('per_page');

                $app->nameModel = $model;
                $app->model->index($pp, $pg, "", $order);

                $body = json_encode($app->model->all());
                $app->response->headers->set('Content-Type', 'application/json');
                $app->response->setStatus(200);
                $app->response->setBody($body);
                $app->stop();
            })->name('api_model_index')->conditions(array('model' => '\w+', 'order' => '\w+', 'pp' => '\d+', 'pg' => '\d+'));

            /*
    		 *
    		 * mostra registro selecionado em JSON
    		 *
    		 *
    		 * return string json
    		 */
            $app->get('/api/:model/:id/show', function ($model, $id) use ($app) {

                if ($model == 'users') {
                    if (!$app->porteiro->loggedIn()) {
                        $app->redirect($app->urlFor('admin_login'));
                    }
                }

                $app->model->show($id);
                $body = json_encode($app->model->all());

                $app->response->headers->set('Content-Type', 'application/json');
                $app->response->setStatus(200);
                $app->response->setBody($body);
                $app->stop();
            })->name('api_model_show')->conditions(array('model' => '\w+', 'id' => '\d+'));

            return $app;
    }
}
