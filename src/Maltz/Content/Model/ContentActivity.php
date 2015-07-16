<?php

namespace Maltz\Content\Model;

trait ContentActivity
{
    public function setAsDraft($id)
    {
        return $this->setActivity($id, 3);
    }

    public function setAsPending($id)
    {
        return $this->setActivity($id, 4);
    }

    public function publish($id)
    {
        return $this->setActivity($id, 5);
    }
}