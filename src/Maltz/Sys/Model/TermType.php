<?php

namespace Maltz\Sys\Model;

class TermType extends Model
{
    public function __construct($db)
    {
        parent::__construct($db, 'term_type', 'term_types', 'term_type_id');
    }
}