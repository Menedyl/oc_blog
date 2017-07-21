<?php

require_once "vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Yaml\Yaml;

$conf = new \Doctrine\DBAL\Configuration();

$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . '/src/AppBundle/Entity'));

$dbParams = Yaml::parse(file_get_contents(__DIR__ . '/app/config/config.yml'));

$conn = \Doctrine\DBAL\DriverManager::getConnection($dbParams['doctrine']['dbal'], $conf);

$em = EntityManager::create($dbParams['doctrine']['dbal'], $config);