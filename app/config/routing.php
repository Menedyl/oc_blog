<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('home', new Route('/home/{name}',
    array(
        'name' => 'Menedyl !',
        '_controller' => 'AppBundle\Controller\AppController::homeAction'
    )));

$routes->add('post_list', new Route('/post_list',
    array(
        '_controller' => 'AppBundle\Controller\PostController::listAction'
    )));

$routes->add('post', new Route('/post/{id}',
    array(
        '_controller' => 'AppBundle\Controller\PostController::postAction'
    )));

return $routes;