<?php

namespace App\Middleware;

/**
 * AuthMiddleware
 *
  * @autor    Carlos Beyersdorf <carlosbdf0213@gmail.com>
 * @copyright    Copyright (c) 2019 Ing. Carlos Beyersdorf
 */

class AuthMiddleware extends Middleware
{

	public function __invoke($request, $response, $next)
	{
		if(! $this->container->auth->check()) {
			$this->container->flash->addMessage('error', 'Debe conectarse para hacer eso');
			return $response->withRedirect($this->container->router->pathFor('auth.signin'));
		}

		$response = $next($request, $response);
		return $response;
	}
}