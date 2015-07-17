<?php

namespace Maltz\Service;

use Maltz\Mvc\Result;
use Maltz\Mvc\Record;

class Handler
{
    public function __construct($app)
    {
        $this->app = $app;
    }

    public function setViewInfo($info)
    {

        if (isset($info['meta.properties'])) {
            foreach ($info['meta.properties'] as $name => $property) {
                $this->app->view->setMetaProperty($name, $property);
            }
            unset($info['meta.properties']);
        }

        if (isset($info['styles'])) {
            foreach ($info['styles'] as $name => $style) {
                $this->app->view->enqueueStyle($name, $style);
            }
            unset($info['styles']);
        }

        if (isset($info['scripts'])) {
            foreach ($info['scripts'] as $name => $script) {
                $this->app->view->enqueueScript($name, $script);
            }
            unset($info['scripts']);
        }

        $this->viewInfo = $info;
    }

    public function render($layout, $template)
    {
        $this->app->view->setLayout($layout);
        if (isset($this->viewInfo['layout.data'])) {
            $this->app->view->setLayoutData($this->viewInfo['layout.data']);
        }
        $data = isset($this->viewInfo['view.data']) ? $this->viewInfo['view.data'] : array();
        $this->app->render($template, $data);
    }

    public function isAuthorized($user = null, $roles = null)
    {
        return true;
    }

    public function handleApiResponse(Result $result)
    {
        $this->app->response->headers->set('Content-Type', 'application/json');
        if ($result->isSuccessful()) {
            $this->app->response->setStatus(200);
            $nonce = $this->app->nonce->generate();
            $result->set('nonce', $nonce);
        } else {
            $this->errorNotFound();
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
            $this->errorForbidden();
        }
        return $record;
    }

    public function handleGetRequest()
    {
        return true;
    }

    public function authorize(array $roles = null)
    {
        if (!$roles) {
            $roles = $this->app->defaultRoles;
        }

        $this->app->response->headers->set('Content-Type', 'application/json');
        $authenticated = $this->doorman->isUserAuthenticated();
        if (!$authenticated) {
            $this->app->redirect('user_login');
        }

        $allowed = $this->app->doorman->isUserAllowed($roles);
        if (!$authenticated) {
            $this->errorForbidden();
        }
    }

    public function errorNotFound()
    {
        $this->error(404, 'You do not have permission to access this content.');
    }

    public function errorForbidden()
    {
        $this->error(403, 'You do not have permission to access this content.');
    }

    public function error($status, $message)
    {
        $result = array('success' => false, 'message' => $message);
        $this->app->response->setStatus($status);
        $app->view->setLayout('frontend.tpl.php');
        $this->app->render('error.tpl.php', $result);
        $this->app->stop();
    }

    public function sendEmail($subject, $body)
    {
        $this->app
            ->postman
                ->createMessage(
                    $this->app->config('system.email'),
                    $this->app->config('site.title'),
                    $subject,
                    $body
                )
                ->sendMessage(
                    $this->session->get('user.email'),
                    $this->session->get('user.name')
                );
    }
}
