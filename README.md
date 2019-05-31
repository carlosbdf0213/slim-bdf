# slim-bdf
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/HavenShen/slim-born/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/HavenShen/slim-born/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/HavenShen/slim-born/badges/build.png?b=master)](https://scrutinizer-ci.com/g/HavenShen/slim-born/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/HavenShen/slim-born/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/HavenShen/slim-born/?branch=master)
[![Build Status](https://travis-ci.org/HavenShen/slim-born.svg?branch=master)](https://travis-ci.org/HavenShen/slim-born)
[![Latest Stable Version](https://poser.pugx.org/HavenShen/slim-born/v/stable.svg)](https://packagist.org/packages/HavenShen/slim-born)
[![Latest Unstable Version](https://poser.pugx.org/HavenShen/slim-born/v/unstable.svg)](https://packagist.org/packages/HavenShen/slim-born)
[![Latest Stable Version](https://img.shields.io/packagist/v/HavenShen/slim-born.svg?style=flat-square)](https://packagist.org/packages/HavenShen/slim-born)
[![Total Downloads](https://img.shields.io/packagist/dt/HavenShen/slim-born.svg?style=flat-square)](https://packagist.org/packages/HavenShen/slim-born)
[![License](https://img.shields.io/packagist/l/HavenShen/slim-born.svg?style=flat-square)](https://packagist.org/packages/HavenShen/slim-born)

> Slim Framework 3 skeleton de una aplicación que tiene autenticación con arquitectura MVC.

Esta desarrollada la autenticación del usuario, solo es necesario instalar y usar.

## Instalación

```shell
composer create-project carlosbdf/slim-bdf [mi-app]
```

## .env

Copiar el archivo .env.example a .env (configurar con los datos de acceso a su BD)

```
DB_DRIVER=mysql
DB_HOST=localhost
DB_DATABASE=slimborn
DB_USERNAME=root
DB_PASSWORD=
DB_PORT=3306
```

## Enrutador

Usa el Router de Slim Framework.
Reference - [Slim Router](http://www.slimframework.com/docs/objects/router.html)

```php
<?php

$app->get('/', 'HomeController:index')->setName('home');

$app->group('', function () {
	$this->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
	$this->post('/auth/signup', 'AuthController:postSignUp');

	$this->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signin');
	$this->post('/auth/signin', 'AuthController:postSignIn');
})->add(new GuestMiddleware($container));
```

## Controladores

Usa Twig View de Slim Framework .
Reference - [Twig-View](https://github.com/slimphp/Twig-View)

```php
<?php

namespace App\Controllers;

class HomeController extends Controller
{
	public function index($request, $response)
	{
		return $this->view->render($response, 'home.twig');
	}
}
```

## Model

Usa Eloquent de Laravel.
Reference - [illuminate/database](https://github.com/illuminate/database)
```php
<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $table = 'users';

	protected $fillable = [
		'email',
		'name',
		'password',
	];

	public function setPassword($password)
	{
		$this->update([
			'password' => password_hash($password, PASSWORD_DEFAULT)
		]);
	}
}
```

## Middleware

```php
<?php

namespace App\Middleware;

class AuthMiddleware extends Middleware
{
	public function __invoke($request, $response, $next)
	{
		if(! $this->container->auth->check()) {
			$this->container->flash->addMessage('error', 'Debe estar conectado para hacer eso');
			return $response->withRedirect($this->container->router->pathFor('auth.signin'));
		}

		$response = $next($request, $response);

		return $response;
	}
}
```

## Validación

Utilice el mejor motor de validación que jamás se haya creado para PHP.
Reference - [Respect/Validation](https://github.com/Respect/Validation)
```php
<?php

namespace App\Controllers\Auth;
use App\Models\User;
use App\Controllers\Controller;
use Respect\Validation\Validator as v;

class AuthController extends Controller
{
	public function postSignUp($request, $response)
	{
		$validation = $this->validator->validate($request, [
			'email' => v::noWhitespace()->notEmpty()->email()->emailAvailable(),
			'name' => v::noWhitespace()->notEmpty()->alpha(),
			'password' => v::noWhitespace()->notEmpty(),
		]);

		if ($validation->failed()) {
			return $response->withRedirect($this->router->pathFor('auth.signup'));
		}

		//	todo someting
	}
}
```

## Mas funciones básicas

documentos oficiales Slim Framework - [Slim Framework](http://www.slimframework.com/docs/)

## Paquetes utilizados

* [illuminate/database](https://github.com/illuminate/database) - También sirve como la capa de base de datos del marco PHP Laravel.
* [Respect/Validation](https://github.com/Respect/Validation) - El mejor motor de validación que jamás se haya creado para PHP.
* [slimphp/Slim](https://github.com/slimphp/Slim) - Slim Framework created.
* [slimphp/Slim-Csrf](https://github.com/slimphp/Slim-Csrf) - Slim Framework created.
* [slimphp/Twig-View](https://github.com/slimphp/Twig-View) - Slim Framework created.
* [slimphp/Slim-Flash](https://github.com/slimphp/Slim-Flash) - Slim Framework created.


## Estructura de Directorios

```shell
|-- slim-bdf
	|-- app
		|-- Auth
		|-- Controllers
		|-- Middleware
		|-- Models
		|-- Validation
		|-- Routes.php
	|-- bootstrap
		|-- app.php
	|-- public
	|-- resources
	....
```

## Testing

``` bash
$ phpunit
```

## Licencia

Licencia MIT (MIT). Consulte el archivo de licencia (LICENCIA.md) para obtener más información.