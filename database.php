<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Psr\Container\ContainerInterface;

// setup entity manager
$container->share(EntityManager::class, function(ContainerInterface $c) {

    $db_entities = $c['db.entities'] ?? [];

    $entities = [];
    foreach($db_entities as $entity) {
        $entities[] = root('src/' . ltrim($entity, '/'));
    }

    $config = Setup::createAnnotationMetadataConfiguration($entities, $c['debug'] ?? false);
    $entity_manager = EntityManager::create($c['db'], $config);

    return $entity_manager;
});