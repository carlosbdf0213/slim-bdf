<?php

namespace App\Middleware;

/**
 * Middleware
 *
 * @autor    Carlos Beyersdorf <carlosbdf0213@gmail.com>
 * @copyright    Copyright (c) 2019 Ing. Carlos Beyersdorf
 */

class Middleware
{
	protected $container;

	public function __construct($container)
	{
		$this->container = $container;
	}
}