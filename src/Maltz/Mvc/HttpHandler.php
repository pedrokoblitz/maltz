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

	public function serveView(Result $data)
	{
        $body = $app->view->render($data->toArray);
        $app->response->headers->set('Content-Type', 'text/html');
        $app->response->setStatus(200);
        $app->response->setBody($body);
        $app->stop();
	}

	public function serveJson(Result $data)
	{
        $app->response->headers->set('Content-Type', 'application/json');
        $app->response->setStatus(200);
        $app->response->setBody($data->toJson);
        $app->stop();
	}
}