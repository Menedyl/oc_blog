<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../doctrine.php';

use AppBundle\Framework;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

// Create the Request
$request = Request::createFromGlobals();
$routes = include __DIR__ . '/../app/config/routing.php';

$context = new RequestContext();

/* @var UrlMatcher $matcher */
$matcher = new UrlMatcher($routes, $context);

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$appBundle = new Framework($matcher, $controllerResolver, $argumentResolver);
$response = $appBundle->handle($request);

$response->setClientTtl(0);
$response->send();

