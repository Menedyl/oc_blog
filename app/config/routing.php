<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('home', new Route('/home',
    array(
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

$routes->add('post_add', new Route('/post_add',
    array(
        '_controller' => 'AppBundle\Controller\PostController::addAction'
    )));

return $routes;