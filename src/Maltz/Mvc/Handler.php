<?php

namespace Maltz\Mvc;

class Handler
{
    public function __construct($app)
    {
        $this->app = $app;
    }

    public function isAuthorized($user = null, $roles = null)
    {
        return true;
    }

    public function handleApi(Result $result)
    {
        $this->app->response->headers->set('Content-Type', 'application/json');
        if ($result->get('success')) {
            $this->app->response->setStatus(200);
            $nonce = $this->app->nonce->generate();
            $result->set('nonce', $nonce);
        } else {
            $this->app->response->setStatus(404);
        }
        $this->app->response->setBody($result->toJson());
        $this->app->stop();
    }

    public function handlePostRequest()
    {
        $body = $app->request->getBody();
        $record = new Record(json_decode($body, true));
        $nonce = $record->get('nonce');
        if (!$app->nonce->verify($nonce)) {
            $app->redirect('/error');
        }
        return $record;
    }
}