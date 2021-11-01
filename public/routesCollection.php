<?php
require_once './functions.php';

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Route;

$routes->add('/hello', new Route('/hello/{name}', [
    'name' => 'Timqaa',
    '_controller' => function ($request) {
        return render_template($request);
    }
]));
$routes->add('/bye', new Route('/bye', ['_controller' => function ($request) {
    return render_template($request);
}]));

$routes->add('/leap_year', new Route('/is_leap_year/{year}', [
    'year' => null,
    '_controller' => function ($request) {
        if (is_leap_year($request->attributes->get('year'))) {
            return new Response('Да, это высокосный год!');
        }
        return new Response('Нет, это не высокосный год');
    }
]));

return $routes;