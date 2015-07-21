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
 * @copyright Copyright (c) 2012-2013 Pedro Koblitz
 * @author    Pedro Koblitz pedrokoblitz@gmail.com
 * @license   GPL v2
 *
 * @package Maltz
 *
 * @version 0.1 alpha
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
    public function __construct(DB $db)
    {
        $rules = array(
            'id' => 'int',
            'username' => 'username',
            'email' => 'email',
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

    public function display($key = 'username', $order = 'asc')
    {
        if (!is_string($key) || !is_string($order)) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $sql = "SELECT id, username, email, password, activity, created
            FROM users ORDER BY $key $order";
        $result = $this->db->run($sql);
        return $result;
    }

    public function find($page = 1, $per_page = 12, $key = 'username', $order = 'asc')
    {
        if (!(int) $page || !(int) $per_page || !is_string($key) || !is_string($order)) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $pagination = Pagination::paginate($page, $per_page);
        $sql = "SELECT id, username, email, password, activity, created
            FROM users ORDER BY $key $order LIMIT $pagination->offset,$pagination->limit";
        $result = $this->db->run($sql);
        return $result;
    }

    public function findByUsernameOrEmail($user)
    {
        if (!is_string($user)) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $sql = "SELECT id, username, email, password, activity, created
            FROM users WHERE username=:user OR email=:user";
        $result = $this->db->run($sql, array('user' => $user));
        return $result;
    }

    public function show($id)
    {
        if (!(int) $id) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $sql = "SELECT id, username, email, password, activity, created
            FROM users 
            WHERE id=:id";
        $result = $this->db->run($sql);
        return $result;
    }

    public function insert(Record $record)
    {
        $fields = $record->getFieldsList();
        $values = $record->getInsertValueString();
        $sql = "INSERT INTO users $fields, created, modified
            VALUES $values, NOW(), NOW()";
        $result = $this->db->run($sql, $record->toArray());
        return $result;
    }

    public function update(Record $record)
    {
        $id = $record->get('id');
        $record->remove('id');
        $values = $record->getUpdateValueString();
        $sql = "UPDATE users 
            SET $values, modified=NOW() WHERE id=:id";
        $record->set('id', $id);
        $result = $this->db->run($sql, $record->toArray());
        return $result;
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
        $result = $this->db->run($sql, array('id' => $user_id));
        return $result;
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
        $result = $this->db->run($sql, array('user_id' => $this->parseUser($user), 'role_id' => $this->parseRole($role)));
        return $result;
    }

    public function removeRole($user, $role)
    {
        $sql = "DELETE FROM users_roles WHERE user_id=:user_id AND role_id=:role_id";
        $result = $this->db->run($sql, array('user_id' => $this->parseUser($user), 'role_id' => $this->parseRole($role)));
        return $result;
    }

    /*
     * REGISTRATION
     */

    public function signUp(Record $record)
    {
        $res = $this->insert($record);
        $id = $res->get('last.insert.id');
        $result = Token::query($this->db, 'generate', $id, 'activation');
        return $result;
    }

    public function remember($user_id)
    {
        if (!(int) $user_id) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $data = Token::query($this->db, 'generate', $user_id, 'remember');
        return $data;
    }

    public function forgot($user_id)
    {
        if (!(int) $user_id) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $data = Token::query($this->db, 'generate', $user_id, 'forgot');
        return $data;
    }

    public function validate($user_token, $type)
    {
        if (!is_string($user_token) || !is_string($type)) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $data = Token::query($this->db, 'validate', $user_token, $type);
        return $data;
    }
}
