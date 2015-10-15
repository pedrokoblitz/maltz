<?php

namespace Maltz\Package\Secult\Model;


class SecultSiteDataView
{

    /**
     * /
     * @return [type] [description]
     */
    public function showHome()
    {

    }
    
    /**
     * /
     * @param  [type] $pg [description]
     * @return [type]     [description]
     */
    public function findEvents($pg)
    {
        $result = Event::query($this->db, 'findPublished', $pg);
        if ($result->isSuccessful()) {
            $this->renderArray['content'] = $result->getRecords();
        }
    }
    
    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function showEvent($id)
    {
        $result = Event::query($this->db, 'showPublished', $id);
        if ($result->isSuccessful()) {
            $this->renderArray['content'] = $result->getRecords();
        }
    }

    /**
     * /
     * @param  [type] $pg [description]
     * @return [type]     [description]
     */
    public function findPlaces($pg)
    {
        $result = Place::query($this->db, 'findPublished', $pg);
        if ($result->isSuccessful()) {
            $this->renderArray['place'] = $result->getRecords();
        }
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function showPlace($id)
    {
        $result = Place::query($this->db, 'showPublished', $id);
        if ($result->isSuccessful()) {
            $this->renderArray['place'] = $result->getRecords();
        }
    }

    /**
     * /
     * @param  [type] $pg [description]
     * @return [type]     [description]
     */
    public function findAlbums($pg)
    {
        $result = Collection::query($this->db, 'findPublished', $pg);
        if ($result->isSuccessful()) {
            $this->renderArray['album'] = $result->getRecords();
        }
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function showAlbum($id)
    {
        $result = Collection::query($this->db, 'showPublished', $id);
        if ($result->isSuccessful()) {
            $this->renderArray['album'] = $result->getRecords();
        }
    }

    /**
     * /
     * @param  [type] $pg [description]
     * @return [type]     [description]
     */
    public function findArticles($pg)
    {
        $result = Content::query($this->db, 'findPublished', $pg);
        if ($result->isSuccessful()) {
            $this->renderArray['content'] = $result->getRecords();
        }
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function showArticle($id)
    {
        $result = Content::query($this->db, 'showPublished', $id);
        if ($result->isSuccessful()) {
            $this->renderArray['content'] = $result->getRecords();
        }
    }

    /**
     * /
     * @param  [type] $pg [description]
     * @return [type]     [description]
     */
    public function findNotas($pg)
    {
        $result = Content::query($this->db, 'findPublished', $pg);
        if ($result->isSuccessful()) {
            $this->renderArray['content'] = $result->getRecords();
        }
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function showSecao($id)
    {
        $result = Content::query($this->db, 'showPublished', $id);
        if ($result->isSuccessful()) {
            $this->renderArray['content'] = $result->getRecords();
        }
    }

    /**
     * /
     * @param  [type] $pg [description]
     * @return [type]     [description]
     */
    public function findConsultas($pg)
    {
        $result = ConsultaPublica::query($this->db, 'findPublished', $pg);
        if ($result->isSuccessful()) {
            $this->renderArray['consulta'] = $result->getRecords();
        }
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function showConsulta($id)
    {
        $result = ConsultaPublica::query($this->db, 'showPublished', $id);
        if ($result->isSuccessful()) {
            $this->renderArray['consulta'] = $result->getRecords();
        }
    }

    /**
     * /
     * @param  [type] $pg [description]
     * @return [type]     [description]
     */
    public function findEditais($pg)
    {
        $result = Edital::query($this->db, 'findPublished', $pg);
        if ($result->isSuccessful()) {
            $this->renderArray['edital'] = $result->getRecords();
        }
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function showEdital($id)
    {
        $result = Edital::query($this->db, 'showPublished', $id);
        if ($result->isSuccessful()) {
            $this->renderArray['edital'] = $result->getRecords();
        }
    }

    /**
     * /
     * @param  [type] $pg [description]
     * @return [type]     [description]
     */
    public function findProjetos($pg)
    {
        $result = Content::query($this->db, 'findPublished', $pg);
        if ($result->isSuccessful()) {
            $this->renderArray['content'] = $result->getRecords();
        }
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function showProjeto($id)
    {
        $result = Content::query($this->db, 'showPublished', $id);
        if ($result->isSuccessful()) {
            $this->renderArray['content'] = $result->getRecords();
        }
    }

    /**
     * /
     * @param  [type] $pg [description]
     * @return [type]     [description]
     */
    public function findLeis($pg)
    {
        $result = LeiIncentivo::query($this->db, 'findPublished', $pg);
        if ($result->isSuccessful()) {
            $this->renderArray['lei'] = $result->getRecords();
        }
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function showLei($id)
    {
        $result = LeiIncentivo::query($this->db, 'showPublished', $id);
        if ($result->isSuccessful()) {
            $this->renderArray['lei'] = $result->getRecords();
        }
    }

    /**
     * /
     * @param  [type] $tag [description]
     * @return [type]      [description]
     */
    public function showTaggedContent($tag)
    {
        $result = Term::query($app->db, 'showPublishedContent', $tag);
        if ($result->isSuccessful()) {
            $this->renderArray['content'] = $result->getRecords();
        }
    }

    /**
     * /
     * @param  [type] $tag [description]
     * @return [type]      [description]
     */
    public function showTaggedCollections($tag)
    {
        $result = Term::query($app->db, 'showPublishedCollections', $tag);
        if ($result->isSuccessful()) {
            $this->renderArray['collection'] = $result->getRecords();
        }
    }

    /**
     * /
     * @param  [type] $tag [description]
     * @return [type]      [description]
     */
    public function showTaggedResources($tag)
    {
        $result = Term::query($app->db, 'showPublishedResources', $tag);
        if ($result->isSuccessful()) {
            $this->renderArray['resource'] = $result->getRecords();
        }
    }
}
