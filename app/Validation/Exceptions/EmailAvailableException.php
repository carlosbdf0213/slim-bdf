<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

/**
 * EmailAvailableException
 *
 * @autor    Carlos Beyersdorf <carlosbdf0213@gmail.com>
 * @copyright    Copyright (c) 2019 Ing. Carlos Beyersdorf
 */

class EmailAvailableException extends ValidationException
{

	public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} is already taken',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} is not already taken',
        ]
    ];
}