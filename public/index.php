<?php
namespace App;
ini_set('display_errors', 1);
require_once '../vendor/autoload.php';


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$request = Request::createFromGlobals();
$response = new Response();
$routes = new RouteCollection();
$context = new RequestContext();

$routes->add('/hello', new Route('/hello/{name}', [
    'name' => 'Timqaa',
    '_controller' => 'render_template',
]));
$routes->add('/bye', new Route('/bye', ['_controller' => 'render_template']));
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

require_once './web/front.php';

$response->send();