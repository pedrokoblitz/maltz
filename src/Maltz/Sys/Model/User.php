<?php

namespace Maltz\Sys\Model;

use Maltz\Mvc\Model;
use Maltz\Mvc\Record;
use Maltz\Mvc\Activity;
use Maltz\Service\Pagination;

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
        $rules = array(
            'id' => 'int',
            'username' => 'username',
            'email' => 'email',
            'cpf' => 'cpf',
            'cnpj' => 'cnpj',
            'cellphone' => 'cellphone',
            'phone' => 'phone',
            'zipcode' => 'cep',
            'address' => 'string',
            'address2' => 'string',
            'district' => 'string',
            'city' => 'string',
            'province' => 'string',
            'password' => 'password',
            'activity' => 'int',
            );
        parent::__construct($db, 'user', 'users', $rules);
    }

    protected function processRecord(Record $record)
    {
        $password = $record->get('password');
        if (!empty($password)) {
            $record->set('password', sha1($password));
        } else {
            $record->remove('password');
        }
        return $record;
    }

    /*
     * CRUD
     */

    public function display($key='username', $order='asc')
    {
        if () {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $sql = "SELECT id, username, name, email, cpf, cnpj, cellphone, phone, zipcode, address, address2, district, city, province, password, activity, created
            FROM users ORDER BY $key $order";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function find($page=1, $per_page=12, $key='username', $order='asc') 
    {
        if () {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $pagination = Pagination::paginate($page, $per_page);
        $sql = "SELECT id, username, name, email, cpf, cnpj, cellphone, phone, zipcode, address, address2, district, city, province, password, activity, created
            FROM users ORDER BY $key $order LIMIT $pagination->offset,$pagination->limit";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function findByUsernameOrEmail($user)
    {
        if () {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $sql = "SELECT id, username, name, email, cpf, cnpj, cellphone, phone, zipcode, address, address2, district, city, province, password, activity, created
            FROM users WHERE username=:user OR email=:user";
        $resultado = $this->db->run($sql, array('user' => $user));
        return $resultado;
    }

    public function show($id) 
    {
        if () {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $sql = "SELECT id, username, name, email, cpf, cnpj, cellphone, phone, zipcode, address, address2, district, city, province, password, activity, created
            FROM users 
            WHERE id=:id";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function insert(Record $post)
    {
        $fields = $record->getFieldsList();
        $values = $record->getInsertValueString();
        $bind = $record->toArray();
        $sql = "INSERT INTO users $fields, created, modified
            VALUES $values, NOW(), NOW()";
        $resultado = $this->db->run($sql, $bind);
        return $resultado;
    }

    public function update(Record $post, $id)
    {
        $updateValues = $record->getUpdateValueString();
        $bind = $record->toArray();
        $sql = "UPDATE users 
            SET $updateValues, modified=NOW()";
        $resultado = $this->db->run($sql, $bind);
        return $resultado;
    }

    /*
     * ROLES
     */
    public function getRoles($user)
    {
        $user_id = $this->parseUser($user);
        $sql = "SELECT t1.id, t1.name 
        FROM roles t1
            JOIN users_roles t2
            ON t1.id=t2.role_id
        WHERE t2.user_id=:id";
        $resultado = $this->db->run($sql, array('id' => $user_id));
        return $resultado;
    }

    protected function parseUser($user)
    {
        if (is_string($user)) {
            $sql = "SELECT id FROM users WHERE username=:user OR email=:user";
            $res = $this->db->run($sql, array('user' => $user));
            $user_id = $res->getFirstRecord()->get('id');
        } elseif (is_int($user)) {
            $user_id = $user;
        }
        return $user_id;
    }

    protected function parseRole($role)
    {
        if (is_string($role)) {
            $sql = "SELECT id FROM roles WHERE name=:name";
            $res = $this->db->run($sql, array('name' => $role));
            $role_id = $res->getFirstRecord()->get('id');
        } elseif (is_int($role)) {
            $role_id = $role;
        }
        return $role_id;
    }

    public function addRole($user, $role)
    {
        $sql = "INSERT INTO users_roles (user_id, role_id) VALUES (:user_id,role_id=:role_id)";
        $resultado = $this->db->run($sql, array('user_id' => $this->parseUser($user), 'role_id' => $this->parseRole($role)));
        return $resultado;
    }

    public function removeRole($user, $role)
    {
        $sql = "DELETE FROM users_roles WHERE user_id=:user_id AND role_id=:role_id";
        $resultado = $this->db->run($sql, array('user_id' => $this->parseUser($user), 'role_id' => $this->parseRole($role)));
        return $resultado;
    }

    /*
     * REGISTRATION
     */

    public function signUp(Record $record)
    {
        $res = $this->insert($record);
        $id = $res->get('last.insert.id');
        $resultado = Token::query($this->db, 'generate', $id, 'activation');
        return $resultado;
    }

    public function remember($user_id)
    {
        if () {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $data = Token::query($this->db, 'generate', $user_id, 'remember');
        return $data;
    }

    public function forgot($user_id)
    {
        if () {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $data = Token::query($this->db, 'generate', $user_id, 'forgot');
        return $data;
    }

    public function validate($user_token, $type)
    {
        if () {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $data = Token::query($this->db, 'validate', $user_token, $type);
        return $data;
    }
}
