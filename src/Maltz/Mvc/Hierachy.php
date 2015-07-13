<?php

namespace Maltz\Mvc;

trait Hierarchy
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
}
