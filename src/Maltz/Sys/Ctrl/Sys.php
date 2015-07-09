<?php

namespace Maltz\Sys\Ctrl;

use Maltz\Sys\Model\Panel;
use Maltz\Sys\Model\User;
use Maltz\Utils\Porteiro;
use Maltz\Mvc\Controller;
use Maltz\Mvc\View;

/**
 * Ações da administraction do sistema
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

class Sys extends Controller
{

    public function route($app)
    {
        $this->session = $app->session;
        $this->user = new User($app->db);

        /*
		 * form de login
		 *
		 * return string / void
		 */
        $app->get('/admin/login', function () use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->view->setView('backend/login.form.tpl.php');
                $body = $app->view->render();
                $app->response->headers->set('Content-Type', 'text/html');
                $app->response->setStatus(200);
                $app->response->setBody($body);
                $app->stop();
            } else {
                $app->redirect($app->urlFor('admin_home'));
            }
        })->name('admin_login');

        /*
		 * autenticar
		 *
		 * return void
		 */
        $app->post('/api/login', function () use ($app) {

            $post = $app->request->post();
            $remember = isset($post['remember']) ? $post['remember'] : null;
            $app->porteiro->login($post['username'], $post['password'], $remember);
            $redir = $app->urlFor('admin_home');
            $flash = $app->flash['proximo'];

            if (isset($flash) && !empty($flash)) {
                $redir = $app->urlFor($flash);
            }

            $app->redirect($redir);
        })->name('api_login');

        /*
         * autenticar
         *
         * return void
         */
        $app->get('/api/facebook/login', function () use ($app) {

        })->name('api_facebook_login');
        
        /*
         * autenticar
         *
         * return void
         */
        $app->post('/api/facebook/login', function () use ($app) {

        })->name('api_facebook_login_post');
        
        /*
		 * sair
		 *
		 *
		 * return void
		 */
        $app->get('/api/logout', function () use ($app) {

            $app->flash('message', 'você está desconectado');

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            if ($app->cookie->has('token.remember')) {
                $app->cookie->remove('token.remember');
            }

            $app->porteiro->logout();
            $app->redirect('login');
        })->name('api_logout');

        /*
		 * panel inicial
		 *
		 *
		 * return string / void
		 */
        $app->get('/admin', function () use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $model = new Panel($app->db);
            $model->setContents();
            $model->setAlbums();
            $model->setLog();
            $data = $model->all();
            $app->view->setTemplates('layouts/admin.layout.tpl.php', 'backend/panel.tpl.php');
            $body = $app->view->render($data);
            $app->response->headers->set('Content-Type', 'text/html');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
 
        })->name('admin_home');

        return $app;
    }
}
