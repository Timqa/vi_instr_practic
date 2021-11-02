<?php

use Symfony\Component\Routing;

function is_leap_year($year = null): bool
{
  if ($year === null) {
    $year = date('Y');
  }
  return !($year % 400) || (!($year % 4) && ($year % 100));
}


$routes = new Routing\RouteCollection();
$routes->add('/hello', new Symfony\Component\Routing\Route('/hello/{name}', ['name' => 'Timqaa', ['_controller' => 'render_template']]));
$routes->add('/bye', new Symfony\Component\Routing\Route('/bye', ['_controller' => function ($request) {
  return render_template($request);
}]));
$routes->add('/leap_year', new Symfony\Component\Routing\Route('/is_leap_year/{year}', ['_controller' => 'LeapYearController::indexAction']));

return $routes;