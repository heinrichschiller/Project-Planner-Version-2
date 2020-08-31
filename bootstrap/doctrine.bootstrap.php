<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

/*
|----------------------------------------------------------------------------
| Doctrine configuration
|----------------------------------------------------------------------------
|
| Create a simple "default" Doctrine ORM configuration for Annotations
|
*/
$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;
$config = Setup::createAnnotationMetadataConfiguration(
    array(__DIR__."/../src")
    , $isDevMode
    , $proxyDir
    , $cache
    , $useSimpleAnnotationReader
);

/*
|----------------------------------------------------------------------------
| Other configuration files, if you prefer yaml or XML
|----------------------------------------------------------------------------
*/

/*
|----------------------------------------------------------------------------
| XML configuration files
|----------------------------------------------------------------------------
*/
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);

/*
|----------------------------------------------------------------------------
| YAML configuration files
|----------------------------------------------------------------------------
|
| Yaml configuration is deprecated and will be removed in Doctrine Version 3
|
*/
//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

/*
|----------------------------------------------------------------------------
| Database configuration parameters
|----------------------------------------------------------------------------
*/
$conn = [
    'driver' => 'pdo_mysql',
    'host' => '',
    'user' => '',
    'password' => '',
    'dbname' => '',
    'charset' => 'utf8mb4'
];

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);
