<?php

namespace Maltz\Media\Model;

use Maltz\Mvc\Model;

/**
 * db de files pertencentes a albums
 *
 * http://ideiasinsolitas.com.br/
 *
 * @copyright  Copyright (c) 2012-2013 Pedro Koblitz
 * @author      Pedro Koblitz pedrokoblitz@gmail.com
 * @license    GPL v2
 *
 * @package    Maltz
 *
 * @version    0.1 alpha
 */

/*
 *
 *
 *
 * @param objeto DB
 *
 * return void
 */

class FileType extends Model
{
    private $album;

    /*
     * construtor
     *
     * @param db objeto DB
     *
     *
     */
    public function __construct($db)
    {
        parent::__construct($db, 'file_type', 'file_types', 'file_type_id');
    }
}
