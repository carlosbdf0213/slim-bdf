<?php

namespace App\Middleware;

/**
 * OldInputMiddleware
 *
 * @autor    Carlos Beyersdorf <carlosbdf0213@gmail.com>
 * @copyright    Copyright (c) 2019 Ing. Carlos Beyersdorf
 */

class OldInputMiddleware extends Middleware
{

	public function __invoke($request, $response, $next)
	{
		$this->container->view->getEnvironment()->addGlobal('old', isset($_SESSION['old']) ? $_SESSION['old'] : '');
		$_SESSION['old'] = $request->getParams();

		$response = $next($request, $response);
		return $response;
	}
}