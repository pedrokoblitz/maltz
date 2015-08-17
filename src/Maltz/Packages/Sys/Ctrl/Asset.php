<?php

namespace Maltz\Sys\Ctrl;

use Maltz\Mvc\Controller;

class Asset extends Controller
{
    public function route($app)
    {
        /*
         * MUSTACHE TEMPLATES
         */
        $app->get('/template/:name', function ($name) use ($app) {

                $file = '/public/assets/mustache/' . $name . '.mustache';
                if (!is_file($file) || !is_readable($file)) {
                    throw new \Exception("Error Processing Request", 1);                    
                }

                $body = file_get_contents($file);
                if (!$body) {
                    throw new \Exception("Error Processing Request", 1);                    
                }

                $app->response->headers->set('Content-Type', $type);
                $app->response->setBody($body);
                $app->stop();
            }
        );

        /*
         * ASSETS
         */
        $app->get('/asset/:name/:extension', function ($name, $extension) use ($app) {

                if (in_array($extension, array('css','js', 'gif', 'jpg', 'jpeg', 'png'))) {
                    switch ($extension) {
                        case 'css':
                            $type = 'text/css';
                        break;
                        case 'js':
                            $type = 'application/javascript';
                        break;
                        default:
                            throw new \Exception("Unrecognized asset mimetype.", 001);
                        break;                            
                    }

                    $file = '/public/assets/' . $extension . '/' . $name . '.' . $extension;
                    if (!is_file($file) || !is_readable($file)) {
                        throw new \Exception("Error Processing Request", 1);                    
                    }

                    $body = file_get_contents($file);
                    if (!$body) {
                        throw new \Exception("Error Processing Request", 1);                    
                    }

                    $app->response->headers->set('Content-Type', $type);
                    $app->response->setBody($body);
                }
                $app->stop();
            }
        );

        /*
         * IMAGE FILES
         * (TODO: implement Imagine PHP lib)
         */
        $app->get('/media/:name/:extension', function ($name, $extension) use ($app) {

                if (in_array($extension, array('gif', 'jpg', 'jpeg', 'png'))) {
                    switch ($extension) {
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
                        default:
                            throw new \Exception("Unrecognized media mimetype.", 001);
                        break;
                    }
                    
                    $app->response->headers->set('Content-Type', $type);

                    $file = '/public/media/' . $name . '.' . $extension;
                    if (!is_file($file) || !is_readable($file)) {
                        throw new \Exception("Error Processing Request", 1);                    
                    }

                    $body = file_get_contents($file);
                    if (!$body) {
                        throw new \Exception("Error Processing Request", 1);                    
                    }

                    $app->response->setBody($body);
                }
                $app->stop();
            }
        );

        /*
         * FORCE DOWNLOAD
         * (TODO: log downloaded files)
         */
        $app->get('/download/:name/:extension', function ($name, $extension) use ($app) {

                $file = '/public/media/' . $name . '.' . $extension;
                if (!is_file($file) || !is_readable($file)) {
                    throw new \Exception("Error Processing Request", 1);
                }

                $body = file_get_contents('/public/media/' . $name . '.' . $extension);
                if (!$body) {
                    throw new \Exception("Error Processing Request", 1);
                }

                $mimes = $app->config('mimetypes.download');
                if (isset($mimes[$extension])) {
                    $app->response->headers->set('Content-Type', $mimes[$extension]);
                    $app->response->setBody($body);
                }
                $app->stop();
            }
        );

        return $app;
    }
}
