<?php

namespace Test\Ctrl;

use Test\CtrlTestCase;

class ContentTest extends CtrlTestCase
{
    public function testFind()
    {
        $urls = array(
            '/api/content/page' => 200,
            '/api/resource/image' => 200,
            '/api/content/article' => 200
        );
        foreach ($urls as $url => $status) {
            $response = $this->getRequest($url);
            $this->assertEquals($response->status_code, $status);
        }
    }

    public function testShow()
    {
        $url = '/api/:model/:id/show';
        $urls = array(
            '/api/' => 200,
        );
        foreach ($urls as $url => $status) {
            $this->assertEquals($response->status_code, $status);
        }
        $response = $this->getRequest($url);
    }

    public function testSave()
    {
        $url = '/api/:model/save';
        $data = array(
        );
        foreach ($data as $item) {
            $this->assertEquals($response->status_code, $status);
        }
        $response = $this->postRequest($url, $data);
    }

    public function testDelete()
    {
        $url = '/api/:model/delete';
        $data = array(
        );
        foreach ($data as $item) {
            $this->assertEquals($response->status_code, $status);
        }
        $response = $this->postRequest($url, $data);
    }

    public function testTree()
    {
        $url = '/api/tree/:model';
        $urls = array(
            '/api/' => 200,
        );
        foreach ($urls as $url => $status) {
            $this->assertEquals($response->status_code, $status);
        }
        $response = $this->getRequest($url);
    }

    public function testShowAttachment()
    {
        $url = '/api/attachment/:group_name/:group_id/show';
        $urls = array(
            '/api/' => 200,
        );
        foreach ($urls as $url => $status) {
            $this->assertEquals($response->status_code, $status);
        }
        $response = $this->getRequest($url);
    }

    public function testAddAttachment()
    {
        $url = '/api/attachment/add';
        $data = array(
        );
        foreach ($data as $item) {
            $this->assertEquals($response->status_code, $status);
        }
        $response = $this->postRequest($url, $data);
    }

    public function testRemoveAttachment()
    {
        $url = '/api/attachment/remove';
        $data = array(
        );
        foreach ($data as $item) {
            $this->assertEquals($response->status_code, $status);
        }
        $response = $this->postRequest($url, $data);
    }

    public function testAddMeta()
    {
        $url = '/api/metadata/add';
        $data = array(
        );
        foreach ($data as $item) {
            $this->assertEquals($response->status_code, $status);
        }
        $response = $this->postRequest($url, $data);
    }

    public function testRemoveMeta()
    {
        $url = '/api/metadata/remove';
        $data = array(
        );
        foreach ($data as $item) {
            $this->assertEquals($response->status_code, $status);
        }
        $response = $this->postRequest($url, $data);
    }

    public function testFindArea()
    {
        $url = '/api/area';
        $urls = array(
            '/api/' => 200,
        );
        foreach ($urls as $url => $status) {
            $this->assertEquals($response->status_code, $status);
        }
        $response = $this->getRequest($url);
    }

    public function testShowArea()
    {
        $url = '/api/area/:id/show';
        $urls = array(
            '/api/' => 200,
        );
        foreach ($urls as $url => $status) {
            $this->assertEquals($response->status_code, $status);
        }
        $response = $this->getRequest($url);
    }

    public function testAddBlockArea()
    {
        $url = '/api/area/block/add';
        $data = array(
        );
        foreach ($data as $item) {
            $this->assertEquals($response->status_code, $status);
        }
        $response = $this->postRequest($url, $data);
    }

    public function testRemoveBlockArea()
    {
        $url = '/api/area/block/remove';
        $data = array(
        );
        foreach ($data as $item) {
            $this->assertEquals($response->status_code, $status);
        }
        $response = $this->postRequest($url, $data);
    }

    public function testDeleteArea()
    {
        $url = '/api/area/delete';
        $data = array(
        );
        foreach ($data as $item) {
            $this->assertEquals($response->status_code, $status);
        }
        $response = $this->postRequest($url, $data);
    }

    public function testSaveArea()
    {
        $url = '/api/area/save';
        $data = array(
        );
        foreach ($data as $item) {
            $this->assertEquals($response->status_code, $status);
        }
        $response = $this->postRequest($url, $data);
    }

    public function testFindBlock()
    {
        $url = '/api/block';
        $urls = array(
            '/api/' => 200,
        );
        foreach ($urls as $url => $status) {
            $this->assertEquals($response->status_code, $status);
        }
        $response = $this->getRequest($url);
    }

    public function testDeleteBlock()
    {
        $url = '/api/block/delete';
        $data = array(
            array(
                'data' => array(
                ),
                'status' => 200
            ),
            array(
                'data' => array(
                ),
                'status' => 200
            ),
            array(
                'data' => array(
                ),
                'status' => 200
            ),
            array(
                'data' => array(
                ),
                'status' => 200
            ),
        );
        foreach ($data as $item) {
            $response = $this->postRequest($url, $item['data']);
            $this->assertEquals($response->status_code, $item['status']);
        }
    }

    public function testBlockSave()
    {
        $url = '/api/block/save';
        $data = array(
            array(
                'data' => array(
                ),
                'status' => 200
            ),
            array(
                'data' => array(
                ),
                'status' => 200
            ),
            array(
                'data' => array(
                ),
                'status' => 200
            ),
            array(
                'data' => array(
                ),
                'status' => 200
            ),
        );
        foreach ($data as $item) {
            $response = $this->postRequest($url, $item['data']);
            $this->assertEquals($response->status_code, $item['status']);
        }
    }
}
