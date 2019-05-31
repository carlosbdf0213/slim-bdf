<?php

namespace App\Middleware;

/**
 * ValidationErrorsMiddleware
 *
 * @autor    Carlos Beyersdorf <carlosbdf0213@gmail.com>
 * @copyright    Copyright (c) 2019 Ing. Carlos Beyersdorf
 */

class ValidationErrorsMiddleware extends Middleware
{

	public function __invoke($request, $response, $next)
	{
		$this->container->view->getEnvironment()->addGlobal('errors', isset($_SESSION['errors']) ? $_SESSION['errors'] : '');
		unset($_SESSION['errors']);

		$response = $next($request, $response);
		return $response;
	}
}