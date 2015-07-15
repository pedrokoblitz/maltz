<?php

namespace Maltz\Service;

use Maltz\Sys\Model\User;

/**
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

class Doorman
{
    protected $user;
    protected $session;
    protected $cookieJar;

    public function __construct($db, $sessionDataStore, $cookieJar)
    {
        $this->sessionDataStore = $sessionDataStore;
        $this->cookieJar = $cookieJar;
    }

    public function remember($user_id)
    {
        if (!intval($user_id)) {
            throw new \Exception("Must be integer", 001);
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
    public function login($username, $password, $remember = null)
    {
        $this->user->search('username', $username);
        $login = $this->user->all();
        $data = $login['data.search'][0];
    
        if ($data['password'] == md5($password)) {
            $this->sessionDataStore->setUserData($data);
            if ($remember) {
                $this->remember($data['id']);
            }
            return true;
        }

        throw new \Exception("Não autorizado", 002);
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
    public function loggedIn()
    {
        $cookie = $this->cookieJar->has('token.remember');
        if (!$cookie && $this->sessionDataStore->isUserAuthenticated()) {
            return true;
        } elseif ($cookie) {
            $tokenCookie = $this->cookieJar->get('token.remember');
            $cookieValue = $tokenCookie->get();
            $token = $cookieValue['value'];
            $data = $this->user->validate($token, 'remember');
            $this->sessionDataStore->setUserData($data);
            return true;
        }
        $this->logout();
        return false;
    }

    /*
	 * checa permissao e deixa passar ou nao
	 *
	 * @param $minimo int
	 *
	 * return bool
	 */
    public function allow($roles)
    {
        if ($this->logado()) {
            $userRoles = $this->getRoles();
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
        $this->user->getRoles($userId);
        $roles = $this->user->all();
        return $roles;
    }
}
