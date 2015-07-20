<?php

namespace Maltz\Calendar\Model;

use Maltz\Mvc\DB;
use Maltz\Mvc\Model;

class Event extends Model
{
	public function __construct(DB $db)
	{
		parent::__construct($db);
	}
}