<?php
namespace App;
ini_set('display_errors', 1);
require_once '../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$request = Request::createFromGlobals();
$response = new Response();
$routes = new RouteCollection();
$context = new RequestContext();

$routes->add('/hello', new Route('/hello/{name}', ['name' => 'Timqaa']));
$routes->add('/bye', new Route('/bye'));
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);
try {
    extract($matcher->match($request->getPathInfo(), EXTR_SKIP));
    ob_start();
    require sprintf('./page/%s.php', $_route);
} catch (ResourceNotFoundException $exception) {
    $response = new Response('Page Not Found', 404);
} catch (\Exception $exception) {
    $response = new Response('Error Server', 500);
}


$response->send();