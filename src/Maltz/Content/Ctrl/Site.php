<?php

namespace Maltz\Content\Ctrl;

use Maltz\Content\Model\Block;
use Maltz\Content\Model\Cover;
use Maltz\Content\Model\Page;
use Maltz\Content\Model\Content;
use Maltz\Content\Model\Book;
use Maltz\Mvc\Controller;
use Maltz\Mvc\View;
use Maltz\Sys\Model\Rss;
use Maltz\Utils\Carteiro;

/**
 * Ações do frontend
 *
 * http://ideiasinsolitas.com.br/
 *
 * @copyright  Copyright (c) 2012-2013 Pedro Koblitz
 * @author     Pedro Koblitz pedrokoblitz@gmail.com
 * @license    GPL v2
 *
 * @package    Meu CMS ainda não tem name
 *
 * @version    0.1 alpha
 */

class Site extends Controller
{

    public function route($app)
    {

        $app->container->singleton('view', function () use ($app) {
            return new View($app->container['settings']);
        });

        /*
		 *
		 * carrega models para capa do site
		 *
		 * @param
		 *
		 * return string
		 */
        $app->get('/', function () use ($app) {
            $capa = new Cover($app->db);
            $capa->setContents((int) $app->config('capa_contents_quant'));
            $capa->setBlog((int) $app->config('capa_blog_quant'), $app->config('tumblr_rss_url'));
            $app->view->setLayout('layouts/site.layout.tpl.php');
            $app->view->setView('frontend/cover.tpl.php');
            $body = $app->view->render($capa->all());
            $app->response->headers->set('Content-Type', 'text/html');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('site_home');

        /*
		 * carrega rss do tumblr e monta no layout
		 *
		 * @param
		 *
		 * return string
		 */
        $app->get('/blog', function () use ($app) {
            $rss = new Rss($app->config('tumblr_rss_url'));
            $rss->getFeed();

            $block = new Block($app->db);
            $block->showArea('blog');
            $sidebar = $block->all();

            if (isset($sidebar['data.record'])) {
                $rss->set('sidebar', $sidebar['data.record']);
            }

            $app->view->setLayout('layouts/site.layout.tpl.php');
            $app->view->setView('frontend/blog.tpl.php');

            $body = $app->view->render($rss->all());
            $app->response->headers->set('Content-Type', 'text/html');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('site_blog');

        /*
		 * list contents
		 *
		 *
		 * @param
		 *
		 * return string
		 */

        $app->get('/contents(/:pg)', function ($pg = 1) use ($app) {

            $model = new Content($app->db);

            // CEM PROJETOS SEM PAGINACAO
            $pg = 1;
            $pp = 100; // $app->config('contents_page_quant',100);
            $order = array('datepub', 'DESC');
            $model->index($pp, $pg, "", $order, true);
            $app->view->setLayout('layouts/site.layout.tpl.php');
            $app->view->setView('frontend/contents.tpl.php');

            $block = new Block($app->db);
            $block->showArea('content');
            $sidebar = $block->all();
            if (isset($sidebar['data.record'])) {
                $app->view->set('sidebar', $sidebar['data.record']);
            }
            $body = $app->view->render($model->all());
            $app->response->headers->set('Content-Type', 'text/html');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('site_content_index')->conditions(array('pg' => '\d+'));

        /*
		 *
		 * mostra um content
		 *
		 * @param
		 *
		 * return string
		 */
        $app->get('/content/:id', function ($id) use ($app) {
            $model = new Content($app->db);
            $model->show($id, true, false, true);
            $app->view->setLayout('layouts/site.layout.tpl.php');
            $app->view->setView('frontend/content.tpl.php');
            $body = $app->view->render($model->all());
            $app->response->headers->set('Content-Type', 'text/html');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('site_content')->conditions(array('id' => '\d+'));

        /*
		 *
		 * formulário de contact
		 *
		 * @param
		 *
		 * return string
		 */
        $app->get('/contact', function () use ($app) {

            $block = new Block($app->db);
            $block->showArea('contact');
            $sidebar = $block->all();
            if (isset($sidebar['data.record'])) {
                $app->view->set('sidebar', $sidebar['data.record']);
            }
            $app->view->setTemplates('layouts/site.layout.tpl.php', 'frontend/contact.tpl.php');
            $body = $app->view->render();
            $app->response->headers->set('Content-Type', 'text/html');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('contact_form');

        /*
		 *
		 * send formulário de contact
		 *
		 * @param
		 *
		 * return void
		 */
        $app->post('/contact/send', function () use ($app) {

            $post = $app->request->post();
            $enviada = Carteiro::send(
                'meu',
                $body = $post['message'] . " \n " . $post['name'] . " \n " . $post['email']
            );

            if ($enviada) {
                $_SESSION['message'] = 'Sua message foi enviada.';

            } else {
                $_SESSION['message'] = 'Sua message nao foi enviada.';
            }

            $app->redirect($app->urlFor('contact_form'));
        })->name('send_contact');

        return $app;
    }
}
