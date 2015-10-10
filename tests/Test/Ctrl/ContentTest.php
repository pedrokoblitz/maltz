<?php

namespace Test\Ctrl;

class ContentTest extends CtrlTestCase
{
    public function testFind()
    {
        $url = '/api/:model/:type';
        $response = $this->getRequest($url);
    }

    public function testShow()
    {
        $url = '/api/:model/:id/show';
        $response = $this->getRequest($url);
    }

    public function testSave()
    {
        $url = '/api/:model/save';
        $data = array(
            '' => '',
        );
        $response = $this->postRequest($url, $data);
    }

    public function testDelete()
    {
        $url = '/api/:model/delete';
        $data = array(
            '' => '',
        );
        $response = $this->postRequest($url, $data);
    }

    public function testTree()
    {
        $url = '/api/tree/:model';
        $response = $this->getRequest($url);
    }

    public function testShowAttachment()
    {
        $url = '/api/attachment/:group_name/:group_id/show';
        $response = $this->getRequest($url);
    }

    public function testAddAttachment()
    {
        $url = '/api/attachment/add';
        $data = array(
            '' => '',
        );
        $response = $this->postRequest($url, $data);
    }

    public function testRemoveAttachment()
    {
        $url = '/api/attachment/remove';
        $data = array(
            '' => '',
        );
        $response = $this->postRequest($url, $data);
    }

    public function testAddMeta()
    {
        $url = '/api/metadata/add';
        $data = array(
            '' => '',
        );
        $response = $this->postRequest($url, $data);
    }

    public function testRemoveMeta()
    {
        $url = '/api/metadata/remove';
        $data = array(
            '' => '',
        );
        $response = $this->postRequest($url, $data);
    }

    public function testFindArea()
    {
        $url = '/api/area';
        $response = $this->getRequest($url);
    }

    public function testShowArea()
    {
        $url = '/api/area/:id/show';
        $response = $this->getRequest($url);
    }

    public function testAddBlockArea()
    {
        $url = '/api/area/block/add';
        $data = array(
            '' => '',
        );
        $response = $this->postRequest($url, $data);
    }

    public function testRemoveBlockArea()
    {
        $url = '/api/area/block/remove';
        $data = array(
            '' => '',
        );
        $response = $this->postRequest($url, $data);
    }

    public function testDeleteArea()
    {
        $url = '/api/area/delete';
        $data = array(
            '' => '',
        );
        $response = $this->postRequest($url, $data);
    }

    public function testSaveArea()
    {
        $url = '/api/area/save';
        $data = array(
            '' => '',
        );
        $response = $this->postRequest($url, $data);
    }

    public function testFindBlock()
    {
        $url = '/api/block';
        $response = $this->getRequest($url);
    }

    public function testDeleteBlock()
    {
        $url = '/api/block/delete';
        $data = array(
            '' => '',
        );
        $response = $this->postRequest($url, $data);
    }

    public function testBlockSave()
    {
        $url = '/api/block/save';
        $data = array(
            '' => '',
        );
        $response = $this->postRequest($url, $data);
    }
}
