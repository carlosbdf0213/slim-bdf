<?php

namespace App\Validation\Rules;

use App\Models\User;
use Respect\Validation\Rules\AbstractRule;

/**
 * EmailAvailable
 *
 * @autor    Carlos Beyersdorf <carlosbdf0213@gmail.com>
 * @copyright    Copyright (c) 2019 Ing. Carlos Beyersdorf
 */

class EmailAvailable extends AbstractRule
{

	public function validate($input)
	{
		return User::where('email',$input)->count() === 0;
	}
}