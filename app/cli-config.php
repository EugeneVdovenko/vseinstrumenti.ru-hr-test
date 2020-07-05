<?php
$dbConnection = [
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/database.sqlite',
];
$dbConfig = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration([__DIR__ . '/entities'], true);
$entityManager = \Doctrine\ORM\EntityManager::create($dbConnection, $dbConfig);

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);