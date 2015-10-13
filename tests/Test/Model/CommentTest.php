<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
<<<<<<< HEAD
use Maltz\Interaction\Model\Comment;

class CommentTest extends ModelTestCase
{
    public function testInsert()
    {
        $faker = \Faker\Factory::create();
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
=======
use Maltz\Sys\Model\User;

class CommentTest extends ModelTestCase
{

>>>>>>> 581057e42a9309b414205b42da284398c82a35a0
}
