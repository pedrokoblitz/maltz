<?php

namespace Maltz\Sys\Model;

use Maltz\Mvc\Model;

/**
 * db de user com password para autenticação
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

class User extends Model
{
    /*
	 *
	 * construtor
	 *
	 * @param $db DB
	 *
	 * return void
	 *
	 */

    public function __construct($db)
    {
        parent::__construct($db, 'user', 'users', 'user_id');
    }

    /*
	 *
	 * insere new user
	 *
	 * @param $post array
	 *
	 * return void
	 */

    public function insert($post)
    {
        if (isset($post['password']) && $post['password'] == '') {
            unset($post['password']);
        } elseif (isset($post['password']) && $post['password'] != '') {
            $post['password'] = md5($post['password']);
        }
        $data = $this->db->insert($this->table, $post);
        $this->set('meta.insert', $data);
    }

    /*
	 *
	 * modifica user
	 *
	 * @param $post array
	 * @param $id int
	 *
	 * return void
	 */

    public function update($post, $id)
    {
        if (isset($post['password']) && $post['password'] == '') {
            // se o campo da password esta vazio, nao update
            unset($post['password']);
        } elseif (isset($post['password']) && $post['password'] != '') {
            // se nao esta vazio, criptografar password
            $post['password'] = md5($post['password']);
        }
        
        $data = $this->db->update($this->table, $post, "user_id=" . $id);
        $this->set('meta.update', $data);
    }

    public function signUp($post)
    {
        $post['password'] = md5($post['password']);
        $id = $this->db->insert($this->table, $post);
        $this->set('meta.insert', $id);
        $data = $token->generate($id, 'activation');
        $this->set('data.token', $data);
        return $data;
    }

    public function remember($user_id)
    {
        $token = new Token($this->db);
        $data = $token->generate($user_id, 'remember');
        $this->set('data.token.remember', $data);
        return $data;
    }

    public function forgot($user_id)
    {
        $token = new Token($this->db);
        $data = $token->generate($user_id, 'forgot');
        $this->set('data.token.forgot', $data);
        return $data;
    }

    public function validate($user_token, $type)
    {
        $token = new Token($this->db);
        $data = $token->validate($user_token, $type);
        $this->set('data.token.validation', $data);
        return $data;
    }

    /*
	 *
	 * modifica permissao de user
	 *
	 * @param $id int
	 * @param $type int
	 *
	 * return void
	 *
	 */
    public function updateLevel($id, $type)
    {
//        $sql = "UPDATE SET type=:type WHERE user_id=$id";
        $data = $this->db->update($this->table, array('type' => $type), "user_id=" . $id);
        $this->set('meta.update', $data);
    }
}
