<?php

namespace Maltz\Content\Model;

use Maltz\Mvc\Activity;

trait ContentActivity
{
    use Activity;

    public function setAsDraft($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return $this->setActivity($id, 3);
    }

    public function setAsPending($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return $this->setActivity($id, 4);
    }

    public function publish($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return $this->setActivity($id, 5);
    }
}
