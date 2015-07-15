<?php

namespace Maltz\Sys\Ctrl;

/**
 * Ações da administraction do sistema
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

class Authentication extends Controller
{

    public function route($app)
    {

        $app->get('/login', function() use ($app) {

        	$app->render('login.tpl.php');

        })->name('user_login_form');

        $app->post('/login', function() use ($app) {

        	$credentials = $app->request->post();
        	$authenticated = $app->doorman->login($credentials['username'], $credentials['password'], $credentials['remember']);
        	if ($authenticated) {
        		$app->redirect('admin_panel');
        	} else {
        		$app->redirect('user_login_form');
        	}

        })->name('user_login');

        $app->get('/signup', function() use ($app) {

        	$app->render('signup.tpl.php');

        })->name('user_signup_form');

        $app->post('/signup', function() use ($app) {

        	$record = new Record($app->request->post());
            $result = User::query($app->db, 'signUp', $record);

        })->name('user_signup_form');

        $app->get('/signup/confirm/:user_id/:token', function($user_id, $token) use ($app) {

            $result = User::query($app->db, 'validate', $token, 'activation');
            if ((int) $result->getFirstRecord()->get('id') === (int) $user_id) {
            	$app->redirect('user_login');
            }
            $app->errorForbidden();

        })->name('confirm_signup')->conditions('user_id' => '\d+', 'token' => '\w+');

        $app->get('/password/forgot', function() use ($app) {

        	$app->render('password.forgot.tpl.php');

        })->name('forgot_password')->conditions();

        $app->get('/password/new/:user_id/:token', function($user_id, $token) use ($app) {

            $result = User::query($app->db, 'validate', $token, 'forgot');
        	$app->render('password.new.tpl.php');

        })->name('new_password')->conditions('user_id' => '\d+', 'token' => '\w+');

        return $app;
    }
}
