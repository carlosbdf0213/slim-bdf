<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

/**
 * MatchesPasswordException
 *
 * @autor    Carlos Beyersdorf <carlosbdf0213@gmail.com>
 * @copyright    Copyright (c) 2019 Ing. Carlos Beyersdorf
 */

class MatchesPasswordException extends ValidationException
{
	public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} no coinciden',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} coinciden',
        ]
    ];
}