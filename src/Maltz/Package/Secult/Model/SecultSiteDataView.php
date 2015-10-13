<?php

namespace Maltz\Package\Secult\Model;


class SecultSiteDataView
{

    public function showHome()
    {

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
