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
        $sql = "SELECT id, username, name, email, cpf, cnpj, cellphone, phone, zipcode, address, address2, district, city, province, password, activity, created
            FROM users";
        $resultado = $this->db->run($sql);
    }

    public function show($id) {
        $sql = "SELECT id, username, name, email, cpf, cnpj, cellphone, phone, zipcode, address, address2, district, city, province, password, activity, created
            FROM users 
            WHERE id=$id";
        $resultado = $this->db->run($sql);
    }

    /*
	 *
	 * insere new user
	 *
	 * @param $post array
	 *
	 * return void
	 */
    public function insert(Record $post)
    {
        $password = $record->get('password');
        if (!empty($password)) {
            $record->set('password', sha1($password));
        } else {
            $record->remove('password');
        }
        $fields = $record->getFieldsList();
        $values = $record->getInsertValueString();
        $bind = $record->values();
        $sql = "INSERT INTO users $fields 
            VALUES $values";
        $resultado = $this->db->run($sql, $bind);
        return $resultado;
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
    public function update(Record $post, $id)
    {
        $password = $record->get('password');
        if (!empty($password)) {
            $record->set('password', sha1($password));
        } else {
            $record->remove('password');
        }

        $updateValues = $record->getUpdateValueString();
        $bind = $record->values();
        $sql = "UPDATE users 
            SET $updateValues";
        $resultado = $this->db->run($sql, $bind);
        return $resultado;
    }

    public function signUp(Record $record)
    {
        $res = $this->insert($record);
        $id = $res->get('last_insert_id');
        $resultado = $token->generate($id, 'activation');
        return $resultado;
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
