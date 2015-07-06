<?php

namespace Maltz\Content\Model;

use Maltz\Media\Model\DocumentAdapter;
use Maltz\Media\Model\MediaAdapter;
use Maltz\Mvc\Model;
use Maltz\Utils\Pagination;

/**
 * db de conteúdo dinamico com
 *  - album
 *  - pdf
 *  - categoria/type
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

class Content extends Model
{
    /*
	 * construtor
	 *
	 *
	 * @param objeto DB
	 *
	 * return void
	 */

    public function __construct($db)
    {
        parent::__construct($db, 'content', 'contents', 'content_id');
    }

    public function getMetaData()
    {
        $sql = "SELECT * FROM contents t1
            INNER JOIN content_attributes t2
            ON t1.id=t2.content_id
            WHERE type_id=:type_id;";
    }

    public function getMetaData()
    {
        $sql = "SELECT * FROM files t1
            JOIN files_collections t2
            ON t1.id=t2.item_id
            JOIN collections t3
            ON t2.collection_id=t3.id
            ORDER BY t2.order ASC, t1.created ASC";
    }

    public function getFilesByType($type_id)
    {
       $sql = "SELECT * FROM files
            WHERE type_id=:type_id;
        ";        
    }

    /*
     *
     * atualiza album do component
     *
     * @param $c_id int
     * @param $album_id int
     *
     * return array
     */
    public function setAlbum($c_id, $album_id)
    {
        if (!intval($album_id) || !intval($c_id)) {
            throw new \Exception("Error Processing Request", 102);
        }

        $sql = "UPDATE $this->table SET album_id=:g_id WHERE $this->fk=:p_id";
        $bind = array('p_id' => $c_id, 'g_id' => $album_id);
        $r = $this->db->run($sql, $bind);
        return $r;
    }

    /*
     *
     * apaga capa do component
     *
     * @param $c_id
     * @param $photo_id
     *
     * return void
     */
    public function deleteAlbum($c_id)
    {
        if (!intval($c_id)) {
            throw new \Exception("Error Processing Request", 104);
        }

        $sql = "UPDATE " . $this->table . " SET album_id=0";
        $r = $this->db->run($sql);
        return $r;
    }
    /*
     *
     * atualiza capa do component
     *
     * @param $c_id
     * @param $photo_id
     *
     * return void
     */
    public function setCover($c_id, $photo_id)
    {
        if (!intval($photo_id) || !intval($c_id)) {
            throw new \Exception("Error Processing Request", 103);
        }

        $sql = "UPDATE " . $this->table . " SET cover_id=:g_id WHERE " . $this->fk . "=:p_id";
        $bind = array('p_id' => $c_id, 'g_id' => $photo_id);
        $r = $this->db->run($sql, $bind);
        return $r;
    }

    /*
     *
     * apaga capa do component
     *
     * @param $c_id
     * @param $photo_id
     *
     * return void
     */
    public function deleteCover($c_id)
    {
        if (!intval($c_id)) {
            throw new \Exception("Error Processing Request", 104);
        }

        $sql = "UPDATE " . $this->table . " SET cover_id=0";
        $r = $this->db->run($sql);
        return $r;
    }
    /*
     *
     * list x photos
     *
     * @param $num int
     *
     * return void
     */

    public function indexPhotos($num = 100)
    {
        if (!intval($num)) {
            throw new \Exception("Error Processing Request", 105);
        }

        $sql = "SELECT * FROM files WHERE extension NOT IN (\"pdf\", \"doc\", \"docx\", \"xls\", \"xlsx\", \"ppt\", \"pps\") LIMIT " . $num;
        $imgs = $this->db->run($sql);
        return $imgs;
    }

    /*
     *
     * mostra capa do component
     *
     * @param $id int
     *
     * return void
     */

    public function getCover($id)
    {
        if (!intval($id)) {
            throw new \Exception("Error Processing Request", 106);
        }

        $data = $this->db->select('files', 'id=' . $id);
        return (isset($data[0])) ? $data[0] : $data;
    }

    /*
     *
     * mostra photos da album
     *
     * @param $id int id da album
     *
     * return void
     */

    public function getAlbumPhotos($id)
    {
        if (!intval($id)) {
            throw new \Exception("Error Processing Request", 107);
        }

        $sql = "SELECT a.id, a.title, a.name, a.extension, fg.order FROM files a INNER JOIN photos_albums fg ON a.id = fg.file_id INNER JOIN albums g ON fg.album_id = g.id where g.id = " . $id;
        $r = $this->db->run($sql);
        if ($r) {
            $ordenada = $this->sort($r, 'order');
            return $ordenada;
        }
    }

    /*
     * chama todas as albums
     * para serem listdas no gerenciador de media
     *
     * @param $num int
     *
     * return array
     */

    public function indexAlbums($num = 100)
    {
        if (!intval($num)) {
            throw new \Exception("Error Processing Request", 108);
        }

        $sql = "SELECT * FROM albums LIMIT " . $num;
        $data = $this->db->run($sql);

        $resultados = array();
        foreach ($data as $album) {
            $album['photos'] = $this->photosAlbum($album['id']);
            $resultados[] = $album;
        }
        return $resultados;
    }


    /*
     * list x documentos
     *
     * @param num int
     *
     * return array
     *
     */
    public function indexDocuments($num)
    {
        if (!intval($num)) {
            throw new \Exception("Error Processing Request", 109);
        }

        $sql = "SELECT * FROM files WHERE extension IN (\"pdf\", \"doc\", \"docx\", \"xls\", \"xlsx\", \"ppt\", \"pps\") LIMIT " . $num;
        $docs = $this->db->run($sql);
        return $docs;
    }

    /*
     * atualiza documento do component
     *
     * @param $id int
     * @param $c_id int
     *
     * return array
     *
     */
    public function updateDocument($c_id, $id)
    {
        if (!intval($c_id) || !intval($id)) {
            throw new \Exception("Error Processing Request", 110);
        }
        
        $sql = "INSERT INTO " . $this->table . " (doc_id) values (" . $id . ") WHERE " . $this->fk . "=" . $c_id . ";";
        $doc = $this->db->run($sql);
        return $doc;
    }

    /*
     * mostra documento
     *
     * @param id int
     *
     *
     * return array
     *
     */

    public function getDocument($id)
    {
        if (!intval($id)) {
            throw new \Exception("Error Processing Request", 111);
        }

        $sql = "SELECT * FROM files WHERE id=:id";
        $doc = $this->db->run($sql, array('id' => $id));
        return $doc;
    }

    /*
	 *
	 * list contents no admin
	 *
	 *
	 * return void
	 */

    public function indexAdmin($perpage = 12, $page = 1, $where = "", $order = array('datepub', 'DESC'), $activity = false)
    {
        if (!intval($perpage) || !intval($page)) {
            throw new \Exception("Error Processing Request", 112);
        }

        $registros = $this->count();
        $pagination = Pagination::pager($registros, $perpage, $page);
        $data = $this->db->select(
            $this->table,
            $where,
            array($pagination->offset, $pagination->limit),
            $order,
            '',
            '*',
            $activity
        );

        if (!$data) {
            return false;
        }

        $resultados = array();
        foreach ($data as $item) {
            if (!empty($item['photo_id'])) {
                $item['content.photo'] = $this->photoCtrl($item['photo_id']);
            }

            if (!empty($item['folder_id'])) {
                $photos = $this->photosAlbum($item['album_id']);
                $item['content.album'] = $photos;
            }

            if (!empty($item['album_id'])) {
                $photos = $this->photosAlbum($item['album_id']);
                $item['content.album'] = $photos;
            }

            if (!empty($item['cover_id'])) {
                $item['content.cover'] = $this->cover($item['cover_id']);
            }

            if (!empty($item['document_id'])) {
                $item['content.document'] = $this->document($item['document_id']);
            }

            $resultados[] = $item;
        }

        $this->set('data.list', $resultados);
        $this->set('pagination.pages', $pagination->num_pages);
        return true;
    }

    /*
	 *
	 * list contents
	 *
	 *
	 * return void
	 */

    public function index($perpage = 12, $page = 1, $where = "", $order = array('datepub', 'DESC'), $activity = false)
    {
        if (!intval($perpage) || !intval($page)) {
            throw new \Exception("Error Processing Request", 113);
        }

        $registros = $this->count();
        $pagination = Pagination::pager($registros, $perpage, $page);
        $data = $this->db->select(
            $this->table,
            $where,
            array($pagination->offset, $pagination->limit),
            $order,
            '',
            '*',
            $activity
        );

        if (!$data) {
            return false;
        }

        $resultados = array();
        foreach ($data as $item) {
            if (!empty($item['photo_id'])) {
                $item['photo.content'] = $this->media->photoCtrl($item['photo_id']);
            }
            if (!empty($data['album_id'])) {
                $photos = $this->media->photosAlbum($item['album_id']);
                $item['content.album'] = $photos;
            }
            if (!empty($item['cover_id'])) {
                $item['content.cover'] = $this->cover($item['cover_id']);
            }
            $resultados[] = $item;
        }
        $this->set('data.list', $resultados);
        $this->set('pagination.pages', $pagination->num_pages);

        return true;
    }

    /*
	 *
	 * mostra content
	 *
	 *
	 *
	 * return void
	 */

    public function show($id, $activity = false)
    {
        if (!intval($id)) {
            throw new \Exception("Error Processing Request", 114);
        }

        $data = $this->db->select(
            $this->table, // table
            "id=" . $id, // where
            null, // limite
            null, // order
            '', // bind
            '*', // fields
            $activity // activity
        );

        if (!$data) {
            return false;
        }

        $data = $data[0];
        if (!empty($data['photo_id'])) {
            // se tem photo adiciona aos resultados
            $data['photo.content'] = $this->media->photoCtrl(intval($data['photo_id']));
        }
        if (!empty($data['album_id'])) {
            // se tem album adiciona aos resultados
            $data['content.album'] = $this->photosAlbum(intval($data['album_id']));
        }
        if (!empty($data['cover_id'])) {
            // se tem cover adiciona aos resultados
            $data['content.cover'] = $this->cover($data['cover_id']);
        }
        if (!empty($data['document_id'])) {
            // se tem adiciona aos resultados
            $data['content.document'] = $this->document($data['document_id']);
        }

        $this->set('data.record', $data);
        return true;
    }

    /*
	 *
	 *
	 *
	 *
	 *
	 * return void
	 */

    public function showAdmin($id, $activity = false)
    {
        if (!intval($id)) {
            throw new \Exception("Error Processing Request", 115);
        }

        $data = $this->db->select(
            $this->table,
            "id=" . $id,
            null,
            null,
            '',
            '*',
            $activity
        );

        if (!$data) {
            return false;
        }

        $data = $data[0];
        if (!empty($data['datepub'])) {
            // se tem adiciona aos resultados
            $data['datepub'] = DateAdapter::converterMostrar($data['datepub']);
        }

        if (!empty($data['photo_id'])) {
            // se tem adiciona aos resultados
            $data['content.photo'] = $this->media->photoCtrl(intval($data['photo_id']));
        }
        if (!empty($data['album_id'])) {
            // se tem adiciona aos resultados
            $data['content.album'] = $this->photosAlbum(intval($data['album_id']));
        }
        if (!empty($data['cover_id'])) {
            // se tem adiciona aos resultados
            $data['content.cover'] = $this->cover($data['cover_id']);
        }

        if (!empty($data['document_id'])) {
            // se tem adiciona aos resultados
            $data['content.document'] = $this->document($data['document_id']);
        }

        // isso aqui tem de sair da key data.content.content e ir para o nivel superior
        $data['documents'] = $this->listDocuments(100);

        $this->set('photos', $this->photos());
        $this->set('albums', $this->albums());

        $this->set('data.record', $data);

        return true;
    }

    /*
	 * modifica content
	 *
	 * @param $data array
	 * @param $id int
	 *
	 *
	 */

    public function update($data, $id)
    {
        if (!intval($id)) {
            throw new \Exception("Error Processing Request", 116);
        }

        if (!empty($data['datepub'])) {
            $data['datepub'] = DateAdapter::converterSalvar($data['datepub']);
        }
        return parent::update($data, $id);
    }
}
