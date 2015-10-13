<?php

namespace Maltz\Store\Service;

use Maltz\Http\CookieJar;
use Maltz\Package\Store\Model\Cart;

class CartService
{
	protected $cookie;

	public function __construct(CookieJar $cookieJar)
	{
		$this->cookie = $cookieJar;
	}
}
