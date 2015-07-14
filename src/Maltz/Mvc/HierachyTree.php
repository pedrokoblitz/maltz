<?php

namespace Maltz\Mvc;

trait HierarchyTree
{
    public function generateTree($hierarchy, $parent_id = 0, $depth = 0)
    {
    	if ($depth > 1000) return;
	    $tree = array();
	    for ($i=0, $ni=count($hierarchy); $i < $ni; $i++) {
	        if ($hierarchy[$i]['parent_id'] == $parent_id) {
	        	$tree[$depth] = $hierarchy[$i];
	            $tree[$depth] = $this->generateTree($hierarchy, $hierarchy[$i]['parent_id'], $depth++);
	        }
	    }
	    return $tree;
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
