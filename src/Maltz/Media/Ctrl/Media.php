<?php

namespace Maltz\Media\Ctrl;

use Maltz\Media\Model\File;
use Maltz\Media\Model\Album;
use Maltz\Content\Model\Page;
use Maltz\Content\Model\Content;
use Maltz\Content\Model\Book;
use Maltz\Mvc\Controller;
use Maltz\Mvc\View;
use Maltz\Utils\Upload;

/**
 * Ações dos dbs de mídia
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

class Media extends Controller
{

    public function route($app)
    {
        $app->container->singleton('view', function () use ($app) {
            return new View($app->container['settings']);
        });

        /*
		 *
		 * list docs em JSON
		 *
		 *
		 * @param
		 *
		 * return void
		 */
        $app->get('/api/documents(/:num)', function ($num = 100) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $m = new Content($app->db);
            $docs = $m->listDocuments($num);
            $data = $app->view->render($docs);
            $body = json_encode($data);
            $app->response->headers->set('Content-Type', 'application/json');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('api_documents')->conditions(array('num' => '\d+'));

        /*
		 *
		 * muda a album selecionada para
		 * books, contents e pages
		 *
		 * @param
		 *
		 * return void
		 */

        $app->get('/api/:name/album/:p_id/set/:g_id', function ($name, $p_id, $g_id) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $app->response->setStatus(200);
            $app->response->headers->set('Content-Type', 'application/json');

            switch ($name) {
                case 'page':
                    $m = new Page($app->db);
                    break;

                case 'content':
                    $m = new Content($app->db);
                    break;

                case 'book':
                    $m = new Book($app->db);
                    break;

                default:
                    $app->response->setStatus(404);
                    break;
            }
            $body = json_encode($m->updateAlbum($p_id, $g_id));
            $app->response->setBody($body);
            $app->stop();
        })->name('api_set_album')->conditions(array('p_id' => '\d+', 'g_id' => '\d+'));

        /*
		 *
		 * muda a capa selecionada para
		 * books, contents e pages
		 *
		 * @param
		 *
		 * return void
		 */

        $app->get('/api/:name/cover/:p_id/set/:f_id', function ($name, $p_id, $f_id) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            switch ($name) {
                case 'pages':
                    $m = new Page($app->db);
                    break;

                case 'contents':
                    $m = new Content($app->db);
                    break;

                case 'books':
                    $m = new Book($app->db);
                    break;

                default:
                    $app->halt(HTTP_FORBIDDEN, 'Você está fazendo merdinha.');
                    break;
            }

            $data = $m->updateCover($p_id, $f_id);
            $body = json_encode($data);
            $app->response->headers->set('Content-Type', 'application/json');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('api_set_cover')->conditions(array('p_id' => '\d+', 'f_id' => '\d+'));

        /*
		 *
		 * delete a capa selecionada para
		 * books, contents e pages
		 *
		 * @param
		 *
		 * return void
		 */

        $app->get('/api/:name/cover/:p_id/delete', function ($name, $p_id) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            switch ($name) {
                case 'pages':
                    $m = new Page($app->db);
                    break;

                case 'contents':
                    $m = new Content($app->db);
                    break;

                case 'books':
                    $m = new Book($app->db);
                    break;

                default:
                    $app->halt(HTTP_FORBIDDEN, 'Você está fazendo merdinha.');
                    break;
            }

            $data = $model->deleteCover($p_id);
            $body = json_encode($data);
            $app->response->headers->set('Content-Type', 'application/json');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('api_delete_cover')->conditions(array('name' => '\w+', 'p_id' => '\d+'));

        /*
		 *
		 * seletor de albums
		 *
		 * @param
		 *
		 * return void
		 */
        $app->get('/api/album/cover/:id', function ($id) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $app->view->setView('blocks/album.cover.selector.tpl.php');
            $model = new Album($app->db);
            $data = $model->photosAlbum($id);
            $body = json_encode($data);
            $app->response->headers->set('Content-Type', 'application/json');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('api_album_cover')->conditions(array('id' => '\d+'));

        /*
		 *
		 * muda a document selecionado para
		 * contents
		 *
		 * @param
		 *
		 * return void
		 */

        $app->get('/api/:name/document/:p_id/set/:d_id', function ($name, $p_id, $d_id) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            if ($name == 'contents') {
                $model = new Content($app->db);
            } else {
                $app->halt(HTTP_FORBIDDEN, 'Você está fazendo merdinha.');
            }

            $data = $model->updateDocument($p_id, $d_id);
            $body = json_encode($data);
            $app->response->headers->set('Content-Type', 'application/json');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('api_set_document')->conditions(array('p_id' => '\d+', 'd_id' => '\d+'));

        /*
		 * retorna photos da album em JSON
		 *
		 *
		 * @param
		 *
		 * return string json
		 */
        $app->get('/api/album/:id/photos', function ($id) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $model = new Album($app->db);
            $data = $model->photosAlbum($id);
            $body = json_encode($data);
            $app->response->headers->set('Content-Type', 'application/json');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('api_album_photos')->conditions(array('id' => '\d+'));

        /*
		 * insere imagem na album
		 *
		 *
		 * @param
		 *
		 * return void
		 *
		 */
        $app->get('/api/album/:g_id/photo/:f_id/add', function ($f_id, $g_id) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $model = new File($app->db);
            $data = $model->assocPhotoAlbum($f_id, $g_id);
            $body = json_encode($data);
            $app->response->headers->set('Content-Type', 'application/json');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('api_album_photo_add')->conditions(array('g_id' => '\d+', 'f_id' => '\d+'));

        /*
		 * apaga photo da album
		 *
		 *
		 * @param
		 *
		 * return string void
		 */
        $app->get('/api/album/:g_id/photo/:f_id/delete', function ($f_id, $g_id) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $model = new File($app->db);
            $data = $model->deletePhotoAlbum($f_id, $g_id);
            $body = json_encode($data);
            $app->response->headers->set('Content-Type', 'application/json');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('api_album_photo_delete')->conditions(array('g_id' => '\d+', 'f_id' => '\d+'));

        /*
		 * muda capa da album
		 *
		 *
		 * @param
		 *
		 *
		 */
        $app->get('/api/:name/:c_id/cover/:f_id/add', function ($name, $c_id, $f_id) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            if ($name == 'pages' || $name == 'contents') {
                if ($name == 'pages') {
                    $cpk = 'page_id';
                }
                if ($name == 'contents') {
                    $cpk = 'content_id';
                }
                $model = new File($app->db);
                $data = $model->assocPhotoCover($model, $cpk, $c_id, $f_id);
            } else {
                $data = array();
            }
            $body = json_encode($data);
            $app->response->headers->set('Content-Type', 'application/json');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('api_model_update_cover')->conditions(array('name' => '\w+', 'c_id' => '\d+', 'f_id' => '\d+'));

        /*
		 * apaga capa da album
		 *
		 *
		 * @param
		 *
		 * return void
		 *
		 */
        $app->get('/api/:name/:c_id/cover/delete', function ($name, $c_id) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            if ($name == 'pages' || $name == 'contents') {
                if ($name == 'pages') {
                    $cpk = 'page_id';
                }
                if ($name == 'contents') {
                    $cpk = 'content_id';
                }
                $model = new File($app->db);
                $data = $model->deletePhotoCover($name, $cpk, $c_id);
                $body = json_encode($data);
                $app->response->headers->set('Content-Type', 'application/json');
                $app->response->setStatus(200);
                $app->response->setBody($body);
                $app->stop();
            }
        })->name('api_model_delete_cover')->conditions(array('name' => '\w+', 'c_id' => '\d+'));

        /*
		 *
		 * list de albums
		 *
		 * @param
		 *
		 * return string / void
		 */

        $app->get('/admin/albums(/order/:key(/:order(/page/:pg)))', function ($key = 'created', $order = 'ASC', $pg = 1) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $db = $app->db;
            $model = new Album($db);
            $pp = $app->config('per_page');
            $dbOrder = array($key, $order);
            
            $model->index($pp, $pg, "", $dbOrder);
            $app->view->setTemplates('layouts/list.layout.tpl.php', 'lists/albums.tpl.php');
            
            $data = $model->all();
            $body = $app->view->render($data);
            $app->response->headers->set('Content-Type', 'text/html');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('admin_album_index')->conditions(array('key' => '\w+', 'order' => '\w+', 'pg' => '\d+'));

        /*
		 * cria new album
		 *
		 *
		 * @param
		 *
		 * return void
		 */

        $app->get('/api/album/new', function () use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $db = $app->db;
            $model = new Album($db);
            $post = array('activity' => 0);
            $model->insert($post);
            $id = $model->get('meta.insert');

            $app->activity->write(
                $app->session->get('user.username'),
                $app->session->get('user.id'),
                'criou',
                'albums',
                $id
            );
            $app->flash('message', 'new registro created');
            $app->redirect($app->urlFor('admin_album_edit', array('id' => $id)));
            $app->request->isAjax() ? $app->redirect($app->urlFor('admin_album_edit', array('id' => $id))) : false;

        })->name('api_album_new');

        /*
		 * edita album
		 *
		 *
		 * @param
		 *
		 * return string / void
		 */

        $app->get('/admin/albums/:id/edit', function ($id) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $db = $app->db;
            $model = new Album($db);

            $model->show($id);
            $app->view->setTemplates('layouts/form.layout.tpl.php', 'backend/album.tpl.php');

            

            $data = $c->all();
            $this->view->addActions($urls);

            $body = $app->view->render($data);
            $app->response->headers->set('Content-Type', 'text/html');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('admin_album_edit')->conditions(array('id' => '\d+'));

        /*
		 * salva album enviada pelo formulario
		 *
		 *
		 * @param
		 *
		 * return void
		 */

        $app->post('/api/album/:id/save', function ($id) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $db = $app->db;
            $model = new Album($db);
            $post = $app->request->post();
            $model->update($post, $id);
            
            $app->activity->write(
                $app->session->get('user.username'),
                $app->session->get('user.id'),
                'salvou',
                'albums',
                $id
            );

            $app->flash('message', 'registro modificado');
            $app->request->isAjax() ? $app->redirect($app->urlFor('admin_album_edit', array('id' => $id))) : false;
        })->name('api_album_save')->conditions(array('id' => '\d+'));

        /*
		 * cria album a partir de photos inseridas
		 * via upload multiplo
		 *
		 *
		 * @param
		 *
		 * return void
		 */

        $app->post('/api/album/photos/new', function () use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            if ($app->session->has('files')) {
                $g = new Album($app->db);
                $g->insert(array('title' => 'album sem name'));
                $g_id = $g->get('meta.insert');
                $f = new File($app->db);
                $files = $app->session->get('files');

                foreach (array_keys($files) as $c) {
                    $f_id = $files[$c];
                    $f->assocPhotoAlbum($f_id, $g_id);
                }

                $app->session->remove('files');
                $app->request->isAjax() ? $app->redirect($app->urlFor('admin_album_edit', array('id' => $g_id))) : false;
            }

        })->name('api_album_photos_new');

        $app->post('/api/album/order/save', function () use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $post = $app->request->post();
            $sql = "UPDATE photos_albums SET order=:order WHERE album_id=:album_id AND photo_id=:photo_id;";

            if (count($post['order']) == count($post['photo_id']) && count($post['photo_id']) == count($post['album_id'])) {
                $c = count($post['order']);
                $data = array();
                for ($i = 0; $i < $c; $i++) {
                    $bind = array(
                        'album_id' => $post['album_id'][$i],
                        'photo_id' => $post['photo_id'][$i],
                        'order' => $post['order'][$i],
                    );

                    $data['meta.save'][] = $app->db->run($sql, $bind);
                }

                $body = json_encode($data);
                $app->response->headers->set('Content-Type', 'application/json');
                $app->response->setStatus(200);
                $app->response->setBody($body);
            }
            $app->stop();
        })->name('api_album_order_save');

        /*
		 * formulario de upload
		 *
		 *
		 * @param
		 *
		 * return string / void
		 */

        $app->get('/admin/upload', function () use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $app->view->setView('backend/upload.tpl.php');
            $body = $app->view->render();
            $app->response->headers->set('Content-Type', 'text/html');
            $app->response->setStatus(200);
            $app->response->setBody($body);
            $app->stop();
        })->name('admin_upload');

        /*
		 * upload de files
		 *
		 *
		 * @param
		 *
		 * return void
		 */

        $app->post('/api/upload', function () use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            $opts = array(
                'media_dir' => $app->config('media_dir'),
                'tamanhos' => array(
                    'tn' => '75',
                    'p' => '222',
                    'm' => '726',
                ),
                'types' => $app->config('extensions'),
            );
            $upload = new Upload($app->db, $app->session, $opts);
            $upload->exec();
        })->name('api_upload');

        /*
		 *
		 * apaga file(s)
		 *
		 *
		 * return void
		 */

        $app->get('/api/file/:id/delete', function ($id) use ($app) {

            if (!$app->porteiro->loggedIn()) {
                $app->redirect($app->urlFor('admin_login'));
            }

            // resolve parametros
            $model = new File($app->db);
            $fileMorto = $model->delete($id);
            $filesMortos = array();
            $filesMortos[] = $fileMorto['name'] . '.' . $fileMorto['extension'];

            // se é imagem, inclui as tns na list
            if (in_array($fileMorto['extension'], array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF'))) {
                $filesMortos[] = $fileMorto['name'] . '_tn.' . $fileMorto['extension'];
                $filesMortos[] = $fileMorto['name'] . '_m.' . $fileMorto['extension'];
                $filesMortos[] = $fileMorto['name'] . '_p.' . $fileMorto['extension'];
            }
            foreach ($filesMortos as $am) {
                if (is_writable($app->config('media_dir') . $am)) {
                    unlink($app->config('media_dir') . $am);
                    $_SESSION['message'] = 'files apagados';

                } else {
                    $_SESSION['message'] = 'nao foi possivel delete os files do servidor';
                }
            }

            // registra operaction no log
            $app->activity->write(
                $app->session->get('user.username'),
                $app->session->get('user.id'),
                'apagou',
                'files',
                $id
            );

            $app->flash('message', 'registro apagado');
            $app->request->isAjax() ? $app->redirect($app->urlFor('admin_model_index', array('model' => 'file'))) : false;
        })->name('api_file_delete')->conditions(array('id' => '\d+'));

        return $app;
    }
}
