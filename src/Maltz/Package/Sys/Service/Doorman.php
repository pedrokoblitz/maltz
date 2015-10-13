<?php

namespace Maltz\Sys\Service;

use Maltz\Mvc\Record;
use Maltz\Package\Sys\Model\User;

/**
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

class Doorman
{
    protected $user;
    protected $session;
    protected $cookieJar;

    public function __construct($db, $sessionDataStore, $cookieJar)
    {
        $this->user = new User($db);
        $this->sessionDataStore = $sessionDataStore;
        $this->cookieJar = $cookieJar;
    }

    public function remember($user_id)
    {
        if (!is_int($user_id)) {
            throw new \Exception("User_id must be integer", 001);
        }

        $cookie['value'] = $this->user->remember($user_id);
        $cookie['path'] = '/';
        $cookie['expires'] = time() + (3600 * 24);
        $this->cookieJar->set('token.remember', $cookie);
    }

    /*
    * realiza autenticaction
    *
    *
    * @param $username string
    * @param $password string
    *
    * return string / void
    */
    public function login(Record $credentials)
    {
        $login = $this->user->findByUsernameOrEmail($credentials->get('username'));
        $record = $login->getFirstRecord();
    
        if ($record->get('password') === sha1($credentials->get('password'))) {
            $this->sessionDataStore->setUserData($data);
            if ($credentials->get('remember')) {
                $this->remember($record->get('id'));
            }
            return true;
        }
        return false;
    }

    /*
    * encerra sessao
    *
    *
    * @param
    *
    * return void
    */
    public function logout()
    {
        $this->sessionDataStore->destroy();
        if ($this->cookieJar->has('token.remember')) {
            $this->cookieJar->remove('token.remember');
        }
    }

    /*
    *
    * checa se user esta autenticado
    *
    * @param
    *
    * return bool
    */
    public function isUserAuthenticated()
    {
        $authenticated = false;
        $cookie = $this->cookieJar->has('token.remember');
        if (!$cookie && $this->sessionDataStore->isUserAuthenticated()) {
            $authenticated = true;
        } elseif ($cookie) {
            $tokenCookie = $this->cookieJar->get('token.remember');
            $cookieValue = $tokenCookie->get();
            $token = $cookieValue['value'];
            $data = $this->user->validate($token, 'remember');
            $this->sessionDataStore->setUserData($data);
            $authenticated = true;
        }
        return $authenticated;
    }

    /*
     *
     * checa permissao
     *
     * @param
     *
     * return bool
     */
    public function isUserAllowed(array $roles)
    {
        if ($this->isUserAuthenticated()) {
            $userRoles = $this->getRoles($this->sessionDataStore->getUserId);
            foreach ($roles as $role) {
                if (in_array($role, $userRoles)) {
                    return true;
                }
            }
        }
        return false;
    }

    /*
     * checa credentials
     *
     * @param
     *
     * return int
     */
    private function getRoles()
    {
        $userId = $this->sessionDataStore->getUserId();
        $roles = $this->user->getRoles($userId);
        return $roles;
    }
}
