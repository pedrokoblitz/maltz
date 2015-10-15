<?php

namespace Maltz\Mvc\ModelFeature;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

trait Tree
{
    protected $elements;

    /**
     * /
     * @return [type] [description]
     */
    public function displayTree()
    {
        if (!method_exists($this, 'display')) {
            throw new \Exception("Invalid input type", 1);
        }

        $result = $this->display()->toArray();
        $tree = $this->generateTree($result['records']);
        $record = new Record($tree);
        $res = array('records' => array($record), 'success' => true);
        $result = new Result($res);
        return $result;
    }

    /**
     * /
     * @param  array  $items [description]
     * @return [type]        [description]
     */
    public function generateTree(array $items)
    {
        $this->elements = array();
        foreach ($items as $item) {
            $this->elements[$item['id']] = $item;
        }
        return $this->buildTree();
    }

    /**
     * /
     * @param  integer $parent_id [description]
     * @return [type]             [description]
     */
    public function buildTree($parent_id = 0)
    {
        $branch = array();
        foreach ($this->elements as $element) {
            if ((int) $element['parent_id'] === (int) $parent_id) {
                $children = $this->buildTree($element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[$element['id']] = $element;
                unset($this->elements[$element['id']]);
            }
        }
        return $branch;
    }

    /**
     * /
     * @param [type]  $child_id  [description]
     * @param integer $parent_id [description]
     */
    public function setParent($child_id, $parent_id = 0)
    {
        if (!is_int($parent_id) || !is_int($child_id)) {
            throw new \Exception("Invalid input type", 1);
        }

        $sql = "UPDATE $this->table SET parent_id=:parent_id WHERE id=:child_id";
        $result = $this->db->run($sql, array('parent_id' => $parent_id, 'child_id' => $child_id));
        return $result;
    }

    /**
     * /
     * @param  [type] $child_id [description]
     * @return [type]           [description]
     */
    public function getParent($child_id)
    {
        if (!is_int($child_id)) {
            throw new \Exception("Invalid input type", 1);
        }

        $sql = "SELECT * FROM $this->table WHERE id=(SELECT parent_id FROM $this->table WHERE id=:child_id)";
        $result = $this->db->run($sql, array('child_id' => $child_id));
        return $result;
    }

    /**
     * /
     * @param  [type] $parent_id [description]
     * @return [type]            [description]
     */
    public function getChildren($parent_id)
    {
        if (!is_int($parent_id)) {
            throw new \Exception("Invalid input type", 1);
        }

        $sql = "SELECT * FROM $this->table WHERE id=:parent_id";
        $result = $this->db->run($sql, array('parent_id' => $parent_id));
        return $result;
    }

    /**
     * /
     * @param [type] $parent_id [description]
     * @param [type] $child_id  [description]
     */
    public function addChild($parent_id, $child_id)
    {
        if (!is_int($parent_id) || !is_int($child_id)) {
            throw new \Exception("Invalid input type", 1);
        }

        $sql = "UPDATE $this->table SET parent_id=:parent_id WHERE id=:child_id";
        $result = $this->db->run($sql, array('parent_id' => $parent_id, 'child_id' => $child_id));
        return $result;
    }

    /**
     * /
     * @param  [type] $child_id [description]
     * @return [type]           [description]
     */
    public function removeChild($child_id)
    {
        if (!is_int($child_id)) {
            throw new \Exception("Invalid input type", 1);
        }

        $sql = "UPDATE $this->table SET parent_id=:parent_id WHERE id=:child_id";
        $result = $this->db->run($sql, array('parent_id' => 0, 'child_id' => $child_id));
        return $result;
    }
}
