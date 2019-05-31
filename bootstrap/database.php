<?php

/**
 * database
 * 
 * @autor    Carlos Beyersdorf <carlosbdf0213@gmail.com>
 * @copyright    Copyright (c) 2019 Ing. Carlos Beyersdorf
 */

$capsule = new \Illuminate\Database\Capsule\Manager;

$capsule->addConnection([
    'driver' => getenv('DB_DRIVER'),
    'host' => getenv('DB_HOST'),
    'database' => getenv('DB_DATABASE'),
    'username' => getenv('DB_USERNAME'),
    'password' => getenv('DB_PASSWORD'),
    'charset' => 'utf8',
    'port' => getenv('DB_PORT'),
    'collation' => 'utf8_unicode_ci',
    'prefix' => ''
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();
