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

    public function list($offset, $limit) {
        $sql = "";
        $result = $this->db->run($sql);
    }

    public function show($id) {
        $sql = "";
        $result = $this->db->run($sql);
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
        $result = $this->db->insert($this->table, $post);
        return $result;
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
        
        $result = $this->db->update($this->table, $post, "user_id=" . $id);
        return $result;
    }

    public function signUp($post)
    {
        $post['password'] = md5($post['password']);
        $id = $this->db->insert($this->table, $post);
        $result = $token->generate($id, 'activation');
        return $result;
    }

    public function remember($user_id)
    {
        $token = new Token($this->db);
        $data = $token->generate($user_id, 'remember');
        return $data;
    }

    public function forgot($user_id)
    {
        $token = new Token($this->db);
        $data = $token->generate($user_id, 'forgot');
        return $data;
    }

    public function validate($user_token, $type)
    {
        $token = new Token($this->db);
        $data = $token->validate($user_token, $type);
        return $data;
    }
}
