<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('home', new Route('/home/{name}',
    array(
        'name' => 'Menedyl !',
        '_controller' => 'AppBundle\Controller\AppController::homeAction'
    )));

$routes->add('blog_list', new Route('/blog_list',
    array(
        '_controller' => 'AppBundle\Controller\BlogController::listAction'
    )));

return $routes;