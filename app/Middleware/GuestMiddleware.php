<?php

namespace App\Middleware;

/**
 * GuestMiddleware
 *
 * @autor    Carlos Beyersdorf <carlosbdf0213@gmail.com>
 * @copyright    Copyright (c) 2019 Ing. Carlos Beyersdorf
 */

class GuestMiddleware extends Middleware
{

	public function __invoke($request, $response, $next)
	{
		if($this->container->auth->check()) {
			return $response->withRedirect($this->container->router->pathFor('home'));
		}

		$response = $next($request, $response);
		return $response;
	}
}