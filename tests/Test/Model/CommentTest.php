<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Package\Interaction\Model\Comment;

class CommentTest extends ModelTestCase
{
    public function testInsert()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $record = new Record(
            array(
                '' => '',
            )
        );
        $result = Comment::query($this->db, 'insert');
        $this->runResultInsertTests($result);
    }

    public function testFind()
    {
        $result = Comment::query($this->db, 'find');
    }

    public function testFindByType()
    {
        $result = Comment::query($this->db, 'findByType');
    }

    public function testApprove()
    {
        $result = Comment::query($this->db, 'approve');
    }

    public function testReprove()
    {
        $result = Comment::query($this->db, 'reprove');
    }

    public function testSetAsSpam()
    {
        $result = Comment::query($this->db, 'setAsSpam');
    }
}
