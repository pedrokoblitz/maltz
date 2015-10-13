<?php

namespace Test;

class CtrlTestCase extends \PHPUnit_Framework_TestCase
{
    protected $url;

    public function setUp()
    {
        $this->url = 'http://maltz.local';
    }

    public function tearDown()
    {
        $this->url = null;
    }

    public function getRequest($url, array $headers = null)
    {
        $response = \Requests::get($this->url . $url, $headers);
        $this->assertTrue($response->success);
        return $response;
    }

    public function postRequest($url, array $data = null, array $headers = null)
    {
        $response = \Requests::post($this->url . $url, $headers, $data);
        $this->assertTrue($response->success);
        return $response;
    }
}
