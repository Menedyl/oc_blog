<?php

namespace AppBundle;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\Yaml\Yaml;

class ManagerEntity
{

    private $entityManager;
    private $config;
    private $connect;

    public function __construct()
    {
        $this->config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . '/../AppBundle', false));
        $this->connect = Yaml::parse(file_get_contents(__DIR__ . '/../../app/config/config.yml'));


        $this->entityManager = EntityManager::create($this->connect['doctrine']['dbal'], $this->config);

    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }


}