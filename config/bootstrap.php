<?php
declare(strict_types=1);
require __DIR__ . '/../vendor/autoload.php';
include 'database.php';

use Slim\App;
use Slim\Factory\AppFactory;

/**
 * @return App
 * @throws Exception
 */
function bootstrap()
{
    $app = AppFactory::create();
    $app->addErrorMiddleware(true, true, true);
    $entityManager = connection();
    $routes = include '../routes/api.php';
    $routes($app, $entityManager);
    return $app;
}