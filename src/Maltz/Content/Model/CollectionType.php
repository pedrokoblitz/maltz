<?php

namespace Maltz\Content\Model;

use Maltz\Mvc\Model;

class CollectionType extends Model
{
    public function __construct($db)
    {
        parent::__construct($db, 'collection_type', 'collection_types', 'collection_type_id');
    }
}