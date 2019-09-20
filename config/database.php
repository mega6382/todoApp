<?php
declare(strict_types=1);

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

/**
 * @return EntityManager
 */
function connection()
{

// Create a simple "default" Doctrine ORM configuration for Annotations
    $isDevMode = true;
    $proxyDir = null;
    $cache = null;
    $useSimpleAnnotationReader = false;
    $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/../src"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);
// database configuration parameters
    $conn = array(
        'driver' => 'pdo_sqlite',
        'path' => __DIR__ . '/db.sqlite',
    );
    try {
        $entityManager = EntityManager::create($conn, $config);
    } catch (\Doctrine\ORM\ORMException $e) {
        echo "Unable to connect to database";
        exit;
    }
    return $entityManager;
}