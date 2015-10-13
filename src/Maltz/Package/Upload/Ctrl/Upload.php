<?php

namespace Maltz\Package\Api\Ctrl;

class Upload
{
    public function route($app)
    {
        /*
         * UPLOAD
         */        
        $app->get('/upload', function () use ($app) {
                $app->render('upload');
            }
        );

        $app->post('/upload', function () use ($app) {

                $validator = new \FileUpload\Validator\Simple(1024 * 1024 * 2, $app->allowedFileTypes);
                $pathresolver = new \FileUpload\PathResolver\Simple('/var/www/html/files/');
                $filesystem = new \FileUpload\FileSystem\Simple();
                $fileupload = new \FileUpload\FileUpload($_FILES['files'], $_SERVER);

                $fileupload->setPathResolver($pathresolver);
                $fileupload->setFileSystem($filesystem);
                $fileupload->addValidator($validator);

                list($files, $headers) = $fileupload->processAll();

                foreach ($headers as $header => $value) {
                    $app->response->headers->set($header . ': ' . $value);
                }

                $body = json_encode(array('files' => $files));
                $app->response->setBody($body);
                $app->stop();
            }
        );

        return $app;
    }
}
