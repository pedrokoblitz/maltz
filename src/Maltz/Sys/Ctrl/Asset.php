<?php

namespace Maltz\Sys\Ctrl;

use Maltz\Mvc\Controller;

class Asset extends Controller
{
    public function route($app)
    {
        $app->get('/asset/:name/:extension', function ($name, $extension) use ($app) {

            if (in_array($extension, array('css','js', 'gif', 'jpg', 'jpeg', 'png'))) {
                switch ($extension) {
                    case 'css':
                        $type = 'text/css';
                        break;
                    case 'js':
                        $type = 'application/javascript';
                        break;
                    case 'jpg':
                        $type = 'image/jpeg';
                        break;
                    case 'jpeg':
                        $type = 'image/jpeg';
                        break;
                    case 'gif':
                        $type = 'image/gif';
                        break;
                    case 'png':
                        $type = 'image/png';
                        break;
                }

                $body = file_get_contents('./public/assets/' . $extension . '/' . $name . '.' . $extension);
                $app->response->headers->set('Content-Type', $type);
                $app->response->setBody($body);
            }
            $app->stop();
        });

        $app->get('/media/:name/:extension', function ($name, $extension) use ($app) {

            $body = file_get_contents('./public/media/' . $name . '.' . $extension);
            $mimes = $app->config('mimetypes.image');
            if (isset($mimes[$extension])) {
                $app->response->headers->set('Content-Type', $mimes[$extension]);
                $app->response->setBody($body);
            }
            $app->stop();
        });

        $app->get('/download/:name/:extension', function ($name, $extension) use ($app) {

            $body = file_get_contents('./public/media/' . $name . '.' . $extension);
            $mimes = $app->config('mimetypes.download');
            if (isset($mimes[$extension])) {
                $app->response->headers->set('Content-Type', $mimes[$extension]);
                $app->response->setBody($body);
            }
            $app->stop();
        });

        return $app;
    }
}
