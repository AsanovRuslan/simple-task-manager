<?php

use BeeJee\App\Controllers;
use BeeJee\App\Middlewares\AuthMiddleware;
use League\Route\Router;

return function (Router $router, Psr\Container\ContainerInterface $container) {

    $router->get('/', Controllers\Task\Index::class);

    $router->get('/login', Controllers\Auth\Index::class);
    $router->post('/login', Controllers\Auth\Login::class);
    $router->get('/logout', Controllers\Auth\Logout::class);

    $router->get('/task/create', Controllers\Task\Form::class);
    $router->post('/task/create', Controllers\Task\Create::class);

    $router->get('/task/{id:number}', Controllers\Task\View::class);

    $router->get('/task/{id:number}/create', Controllers\Task\Form::class)->middleware(
        $container->get(AuthMiddleware::class)
    );

    $router->get('/task/{id:number}/edit', Controllers\Task\Form::class)->middleware(
        $container->get(AuthMiddleware::class)
    );

    $router->post('/task/{id:number}', Controllers\Task\Update::class)->middleware(
        $container->get(AuthMiddleware::class)
    );
};