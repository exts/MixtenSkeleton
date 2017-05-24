<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

//require bootstrap
require dirname(__DIR__) . '/bootstrap.php';

//get entity manager
$entity_manager = $container->get(EntityManager::class);

//return cli tool
return ConsoleRunner::createHelperSet($entity_manager);