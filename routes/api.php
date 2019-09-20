<?php
declare(strict_types=1);

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use Todo\Controller\TodoController;

return function (App $app, EntityManager $entityManager) {
    $app->group('/', function (Group $group) {
        // Main page, a simple hello world
        $group->get('', function (Request $request, Response $response, $args) {
            $response->getBody()->write("Hello World!");
            return $response;
        });
    });
    $app->group('/todo', function (Group $group) use ($entityManager) {
        // Main page, a simple hello world
        $controller = new TodoController($entityManager);
        $group->get('', function (Request $request, Response $response, $args) use ($controller) {
            $newResponse = $response->withHeader('Content-type', 'application/json');
            $newResponse->getBody()->write($controller->listAction());
            return $newResponse;
        });
        $group->post('', function (Request $request, Response $response, $args) use ($controller) {
            $newResponse = $response->withHeader('Content-type', 'application/json');
            $newResponse->getBody()->write($controller->addAction($request->getParsedBody()));
            return $newResponse;
        });
        $group->put('/{id}', function (Request $request, Response $response, $args) use ($controller) {
            $newResponse = $response->withHeader('Content-type', 'application/json');
            parse_str($request->getBody()->getContents(), $body);
            $newResponse->getBody()->write($controller->editAction((int)$args['id'], $body));
            return $newResponse;
        });
        $group->delete('/{id}', function (Request $request, Response $response, $args) use ($controller) {
            $newResponse = $response->withHeader('Content-type', 'application/json');
            $newResponse->getBody()->write($controller->removeAction((int)$args['id']));
            return $newResponse;
        });
    });
};