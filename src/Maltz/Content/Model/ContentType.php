<?php

namespace Maltz\Content\Model;

use Maltz\Mvc\Model;

class ContentType
{
    public function __construct($db)
    {
        parent::__construct($db, 'content_type', 'content_types', 'content_type_id');
    }

    public function list() {
    	
    }

    public function show() {
    	
    }
}