<?php

namespace Maltz\Service;

use Maltz\Mvc\Result;
use Maltz\Mvc\Record;
use Maltz\Sys\Model\User;

class Handler
{
    protected $app;
    protected $template;
    protected $allowedRequestFilters;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function setViewInfo($info)
    {
        $this->setDefaultViewResources();
        
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

    public function isAuthorized($user_id, $roles)
    {
        $result = User::query($this->app->db, 'getRoles', $user_id);
        $userRoles = $result->asArray();
        foreach ($userRoles as $role) {
            if (in_array($role, $roles)) {
                return true;
            }
        }
        return false;
    }

    public function sendSignUpConfirmation(Record $record, $token)
    {
        $siteTitle = $this->app->config('site.title');
        $subject = 'Activate your account';
        $body = "Welcome to $siteTitle. \n To activate your account, click on the link:\n<a>";
        $body .= $this->app->urlFor('confirm_signup', array('token' => $token, 'user_id' => $record->get('id')));
        $body .= '</a>';
        $this->app->postman->createMessage($this->app->config('system.email'), $siteTitle, $subject, $body);
        return $this->app->postman->sendMessage($record->get('email'), $record->get('name'));
    }

    public function sendPasswordReset(Record $record, $token)
    {
        $subject = 'Password Reset';
        $body = "Welcome to $siteTitle. \n To reset your password, click on the link:\n<a>";
        $body .= $this->app->urlFor('new_password', array('token' => $token, 'user_id' => $record->get('id')));
        $body .= '</a>';
        $this->app->postman->createMessage($app->config('system.email'), $app->config('site.title'), $subject, $body);
        return $this->app->postman->sendMessage($record->get('email'), $record->get('name'));
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
        // try to get $_POST
        $body = $this->app->request->post();
        // if $_POST is empty, try to get json request body instead
        if (empty($body)) {
            $json = $app->request->getBody();
            $body = json_decode($json, true);
        }

        $record = new Record($body);
        if (!$record->has('nonce') || !$this->app->nonce->verify($record->get('nonce'))) {
            $this->errorForbidden();
        }
        
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

    public function authorize(array $roles = null)
    {
        $authenticated = $this->doorman->isUserAuthenticated();
        if (!$authenticated) {
            $this->app->redirect('user_login');
        }

        if ($roles) {
            $allowed = $this->app->doorman->isUserAllowed($roles);
            if (!$authenticated) {
                $this->errorForbidden();
            }
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
        $this->app->response->setStatus($status);
        $result = array('success' => false, 'message' => $message);

        if ($this->app->request->isAjax()) {
            $this->app->response->headers->set('Content-Type', 'application/json');
            $this->response->setBody($result->toJson());
        } else {
            $this->app->response->headers->set('Content-Type', 'text/html');
            $this->setDefaultViewResources();
            $this->app->view->setLayout('frontend');
            $this->app->render('error', $result);
        }
        $this->app->stop();
    }
}
