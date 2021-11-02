<?php

namespace App;
ini_set('display_errors', 1);
require_once '../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel;
use Symfony\Component\Routing;

function render_template(Request $request)
{
  extract($request->attributes->all(), EXTR_SKIP);
  ob_start();
  include sprintf(__DIR__.'/pages/%s.php', $_route);

  return new Response(ob_get_clean());
}

$request = Request::createFromGlobals();
$routes = include './app.php';

$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$controllerResolver = new HttpKernel\Controller\ControllerResolver();
$argumentResolver = new HttpKernel\Controller\ArgumentResolver();

try {
  $request->attributes->add($matcher->match($request->getPathInfo()));

  $controller = $controllerResolver->getController($request);
  $arguments = $argumentResolver->getArguments($request, $controller);

  $response = call_user_func_array($controller, $arguments);
} catch (Routing\Exception\ResourceNotFoundException $exception) {
  $response = new Response('Not Found', 404);
} catch (Exception $exception) {
  $response = new Response('An error occurred', 500);
}

$response->send();