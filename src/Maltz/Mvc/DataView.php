<?php

namespace Maltz\Mvc;

use Maltz\Mvc\DB;
use Maltz\Sys\Config;
use Maltz\SiteBuilding\Area;
use Maltz\Content\Term;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

abstract class DataView
{
    protected $db;
    protected $config;

    /**
     * /
     * @param DB    $db      [description]
     * @param array $options [description]
     */
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

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    protected function getUser($id)
    {
        $result = User::query($this->db, 'show', $id);
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    protected function showArea($id)
    {
        $result = Area::query($this->db, 'show', $id);
        if ($result->isSuccessful()) {
            $record = $result->getFirstRecord();
            $name = $record->get('name');
            $this->renderArray['areas'][$name] = $record;
        }
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    protected function showMenu($id)
    {
        $result = Term::query($this->db, 'getItems', $id);
        if ($result->isSuccessful()) {
            $record = $result->getFirstRecord();
            $name = $record->get('name');
            $this->renderArray['menus'][$name] = $record;
        }
    }

    /**
     * /
     * @return [type] [description]
     */
    protected function generateTagCloud()
    {
        $result = Term::query($this->db, 'generateCloud');
    }

    /**
     * /
     * @return [type] [description]
     */
    protected function getSiteParts()
    {
        $this->getUser();
        $this->showArea();
        $this->showMenu();
    }
    
    /**
     * /
     * @param  [type] $user_id [description]
     * @return [type]          [description]
     */
    public function viewProfile($user_id)
    {
        $result = User::query($app->db, 'show', $user_id);
    }
}
