<?php

namespace Maltz\Sys\Model;

use Maltz\Mvc\Model;
use Maltz\Mvc\Activity;

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
    use Activity;
    
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
     * CRUD
     */

    public function list($offset=0, $limit=12, $key='username', $order='asc') {
        $sql = "SELECT id, username, name, email, cpf, cnpj, cellphone, phone, zipcode, address, address2, district, city, province, password, activity, created
            FROM users ORDER BY $key $order LIMIT :offset,:limit";
        $resultado = $this->db->run($sql, array('offset' => $offset, 'limit' => $limit));
    }

    public function show($id) {
        $sql = "SELECT id, username, name, email, cpf, cnpj, cellphone, phone, zipcode, address, address2, district, city, province, password, activity, created
            FROM users 
            WHERE id=:id";
        $resultado = $this->db->run($sql);
    }

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
        $bind = $record->toArray();
        $sql = "INSERT INTO users $fields, created 
            VALUES $values, NOW()";
        $resultado = $this->db->run($sql, $bind);
        return $resultado;
    }

    public function update(Record $post, $id)
    {
        $password = $record->get('password');
        if (!empty($password)) {
            $record->set('password', sha1($password));
        } else {
            $record->remove('password');
        }

        $updateValues = $record->getUpdateValueString();
        $bind = $record->toArray();
        $sql = "UPDATE users 
            SET $updateValues, modified=NOW()";
        $resultado = $this->db->run($sql, $bind);
        return $resultado;
    }

    /*
     * USER REGISTRATION
     */

    public function signUp(Record $record)
    {
        $res = $this->insert($record);
        $id = $res->get('last_insert_id');
        $resultado = Token::query($this->db, 'generate', $id, 'activation');
        return $resultado;
    }

    public function remember($user_id)
    {
        $data = Token::query($this->db, 'generate', $user_id, 'remember');
        return $data;
    }

    public function forgot($user_id)
    {
        $data = Token::query($this->db, 'generate', $user_id, 'forgot');
        return $data;
    }

    public function validate($user_token, $type)
    {
        $data = Token::query($this->db, 'validate', $user_token, $type);
        return $data;
    }
}
