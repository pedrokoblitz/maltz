<?php

namespace Maltz\Package\Sys\Ctrl;

use Maltz\Mvc\Record;
use Maltz\Sys\User;

/**
 * Ações da administraction do sistema
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

class Authentication extends Controller
{
    /**
     * /
     * @param  [type] $app [description]
     * @return [type]      [description]
     */
    public function route($app)
    {
        $app->view->setLayout('frontend');

        $app->get('/login', function () use ($app) {

                $app->render('login');
            }
        )->name('user_login_form');

        $app->post('/login', function () use ($app) {

                $credentials = $app->handler->handlePostRequest();
                $app->doorman->login($credentials);
                if ($app->doorman->isUserAuthenticated()) {
                    $app->redirect('admin_panel');
                } else {
                    $app->redirect('user_login_form');
                }
            }
        )->name('user_login');

        $app->get('/signup', function () use ($app) {

                $app->render('signup');
            }
        )->name('user_signup_form');

        $app->post('/signup', function () use ($app) {

                $record = new Record($app->request->post());
                $token = User::query($app->db, 'signUp', $record);
                $sent = $app->handler->sendSignUpConfirmation($record, $token);
                $app->redirect('user_login_form');
            }
        )->name('user_signup');

        $app->get('/signup/confirm/:token', function ($user_id, $token) use ($app) {

                $result = User::query($app->db, 'validate', $token, 'activation');
                if ((int) $result->isSuccessful()) {
                    $app->redirect('user_login');
                }
                $app->errorForbidden();
            }
        )->name('confirm_signup')->conditions(array('token' => '\w+'));

        $app->get('/password/forgot', function () use ($app) {

                $app->render('password.forgot');
            }
        )->name('forgot_password_form');

        $app->post('/password/forgot', function () use ($app) {
                $record = new Record($app->request->post());
                $token = User::query($app->db, 'forgot', $record->get('user_id'));
                $sent = $app->handler->sendPasswordReset($record, $token);
                $app->redirect('user_login_form');
            }
        )->name('forgot_password');

        $app->get('/password/new/:token', function ($token) use ($app) {

                $result = User::query($app->db, 'validate', $token, 'forgot');
                if ($result->isSuccessful()) {
                    $app->render('password.new');
                    $app->stop();
                } else {
                    $app->handler->errorForbidden();
                }
            }
        )->name('new_password_form')->conditions(array('token' => '\w+'));

        $app->post('/password/new', function () use ($app) {
                $record = new Record($app->request->post());
                $result = User::query($app->db, 'resetPassword', $record->get('new_password'));
                $app->redirect($app->urlFor('user_login_form'));
            }
        )->name('new_password');

        return $app;
    }
}
