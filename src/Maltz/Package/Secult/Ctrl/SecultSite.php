<?php

namespace Maltz\Package\Content\Ctrl;

use Maltz\Package\Content\Model\Block;
use Maltz\Package\Content\Model\Cover;
use Maltz\Package\Content\Model\Page;
use Maltz\Package\Content\Model\Content;
use Maltz\Package\Content\Model\Book;
use Maltz\Mvc\Controller;
use Maltz\Mvc\View;
use Maltz\Package\Sys\Model\Rss;
use Maltz\Utils\Carteiro;

/**
 * Ações do frontend
 *
 * http://ideiasinsolitas.com.br/
 *
 * @copyright Copyright (c) 2012-2013 Pedro Koblitz
 * @author    Pedro Koblitz pedrokoblitz@gmail.com
 * @license   GPL v2
 *
 * @package Meu CMS ainda não tem name
 *
 * @version 0.1 alpha
 */

class SecultSite extends Controller
{
    /**
     * /
     * @param  [type] $app [description]
     * @return [type]      [description]
     */
    public function route($app)
    {
        $app->view->setLayout($layout);

        $app->get('/tag/:tag', function ($tag) use ($app) {

        })->name('tag')->conditions(array('' => ''));

        $app->get('/', function () use ($app) {
            $result = Content::query($app->db, 'findPublished');
            $app->view->setData($result);
            $app->view->render('');
        })->name('home');

        $app->get('/perfil', function () use ($app) {
            $result = User::query($app->db, 'show', $app->sessionDataStore->getUserId());
            $app->view->setData($result);
            $app->view->render('');
        })->name('perfil');

        $app->get('/perfil/editar', function () use ($app) {
            $app->view->setData($result);
            $app->view->render('');
        })->name('salvar_perfil');

        $app->post('/perfil/salvar', function () use ($app) {
            $record = $app->handler->handlePostRequest();
            $app->redirect($app->urlFor(''));
        })->name('salvar_perfil');
        
        $app->post('/comentar', function () use ($app) {
            $record = $app->handler->handlePostRequest();
            $app->redirect($app->urlFor(''));
        })->name('comentar');
        
        $app->get('/programacao(/:pagina)', function ($pagina = 1) use ($app) {
            $result = Event::query($app->db, 'findPublished', $pagina);
            $app->view->setData($result);
            $app->view->render('');
        })->name('programacao')->conditions(array('' => ''));
        
        $app->get('/evento/:slug/:id', function ($slug, $id) use ($app) {
            $result = Event::query($app->db, 'showPublished', $id);
            $app->view->setData($result);
            $app->view->render('');
        })->name('evento')->conditions(array('' => ''));
        
        $app->get('/espacos(/:pagina)', function ($pagina = 1) use ($app) {
            $result = Content::query($app->db, 'findPublished', $pagina);
            $app->view->setData($result);
            $app->view->render('');
        })->name('espacos')->conditions(array('' => ''));
        
        $app->get('/espaco/:slug/:id', function ($slug, $id) use ($app) {
            $result = Content::query($app->db, 'showPublished', $id);
            $app->view->setData($result);
            $app->view->render('');
        })->name('espaco')->conditions(array('' => ''));
        
        $app->get('/galerias(/:pagina)', function ($pagina = 1) use ($app) {
            $result = Content::query($app->db, 'findPublished', $pagina);
            $app->view->setData($result);
            $app->view->render('');
        })->name('galerias')->conditions(array('' => ''));
        
        $app->get('/galeria/:slug/:id', function ($slug, $id) use ($app) {
            $result = Content::query($app->db, 'showPublished', $id);
            $app->view->setData($result);
            $app->view->render('');
        })->name('galeria')->conditions(array('' => ''));
        
        $app->get('/revista(/:pagina)', function ($pagina = 1) use ($app) {
            $result = Content::query($app->db, 'findPublished', $pagina);
            $app->view->setData($result);
            $app->view->render('');
        })->name('revista')->conditions(array('' => ''));
        
        $app->get('/materia/:slug/:id', function ($slug, $id) use ($app) {
            $result = Content::query($app->db, 'showPublished', $id);
            $app->view->setData($result);
            $app->view->render('');
        })->name('materia')->conditions(array('' => ''));
        
        $app->get('/notas(/:pagina)', function ($pagina = 1) use ($app) {
            $result = Content::query($app->db, 'findPublished', $pagina);
            $app->view->setData($result);
            $app->view->render('');
        })->name('notas')->conditions(array('' => ''));
        
        $app->get('/secao/:slug/:id', function ($id) use ($app) {
            $result = Content::query($app->db, 'showPublished', $id);
            $app->view->setData($result);
            $app->view->render('');
        })->name('nota')->conditions(array('' => ''));
        
        $app->get('/equipe', function () use ($app) {
            $result = Equipe::query($app->db, 'findPublished', $pagina);
            $app->view->setData($result);
            $app->view->render('');
        })->name('equipe');
        
        $app->get('/consultas(/:pagina)', function ($pagina = 1) use ($app) {
            $result = ConsultaPublica::query($app->db, 'findPublished', $pagina);
            $app->view->setData($result);
            $app->view->render('');
        })->name('consultas')->conditions(array('' => ''));
        
        $app->get('/consulta/:id', function ($id) use ($app) {
            $result = ConsultaPublica::query($app->db, 'showPublished', $id);
            $app->view->setData($result);
            $app->view->render('');
        })->name('consulta')->conditions(array('' => ''));
        
        $app->get('/editais(/:pagina)', function ($pagina = 1) use ($app) {
            $result = Edital::query($app->db, 'findPublished', $pagina);
            $app->view->setData($result);
            $app->view->render('');
        })->name('editais')->conditions(array('' => ''));
        
        $app->get('/edital/:id', function ($id) use ($app) {
            $result = Edital::query($app->db, 'showPublished', $id);
            $app->view->setData($result);
            $app->view->render('');
        })->name('edital')->conditions(array('' => ''));
        
        $app->get('/projetos(/:pagina)', function ($pagina = 1) use ($app) {
            $result = Content::query($app->db, 'findPublished', $pagina);
            $app->view->setData($result);
            $app->view->render('');
        })->name('projetos')->conditions(array('' => ''));
        
        $app->get('/projeto/:id', function ($id) use ($app) {
            $result = Content::query($app->db, 'showPublished', $id);
            $app->view->setData($result);
            $app->view->render('');
        })->name('projeto')->conditions(array('' => ''));
        
        $app->get('/leis(/:pagina)', function ($pagina = 1) use ($app) {
            $result = LeiIncentivo::query($app->db, 'findPublished', $pagina);
            $app->view->setData($result);
            $app->view->render('');
        })->name('leis')->conditions(array('' => ''));
        
        $app->get('/lei/:id', function ($id) use ($app) {
            $result = LeiIncentivo::query($app->db, 'showPublished', $id);
            $app->view->setData($result);
            $app->view->render('');
        })->name('lei')->conditions(array('id' => '\d+'));
        
        return $app;
    }
}
