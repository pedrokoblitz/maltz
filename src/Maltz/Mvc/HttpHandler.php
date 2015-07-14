<?php 

namespace Maltz\Mvc;

class HttpHandler
{
	public function __construct($app)
	{
		$this->app = $app;
	}

	public function authorized($user, array $roles)
	{
		if (!$this->app->loggedIn()) {
			$this->app->redirect('user_login');
		}
	}

	public function redirect($message, $name, $params)
	{
        $app->flash('message', $message);
        $app->request->isAjax() ? $app->redirect($app->urlFor($name, $params)) : false;
	}
}