<?php

namespace Maltz\Content\Model;

use Maltz\Mvc\Model;

/**
 * db de configuração
 * guarda keys e valuees que são carregados a cada requisição
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

class Section extends Model
{
    /*
	 * construtor
	 *
	 * @param $db DB
	 *
	 * return void
	 *
	 */
    public function __construct($db)
    {
        parent::__construct($db, 'section', 'sections', 'section_id');
    }
}
