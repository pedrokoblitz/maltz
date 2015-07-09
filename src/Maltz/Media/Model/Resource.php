<?php

namespace Maltz\Media\Model;

use Maltz\Mvc\Model;

/**
 * db de files pertencentes a albums
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

/*
 *
 *
 *
 * @param objeto DB
 *
 * return void
 */

class Resource extends Model
{
    /*
	 * construtor
	 *
	 * @param db objeto DB
	 *
	 *
	 */
    public function __construct($db)
    {
        parent::__construct($db, 'resource', 'resources', 'resource_id');
    }

    /*
	 *
	 * apaga um registro no banco
	 * guarda resultado na var $data
	 *
	 * @param id int
	 *
	 * return void
	 */
    public function delete($id)
    {
        $file = $this->db->select($this->table, "id=" . $id);
        $this->db->delete($this->table, "id=" . $id);
        $this->db->delete('photos_albums', "id=" . $id);
        return $file[0];

    }

    /*
	 * inserer file E adiciona em album
	 *
	 * @param $post - data da file
	 * @param $album_id - identifier da album
	 *
	 * return bool
	 *
	 */
    public function insertAlbumPhotos($post, $album_id)
    {
        $this->insert($post);
        $file_id = $this->all();
        return $this->db->insert('photos_albums', array('file_id' => $file_id['content'], 'album_id' => $album_id));
    }

    /*
	 * associa file a uma album
	 *
	 * @param $file_id int
	 * @param $album_id int
	 *
	 * return bool
	 *
	 */
    public function assocPhotoAlbum($file_id, $album_id)
    {
        if (!$this->db->select('photos_albums', "photo_id=$file_id AND album_id=$album_id")) {
            return $this->db->insert('photos_albums', array('photo_id' => $file_id, 'album_id' => $album_id));
        }
    }

    /*
	 * retira file da album
	 *
	 * @param $file_id int
	 * @param $album_id int
	 *
	 * return bool
	 *
	 */
    public function deletePhotoAlbum($file_id, $album_id)
    {
        return $this->db->delete('photos_albums', "photo_id=$file_id AND album_id=$album_id");
    }

    /*
	 * search files pelo name
	 *
	 * @param $name string
	 *
	 * return array
	 *
	 */
    public function indexByName($name)
    {
        $sql = "SELECT * FROM files WHERE name=:name;";
        $this->set('data.list', $this->db->run($sql, array('name' => $name)));
    }

    /*
	 * search files pela extension
	 *
	 * @param $ext string
	 *
	 * return array
	 *
	 */
    public function indexByExtension($ext)
    {
        $sql = "SELECT * FROM files WHERE extension=:ext;";
        $this->set('data.list', $this->db->run($sql, array('ext' => $ext)));
    }
}
