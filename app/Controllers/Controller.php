<?php

namespace App\Controllers;

/**
 * Controller
 *
 * @autor    Carlos Beyersdorf <carlosbdf0213@gmail.com>
 * @copyright    Copyright (c) 2019 Ing. Carlos Beyersdorf
 */

class Controller
{
	protected $container;

	public function __construct($container)
	{
		$this->container = $container;
	}

	public function __get($property)
	{
		if ($this->container->{$property}) {
			return $this->container->{$property};
		}
	}
}