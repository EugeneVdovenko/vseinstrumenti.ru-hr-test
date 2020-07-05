<?php
require_once "../vendor/autoload.php";

use App\Controllers\InitializeController;
use App\Controllers\OrderController;
use App\Controllers\PaymentController;
use App\Services\ProductService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// конфиг маршрутов
$routes = new RouteCollection();

$route = (new Route('/init/', ['_controller' => InitializeController::class, '_action' => 'init']))
    ->setMethods(Request::METHOD_GET);
$routes->add('init', $route);

$route = (new Route('/orders/', ['_controller' => OrderController::class, '_action' => 'list']))
    ->setMethods(Request::METHOD_GET);
$routes->add('list-orders', $route);

$route = (new Route('/order/{id}', ['_controller' => OrderController::class, '_action' => 'get']))
    ->setMethods(Request::METHOD_GET);
$routes->add('get-order', $route);

$route = (new Route('/order/create/', ['_controller' => OrderController::class, '_action' => 'create']))
    ->setMethods(Request::METHOD_POST);
$routes->add('create-order', $route);

$route = (new Route('/payment/create/', ['_controller' => PaymentController::class, '_action' => 'createPayment']))
    ->setMethods(Request::METHOD_POST);
$routes->add('create-payment', $route);

// определение и вызов контроллера
$request = Request::createFromGlobals();
$context = (new RequestContext())->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

try {
    $params = $matcher->matchRequest($request);
    $controller = new $params['_controller'](new ProductService);
    $response = call_user_func_array([$controller, $params['_action']], [[$request]]);
} catch (ResourceNotFoundException $e) {
    $response = new JsonResponse(['status' => 'Not Found'], JsonResponse::HTTP_NOT_FOUND);
}

if ($response instanceof Response) {
    $response->send();
}

die(Response::HTTP_OK);
