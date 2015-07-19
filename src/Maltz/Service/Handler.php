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
        $this->app->view->enqueueStyle('bootstrap', 'bootstrap.min.css');
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
        $body = $this->app->request->getBody();
        $record = new Record(json_decode($body, true));
        $nonce = $record->get('nonce');
        if (!$this->app->nonce->verify($nonce)) {
            $this->errorForbidden();
        }
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

    public function handleNonce()
    {
        $get = $this->app->request->get();
        if (!isset($get['nonce']) || !$this->app->nonce->verify($get['nonce'])) {
            $this->errorForbidden();
        }
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

    public function error($status, $message)
    {
        $result = array('success' => false, 'message' => $message);
        $this->app->response->setStatus($status);
        $this->app->view->setLayout('frontend.tpl.php');
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
                    $this->app->session->get('user.email'),
                    $this->app->session->get('user.name')
                );
    }
}
