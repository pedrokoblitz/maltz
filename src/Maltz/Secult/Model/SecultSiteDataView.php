<?php

namespace Maltz\App\Model;

use Maltz\Mvc\DB;
use Maltz\Mvc\Result;

class SecultSiteDataView
{
    protected $db;
    protected $options;
    protected $config;

    public function __construct(DB $db, array $options = array())
    {
        $this->db = $db;
        $this->config = Config::query($this->db, 'display');
    }

    protected function getUser($id)
    {

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

    }
    
    public function showHome()
    {

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
        $result = Comment::query($app->db, 'create', $record);
    }
    
    public function findEvents($pg)
    {
        $result = Event::query($this->db, 'findPublished', $pg);
        if ($result->isSuccessful()) {
            $this->renderArray['content'] = $result->getRecords();
        }
    }
    
    public function showEvent($id)
    {
        $result = Event::query($this->db, 'showPublished', $id);
        if ($result->isSuccessful()) {
            $this->renderArray['content'] = $result->getRecords();
        }
    }

    public function findPlaces($pg)
    {
        $result = Place::query($this->db, 'findPublished', $pg);
        if ($result->isSuccessful()) {
            $this->renderArray['place'] = $result->getRecords();
        }
    }

    public function showPlace($id)
    {
        $result = Place::query($this->db, 'showPublished', $id);
        if ($result->isSuccessful()) {
            $this->renderArray['place'] = $result->getRecords();
        }
    }

    public function findAlbums($pg)
    {
        $result = Collection::query($this->db, 'findPublished', $pg);
        if ($result->isSuccessful()) {
            $this->renderArray['album'] = $result->getRecords();
        }
    }

    public function showAlbum($id)
    {
        $result = Collection::query($this->db, 'showPublished', $id);
        if ($result->isSuccessful()) {
            $this->renderArray['album'] = $result->getRecords();
        }
    }

    public function findArticles($pg)
    {
        $result = Content::query($this->db, 'findPublished', $pg);
        if ($result->isSuccessful()) {
            $this->renderArray['content'] = $result->getRecords();
        }
    }

    public function showArticle($id)
    {
        $result = Content::query($this->db, 'showPublished', $id);
        if ($result->isSuccessful()) {
            $this->renderArray['content'] = $result->getRecords();
        }
    }

    public function findNotas($pg)
    {
        $result = Content::query($this->db, 'findPublished', $pg);
        if ($result->isSuccessful()) {
            $this->renderArray['content'] = $result->getRecords();
        }
    }

    public function showSecao($id)
    {
        $result = Content::query($this->db, 'showPublished', $id);
        if ($result->isSuccessful()) {
            $this->renderArray['content'] = $result->getRecords();
        }
    }

    public function findConsultas($pg)
    {
        $result = ConsultaPublica::query($this->db, 'findPublished', $pg);
        if ($result->isSuccessful()) {
            $this->renderArray['consulta'] = $result->getRecords();
        }
    }

    public function showConsulta($id)
    {
        $result = ConsultaPublica::query($this->db, 'showPublished', $id);
        if ($result->isSuccessful()) {
            $this->renderArray['consulta'] = $result->getRecords();
        }
    }

    public function findEditais($pg)
    {
        $result = Edital::query($this->db, 'findPublished', $pg);
        if ($result->isSuccessful()) {
            $this->renderArray['edital'] = $result->getRecords();
        }
    }

    public function showEdital($id)
    {
        $result = Edital::query($this->db, 'showPublished', $id);
        if ($result->isSuccessful()) {
            $this->renderArray['edital'] = $result->getRecords();
        }
    }

    public function findProjetos($pg)
    {
        $result = Content::query($this->db, 'findPublished', $pg);
        if ($result->isSuccessful()) {
            $this->renderArray['content'] = $result->getRecords();
        }
    }

    public function showProjeto($id)
    {
        $result = Content::query($this->db, 'showPublished', $id);
        if ($result->isSuccessful()) {
            $this->renderArray['content'] = $result->getRecords();
        }
    }

    public function findLeis($pg)
    {
        $result = LeiIncentivo::query($this->db, 'findPublished', $pg);
        if ($result->isSuccessful()) {
            $this->renderArray['lei'] = $result->getRecords();
        }
    }

    public function showLei($id)
    {
        $result = LeiIncentivo::query($this->db, 'showPublished', $id);
        if ($result->isSuccessful()) {
            $this->renderArray['lei'] = $result->getRecords();
        }
    }

    public function showTaggedContent($tag)
    {
        $result = Term::query($app->db, 'showPublishedContent', $tag);
        if ($result->isSuccessful()) {
            $this->renderArray['content'] = $result->getRecords();
        }
    }

    public function showTaggedCollections($tag)
    {
        $result = Term::query($app->db, 'showPublishedCollections', $tag);
        if ($result->isSuccessful()) {
            $this->renderArray['collection'] = $result->getRecords();
        }
    }

    public function showTaggedResources($tag)
    {
        $result = Term::query($app->db, 'showPublishedResources', $tag);
        if ($result->isSuccessful()) {
            $this->renderArray['resource'] = $result->getRecords();
        }
    }
}
