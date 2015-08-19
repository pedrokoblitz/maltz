<?php

namespace Maltz\Mvc;

use Maltz\Mvc\DB;
use Maltz\Sys\Config;
use Maltz\SiteBuilding\Area;
use Maltz\Content\Term;

abstract class Binder
{
    protected $db;
    protected $config;

    public function __construct(DB $db, array $options = array())
    {
        $this->db = $db;
        $result = Config::query($this->db, 'display');
        $config = $result->getRecords()->toArray();
        foreach ($options as $key => $value) {
            $config[$key] = $value;
        }
        $this->config = $config;
    }

    protected function getUser($id)
    {
        $result = User::query($this->db, 'show', $id);
    }

    protected function showArea($id)
    {
        $result = Area::query($this->db, 'show', $id);
        if ($result->isSuccessful()) {
            $record = $result->getFirstRecord();
            $name = $record->get('name');
            $this->renderArray['areas'][$name] = $record;
        }
    }

    protected function showMenu($id)
    {
        $result = Term::query($this->db, 'getItems', $id);
        if ($result->isSuccessful()) {
            $record = $result->getFirstRecord();
            $name = $record->get('name');
            $this->renderArray['menus'][$name] = $record;
        }
    }

    protected function generateTagCloud()
    {
        $result = Term::query($this->db, 'generateCloud');
    }

    protected function getSiteParts()
    {
        $this->getUser();
        $this->showArea();
        $this->showMenu();
    }
    
    public function viewProfile($user_id)
    {
        $result = User::query($app->db, 'show', $user_id);
    }

    public function saveProfile(Record $record)
    {
        $result = User::query($app->db, 'save', $record);
    }

    public function comment(Record $record)
    {
        $result = CommentFacade::query($app->db, 'create', $record);
    }
}
