<?php

use BeeJee\App\Session;
use Delight\Auth\Auth;
use League\Route\Router;
use Zend\Diactoros\ServerRequestFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

define('APP_PATH', __DIR__ . '/..');

if (php_sapi_name() === "cli-server") {
    $uri = urldecode(
        parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
    );

    if ($uri !== '/' && file_exists(__DIR__ . '/public' . $uri)) {
        return false;
    }
}

require_once APP_PATH . '/vendor/autoload.php';

$request = ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$container = (new League\Container\Container)->delegate(
    new League\Container\ReflectionContainer
);

$session = new Session();
$pdo  = new PDO("mysql:host=mysql;dbname=beejee", "root", "beejee");
$auth = new Auth($pdo);

$container->share(PDO::class, $pdo);
$container->share(Auth::class, $auth);
$container->share(Session::class, $session);

$router = (new Router())->setStrategy(
    (new League\Route\Strategy\ApplicationStrategy)->setContainer($container)
);
$routes = include APP_PATH . '/routes.php';
$routes($router, $container);

$response = $router->dispatch($request);

(new SapiEmitter())->emit($response);