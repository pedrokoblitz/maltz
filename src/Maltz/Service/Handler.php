<?php

namespace Maltz\Service;

use Maltz\Mvc\Result;
use Maltz\Mvc\Record;

class Handler
{
    protected $app;
    protected $allowedRequestFilters;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function setViewInfo($info)
    {
        if (isset($this->viewInfo['layout'])) {
            $this->app->view->setLayout($layout);
        }

        if (isset($this->viewInfo['view.data'])) {
            $this->app->view->setData($this->viewInfo['view.data']);
        }

        if (isset($this->viewInfo['layout.data'])) {
            $this->app->view->setLayoutData($this->viewInfo['layout.data']);
        }

        if (isset($info['meta.properties'])) {
            foreach ($info['meta.properties'] as $name => $property) {
                $this->app->view->setMetaProperty($name, $property);
            }
        }

        if (isset($info['styles'])) {
            foreach ($info['styles'] as $name => $style) {
                $this->app->view->enqueueStyle($name, $style);
            }
        }

        if (isset($info['scripts'])) {
            foreach ($info['scripts'] as $name => $script) {
                $this->app->view->enqueueScript($name, $script);
            }
        }

        $this->template = $info['template'];
    }

    public function setDefaultViewResources()
    {
        $this->app->view->enqueueScript('jquery', 'jquery.min.js');
        $this->app->view->enqueueScript('bootstrap', 'bootstrap.min.js');
        $this->app->view->enqueueScript('init', 'init.js');
        $this->app->view->enqueueStyle('sheet', 'style.css');
        $this->app->view->enqueueStyle('sheet', 'sheet.css');
    }

    public function render()
    {
        $this->app->render($this->template);
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
        } else {
            $this->errorNotFound();
        }
        $this->app->response->setBody($result->toJson());
        $this->app->stop();
    }

    public function handlePostRequest()
    {
        $body = $this->app->request->post();
        $record = new Record($body);

        //if (!$record->has('nonce') || !$this->app->nonce->verify($record->get('nonce'))) {
        //    $this->errorForbidden();
        //}
        $record->remove('nonce');
        return $record;
    }

    public function setEntity($name)
    {
        $avaiable = array(
            'content' => 'Maltz\Content\Model\Content',
            'resource' => 'Maltz\Content\Model\Resource',
            'collection' => 'Maltz\Content\Model\Collection',
            'term' => 'Maltz\Content\Model\Term',
            );
        return new $avaiable[$name]($this->app->db);
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
        $this->error(404, 'The content you requested is not avaiable at this time.');
    }

    public function errorForbidden()
    {
        $this->error(403, 'You do not have permission to access this content.');
    }

    public function handleError()
    {
        $this->app->response->headers->set('Content-Type', 'text/html');                
    }

    public function handleApiError()
    {
        $this->app->response->headers->set('Content-Type', 'application/json');                
    }

    public function error($status, $message)
    {
        $this->app->response->headers->set('Content-Type', 'text/html');
        $result = array('success' => false, 'message' => $message);
        $this->app->response->setStatus($status);
        $this->setDefaultViewResources();
        $this->app->view->setLayout('frontend');
        $this->app->render('error', $result);
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
                $this->app->session->get('user.email'),
                $this->app->session->get('user.name')
            );
    }
}
