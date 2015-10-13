<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Package\Content\Model\Content;

class ContentTest extends ModelTestCase
{
    public function testInsert()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $record = new Record(
            array(
                'parent_id' => 0,
                'type_id' => 1,
                'activity' => 1,
                'date_pub' => "",
                'user_id' => 1,
                'title' => $faker->sentence(),
                'subtitle' => $faker->sentence(),
                'excerpt' => $faker->sentences(),
                'description' => $faker->sentences(),
                'body' => $faker->text,
                'language' => 'pt-br',
            )
        );
        $result = Content::query($this->db, 'insert', $record);
        $this->runResultInsertTests($result);
    }

    public function testUpdate()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $record = new Record(
            array(
                'id' => 1,
                'parent_id' => 0,
                'type_id' => 1,
                'activity' => 1,
                'date_pub' => "",
                'user_id' => 1,
                'title' => $faker->sentence(),
                'subtitle' => $faker->sentence(),
                'excerpt' => $faker->sentences(),
                'description' => $faker->sentences(),
                'body' => $faker->text,
                'language' => 'pt-br',
            )
        );
        $result = Content::query($this->db, 'update', $record);
        $this->runResultUpdateTests($result);
    }

    public function testShow()
    {
        $id = 1;
        $result = Content::query($this->db, 'show', $id);
        $this->runResultSelectTests($result);
    }

    public function testFind()
    {
        $result = Content::query($this->db, 'find');
        $this->runResultSelectTests($result);
    }

    public function testFindByType()
    {
        $type = '';
        $result = Content::query($this->db, 'findByType', $type);
        $this->runResultSelectTests($result);
    }

    public function testSetAsDraft()
    {
        $id = 1;
        $result = Content::query($this->db, 'setAsDraft', $id);
        $this->runResultUpdateTests($result);
    }

    public function testSetAsPending()
    {
        $id = 1;
        $result = Content::query($this->db, 'setAsPending', $id);
        $this->runResultUpdateTests($result);
    }

    public function testPublish()
    {
        $id = 1;
        $result = Content::query($this->db, 'publish', $id);
        $this->runResultUpdateTests($result);
    }
}
