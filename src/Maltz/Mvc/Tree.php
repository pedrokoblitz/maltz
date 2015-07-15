<?php

namespace Maltz\Mvc;

trait Tree
{
    public function display() {
        $sql = "SELECT t1.id, t1.parent_id, t2.slug, t2.title, t2.subtitle, t2.excerpt, t2.description, t2.body, t3.name AS type
            FROM $this->table t1
                JOIN translations t2
                    ON t1.id=t2.item_id
                    AND t2.item_name=:item_name
                JOIN types t3
                    ON t1.type_id=t3.id";
        $result = $this->db->run($sql, array('item_name' => $this->slug));
        return $result;
    }

    public function displayByType($type) {
        $sql = "SELECT t1.id, t1.parent_id, t2.slug, t2.title, t2.subtitle, t2.excerpt, t2.description, t2.body, t3.name AS type
            FROM $this->table t1
                JOIN translations t2
                    ON t1.id=t2.item_id
                    AND t2.item_name=:item_name
                JOIN types t3
                    ON t1.type_id=t3.id
                WHERE t3.name=:type";
        $result = $this->db->run($sql, array('item_name' => $this->slug, 'type' => $type));
        return $result;
    }

    public function displayTree()
    {
        $result = $this->display()->toArray();
        $tree = $this->generateTree($result['records']);
        $record = new Record($tree);
        $res = array('records' => array($record), 'success' => true);
        $result = new Result($res);
        return $result;
    }

    public function generateTree($items)
    {
        $this->elements = array();
        foreach ($items as $item) {
            $this->elements[$item['id']] = $item;
        }

        return $this->buildTree();
    }

    public function buildTree($parentId = 0) {
        $branch = array();
        foreach ($this->elements as $element) {
            if ((int) $element['parent_id'] === (int) $parentId) {
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

    public function setParent($child_id, $parent_id = 0)
    {
        $sql = "UPDATE $this->table SET parent_id=:parent_id WHERE id=:child_id";
        $resultado = $this->db->run($sql, array('parent_id' => $parent_id, 'child_id' => $child_id));
        return $resultado;
    }

    public function getParent($child_id)
    {
        $sql = "SELECT * FROM $this->table WHERE id=(SELECT parent_id FROM $this->table WHERE id=:child_id)";
        $resultado = $this->db->run($sql, array('child_id' => $child_id));
        return $resultado;        
    }

    public function getChildren($parent_id)
    {
        $sql = "SELECT * FROM $this->table WHERE id=:parent_id";
        $resultado = $this->db->run($sql, array('parent_id' => $parent_id));
        return $resultado;
    }

    public function addChild($parent_id, $child_id)
    {
        $sql = "UPDATE $this->table SET parent_id=:parent_id WHERE id=:child_id";
        $resultado = $this->db->run($sql, array('parent_id' => $parent_id, 'child_id' => $child_id));
        return $resultado;
    }

    public function removeChild($child_id)
    {
        $sql = "UPDATE $this->table SET parent_id=:parent_id WHERE id=:child_id";
        $resultado = $this->db->run($sql, array('parent_id' => 0, 'child_id' => $child_id));
        return $resultado;
    }
}