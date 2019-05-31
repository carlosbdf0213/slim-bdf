<?php

namespace App\Controllers;

use App\Models\User;

/**
 * HomeController
 *
 * @autor    Carlos Beyersdorf <carlosbdf0213@gmail.com>
 * @copyright    Copyright (c) 2019 Ing. Carlos Beyersdorf
 */

class HomeController extends Controller
{
	public function index($request, $response)
	{
		return $this->view->render($response,'home.twig');
	}
}