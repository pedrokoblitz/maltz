<?php

namespace Maltz\Package\Sys\Model;

use Maltz\Mvc\DB;
use Maltz\Mvc\Model;
use Maltz\Mvc\Record;
use Maltz\Mvc\ModelFeature\Activity;
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

    /**
     * /
     * @param  Record $record [description]
     * @return [type]         [description]
     */
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
    /**
     * /
     * @param  string $key   [description]
     * @param  string $order [description]
     * @return [type]        [description]
     */
    public function display($key = 'username', $order = 'asc')
    {
        if (!is_string($key) || !is_string($order)) {
            throw new \Exception("Key and order must be strings.", 001);
        }
        
        $sql = "SELECT id, username, email, password, activity, created
            FROM users ORDER BY $key $order";
        $result = $this->db->run($sql);
        return $result;
    }

    /**
     * /
     * @param  integer $page     [description]
     * @param  integer $per_page [description]
     * @param  string  $key      [description]
     * @param  string  $order    [description]
     * @return [type]            [description]
     */
    public function find($page = 1, $per_page = 12, $key = 'username', $order = 'asc')
    {
        if (!is_int($page) || !is_int($per_page) || !is_string($key) || !is_string($order)) {
            throw new \Exception("Page and per_page must be integers, key and order must be strings.", 002);
        }
        
        $pagination = Pagination::paginate($page, $per_page);
        $sql = "SELECT id, username, email, password, activity, created
            FROM users ORDER BY $key $order LIMIT $pagination->offset,$pagination->limit";
        $result = $this->db->run($sql);
        return $result;
    }

    /**
     * /
     * @param  [type] $user [description]
     * @return [type]       [description]
     */
    public function findByUsernameOrEmail($user)
    {
        if (!is_string($user)) {
            throw new \Exception("Username or email must be string.", 003);
        }
        
        $sql = "SELECT id, username, email, password, activity, created
            FROM users WHERE username=:user OR email=:user";
        $result = $this->db->run($sql, array('user' => $user));
        return $result;
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show($id)
    {
        if (!is_int($id) ) {
            throw new \Exception("Id must be integer.", 004);
        }
        
        $sql = "SELECT id, username, email, password, activity, created
            FROM users 
            WHERE id=:id";
        $result = $this->db->run($sql);
        return $result;
    }

    /**
     * /
     * @param  Record $record [description]
     * @return [type]         [description]
     */
    public function insert(Record $record)
    {
        $fields = $record->getFieldsList();
        $values = $record->getInsertValueString();
        $sql = "INSERT INTO users $fields, created, modified
            VALUES $values, NOW(), NOW()";
        $result = $this->db->run($sql, $record->toArray());
        return $result;
    }

    /**
     * /
     * @param  Record $record [description]
     * @return [type]         [description]
     */
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
    
    /**
     * /
     * @param  [type] $user [description]
     * @return [type]       [description]
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

    /**
     * /
     * @param  [type] $user [description]
     * @return [type]       [description]
     */
    protected function parseUser($user)
    {
        if (is_string($user)) {
            $sql = "SELECT id FROM users 
                WHERE username=:user 
                OR email=:user";
            $res = $this->db->run($sql, array('user' => $user));
            $user_id = $res->getFirstRecord()->get('id');
        } elseif (is_int($user)) {
            $user_id = $user;
        }
        return $user_id;
    }

    /**
     * /
     * @param  [type] $role [description]
     * @return [type]       [description]
     */
    protected function parseRole($role)
    {
        if (is_string($role)) {
            $sql = "SELECT id FROM roles 
                WHERE name=:name";
            $res = $this->db->run($sql, array('name' => $role));
            $role_id = $res->getFirstRecord()->get('id');
        } elseif (is_int($role)) {
            $role_id = $role;
        }
        return $role_id;
    }

    /**
     * /
     * @param [type] $user [description]
     * @param [type] $role [description]
     */
    public function addRole($user, $role)
    {
        $sql = "INSERT INTO users_roles (user_id, role_id) 
            VALUES (:user_id,role_id=:role_id)";
        $result = $this->db->run($sql, array('user_id' => $this->parseUser($user), 'role_id' => $this->parseRole($role)));
        return $result;
    }

    /**
     * /
     * @param  [type] $user [description]
     * @param  [type] $role [description]
     * @return [type]       [description]
     */
    public function removeRole($user, $role)
    {
        $sql = "DELETE FROM users_roles 
            WHERE user_id=:user_id 
            AND role_id=:role_id";
        $result = $this->db->run($sql, array('user_id' => $this->parseUser($user), 'role_id' => $this->parseRole($role)));
        return $result;
    }

    /*
     * REGISTRATION
     */

    /**
     * /
     * @param  Record $record [description]
     * @return [type]         [description]
     */
    public function signUp(Record $record)
    {
        $res = $this->insert($record);
        $id = $res->getLastInsertId();
        $token = Token::query($this->db, 'generate', $id, 'activation');
        return $token;
    }

    /**
     * /
     * @param  [type] $user_id [description]
     * @return [type]          [description]
     */
    public function remember($user_id)
    {
        if (!is_int($user_id)) {
            throw new \Exception("User_id must be integer.", 005);
        }
        
        $token = Token::query($this->db, 'generate', $user_id, 'remember');
        return $token;
    }

    /**
     * /
     * @param  [type] $user_id [description]
     * @return [type]          [description]
     */
    public function forgot($user_id)
    {
        if (!is_int($user_id)) {
            throw new \Exception("User_id must be integer.", 006);
        }
        
        $token = Token::query($this->db, 'generate', $user_id, 'forgot');
        return $token;
    }

    /**
     * /
     * @param  [type] $user_token [description]
     * @param  [type] $type       [description]
     * @return [type]             [description]
     */
    public function validate($user_token, $type)
    {
        if (!is_string($user_token) || !is_string($type)) {
            throw new \Exception("Token and type must be strings", 007);
        }
        
        $token = Token::query($this->db, 'validate', $user_token, $type);
        if ($token === $user_token) {
            $sql = "UPDATE tokens SET used=NOW() 
                WHERE type=:type 
                AND token=:token";
            $this->db->run($sql, array('type' => $type, 'token' => $token));
            $sql = "SELECT id, username, email, password, activity, created 
                FROM users 
                WHERE id=:id";
            $user = $this->db->run($sql, array('id' => $record->get('user_id')));
            return $user->getFirstRecord();
        }
        return false;
    }
}
