<?php

namespace Maltz\Package\Api\Ctrl;

class FrontEnd
{
	public function route($app)
	{
		$app->get('/admin/:appliance', function ($appliance) use ($app) {

	        $app->response->headers->set('Content-Type', 'text/html');
			$info = array(
				'' => '',
				);

			$app->handler->setViewInfo($info);
			$body = $app->handler->render($appliance);
 			$app->response->setBody($body);
 			$app->stop();
		});
	}
}