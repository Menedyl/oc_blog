<?php

require_once __DIR__ . '/../vendor/autoload.php';

use AppBundle\AppBundle;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Yaml\Yaml;

// Create the Request
$request = Request::createFromGlobals();
$routes = include __DIR__ . '/../app/config/routing.php';


$context = new RequestContext();

/* @var UrlMatcher $matcher */
$matcher = new UrlMatcher($routes, $context);

// Create the EntityManager

$paths = array(__DIR__ . '/../src/AppBundle/Entity');
$isDevMode = false;
$dbParams = Yaml::parse(file_get_contents(__DIR__ . '/../app/config/config.yml'));
$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);

$em = EntityManager::create($dbParams['doctrine']['dbal'], $config);


$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$appBundle = new AppBundle($matcher, $controllerResolver, $argumentResolver);
$response = $appBundle->handle($request);

$response->send();
