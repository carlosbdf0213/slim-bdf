<?php

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controllers\Controller;
use Respect\Validation\Validator as v;

/**
 * AuthController
 *
 * @autor    Carlos Beyersdorf <carlosbdf0213@gmail.com>
 * @copyright    Copyright (c) 2019 Ing. Carlos Beyersdorf
 */

class AuthController extends Controller
{
	public function getSignOut($request, $response)
	{
		$this->auth->logout();
		return $response->withRedirect($this->router->pathFor('home'));
	}

	public function getSignIn($request, $response)
	{
		return $this->view->render($response, 'auth/signin.twig');
	}

	public function postSignIn($request, $response)
	{
		$auth = $this->auth->attempt(
			$request->getParam('email'),
			$request->getParam('password')
		);

		if (! $auth) {
			$this->flash->addMessage('error', 'No es posible entrar con esas credenciales');
			return $response->withRedirect($this->router->pathFor('auth.signin'));
		}

		return $response->withRedirect($this->router->pathFor('home'));
	}

	public function getSignUp($request, $response)
	{
		return $this->view->render($response, 'auth/signup.twig');
	}

	public function postSignUp($request, $response)
	{

		$validation = $this->validator->validate($request, [
			'email' => v::noWhitespace()->notEmpty()->email()->emailAvailable(),
			'name' => v::notEmpty()->alpha(),
			'password' => v::noWhitespace()->notEmpty(),
		]);

		if ($validation->failed()) {
			return $response->withRedirect($this->router->pathFor('auth.signup'));
		}

		$user = User::create([
			'email' => $request->getParam('email'),
			'name' => $request->getParam('name'),
			'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
		]);

		$this->flash->addMessage('info', 'Se ha registrado exitosamente');

		$this->auth->attempt($user->email,$request->getParam('password'));

		return $response->withRedirect($this->router->pathFor('home'));
	}
}