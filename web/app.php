<?php

require_once __DIR__ . '/../vendor/autoload.php';

use AppBundle\AppBundle;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

$request = Request::createFromGlobals();
$routes = include __DIR__ . '/../app/Config/routing.php';


$context = new RequestContext();

/* @var UrlMatcher $matcher */
$matcher = new UrlMatcher($routes, $context);

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$appBundle = new AppBundle($matcher, $controllerResolver, $argumentResolver);
$response = $appBundle->handle($request);

$response->send();
