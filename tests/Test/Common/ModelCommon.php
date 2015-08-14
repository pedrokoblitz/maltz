<?php

namespace Test\Common;

trait ModelCommon
{
    public function testDisplay()
    {
        $this->model->display();
    }

    public function testDelete($id)
    {
        $this->model->update($id);
    }

    public function testShow($id)
    {
        $this->model->show($id);
    }

    public function testFind()
    {
        $this->model->find();
    }
    
    public function testUpdate($record)
    {
        $this->model->update($record);
    }

    public function testInsert($record)
    {
        $this->model->insert($record);
    }
}
