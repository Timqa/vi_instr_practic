<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

function render_template($request)
{
    extract($request->attributes->all(), EXTR_SKIP);
    ob_start();
    require sprintf('./page/%s.php', $_route);
    return new Response(ob_get_clean());
}

try {
    $request->attributes->add($matcher->match($request->getPathInfo()));
    $response = call_user_func($request->attributes->get('_controller'), $request);
} catch (ResourceNotFoundException $e) {
    $response = new Response('Page Not Found', 404);
} catch (Exception $e) {
    $response = new Response('Error Server', 500);
}
