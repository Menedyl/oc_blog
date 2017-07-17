<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('home', new Route('/home',
    array(
        '_controller' => 'AppBundle\Controller\AppController::homeAction'
    )));

$routes->add('post_list', new Route('/post_list/{page}',
    array(
        '_controller' => 'AppBundle\Controller\PostController::listAction',
        'page' => 1

    )));

$routes->add('post', new Route('/post/{id}',
    array(
        '_controller' => 'AppBundle\Controller\PostController::postAction'
    )));

$routes->add('post_add', new Route('/post_add',
    array(
        '_controller' => 'AppBundle\Controller\PostController::addAction'
    )));

$routes->add('post_edit', new Route('/post_edit/{id}',
    array(
        '_controller' => 'AppBundle\Controller\PostController::editAction'
    )));

return $routes;