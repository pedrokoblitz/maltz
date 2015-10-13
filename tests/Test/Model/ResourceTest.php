<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Package\Content\Model\Resource;

class ResourceTest extends ModelTestCase
{
    public function testInsert()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $record = new Record(
            array(
                'type_id' => 1,
                'activity' => 1,
                'url' => 'http://google.com',
                'filepath' => '/var/files',
                'filename' => 'file-0002',
                'extension' => 'jpg',
                'embed' => '<embed></embed>',
                'user_id' => 1,
                'title' => $faker->sentence(),
                'description' => $faker->sentences(),
                'language' => 'pt-br',
                'mimetype' => 'image/jpeg',
            )
        );
        $result = Resource::query($this->db, 'insert', $record);
        $this->runResultInsertTests($result);
    }

    public function testDisplay()
    {
        $result = Resource::query($this->db, 'display');
        $this->runResultSelectTests($result);
    }

    public function testFind()
    {
        $result = Resource::query($this->db, 'find');
        $this->runResultSelectTests($result);
    }

    public function testFindByType()
    {
        $type = '';
        $result = Resource::query($this->db, 'findByType', $type);
        $this->runResultSelectTests($result);
    }

    public function testShow()
    {
        $id = 1;
        $result = Resource::query($this->db, 'show', $id);
        $this->runResultSelectTests($result);
    }
}
